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


Route::get('register', [
	'as'=>'register',
	'uses'=>'PageController@getRegister'
]);

Route::post('register',[
	'as' =>'register',
	'uses'=>'PageController@postRegister'
]);

Route::get('active/{id}-{email}',[
	'as'=>'active_account',
	'uses'=>'PageController@getActiveAccount'
]);



Route::get('login', [
	'as'=>'login',
	'uses'=>'PageController@getLogin'
]);

Route::post('login', [
	'as'=>'login',
	'uses'=>'PageController@postLogin'
]);


Route::get('logout', [
	'as'=>'logout',
	'uses'=>'PageController@getLogout'
]);


Route::get('search',[
	'as'=>'search',
	'uses'=>'PageController@getSearch'
]);



Route::get('login/{provider}', [
	'as'=>'provider_login',
	'uses'=>'PageController@redirectToProvider'
]);


Route::get('login/{provider}/callback', [
	'as'=>'provider_login_callback',
	'uses'=>'PageController@handleProviderCallback'
]);

Route::group(['prefix'=>'administrator'], function(){
	Route::get('/',[
		'as'=>'admin.trangchu',
		'uses'=>'AdminController@getIndex'
	]);
	Route::get('/add-product',[
		'as'=>'admin.add_product',
		'uses'=>'AdminController@getAddProduct'
	]);

	Route::post('/add-product',[
		'as'=>'admin.add_product',
		'uses'=>'AdminController@postAddProduct'
	]);

	Route::get('/edit-product/{id}',[
		'as'=>'admin.edit_product',
		'uses'=>'AdminController@getEditProduct'
	]);

	Route::post('/edit-product/{id}',[
		'as'=>'admin.edit_product',
		'uses'=>'AdminController@postEditProduct'
	]);


	Route::get('/delete-product/{id}',[
		'as'=>'admin.delete_product',
		'uses'=>'AdminController@getDeleteProduct'
	]);
});


Route::get('import',[
	'as'=>'import',
	'uses'=>'PageController@getImportExcel'
]);

Route::post('import',[
	'as'=>'import',
	'uses'=>'PageController@postImportExcel'
]);


Route::post('export',[
	'as'=>'export',
	'uses'=>'PageController@postExportExcel'
]);