<?php

namespace PremiumAddons;

use PremiumAddons\Admin\Includes;
use PremiumAddons\Admin\Settings;

if ( ! defined( 'ABSPATH' ) ) exit;

class Plugin {

	public static $instance = null;

	public static function instance() {
        
		if ( is_null( self::$instance ) ) {
            
			self::$instance = new self();
            
		}

		return self::$instance;
	}
    
    public function init() {
        
		$this->init_components();
        
	}
    
    private function init_components() {
        
        new Includes\Plugin_Info();
        new Settings\Maps();
        new Includes\Version_Control();
        new Includes\Config_Data();
    	new Settings\Modules_Settings();
		$this->settings = new Includes\Papro_Actions();
	}
    
    private function __construct() {
		add_action( 'init', array( $this, 'init' ), 0 );
	}
}

if ( ! defined( 'ELEMENTOR_TESTS' ) ) {
	Plugin::instance();
}