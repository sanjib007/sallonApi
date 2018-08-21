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

Route::post('registration', 'Api\v1\UserController@store');
Route::get('users/{user}/resend', 'Api\v1\UserController@resend');
Route::name('verify')->get('users/verify/{token}', 'Api\v1\UserController@verify');
Route::post('login', 'Api\v1\UserController@login');

$router->group(['middleware' => 'throttle:200,1'], function () use ($router) {
  // $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->group(['prefix' => 'api/v1'], function () use ($router) {
            $router->get('/test', 'Api\v1\PostController@index');
            $router->get('/test/{id}', 'Api\v1\PostController@show');
            $router->post('/test', 'Api\v1\PostController@store');


        });
  //  });

});






