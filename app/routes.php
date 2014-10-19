<?php

Route::get('/', function() {
	return View::make('splash');
});

Route::get('/base64/encode', function() {
	return View::make('tools.encoders.base64');
});
Route::post('/base64/encode', 'Base64Controller@encode');

Route::get('/base64/decode', function() {
	return View::make('tools.encoders.base64');
});
Route::post('/base64/decode', 'Base64Controller@decode');

Route::group(array('prefix' => 'generate'), function() {
    Route::get('/password', 'PasswordGeneratorController@generate');
	Route::get('/text', 'TextGeneratorController@generate');
	Route::get('/user', 'UserGeneratorController@generate');
});