<?php
namespace ElementsKit;

class Elementskit_Widget_Pricing_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-pricing';
    }

    static function get_title() {
        return esc_html__( 'Pricing Table', 'elementskit' );
    }

    static function get_icon() {
        return 'eicon-price-table ekit-widget-icon ';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'pricing/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'pricing/';
    }

}