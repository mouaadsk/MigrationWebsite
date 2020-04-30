<?php
namespace ElementsKit;

class Elementskit_Widget_Countdown_Timer_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-countdown-timer';
    }

    static function get_title() {
        return esc_html__( 'Countdown Timer', 'elementskit' );
    }

    static function get_icon() {
        return 'ekit  ekit-widget-icon ekit-countdown-timer';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'countdown-timer/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'countdown-timer/';
    }
}