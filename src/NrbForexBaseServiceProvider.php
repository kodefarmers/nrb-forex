<?php

namespace KodeFarmers\NrbForex;

use Illuminate\Support\ServiceProvider;

class NrbForexBaseServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/nrbforex.php' => config_path('nrbforex.php'),
        ], 'nrbforex');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/nrbforex.php',
            'nrbforex'
        );

        $this->app->bind('NrbForex', function ($app) {
            return new NrbForex();
        });
    }
}
