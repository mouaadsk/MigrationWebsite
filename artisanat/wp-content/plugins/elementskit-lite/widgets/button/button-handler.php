<?php
namespace ElementsKit;

class Elementskit_Widget_Button_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-button';
    }

    static function get_title() {
        return esc_html__( 'Button', 'elementskit' );
    }

    static function get_icon() {
        return ' ekit-widget-icon eicon-button';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'button/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'button/';
    }
}