<?php


namespace calderawp\WPUser;


/**
 * Class JWTWPUser
 *
 *
 * @package calderawp\WPUser
 */
class JWTWPUser extends WPUser{

	protected $fillable = [
		'token',
		'display_name',
		'email',
		'nicename',
		'ID'
	];
}