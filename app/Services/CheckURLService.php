<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CheckURLService
{
    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function check(): Bool
    {
        $check_dns = checkdnsrr($this->url);

        if ($check_dns !== true) {
            return false;
        }

        $response = Http::retry(3, 500, throw: false)->get($this->url);

        return $response->status() === 200 ? true : false;
    }
}