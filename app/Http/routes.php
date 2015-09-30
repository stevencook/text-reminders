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

// Home page
Route::get('/', function () {
	if (Auth::check()) {
		return redirect()->action('ReminderController@index');
	} else {
		return view('spark::welcome');
	}
});


// Authenticated user routes
Route::group(['middleware' => 'auth'], function () {

	// Redirect home to reminder
	Route::get('home', function() {
		return redirect()->action('ReminderController@index');
	});

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
