<?php

namespace Cms\Facades;

use Illuminate\Support\Facades\Facade;

class SitecServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'SitecService';
    }
}
