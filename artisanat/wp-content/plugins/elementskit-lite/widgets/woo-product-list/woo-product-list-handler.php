<?php
namespace ElementsKit;

class ElementsKit_Widget_Woo_Product_List_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-woo-product-list';
    }

    static function get_title() {
        return esc_html__( 'Woo Product List', 'elementskit' );
    }

    static function get_icon() {
        return 'ekit-widget-icon eicon-editor-list-ul';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'woo-product-list/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'woo-product-list/';
    }
}