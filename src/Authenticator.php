<?php


namespace calderawp\WPUser;

/**
 * Interface Authenticator
 *
 * Intertface that clients that handle token exchange to get authentications should impliment
 *
 * @package calderawp\WPUser
 */
interface Authenticator {

	/**
	 * Try remote login
	 *
	 * @param string $username
	 * @param string $password
	 *
	 * @return bool
	 */
	public function login( string  $username, string $password ) : bool;


}