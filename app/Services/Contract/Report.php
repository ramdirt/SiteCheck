<?php

namespace App\Services\Contract;

interface Report
{
    public function SendMail(string $mail, object $template);
    public function SendMessageTelegram(string $telegram_id, object $template);
}