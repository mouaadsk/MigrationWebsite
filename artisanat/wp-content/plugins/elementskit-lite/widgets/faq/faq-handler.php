<?php
namespace ElementsKit;

class Elementskit_Widget_FAQ_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-faq';
    }

    static function get_title() {
        return esc_html__( 'FAQ', 'elementskit' );
    }

    static function get_icon() {
        return 'ekit ekit-faq ekit-widget-icon';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'faq/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'faq/';
    }
}