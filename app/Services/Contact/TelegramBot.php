<?php

namespace App\Services\Contract;

interface TelegramBot
{
    public function setChatId(int $chat_id): object;
    public function setData(array $data): object;
    public function sendReport();
}