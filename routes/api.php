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
Route::post('/public-user', 'PublicUserController@register');
Route::post('/public-user/activate', 'PublicUserController@activateUser');

Route::middleware('jwt.auth')->get('/public-user','PublicUserController@getUserDetails');

Route::middleware('jwt.auth')->put('/public-user','PublicUserController@updatePublicUser');
Route::middleware('jwt.auth')->post('/public-user/upload-profile','PublicUserController@uploadPhoto');

Route::middleware('jwt.auth')->get('/vendors', 'AddVendorController@showAll');
Route::middleware('jwt.auth')->get('/vendor/{id}', 'AddVendorController@showSingle');
Route::middleware('jwt.auth')->post('/booking', 'BookingController@bookSeat');