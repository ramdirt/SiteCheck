<?php

namespace App\Providers;

use Inertia\Inertia;
use App\Queries\QueryBuilder;
use App\Services\ChiefService;
use App\Services\ReportService;
use App\Services\Contract\Chief;
use App\Services\CheckURLService;
use App\Services\Contract\Report;
use App\Services\OverseerService;
use App\Queries\QueryBuilderSites;
use App\Services\AccessTestService;
use App\Services\Contract\CheckURL;
use App\Services\Contract\Overseer;
use App\Services\TelegramBotService;
use App\Services\UserBalanceService;
use App\Services\Contract\AccessTest;
use App\Services\Contract\TelegramBot;
use App\Services\Contract\UserBalance;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(QueryBuilder::class, QueryBuilderSites::class);
        $this->app->bind(Chief::class, ChiefService::class);
        $this->app->bind(Overseer::class, OverseerService::class);
        $this->app->bind(Report::class, ReportService::class);
        $this->app->bind(TelegramBot::class, TelegramBotService::class);
        $this->app->bind(UserBalance::class, UserBalanceService::class);
        $this->app->bind(AccessTest::class, AccessTestService::class);
        $this->app->bind(CheckURL::class, CheckURLService::class);
        Inertia::share('errors', function () {
            return session()->get('errors') ? session()->get('errors')->getBag('default')->getMessages() : (object) [];
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}