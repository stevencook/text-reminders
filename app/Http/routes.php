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

	// Test Twilio route
	Route::get('twilio', function() {

		$account_sid = env('TWILIO_ACCOUNT_SID', ''); // Your Twilio account sid
		$auth_token = env('TWILIO_AUTH_TOKEN', ''); // Your Twilio auth token

		$client = new Services_Twilio($account_sid, $auth_token);
		$message = $client->account->messages->sendMessage(
		  env('TWILIO_PHONE_NUMBER', ''), // From a Twilio number in your account
		  env('TEST_RECEIVE_PHONE_NUMBER', ''), // Text any number
		  "Test message sent from Twilio!"
		);

		echo 'Sent from ' . env('TWILIO_PHONE_NUMBER', '') . '<br/>';
		print $message->sid;

	});
});