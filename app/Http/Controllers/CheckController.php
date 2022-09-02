<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class CheckController extends Controller
{
    public function __invoke($site)
    {
        $check_dns = checkdnsrr($site);

        if ($check_dns === true) {
            $response = Http::retry(3, 500, throw: false)->get($site);
            if ($response->status() === 200) {
                return 'true';
            }
        } else {
            return 'false';
        }

        return 'false';
    }
}