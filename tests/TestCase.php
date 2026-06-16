<?php

namespace SabreLaravel\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use SabreLaravel\SabreServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            SabreServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('sabre.client_id', 'test_client_id');
        $app['config']->set('sabre.client_secret', 'test_secret');
        $app['config']->set('sabre.environment', 'test');
    }
}
