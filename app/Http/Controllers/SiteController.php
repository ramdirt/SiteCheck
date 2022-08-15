<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use VxeController\Http\Controller\VxeController;

class SiteController extends VxeController
{
    public function model(): string
    {
        return Site::class;
    }
}
