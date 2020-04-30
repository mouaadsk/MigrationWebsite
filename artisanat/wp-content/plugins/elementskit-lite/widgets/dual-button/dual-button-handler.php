<?php
namespace ElementsKit;

class Elementskit_Widget_Dual_Button_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-dual-button';
    }

    static function get_title() {
        return esc_html__( 'Dual Button', 'elementskit' );
    }

    static function get_icon() {
        return ' ekit-widget-icon eicon-dual-button';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'dual-button/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'dual-button/';
    }
}