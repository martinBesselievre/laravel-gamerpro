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

Route::get('/', 'HomeController@index')->name('home');


Route::get('/admin', 'ProductController@create')->name('product.create')->middleware('auth')->middleware('admin');
Route::get('/products/{id}', 'ProductController@show')->name('product.show')->middleware('auth')->middleware('admin');
Route::post('/products', 'ProductController@store')->name('product.store')->middleware('auth')->middleware('admin');
Route::get('/products/{id}/edit', 'ProductController@edit')->name('product.edit')->middleware('auth')->middleware('admin');
Route::patch('/products/{id}', 'ProductController@update')->name('product.update')->middleware('auth')->middleware('admin');

Route::get('admin/users', 'ProductController@users')->name('admin.users')->middleware('auth')->middleware('admin');
Route::get('admin/orders', 'ProductController@orders')->name('admin.orders')->middleware('auth')->middleware('admin');
/* Authenticated users routes -----------------------------------------------*/
Route::get('/catalog', 'ProductController@index')->name('catalog.index')->middleware('auth');
Route::get('/cart', 'CartController@show')->name('cart.show')->middleware('auth');;
Route::post('/cart/items', 'CartController@store')->name('cart.item.add')->middleware('auth');
Route::delete('/cart/items/{id}', 'CartController@delete')->name('cart.item.delete')->middleware('auth');
Route::post('/cart/pay', 'CartController@pay')->name('cart.pay')->middleware('auth');

/* Authentication  routes -----------------------------------------------*/
Auth::routes();

