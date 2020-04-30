<?php
namespace ElementsKit;

class Elementskit_Widget_Team_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-team';
    }

    static function get_title() {
        return esc_html__( 'Team', 'elementskit' );
    }

    static function get_icon() {
        return 'eicon-image-box ekit-widget-icon ';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'team/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'team/';
    }


}