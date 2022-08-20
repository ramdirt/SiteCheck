<?php

namespace App\Services;

use App\Jobs\TelegramSendingProcess;
use Illuminate\Support\Facades\Mail;

class ReportService
{
    public function sendReportMail(string $mail, object $template)
    {
        Mail::to($mail)->queue($template);
    }

    public function sendReportTelegram(int $chat_id, array $data)
    {
        dispatch(new TelegramSendingProcess($chat_id, $data));
    }
}
