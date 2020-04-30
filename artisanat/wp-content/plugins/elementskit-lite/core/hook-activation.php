<?php
namespace ElementsKit\Core;

defined( 'ABSPATH' ) || exit;

class Activation_Hook{
	/**
	 * Hooks on plugin activation.
	 *
	 * @since 1.0.0
	 * @access private
	 */

    public function __construct() {
        \ElementsKit\Autoloader::run();
        $this->flush();
        $this->set_activation_stamp();
    }
    
    public function flush(){
        $dynamic_content = new \ElementsKit\Modules\Dynamic_Content\Cpt();
        $dynamic_content->flush_rewrites();
    }

    public function set_activation_stamp(){
        update_option('elementskit_lite_activation_stamp', time());
    }
}

new Activation_Hook();