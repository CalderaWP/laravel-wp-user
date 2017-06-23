<?php


namespace calderawp\WPUser;
use GuzzleHttp\Client;


/**
 * Class Factory
 * @package calderawp\WPUser
 */
class Factory {


	/**
	 * Get JWT Authenticator client
	 *
	 * @param string $wpUrl URL of WordPress REST API with /wp-json
	 * @param array $args Optional. Guzzle options.
	 *
	 * @return JWTAuthenticator
	 */
	public static function jwtAuthenticator( string  $wpUrl, array $args = [] ) : JWTAuthenticator
	{
		return new JWTAuthenticator( static::guzzle( $wpUrl, $args ) );
	}

	/**
	 *  Get JWT-authenticated client
	 *
	 * @param string $wpUrl URL of WordPress REST API with /wp-json
	 * @param WPUser $WPUser User object
	 * @param array $args Optional. Guzzle options.
	 *
	 * @return JWTAuthenticated
	 */
	public static function jwtAuthenitcated( string  $wpUrl, WPUser $WPUser, array $args = [] ) : JWTAuthenticated
	{
		return ( new JWTAuthenticated( static::guzzle( $wpUrl, $args ) ) )->setUser( $WPUser );

	}


	/**
	 * @param string $wpApiUrl
	 * @param array $args
	 *
	 * @return Client
	 */
	protected static function guzzle( string $wpApiUrl, array  $args = []) : Client
	{
		$args = array_merge([
			'base_uri' => $wpApiUrl
		], $args );
		return new Client( $args );
	}

}