<?php
namespace ElementsKit;

class Elementskit_Widget_Business_Hours_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-business-hours';
    }

    static function get_title() {
        return esc_html__( 'Business Hours', 'elementskit' );
    }

    static function get_icon() {
        return 'ekit-widget-icon eicon-clock-o';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'business-hours/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'business-hours/';
    }
}