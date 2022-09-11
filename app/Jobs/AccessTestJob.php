<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Services\AccessTestService;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class AccessTestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public object $site;

    public function __construct(object $site)
    {
        $this->site = $site;
    }

    public function handle(AccessTestService $test)
    {
        $test->setSite($this->site)->start();
    }
}