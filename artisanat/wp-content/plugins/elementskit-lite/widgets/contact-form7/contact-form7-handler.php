<?php
namespace ElementsKit;

class Elementskit_Widget_Contact_Form7_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-contact-form7';
    }

    static function get_title() {
        return esc_html__( 'Contact form 7', 'elementskit' );
    }

    static function get_icon() {
        return 'eicon-mail ekit-widget-icon';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'contact-form7/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'contact-form7/';
    }
}