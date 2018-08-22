<?php

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




$router->group(['middleware' => 'throttle:200,1'], function () use ($router) {

  // $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->group(['prefix' => 'api/v1'], function () use ($router) {
            $router->get('/test', 'Api\v1\PostController@index');
            $router->get('/test/{id}', 'Api\v1\PostController@show');
            $router->post('/test', 'Api\v1\PostController@store');
            $router->post('registration', 'Api\v1\UserController@store');
            $router->get('users/{user}/resend', 'Api\v1\UserController@resend');
            $router->get('users/verify/{token}', [
                'as' => 'verify', 'uses' => 'Api\v1\UserController@verify'
            ]);

            $router->post('login', 'Api\v1\UserController@login');

            //category route
            $router->get('category', 'Api\v1\CategoryController@index');
            $router->post('category', 'Api\v1\CategoryController@store');
            $router->get('category/{id}', 'Api\v1\CategoryController@show');
            $router->post('category/{id}', 'Api\v1\CategoryController@update');
            $router->delete('category/{id}', 'Api\v1\CategoryController@destroy');


            //Post route
            $router->get('post', 'Api\v1\PostController@index');
            $router->post('post', 'Api\v1\PostController@store');
            $router->get('post/{id}', 'Api\v1\PostController@show');
            $router->post('post/{id}', 'Api\v1\PostController@update');
            $router->delete('post/{id}', 'Api\v1\PostController@destroy');

        });
  //  });

});






