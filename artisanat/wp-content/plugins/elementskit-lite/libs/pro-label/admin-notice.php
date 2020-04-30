<?php 
namespace ElementsKit\Libs\Pro_Label;
defined( 'ABSPATH' ) || exit;

trait Admin_Notice{
    /**
     * Extending plugin links
     *
     * @since 1.1.2
     */
    public function insert_plugin_links($links)
    {
        $links[] = sprintf('<a href="'.admin_url().'admin.php?page=elementskit">' . esc_html__('Settings', 'elementskit') . '</a>');
        $links[] = sprintf('<a href="https://go.wpmet.com/ekitpro" target="_blank" style="color: #39b54a; font-weight: bold;">' . esc_html__('Go Pro', 'elementskit') . '</a>');

        return $links;
    }

    /**
     * Extending plugin row meta
     *
     * @since 1.1.2
     */
    public function insert_plugin_row_meta($links, $file)
    {
        if($file == 'elementskit/elementskit-lite.php'){
            $links[] = sprintf('<a href="https://go.wpmet.com/ekitdoc" target="_blank">' . esc_html__('Documentation', 'elementskit') . '</a>');
            $links[] = sprintf('<a href="https://go.wpmet.com/ekityoutube" target="_blank">' . esc_html__('Video Tutorials', 'elementskit') . '</a>');
        }
        return $links;
    }


    public function footer_alert_box(){
        include 'views/modal.php';
    }

    public function show_go_pro_notice(){

    $btn['label'] = esc_html__('Go Pro Now', 'elementskit');
    $btn['url'] = 'https://go.wpmet.com/ekitpro';


    ob_start();
    include 'views/notice.php';
    $contents = ob_get_contents();
    ob_clean();


    \ElementsKit\Notice::push(
        [
            'id'          => 'elementskit-go-pro',
            'type'        => 'success',
            'dismissible' => true,
            'btn'		  => $btn,
            'message'     => $contents
        ]
    );
    }
}