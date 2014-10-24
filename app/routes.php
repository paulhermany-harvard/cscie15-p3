<?php

Route::get('/', function() {
    return View::make('splash');
});

// set the route pattern for the text encoder
Route::pattern('encoding', 'base64|html|url');

// redirect /text-encoder to the default view of the text encoder
Route::get('text-encoder', function() {
    return View::make('text-encoder');
});

// set get/post route for encoding
Route::get('{encoding}/encode', 'TextEncoderController@encode');
Route::post('{encoding}/encode', 'TextEncoderController@encode');

// set get/post route for decoding
Route::get('{encoding}/decode', 'TextEncoderController@decode'); 
Route::post('{encoding}/decode', 'TextEncoderController@decode'); 

Route::group(array('prefix' => 'generate'), function() {
    // set the route patterns for the text generator
    Route::pattern('textQty', '[0-9]+');
    Route::pattern('textSource', 'lorem(-ipsum)?');
    Route::pattern('textType', 'paragraphs?|sentences?|words?');
    
    // redirect /lorem-ipsum to the default route
    Route::get('/lorem-ipsum', function() {
        return Redirect::to("/generate/3/lorem-ipsum/paragraphs");
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
 
    // set the route patterns for the user generator
    Route::pattern('userQty', '[0-9]+');
    Route::pattern('userType', 'users?');
    Route::pattern('userProperty', 'profiles?|names?|email-address(es)?|phone-numbers?|photos?');

    // redirect /user and /users to their default routes
    Route::get('/{userType}', function($userType) {
        $userQty = substr($userType, -1) == 's' ? 3 : 1;
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