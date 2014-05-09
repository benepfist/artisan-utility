https://travis-ci.org/benepfist/artisan-utility.svg?branch=master

## Installation

First ensure you have the latest version of composer installed.

Run `composer self-update`.

Install this package through Composer. To your `composer.json` file, add:

```js
"require-dev": {
	"benepfist/artisan-utility": "dev-master"
}
```

Next, run `composer install --dev` to download it.

Add the service provider to `app/config/app.php`, within the `providers` array.

```php
'providers' => array(
	// ...

	'Benepfist\ArtisanUtility\ArtisanUtilityServiceProvider',
)
```

Run `php artisan` to view the new laravel:add command:

- **laravel:add --provider="DemoPackage\Demo\DemoServiceProvider"** - Add a new ServiceProvider
- **laravel:add --alias="Demo => DemoPackage\Facade\Demo"** - Add a new Alias
