<?php
namespace ElementsKit;

class Elementskit_Widget_timeline_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-timeline';
    }

    static function get_title() {
        return esc_html__( 'Timeline', 'elementskit' );
    }

    static function get_icon() {
        return 'ekit ekit-horizontal-timeline ekit-widget-icon ';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'timeline/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'timeline/';
    }


}