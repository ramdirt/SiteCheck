<?php

namespace App\Services\Contract;

interface TelegramBot
{
    public function sendMessage(string $login, object $template);
}
