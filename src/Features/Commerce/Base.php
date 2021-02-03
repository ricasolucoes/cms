<?php

namespace Cms\Features\Commerce;

class Base
{

    public $name = 'Commerce';
    public $code = 'commerce';

    /**
     * 
     * @var array
     */
    protected $modelAdmins = [
        
    ];

    public function getAdminMenu()
    {
        // Route::resource('Shopping', 'Admin\ShoppingController');
        // Route::resource('hotels', 'Admin\HotelsController');
        // Route::resource('rooms', 'Admin\RoomsController');
    }

    public function getSiteMenu()
    {
        $s = 'shopping';
        Route::post('/travel', ['as' => $s . 'travel',   'uses' => 'ShoppingController@postTravel']);
    }
}
