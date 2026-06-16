<?php

namespace SabreLaravel\Facades;

use Illuminate\Support\Facades\Facade;

class SabreAuth extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'sabre.auth';
    }
}
