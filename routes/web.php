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

Route::get('loai-san-pham/{id}', [
	'as'=>'loai-san-pham',
	'uses'=>'PageController@getProductType'
]);

Route::get('chi-tiet-san-pham/{id}', [
	'as'=>'chi-tiet-san-pham',
	'uses'=>'PageController@getDetailProduct'
]);

Route::get('add-to-cart/{id}',[
	'as'=>'gio-hang',
	'uses'=>'PageController@getAddToCart'
]);

Route::get('xoa-item-gio-hang/{id}',[
	'as'=>'del-item-cart',
	'uses'=>'PageController@getDelItemCart'
]);


Route::get('reduce-incre-by-one',[
	'as'=>'reduce-incre-by-one',
	'uses'=>'PageController@getReduceIncreByOne'
]);



Route::get('unset',function(){
	Session::forget('cart');
});

Route::get('dat-hang', [
	'as'=>'dat-hang',
	'uses'=>'PageController@getCart'
]);


Route::post('dat-hang',[
	'as'=>'dat-hang',
	'uses'=>'PageController@postCheckout'
]);



Route::get('login', [
	'as'=>'login',
	'uses'=>'PageController@getLogin'
]);

Route::get('register', [
	'as'=>'register',
	'uses'=>'PageController@getRegister'
]);


