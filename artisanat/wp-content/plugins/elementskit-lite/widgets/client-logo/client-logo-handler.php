<?php
namespace ElementsKit;

class Elementskit_Widget_Client_Logo_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-client-logo';
    }

    static function get_title() {

        return esc_html__( 'Client Logo', 'elementskit' );

    }

    static function get_icon() {
        return 'eicon-slider-push ekit-widget-icon';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'client-logo/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'client-logo/';
    }

}