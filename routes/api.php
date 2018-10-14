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
Route::middleware('jwt.auth')->get('/city-list', 'AddVendorController@getCityList');
Route::middleware('jwt.auth')->get('/locallity-list/{city_name}', 'AddVendorController@getLocality');
Route::middleware('jwt.auth')->get('/price-range', 'BookingController@getPricerange');
Route::middleware('jwt.auth')->get('/getListShop/{city}/{locality}/{gender}/{min}/{max}', 'BookingController@getFilterList');
//Route::middleware('jwt.auth')->post('/booking', 'BookingController@bookSeat');

Route::middleware('jwt.auth')->post('/public-user/checkavailability', 'BookingController@getAvailibility');
Route::middleware('jwt.auth')->post('/public-user/booknow', 'BookingController@newBooking');
Route::middleware('jwt.auth')->get('/public-user/bookinglist', 'BookingController@showAllBooking');
Route::middleware('jwt.auth')->get('/public-user/singlebooking/{id}', 'BookingController@showSingleBooking');
Route::middleware('jwt.auth')->post('/public-user/cancelbooking', 'BookingController@cancelBooking');
Route::middleware('jwt.auth')->post('/public-user/mfsearch', 'BookingController@genderSearch');
Route::middleware('jwt.auth')->post('/public-user/bycitysearch', 'BookingController@citySearch');
Route::middleware('jwt.auth')->post('/public-user/bycity-localitysearch', 'BookingController@cityWithlocalitySearch');

//Payment gateway

Route::middleware('jwt.auth')->post('/payu-hash', 'BookingController@makeHash');
Route::post('/payu-validate', 'BookingController@payuValidate');
