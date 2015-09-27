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

Route::group(['middleware' => 'auth'], function () {

	// List
	Route::get('home', 'ReminderController@index');

	// Create
	Route::get('reminder/create', 'ReminderController@create');

});