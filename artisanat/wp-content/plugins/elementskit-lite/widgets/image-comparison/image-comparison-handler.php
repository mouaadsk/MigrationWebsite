<?php
namespace ElementsKit;

class Elementskit_Widget_Image_Comparison_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-image-comparison';
    }

    static function get_title() {
        return esc_html__( 'Image Comparison', 'elementskit' );
    }

    static function get_icon() {
        return 'ekit  ekit-widget-icon ekit-image-comparison';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'image-comparison/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'image-comparison/';
    }
}