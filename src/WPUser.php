<?php


namespace calderawp\WPUser;

use \Illuminate\Database\Eloquent\Concerns;
use Illuminate\Database\Eloquent\MassAssignmentException;

/**
 * Class WPUser
 *
 * Abstraction for WordPress user data
 *
 * @package calderawp\WPUser
 */
abstract class WPUser {

	protected $fillable;

	protected $attributes;

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
		foreach ( $WPUser->fillable as $attr ){
			if( isset( $obj->$attr ) ){
				$WPUser->$attr = $obj->$attr;
			}else{
				$_attr =  'user_' . $attr;
				if( isset( $obj->$_attr ) ){
					$WPUser->$attr = $obj->$_attr;
				}
			}
		}

		return $WPUser;
	}

	public function get( $name, $default = null )
	{
		if ( $this->allowed( $name ) ) {
			if ( ! isset( $this->attributes[ $name ] ) ) {
				return $default;
			}

			return $this->attributes[ $name ];

		}

		return null;

	}

	public function __set( $name, $value )
	{
		if( $this->allowed( $name ) ){
			$this->attributes[ $name ] = $value;
		}

		return $this;
	}

	public function __get( $name )
	{
		return $this->get( $name );

	}


	protected function allowed( $attr ){
		return in_array( $attr, $this->fillable );
	}
}