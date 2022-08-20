<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AccessTestService
{
    protected string $url;

    public function setURL(string $url)
    {
        $this->url = $url;

        return $this;
    }

    public function run()
    {
        $check_dns = checkdnsrr($this->url);

        if ($check_dns === true) {
            $response = Http::retry(3, 500, throw: false)->get($this->url);
            if ($response->status() === 200) {
                return true;
            }
        } else {
            return false;
        }
    }
}