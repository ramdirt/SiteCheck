<?php

namespace App\Services;

class TelegramBotService
{
    public function sendMessage()
    {
        $token = env('TG_TOKEN');
        $method = 'sendMessage';
        $params = [
            'chat_id' => 1053678973,
            'text' => 'Привет'
        ];
        $url = "https://api.tlgr.org/bot{$token}/{$method}";
        \Illuminate\Support\Facades\Http::post($url, $params);
        return "send message";
    }
};