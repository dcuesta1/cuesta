<?php

/*
 *  Unprotected Routes
 */
Route::post('/authenticate', 'AuthController@authenticate');


/*
 *  Protected Routes
 */
Route::group(['middleware' => ['auth.api']], function () {

	Route::put('/users/{id}', 'UserController@update');
	Route::get('/users/{id}', 'UserController@show');

	Route::group(['middleware' => 'auth.superuser'], function() {
		Route::get('/users', 'UserController@index');
		Route::get('/users/role/{id}', 'UserController@getUsersByRole');
		Route::post('/users', 'UserController@create');
		Route::delete('/users/{id}', 'UserController@destroy');
	});
});
