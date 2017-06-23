<?php


namespace calderawp\WPUser;


/**
 * Class JWTAuthenticated
 *
 * Make authenticated requests against REST API using a
 *
 * @package calderawp\WPUser
 */
class JWTAuthenticated extends APIClient {


	public function addAuthToHeaders()
	{
		$this->headers[ 'Authorization' ] = 'Bearer ' . $this->getUser()->getToken();
	}

	public function verify() : bool
	{
		try{
			$this->request( 'POST', '/jwt-auth/v1/token/validate' );
		}catch ( \Exception $e ){
			return false;
		}

		return false;
	}

}