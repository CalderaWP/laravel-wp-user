<?php


namespace calderawp\WPUser\Providers;
use calderawp\WPUser\Factory;
use Illuminate\Support\ServiceProvider;
use \calderawp\WPUser\JWTAuthenticator;

/**
 * Class JWTAuthenticatorProvider
 * @package calderawp\WPUser\Providers
 */
class JWTAuthenticatorProvider extends ServiceProvider {

	protected $defer = true;

	/**
	 * Perform post-registration booting of services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__.'/config.php' => config_path('wp-user-jwt.php'),
		]);
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom(
			__DIR__.'/config.php', 'wp-user-jwt'
		);

		$this->app->singleton(\calderawp\WPUser\JWTAuthenticator::class, function($app) {

			return Factory::jwtAuthenticator( config( 'wp-user-jwt.wpUrl' ), [
				'verify' => config( 'wp-user-jwt.verify' )
			] );
		});

	}


	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [\calderawp\WPUser\JWTAuthenticator::class];
	}
}