<?php

namespace App\Services\Contract;

interface AccessTest
{
    public function setUser(object $user): object;
    public function start();
}