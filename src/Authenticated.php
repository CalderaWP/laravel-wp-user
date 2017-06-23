<?php


namespace calderawp\WPUser;

/**
 * Interface Authenticated
 *
 * API Clients for authenticated requests should impliment this interface
 *
 * @package calderawp\WPUser
 */
interface Authenticated {

	/**
	 * Will be called before making authenticated requests.
	 *
	 * Use to merge auth tokens or whatever into $headers property
	 *
	 * @return void
	 */
	public function addAuthToHeaders();

	/**
	 * Verify current user token
	 *
	 * @return bool
	 */
	public function verify() : bool;
}