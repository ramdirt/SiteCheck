<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Site;
use App\Models\User;
use App\Jobs\AccessTestProcess;
use App\Services\ReportService;


class Overseer
{
    private $userSites;
    private $carbon;

    public function __construct()
    {
        $this->carbon = new Carbon();
    }

    public function CreateTaskForReview()
    {
        $this->GetListOfUserSitesToCheck();

        foreach ($this->userSites as $userSite) {
            $last_check = $this->carbon->parse($userSite['last_check']);
            $allowable_time = $last_check->addMinutes($userSite['interval']);

            if ($this->carbon->now()->gt($allowable_time)) {
                $site = Site::find($userSite['site_id']);
                dispatch(new AccessTestProcess($site));
            }
        }

        $user = User::find($userSite['user_id']);

        $this->updateLimitUser($user);
        $this->sendReportUser($user);
    }


    public function GetListOfUserSitesToCheck()
    {
        foreach (User::all() as $user) {
            foreach ($user->sites as $site) {
                $this->userSites[] = [
                    'user_id' => $user->id,
                    'site_id' => $site->id,
                    'interval' => $user->interval,
                    'last_check' => $site->last_check,
                    'limit' => $user->limit,
                ];
            }
        }
    }

    private function sendReportUser(object $user)
    {
        $report = new ReportService($user);

        if ($user->report_telegram) {
            $report->sendReportTelegram();
        }

        if ($user->report_email) {
            $report->sendReportMail();
        }
    }


    private function updateLimitUser(object $user)
    {
        $limit = $user->limit;

        if ($limit > 0) {
            $user->update([
                'limit' => $limit - 1
            ]);
        }
    }
}