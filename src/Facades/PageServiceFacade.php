<?php

namespace Cms\Facades;

use Illuminate\Support\Facades\Facade;

class PageServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'PageService';
    }
}
