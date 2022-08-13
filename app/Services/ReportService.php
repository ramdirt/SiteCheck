<?php

namespace App\Services;

use App\Mail\ReportShipped;
use Illuminate\Support\Facades\Mail;
use App\Services\Contract\Report;

class ReportService implements Report
{
    public function sendMail(string $mail, object $template)
    {
        Mail::to($mail)->queue($template);
    }

    public function sendMessageTelegram(string $login)
    {
        // TODO: Написать сервис для работы с ботом телеграма
    }
}
