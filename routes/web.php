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


Route::controller(\App\Http\Controllers\SiteController::class)->group(function () {
    /**
     * Get all sites or specific site
     * @param $request[] - for all sites,
     * @param $request[ 'site_id' = id ] - for specific site
     */
    Route::get('/sites', 'index');
    /**
     * Save page
     * @param $request[
     *   'page' = model
     * ]
     */
    Route::post('/site/update', 'update');
    /**
     * Delete page
     * @param $request[
     *  'id' = $modelId
     * ]
     */
    Route::delete('/site/delete');
});

Route::controller(\App\Http\Controllers\PageController::class)->group(function () {
    /**
     * Get all pages
     */
    Route::get('/pages/{site_id}', 'index');
    /**
     * Save page
     * @param $request[
     *   'page' = model
     * ]
     */
    Route::post('/page/update', 'update');
    /**
     * Delete page
     * @param $request[
     *  'id' = $modelId
     * ]
     */
    Route::delete('/page/delete');
});

Route::controller(\App\Http\Controllers\CheckController::class)->group(function () {
    /**
     * Get all checks for specific page
     */
    Route::get('/pages/{site_id}', 'index');
    /**
     * Save page
     * @param $request[
     *   'page' = model
     * ]
     */
    Route::post('/page/update', 'update');
    /**
     * Delete page
     * @param $request[
     *  'id' = $modelId
     * ]
     */
    Route::delete('/page/delete');
});

require __DIR__ . '/auth.php';
