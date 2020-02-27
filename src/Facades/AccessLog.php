<?php

namespace AnnaNovas\AccessLog\Facades;

use Illuminate\Support\Facades\Facade;

class AccessLog extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'accesslog';
    }
}
