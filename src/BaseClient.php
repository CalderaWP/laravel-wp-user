<?php


namespace calderawp\WPUser;
use GuzzleHttp\Client as Guzzle;

/**
 * Class Client
 *
 * Bass class for all types of API clients
 *
 * @package calderawp\WPUser
 */
abstract class BaseClient {

	/**
	 * Guzzle client
	 *
	 * Acces via request method
	 *
	 * @var Guzzle
	 */
	private $guzzle;

	/**
	 * Will be used as request headers
	 *
	 * @var array
	 */
	protected $headers;

	/**
	 * @var WPUser
	 */
	protected $WPUser;

	public function __construct( Guzzle  $guzzle )
	{
		$this->guzzle = $guzzle;
	}

	/**
	 * @return WPUser
	 * @throws \Exception
	 */
	public function getUser() : WPUser
	{
		if( ! $this->WPUser ){
			throw new \Exception( 'User not set' );
		}

		return $this->WPUser;

	}

	/***
	 * Make an API request
	 *
	 * @param string $method HTTP Method
	 * @param string $endpoint Endpoint URL
	 * @param array $data Optional. Body data (or query params for GET)
	 *
	 * @return mixed|\Psr\Http\Message\ResponseInterface
	 */
	protected function request( string $method, string $endpoint,  array  $data = [] )
	{
		if( method_exists( $this, 'addAuthToHeaders' ) ){
			$this->addAuthToHeaders();
		}

		$args = [
			'headers' => $this->headers
		];
		if( 'GET' === $method && ! empty( $data ) ){
			$endpoint .= '?' . http_build_query( $data );
		}else{
			$args ['json' ] = $data;
		}

		return $this->guzzle->request( $method, $endpoint,  $args );

	}


}