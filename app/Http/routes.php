<?php

// Home route
$router->get('/', 'ThreadListController@getRecent')->name('home');

// Guest authentication (logging in, registering, etc.)
$router->group(['middleware' => 'guest', 'as' => 'auth::'], function() use ($router) {
    $router->get('login', 'AuthController@getLogin')->name('login');
    $router->post('login', 'AuthController@postLogin');

    $router->get('register', 'AuthController@getRegister')->name('register');
    $router->post('register', 'AuthController@postRegister');
});

// Authenticated user routes (account area, etc.)
$router->get('logout', 'AuthController@getLogout')->name('auth::logout');

// Thread-related routes
$router->group(['as' => 'thread::', 'prefix' => 'thread'], function() use ($router) {
    $router->get('{threadId}-{threadSlug?}', 'ThreadController@getThread');
});