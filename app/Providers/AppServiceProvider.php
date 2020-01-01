<?php

namespace App\Providers;

use App\User;
use robrogers3\Laracastle\UserInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Laracastle should reference the App\User::class
        // when resolving the UserInterface::class
        $this->app->bind(UserInterface::class, function ($app) {
            dump('helel');
            return User::class;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $monolog = Log::getLogger();
        $syslog = new \Monolog\Handler\SyslogHandler('papertrail');
        $formatter = new \Monolog\Formatter\LineFormatter('%channel%.%level_name%: %message% %extra%');
        $syslog->setFormatter($formatter);
        $monolog->pushHandler($syslog);
    }
}
