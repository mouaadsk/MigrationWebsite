<?php
namespace ElementsKit;

class Elementskit_Widget_Page_List_Handler extends Core\Handler_Widget{

    static function get_name() {
		return 'elementskit-page-list';
	}


	static function get_title() {
		return esc_html__( 'Page List', 'elementskit' );
	}


	static function get_icon() {
		return 'eicon-bullet-list ekit-widget-icon ';
	}


	static function get_keywords() {
		return [ 'list', 'page list', 'page', 'ekit', 'elementskit page list' ];
	}

    static function get_categories() {
        return [ 'elementskit_headerfooter' ];
	}

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'page-list/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'page-list/';
    }

}