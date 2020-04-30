<?php
namespace Elementor;

use \ElementsKit\Elementskit_Widget_We_Forms_Handler as Handler;
use \ElementsKit\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if (! defined( 'ABSPATH' ) ) exit;

class Elementskit_Widget_We_Forms extends Widget_Base {
    use \ElementsKit\Widgets\Widget_Notice;

    public $base;
    
    public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );
		$this->add_script_depends('weforms');
    }
    
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
            'ekit_weform_section_tab', [
                'label' =>esc_html__( 'weForm', 'elementskit' ),
            ]
        );

        $this->add_control(
            'ekit_weform_form_id',
            [
                'label' => __( 'Select Your Form', 'elementskit' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'default' => '0',
				'options' => \ElementsKit\Utils::ekit_get__forms('wpuf_contact_form'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ekit_weform__section_fields_style',
            [
                'label' => __( 'Fields', 'elementskit' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
		);

        $this->add_responsive_control(
            'ekit_weform_large_field_width',
            [
                'label' => __( 'Input Width', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'unit' => '%',
                    'size' => 99
                ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 800,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form li .wpuf-fields input[type="text"],
					 {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form li .wpuf-fields input[type="password"],
					 {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form li .wpuf-fields input[type="email"],
					 {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form li .wpuf-fields input[type="url"],
					 {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form li .wpuf-fields input[type="url"],
                     {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form li .wpuf-fields input[type="number"],
                     {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ekit_weform_field_margin',
            [
                'label' => __( 'Input Spacing', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpuf-el:not(.wpuf-submit)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ekit_weform_field_padding',
            [
                'label' => __( 'Padding', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpuf-fields input:not(.weforms_submit_btn)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ekit_weform_field_border_radius',
            [
                'label' => __( 'Border Radius', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpuf-fields input:not(.weforms_submit_btn), {{WRAPPER}} .wpuf-fields textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ekit_weform_field_typography',
                'label' => __( 'Typography', 'elementskit' ),
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields input:not(.weforms_submit_btn), .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3
            ]
        );

        $this->add_control(
            'ekit_weform_field_textcolor',
            [
                'label' => __( 'Input Text Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields input:not(.weforms_submit_btn), {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea' => 'color: {{VALUE}};',
                ],
            ]
		);

		$this->add_control(
            'ekit_weform_field_placeholder_color',
            [
                'label' => __( 'Input Placeholder Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ::-webkit-input-placeholder'	=> 'color: {{VALUE}};',
                    '{{WRAPPER}} ::-moz-placeholder'			=> 'color: {{VALUE}};',
                    '{{WRAPPER}} ::-ms-input-placeholder'		=> 'color: {{VALUE}};',
                ],
            ]
		);

		$this->start_controls_tabs( 'ekit_weform_tabs_field_state' );

        $this->start_controls_tab(
            'ekit_weform_tab_field_normal',
            [
                'label' => __( 'Normal', 'elementskit' ),
            ]
		);

		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ekit_weform_field_border',
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields input:not(.weforms_submit_btn), {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea',
            ]
        );

		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ekit_weform_field_box_shadow',
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields input:not(.weforms_submit_btn), {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea',
            ]
        );

        $this->add_control(
            'ekit_weform_field_bg_color',
            [
                'label' => __( 'Background Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields input:not(.weforms_submit_btn), {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea' => 'background-color: {{VALUE}}',
                ],
            ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
            'ekit_weform_tab_field_focus',
            [
                'label' => __( 'Focus', 'elementskit' ),
            ]
		);

		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ekit_weform_field_focus_border',
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields input:focus:not(.weforms_submit_btn), {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea:focus',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ekit_weform_field_focus_box_shadow',
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields input:focus:not(.weforms_submit_btn), {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea:focus',
            ]
		);

		$this->add_control(
            'ekit_weform_field_focus_bg_color',
            [
                'label' => __( 'Background Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields input:focus:not(.weforms_submit_btn), {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-fields textarea:focus' => 'background-color: {{VALUE}}',
                ],
            ]
        );

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();


        $this->start_controls_section(
            'ekit_weform_form-label',
            [
                'label' => __( 'Label', 'elementskit' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ekit_weform_label_margin',
            [
                'label' => __( 'Margin', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} ul.wpuf-form.form-label-above li .wpuf-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ekit_weform_label_padding',
            [
                'label' => __( 'Padding', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} ul.wpuf-form.form-label-above li .wpuf-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ekit_weform_hr3',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ekit_weform_label_typography',
                'label' => __( 'Label Typography', 'elementskit' ),
                'selector' => '{{WRAPPER}} .wpuf-label label, {{WRAPPER}} .wpuf-form-sub-label',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3
            ]
        );

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ekit_weform_desc_typography',
                'label' => __( 'Help Text Typography', 'elementskit' ),
                'selector' => '{{WRAPPER}} .wpuf-fields .wpuf-help',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3
            ]
        );

        $this->add_control(
            'ekit_weform_label_color',
            [
                'label' => __( 'Label Text Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpuf-label label, {{WRAPPER}} .wpuf-form-sub-label' => 'color: {{VALUE}}',
                ],
            ]
		);

		$this->add_control(
            'ekit_weform_requered_label',
            [
                'label' => __( 'Required Label Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpuf-label .required' => 'color: {{VALUE}} !important',
                ],
            ]
        );

		$this->add_control(
            'ekit_weform_desc_color',
            [
                'label' => __( 'Help Text Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpuf-fields .wpuf-help' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ekit_weform_submit',
            [
                'label' => __( 'Button', 'elementskit' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
		);

        $this->add_control(
            'ekit_weform_submit_btn_width',
            [
                'label' => __( 'Button Full Width?', 'elementskit' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'elementskit' ),
                'label_off' => __( 'No', 'elementskit' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_responsive_control(
            'ekit_weform_button_width',
            [
                'label' => __( 'Button Width', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'condition' => [
                    'ekit_weform_submit_btn_width' => 'yes'
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100
                ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 800,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit .weforms_submit_btn' => 'display: block; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'ekit_weform_submit_btn_position',
            [
                'label' => __( 'Button Position', 'elementskit' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'elementskit' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'elementskit' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'elementskit' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'condition' => [
                    'ekit_weform_submit_btn_width' => ''
                ],
                'desktop_default' => 'left',
                'toggle' => false,
				'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit' => 'text-align: {{Value}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ekit_weform_submit_margin',
            [
                'label' => __( 'Margin', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ekit_weform_submit_padding',
            [
                'label' => __( 'Padding', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ekit_weform_submit_typography',
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ekit_weform_submit_border',
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]',
            ]
        );

        $this->add_control(
            'ekit_weform_submit_border_radius',
            [
                'label' => __( 'Border Radius', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ekit_weform_submit_box_shadow',
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]',
            ]
        );

		$this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'ekit_weform_submit_text_shadow',
                'selector' => '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]',
            ]
        );

        $this->add_control(
            'ekit_weform_hr4',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->start_controls_tabs( 'ekit_weform_tabs_button_style' );

        $this->start_controls_tab(
            'ekit_weform_tab_button_normal',
            [
                'label' => __( 'Normal', 'elementskit' ),
            ]
        );

        $this->add_control(
            'ekit_weform_submit_color',
            [
                'label' => __( 'Text Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ekit_weform_submit_bg_color',
            [
                'label' => __( 'Background Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ekit_weform_tab_button_hover',
            [
                'label' => __( 'Hover', 'elementskit' ),
            ]
        );

        $this->add_control(
            'ekit_weform_submit_hover_color',
            [
                'label' => __( 'Text Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]:hover, {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ekit_weform_submit_hover_bg_color',
            [
                'label' => __( 'Background Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]:hover, {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ekit_weform_submit_hover_border_color',
            [
                'label' => __( 'Border Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]:hover, {{WRAPPER}} .wpuf-form-add.wpuf-style ul.wpuf-form .wpuf-submit input[type=submit]:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->insert_pro_message();
    }

    protected function render( ) {
        $settings = $this->get_settings();
			

		if ( ! empty( $settings['ekit_weform_form_id'] ) ) {
            echo \ElementsKit\Utils::ekit_do_shortcode( 'weforms', [
                'id' => $settings['ekit_weform_form_id'],
            ] );
		}

	}
    protected function _content_template() { }
}