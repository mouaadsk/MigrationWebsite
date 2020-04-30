<?php
namespace ElementsKit;

class Elementskit_Widget_Image_Box_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-image-box';
    }

    static function get_title() {
        return esc_html__( 'Image Box', 'elementskit' );
    }

    static function get_icon() {
        return 'eicon-image-rollover ekit-widget-icon ';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'image-box/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'image-box/';
    }

}