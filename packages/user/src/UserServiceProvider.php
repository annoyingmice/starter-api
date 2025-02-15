<?php

namespace Packages\User;

use Packages\User\App\Events\Registered;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Packages\User\App\Listeners\SendEmailVerificationNotification;

class UserServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . "/resources/views", "user");

        $this->mergeConfigFrom(__DIR__ . "/config/user.php", "user");

        // $this->publishes([
        //     __DIR__ . "/config/user.php" => config_path("user.php"),
        // ]);

        $this->publishesMigrations([
            __DIR__ . "/database/migrations" => database_path("migrations"),
        ]);

        $this->loadRoutesWithApiMiddleware();

        Event::listen(
            Registered::class,
            SendEmailVerificationNotification::class
        );
    }

    /**
     * Load package routes with the "api" middleware group.
     */
    protected function loadRoutesWithApiMiddleware(): void
    {
        Route::middleware("api")->group(__DIR__ . "/routes/api.php");
    }
}
