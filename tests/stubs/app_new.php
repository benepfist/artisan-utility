<?php

return array(

	/**
	 *
	 * Providers
	 * 
	 */

	'providers' => array(

		'Illuminate\Auth\AuthServiceProvider',
		'Demopackage\Demo\DemoServiceProvider',

	),

	/**
	 *
	 * Aliases
	 * 
	 */

	'aliases' => array(
	
		'App' => 'Illuminate\Support\Facades\App',
		'Demo' => 'Demopackage\Facade\Demo',

	),

);
