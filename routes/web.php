<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
   // return view('login');
    // return view('layout/index');
//});
Route::get('/', 'Auth\LoginController@Login');
//Route::post('login', 'Auth\LoginController@Authenticate');
Route::post('login', [ 'as' => 'login', 'uses'=>'Auth\LoginController@Authenticate']);

Route::get('passSet', 'Auth\LoginController@update');
Route::group(['middleware' => 'web'], function()
{
Route::get('/index', function () {
    return view('layout/index');
});
});
//User Routes
/*Route::get('change_password', function () {
    return view('changePassword');
});*/
Route::group(['middleware' => 'web'], function()
{
Route::get('logout', [ 'as' => 'logout', 'uses'=>'Auth\LoginController@logout']);
Route::get('settings',[ 'as' => 'settings', 'uses'=>'Auth\LoginController@settings']);
Route::post('settings',[ 'as' => 'settings', 'uses'=>'Auth\LoginController@update_settings']);

Route::get('vendors', [ 'as' => 'vendors', 'uses'=>'AddVendorController@show']);
Route::get('newVendor', [ 'as' => 'newVendor', 'uses'=> 'AddVendorController@newVendor']);
Route::post('newVendor', [ 'as' => 'newVendor', 'uses'=>'AddVendorController@saveVendor']);
Route::get('editVendor/{id}',[
    'as' => 'editVendor',
    'uses' => 'AddVendorController@editVendor'
]);
Route::get('vendorProfile/{id}', 'AddVendorController@showVendorProfile');
Route::post('addServices', [ 'as' => 'addServices', 'uses'=> 'AddVendorController@addServiceToDb']);
Route::post('addTimeslot', [ 'as' => 'addTimeslot', 'uses'=> 'AddVendorController@addTimeslotToDb']);
Route::post('updateServices', [ 'as' => 'updateServices', 'uses'=> 'AddVendorController@updateServiceToDb']);
Route::post('changeStatus', [ 'as' => 'changeStatus', 'uses'=>'AddVendorController@changeSts']);
Route::post('updatebankdetails', [ 'as' => 'updatebankdetails', 'uses'=>'AddVendorController@updateBankdet']);
Route::post('changeweekStatus', [ 'as' => 'changeweekStatus', 'uses'=>'AddVendorController@changeWeeksts']);
Route::get('viewCallender/{id}', [ 'AddVendorController@changeWeeksts']);
Route::post('dayBlockchangeStatus', [ 'as' => 'dayBlockchangeStatus', 'uses'=>'DayBlockController@changeStsDayBlock']);
Route::post('serviceBlockchangeStatus', [ 'as' => 'serviceBlockchangeStatus', 'uses'=>'DayBlockController@changeStsServiceBlock']);
Route::post('timeBlockchangeStatus', [ 'as' => 'timeBlockchangeStatus', 'uses'=>'DayBlockController@changeStsTimeBlock']);
Route::post('seatBlockchangeStatus', [ 'as' => 'seatBlockchangeStatus', 'uses'=>'DayBlockController@seatBlock']);

Route::get('viewCallender/{id}', 'AddVendorController@showCallender');
Route::get('mybookings/{id}', 'BookingController@getBookingHistory');
Route::get('dailyBlockingStatus/{id}/{dt}', 'DayBlockController@showDailyEvents');

Route::post('changeprofilepic', [ 'as' => 'changeprofilepic', 'uses'=>'AddVendorController@uploadProfilePic']);
Route::get('customers',[ 'as' => 'customers','uses'=>'PublicUserController@customerList']);
Route::get('bookings',[ 'as' => 'bookings','uses'=>'BookingController@bookings']);
});
