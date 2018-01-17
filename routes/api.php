<?php

/*
 *  Unprotected Routes
 */
Route::post('/authenticate', 'AuthController@authenticate');
/*
 *  Protected Routes
 */
Route::group(['middleware' => ['auth.api']], function () {
    //Users
	Route::put('/users/{id}', 'UserController@update');
	Route::get('/users/{id}', 'UserController@show');
	//Invoices
    Route::get('/invoices/{id}', 'InvoiceController@show');
    Route::get('/user/{username}/invoices', 'InvoiceController@userInvoices');
    Route::post('/invoices', 'InvoiceController@create');
    Route::put('/invoices/{id}', 'InvoiceController@update');
    Route::delete('/invoices/{id}', 'InvoiceController@destroy');

    //Payments
    Route::get('/invoices/{id}/payments', 'PaymentController@show');
    Route::post('/invoices/{id}/payments', 'PaymentController@create');

    //Customers
    Route::get('/customers/{id}', 'CustomerController@show');
    Route::get('/user/{username}/customers', 'CustomerController@userCustomers');
    Route::post('/customers', 'CustomerController@create');
    Route::put('customers/{id}', 'CustomerController@update');
    Route::patch('/user/{username}/customers/delete', 'CustomerController@destroyMultiple');

    //Cars
    Route::post('/cars', 'CarController@create');
    Route::put('/cars/{id}', 'CarController@update');
    Route::delete('/cars/{id}','CarController@destroy');

    //AutoTelematics
    Route::get('/auto/decode/{vin}', 'AutoTelematicController@decode');

    Route::group(['middleware' => 'auth.superuser'], function() {

	    //Users
	    Route::get('/users', 'UserController@index');
		Route::get('/users/role/{id}', 'UserController@getUsersByRole');
		Route::post('/users', 'UserController@create');
		Route::delete('/users/{id}', 'UserController@destroy');

		//Invoices
		Route::get('/invoices', 'InvoiceController@index');

		//Payments
        Route::get('/invoices/payments', 'PaymentController@index');
        Route::put('/invoices/{id}/payments', 'PaymentController@update');
//       Route::destroy('/invoices/{id}/payments', 'PaymentController@destroy');

        //Customers
        Route::get('/customers', 'CustomerController@index');
	});
});
