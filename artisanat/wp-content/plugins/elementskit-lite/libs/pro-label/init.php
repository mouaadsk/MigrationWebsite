<?php 
namespace ElementsKit\Libs\Pro_Label;
defined( 'ABSPATH' ) || exit;

class Init{
    use Admin_Notice;

    public function __construct(){
        add_action( 'current_screen', [$this, 'hook_current_screen'] );

        $activation_stamp = get_option('elementskit_lite_activation_stamp');
        if(date('d', (time() - $activation_stamp)) > 10){
            add_action( 'admin_notices', [$this, 'show_go_pro_notice'] );
        }
    }

    public function hook_current_screen($screen){
        if(!in_array($screen->id, ['nav-menus', 'toplevel_page_elementskit', 'edit-elementskit_template'])){
            return;
        }

        //Plugin list links
        add_filter('plugin_action_links_elementskit/elementskit-lite.php', [$this, 'insert_plugin_links']);
        add_filter('plugin_row_meta', [$this, 'insert_plugin_row_meta'], 10, 2);
        add_action('admin_footer', [$this, 'footer_alert_box']);
    }
}