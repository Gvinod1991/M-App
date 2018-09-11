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
Route::get('logout', [ 'as' => 'logout', 'uses'=>'Auth\LoginController@getLogout']);
Route::get('passSet', 'Auth\LoginController@update');
Route::group(['middleware' => 'web'], function()
{
Route::get('index', function () {
    return view('layout/index');
});
});
Route::get('viewVendor', [ 'as' => 'viewVendor', 'uses'=>'AddVendorController@show']);
Route::post('addVendor', [ 'as' => 'addVendor', 'uses'=>'AddVendorController@createNewVendor']);
Route::get('addVendorForm', [ 'as' => 'addVendorForm', 'uses'=> 'AddVendorController@showVendorFomr']);
Route::get('vendorProfile/{id}', 'AddVendorController@showVendorProfile');
Route::post('addServices', [ 'as' => 'addServices', 'uses'=> 'AddVendorController@addServiceToDb']);
Route::post('addTimeslot', [ 'as' => 'addTimeslot', 'uses'=> 'AddVendorController@addTimeslotToDb']);
Route::post('updateServices', [ 'as' => 'updateServices', 'uses'=> 'AddVendorController@updateServiceToDb']);
Route::post('changeStatus', [ 'as' => 'changeStatus', 'uses'=>'AddVendorController@changeSts']);
Route::post('updatebankdetails', [ 'as' => 'updatebankdetails', 'uses'=>'AddVendorController@updateBankdet']);
Route::post('changeweekStatus', [ 'as' => 'changeweekStatus', 'uses'=>'AddVendorController@changeWeeksts']);

///Routes to implemented
Route::get('profile', [ 'as' => 'profile', 'uses'=>'AddVendorController@show']);
Route::get('customerList', [ 'as' => 'customerList', 'uses'=>'AddVendorController@show']);
Route::get('bookings', [ 'as' => 'bookings', 'uses'=>'AddVendorController@show']);
Route::get('pending-bookings', [ 'as' => 'pending-bookings', 'uses'=>'AddVendorController@show']);