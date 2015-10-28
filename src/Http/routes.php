<?php

//Authenticate
Route::group(['namespace'  => '\MVsoft\Webdefault\Http\Controllers'], function(){

	Route::get(Config::get('webdefault.link').'/auth/login', 'Auth\AuthController@getLogin');
	Route::post(Config::get('webdefault.link').'/auth/login', 'Auth\AuthController@postLogin');
	Route::get(Config::get('webdefault.link').'/auth/logout', 'Auth\AuthController@getLogout');

});

//Default admin default view parts for AngularJS.
Route::group([
	'namespace'  => '\MVsoft\Webdefault\Http\Controllers',
	'middleware' => ['webadmin'],
	], 
function(){

	//Load header
	Route::get('webadmin/header', function(){
		return view('mvsoft::partials.header');
	});

	//Load footer
	Route::get('webadmin/footer', function(){
		return view('mvsoft::partials.footer');
	});

});

//Start run default admin
Route::group([
	'prefix'     => Config::get('webdefault.link'), //This is default link for admin part
	'namespace'  => '\MVsoft\Webdefault\Http\Controllers', //Naspace to controller of this default admin package
	'middleware' => ['webadmin'] //Middleware for admin part
	], 
function(){



	//Run default controller
	Route::controller('/', 'DefaultController');

});