<?php


namespace calderawp\WPUser\Model;
use calderawp\WPUser\Authenticated;
use calderawp\WPUser\JWTAuthenticator;

/**
 * Class Model
 * @package calderawp\WPUser
 */
class Model extends \Illuminate\Database\Eloquent\Model {

	/** @inheritdoc */
	protected $fillable = [
		'token',
		'email',
		'name',
		'ID'
	];

	/**
	 * @param Authenticated $authenticated
	 *
	 * @return Model
	 */
	public static function fromAuth( Authenticated $authenticated )
	{
		$obj = new Model([
			'token' => $authenticated->token,
			'email' => $authenticated->email,
			'name' => $authenticated->name,
			'ID' => $authenticated->ID
		]);

		return $obj;

	}

}