<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	return view('spark::welcome');
});

// Require authentication
Route::group(['middleware' => 'auth'], function () {

	// Reminders Section
	Route::group(['prefix' => 'reminder'], function() {

		// Create
		Route::get('create', 'ReminderController@create');
		Route::post('create', 'ReminderController@store');

		// List all
		Route::get('/', 'ReminderController@index');

		// Update
		Route::get('edit/{id}', 'ReminderController@edit');
		Route::patch('edit/{id}', 'ReminderController@update');

		// Delete
		Route::delete('delete/{id}', 'ReminderController@destroy');

	});
});