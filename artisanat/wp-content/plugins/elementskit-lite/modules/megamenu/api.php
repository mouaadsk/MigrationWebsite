<?php 
namespace ElementsKit;
use ElementsKit\Libs\Framework\Attr;
use ElementsKit\Modules\Megamenu\Init;

defined( 'ABSPATH' ) || exit;

class Megamenu_Api extends Core\Handler_Api {

    public function config(){
        $this->prefix = 'megamenu';
    }

    public function get_save_menuitem_settings(){
        $menu_item_id = $this->request['settings']['menu_id'];
        $menu_item_settings = json_encode($this->request['settings']);
        update_post_meta( $menu_item_id, Init::$menuitem_settings_key, $menu_item_settings );

        return [
            'saved' => 1,
            'message' => esc_html__('Saved', 'ekit-megamenu'),
        ];
    }

    public function get_get_menuitem_settings(){
        $menu_item_id = $this->request['menu_id'];

        $data = get_post_meta($menu_item_id, Init::$menuitem_settings_key, true);
        return (array) json_decode($data);
    }

}
new Megamenu_Api();