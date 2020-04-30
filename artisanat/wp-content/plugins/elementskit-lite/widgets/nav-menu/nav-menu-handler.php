<?php
namespace ElementsKit;

class Elementskit_Widget_Nav_Menu_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'ekit-nav-menu';
    }

    static function get_title() {
        return esc_html__( 'Nav menu', 'elementskit' );
    }

    static function get_icon() {
        return 'eicon-nav-menu ekit-widget-icon ';
    }

    static function get_categories() {
        return [ 'elementskit_headerfooter' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'nav-menu/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'nav-menu/';
    }

    public function register_api(){
        
    }

}