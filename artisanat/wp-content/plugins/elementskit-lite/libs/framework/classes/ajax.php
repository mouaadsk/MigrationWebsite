<?php 
namespace ElementsKit\Libs\Framework\Classes;

defined( 'ABSPATH' ) || exit;

class Ajax{
    private $utils;

    public function __construct() {
        add_action( 'wp_ajax_ekit_admin_action', [$this, 'elementskit_admin_action'] );
        $this->utils = Utils::instance();
    }
    
    
    public function elementskit_admin_action() {
        if(!current_user_can('edit_theme_options')){
            wp_die(esc_html__('Permission deny.', 'elementskit'));
        }
        $this->utils->save_sanitized('widget_list', !isset($_POST['widget_list']) ? [] : $_POST['widget_list']);
        $this->utils->save_sanitized('module_list',  !isset($_POST['module_list']) ? [] : $_POST['module_list']);
        $this->utils->save_sanitized('user_data', $_POST['user_data']);

        wp_die(); // this is required to terminate immediately and return a proper response
    }

}