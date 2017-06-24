# laravel-wp-user
Use a WordPress site as the authentication provider for a Laravel app.

Also can act as a WordPress REST API client.


### Setting Up WordPress
This library could use other authentication systems but only JWT is implimented.

* Have WordPress 4.7 or later
* Install [JWT Authentication for the WP REST API](https://wordpress.org/plugins/jwt-authentication-for-wp-rest-api/)
* Set the right constants as describe in the plugin's readme.
* Activate plugin


### Add WordPress Login To Your App

* Config
** Publish config and set url for WordPress site or use `WPUSERWPURL` in your .env
** URL must include `/wp-json/` (or whatever) you use WITH trailing slash.

* Add a login route, for example
```
Route::post('/wp-login', function( \calderawp\WPUser\JWTAuthenticator $authenticator, \Illuminate\Http\Request $request ){
	if( $request->has( 'username' ) && $request->has( 'password' ) ){
		if( $authenticator->login( $request->input( 'username'), $request->input( 'password' ) ) ){
			$x= 1;
		}

		//return an error;
	}
});
```

### Example To Authenticate User

```
    //SUPER IMPORTANT to use a trialing slash after wp-json
    $wpApiUrl = 'https://roysivan.com/wp-json/';
    $authClient = \calderawp\WPUser\Factory::jwtAuthenticator( $wpApiUrl, [ 
        //args to pass to constructor of GuzzleHttp\Client
     ] );
     
    //BTW- in local testing, might want to set verify false
    // $authClient = \calderawp\WPUser\Factory::jwtAuthenticator( $wpApiUrl, [ 'verify' => false ] );


    //authenticate
    if( $authClient->login( 'josh', '12345' ) ){
        $api = \calderawp\WPUser\Factory::jwtAuthenitcated( $wpApiUrl, $authClient->getUser(), 
            [ 
                //args to pass to constructor of GuzzleHttp\Client
             ] 
        );
        $me = $api->me();
    }
```

