<?php
namespace ElementsKit;

class Elementskit_Widget_We_Forms_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-we-forms';
    }

    static function get_title() {
        return esc_html__( 'We Forms', 'elementskit' );
    }

    static function get_icon() {
        return 'eicon-mail ekit-widget-icon';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'we-forms/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'we-forms/';
    }
}