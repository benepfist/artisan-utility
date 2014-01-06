<?php namespace Benepfist\ArtisanUtility;

use Illuminate\Support\ServiceProvider;

class ArtisanUtilityServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerArtisanUtilityCommand();

		$this->commands(
			'laravel.add');
	}

	protected function registerArtisanUtilityCommand()
	{
		$this->app['laravel.add'] = $this->app->share(function($app){
			$PackageInstaller = new PackageInstaller($app['files'], $app['config']);
			return new ArtisanUtilityCommand($PackageInstaller);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}