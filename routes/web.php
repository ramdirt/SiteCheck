<?php

use Inertia\Inertia;
use App\Mail\ReportShipped;
use App\Services\ReportService;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

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

Route::get('/push_mail', function () {
    $report = new ReportService();
    $report->sendMail('ramrimi@yandex.ru', new ReportShipped);
    return "push mail";
});


Route::vxeController(\App\Http\Controllers\SiteController::class);

require __DIR__ . '/auth.php';
