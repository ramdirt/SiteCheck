<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Services\TelegramBotService;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class TelegramSendingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $chat_id;
    public array $data;

    public function __construct(int $chat_id, array $data)
    {
        $this->chat_id = $chat_id;
        $this->data = $data;
    }

    public function handle(TelegramBotService $bot)
    {
        $bot->setChatId($this->chat_id)->setData($this->data)->sendReport();
    }
}