<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\OverseerController;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/overseer', OverseerController::class)->middleware(['auth', 'verified'])->name('overseer');

Route::resource('/settings', SettingController::class)->middleware(['auth', 'verified']);
Route::resource('/plans', PlanController::class)->middleware(['auth', 'verified']);
Route::resource('/sites', SiteController::class)->middleware(['auth', 'verified']);


require __DIR__ . '/auth.php';