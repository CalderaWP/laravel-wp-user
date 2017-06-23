<?php


namespace calderawp\WPUser;

use \Illuminate\Database\Eloquent\Concerns;
/**
 * Class WPUser
 *
 * Abstraction for WordPress user data
 *
 * @package calderawp\WPUser
 */
class WPUser {

	use Concerns\HasAttributes;

	protected $attributes = [
		'token',
		'display_name',
		'email',
		'nicename'
	];

	/**
	 *  Construct from stdClass - IE from API returns
	 *
	 * @param \stdClass $obj
	 *
	 * @return WPUser
	 */
	public static function factory( \stdClass $obj ) : WPUser
	{
		$WPUser = new WPUser();
		foreach ( $WPUser->getAttributes() as $attr ){
			if( isset( $obj->$attr ) ){
				$WPUser->$attr = $obj->$attr;
			}else{
				$attr = str_replace( 'user_', '', $attr );
				if( isset( $obj->$attr ) ){
					$WPUser->$attr = $obj->$attr;
				}
			}
		}

		return $WPUser;
	}

	/**
	 *
	 * @return string
	 */
	public function getToken()
	{
		return $this->getAttribute( 'token' );
	}

}