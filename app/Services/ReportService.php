<?php

namespace App\Services;

use App\Services\Contract\Report;
use App\Services\TelegramBotService;
use Illuminate\Support\Facades\Mail;

class ReportService implements Report
{
    public function sendMail(string $mail, object $template)
    {
        Mail::to($mail)->queue($template);
    }

    public function sendMessageTelegram(string $telegram_id, object $template)
    {
        $bot = new TelegramBotService;
        $bot->sendMessage($telegram_id, $template);
    }
}