<?php

namespace App\Http\Controllers;

use App\Models\Page;
use VxeController\Http\Controller\VxeController;

class PageController extends VxeController
{
    public function model(): string
    {
        return Page::class;
    }
}
