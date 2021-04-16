<?php

namespace Chowjiawei\Helpers\Facade;

use \Illuminate\Support\Facades\Facade as LaravelFacade;

class Helper extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return 'Helper';
    }

    public static function allCountry() {
        return config('helpers.country');
    }
}
