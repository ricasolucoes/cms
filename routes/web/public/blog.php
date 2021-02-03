<?php

Route::get('blog', 'BlogController@all');
Route::get('blog/{url}', 'BlogController@show');
Route::get('blog/tags/{tag}', 'BlogController@tag');