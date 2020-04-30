<?php
namespace ElementsKit;

class Elementskit_Widget_Drop_Caps_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-drop-caps';
    }

    static function get_title() {
        return esc_html__( 'Drop Caps', 'elementskit' );
    }

    static function get_icon() {
        return ' ekit-widget-icon eicon-typography';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'drop-caps/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'drop-caps/';
    }
}