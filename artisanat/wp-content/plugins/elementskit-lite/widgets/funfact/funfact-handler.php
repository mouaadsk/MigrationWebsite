<?php
namespace ElementsKit;

class Elementskit_Widget_Funfact_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-funfact';
    }

    static function get_title() {
        return esc_html__( 'Funfact', 'elementskit' );
    }

    static function get_icon() {
        return 'ekit ekit-widget-icon  ekit-progress-bar';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'funfact/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'funfact/';
    }
}