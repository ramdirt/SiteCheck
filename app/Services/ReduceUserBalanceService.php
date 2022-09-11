<?php

namespace App\Services;

use App\Models\Rate;

class UserBalanceService
{
    private object $user;
    private object $rate;

    public function __construct()
    {
        // TODO: не оптимально, в будущем переделать, так как возможны другие тарифы
        // TODO: переименовать класс в UserBalance и сделать рефакторинг
        $this->rate = Rate::find(1);
    }

    public function setUser($user)
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