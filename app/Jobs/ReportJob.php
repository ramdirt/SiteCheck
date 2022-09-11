<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Services\ReportService;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public object $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function handle(ReportService $report)
    {
        $report->setUser($this->user)->generateReport()->sendReport();
    }
}