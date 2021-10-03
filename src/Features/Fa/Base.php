<?php

namespace Cms\Features\Fa;

class Base
{

    public $name = 'Fa';
    public $code = 'fa';

    /**
     * 
     * @var array
     */
    protected $modelAdmins = [
        \Cms\Models\Fa::class,
    ];

    public function getAdminMenu(): void
    {
        // Route::resource('fa', 'Admin\FaController');
        
    }

    public function getSiteMenu(): void
    {
        Route::post('/fa', ['as' => $s . 'fa',   'uses' => 'FaController@postTravel']);
        
    }
}
