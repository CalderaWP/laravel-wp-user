<?php


namespace calderawp\WPUser\Model;
use calderawp\WPUser\Authenticated;
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


	public static function fromAuth( Authenticated $authenticated )
	{
		$obj = new Model([
			'token' => $authenticated->token,
			'email' => $authenticated->email,
			'name' => $authenticated->name
		]);

		return $obj;

	}

}