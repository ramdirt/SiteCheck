<?php

namespace App\Services;

use App\Models\User;


class Overseer
{
    public $userInterval;
    public $userSites;

    public function getUserInterval()
    {
        foreach (User::all() as $user) {
            $this->userInterval[] = [
                'id' => $user->id,
                'interval' => $user->interval,
            ];
        }
        dd(User::all());
    }

    public function getLastCheckTime()
    {
        foreach (User::all() as $user) {
            foreach ($user->sites as $site) {
                $this->userSites[] = [
                    'name' => $site,
                ];
            }
        }
        dd($this->userSites);
    }
}