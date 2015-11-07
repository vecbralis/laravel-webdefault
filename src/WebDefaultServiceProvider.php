<?php

namespace MVsoft\Webdefault;

use MVsoft\Webdefault\Services\MVemail;
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
	 * Register all commands for MVsoft Webdefault part
	 * @return void
	 */
	private function registerCommands()
	{

		$mvSoftCommands = 'MVsoft\Webdefault\Commands\/';
		foreach(scandir(__DIR__.'/Commands/') AS $command)
		{
			$testFile = explode('.', $command);
			if(isset($testFile[1]) && strlen($testFile[0]) > 7)
			{
				$commandFile = $mvSoftCommands.$testFile[0];
				$this->app->singleton('command.mvsoftWebdefault.'.$testFile[0], function ($app) use ($commandFile) {
		            return $app[str_replace('/', '', $commandFile)];
		        });
		        $this->commands('command.mvsoftWebdefault.'.$testFile[0]);
			}
		}

	}

	/**
	 * Register all needed things for 
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom(
	        __DIR__.'/config/webdefault.php', 'webdefault'
	    );


		//Register Facade
	    $this->app['mvemail'] = $this->app->share(function ($app) {
            return new MVemail();
        });

	    //Register all commands
		$this->registerCommands();
	}

}