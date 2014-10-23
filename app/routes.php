<?php

Route::get('/', function() {
    return View::make('splash');
});

Route::group(array('prefix' => 'generate'), function() {
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