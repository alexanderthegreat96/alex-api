<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Facade;

class ExchangeFacade extends Facade
{

    /**
     * @return string
     */

    protected static function getFacadeAccessor()
    {
        return 'exchange';
    }
}
