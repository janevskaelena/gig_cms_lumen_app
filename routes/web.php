<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api', 'middleware' => 'validator:App\Models\Post'], function () use ($router) {
    $router->get('posts',  ['uses' => 'PostsController@show']);
    $router->delete('posts/{id}', ['uses' => 'PostsController@delete']);
});

$router->group(['prefix' => 'api', 'middleware' => 'validator:App\Models\Comment'], function () use ($router) {
    $router->get('comments', ['uses' => 'CommentsController@show']);
    $router->post('comments', ['uses' => 'CommentsController@create']);
    $router->delete('comments/{id}', ['uses' => 'CommentsController@delete']);
});
