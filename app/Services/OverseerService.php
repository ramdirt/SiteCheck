<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Site;
use App\Models\User;
use App\Jobs\AccessTestProcess;
use App\Services\ReportService;


class OverseerService
{
    private array $userSites;
    private object $user;

    public function run()
    {
        $this->getListOfUserSitesToCheck();
        $this->createTaskForReview();
        $this->updateLimitUser();
        $this->sendReportUser();
    }


    private function createTaskForReview()
    {
        foreach ($this->userSites as $userSite) {
            $last_check = Carbon::parse($userSite['last_check']);
            $allowable_time = $last_check->addMinutes($userSite['interval']);

            if (Carbon::now()->gt($allowable_time)) {
                $site = Site::find($userSite['site_id']);
                dispatch(new AccessTestProcess($site));
            }
        }

        $this->user = User::find($userSite['user_id']);
    }


    private function getListOfUserSitesToCheck()
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


    private function sendReportUser()
    {
        $report = new ReportService($this->user);

        if ($this->user->report_telegram) {
            $report->sendReportTelegram();
        }

        if ($this->user->report_email) {
            $report->sendReportMail();
        }
    }


    private function updateLimitUser()
    {
        $limit = $this->user->limit;

        if ($limit > 0) {
            $this->user->update([
                'limit' => $limit - 1
            ]);
        }
    }
}