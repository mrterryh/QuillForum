<?php

$router->post('validate-register-form', 'AuthController@postValidateRegisterForm');

$router->group(['prefix' => 'threads'], function() use ($router) {
    // Retrieving threads and posts.
    $router->get('recent', 'ThreadController@getRecent');
    $router->get('posts/{threadId}', 'ThreadController@getPosts');

    // Replying to threads.
    $router->post('/reply', 'ThreadController@postReply');
});

$router->group(['prefix' => 'posts'], function() use ($router) {
    // Deleting, editing, and reporting posts.
    $router->post('/delete', 'PostController@postDelete');
    $router->post('/edit', 'PostController@postEdit');
});