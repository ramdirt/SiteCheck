<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Services\OverseerService;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class OverseerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private object $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function handle(OverseerService $overseer)
    {
        $overseer->setUser($this->user)->startVerify();
    }
}