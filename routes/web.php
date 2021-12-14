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
Route::get('/coupons/create', 'CouponController@create');

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/coupons', 'CouponController@index');
    Route::get('/coupons/{coupon}', 'CouponController@show');
    Route::get('/user/{user}/details', 'UserController@showDetails');

});

Route::middleware(['auth', 'isAdmin'])->group(function () {

    Route::post('/coupons/store', 'CouponController@store');
    Route::post('/coupons/{coupon}/delete', 'CouponController@delete');
    Route::get('/coupons/{coupon}/edit', 'CouponController@edit');
    Route::post('/coupons/{coupon}/update', 'CouponController@update');
});


