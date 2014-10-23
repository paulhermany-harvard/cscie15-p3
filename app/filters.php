<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
    //
});


App::after(function($request, $response)
{
    //
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
    if (Auth::guest())
    {
        if (Request::ajax())
        {
            return Response::make('Unauthorized', 401);
        }
        else
        {
            return Redirect::guest('login');
        }
    }
});


Route::filter('auth.basic', function()
{
    return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
    if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
    if (Session::token() != Input::get('_token'))
    {
        throw new Illuminate\Session\TokenMismatchException;
    }
});

/**
 * Text Pluralization Filter
 * 
 * The text pluralization filter handles the pluralization (or singularization) of routes
 * to the text generator controller. This allows requests to be grammatically correct.
 *
 * Examples:
 *   Route                                  Redirect
 *   /generate/1/lorem-ipsum/paragraphs     /generate/1/lorem-ipsum/paragraph
 *   /generate/2/lorem-ipsum/paragraph      /generate/2/lorem-ipsum/paragraphs
**/
Route::filter('TextPluralization', function($route, $request) {
   
    // get route parameters
    $textQty = $route->getParameter('textQty');
    $textType = $route->getParameter('textType');
    
    // set key-value pairs of plural forms of each type
    $pluralize = array(
        'paragraph' => 's',
        'sentence' => 's',
        'word' => 's'
    );

    // create an array of patterns that use positive lookahead for the plural form of each type
    $patterns = [];
    foreach ($pluralize as $key => $value)
        array_push($patterns, "$key(?=($value)?)");
    
    // combine individual patterns into a single regex
    $pattern = '/'.implode('|', $patterns).'/';

    // extract the singular form of the type and rebuild the plural form
    preg_match($pattern, $textType, $matches);
    $singularTextType = $matches[0];
    $pluralTextType = $singularTextType.$pluralize[$singularTextType];
    
    if($textQty == 1) {
        // redirect plural to singular
        if($textType != $singularTextType) {
            return Redirect::to("/generate/$textQty/lorem-ipsum/$singularTextType");
        }
    } else {
        // redirect singular to plural
        if($textType != $pluralTextType) {
            return Redirect::to("/generate/$textQty/lorem-ipsum/$pluralTextType");
        }
    }
});

/**
 * User Pluralization Filter
 * 
 * The user pluralization filter handles the pluralization (or singularization) of routes
 * to the user generator controller. This allows requests to be grammatically correct.
 *
 * Examples:
 *   Route                          Redirect
 *   /generate/1/users              /generate/1/user/profile
 *   /generate/1/user               /generate/1/user/profile
 *   /generate/1/user/profiles      /generate/1/user/profile
 *   /generate/2/user               /generate/2/user/profiles
 *   /generate/2/user               /generate/2/user/profiles
 *   /generate/2/user/profiles      /generate/2/user/profiles 
**/
Route::filter('UserPluralization', function($route, $request) {
   
    // get route parameters
    $userQty = $route->getParameter('userQty');
    $userProperty = $route->getParameter('userProperty');
    
    // if the user property is not defined, redirect using profile
    if($userProperty == null) {
        return Redirect::to("generate/$userQty/user/profile");
    };

    // set key-value pairs of plural forms of each property
    $pluralize = array(
        'profile' => 's',
        'name' => 's',
        'email-address' => 'es',
        'phone-number' => 's',
        'photo' => 's'
    );
    
    // create an array of patterns that use positive lookahead for the plural form of each property
    $patterns = [];
    foreach ($pluralize as $key => $value)
        array_push($patterns, "$key(?=($value)?)");
    
    // combine individual patterns into a single regex
    $pattern = '/'.implode('|', $patterns).'/';
    
    // extract the singular form of the user property and rebuild the plural form
    preg_match($pattern, $userProperty, $matches);
    $singularUserProperty = $matches[0];
    $pluralUserProperty = $singularUserProperty.$pluralize[$singularUserProperty];
    
    if($userQty == 1) {
        // redirect plural to singular
        if($userProperty != $singularUserProperty) {
            return Redirect::to("/generate/$userQty/user/$singularUserProperty");
        }
    } else {
        // redirect singular to plural
        if($userProperty != $pluralUserProperty) {
            return Redirect::to("/generate/$userQty/user/$pluralUserProperty");
        }
    }
});

