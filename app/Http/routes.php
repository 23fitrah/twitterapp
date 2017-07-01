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

Route::get('/', 'TwitterController@index');

Route::get('/tweet_list', 'TwitterController@tweet_list');

Route::get('/favorite_list', 'TwitterController@favorite_list');

Route::get('/retweet_list', 'TwitterController@retweet_list');

Route::get('tweet_detail/{idx}', 'TwitterController@tweet_detail');

Route::get('home', 'HomeController@index');

Route::post('/post_tweet','TwitterController@post_tweet');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
