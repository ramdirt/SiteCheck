<?php

namespace App\Services;

class UserBalanceService
{
    private object $user;
    private object $rate;

    public function __construct()
    {
        $this->rate = 0.05;
    }

    public function setUser(object $user): object
    {
        $this->user = $user;

        return $this;
    }

    public function reduceBalance()
    {
        $count_user_site = count($this->user->sites);
        $amount_payment = $count_user_site * $this->rate->price;
        $this->user->wallet -= $amount_payment;
        $this->user->update();
    }
}
