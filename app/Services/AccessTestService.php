<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class AccessTestService
{
    private object $site;

    public function setSite(object $site): object
    {
        $this->site = $site;

        return $this;
    }

    public function start()
    {
        $check_dns = checkdnsrr($this->site->url);

        if ($check_dns === true) {
            $response = Http::retry(3, 500, throw: false)->get($this->site->url);
            if ($response->status() === 200) {
                $this->site->status = true;
            }
        } else {
            $this->site->status = false;
        }

        $this->site->update();
    }
}