<?php

namespace SabreLaravel;

use Illuminate\Support\ServiceProvider;
use SabreLaravel\Auth\SabreAuthService;
use SabreLaravel\Passengers\PassengerService;

class SabreServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/sabre.php', 'sabre');

        $this->app->singleton(SabreClient::class, fn() => new SabreClient());

        $this->app->singleton('sabre.auth', function ($app) {
            return new SabreAuthService($app->make(SabreClient::class));
        });

        $this->app->singleton('sabre.passenger', function ($app) {
            return new PassengerService(
                $app->make(SabreClient::class),
                $app->make('sabre.auth')
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/sabre.php' => config_path('sabre.php'),
            ], 'sabre-config');
        }
    }
}
