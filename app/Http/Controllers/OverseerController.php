<?php

namespace App\Http\Controllers;

use App\Services\OverseerService;

class OverseerController extends Controller
{
    public function __invoke(OverseerService $overseer)
    {
        return $overseer->run();
    }
}