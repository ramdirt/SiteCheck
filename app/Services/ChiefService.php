<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Jobs\ReportJob;
use App\Jobs\OverseerJob;
use App\Jobs\ReduceUserBalanceJob;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Auth;


class ChiefService
{
    private object $user;

    public function start()
    {
        $users = User::all();

        foreach ($users as $user) {
            $this->user = $user;

            if ($this->checkInterval() and $this->checkSitesIsEmpty() or Auth::user()->is_admin)
                Bus::chain([
                    new OverseerJob($user),
                    new ReportJob($user),
                    new ReduceUserBalanceJob($user),
                ])->dispatch();

            $this->updateLastCheck();
        }
    }

    private function checkInterval(): Bool
    {
        $last_check = Carbon::parse($this->user->last_check);
        $allowable_time = $last_check->addMinutes($this->user->interval);

        if ($this->user->last_check === NULL) {
            return true;
        }

        return Carbon::now()->gt($allowable_time);
    }

    private function checkSitesIsEmpty(): Bool
    {
        return !$this->user->sites->isEmpty();
    }

    private function updateLastCheck()
    {
        $this->user->last_check = Carbon::now();
        $this->user->update();
    }
}