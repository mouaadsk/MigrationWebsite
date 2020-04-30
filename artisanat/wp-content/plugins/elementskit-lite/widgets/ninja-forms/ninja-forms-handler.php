<?php
namespace ElementsKit;

class Elementskit_Widget_Ninja_Forms_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-ninja-forms';
    }

    static function get_title() {
        return esc_html__( 'Ninja Forms', 'elementskit' );
    }

    static function get_icon() {
        return 'eicon-mail ekit-widget-icon';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'ninja-forms/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'ninja-forms/';
    }
}