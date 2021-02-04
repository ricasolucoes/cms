<?php

/*
|--------------------------------------------------------------------------
| Features Routes
|--------------------------------------------------------------------------
*/
Route::resource('features', 'FeatureController', [
    'except' => [
        'show',
    ],
    'as' => 'admin',
]);
Route::post('features/search', 'FeatureController@search');

