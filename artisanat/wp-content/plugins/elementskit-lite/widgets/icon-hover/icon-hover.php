<?php
namespace Elementor;

use \ElementsKit\Elementskit_Widget_Icon_Hover_Handler as Handler;
use \ElementsKit\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if (! defined( 'ABSPATH' ) ) exit;

class Elementskit_Widget_Icon_Hover extends Widget_Base {
    use \ElementsKit\Widgets\Widget_Notice;

    public $base;

    public function get_name() {
        return Handler::get_name();
    }

    public function get_title() {
        return Handler::get_title();
    }

    public function get_icon() {
        return Handler::get_icon();
    }

    public function get_categories() {
        return Handler::get_categories();
    }


    protected function _register_controls() {
        $this->start_controls_section(
            'section_tab', [
                'label' =>esc_html__( 'Icon Hover', 'elementskit' ),
            ]
        );


        $this->end_controls_section();

        $this->insert_pro_message();
    }

    protected function render( ) {
        echo '<div class="ekit-wid-con" >';
        $this->render_raw();
        echo '</div>';
    }

    protected function render_raw( ) {

        $settings = $this->get_settings_for_display();

        extract($settings);

      ?>
        <span class="ekit_creative_icon_box ekit_hover_grow">
            <i class="fa fa-facebook"></i>
        </span>
    <?php }
    protected function _content_template() { }
}