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


Auth::routes();

Route::group(['middleware' => ['auth']], function () { 
    Route::get('/', function () {
        return view('layouts.master');
    });
    Route::post('/register_user', 'RegisterController@create');
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('/product', 'ProductController');
    Route::resource('/transaction', 'TransactionController');

    Route::get('/cart', 'CartController@cart')->name('cart.index');
    Route::get('/cart-html', 'CartController@renderCart')->name('cart.html');
    Route::post('/add', 'CartController@add')->name('cart.store');
    Route::post('/update', 'CartController@update')->name('cart.update');
    Route::post('/remove', 'CartController@remove')->name('cart.remove');
    Route::post('/clear', 'CartController@clear')->name('cart.clear');

    Route::get('/history', 'TransactionController@history');
    Route::resource('/category', 'CategoriesController');

    Route::resource('/users', 'UserController');

    Route::resource('/unit', 'UnitController');

    Route::get('/pengajuan', 'TransactionController@submission');
});
