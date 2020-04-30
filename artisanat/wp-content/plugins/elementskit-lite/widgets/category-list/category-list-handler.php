<?php
namespace ElementsKit;

class Elementskit_Widget_Category_List_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-category-list';
    }

    static function get_title() {
        return esc_html__( 'Category List', 'elementskit' );
    }

    static function get_icon() {
        return ' ekit-widget-icon eicon-bullet-list';
    }


	static function get_keywords() {
		return [ 'list', 'category list', 'category', 'ekit', 'elementskit', 'elementskit category list' ];
	}

    static function get_categories() {
        return [ 'elementskit_headerfooter' ];
	}

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'category-list/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'category-list/';
    }
}