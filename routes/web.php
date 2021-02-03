<?php

Route::group(
    ['middleware' => ['web']], function () {  
        // Route::group(['middleware' => ['cms-analytics']], function () {
        // Route::group(
        //     ['prefix' => 'cms'], function () {


        $loadingRoutes = [
            'public',
            'writelabel',
            'admin',
            'features',
            'recursos'
        ];
        foreach ($loadingRoutes as $loadingRoute) {
            include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . $loadingRoute.".php";
        }

                // include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . "wiki.php";
                // include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . "book.php";
            // }
        // );
    }
);