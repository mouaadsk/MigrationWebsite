<?php
namespace ElementsKit;

class Elementskit_Widget_Video_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-video';
    }

    static function get_title() {
        return esc_html__( 'Video', 'elementskit' );
    }

    static function get_icon() {
        return 'eicon-youtube ekit-widget-icon ';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'video/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'video';
    }
}