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

Route::post('login', 'Auth\AuthController@login')->name('login');

Route::post('/register', 'AccountController@store');

    Route::group(['middleware' => 'auth:api'], function ($router) {
        //Logout
        Route::post('/logout', 'Auth\AuthController@logout');

        //Event Module
        Route::post('/event', 'EventController@store');
    });
