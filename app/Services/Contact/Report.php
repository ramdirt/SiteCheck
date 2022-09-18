<?php

namespace App\Services\Contract;

interface Report
{
    public function setUser(object $user);
    public function generateReport();
    public function sendReport();
}