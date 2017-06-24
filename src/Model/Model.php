<?php


namespace calderawp\WPUser\Model;
use calderawp\WPUser\JWTAuthenticator;

/**
 * Class Model
 * @package calderawp\WPUser
 */
class Model extends \Illuminate\Database\Eloquent\Model {

	protected $fillable = [
		'token',
		'email',
		'name'
	];



}