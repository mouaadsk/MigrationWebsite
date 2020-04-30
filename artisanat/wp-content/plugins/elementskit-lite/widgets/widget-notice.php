<?php 
namespace ElementsKit\Widgets;
defined( 'ABSPATH' ) || exit;

trait Widget_Notice{
    /**
     * Adding Go Pro message to all widgets
     *
     * @since 1.4.2
     */
    public function insert_pro_message()
    {
        if(\ElementsKit::PACKAGE_TYPE != 'pro'){
            $this->start_controls_section(
                'ekit_section_pro',
                [
                    'label' => __('Go Pro for More Features', 'elementskit'),
                ]
            );

            $this->add_control(
                'ekit_control_get_pro',
                [
                    'label' => __('Unlock more possibilities', 'elementskit'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        '1' => [
                            'title' => __('', 'elementskit'),
                            'icon' => 'fa fa-unlock-alt',
                        ],
                    ],
                    'default' => '1',
                    'description' => '<span class="ekit-widget-pro-feature"> Get the  <a href="http://go.wpmet.com/ekit-pro-widget-message" target="_blank">Pro version</a> for more awesome elements and powerful modules.</span>',
                ]
            );

            $this->end_controls_section();
        }
    }
}