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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Admin route

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function(){

	Route::resource('/users', 'UserController');
	Route::resource('/customers', 'CustomerController');
	Route::resource('/suppliers', 'SupplierController');
	Route::resource('/categories', 'CategoryController');
	Route::resource('/units', 'UnitController');
	Route::resource('/products', 'ProductController');
	Route::resource('/purchases', 'PurchaseController');
	Route::resource('/purchase-payments', 'PurchasePaymentController');
	Route::resource('/sales', 'SaleController');
	Route::resource('/sale-payments', 'SalePaymentController');
	Route::post('/cart', 'CartController@cart')->name('add.cart');
	Route::post('/cart-subtotal', 'CartController@subtotal')->name('cart.subtotal');

});
