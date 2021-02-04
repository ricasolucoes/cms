<?php
    Route::group(['namespace' => 'Calendar', 'as' => 'calendar.'], function () {
        Route::get('events', 'EventsController@calendar');
        Route::get('events/{month}', 'EventsController@calendar');
        Route::get('events/all', 'EventsController@all');
        Route::get('events/date/{date}', 'EventsController@date');
        Route::get('events/event/{id}', 'EventsController@show');
});