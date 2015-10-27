<?php

//Authenticate
Route::group(['namespace'  => '\MVsoft\Webdefault\Http\Controllers'], function(){

	Route::get(Config::get('webdefault.link').'/auth/login', 'Auth\AuthController@getLogin');
	Route::post(Config::get('webdefault.link').'/auth/login', 'Auth\AuthController@postLogin');
	Route::get(Config::get('webdefault.link').'/auth/logout', 'Auth\AuthController@getLogout');

});

Route::group([
	'prefix'     => Config::get('webdefault.link'),
	'namespace'  => '\MVsoft\Webdefault\Http\Controllers',
	'middleware' => ['webadmin']
	], function(){
		Route::get('test', function(){
			return 'tests';
		});
});

Route::group([
	'namespace'  => '\MVsoft\Webdefault\Http\Controllers',
	'middleware' => ['webadmin', 'role:admin'],
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