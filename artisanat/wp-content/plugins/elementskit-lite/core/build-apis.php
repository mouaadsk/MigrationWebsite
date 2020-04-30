<?php
namespace ElementsKit\Core;

defined( 'ABSPATH' ) || exit;

class Build_Apis{
	/**
	 * Collection of default widgets.
	 *
	 * @since 1.0.0
	 * @access private
	 */

    public function __construct() {

        add_action( 'rest_api_init', function () {
            register_rest_route( 'elementskit/', '/v(?P<version>\d+)/(?P<route>\w+)', array(
              'methods' => 'POST',
              'callback' => [$this, 'register_post_apis'],
            ));
        });
        
        add_action( 'rest_api_init', function () {
            register_rest_route( 'elementskit/', '/v(?P<version>\d+)/(?P<route>\w+)', array(
              'methods' => 'GET',
              'callback' => [$this, 'register_get_apis'],
            ));
        });
    }
    
    public function register_post_apis($request){
        $route = $request['route'];
        do_action('elementskit/apis/apis_registered/post', $route, $request);
    }
    public function register_get_apis($request){
        return do_action('elementskit/apis/apis_registered/get', $request);
    }
}