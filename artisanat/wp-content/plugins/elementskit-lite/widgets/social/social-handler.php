<?php
namespace ElementsKit;

class Elementskit_Widget_Social_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-social-media';
    }

    static function get_title() {
        return esc_html__( 'Social Media', 'elementskit' );
    }

    static function get_icon() {
        return 'eicon-social-icons ekit-widget-icon ';
    }

    static function get_categories() {
        return ['elementskit'];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'social/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'social/';
    }

}