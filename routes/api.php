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
Route::get('/public-user/all-list', 'AddVendorController@showAll');
Route::get('/public-user/shop/{id}', 'AddVendorController@showSingle');
Route::post('/public-user/checkavailability', 'BookingController@getAvailibility');
Route::post('/public-user/booknow', 'BookingController@newBooking');
Route::get('/public-user/bookinglist/{id}', 'BookingController@showAllBooking');
Route::get('/public-user/singlebooking/{id}', 'BookingController@showSingleBooking');
Route::post('/public-user/cancelbooking', 'BookingController@cancelBooking');
Route::post('/public-user/mfsearch', 'BookingController@genderSearch');
Route::post('/public-user/bycitysearch', 'BookingController@citySearch');
Route::post('/public-user/bycity-localitysearch', 'BookingController@cityWithlocalitySearch');
Route::get('/public-user/getpricerange', 'BookingController@getPricerange');