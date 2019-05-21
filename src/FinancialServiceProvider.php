<?php

namespace Hosein\Financial;

use Illuminate\Support\ServiceProvider;

class FinancialServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/Views', 'FinancialView');
        $this->publishes([
            __DIR__.'/Views' => resource_path('views/vendor/FinancialView'),
        ],"financialview");
        $this->publishes([
            __DIR__.'/Migrations' => database_path('/migrations')
        ], 'financialmigrations');
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
    }
}
