<?php
namespace ElementsKit;
use ElementsKit\Libs\Framework\Attr;
class Elementskit_Widget_Mail_Chimp_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-mail-chimp';
    }

    static function get_title() {
        return esc_html__( 'Mail Chimp', 'elementskit' );
    }

    static function get_icon() {
        return 'eicon-mailchimp ekit-widget-icon ';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'mail-chimp/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'mail-chimp/';
    }

    public function register_api(){
        return $this->get_dir() . 'mail-chimp-api.php';
    }

    public function scripts(){
		wp_enqueue_script( 'mail-chimp-script', self::get_url().'assets/js/mail-chimp.js', array( 'jquery' ), '1.0', true );
		wp_localize_script('mail-chimp-script', 'ekit_site_url', array( 'siteurl' => get_option('siteurl') ));
    }
    
	static function get_data(){
		$data = Attr::instance()->utils->get_option('user_data', []);

		$token = (isset($data['mail_chimp']) && !empty($data['mail_chimp']['token']) ) ? $data['mail_chimp']['token'] : '';

		$list = (isset($data['mail_chimp']) && !empty($data['mail_chimp']['list']) ) ? $data['mail_chimp']['list'] : '';

		return [
			'token' => $token,
			'list' => $list,
		];
	}


}