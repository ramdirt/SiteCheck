<?php

namespace App\Services;

use App\Models\User;
use App\Mail\ReportShipped;
use App\Jobs\TelegramSendingProcess;
use Illuminate\Support\Facades\Mail;

class ReportService
{
    private array $report;
    private object $user;

    public function __construct(object $user)
    {
        $this->user = $user;
        $this->generateReport();
    }

    private function generateReport()
    {
        foreach ($this->user->sites as $site) {
            $this->report[] = [
                'name' => $site->name,
                'url' => $site->url,
                'pages' => [
                    [
                        'name' => 'Главная',
                        'url' => '/',
                        'status' => $site->status
                    ]
                ],
            ];
        }
    }

    public function sendReportMail()
    {
        Mail::to($this->user->email)->queue(new ReportShipped($this->report));
    }

    public function sendReportTelegram()
    {
        if ($this->user->telegram_id) {
            dispatch(new TelegramSendingProcess($this->user->telegram_id, $this->report));
        }
    }
}