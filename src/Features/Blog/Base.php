<?php

namespace Cms\Features\Blog;

class Base
{

    public $name = 'Blog';
    public $code = 'blog';

    /**
     * 
     * @var array
     */
    protected $modelAdmins = [
        \Cms\Models\Blog\Blog::class,
    ];
    

    public function getAdminMenu()
    {
        return function () {
            Route::resource('/posts', 'PostController');
            Route::put('/posts/{post}/publish', 'PostController@publish')->middleware('admin');
            Route::resource('/categories', 'CategoryController', ['except' => ['show']]);
            Route::resource('/tags', 'TagController', ['except' => ['show']]);
            Route::resource('/comments', 'CommentController', ['only' => ['index', 'destroy']]);
            Route::resource('/users', 'UserController', ['middleware' => 'admin', 'only' => ['index', 'destroy']]);
        };
    }

    public function getSiteMenu()
    {
        return function () {
            Route::get('/', 'BlogController@index');
            Route::get('/posts/{post}', 'BlogController@post');
            Route::post('/posts/{post}/comment', 'BlogController@comment')->middleware('auth');

            Auth::routes();

            Route::get('/home', 'HomeController@index');
        };
    }

    public function apis()
    {
        return function () {
            Route::post('/auth/token', 'Api\AuthController@getAccessToken');
            Route::post('/auth/reset-password', 'Api\AuthController@passwordResetRequest');
            Route::post('/auth/change-password', 'Api\AuthController@changePassword');

            Route::group(
                ['middleware' => 'auth:api', 'namespace' => 'Api'], function () {
                    Route::get('/tags', 'ListingController@tags');
                    Route::get('/categories', 'ListingController@categories');
                    Route::get('/users', 'ListingController@users')->middleware('admin');

                    Route::resource('/posts', 'PostController', ['only' => ['index', 'show']]);
                }
            );
        };
    }
}
