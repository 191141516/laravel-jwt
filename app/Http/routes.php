<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});

$api = app('api.router');

$api->version('v1', function($api){
//	$api->group(['namespace' => 'App\Http\Controllers'], function($api){
//		$api->post('authenticate', 'AuthenticateController@authenticate');
//		$api->get('authenticate', 'AuthenticateController@index');
//	});

	$api->group(['namespace' => 'App\Api\Controllers'], function($api){
		$api->post('login', 'AuthController@authenticate');
		$api->post('register', 'AuthController@register');

		// Dogs! All routes in here are protected and thus need a valid token
		//$api->group( [ 'protected' => true, 'middleware' => 'jwt.refresh' ], function ($api) {
		$api->group( [ 'middleware' => ['jwt.auth', 'jwt.refresh'] ], function ($api) {

			$api->get('users/me', 'AuthController@me');
			$api->get('validate_token', 'AuthController@validateToken');

			$api->get('dogs', 'DogsController@index');
			$api->post('dogs', 'DogsController@store');
			$api->get('dogs/{id}', 'DogsController@show');
			$api->delete('dogs/{id}', 'DogsController@destroy');
			$api->put('dogs/{id}', 'DogsController@update');

		});
	});
});
