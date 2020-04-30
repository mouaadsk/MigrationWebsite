<?php
namespace ElementsKit;

class Elementskit_Widget_Chart_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-chart';
    }

    static function get_title() {
        return esc_html__( 'Chart', 'elementskit' );
    }

    static function get_icon() {
        return 'fa fa-bar-chart ekit-widget-icon';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'chart/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'chart/';
    }

    public function register_api(){
    }

    public function scripts(){
       wp_enqueue_script( 'chart-kit-js', self::get_url() . 'assets/js/chart.js', array( 'jquery' ), false, true );
    }
}