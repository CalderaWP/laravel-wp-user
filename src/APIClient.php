<?php


namespace calderawp\WPUser;


/**
 * Class APIClient
 *
 * Base class for clients that make authenticated requests
 *
 * @package calderawp\WPUser
 */
abstract class APIClient extends BaseClient implements Authenticated {

	/**
	 * Set WPUser object
	 *
	 * @param WPUser $WPUser
	 *
	 * @return APIClient
	 */
	public function setUser( WPUser  $WPUser ) : APIClient
	{
		$this->WPUser = $WPUser;
		return $this;
	}

	/**
	 * Query the /users/met endpoint
	 *
	 * @return bool|\stdClass
	 */
	public function me()
	{
		try {
			$request = $this->request( 'GET', 'wp/v2/users/me' );
		} catch ( \Exception $e ) {
			return false;
		}

		return \GuzzleHttp\json_decode( $request->getBody() );

	}

}