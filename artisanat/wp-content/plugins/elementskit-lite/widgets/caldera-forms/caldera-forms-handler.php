<?php
namespace ElementsKit;

class Elementskit_Widget_Caldera_Forms_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-caldera-forms';
    }

    static function get_title() {
        return esc_html__( 'Caldera Forms', 'elementskit' );
    }

    static function get_icon() {
        return 'eicon-mail ekit-widget-icon';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'caldera-forms/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'caldera-forms/';
    }
}