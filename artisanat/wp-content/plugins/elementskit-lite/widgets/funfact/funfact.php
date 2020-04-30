<?php
namespace Elementor;

use \ElementsKit\Elementskit_Widget_Funfact_Handler as Handler;
use \ElementsKit\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;


class Elementskit_Widget_Funfact extends Widget_Base {
    use \ElementsKit\Widgets\Widget_Notice;

    public $base;

    public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );
		$this->add_script_depends('elementor-waypoints');
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
            'ekit_funfact_section_icon',
            [
                'label' => esc_html__( 'Icon', 'elementskit' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'ekit_funfact_icon_type',
            [
                'label' => esc_html__( 'Icon type ', 'elementskit' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'icon' => [
                        'title' => esc_html__( 'Icon', 'elementskit' ),
                        'icon' => 'fa fa-star',
                    ],
                    'image_icon' => [
                        'title' => esc_html__( 'Image', 'elementskit' ),
                        'icon' => 'fa fa-image',
                    ],
                    'none' => [
                        'title' => esc_html__( 'None', 'elementskit' ),
                        'icon' => 'fa fa-stop-circle',
                    ],
                ],
                'default' => 'icon',
                'toggle' => true,
            ]
        );

        $this->add_control(
            'ekit_funfact_icons__switch',
            [
                'label' => esc_html__('Add icon? ', 'elementskit'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' =>esc_html__( 'Yes', 'elementskit' ),
                'label_off' =>esc_html__( 'No', 'elementskit' ),
                'condition' => [
                    'ekit_funfact_icon_type'        => 'icon',
                ]
            ]
        );

        $this->add_control(
            'ekit_funfact_icons',
            [
                'label' => esc_html__( 'Icon', 'elementskit' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'ekit_funfact_icon',
                'default' => [
                    'value' => 'fab fa-amazon',
                    'library' => 'brands',
                ],
                'condition' => [
                    'ekit_funfact_icon_type'        => 'icon',
                    'ekit_funfact_icons__switch'    => 'yes',
                ]
            ]
        );

        $this->add_control(
            'ekit_funfact_view',
            [
                'label' => esc_html__( 'View', 'elementskit' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => esc_html__( 'Default', 'elementskit' ),
                    'fill-icon' => esc_html__( 'Stacked', 'elementskit' ),
                    'framed' => esc_html__( 'Framed', 'elementskit' ),
                ],
                'default' => 'default',
                'condition' => [
                    'icon!' => '',
                    'ekit_funfact_icon_type' => 'icon',

                ],
            ]
        );
        $this->add_control(
            'ekit_funfact_icon_image',
            [
                'label' => esc_html__( 'Choose Image', 'elementskit' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'ekit_funfact_icon_type' => 'image_icon',
                ]
            ]
        );


        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'ekit_funfact_thumbnail',
                'default' => 'thumbnail',
                'separator' => 'none',
                'condition' => [
                    'ekit_funfact_icon_type' => 'image_icon',
                ]
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
			'ekit_funfact_content_section',
			[
				'label' => esc_html__( 'Content', 'elementskit' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
            'ekit_funfact_number',
            [
                'label' => esc_html__( 'Number ', 'elementskit' ),
                'type' => Controls_Manager::TEXT,
                'default' => '254',
                'placeholder' => esc_html__( 'Enter number', 'elementskit' ),
            ]
        );

        $this->add_control(
            'ekit_funfact_number_suffix',
            [
                'label' => esc_html__( 'Number Suffix ', 'elementskit' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'M',
                'placeholder' => esc_html__( 'M+', 'elementskit' ),
            ]
        );

        $this->add_control(
            'ekit_funfact_title_text',
            [
                'label' => esc_html__( 'Title ', 'elementskit' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'This is the heading', 'elementskit' ),
                'placeholder' => esc_html__( 'Enter your title', 'elementskit' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
			'ekit_funfact_super',
			[
				'label' => esc_html__( 'Enable Super', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
        );

        $this->add_control(
            'ekit_funfact_super_text',
            [
                'label' => esc_html__( 'Super', 'elementskit' ),
                'type' => Controls_Manager::TEXT,
                'default' => '+',
                'placeholder' => esc_html__( '+', 'elementskit' ),
				'condition' => ['ekit_funfact_super' => 'yes'],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
			'ekit_funfact_settings_items',
			[
				'label' => esc_html__( 'Settings', 'elementskit' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


        $this->add_responsive_control(
            'ekit_funfact_text_align',
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
        $this->add_control(
            'ekit_funfact_title_size',
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
			'ekit_funfact_separetor_one',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

        $this->add_control(
			'ekit_funfact_hover_border_bottom',
			[
				'label' => esc_html__( 'Enable Hover Border Bottom', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
        );

        $this->add_control(
            'ekit_funfact_hover_border_bottom_direction',
            [
                'label' => esc_html__( 'Hover Direction', 'elementskit' ),
                'type' =>   Controls_Manager::CHOOSE,
                'options' => [
                    'hover_from_left' => [
                        'title' => esc_html__( 'From Left', 'elementskit' ),
                        'icon' => 'fa fa-caret-right',
                    ],
                    'hover_from_right' => [
                        'title' => esc_html__( 'From Right', 'elementskit' ),
                        'icon' => 'fa fa-caret-left',
                    ],
                ],
                'default' => 'hover_from_right',
                'toggle' => true,
                'condition'  => [
                    'ekit_funfact_hover_border_bottom' => 'yes'
                ]
            ]
        );

        $this->add_control(
			'ekit_funfact_hover_border_bottom_direction_hr',
			[
				'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
                'condition'  => [
                    'ekit_funfact_hover_border_bottom' => 'yes'
                ]
			]
		);

        $this->add_control(
			'ekit_funfact_enable_vertical_border',
			[
				'label' => esc_html__( 'Enable Vertical Border', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
        );

        $this->add_control(
            'ekit_funfact_enable_vertical_border_position',
            [
                'label' => esc_html__( 'Border Direction', 'elementskit' ),
                'type' =>   Controls_Manager::CHOOSE,
                'options' => [
                    'border_left_side' => [
                        'title' => esc_html__( 'From Left', 'elementskit' ),
                        'icon' => 'fa fa-caret-right',
                    ],
                    'border_right_side' => [
                        'title' => esc_html__( 'From Right', 'elementskit' ),
                        'icon' => 'fa fa-caret-left',
                    ],
                ],
                'default' => 'border_right_side',
                'toggle' => true,
                'condition'  => [
                    'ekit_funfact_enable_vertical_border' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();


        // start Image style section for image

        $this->start_controls_section(
            'ekit_funfact_style_section_image',
            [
                'label' => esc_html__( 'Icon', 'elementskit' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'conditions'    => [
                    'terms' => [
                        [
                            'relation'      => 'OR',
                            'name' => 'ekit_funfact_icons__switch',
                            'operator' => 'in',
                            'value' => [
                                'yes',
                            ],
                            'terms' => [
                                [
                                    'name' => 'ekit_funfact_icon_type',
                                    'operator' => 'in',
                                    'value' => [
                                        'image_icon',
                                    ],
                                ],
                            ],
                        ],
                        
                    ],
                ]
            ]
        );
        $this->add_responsive_control(
            'ekit_funfact_icon_image_space',
            [
                'label' => esc_html__( 'Margin Bottom', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-funfact .funfact-icon img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'ekit_funfact_style_tabs_image'
        );

        $this->start_controls_tab(
            'ekit_funfact_style_img_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'elementskit' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ekit_funfact_imge_border_group',
                'label' => esc_html__( 'Border', 'elementskit' ),
                'selector' => '{{WRAPPER}} .elementskit-funfact .funfact-icon img',
            ]
        );
        $this->add_responsive_control(
            'ekit_funfact_icon_image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-funfact .funfact-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ekit_funfact_iamge_box_shadow_group',
                'label' => esc_html__( 'Box Shadow', 'elementskit' ),
                'selector' => '{{WRAPPER}} .elementskit-funfact .funfact-icon img',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ekit_funfact_style_img_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'elementskit' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ekit_funfact_imge_border_hover_group',
                'label' => esc_html__( 'Border', 'elementskit' ),
                'selector' => '{{WRAPPER}} .elementskit-funfact .funfact-icon img:hover',
            ]
        );
        $this->add_responsive_control(
            'ekit_funfact_icon_image_hover_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-funfact .funfact-icon img:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ekit_funfact_image_box_shadow_hv_group',
                'label' => esc_html__( 'Box Shadow', 'elementskit' ),
                'selector' => '{{WRAPPER}} .elementskit-funfact .funfact-icon img:hover',
            ]
        );

        $this->add_responsive_control(
            'ekit_funfact_icon_image_hover_animation',
            [
                'label' => esc_html__( 'Animation', 'elementskit' ),
                'type' => Controls_Manager::HOVER_ANIMATION,
				'selector' => '{{WRAPPER}} .elementskit-funfact .funfact-icon img:hover',
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // image style section

        //Icon Style Start
        $this->start_controls_section(
            'ekit_funfact_section_style_icon',
            [
                'label' => esc_html__( 'Icons', 'elementskit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ekit_funfact_icons__switch'    => 'yes',
                    'ekit_funfact_icon_type' => 'icon',

                ],
            ]
        );

        $this->start_controls_tabs( 'icon_colors' );

        $this->start_controls_tab(
            'ekit_funfact_icon_colors_normal',
            [
                'label' => esc_html__( 'Normal', 'elementskit' ),
            ]
        );

        $this->add_responsive_control(
            'ekit_funfact_icon_primary_color',
            [
                'label' => esc_html__( 'Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-funfact .elementskit-funfact-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementskit-funfact .funfact-icon svg path'   => 'stroke: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ekit_funfact_icon_secondary_color_normal',
            [
                'label' => esc_html__( 'BG Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-funfact .elementskit-funfact-icon, {{WRAPPER}} .elementskit-funfact svg' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ekit_funfact_border_group',
                'label' => esc_html__( 'Border', 'elementskit' ),
                'selector' => '{{WRAPPER}} .elementskit-funfact-icon, {{WRAPPER}} .elementskit-funfact svg',
            ]
        );

        $this->add_responsive_control(
            'ekit_funfact_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-funfact .elementskit-funfact-icon, {{WRAPPER}} .elementskit-funfact svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ekit_funfact_icon_colors_hover',
            [
                'label' => esc_html__( 'Hover', 'elementskit' ),
            ]
        );

        $this->add_responsive_control(
            'ekit_funfact_hover_primary_color',
            [
                'label' => esc_html__( 'Primary Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-funfact:hover .elementskit-funfact-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementskit-funfact:hover svg path'   => 'stroke: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ekit_funfact_hover_secondary_color',
            [
                'label' => esc_html__( 'Secondary Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-funfact:hover .elementskit-funfact-icon, {{WRAPPER}} .elementskit-funfact:hover svg' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ekit_funfact_border_icon_group',
                'label' => esc_html__( 'Border', 'elementskit' ),
                'selector' => '{{WRAPPER}} .elementskit-funfact:hover .elementskit-funfact-icon, {{WRAPPER}} .elementskit-funfact:hover svg',
                'condition' => [
                    'ekit_funfact_view!' => 'Stacked',
                ],
            ]
        );
        $this->add_responsive_control(
            'ekit_funfact_icon_hover_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-funfact:hover .elementskit-funfact-icon, {{WRAPPER}} .elementskit-funfact svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
		$this->add_responsive_control(
            'ekit_funfact_icon_size',
            [
                'label' => esc_html__( 'Size', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'default' => [
                    'size' => 40,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-funfact-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementskit-funfact svg' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'ekit_funfact_icon_space',
            [
                'label' => esc_html__( 'Margin Bottom', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -20,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 15,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-funfact-icon, {{WRAPPER}} .elementskit-funfact svg' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ekit_funfact_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 15,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-funfact-icon, {{WRAPPER}} .elementskit-funfact svg' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ekit_funfact_rotate',
            [
                'label' => esc_html__( 'Rotate', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                    'unit' => 'deg',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-funfact-icon, {{WRAPPER}} .elementskit-funfact svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ekit_funfact_icon_box_shadow_group',
                'selector' => '{{WRAPPER}} .elementskit-funfact-icon, {{WRAPPER}} .elementskit-funfact svg',
            ]
        );

        $this->end_controls_section();
        // end icon style section

        //Content style start
        $this->start_controls_section(
            'ekit_funfact_section_style_content',
            [
                'label' => esc_html__( 'Content', 'elementskit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'ekit_funfact_heading_number',
            [
                'label' => esc_html__( 'Number Count', 'elementskit' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'ekit_funfact_description_color',
            [
                'label' => esc_html__( 'Number Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-funfact .funfact-content .number-percentage-wraper' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ekit_funfact_number_typography',
				'label' => esc_html__( 'Typography', 'elementskit' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .elementskit-funfact .funfact-content .number-percentage-wraper',
			]
		);


        $this->add_responsive_control(
            'ekit_funfact_number_count_bottom_space',
            [
                'label' => esc_html__( 'Spacing', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-funfact .funfact-content .number-percentage-wraper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ekit_funfact_number_count_right_space',
            [
                'label' => esc_html__( 'Right Spacing', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-funfact .funfact-content .number-percentage' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'ekit_funfact_heading_title',
            [
                'label' => esc_html__( 'Title', 'elementskit' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'ekit_funfact_title_bottom_space',
            [
                'label' => esc_html__( 'Spacing', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-funfact .funfact-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ekit_funfact_title_color',
            [
                'label' => esc_html__( 'Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-funfact .funfact-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ekit_funfact_title_typography',
                'selector' => '{{WRAPPER}} .elementskit-funfact .funfact-title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_responsive_control(
            'ekit_funfact_info_box_padding',
            [
                'label' => esc_html__( 'Padding', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-funfact ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'size' => 15,
                    'unit' => 'px',
                ],
            ]
        );

        $this->end_controls_section();
        //Content style end

        $this->start_controls_section(
			'ekit_funfact_super_controls',
			[
				'label' => esc_html__( 'Super', 'elementskit' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ekit_funfact_super' => 'yes',
                ]
			]
		);

        $this->add_responsive_control(
            'ekit_funfact_super_color',
            [
                'label' => esc_html__( 'Number Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-funfact .super' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ekit_funfact_super_typography',
				'label' => esc_html__( 'Typography', 'elementskit' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .elementskit-funfact .super',
			]
		);

        $this->add_responsive_control(
			'ekit_funfact_super_position_top',
			[
				'label' => esc_html__( 'Top', 'elementskit' ),
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
					'size' => -5,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-funfact .super' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'ekit_funfact_super_position_left_right',
            [
                'label' => esc_html__( 'Horizontal space', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => -5,
                        'max' => 20,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-funfact .super' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'ekit_funfact_super_vertical_position',
			[
				'label' => esc_html__( 'Vertical Position', 'elementskit' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'top' => [
						'title' => esc_html__( 'Top', 'elementskit' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => esc_html__( 'Middle', 'elementskit' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'elementskit' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'top',
				'selectors_dictionary' => [
					'top' => 'super',
					'middle' => 'baseline',
					'bottom' => 'sub',
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-funfact .super' => 'vertical-align: {{VALUE}}',
                ],
			]
		);

		$this->end_controls_section();

        //Background style start
        $this->start_controls_section(
            'ekit_funfact_section_background_style',
            [
                'label' => esc_html__( 'Background', 'elementskit' ),
                'tab' => controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ekit_funfact_bg',
                'label' => esc_html__( 'Background', 'elementskit' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .elementskit-funfact',
            ]
        );

        $this->add_responsive_control(
            'ekit_funfact_bg_padding',
            [
                'label' => esc_html__( 'Padding', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-funfact .elementskit-funfact-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ekit_funfact_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'elementskit' ),
                'selector' => '{{WRAPPER}} .elementskit-funfact',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ekit_kit_funfact_border',
                'label' => esc_html__( 'Border', 'elementskit' ),
                'selector' => '{{WRAPPER}} .elementskit-funfact',
            ]
        );

        $this->add_responsive_control(
            'ekit_funfact_border_radious',
            [
                'label' => esc_html__( 'Border Radius', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-funfact' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ekit_funfact_box_ainmation',
            [
                'label' => esc_html__( 'Entrance Animation', 'elementskit' ),
                'type' => Controls_Manager::ANIMATION,
                'prefix_class' => 'animated ',
            ]
        );


        $this->add_control(
            'ekit_funfact_show_overly',
            [
                'label' => esc_html__( 'Enable Overlay', 'elementskit' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'elementskit' ),
                'label_off' => esc_html__( 'No', 'elementskit' ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );
        $this->add_responsive_control(
            'ekit_funfact_bg_ovelry_color',
            [
                'label' => esc_html__( 'Overlay Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementskit-funfact .elementskit-funfact-overlay' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'ekit_funfact_show_overly' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'ekit_funfact_divider_tab',
			[
				'label' => esc_html__( 'Devider', 'elementskit' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ekit_funfact_enable_vertical_border' => 'yes',
                ]
			]
		);

		$this->add_responsive_control(
			'ekit_funfact_divider_width',
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
					'size' => 3,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-funfact .vertical-bar' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
        );

		$this->add_responsive_control(
			'ekit_funfact_divider_height',
			[
				'label' => esc_html__( 'Height', 'elementskit' ),
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
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-funfact .vertical-bar' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_funfact_divider_background',
				'label' => esc_html__( 'Background', 'elementskit' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elementskit-funfact .vertical-bar',
			]
        );

        $this->add_control(
            'ekit_funfact_enable_border_verticaly_position',
            [
                'label' => esc_html__( 'Border Direction', 'elementskit' ),
                'type' =>   Controls_Manager::CHOOSE,
                'options' => [
                    'position_top' => [
                        'title' => esc_html__( 'From Top', 'elementskit' ),
                        'icon' => 'fa fa-caret-up',
                    ],
                    'position_center' => [
                        'title' => esc_html__( 'From Center', 'elementskit' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'position_bottom' => [
                        'title' => esc_html__( 'From Down', 'elementskit' ),
                        'icon' => 'fa fa-caret-down',
                    ],
                ],
                'default' => 'position_center',
                'toggle' => true,
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


        $text_align = $settings['ekit_funfact_text_align'];

        $hover_border_bottom_direction = '';
        $vertically_devider_position = '';
        $divider_funfact = '';

        $enable_ovelry_color = $modern_design = $enable_border_bottom = '';

        if($settings['ekit_funfact_show_overly'] == 'yes') {
            $enable_ovelry_color = '<div class="elementor-background-overlay elementskit-funfact-overlay"></div>';
        }
        if ($settings['ekit_funfact_hover_border_bottom'] == 'yes') {
            $enable_border_bottom = 'style-border-bottom';
            $hover_border_bottom_direction = $settings['ekit_funfact_hover_border_bottom_direction'];
        }

        if ($settings['ekit_funfact_enable_vertical_border'] == 'yes') {
            $divider_funfact = 'divider_funfact';
            $vertically_devider_position = $settings['ekit_funfact_enable_border_verticaly_position'];
        }

        // info box style

        $this->add_render_attribute( 'funfact_wrapper', 'class', 'elementskit-funfact'.' text-'.$text_align.' '.$enable_border_bottom.' '.$modern_design.' '.$hover_border_bottom_direction.' '.$divider_funfact.' '.$vertically_devider_position);

        // for image box
        $image_html = '';
        if ( ! empty( $settings['ekit_funfact_icon_image']['url'] ) ) {

            $this->add_render_attribute( 'image', 'src', $settings['ekit_funfact_icon_image']['url'] );
            $this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['ekit_funfact_icon_image'] ) );

            $image_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'ekit_funfact_thumbnail', 'ekit_funfact_icon_image' );

        }

        ?>

        <div <?php echo \ElementsKit\Utils::kses($this->get_render_attribute_string( 'funfact_wrapper' )); ?>>
            <?php if ($settings['ekit_funfact_enable_vertical_border'] == 'yes') : ?>
            <div class="vertical-bar <?php echo esc_attr($settings['ekit_funfact_enable_vertical_border_position']); ?>"></div>
            <?php endif; ?>
            <div class="elementskit-funfact-inner">
                <?php if(($settings['ekit_funfact_icon_type'] == 'image_icon') || ($settings['ekit_funfact_icon_type'] == 'icon')) : ?>
                <div class="funfact-icon">
                    <?php if($settings['ekit_funfact_icon_type'] == 'image_icon') : ?>
                        <?php echo \ElementsKit\Utils::render($image_html); ?>
                    <?php endif; ?>
                    <?php if($settings['ekit_funfact_icon_type'] == 'icon') : ?>
                        <i <?php echo \ElementsKit\Utils::kses($this->get_render_attribute_string( 'icon' )); ?>></i>

                        <?php
                            // new icon
                            $migrated = isset( $settings['__fa4_migrated']['ekit_funfact_icons'] );
                            // Check if its a new widget without previously selected icon using the old Icon control
                            $is_new = empty( $settings['ekit_funfact_icon'] );
                            if ( $is_new || $migrated ) {
                                // new icon
                                Icons_Manager::render_icon( $settings['ekit_funfact_icons'], [ 'aria-hidden' => 'true', 'class'    => 'elementskit-funfact-icon' ] );
                            } else {
                                ?>
                                <i class="<?php echo esc_attr($settings['ekit_funfact_icon']); ?> elementskit-funfact-icon" aria-hidden="true"></i>
                                <?php
                            }
                        ?>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <div class="funfact-content">
                    <div class="number-percentage-wraper">
                        <span class="number-percentage" data-value="<?php echo esc_attr($settings['ekit_funfact_number']); ?>" data-animation-duration="3500">0</span><?php echo esc_html($settings['ekit_funfact_number_suffix']); ?>
                        <?php if ($settings['ekit_funfact_super'] == 'yes') : ?>
                        <span class="super"><?php echo \ElementsKit\Utils::kses($settings['ekit_funfact_super_text']); ?></span>
                        <?php endif; ?>
                    </div>
                    <<?php echo \ElementsKit\Utils::render($settings['ekit_funfact_title_size']); ?> class="funfact-title"><?php echo esc_html($settings['ekit_funfact_title_text']); ?></<?php echo esc_html($settings['ekit_funfact_title_size']); ?>>
                    <?php echo $enable_ovelry_color; ?>
                </div>
            </div>
        </div>


        <?php

    }
    protected function _content_template() { }
}