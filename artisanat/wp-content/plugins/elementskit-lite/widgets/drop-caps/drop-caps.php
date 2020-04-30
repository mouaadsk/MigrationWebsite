<?php
namespace Elementor;

use \ElementsKit\Elementskit_Widget_Drop_Caps_Handler as Handler;
use \ElementsKit\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;


class Elementskit_Widget_Drop_Caps extends Widget_Base {
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
            'ekit_dropcaps_content',
            [
                'label' => esc_html__( 'Dropcaps', 'elementskit' ),
            ]
        );

		$this->add_control(
			'ekit_dropcaps_text',
			[
				'label'         => esc_html__( 'Content', 'elementskit' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => esc_html__( 'Lorem ipsum dolor sit amet, consec adipisicing elit, sed do eiusmod tempor incidid ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip exl Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incidid ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 'elementskit' ),
				'placeholder'   => esc_html__( 'Enter Your Drop Caps Content.', 'elementskit' ),
                'separator'=>'before',
                'dynamic' => [
                    'active' => true,
                ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
            'ekit_dropcaps_style_section',
            [
                'label' => esc_html__( 'Style', 'elementskit' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'ekit_content_color',
                [
                    'label' => esc_html__( 'Color', 'elementskit' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#333333',
                    'selectors' => [
                        '{{WRAPPER}} .ekit-dropcap-cotnent' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'ekit_content_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .ekit-dropcap-cotnent',
                ]
            );

            // $this->add_group_control(
            //     Group_Control_Background::get_type(),
            //     [
            //         'name' => 'ekit_content_background',
            //         'label' => esc_html__( 'Background', 'elementskit' ),
            //         'types' => [ 'classic', 'gradient' ],
            //         'selector' => '{{WRAPPER}} .ekit-dropcap-cotnent',
            //     ]
            // );

            // $this->add_responsive_control(
            //     'ekit_content_padding',
            //     [
            //         'label' => esc_html__( 'Padding', 'elementskit' ),
            //         'type' => Controls_Manager::DIMENSIONS,
            //         'size_units' => [ 'px', '%', 'em' ],
            //         'selectors' => [
            //             '{{WRAPPER}} .ekit-dropcap-cotnent' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            //         ],
            //         'separator' =>'before',
            //     ]
            // );

            // $this->add_responsive_control(
            //     'ekit_content_margin',
            //     [
            //         'label' => esc_html__( 'Margin', 'elementskit' ),
            //         'type' => Controls_Manager::DIMENSIONS,
            //         'size_units' => [ 'px', '%', 'em' ],
            //         'selectors' => [
            //             '{{WRAPPER}} .ekit-dropcap-cotnent' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            //         ],
            //     ]
            // );

            // $this->add_group_control(
            //     Group_Control_Border::get_type(),
            //     [
            //         'name' => 'ekit_content_border',
            //         'label' => esc_html__( 'Border', 'elementskit' ),
            //         'selector' => '{{WRAPPER}} .ekit-dropcap-cotnent',
            //     ]
            // );

            // $this->add_responsive_control(
            //     'ekit_content_border_radius',
            //     [
            //         'label' => esc_html__( 'Border Radius', 'elementskit' ),
			// 		'type' => Controls_Manager::DIMENSIONS,
			// 		'size_units' => [ 'px', '%', 'em' ],
            //         'selectors' => [
            //             '{{WRAPPER}} .ekit-dropcap-cotnent' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            //         ],
            //     ]
            // );

        $this->end_controls_section();

        // Style dropcaps latter tab section
        $this->start_controls_section(
            'ekit_dropcaps_latter_style_section',
            [
                'label' => esc_html__( 'Dropcap Latter', 'elementskit' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'ekit_content_dropcaps_color',
                [
                    'label' => esc_html__( 'Color', 'elementskit' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#903',
                    'selectors' => [
                        '{{WRAPPER}} .ekit-dropcap-cotnent:first-child:first-letter' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'ekit_content_dropcaps_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .ekit-dropcap-cotnent:first-child:first-letter',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'ekit_content_dropcaps_background',
                    'label' => esc_html__( 'Background', 'elementskit' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .ekit-dropcap-cotnent:first-child:first-letter',
                ]
            );

            $this->add_responsive_control(
                'ekit_content_dropcaps_padding',
                [
                    'label' => esc_html__( 'Padding', 'elementskit' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ekit-dropcap-cotnent:first-child:first-letter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'ekit_content_dropcaps_margin',
                [
                    'label' => esc_html__( 'Margin', 'elementskit' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ekit-dropcap-cotnent:first-child:first-letter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'ekit_content_dropcaps_border',
                    'label' => esc_html__( 'Border', 'elementskit' ),
                    'selector' => '{{WRAPPER}} .ekit-dropcap-cotnent:first-child:first-letter',
                ]
            );

            $this->add_responsive_control(
                'ekit_content_dropcaps_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'elementskit' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ekit-dropcap-cotnent:first-child:first-letter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
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
		?>
		<div class="ekit-dropcap-wraper">
			<?php if( !empty( $settings['ekit_dropcaps_text'] ) ) : ?>
			<p class="ekit-dropcap-cotnent"><?php echo \ElementsKit\Utils::kses($settings['ekit_dropcaps_text'])?></p>
			<?php endif; ?>
		</div>
        <?php
    }

    protected function _content_template() { }
}