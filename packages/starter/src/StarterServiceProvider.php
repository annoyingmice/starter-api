<?php

namespace Packages\Starter;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class StarterServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . "/resources/views", "starter");

        $this->mergeConfigFrom(__DIR__ . "/config/starter.php", "starter");

        // $this->publishes([
        //     __DIR__.'/config/starter.php' => config_path('packages_starter.php'),
        // ]);

        $this->publishesMigrations([
            __DIR__.'/database/migrations' => database_path('migrations'),
        ]);

        $this->loadRoutesWithApiMiddleware();
    }

    /**
    * Load package routes with the "api" middleware group.
    */
    protected function loadRoutesWithApiMiddleware(): void
    {
        Route::middleware("api")
            ->prefix("api")
            ->group(__DIR__ . "/routes/api.php");
    }
}
