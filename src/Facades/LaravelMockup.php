<?php

namespace Nihilsen\LaravelMockup\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Nihilsen\LaravelMockup\LaravelMockup
 */
class LaravelMockup extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Nihilsen\LaravelMockup\LaravelMockup::class;
    }
}
