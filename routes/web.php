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

// get routes are publicly accessible
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('posts',  ['uses' => 'PostsController@show']);
    $router->get('comments', ['uses' => 'CommentsController@show']);
});

//post and delete routes are authenticated by fixed token sent in the Authorisation header
//post routes have an extra validation
$router->group(['prefix' => 'api', 'middleware' => ['validator:App\Models\Comment', 'authAppToken']], function () use ($router) {
    $router->post('comments', ['uses' => 'CommentsController@create']);
});

//post and delete routs are authenticated by fixed token sent in the Authorisation header
$router->group(['prefix' => 'api', 'middleware' => ['authAppToken']], function () use ($router) {
    $router->delete('posts/{id}', ['uses' => 'PostsController@delete']);
    $router->delete('comments/{id}', ['uses' => 'CommentsController@delete']);
});

