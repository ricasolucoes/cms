<?php

namespace Cms\Features\Productions;

class Base
{

    public $name = 'Productions';
    public $code = 'productions';

    /**
     * 
     * @var array
     */
    protected $modelAdmins = [
        \Cms\Models\Production::class,
    ];

    public function getAdminMenu()
    {
        // Route::resource('productions', 'Admin\ProductionsController');
    }

    public function getSiteMenu()
    {
        $s = 'production';
        Route::post('/production', ['as' => $s . 'production',   'uses' => 'ProductionsController@postProduction']);
    }
}
