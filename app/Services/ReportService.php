<?php

namespace App\Services;

use App\Mail\ReportShipped;
use App\Jobs\TelegramSendingJob;
use Illuminate\Support\Facades\Mail;

class ReportService
{
    private array $report;
    private object $user;

    public function setUser(object $user): object
    {
        $this->user = $user;

        return $this;
    }


    public function generateReport(): object
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

        return $this;
    }

    public function sendReport()
    {
        if ($this->user->report_telegram) {
            if ($this->user->telegram_id) {
                dispatch(new TelegramSendingJob($this->user->telegram_id, $this->report));
            }
        }

        if ($this->user->report_email) {
            Mail::to($this->user->email)->queue(new ReportShipped($this->report));
        }
    }
}