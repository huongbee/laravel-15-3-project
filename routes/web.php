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

Route::get('/', [
	'as'=>'trangchu',
	'uses'=>'PageController@getIndex'
]);

Route::get('loai-san-pham', [
	'as'=>'loai-san-pham',
	'uses'=>'PageController@getProductType'
]);

Route::get('chi-tiet-san-pham', [
	'as'=>'chi-tiet-san-pham',
	'uses'=>'PageController@getDetailProduct'
]);

Route::get('gio-hang', [
	'as'=>'gio-hang',
	'uses'=>'PageController@getCart'
]);


Route::get('login', [
	'as'=>'login',
	'uses'=>'PageController@getLogin'
]);

Route::get('register', [
	'as'=>'register',
	'uses'=>'PageController@getRegister'
]);


