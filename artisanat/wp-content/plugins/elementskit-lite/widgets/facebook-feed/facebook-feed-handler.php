<?php
namespace ElementsKit;
use ElementsKit\Libs\Framework\Attr;
class Elementskit_Widget_Facebook_Feed_Handler extends Core\Handler_Widget{

    public function wp_init(){
        include(self::get_dir().'classes/settings.php');
    }

    static function get_name() {
        return 'elementskit-facebook-feed';
    }

    static function get_title() {
        return esc_html__( 'Facebook Feed', 'elementskit' );
    }

    static function get_icon() {
        return 'eicon-fb-feed ekit-widget-icon ';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'facebook-feed/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'facebook-feed/';
    }
    
	static function get_data(){
		$data = Attr::instance()->utils->get_option('user_data', []);

		$page_id = (isset($data['facebook']) && !empty($data['facebook']['page_id']) ) ? $data['facebook']['page_id'] : '';

		$access = (isset($data['facebook']) && !empty($data['facebook']['token']) ) ? $data['facebook']['token'] : '';


		return [
			'page_id' => $page_id,
			'access' => $access,
		];
	}

}