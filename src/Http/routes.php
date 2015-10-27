<?php

Route::group([
	'namespace'  => '\MVsoft\Webdefault\Http\Controllers',
	'middleware' => ['role:admin'],
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