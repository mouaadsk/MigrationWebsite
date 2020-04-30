<?php

namespace Elementor;

use \ElementsKit\Elementskit_Widget_Image_Box_Handler as Handler;
use \ElementsKit\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Elementskit_Widget_Image_Box extends Widget_Base {
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

        // start content section for set Image
        $this->start_controls_section(
            'ekit_image_box_section_infoboxwithimage',
            [
                'label' => esc_html__( 'Image', 'elementskit' ),
            ]
        );

        // Image insert
        $this->add_control(
            'ekit_image_box_image',
            [
                'label' => esc_html__( 'Choose Image', 'elementskit' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

		$this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'ekit_image_box_thumbnail',
                'default' => 'full',
                'separator' => 'none',
            ]
        );

        //  simple  style

        $this->add_control(
            'ekit_image_box_style_simple',
            [
                'label' => esc_html__( 'Content Area', 'elementskit' ),
                'type' =>  Controls_Manager::SELECT,
                'default' => 'simple-card',
                'options' => [
                    'simple-card'  => esc_html__( 'Simple', 'elementskit' ),
                    'style-modern' => esc_html__( 'Classic Curves', 'elementskit' ),
                    'floating-style' => esc_html__( 'Floating box', 'elementskit' ),
                    'hover-border-bottom' => esc_html__( 'Hover Border', 'elementskit' ),
                    'style-sideline' => esc_html__( 'Side Line', 'elementskit' ),
                    'shadow-line' => esc_html__( 'Shadow line', 'elementskit' ),
                ],
            ]
        );

        $this->add_control(
            'ekit_image_box_enable_link',
            [
                'label' => esc_html__( 'Enable Link', 'elementskit' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'elementskit' ),
                'label_off' => esc_html__( 'No', 'elementskit' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'ekit_image_box_website_link',
            [
                'label' => esc_html__( 'Link', 'elementskit' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'elementskit' ),
                'show_external' => true,
                'condition' => [
                    'ekit_image_box_enable_link' => 'yes'
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

         // end content section for set Image
        $this->end_controls_section();


        // start content section for image title and sub title
        $this->start_controls_section(
            'ekit_image_box_section_for_image_title',
            [
                'label' => esc_html__( 'Body', 'elementskit' ),
            ]
        );

        $this->add_control(
            'ekit_image_box_title_text',
            [
                'label' => esc_html__( 'Title ', 'elementskit' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'This is the heading', 'elementskit' ),
                'placeholder' => esc_html__( 'Enter your title', 'elementskit' ),
                'label_block' => true,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ekit_image_box_front_title_icons__switch',
            [
                'label' => esc_html__('Add icon? ', 'elementskit'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' =>esc_html__( 'Yes', 'elementskit' ),
                'label_off' =>esc_html__( 'No', 'elementskit' ),
                'condition' => [
                    'ekit_image_box_style_simple' => 'floating-style',
                ]
            ]
		);

        $this->add_control(
            'ekit_image_box_front_title_icons',
            [
                'label' => esc_html__( 'Title Icon', 'elementskit' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'ekit_image_box_front_title_icon',
                'default' => [
                    'value' => 'icon icon-review',
                    'library' => 'ekiticons',
                ],
                'condition' => [
                    'ekit_image_box_style_simple' => 'floating-style',
                    'ekit_image_box_front_title_icons__switch'  => 'yes'
                ]
            ]
        );

        $this->add_control(
            'ekit_image_box_front_title_icon_position',
            [
                'label' => esc_html__( 'Title Icon Position', 'elementskit' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' =>esc_html__( 'Before', 'elementskit' ),
                    'right' =>esc_html__( 'After', 'elementskit' ),
                ],
                'condition' => [
                    'ekit_image_box_front_title_icons__switch'  => 'yes',
                    'ekit_image_box_style_simple' => 'floating-style',
                ]
            ]
        );

        // title tag
        $this->add_control(
            'ekit_image_box_title_size',
            [
                'label' => esc_html__( 'Title HTML Tag', 'elementskit' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h3',
            ]
        );

        $this->add_control(
            'ekit_image_box_description_text',
            [
                'label' => esc_html__( 'Description', 'elementskit' ),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'Click edit  to change this text. Lorem ipsum dolor sit amet, cctetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementskit' ),
                'placeholder' => esc_html__( 'Enter your description', 'elementskit' ),
                'separator' => 'none',
                'rows' => 10,
                'show_label' => false,
            ]
        );

        // Text aliment

        $this->add_control(
            'ekit_image_box_content_text_align',
            [
                'label' => esc_html__( 'Alignment', 'elementskit' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'elementskit' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'elementskit' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'elementskit' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
            ]
        );

         // end content section for image title and sub title
        $this->end_controls_section();

         // start content section for button
         //  Section Button

        $this->start_controls_section(
            'ekit_image_box_section_button',
            [
                'label' => esc_html__( 'Button', 'elementskit' ),
            ]
        );
        $this->add_control(
			'ekit_image_box_enable_btn',
			[
				'label' => esc_html__( 'Enable Button', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);
        $this->add_control(
			'ekit_image_box_btn_text',
			[
				'label' =>esc_html__( 'Label', 'elementskit' ),
				'type' => Controls_Manager::TEXT,
				'default' =>esc_html__( 'Learn more ', 'elementskit' ),
				'placeholder' =>esc_html__( 'Learn more ', 'elementskit' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'ekit_image_box_enable_btn' => 'yes',
                ]
			]
		);


		$this->add_control(
			'ekit_image_box_btn_url',
			[
				'label' =>esc_html__( 'URL', 'elementskit' ),
				'type' => Controls_Manager::URL,
				'placeholder' =>esc_url('http://your-link.com'),
				'default' => [
                    'url' => '#',
                    'is_external' => true,
					'nofollow' => true,
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'ekit_image_box_enable_btn' => 'yes',
                ]
			]
        );
        $this->add_control(
            'ekit_image_box_icons__switch',
            [
                'label' => esc_html__('Add icon? ', 'elementskit'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' =>esc_html__( 'Yes', 'elementskit' ),
                'label_off' =>esc_html__( 'No', 'elementskit' ),
                'condition' => [
                    'ekit_image_box_enable_btn' => 'yes',
                ]
            ]
		);
        $this->add_control(
			'ekit_image_box_icons',
			[
				'label' =>esc_html__( 'Icon', 'elementskit' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'ekit_image_box_icon',
                'default' => [
                    'value' => '',
                ],
				'label_block' => true,
                'condition' => [
                    'ekit_image_box_enable_btn' => 'yes',
                    'ekit_image_box_icons__switch' => 'yes'
                ]
			]
		);
		$this->add_control(
			'ekit_image_box_icon_align',
			[
				'label' =>esc_html__( 'Icon Position', 'elementskit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' =>esc_html__( 'Before', 'elementskit' ),
					'right' =>esc_html__( 'After', 'elementskit' ),
				],
				'condition' => [
                    'ekit_image_box_icons__switch' => 'yes',
                    'ekit_image_box_enable_btn' => 'yes',
				],
			]
		);
        // end content section for button
        $this->end_controls_section();

        // start style section here


        // start floating box style
        $this->start_controls_section(
			'ekit_image_box_image_floating_box',
			[
				'label' => esc_html__( 'Floating Style', 'elementskit' ),
                'tab' =>  Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ekit_image_box_style_simple' => 'floating-style',
                ]
			]
        );

        $this->start_controls_tabs(
            'ekit_image_box_image_floating_box_heights'
        );

        $this->start_controls_tab(
            'ekit_image_box_image_floating_box_normal_height_tab',
            [
                'label' => esc_html__( 'Normal', 'elementskit' ),
            ]
        );

        $this->add_responsive_control(
			'ekit_image_box_image_floating_box_height',
			[
				'label' => esc_html__( 'Height', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 90,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-info-image-box.floating-style .elementskit-box-body' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
            'ekit_image_box_image_floating_box_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementskit-info-image-box.floating-style .elementskit-box-body .elementskit-info-box-title > i ' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementskit-info-image-box.floating-style .elementskit-box-body .elementskit-info-box-title > svg path' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ekit_image_box_image_floating_box_hover_height_tab',
            [
                'label' => esc_html__( 'Hover', 'elementskit' ),
            ]
        );

        $this->add_responsive_control(
			'ekit_image_box_image_floating_box_hover_height',
			[
				'label' => esc_html__( 'Hover Height', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 185,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-info-image-box.floating-style:hover .elementskit-box-body' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
            'ekit_image_box_image_floating_box_icon_color_hover',
            [
                'label' => esc_html__( 'Icon Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementskit-info-image-box.floating-style:hover .elementskit-box-body .elementskit-info-box-title > i ' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementskit-info-image-box.floating-style:hover .elementskit-box-body .elementskit-info-box-title > svg path' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
			'ekit_image_box_image_floating_box_tab_separetor',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
        );
        
        $this->add_responsive_control(
			'ekit_image_box_image_floating_box_icon_font_size',
			[
				'label' => esc_html__( 'Icon Font Size', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 26,
				],
				'selectors' => [
                    '{{WRAPPER}} .elementskit-info-image-box.floating-style .elementskit-box-body .elementskit-info-box-title > i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementskit-info-image-box.floating-style .elementskit-box-body .elementskit-info-box-title > svg'    => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);


        $this->add_responsive_control(
			'ekit_image_box_image_floating_box_margin_top',
			[
				'label' => esc_html__( 'Margin Top', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => -40,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-info-image-box.floating-style .elementskit-box-body' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'ekit_image_box_image_floating_box_width',
			[
				'label' => esc_html__( 'Width', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 90,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-info-image-box.floating-style .elementskit-box-body' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_image_box_image_floating_box_background',
				'label' => esc_html__( 'Background', 'elementskit' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elementskit-info-image-box.floating-style .elementskit-box-body, {{WRAPPER}} .elementskit-info-image-box.floating-style .elementskit-box-body::before, {{WRAPPER}} .elementskit-info-image-box.floating-style .elementskit-box-body::after',
			]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ekit_image_box_image_floating_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'elementskit' ),
                'selector' => '{{WRAPPER}} .elementskit-info-image-box.floating-style .elementskit-box-body, .elementskit-info-image-box.floating-style .elementskit-box-body::before, .elementskit-info-image-box.floating-style .elementskit-box-body::after',
            ]
        );

        $this->end_controls_section();

         // start classic curves style
        $this->start_controls_section(
			'ekit_image_box_image_classic_curves',
			[
				'label' => esc_html__( 'Classic Curves', 'elementskit' ),
                'tab' =>  Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ekit_image_box_style_simple' => 'style-modern',
                ]
			]
		);

        $this->add_responsive_control(
			'ekit_image_box_image_classic_curves_width',
			[
				'label' => esc_html__( 'Width', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-info-image-box.style-modern .elementskit-box-body' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'ekit_image_box_image_classic_curves_margin',
			[
				'label' => esc_html__( 'Margin', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => -20,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-info-image-box.style-modern .elementskit-box-body' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->end_controls_section();

        // start border bottom hover style
        $this->start_controls_section(
			'ekit_image_box_border_bottom_hover',
			[
				'label' => esc_html__( 'Hover Border Bottom', 'elementskit' ),
                'tab' =>  Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ekit_image_box_style_simple' => 'hover-border-bottom',
                ]
			]
		);

        $this->add_responsive_control(
			'ekit_image_box_border_hover_height',
			[
				'label' => esc_html__( 'Border Bottom Height', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 3,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-info-image-box.hover-border-bottom .elementskit-box-body::before' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ekit_image_box_style_simple' => 'hover-border-bottom',
                ]
			]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_image_box_border_hover_background',
				'label' => esc_html__( 'Background', 'elementskit' ),
				'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .elementskit-info-image-box.hover-border-bottom .elementskit-box-body::before',
                'condition' => [
                    'ekit_image_box_style_simple' => 'hover-border-bottom',
                ]
			]
		);

        $this->add_control(
			'ekit_image_box_border_hover_background_direction',
			[
				'label' => esc_html__( 'Hover Direction', 'elementskit' ),
				'type' =>   Controls_Manager::CHOOSE,
				'options' => [
					'hover_from_left' => [
						'title' => esc_html__( 'From Left', 'elementskit' ),
						'icon' => 'fa fa-caret-right',
                    ],
                    'hover_from_center' => [
						'title' => esc_html__( 'From Center', 'elementskit' ),
						'icon' => 'fa fa-align-center',
					],
					'hover_from_right' => [
						'title' => esc_html__( 'From Right', 'elementskit' ),
						'icon' => 'fa fa-caret-left',
					],
				],
				'default' => 'hover_from_right',
				'toggle' => true,
				'condition'  => [
					'ekit_image_box_style_simple' => 'hover-border-bottom',
				]
			]
        );

        $this->end_controls_section();

         // start side line style
        $this->start_controls_section(
			'ekit_image_box_image_side_line',
			[
				'label' => esc_html__( 'Side Line', 'elementskit' ),
                'tab' =>  Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ekit_image_box_style_simple' => 'style-sideline',
                ]
			]
        );

		$this->add_responsive_control(
            'ekit_image_box_image_side_line_border',
            [
                'label' => esc_html__( 'Border Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementskit-info-image-box.style-sideline .elementskit-box-body .elementskit-box-content ' => 'border-left-color: {{VALUE}}',
                ],
            ]
        );

		$this->add_responsive_control(
            'ekit_image_box_image_side_line_border_width',
            [
                'label' => esc_html__( 'Border Width', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 3,
				],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-info-image-box.style-sideline .elementskit-box-body .elementskit-box-content ' => 'border-left-width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

		$this->add_responsive_control(
            'ekit_image_box_image_side_line_border_type',
            [
                'label' => esc_html__( 'Border Type', 'elementskit' ),
                'type' => Controls_Manager::SELECT,
				'default' => 'solid',
                'options' => [
                    'none' =>esc_html__( 'None', 'elementskit' ),
                    'solid' =>esc_html__( 'Solid', 'elementskit' ),
                    'double' =>esc_html__( 'Double', 'elementskit' ),
                    'dotted' =>esc_html__( 'Dotted', 'elementskit' ),
                    'dashed' =>esc_html__( 'Dashed', 'elementskit' ),

                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-info-image-box.style-sideline .elementskit-box-body .elementskit-box-content ' => 'border-left-style: {{VALUE}}',
                ],
            ]
        );

		$this->end_controls_section();

        // start line shadow style
        $this->start_controls_section(
			'ekit_image_box_image_shadow_line',
			[
				'label' => esc_html__( 'Shadow Line', 'elementskit' ),
                'tab' =>  Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ekit_image_box_style_simple' => 'shadow-line',
                ]
			]
        );

        $this->start_controls_tabs(
            'ekit_image_box_image_shadow_line_tabs'
        );

        $this->start_controls_tab(
            'ekit_image_box_image_shadow_line_left_tab',
            [
                'label' => esc_html__( 'Left Line', 'elementskit' ),
            ]
        );

		$this->add_responsive_control(
			'ekit_image_box_image_shadow_left_line_width',
			[
				'label' => esc_html__( 'Width', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-info-image-box.shadow-line .elementskit-box-body::before' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ekit_image_box_image_shadow_left_line_shadow',
                'label' => esc_html__( 'Box Shadow', 'elementskit' ),
                'selector' => '{{WRAPPER}} .elementskit-info-image-box.shadow-line .elementskit-box-body::before',
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_image_box_image_shadow_left_line_background',
				'label' => esc_html__( 'Background', 'elementskit' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elementskit-info-image-box.shadow-line .elementskit-box-body::before',
			]
        );

        $this->end_controls_tab();

        // right line
        $this->start_controls_tab(
            'ekit_image_box_image_shadow_line_right_tab',
            [
                'label' => esc_html__( 'Right Line', 'elementskit' ),
            ]
        );

		$this->add_responsive_control(
			'ekit_image_box_image_shadow_right_line_width',
			[
				'label' => esc_html__( 'Width', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-info-image-box.shadow-line .elementskit-box-body::after' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ekit_image_box_image_shadow_right_line_shadow',
                'label' => esc_html__( 'Box Shadow', 'elementskit' ),
                'selector' => '{{WRAPPER}} .elementskit-info-image-box.shadow-line .elementskit-box-body::after',
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_image_box_image_shadow_right_line_background',
				'label' => esc_html__( 'Background', 'elementskit' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elementskit-info-image-box.shadow-line .elementskit-box-body::after',
			]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        // start image section style
        $this->start_controls_section(
            'ekit_image_box_image_section',
            [
                'label' => esc_html__( 'Image', 'elementskit' ),
                'tab' =>  Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'ekit_image_box_border_radius',
			[
				'label' => esc_html__( 'Border radius', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-box-header img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'ekit_image_box_padding',
			[
				'label' => esc_html__( 'Padding', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-box-header img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->start_controls_tabs(
            'ekit_image_box_style_tabs_image'
        );

        $this->start_controls_tab(
            'ekit_image_box_style_normal_tab_image',
            [
                'label' => esc_html__( 'Normal', 'elementskit' ),
            ]
        );

        $this->add_responsive_control(
            'ekit_image_box_image_opacity',
            [
                'label' => esc_html__( 'Image opacity', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => .01,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-info-image-box  .elementskit-box-header img' => 'opacity: {{SIZE}};',
                    '{{WRAPPER}} .elementskit-info-image-box.elementskit-thumb-card >  img' => 'opacity: {{SIZE}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'ekit_image_box_style_hover_tab_image',
            [
                'label' => esc_html__( 'Hover', 'elementskit' ),
            ]
        );

        $this->add_responsive_control(
            'ekit_image_box_image_opacity_hover',
            [
                'label' => esc_html__( 'Image opacity', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => .01,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1.1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-info-image-box:hover  .elementskit-box-header img' => 'opacity: {{SIZE}};',
                    '{{WRAPPER}} .elementskit-info-image-box.elementskit-thumb-card:hover >  img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ekit_image_box_image_scale_on_hover',
            [
                'label' => esc_html__( 'Image Scale on Hover', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 2,
                        'step' => .1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1.1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-info-image-box:hover  .elementskit-box-header img' => 'transform: scale({{SIZE}});',
                    '{{WRAPPER}} .elementskit-info-image-box.elementskit-thumb-card:hover >  img' => 'transform: scale({{SIZE}});',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
        //end image section style

        // start body style section
        $this->start_controls_section(
            'ekit_image_box_style_body_section',
            [
                'label' => esc_html__( 'Body', 'elementskit' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_control(
			'ekit_imagebox_genaral_border_heading_title',
			[
				'label' => esc_html__( 'Genaral', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ekit_imagebox_container_border_group',
                'label' => esc_html__( 'Border', 'elementskit' ),
                'selector' => '{{WRAPPER}} .elementskit-info-image-box .elementskit-box-body',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ekit_imagebox_container_background',
                'label' => esc_html__( 'Background', 'elementskit' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .elementskit-info-image-box .elementskit-box-body',
            ]
        );

        $this->add_responsive_control(
			'ekit_imagebox_container_spacing',
			[
				'label' => esc_html__( 'Padding', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-info-image-box .elementskit-box-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ekit_image_box_shadow_group',
                'selector' => '{{WRAPPER}} .elementskit-info-image-box .elementskit-box-body',
            ]
        );

		// title
		$this->add_control(
			'ekit_imagebox_title_border_heading_title',
			[
				'label' => esc_html__( 'Title', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
			]
        );
        
        $this->start_controls_tabs('ekit_image_box_style_heading_tabs');

        $this->start_controls_tab(
            'ekit_image_box_style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'elementskit' ),
            ]
        );

        $this->add_responsive_control(
            'ekit_image_box_title_bottom_space',
			[
                'label' => esc_html__( 'Spacing', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
                'default' => [  
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '20',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => 'true',
                ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-info-image-box .elementskit-info-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


        $this->add_responsive_control(
            'ekit_image_box_heading_color',
            [
                'label' => esc_html__( 'Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementskit-info-image-box .elementskit-info-box-title ' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementskit-info-image-box .elementskit-info-box-title a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementskit-info-image-box .elementskit-info-box-title svg path'    => 'stroke: {{VALUE}}; fill: {{VALUE}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ekit_image_box_title_typography',
                'label' => esc_html__( 'Typography', 'elementskit' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .elementskit-info-image-box .elementskit-info-box-title, {{WRAPPER}} .elementskit-info-image-box .elementskit-info-box-title a',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ekit_image_box_style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'elementskit' ),
            ]
        );

        $this->add_responsive_control(
            'ekit_image_box_heading_color_hover',
            [
                'label' => esc_html__( 'Hover Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementskit-info-image-box:hover .elementskit-info-box-title ' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementskit-info-image-box:hover .elementskit-info-box-title a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementskit-info-image-box:hover .elementskit-info-box-title svg path'    => 'stroke: {{VALUE}}; fill: {{VALUE}};'
                ],
            ]
        );

		$this->end_controls_tabs();

		// sub Description
		$this->add_control(
			'ekit_imagebox_description_border_heading_title',
			[
				'label' => esc_html__( 'Description', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
			]
		);
        $this->start_controls_tabs('ekit_image_box_style_description_tabs');

        $this->start_controls_tab(
            'ekit_image_box_style_normal_tab_description',
            [
                'label' => esc_html__( 'Normal', 'elementskit' ),
            ]
        );

        $this->add_responsive_control(
            'ekit_image_box_title_bottom_space_description',
			[
                'label' => esc_html__( 'Spacing', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
                'default' => [  
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '14',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => 'true',
                ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-info-image-box .elementskit-box-style-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'ekit_image_box_heading_color_description',
            [
                'label' => esc_html__( 'Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementskit-info-image-box .elementskit-box-style-content' => 'color: {{VALUE}}',

                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ekit_image_box_title_typography_description',
                'label' => esc_html__( 'Typography', 'elementskit' ),
                'selector' => '{{WRAPPER}} .elementskit-info-image-box .elementskit-box-style-content',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ekit_image_box_style_hover_tab_description',
            [
                'label' => esc_html__( 'Hover', 'elementskit' ),
            ]
        );

        $this->add_responsive_control(
            'ekit_image_box_heading_color_hover_description',
            [
                'label' => esc_html__( 'Hover Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementskit-info-image-box:hover .elementskit-box-style-content ' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // start style csetion for button
        // Button

        $this->start_controls_section(
            'ekit_image_box_section_style',
            [
                'label' => esc_html__( 'Button', 'elementskit' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ekit_image_box_enable_btn' => 'yes',
                ]
            ]
        );
        $this->add_responsive_control(
			'ekit_image_box_text_padding',
			[
				'label' =>esc_html__( 'Padding', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-info-image-box .elementskit-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ekit_image_box_typography_group',
				'label' =>esc_html__( 'Typography', 'elementskit' ),
				'selector' => '{{WRAPPER}} .elementskit-info-image-box .elementskit-btn',
			]
		);
        $this->add_responsive_control(
			'ekit_image_box_btn_icon_font_size',
			array(
				'label'      => esc_html__( 'Icon Font Size', 'elementskit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array(
					'px', 'em', 'rem',
				),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors'  => array(
                    '{{WRAPPER}} .elementskit-info-image-box .elementskit-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementskit-info-image-box .elementskit-btn svg'  => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'ekit_image_box_tab_button_normal',
            [
                'label' => esc_html__( 'Normal', 'elementskit' ),
            ]
        );

        $this->add_responsive_control(
            'ekit_image_box_button_text_color',
            [
                'label' => esc_html__( 'Text Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-info-image-box .elementskit-btn' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementskit-info-image-box .elementskit-btn svg path' => 'stroke: {{VALUE}}; fill: {{VALUE}};', 
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ekit_image_box_btn_background_group',
                'label' => esc_html__( 'Background', 'elementskit' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .elementskit-info-image-box .elementskit-btn',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ekit_image_box_button_border_color_group',
                'label' => esc_html__( 'Border', 'elementskit' ),
                'selector' => '{{WRAPPER}} .elementskit-info-image-box .elementskit-btn',
            ]
        );
        $this->add_responsive_control(
			'ekit_image_box_btn_border_radius',
			[
				'label' =>esc_html__( 'Border Radius', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'default' => [
					'top' => '',
					'right' => '',
					'bottom' => '' ,
					'left' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-info-image-box .elementskit-btn' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ekit_image_box_button_box_shadow',
                'selector' => '{{WRAPPER}} .elementskit-info-image-box .elementskit-btn',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ekit_image_box_tab_button_hover',
            [
                'label' => esc_html__( 'Hover', 'elementskit' ),
            ]
        );

        $this->add_responsive_control(
            'ekit_image_box_btn_hover_color',
            [
                'label' => esc_html__( 'Text Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementskit-info-image-box:hover .elementskit-btn' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementskit-info-image-box:hover .elementskit-btn svg path' => 'stroke: {{VALUE}}; fill: {{VALUE}};', 
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ekit_image_box_btn_background_hover_group',
                'label' => esc_html__( 'Background', 'elementskit' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .elementskit-info-image-box:hover .elementskit-btn',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ekit_image_box_button_border_hv_color_group',
                'label' => esc_html__( 'Border', 'elementskit' ),
                'selector' => '{{WRAPPER}} .elementskit-info-image-box:hover .elementskit-btn',
            ]
        );
        $this->add_responsive_control(
			'ekit_image_box_btn_hover_border_radius',
			[
				'label' =>esc_html__( 'Border Radius', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'default' => [
					'top' => '',
					'right' => '',
					'bottom' => '' ,
					'left' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-info-image-box:hover .elementskit-btn' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ekit_image_box_button_box_shadow_hover_group',
                'selector' => '{{WRAPPER}} .elementskit-info-image-box:hover .elementskit-btn',
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->end_controls_section();

        // end style section for buttun

        $this->insert_pro_message();

    }

    protected function render( ) {
        echo '<div class="ekit-wid-con" >';
            $this->render_raw();
        echo '</div>';
    }

    protected function render_raw( ) {

        $settings = $this->get_settings_for_display();

        // Wrapper settion

        $this->add_render_attribute('wrapper', 'class', 'elementskit-info-image-box');
        $this->add_render_attribute('wrapper', 'class', 'text-' . $settings['ekit_image_box_content_text_align']);


        if ($settings['ekit_image_box_style_simple'] == 'hover-border-bottom') {

            $this->add_render_attribute('wrapper', 'class', $settings['ekit_image_box_border_hover_background_direction']);
        }
        $this->add_render_attribute('wrapper', 'class', $settings['ekit_image_box_style_simple']);



        // Image sectionn
		$image_html = '';
        if (!empty($settings['ekit_image_box_image']['url'])) {

            $this->add_render_attribute('image', 'src', $settings['ekit_image_box_image']['url']);
            $this->add_render_attribute('image', 'alt', Control_Media::get_image_alt($settings['ekit_image_box_image']));
            $this->add_render_attribute('image', 'title', Control_Media::get_image_title($settings['ekit_image_box_image']));

			$image_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'ekit_image_box_thumbnail', 'ekit_image_box_image' );
        }

        // Image  wrapper
        $link_wrapper_start = '';
        $link_wrapper_end = '';

        if (($settings['ekit_image_box_enable_btn'] == 'yes')) {
            $link_wrapper_start .= '<a ' . $this->get_render_attribute_string('link') . '>';
            $link_wrapper_end .= ' </a>';
        }


        // Button
        $btn_text = $settings['ekit_image_box_btn_text'];
        $btn_url = (! empty( $settings['ekit_image_box_btn_url']['url'])) ? $settings['ekit_image_box_btn_url']['url'] : '';

        $image_pos = 'image-box-img-'.$settings['ekit_image_box_content_text_align'];
?>

            <div <?php echo \ElementsKit\Utils::render($this->get_render_attribute_string('wrapper')); ?> >

                <?php if($settings['ekit_image_box_enable_link'] == 'yes' && isset($settings['ekit_image_box_website_link']['url'])) {
                    $img_nofollow = (( $settings['ekit_image_box_website_link']['nofollow'] == 'on') ? 'nofollow' : '');    
                    $img_target = (($settings['ekit_image_box_website_link']['is_external'] == 'on') ? '_blank' : '');
                    $img_url = $settings['ekit_image_box_website_link']['url'];

                    echo "<a href='".esc_url($img_url)."' rel='". esc_attr($img_nofollow) ."' target='".esc_attr($img_target)."'>";
                }
                ?>

                <div class="elementskit-box-header <?php echo \ElementsKit\Utils::render($image_pos); ?>">

                    <?php echo  \ElementsKit\Utils::render($image_html); ?>

                </div>
                <?php if($settings['ekit_image_box_enable_link'] == 'yes' && isset($settings['ekit_image_box_website_link']['url'])) {
                    echo "</a>";
                } ?>

                <div class="elementskit-box-body">
                    <div class="elementskit-box-content">
                        <?php
                        if ($settings['ekit_image_box_title_text'] != '') :
                        ?>
                        <<?php echo \ElementsKit\Utils::render($settings['ekit_image_box_title_size']); ?> class="elementskit-info-box-title">

                        <?php if(($settings['ekit_image_box_front_title_icons'] != '') && ($settings['ekit_image_box_front_title_icon_position'] == 'left') && ($settings['ekit_image_box_style_simple'] == 'floating-style')) : ?>

                            <?php
                                // new icon
                                $migrated = isset( $settings['__fa4_migrated']['ekit_image_box_front_title_icons'] );
                                // Check if its a new widget without previously selected icon using the old Icon control
                                $is_new = empty( $settings['ekit_image_box_front_title_icon'] );
                                if ( $is_new || $migrated ) {
                                    // new icon
                                    Icons_Manager::render_icon( $settings['ekit_image_box_front_title_icons'], [ 'aria-hidden' => 'true' ] );
                                } else {
                                    ?>
                                    <i class="<?php echo esc_attr($settings['ekit_image_box_front_title_icon']); ?>" aria-hidden="true"></i>
                                    <?php
                                }
                            ?>

                        <?php endif; ?>

                        <?php echo \ElementsKit\Utils::render($link_wrapper_start . $settings['ekit_image_box_title_text'] . $link_wrapper_end); ?>

                        <?php if(($settings['ekit_image_box_front_title_icons'] != '') && ($settings['ekit_image_box_front_title_icon_position'] == 'right') && ($settings['ekit_image_box_style_simple'] == 'floating-style')) : ?>
                                
                            <?php
                                // new icon
                                $migrated = isset( $settings['__fa4_migrated']['ekit_image_box_front_title_icons'] );
                                // Check if its a new widget without previously selected icon using the old Icon control
                                $is_new = empty( $settings['ekit_image_box_front_title_icon'] );
                                if ( $is_new || $migrated ) {
                                    // new icon
                                    Icons_Manager::render_icon( $settings['ekit_image_box_front_title_icons'], [ 'aria-hidden' => 'true' ] );
                                } else {
                                    ?>
                                    <i class="<?php echo esc_attr($settings['ekit_image_box_front_title_icon']); ?>" aria-hidden="true"></i>
                                    <?php
                                }
                            ?>

                        <?php endif; ?>

                    </<?php echo \ElementsKit\Utils::render($settings['ekit_image_box_title_size']); ?>>
                    <?php

                        endif;
                    ?>
                    <?php if ($settings['ekit_image_box_description_text'] != '') { ?>
                    <div class="elementskit-box-style-content">
                        <?php
                        echo \ElementsKit\Utils::kses($settings['ekit_image_box_description_text']);
                        ?>
                    </div>
                    <?php }; ?>
                </div>

                <?php if($settings['ekit_image_box_enable_btn'] == 'yes') :  ?>
                <div class="elementskit-box-footer">
                    <div class="box-footer">
                        <div class="btn-wraper">
                            <?php if($settings['ekit_image_box_icon_align'] == 'right'): ?>
                                <a href="<?php echo esc_url( $btn_url ); ?>" target="<?php echo $settings['ekit_image_box_btn_url']['is_external'] == 'on' ? '_blank' : '_self' ?>" rel="<?php echo $settings['ekit_image_box_btn_url']['nofollow'] == 'on' ? 'nofollow' : '' ?>" class="elementskit-btn">
                                    <?php echo esc_html( $btn_text ); ?>

                                    <?php
                                        // new icon
                                        $migrated = isset( $settings['__fa4_migrated']['ekit_image_box_icons'] );
                                        // Check if its a new widget without previously selected icon using the old Icon control
                                        $is_new = empty( $settings['ekit_image_box_icon'] );
                                        if ( $is_new || $migrated ) {
                                            // new icon
                                            Icons_Manager::render_icon( $settings['ekit_image_box_icons'], [ 'aria-hidden' => 'true' ] );
                                        } else {
                                            ?>
                                            <i class="<?php echo esc_attr($settings['ekit_image_box_icon']); ?>" aria-hidden="true"></i>
                                            <?php
                                        }
                                    ?>

                                </a>
                                <?php elseif ($settings['ekit_image_box_icon_align'] == 'left') : ?>
                                <a href="<?php echo esc_url( $btn_url ); ?>" target="<?php echo $settings['ekit_image_box_btn_url']['is_external'] == 'on' ? '_blank' : '_self' ?>" rel="<?php echo $settings['ekit_image_box_btn_url']['nofollow'] == 'on' ? 'nofollow' : '' ?>" class="elementskit-btn">
                                    
                                    <?php
                                        // new icon
                                        $migrated = isset( $settings['__fa4_migrated']['ekit_image_box_icons'] );
                                        // Check if its a new widget without previously selected icon using the old Icon control
                                        $is_new = empty( $settings['ekit_image_box_icon'] );
                                        if ( $is_new || $migrated ) {
                                            // new icon
                                            Icons_Manager::render_icon( $settings['ekit_image_box_icons'], [ 'aria-hidden' => 'true' ] );
                                        } else {
                                            ?>
                                            <i class="<?php echo esc_attr($settings['ekit_image_box_icon']); ?>" aria-hidden="true"></i>
                                            <?php
                                        }
                                    ?>

                                    <?php echo esc_html( $btn_text ); ?>
                                </a>
                                <?php else : ?>
                                <a href="<?php echo esc_url( $btn_url ); ?>" target="<?php echo $settings['ekit_image_box_btn_url']['is_external'] == 'on' ? '_blank' : '_self' ?>" rel="<?php echo $settings['ekit_image_box_btn_url']['nofollow'] == 'on' ? 'nofollow' : '' ?>" class="elementskit-btn">
                                    <?php echo esc_html( $btn_text ); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            </div>
        <?php

        }
    protected function _content_template() { }
}