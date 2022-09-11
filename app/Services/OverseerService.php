<?php

namespace App\Services;

use App\Jobs\AccessTestJob;


class OverseerService
{
    private object $user;

    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    public function startVerify()
    {
        foreach ($this->user->sites as $site) {
            dispatch(new AccessTestJob($site));
        }
    }
}