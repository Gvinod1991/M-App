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

Route::get('/vendors', 'AddVendorController@showAll');
Route::get('/vendor/{id}', 'AddVendorController@showSingle');
Route::get('/city-list', 'AddVendorController@getCityList');
Route::get('/locallity-list/{city_name}', 'AddVendorController@getLocality');
Route::get('/price-range', 'BookingController@getPricerange');
Route::get('/public-user/getListShop/{city}/{locality}/{gender}/{min}/{max}', 'BookingController@getFilterList');
//Route::middleware('jwt.auth')->post('/booking', 'BookingController@bookSeat');

Route::post('/public-user/checkavailability', 'BookingController@getAvailibility');
Route::post('/public-user/booknow', 'BookingController@newBooking');
Route::get('/public-user/bookinglist/{id}', 'BookingController@showAllBooking');
Route::get('/public-user/singlebooking/{id}', 'BookingController@showSingleBooking');
Route::post('/public-user/cancelbooking', 'BookingController@cancelBooking');
Route::post('/public-user/mfsearch', 'BookingController@genderSearch');
Route::post('/public-user/bycitysearch', 'BookingController@citySearch');
Route::post('/public-user/bycity-localitysearch', 'BookingController@cityWithlocalitySearch');

