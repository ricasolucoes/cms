<?php

namespace Cms\Features\Midias;

class Base
{

    public $name = 'Midias';
    public $code = 'midias';

    /**
     * 
     * @var array
     */
    protected $modelAdmins = [
        \Stalker\Models\Photo::class,
    ];

    public function getAdminMenu()
    {
        // Route::resource('photos', 'Admin\PhotosController');

    }

    public function getSiteMenu()
    {
        $s = 'photo';
        Route::post('/photo', ['as' => $s . 'photo',   'uses' => 'PhotosController@postTravel']);
        
    }
}
