<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;


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
                    'interval' => $user->interval,
                    'url' => $site->url,
                    'last_check' => $site->last_check,
                ];
            }
        }

        return $this;
    }

    public function CreateTaskForReview()
    {
        $carbon = new Carbon();

        foreach ($this->userSites as $userSite) {
            $last_check = $carbon->parse($userSite['last_check']);
            $allowable_time = $last_check->addMinutes($userSite['interval']);
            dd($carbon::parse($userSite['last_check'])->addMinutes($userSite['interval'])->between($last_check, $allowable_time));
        }
    }
}