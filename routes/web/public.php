<?php



// @todo
// Route::get('midia-preview/{encFileName}', 'MidiaController@asPreview');
// Route::get('midia-full/{encFileName}', 'MidiaController@asFull');
// Route::get('midia-download/{encFileName}/{encRealFileName}', 'MidiaController@asDownload');


/*
|--------------------------------------------------------------------------
| Features Routes
|--------------------------------------------------------------------------
*/

Route::group(['namespace' => 'Features'/*, 'as' => 'public.'*/], function () {



    /**
     * Blog
     */
    Route::group(['namespace' => 'Blog', 'as' => 'blog.'], function () {
        include dirname(__FILE__) . DIRECTORY_SEPARATOR . "public". DIRECTORY_SEPARATOR . "calendar.php";
    });

    /**
     * Calendar
     */
    Route::group(['namespace' => 'Calendar', 'as' => 'calendar.'], function () {
        include dirname(__FILE__) . DIRECTORY_SEPARATOR . "public". DIRECTORY_SEPARATOR . "calendar.php";
    });

    /**
     * Commerce
     */
    Route::group(['namespace' => 'Commerce', 'as' => 'commerce.'], function () {
        include dirname(__FILE__) . DIRECTORY_SEPARATOR . "public". DIRECTORY_SEPARATOR . "commerce.php";
    });
});
