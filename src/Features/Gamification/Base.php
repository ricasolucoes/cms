<?php

namespace Cms\Features\Gamification;

class Base
{

    public $name = 'Gamification';
    public $code = 'gamification';

    /**
     * 
     * @var array
     */
    protected $modelAdmins = [
        \Cms\Models\Point::class,
    ];

    public function getAdminMenu()
    {
        // Route::resource('gamification', 'Admin\GamificationController');
        
    }

    public function getSiteMenu()
    {
        $s = 'gamification';
        Route::post('/gamification', ['as' => $s . 'gamification',   'uses' => 'GamificationController@postTravel']);
        
    }
}
