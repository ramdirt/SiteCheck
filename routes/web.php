<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\OverseerController;


Route::get('/', function () {
    return Inertia::render('TheWelcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/overseer', OverseerController::class)->name('overseer');
    Route::resource('/settings', SettingController::class);
    Route::resource('/balance', BalanceController::class);
    Route::resource('/sites', SiteController::class);
});


require __DIR__ . '/auth.php';