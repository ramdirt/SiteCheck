<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Jobs\ReportJob;
use App\Jobs\OverseerJob;
use App\Jobs\ReduceUserBalanceJob;
use Illuminate\Support\Facades\Bus;


class ChiefController extends Controller
{
    private object $user;

    public function __invoke()
    {
        foreach (User::all() as $user) {
            $this->user = $user;

            if ($this->checkInterval() and $this->checkSites())
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

    private function checkSites(): Bool
    {
        return !$this->user->sites->isEmpty();
    }

    private function updateLastCheck()
    {
        $this->user->last_check = Carbon::now();
        $this->user->update();
    }
}