<?php

namespace Packages\Auth;

use Illuminate\Support\ServiceProvider;

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

        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
    }
}
