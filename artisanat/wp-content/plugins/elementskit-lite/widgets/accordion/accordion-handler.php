<?php
namespace ElementsKit;

class ElementsKit_Widget_Accordion_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-accordion';
    }

    static function get_title() {
        return esc_html__( 'Accordion', 'elementskit' );
    }

    static function get_icon() {
        return 'ekit ekit-widget-icon ekit-accordion';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'accordion/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'accordion/';
    }
}