<?php
namespace ElementsKit;

class Elementskit_Widget_Icon_Hover_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-icon-hover';
    }

    static function get_title() {
        return esc_html__( 'Icon Hover', 'elementskit' );
    }

    static function get_icon() {
        return 'eicon-image-hotspot ekit-widget-icon ';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'icon-hover/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'icon-hover/';
    }
}