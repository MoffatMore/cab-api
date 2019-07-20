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

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/login','API\AuthController@postLogin');
Route::post('/register','API\AuthController@postRegister');
Route::post('/cab/register','API\AuthController@cabRegister');
Route::post('/logout','API\AuthController@postLogout');
Route::post('/getCabs','API\CabController@getCabs');
Route::post('/requestCab','API\BookingController@requestCab');
Route::post('/checkBooking','API\BookingController@checkBooking');

//Todo
Route::post('/userRquests','API\BookingController@getUserRequests');
Route::post('/getPlateNumber','API\BookingController@getPlateNumber');
Route::post('/updateMyLocation','API\BookingController@updateMyLocation');


