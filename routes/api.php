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


    Route::group(['middleware' => 'auth:api'], function ($router) {
        //Logout
        Route::post('/logout', 'Auth\AuthController@logout');
        //Brand Management Routes
        Route::get('/brand/index', 'BrandController@index');
        Route::post('/brand/create', 'BrandController@store');
        Route::put('/brand/update/{id}', 'BrandController@update');
        Route::delete('/brand/delete/{id}', 'BrandController@destroy');

        //Brand Management Routes
        Route::get('/category/index', 'CategoryController@index');
        Route::post('/category/create', 'CategoryController@store');
        Route::put('/category/update/{id}', 'CategoryController@update');
        Route::delete('/category/delete/{id}', 'CategoryController@destroy');

        //Producy Management
        Route::post('/product/create', 'ProductController@store');
        Route::put('/product/update/{id}', 'ProductController@update');
        Route::delete('/product/delete/{id}', 'ProductController@destroy');
    });
