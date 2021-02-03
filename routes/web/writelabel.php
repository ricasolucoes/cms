<?php



// @todo
// Route::get('midia-preview/{encFileName}', 'MidiaController@asPreview');
// Route::get('midia-full/{encFileName}', 'MidiaController@asFull');
// Route::get('midia-download/{encFileName}/{encRealFileName}', 'MidiaController@asDownload');

/*
|--------------------------------------------------------------------------
| Basic WriteLabels Pages
|--------------------------------------------------------------------------
*/
Route::get('{module}/rss', 'RssController@index');
Route::get('site-map', 'SiteMapController@index');


/**
 * Writelabel @todo
 */
Route::group(['namespace' => 'Writelabel', 'as' => 'writelabel.'], function () {
    Route::get('/', 'PagesController@home');
    Route::get('home', 'PagesController@home');
    Route::get('pages', 'PagesController@all');
    Route::get('page/{url}', 'PagesController@show');
    Route::get('p/{url}', 'PagesController@show');

    Route::get('faqs', 'FaqController@all');
});
