<?php


namespace calderawp\WPUser;


/**
 * Class JWTWPUser
 *
 *
 * @package calderawp\WPUser
 */
class JWTWPUser extends WPUser{

	protected $attributes = [
		'token',
		'display_name',
		'email',
		'nicename'
	];
}