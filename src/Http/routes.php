<?php

//Authenticate
Route::group(['namespace'  => '\MVsoft\Webdefault\Http\Controllers'], function(){

	Route::get(Config::get('webdefault.link').'/auth/login', 'Auth\AuthController@getLogin');
	Route::post(Config::get('webdefault.link').'/auth/login', 'Auth\AuthController@postLogin');
	Route::get(Config::get('webdefault.link').'/auth/logout', 'Auth\AuthController@getLogout');

});

Route::get('infotest', function(){
	
	// if(Gate::has('check-permission'))
	// {
	// 	return 'Hi have are you';
	// }

	if(Gate::denies('check-permission', ['ttests']))
	{
		return 'tests';
	}
	else
	{
		return 'tests good';
	}
});

Route::group([
	'prefix'     => Config::get('webdefault.link'),
	'namespace'  => '\MVsoft\Webdefault\Http\Controllers',
	'middleware' => ['webadmin']
	], function(){
		Route::get('test', function(){
			if(Gate::denies('check-permission', [['sadf', 'asddsf', '11233'], 'fuck off']))
			{
				return 'tests';
			}
			else
			{
				return 'tests good';
			}
		});
});

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