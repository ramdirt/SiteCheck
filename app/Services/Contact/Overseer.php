<?php

namespace App\Services\Contract;

interface Overseer
{
    public function setUser(object $user);
    public function startVerify();
}