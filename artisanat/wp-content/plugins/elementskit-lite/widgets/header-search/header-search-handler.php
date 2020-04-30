<?php
namespace ElementsKit;

class Elementskit_Widget_Header_Search_Handler extends Core\Handler_Widget{

    static function get_name()
    {
        return 'elementskit-header-search';
    }

    static function get_title()
    {
        return esc_html__('Header Search', 'elementskit');
    }

    static function get_icon()
    {
        return 'eicon-search ekit-widget-icon ';
    }

    static function get_categories()
    {
        return ['elementskit_headerfooter'];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'header-search/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'header-search/';
    }

}