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

Route::get('/application/pdf/{id}', 'VehicleController@clearance_pdf');

Route::post('/account/store', 'AccountController@store');

    Route::group(['middleware' => 'auth:api'], function ($router) {
        //Logout
        Route::post('/logout', 'Auth\AuthController@logout');

        //Mobile
        Route::get('/mobile/index', 'MobileController@index');
        Route::get('/mobile/scan/vehicle/{code}', 'MobileController@scanVehicle');
        Route::get('/mobile/scan/application/{code}', 'MobileController@scanOnlineApplication');

        //Online
        Route::get('/vehicle/owned', 'VehicleController@getVehicles');
        Route::post('/vehicle/store/online', 'VehicleController@storeOnline');
        Route::post('/vehicle/store/clearance/{vehicle_id}/{user_id}', 'VehicleController@storeClearance');

        //Appointment
        Route::get('/appointment/index', 'AppointmentController@getAppointments');
        Route::put('/vehicle/step2/done/{clearance_id}/{vehicle_id}', 'VehicleController@paymentDone');
        Route::put('/vehicle/inspection/hpg/done/{clearance_id}/{vehicle_id}', 'VehicleController@physicalInspectionHPG');
    });
