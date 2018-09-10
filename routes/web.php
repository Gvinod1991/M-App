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
Route::get('logout', 'Auth\LoginController@getLogout');
Route::get('passSet', 'Auth\LoginController@update');
Route::group(['middleware' => 'web'], function()
{
Route::get('index', function () {
    return view('layout/index');
});
});

Route::get('viewVendor', 'AddVendorController@show');
Route::post('addVendor', 'AddVendorController@createNewVendor');
Route::get('addVendorForm', 'AddVendorController@showVendorFomr');
Route::get('vendorProfile/{id}', 'AddVendorController@showVendorProfile');
Route::post('addServices', 'AddVendorController@addServiceToDb');
Route::post('addTimeslot', 'AddVendorController@addTimeslotToDb');
Route::post('updateServices', 'AddVendorController@updateServiceToDb');
Route::post('changeStatus', 'AddVendorController@changeSts');
Route::post('updatebankdetails', 'AddVendorController@updateBank');