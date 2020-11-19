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
	Route::resource('/costs', 'CostController');
	Route::resource('/customers', 'CustomerController');
	Route::resource('/suppliers', 'SupplierController');
	Route::resource('/categories', 'CategoryController');
	Route::resource('/units', 'UnitController');
	Route::resource('/products', 'ProductController');
	Route::resource('/purchases', 'PurchaseController');
	Route::resource('/purchase-payments', 'PurchasePaymentController');
	Route::resource('/sales', 'SaleController');
	Route::resource('/sale-payments', 'SalePaymentController');

	/** cart route start **/
	Route::post('/cart', 'CartController@cart')->name('add.cart');
	Route::post('/cart-subtotal', 'CartController@subtotal')->name('cart.subtotal');
	/** cart route end **/

	Route::get('/stocks', 'StockController@index')->name('product.stock');

	/** purchase return route start **/
	Route::get('/purchase-returns', 'PurchaseReturnController@index');
	Route::post('/purchase-returns/store', 'PurchaseReturnController@store')->name('purchase-returns.store');
	Route::get('/purchase-returns/{id}', 'PurchaseReturnController@return')->name('purchase-returns');
	Route::delete('/purchase-returns/{id}', 'PurchaseReturnController@destroy')->name('purchase-returns-destroy');
	/** purchase return route end **/
	
	/** sale return route start **/
	Route::get('/sale-returns', 'SaleReturnController@index');
	Route::post('/sale-returns/store', 'SaleReturnController@store')->name('sale-returns.store');
	Route::get('/sale-returns/{id}', 'SaleReturnController@return')->name('sale-returns');
	Route::delete('/sale-returns/{id}', 'SaleReturnController@destroy')->name('sale-returns-destroy');
	/** sale return route end **/

	/** report route start **/

	Route::get('/purchase-reports', 'ReportController@purchase')->name('purchase.report');
	Route::get('/purchase-payment-reports', 'ReportController@purchase_payment')->name('purchase.payment.report');
	Route::get('/sale-reports', 'ReportController@sale')->name('sale.report');
	Route::get('/sale-payment-reports', 'ReportController@sale_payment')->name('sale.payment.report');

	/** report route end **/


});
