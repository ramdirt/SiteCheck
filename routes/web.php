<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\OverseerController;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/overseer', OverseerController::class)->name('overseer');
Route::get('/check_site/{site}', CheckController::class)->name('check_site');

Route::resource('/setting', SettingController::class)->middleware(['auth', 'verified']);
Route::resource('/plans', PlansController::class)->middleware(['auth', 'verified']);
Route::resource('/sites', SiteController::class)->middleware(['auth', 'verified']);


require __DIR__ . '/auth.php';