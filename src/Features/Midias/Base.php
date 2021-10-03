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

    public function getAdminMenu(): void
    {
        // Route::resource('photos', 'Admin\PhotosController');

    }

    public function getSiteMenu(): void
    {
        $s = 'photo';
        Route::post('/photo', ['as' => $s . 'photo',   'uses' => 'PhotosController@postTravel']);
        
    }
}
