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

Route::get('/', 'PagesController@index')->name('index');
Route::get('/search/bus', 'SearchController@search')->name('search.bus');
Route::get('/search/car', 'SearchController@carSearch')->name('search.car');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/orders', 'SeatsController@index')->name('order');
Route::post('/orders', 'SeatsController@order')->name('order');
//stores booking session
Route::post('/session', 'SeatsController@bookingSession')->name('booking.session');

Route::prefix('booking')->group(function(){
    Route::get('/', 'BookingController@index')->name('booking.index');
    Route::get('/create', 'BookingController@create')->name('booking.create');
    Route::delete('/{id}', 'BookingController@destroy')->name('booking.delete');
});

Route::prefix('checkout')->group(function(){
    Route::get('/', 'CheckoutController@index')->name('checkout.index');
    Route::get('/export-pdf/{id}', 'CheckoutController@export')->name('booking.export');
    Route::post('/card', 'CheckoutController@stripe_order')->name('checkout.stripe');
    
});

Route::group(['prefix' => 'admin',  'middleware' => 'is_admin'], function(){
    Route::get('/scheduler', 'SchedulerController@create')->name('admin.scheduler.create');
    Route::put('/scheduler', 'SchedulerController@update')->name('admin.scheduler.update');
});
Route::get('car/{id}', 'CarController@show')->name('car.show')->middleware('booking');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

