<?php

namespace App\Services;

use App\Services\Contract\TelegramBot;

class TelegramBotService implements TelegramBot
{
    public function sendMessage(string $login, object $template)
    {
        $token = env('TG_TOKEN');
        $method = 'sendMessage';
        $params = [
            'chat_id' => $login,
            'text' => $template->render(),
            'parse_mode' => 'html'
        ];
        $url = "https://api.tlgr.org/bot{$token}/{$method}";
        \Illuminate\Support\Facades\Http::post($url, $params);
        return $template;
    }
};