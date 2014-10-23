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
    Route::post('/password', 'PasswordGeneratorController@generate');
    
    Route::pattern('textQty', '[0-9]+');
    Route::pattern('textSource', 'lorem(-ipsum)?');
    Route::pattern('textType', 'paragraphs?|sentences?|words?');
    
    // redirect /lorem-ipsum to the default route
    Route::get('/lorem-ipsum', function() {
        return Redirect::to("/generate/2/lorem-ipsum/paragraph");
    });
    
    // set route using text pluralization filter
    Route::get('/{textQty}/{textSource}/{textType}', 
        array(
            'before' => 'TextPluralization',
            'uses' => 'TextGeneratorController@generate'
        )
    );

    // set post route using text pluralization filter
    Route::post('/{textQty}/{textSource}/{textType}', 
        array(
            'before' => 'TextPluralization',
            'uses' => 'TextGeneratorController@generate'
        )
    );
 
    Route::pattern('userQty', '[0-9]+');
    Route::pattern('userType', 'users?');
    Route::pattern('userProperty', 'profiles?|names?|email-address(es)?|phone-numbers?|photos?');

    // redirect /user and /users to their default quantities
    Route::get('/{userType}', function($userType) {
        $userQty = substr($userType, -1) == 's' ? 10 : 1;
        return Redirect::to("/generate/$userQty/$userType");
    });

    // set route using user pluralization filter
    Route::get('/{userQty}/{userType}/{userProperty?}', 
        array(
            'before' => 'UserPluralization',
            'uses' => 'UserGeneratorController@generate'
        )
    );

    // set post route using user pluralization filter
    Route::post('/{userQty}/{userType}/{userProperty?}', 
        array(
            'before' => 'UserPluralization',
            'uses' => 'UserGeneratorController@generate'
        )
    );
});