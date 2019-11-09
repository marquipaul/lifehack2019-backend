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

        //Accounts / Users
        Route::get('/accounts', 'AccountController@accounts');

        //User Location
        Route::post('/location', 'UserLocationController@store');

        //Blood Request 
        Route::get('/all-requests', 'BloodRequestController@index');
        Route::get('/my-requests', 'BloodRequestController@myRequests');
        Route::get('/my-donations', 'BloodRequestController@myDonations');
        Route::post('/request', 'BloodRequestController@requestBlood');
        Route::put('/request/donor-approve/{id}', 'BloodRequestController@approveByDonor');
        Route::put('/request/requestor-approve/{id}', 'BloodRequestController@approveByRequestor');
        Route::put('/request/finish-request/{id}', 'BloodRequestController@finishRequest');

        //Hospital
        Route::get('/hospital', 'HospitalController@index');
        Route::post('/hospital', 'HospitalController@store');

        //Event Module
        Route::get('/event', 'EventController@index');
        Route::get('/event/donors/{id}', 'EventController@getDonors');
        Route::post('/event', 'EventController@store');
        Route::post('/approve', 'EventController@approveDonor');

        //Donor Routes
        Route::post('/join', 'DonorController@join');
        Route::post('/leave', 'DonorController@leave');

        //
    });
