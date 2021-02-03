<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function () {
    // Credit Card Controller
    // Route::post('/cards/register',				'CreditCardController@register');
    // Route::post('/cards/edit',				    'CreditCardController@edit');
    // Route::post('/cards/delete',				'CreditCardController@delete');
    // Route::post('/cards/user',				    'CreditCardController@user');
    // Route::post('/cards/validation',		    'CreditCardController@validation');
    // Route::post('/cards/validate-token',		'CreditCardController@validateToken');
    // Route::post('/cards/valid',				    'CreditCardController@valid');

    // // Customer Controller
    // Route::post('/users/register',				'CustomerController@register');
    // Route::post('/users/user-token',			'CustomerController@userToken');

    // // Order Controller
    // Route::post('/orders/register',				'OrderController@register');
    // Route::post('/orders/find',				    'OrderController@find');
});
