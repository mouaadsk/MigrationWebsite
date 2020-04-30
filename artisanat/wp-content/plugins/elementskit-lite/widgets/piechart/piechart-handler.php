<?php
namespace ElementsKit;

class Elementskit_Widget_Piechart_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-piechart';
    }

    static function get_title() {
        return esc_html__( 'Pie Chart', 'elementskit' );
    }

    static function get_icon() {
        return 'fa fa-pie-chart ekit-widget-icon ';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'piechart/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'piechart/';
    }

}