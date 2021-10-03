<?php

namespace Cms\Features\Writelabel;

class Base
{

    public $name = 'Writelabel';
    public $code = 'writelabel';

    /**
     * 
     * @var array
     */
    protected $modelAdmins = [
        \Stalker\Models\Photo::class,
    ];

    public function getAdminMenu(): void
    {
        // Route::resource('writelabel', 'Admin\WritelabelController');
    }

    public function getSiteMenu(): void
    {
        $s = 'writelabel';
        Route::post('/writelabel', ['as' => $s . 'writelabel',   'uses' => 'WritelabelController@postTravel']);
    }
}
