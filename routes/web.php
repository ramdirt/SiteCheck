<?php

use App\Models\User;
use Inertia\Inertia;
use App\Mail\ReportShipped;
use App\Services\ReportService;
use App\Services\AccessTestService;
use App\Services\TelegramBotService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\SettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('SitesLayout');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/setting', SettingController::class)->middleware(['auth', 'verified']);
Route::resource('/plans', PlansController::class)->middleware(['auth', 'verified']);


Route::vxeController(\App\Http\Controllers\SiteController::class);

require __DIR__ . '/auth.php';