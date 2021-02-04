<?php
// @todo
Route::group(
    ['middleware' => 'auth'], function () {
        Route::group(
            ['as' => 'sitec.'], function () {
                Route::group(
                    ['namespace' => 'Pages'], function () {
                        Route::get('/sitec/dash', 'DashController@index')->name('dash');

                        Route::get('/sitec/profile', 'ProfileController@index')->name('profile');

                    }
                );
            }
        );

    }
);