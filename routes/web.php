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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', 'AdminController@index')->name('dashboard');
    Route::get('/dashboard', 'AdminController@index')->name('dashboard');

    Route::get('register', 'Auth\Admin\RegisterController@create')->name('register');
    Route::post('register', 'Auth\Admin\RegisterController@store')->name('register.store');

    Route::get('login', 'Auth\Admin\LoginController@login')->name('auth.login');
    Route::post('login', 'Auth\Admin\LoginController@loginAdmin')->name('auth.loginAdmin');
    Route::get('logout', 'Auth\Admin\LoginController@logout')->name('auth.logout');

    Route::get('profile', 'Admin\AdminManagerController@show')->name('profile');
    Route::get('profile/edit', 'Admin\AdminManagerController@edit')->name('profile.edit');
    Route::post('profile/update', 'Admin\AdminManagerController@update')->name('profile.update');

    Route::get('country', 'Admin\CountryController@index')->name('country');
    Route::get('province', 'Admin\ProvinceController@index')->name('province');

    Route::get('hotel/', 'Admin\HotelController@index')->name('hotel');
    Route::get('hotel/list_provinces', 'Admin\HotelController@getProvinces')->name('hotel.list_provinces');
    Route::get('hotel/list_hotels', 'Admin\HotelController@getHotelInProvince')->name('hotel.list_hotels');
    Route::get('hotel/search', 'Admin\HotelController@search')->name('hotel.search');
    Route::get('hotel/create', 'Admin\HotelController@create')->name('hotel.create');
    Route::get('hotel/edit/{id}', 'Admin\HotelController@edit')->where('id', '[0-9]+')->name('hotel.edit');
    Route::get('hotel/upload', 'Admin\HotelController@upload');
    Route::get('hotel/export', 'Admin\HotelController@export')->name('hotel.export');;

    Route::post('hotel', 'Admin\HotelController@store')->name('hotel.store');
    Route::post('hotel/{id}', 'Admin\HotelController@update')->where('id', '[0-9]+')->name('hotel.update');
    Route::post('hotel/delete/{id}', 'Admin\HotelController@destroy')->where('id', '[0-9]+')->name('hotel.destroy');
    Route::post('hotel/import', 'Admin\HotelController@import')->name('hotel.import');

    Route::get('room/type', 'Admin\RoomTypeController@index')->name('room.type');
});
