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
            $router->get('users/{id}/resend', 'Api\v1\UserController@resend');

            $router->get('users/verify/{token}', [
                'as' => 'verify', 'uses' => 'Api\v1\UserController@verify'
            ]);
            $router->post('login', 'Api\v1\AuthenticationController@login');
            $router->post('registration', 'Api\v1\AuthenticationController@registration');


            $router->group(['middleware' => 'auth'], function () use ($router) {
                $router->post('add', 'Api\v1\PostController@store');
                $router->post('logout', 'Api\v1\AuthenticationController@logout');
            });

        });
  //  });

});






