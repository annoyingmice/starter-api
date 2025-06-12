<?php

namespace Packages\Auth;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AuthServiceProvider extends ServiceProvider
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
        $this->mergeConfigFrom(__DIR__ . "/config/auth.php", "auth");

        // $this->publishes([
        //     __DIR__.'/config/auth.php' => config_path('p_auth.php'),
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
