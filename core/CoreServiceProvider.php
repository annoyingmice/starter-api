<?php

namespace Core;

use Core\App\Users\Listeners\SendEmailVerificationNotification;
use Core\App\Users\Listeners\SendOtpNotification;
use Core\Domain\Users\Events\OtpGenerated;
use Core\Domain\Users\Events\UserRegistered;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class CoreServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(__DIR__ . '/Infrastructure/Database/Migrations');

        if (file_exists($api = __DIR__ . '/Web/api.php')) {
            Route::middleware('api')
                ->prefix('api')
                ->group($api);
        }

        if (file_exists($web = __DIR__ . '/Web/web.php')) {
            Route::middleware('web')->group($web);
        }

        if ($this->app->runningInConsole() && file_exists($console = __DIR__ . '/Web/console.php')) require $console;
        if (file_exists($channels = __DIR__ . '/Web/channel.php')) require $channels;

        $this->registerViewNamespaces();
        $this->registerEvents();
    }

    protected function registerViewNamespaces(): void
    {
        $webPath = __DIR__ . '/Web';

        if (!is_dir($webPath)) return;

        $modules = glob("$webPath/*", GLOB_ONLYDIR);

        foreach ($modules as $modulePath) {
            $viewPath = $modulePath . '/Views';

            if (is_dir($viewPath)) {
                $namespace = Str::singular(strtolower(basename($modulePath)));
                $this->loadViewsFrom($viewPath, $namespace);
            }
        }
    }

    protected function registerEvents(): void
    {
        Event::listen(UserRegistered::class, SendEmailVerificationNotification::class);
        Event::listen(OtpGenerated::class, SendOtpNotification::class);
    }
}
