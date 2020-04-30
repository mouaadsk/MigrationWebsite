<?php
namespace ElementsKit;

class Elementskit_Widget_Heading_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-heading';
    }

    static function get_title() {
        return esc_html__( 'Heading', 'elementskit' );
    }

    static function get_icon() {
        return 'ekit  ekit-widget-icon ekit-heading-style';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'heading/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'heading/';
    }
}