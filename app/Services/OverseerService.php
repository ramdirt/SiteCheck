<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Rate;
use App\Models\Site;
use App\Models\User;
use App\Jobs\AccessTestProcess;
use App\Services\ReportService;


class OverseerService
{
    private object $user_sites;
    private object $user;
    private object $rate;

    public function __construct()
    {
        // TODO: не оптимально, в будущем переделать, так как возможны другие тарифы
        $this->rate = Rate::find(1);
    }

    public function run()
    {
        $this->getListOfUserSitesToCheck();
        $this->reduceUserBalance();
        $this->createTaskForReview();
        $this->sendReportUser();
    }


    private function createTaskForReview()
    {
        foreach ($this->user_sites as $user_site) {
            if ($this->checkInterval()) {
                dispatch(new AccessTestProcess($user_site));
            }
        }
    }


    private function checkInterval(): Bool
    {
        $last_check = Carbon::parse($this->user->last_check);
        $allowable_time = $last_check->addMinutes($this->user->interval);

        return Carbon::now()->gt($allowable_time);
    }


    private function reduceUserBalance()
    {
        if ($this->checkInterval()) {
            $count_user_site = count($this->user->sites);
            $amount_payment = $count_user_site * $this->rate->price;
            $this->user->wallet -= $amount_payment;
            $this->user->update();
        }
    }


    private function getListOfUserSitesToCheck()
    {
        foreach (User::all() as $user) {
            $this->user = $user;
            $this->user_sites = $user->sites;
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
}