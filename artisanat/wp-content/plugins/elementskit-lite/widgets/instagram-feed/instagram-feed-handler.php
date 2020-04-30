<?php
namespace ElementsKit;
use ElementsKit\Libs\Framework\Attr;
class Elementskit_Widget_Instagram_Feed_Handler extends Core\Handler_Widget{

    public function wp_init(){
        include(self::get_dir().'classes/settings.php');
    }

    static function get_name() {
        return 'elementskit-instagram-feed';
    }

    static function get_title() {
        return esc_html__( 'Instagram Feed', 'elementskit' );
    }

    static function get_icon() {
        return 'ekit ekit-instagram ekit-widget-icon ';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'instagram-feed/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'instagram-feed/';
    }

	static function get_data(){
		$data = Attr::instance()->utils->get_option('user_data', []);

		$user_id = (isset($data['instragram']) && !empty($data['instragram']['user_id']) ) ? $data['instragram']['user_id'] : '';

		$token = (isset($data['instragram']) && !empty($data['instragram']['token']) ) ? $data['instragram']['token'] : '';

		return [
			'user_id' => $user_id,
			'token' => $token,
		];
	}
}