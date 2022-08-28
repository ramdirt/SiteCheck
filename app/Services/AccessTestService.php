<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class AccessTestService
{
    protected object $site;

    public function setSite(object $site)
    {
        $this->site = $site;

        return $this;
    }

    public function run()
    {
        $check_dns = checkdnsrr($this->site->url);
        $carbon = new Carbon();

        if ($check_dns === true) {
            $response = Http::retry(3, 500, throw: false)->get($this->site->url);
            if ($response->status() === 200) {
                $this->site->status = true;
            }
        } else {
            $this->site->status = false;
        }

        $this->site->last_check = $carbon->now();
        $this->site->update();

        return true;
    }
}