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

Route::get('home', ['middleware' => 'auth', function () {
	return view('home');
}]);

Route::get('testmail', function() {

	// the message
	$msg = "First line of text\nSecond line of text";

	// use wordwrap() if lines are longer than 70 characters
	$msg = wordwrap($msg,70);

	// send email
	$result = mail("steven@voltagead.com","Testing local mail",$msg);

	echo "mail sent\n";
	print_r($result);

});