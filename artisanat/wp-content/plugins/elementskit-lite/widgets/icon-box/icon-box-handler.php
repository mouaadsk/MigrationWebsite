<?php
namespace ElementsKit;

class Elementskit_Widget_Icon_Box_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-icon-box';
    }

    static function get_title() {
        return esc_html__( 'Icon Box', 'elementskit' );
    }

    static function get_icon() {
        return 'eicon-info-box ekit-widget-icon ';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'icon-box/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'icon-box/';
    }
}