<?php
namespace ElementsKit;

class Elementskit_Widget_hotspot_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-hotspot';
    }

    static function get_title() {
        return esc_html__( 'Hotspot', 'elementskit' );
    }

    static function get_icon() {
        return 'eicon-image-hotspot ekit-widget-icon ';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'hotspot/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'hotspot/';
    }
}