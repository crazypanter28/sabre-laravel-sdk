<?php

namespace SabreLaravel\Facades;

use Illuminate\Support\Facades\Facade;

class SabrePassenger extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'sabre.passenger';
    }
}
