<?php
namespace ElementsKit;

class Elementskit_Widget_Tab_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-simple-tab';
    }

    static function get_title() {
        return esc_html__( 'Tab', 'elementskit' );
    }

    static function get_icon() {
        return 'ekit ekit-tab ekit-widget-icon ';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'tab/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'tab/';
    }

}