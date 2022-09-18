<?php

namespace App\Services\Contract;

interface UserBalance
{
    public function setUser(object $user): object;
    public function reduceBalance();
}