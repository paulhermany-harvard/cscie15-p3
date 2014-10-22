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
	#Route::get('/text', 'TextGeneratorController@generate');
	
	Route::pattern('textQty', '[0-9]+');
	Route::pattern('textSource', 'lorem(-ipsum)?');
	Route::pattern('textType', 'p(aragraphs?)?|s(entences?)?|w(ords?)?');
	Route::get('/{textQty}/{textSource}/{textType}', 'TextGeneratorController@generate');
	Route::post('/{textQty}/{textSource}/{textType}', 'TextGeneratorController@generate');
	
	Route::pattern('userQty', '[0-9]+');
	Route::pattern('userProperty', 'profiles?|names?|email-address(es)?|phone-numbers?');
	Route::get('/{userQty}/user/{userProperty}', 'UserGeneratorController@generate');
	Route::post('/{userQty}/user/{userProperty}', 'UserGeneratorController@generate');
});