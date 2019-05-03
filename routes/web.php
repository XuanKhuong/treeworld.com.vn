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

Route::get('/', 'WebSaleController@index')->name('web-sale.index');
Route::get('/web-detail/{slug}', 'WebSaleController@detail');
Route::get('/add-to-cart/{id}/{name}', 'WebSaleController@addToCart');
Route::get('/reduction/{id}', 'WebSaleController@reduceNumber');
Route::get('/cart/', 'WebSaleController@Cart')->name('cart.Cart');
Route::get('get-info-user', 'WebSaleController@getInfo');
Route::post('/check-out/', 'WebSaleController@checkOut')->name('check-out.checkOut');
Route::get('/delete-cart/', 'WebSaleController@deleteCart')->name('delete-cart.delete-cart');
Auth::routes();//admin login

// Route::get('/login', 'LoginController@getLogin')->name('login.getLogin');

Route::middleware('auth')->group(function() {

	Route::get('/upload-img/{id}', 'ProductDetailController@getImages');

	Route::post('upload-img/store', 'ProductDetailController@postImages');


	Route::get('/products','ProductController@index')->name('products.index');
	Route::post('/products', 'ProductController@store')->name('products.store');
	Route::get('/products/create', 'ProductController@create')->name('products.create');
	Route::get('/products/{id}/edit', 'ProductController@edit')->name('products.edit');
	Route::post('/products/{id}', 'ProductController@update')->name('products.update');
	Route::get('/getproducts','ProductController@getproducts')->name('products.getproducts');
	Route::get('/products/{id}', 'ProductController@show')->name('products.show');
	Route::delete('/products/{id}', 'ProductController@destroy')->name('products.destroy');


	Route::post('/detail-products', 'ProductDetailController@store')->name('detail-products.store');
	Route::get('/detail-products/create', 'ProductDetailController@create')->name('detail-products.create');
	Route::get('/detail-products/{id}/edit', 'ProductDetailController@edit')->name('detail-products.edit');
	Route::post('/detail-products/{id}', 'ProductDetailController@update')->name('detail-products.update');
	Route::get('/getdetailproducts/{id}','ProductDetailController@getdetailproducts')->name('getdetailproducts.getdetailproducts');


	//test
	Route::get('/getdetailproducts/{id}','ProductDetailController@getdetailproducts');

	Route::get('/detail-products/{id}', 'ProductDetailController@show')->name('detail-products.show');
	Route::delete('/detail-products/{id}', 'ProductDetailController@destroy')->name('detail-products.destroy');

	Route::get('/accessories','AccessoryController@index')->name('accessories.index');
	Route::post('/accessories', 'AccessoryController@store')->name('accessories.store');
	Route::get('/accessories/create', 'AccessoryController@create')->name('accessories.create');
	Route::get('/accessories/{id}/edit', 'AccessoryController@edit')->name('accessories.edit');
	Route::post('/accessories/{id}', 'AccessoryController@update')->name('accessories.update');
	Route::get('/getaccessories','AccessoryController@getaccessories')->name('accessories.getaccessories');
	Route::get('/accessories/{id}', 'AccessoryController@show')->name('accessories.show');
	Route::delete('/accessories/{id}', 'AccessoryController@destroy')->name('accessories.destroy');

	Route::get('/addresses','AddressController@index')->name('addresses.index');
	Route::post('/addresses', 'AddressController@store')->name('addresses.store');
	Route::get('/addresses/create', 'AddressController@create')->name('addresses.create');
	Route::get('/addresses/{id}/edit', 'AddressController@edit')->name('addresses.edit');
	Route::post('/addresses/{id}', 'AddressController@update')->name('addresses.update');
	Route::get('/getaddresses','AddressController@getaddresses')->name('getaddresses.getaddresses');
	Route::get('/addresses/{id}', 'AddressController@show')->name('addresses.show');
	Route::delete('/addresses/{id}', 'AddressController@destroy')->name('addresses.destroy');

	Route::get('/categories','CategoryController@index')->name('categories.index');
	Route::post('/categories', 'CategoryController@store')->name('categories.store');
	Route::get('/categories/create', 'CategoryController@create')->name('categories.create');
	Route::get('/categories/{id}/edit', 'CategoryController@edit')->name('categories.edit');
	Route::post('/categories/{id}', 'CategoryController@update')->name('categories.update');
	Route::get('/getcategories','CategoryController@getcategories')->name('getcategories.getcategories');
	Route::get('/categories/{id}', 'CategoryController@show')->name('categories.show');
	Route::delete('/categories/{id}', 'CategoryController@destroy')->name('categories.destroy');

	Route::get('/colors','ColorController@index')->name('colors.index');
	Route::post('/colors', 'ColorController@store')->name('colors.store');
	Route::get('/colors/create', 'ColorController@create')->name('colors.create');
	Route::get('/colors/{id}/edit', 'ColorController@edit')->name('colors.edit');
	Route::post('/colors/{id}', 'ColorController@update')->name('colors.update');
	Route::get('/getcolors','ColorController@getcolors')->name('getcolors.getcolors');
	Route::get('/colors/{id}', 'ColorController@show')->name('colors.show');
	Route::delete('/colors/{id}', 'ColorController@destroy')->name('colors.destroy');

	Route::get('/customers','CustomerController@index')->name('customers.index');
	Route::post('/customers', 'CustomerController@store')->name('customers.store');
	Route::get('/customers/create', 'CustomerController@create')->name('customers.create');
	Route::get('/customers/{id}/edit', 'CustomerController@edit')->name('customers.edit');
	Route::post('/customers/{id}', 'CustomerController@update')->name('customers.update');
	Route::get('/getcustomers','CustomerController@getcustomers')->name('getcustomers.getcustomers');
	Route::get('/customers/{id}', 'CustomerController@show')->name('customers.show');
	Route::delete('/customers/{id}', 'CustomerController@destroy')->name('customers.destroy');

	Route::get('/employees','EmployeeController@index')->name('employees.index');
	Route::post('/employees', 'EmployeeController@store')->name('employees.store');
	Route::get('/employees/create', 'EmployeeController@create')->name('employees.create');
	Route::get('/employees/{id}/edit', 'EmployeeController@edit')->name('employees.edit');
	Route::post('/employees/{id}', 'EmployeeController@update')->name('employees.update');
	Route::get('/getemployees','EmployeeController@getemployees')->name('getemployees.getemployees');
	Route::get('/employees/{id}', 'EmployeeController@show')->name('employees.show');
	Route::delete('/employees/{id}', 'EmployeeController@destroy')->name('employees.destroy');

	Route::get('/orders','OrderController@index')->name('orders.index');
	Route::post('/orders', 'OrderController@store')->name('orders.store');
	Route::get('/orders/create', 'OrderController@create')->name('orders.create');
	Route::get('/orders/{id}/edit', 'OrderController@edit')->name('orders.edit');
	Route::post('/orders/{id}', 'OrderController@update')->name('orders.update');
	Route::get('/getorders','OrderController@getorders')->name('getorders.getorders');
	Route::get('/orders/{id}', 'OrderController@show')->name('orders.show');
	Route::delete('/orders/{id}', 'OrderController@destroy')->name('orders.destroy');

});
