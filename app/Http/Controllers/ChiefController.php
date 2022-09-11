<?php

namespace App\Http\Controllers;

use App\Services\ChiefService;


class ChiefController extends Controller
{
    public function __invoke(ChiefService $chief)
    {
        $chief->start();
    }
}