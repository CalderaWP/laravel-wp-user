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
abstract class WPUser {

	use Concerns\HasAttributes;


	/**
	 *  Construct from stdClass - IE from API returns
	 *
	 * @param \stdClass $obj
	 *
	 * @return $this
	 */
	public static function factory( \stdClass $obj )
	{
		$WPUser = new static();
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