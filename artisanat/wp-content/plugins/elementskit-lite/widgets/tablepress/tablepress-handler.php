<?php
namespace ElementsKit;

class Elementskit_Widget_TablePress_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-tablepress';
    }

    static function get_title() {
        return esc_html__( 'TablePress', 'elementskit' );
    }

    static function get_icon() {
        return 'eicon-table ekit-widget-icon ';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'tablepress/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'tablepress/';
    }
}