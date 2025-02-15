<?php

namespace Packages\Otp;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Packages\Otp\App\Events\OtpRequested;
use Packages\Otp\App\Listeners\SendRequestedOtp;

class OtpServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . "/resources/views", "otp");

        $this->mergeConfigFrom(__DIR__ . "/config/otp.php", "otp");

        // $this->publishes(
        //     [
        //         __DIR__ . "/config/otp.php" => config_path("otp.php"),
        //     ],
        //     "otp"
        // );

        $this->publishesMigrations([
            __DIR__ . "/database/migrations" => database_path("migrations"),
        ]);

        $this->loadRoutesWithApiMiddleware();

        Event::listen(OtpRequested::class, SendRequestedOtp::class);
    }

    /**
     * Load package routes with the "api" middleware group.
     */
    protected function loadRoutesWithApiMiddleware(): void
    {
        Route::middleware("api")->group(__DIR__ . "/routes/api.php");
    }
}
