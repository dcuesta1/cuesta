<?php

/*
 *  Unprotected Routes
 */
Route::post('/authenticate', 'AuthController@authenticate');


/*
 *  Protected Routes
 */

Route::group(['middleware' => ['auth.api']], function () {
    /*
     * USERS
     */

    // --Admin
    Route::middleware(['can:admin,user'])->group(function () {
        Route::get('/users/{user}', 'UserController@get');
        Route::put('/users/{user}', 'UserController@update');
    });

    // --Super
    Route::middleware(['can:super,App\User'])->group(function () {
        //Users
        Route::get('/users', 'UserController@all');
        Route::get('/users/role/{role}', 'UserController@getUsersByRole');
        Route::post('/users', 'UserController@store');
        Route::delete('/users/{user}', 'UserController@destroy');
    });

    /*
     *  SETTINGS
     */

    Route::get('/users/{user}/settings', 'SettingsController@get');
    Route::put('/users/{user}/settings', 'SettingsController@update');

    //--Admin
    Route::middleware(['can:admin,App\User'])->group(function () {
    });

    /*
     *  INVOICES
     */
    //--Admin
    Route::middleware(['can:admin,invoice'])->group(function () {
        Route::get('/invoices/{invoice}', 'InvoiceController@get');
        Route::put('/invoices/{invoice}', 'InvoiceController@update');
        Route::delete('/invoices/{invoice}', 'InvoiceController@destroy');
    });

    Route::get('/user/{username}/invoices', 'InvoiceController@userInvoices');
    Route::post('/invoices', 'InvoiceController@store');

    //--Super
    Route::middleware(['can:super,App\Invoice'])->group(function () {
        Route::get('/invoices', 'InvoiceController@all');
    });

    /*
     *  PAYMENTS
     */
    //--Admin
//    Route::middleware(['can:admin,invoice'])->group(function () {
//        Route::get('/invoices/{invoice}/payments', 'PaymentController@get');
//        Route::post('/invoices/{invoice}/payments', 'PaymentController@store');
//    });
    //--Super
//    Route::middleware(['can:super,App\Payment'])->group(function (){
//        Route::get('/invoices/payments', 'PaymentController@all');
//        Route::put('/invoices/{invoice}/payments', 'PaymentController@update');
//        Route::destroy('/invoices/{id}/payments', 'PaymentController@destroy');
//    });


    /*
     *  CUSTOMERS
     */
    //--Admin
    Route::middleware(['can:admin,App\Customer'])->group(function (){
        Route::get('/customers/{customer}', 'CustomerController@get');
        Route::put('customers/{customer}', 'CustomerController@update');
        Route::patch('/user/{username}/customers/delete', 'CustomerController@destroyMultiple');
    });
    Route::get('/user/{username}/customers', 'CustomerController@userCustomers');
    Route::post('/customers', 'CustomerController@store');

    //--Super
//    Route::get('/customers', 'CustomerController@all')->middleware('can:super,App\Customer');

    /*
     *  CARS
     */
    //-Admin
    Route::middleware(['can:admin,car'])->group(function () {
        Route::put('/cars/{car}', 'CarController@update');
        Route::delete('/cars/{car}','CarController@destroy');
    });
    Route::post('/cars', 'CarController@store');

    /*
     *  AUTO TELEMATICS
     */

    //Route::get('/auto/decode/{vin}', 'AutoTelematicController@decode')

});
