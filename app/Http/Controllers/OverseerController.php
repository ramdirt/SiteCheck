<?php

namespace App\Http\Controllers;

use App\Services\Overseer;
use Illuminate\Http\Request;

class OverseerController extends Controller
{
    public function __invoke()
    {
        $overseer = new Overseer();

        return $overseer->run();
    }
}
