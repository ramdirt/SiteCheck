<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TelegramBotService
{
    private int $chat_id;
    private array $data;

    public function setChatId(int $chat_id): object
    {
        $this->chat_id = $chat_id;

        return $this;
    }

    public function setData(array $data): object
    {
        $this->data = $data;

        return $this;
    }

    public function sendReport(): object
    {
        $token = env('TG_TOKEN');
        $params = [
            'chat_id' => $this->chat_id,
            'text' => view('telegram.report', ['data' => $this->data])->render(),
            'parse_mode' => 'html'
        ];
        $url = "https://api.tlgr.org/bot{$token}/sendMessage";

        Http::post($url, $params);

        return $this;
    }
};