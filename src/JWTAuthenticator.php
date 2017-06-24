<?php


namespace calderawp\WPUser;


/**
 * Class JWTAuthenticator
 *
 * Authenticate against REST API using JWT Token
 *
 * @package calderawp\WPUser
 */
class JWTAuthenticator extends AuthClient {

	/** @inheritdoc */
	public function login( string $username, string $password ) : bool
	{
		try {
			$response = $this->request( 'POST', 'jwt-auth/v1/token',
				[
					'username' => $username,
					'password' => $password
				]
		    );
		} catch ( \Exception $e ) {
			return false;
		}

		$this->WPUser = JWTWPUser::factory( \GuzzleHttp\json_decode( $response->getBody() ) );
		return true;

	}

}