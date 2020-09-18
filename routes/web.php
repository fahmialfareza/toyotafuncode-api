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

Route::get('foods', 'AdminController@foods')->name('foods');
Route::get('components', 'AdminController@components')->name('components');
Route::get('reminders', 'AdminController@reminders')->name('reminders');
Route::get('reminders/{id}', 'AdminController@reminders_user')->name('reminders.user');
Route::get('bookings', 'AdminController@bookings')->name('bookings');
Route::get('bookings/{id}/{userId}', 'AdminController@booking_id')->name('booking.id');
Route::get('engineers', 'AdminController@engineers')->name('engineers');
