<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Site;
use App\Models\User;
use App\Jobs\AccessTestProcess;
use App\Services\ReportService;


class Overseer
{
    public $userInterval;
    public $userSites;

    public function GetListOfUserSitesToCheck()
    {
        foreach (User::all() as $user) {
            foreach ($user->sites as $site) {
                $this->userSites[] = [
                    'user_id' => $user->id,
                    'site_id' => $site->id,
                    'interval' => $user->interval,
                    'last_check' => $site->last_check,
                ];
            }
        }

        return $this;
    }

    public function CreateTaskForReview()
    {
        $carbon = new Carbon();
        $report = new ReportService();

        foreach ($this->userSites as $userSite) {
            $last_check = $carbon->parse($userSite['last_check']);
            $allowable_time = $last_check->addMinutes($userSite['interval']);

            if ($carbon->now()->gt($allowable_time)) {
                $site = Site::find($userSite['site_id']);
                dispatch(new AccessTestProcess($site));
            }
        }

        $user = User::find($userSite['user_id']);

        if ($user->report_telegram) {
            $report->setUser($user)->generateReport()->sendReportTelegram();
        }

        if ($user->report_email) {
            $report->setUser($user)->generateReport()->sendReportMail();
        }

        return true;
    }
}