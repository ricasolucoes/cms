<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

    Route::get('cms'.'/hero-images/delete/{entity}/{entity_id}', 'SitecFeatureController@deleteHero');
    /*
    |--------------------------------------------------------------------------
    | Common Features
    |--------------------------------------------------------------------------
    */

    Route::get('preview/{entity}/{entityId}', 'SitecFeatureController@preview');
    Route::get('rollback/{entity}/{entityId}', 'SitecFeatureController@rollback');
    Route::get('revert/{id}', 'SitecFeatureController@revert');


    /**
     * Blog
     */
    Route::group(['namespace' => 'Blog'], function () {

        /*
        |--------------------------------------------------------------------------
        | Blog
        |--------------------------------------------------------------------------
        */

        Route::resource('blog', 'BlogController', ['except' => ['show']]);
        Route::post('blog/search', 'BlogController@search');
        Route::get('blog/{id}/history', 'BlogController@history');

    });


    /**
     * Calendar
     */
    Route::group(['namespace' => 'Calendar'], function () {
        /*
        |--------------------------------------------------------------------------
        | Events
        |--------------------------------------------------------------------------
        */

        Route::resource('events', 'EventController', ['except' => ['show']]);
        Route::post('events/search', 'EventController@search');
        Route::get('events/{id}/history', 'EventController@history');

    });


    /**
     * Interaction
     */
    Route::group(['namespace' => 'Interaction'], function () {


        /*
        |--------------------------------------------------------------------------
        | Contacts
        |--------------------------------------------------------------------------
        */

        Route::resource('contacts', 'ContactController', ['except' => ['show']]);
        Route::post('contacts/search', 'ContactController@search');
        Route::get('contacts/{id}/history', 'ContactController@history');

        /*
        |--------------------------------------------------------------------------
        | Promotions
        |--------------------------------------------------------------------------
        */

        Route::resource('promotions', 'PromotionsController', ['except' => ['show']]);
        Route::post('promotions/search', 'PromotionsController@search');

    });


    /**
     * Production
     */
    Route::group(['namespace' => 'Production'], function () {

    });




    /**
     * Writelabel
     */
    Route::group(['namespace' => 'Writelabel'], function () {

        /*
        |--------------------------------------------------------------------------
        | Members
        |--------------------------------------------------------------------------
        */

        Route::resource('members', 'MemberController', ['only' => ['index', 'show']]);


        /*
        |--------------------------------------------------------------------------
        | Faqs
        |--------------------------------------------------------------------------
        */

        Route::resource('faqs', 'FaqController', ['except' => ['show']]);
        Route::post('faqs/search', 'FaqController@search');
        /*
        |--------------------------------------------------------------------------
        | Menus
        |--------------------------------------------------------------------------
        */

        Route::resource('menus', 'MenuController', ['except' => ['show']]);
        Route::post('menus/search', 'MenuController@search');
        Route::put('menus/{id}/order', 'MenuController@setOrder');

        /*
        |--------------------------------------------------------------------------
        | Pages
        |--------------------------------------------------------------------------
        */

        Route::resource('pages', 'PagesController', ['except' => ['show']]);
        Route::post('pages/search', 'PagesController@search');
        Route::get('pages/{id}/history', 'PagesController@history');

        /*
        |--------------------------------------------------------------------------
        | Links
        |--------------------------------------------------------------------------
        */

        Route::resource('links', 'LinksController', ['except' => ['index', 'show']]);
        Route::post('links/search', 'LinksController@search');
    });



    /*
    |--------------------------------------------------------------------------
    | Widgets
    |--------------------------------------------------------------------------
    */

    Route::resource('widgets', 'WidgetsController', ['except' => ['show']]);
    Route::post('widgets/search', 'WidgetsController@search');


    /*
    |--------------------------------------------------------------------------
    | Team Routes
    |--------------------------------------------------------------------------
    */

    Route::get('team/{name}', 'TeamController@showByName');
    Route::resource('teams', 'TeamController', ['except' => ['show']]);
    Route::post('teams/search', 'TeamController@search');
    Route::post('teams/{id}/invite', 'TeamController@inviteMember');
    Route::get('teams/{id}/remove/{userId}', 'TeamController@removeMember');





    // Route::resource('users', 'UserController');
    // Route::resource('girls', 'GirlController');
    // Route::resource('clients', 'ClientController');
    
