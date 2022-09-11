<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ChiefController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\SettingController;


Route::get('/', function () {
    return Inertia::render('TheWelcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/chief', ChiefController::class)->name('chief');
    Route::resource('/settings', SettingController::class);
    Route::resource('/balance', BalanceController::class);
    Route::resource('/sites', SiteController::class);
});

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('backup:clean');
    return "Кэш очищен.";
});


require __DIR__ . '/auth.php';