<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Developer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return new \App\Developer();
    }
}
