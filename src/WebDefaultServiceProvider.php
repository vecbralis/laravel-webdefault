<?php

namespace MVsoft\Webdefault;

use Illuminate\Support\ServiceProvider;

class WebDefaultServiceProvider extends ServiceProvider {

	/**
	 * Translate with database booting service
	 * @return void
	 */
	public function boot()
	{
		//Load views from
		$this->loadViewsFrom(__DIR__.'/../resources/views', 'mvsoft');
		
		//Configuration publish
		$this->publishes([
			__DIR__.'/config/webdefault.php' => config_path('webdefault.php')
		], 'mvsoft.config');

		//Migrations publish
	    $this->publishes([
	    	__DIR__.'/../migrations/' => database_path('migrations')
	    ], 'mvsoft.webdefault.migrations');
	
		//Public files
		$this->publishes([
	        __DIR__.'/../public/assets' => public_path('assets'),
	    ], 'mvsoft.public');

	    //Publicate views
	    $this->publishes([
	        __DIR__.'/../resources/views' => base_path('resources/views/vendor/mvsoft'),
	    ], 'mvsoft.webdefault.views');

	    //Register routes
	    if (! $this->app->routesAreCached()) {
	        require __DIR__.'/Http/routes.php';
	    }
	}

	/**
	 * 
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom(
	        __DIR__.'/config/webdefault.php', 'webdefault'
	    );
	}

}