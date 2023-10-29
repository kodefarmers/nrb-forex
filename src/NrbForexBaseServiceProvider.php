<?php

namespace KodeFarmers\NrbForex;

use Illuminate\Support\ServiceProvider;

class NrbForexBaseServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
    }

    public function register(): void
    {
        $this->app->bind('NrbForex', function ($app) {
            return new NrbForex();
        });
    }
}
