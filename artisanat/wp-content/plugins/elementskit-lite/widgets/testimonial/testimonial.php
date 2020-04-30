<?php
namespace Elementor;

use \ElementsKit\Elementskit_Widget_Testimonial_Handler as Handler;
use \ElementsKit\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Elementskit_Widget_Testimonial extends Widget_Base {
	use \ElementsKit\Widgets\Widget_Notice;

	public $base;
    
    public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );
		$this->add_script_depends('slick');
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
            'ekit_testimonial_layout_section_tab_style',
            [
                'label' => esc_html__('Layout', 'elementskit'),
            ]
        );


        // Card style

		$this->add_control(
            'ekit_testimonial_style',
            [
                'label' => esc_html__('Choose Style', 'elementskit'),
                'type' => ElementsKit_Controls_Manager::IMAGECHOOSE,
                'default' => 'style1',
                'options' => [
					'style1' => [
						'title' => esc_html__( 'Default', 'elementskit' ),
                        'imagelarge' => Handler::get_url() . 'assets/imagechoose/1.png',
                        'imagesmall' => Handler::get_url() . 'assets/imagechoose/1.png',
                        'width' => '33.33%',
					],
					'style2' => [
						'title' => esc_html__( 'Grid Style without image', 'elementskit' ),
                        'imagelarge' => Handler::get_url() . 'assets/imagechoose/2.png',
                        'imagesmall' => Handler::get_url() . 'assets/imagechoose/2.png',
                        'width' => '33.33%',
					],
					'style3' => [
						'title' => esc_html__( 'Image with Ratting', 'elementskit' ),
                        'imagelarge' => Handler::get_url() . 'assets/imagechoose/3.png',
                        'imagesmall' => Handler::get_url() . 'assets/imagechoose/3.png',
                        'width' => '33.33%',
					],
					'style4' => [
						'title' => esc_html__( 'image style 4', 'elementskit' ),
                        'imagelarge' => Handler::get_url() . 'assets/imagechoose/4.png',
                        'imagesmall' => Handler::get_url() . 'assets/imagechoose/4.png',
                        'width' => '33.33%',
					],
					'style5' => [
						'title' => esc_html__( 'image style 5', 'elementskit' ),
                        'imagelarge' => Handler::get_url() . 'assets/imagechoose/5.png',
                        'imagesmall' => Handler::get_url() . 'assets/imagechoose/5.png',
                        'width' => '33.33%',
					],
					'style6' => [
						'title' => esc_html__( 'image style 6', 'elementskit' ),
                        'imagelarge' => Handler::get_url() . 'assets/imagechoose/6.png',
                        'imagesmall' => Handler::get_url() . 'assets/imagechoose/6.png',
                        'width' => '33.33%',
					],
				],
            ]
        );

		$this->end_controls_section();
        $this->start_controls_section(
            'ekit_testimonial_section_tab_style',
            [
                'label' => esc_html__('Testimonial', 'elementskit'),
            ]
        );

		// enable warter mark icon
		$this->add_control(
            'ekit_testimonial_wartermark_enable',
            [
                'label' => esc_html__( 'Enable Quote Icon', 'elementskit' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'elementskit' ),
                'label_off' => esc_html__( 'No', 'elementskit' ),
                'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'ekit_testimonial_style' => ['style2', 'style4', 'style5', 'style6']
				]
            ]
		);

		$this->add_control(
            'ekit_testimonial_wartermarks',
            [
                'label' => esc_html__( 'Quote Icon', 'elementskit' ),
                'label_block' => true,
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'ekit_testimonial_wartermark',
                'default' => [
                    'value' => 'icon icon-quote1',
                    'library' => 'ekiticons',
                ],
                'condition' => [
					'ekit_testimonial_wartermark_enable' => 'yes',
					'ekit_testimonial_style' => ['style2', 'style4', 'style5', 'style6'],
				],
            ]
		);

		// water mark position
		$this->add_control(
			'ekit_testimonial_wartermark_position',
			[
				'label' => esc_html__( 'Quote Icon Position', 'elementskit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'top',
				'separator'    => 'before',
				'options' => [
					'top'  => esc_html__( 'Top', 'elementskit' ),
					'bottom' => esc_html__( 'Bottom', 'elementskit' ),
				],
				'condition' => [
					'ekit_testimonial_wartermark_enable' => 'yes',
					'ekit_testimonial_style' => ['style5']
				]
			]
		);

		$this->add_control(
			'ekit_testimonial_wartermark_mask_show_badge',
			[
				'label' => esc_html__( 'Show Quote Icon Badge', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementskit' ),
				'label_off' => esc_html__( 'Hide', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'no',
				'separator'    => 'before',
				'condition' => [
					'ekit_testimonial_wartermark_enable' => 'yes',
					'ekit_testimonial_style' => ['style6']
				]
			]
		);

		$this->add_control(
			'ekit_testimonial_wartermark_custom_position',
			[
				'label' => esc_html__( 'Custom Position', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementskit' ),
				'label_off' => esc_html__( 'Hide', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'no',
				'separator'    => 'before',
				'condition' => [
					'ekit_testimonial_wartermark_enable' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_wartermark_custom_position_offset_x',
			[
				'label' => esc_html__( 'Left', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .ekit_watermark_icon_custom_position' => 'left: {{SIZE}}{{UNIT}} !important;',
				],
				'condition' => [
					'ekit_testimonial_wartermark_enable' => 'yes',
					'ekit_testimonial_wartermark_custom_position' => 'yes',
				]
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_wartermark_custom_position_offset_y',
			[
				'label' => esc_html__( 'top', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .ekit_watermark_icon_custom_position' => 'top: {{SIZE}}{{UNIT}} !important;',
				],
				'condition' => [
					'ekit_testimonial_wartermark_enable' => 'yes',
					'ekit_testimonial_wartermark_custom_position' => 'yes',
				]
			]
		);

		// enable rating
		$this->add_control(
            'ekit_testimonial_rating_enable',
            [
                'label' => esc_html__( 'Enable Rating', 'elementskit' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'elementskit' ),
                'label_off' => esc_html__( 'No', 'elementskit' ),
                'return_value' => 'yes',
				'default' => 'yes',
				'separetor' => 'before',
				'condition' => [
					'ekit_testimonial_style' => ['style3', 'style4', 'style5', 'style6']
				]
            ]
		);

		// enable title separetor
		$this->add_control(
            'ekit_testimonial_title_separetor',
            [
                'label'     => esc_html__( 'Show Separator', 'elementskit' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'Yes', 'elementskit' ),
                'label_off' => esc_html__( 'No', 'elementskit' ),
				'default'   => 'yes',
				'separator'    => 'before',
				'condition' => [
					'ekit_testimonial_style' => ['style1', 'style2'],
				]
            ]
		);

		$repeater = new Repeater();
        $repeater->add_control(
            'client_name', [
                'label' => esc_html__('Client Name', 'elementskit'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Testimonial #1', 'elementskit'),
				'label_block' => true,
            ]
        );
        $repeater->add_control(
            'designation', [
                'label' => esc_html__('Designation', 'elementskit'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Designation', 'elementskit'),
            ]
        );
        $repeater->add_control(
            'review', [
				'label' => esc_html__('Testimonial Review', 'elementskit'),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__('Review Text', 'elementskit'),
            ]
        );
        $repeater->add_control(
            'rating', [
				'label' => esc_html__('Testimonial Rating', 'elementskit'),
				'type' => Controls_Manager::SELECT,
				'default' => '5',
				'options'   => [
					'5'     => esc_html__( '5', 'elementskit' ),
					'4'     => esc_html__( '4', 'elementskit' ),
					'3'     => esc_html__( '3', 'elementskit' ),
					'2'     => esc_html__( '2', 'elementskit' ),
					'1'     => esc_html__( '1', 'elementskit' ),
				],
				'label_block' => true,
            ]
        );
        $repeater->add_control(
            'client_photo', [
				'label' => esc_html__('Client Avatar', 'elementskit'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
            ]
        );
        $repeater->add_control(
            'client_logo', [
				'label' => esc_html__('Logo', 'elementskit'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
            ]
        );
        $repeater->add_control(
            'use_hover_logo', [
				'label' => esc_html__( 'Display different logo on hover?', 'elements-test' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'elements-test' ),
				'label_off' => esc_html__( 'No', 'elements-test' ),
				'default' => 'no',
				'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'client_logo_active', [
				'label' => esc_html__('Logo Active', 'elementskit'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => ['use_hover_logo' => 'yes'],
            ]
        );
		$repeater->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ekit_testimonial_background_group',
                'label' => esc_html__( 'Background', 'elementskit' ),
                'types' => [ 'classic'],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
            ]
        );
        $this->add_control(
            'ekit_testimonial_data',
            [
                'label' => esc_html__('Testimonial', 'elementskit'),
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [ 'client_name' => esc_html__('Testimonial #1', 'elementskit') ],
                    [ 'client_name' => esc_html__('Testimonial #2', 'elementskit') ],
                    [ 'client_name' => esc_html__('Testimonial #3', 'elementskit') ],
                ],

                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ client_name }}}',
            ]
		);



		$this->end_controls_section();

		// setting section

        $this->start_controls_section(
            'ekit_testimonial_layout_settings',
            [
                'label' => esc_html__( 'Settings', 'elementskit' ),
            ]
        );

		$this->add_responsive_control(
			'ekit_testimonial_left_right_spacing',
			[
				'label' => esc_html__( 'Spacing Left Right', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 15,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 10,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 10,
					'unit' => 'px',
				],
				'default' => [
					'size' => 15,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-testimonial-slider .slick-slide' => 'margin-right: {{SIZE}}{{UNIT}};margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_top_bottom_spacing',
			[
				'label' => esc_html__( 'Padding', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-testimonial-slider .slick-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'ekit_testimonial_slidetoshow',
			[
				'label' => esc_html__( 'Slides To Show', 'elementskit' ),
				'type' =>  Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 20,
				'step' => 1,
				'default' => 1,
			]
		);

        $this->add_responsive_control(
			'ekit_testimonial_slidesToScroll',
			[
				'label' => esc_html__( 'Slides To Scroll', 'elementskit' ),
				'type' =>  Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 20,
				'step' => 1,
				'default' => 1,
			]
		);

        $this->add_control(
			'ekit_testimonial_speed',
			[
				'label' => esc_html__( 'Speed', 'elementskit' ),
				'type' =>  Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10000,
				'step' => 1,
				'default' => 1000,
			]
		);

		$this->add_control(
			'ekit_testimonial_autoplay',
			[
				'label' => esc_html__( 'Autoplay', 'elementskit' ),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'elementskit' ),
				'label_off' => esc_html__( 'No', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_control(
			'ekit_testimonial_show_arrow',
			[
				'label' => esc_html__( 'Show arrow', 'elementskit' ),
				'type' =>   Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'elementskit' ),
				'label_off' => esc_html__( 'No', 'elementskit' ),
				'return_value' => 'yes',
				'default' => '',
			]
        );

        $this->add_control(
			'ekit_testimonial_show_dot',
			[
				'label' => esc_html__( 'Show dots', 'elementskit' ),
				'type' =>   Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'elementskit' ),
				'label_off' => esc_html__( 'No', 'elementskit' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

        $this->add_control(
			'ekit_testimonial_left_arrows',
			[
				'label' => esc_html__( 'Left arrow Icon', 'elementskit' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'ekit_testimonial_left_arrow',
                'default' => [
                    'value' => 'icon icon-left-arrow2',
                    'library' => 'ekiticons',
                ],
                'condition' => [
                        'ekit_testimonial_show_arrow' => 'yes',
                ]
			]
        );

        $this->add_control(
			'ekit_testimonial_right_arrows',
			[
				'label' => esc_html__( 'Right arrow Icon', 'elementskit' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'ekit_testimonial_right_arrow',
                'default' => [
                    'value' => 'icon icon-right-arrow2',
                    'library' => 'ekiticons',
                ],
                'condition' => [
                    'ekit_testimonial_show_arrow' => 'yes',
                ]
			]
		);

		$this->add_control(
            'ekit_testimonial_pause_on_hover',
            [
                'label' => esc_html__( 'Pause on Hover', 'elementskit' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'elementskit' ),
                'label_off' => esc_html__( 'No', 'elementskit' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

		// layout controll style start
		 $this->start_controls_section(
		    'ekit_testimonial_section_layout', [
			    'label'	 => esc_html__( 'Layout', 'elementskit' ),
			    'tab'	 => Controls_Manager::TAB_STYLE,
		    ]
	    );

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_testimonial_layout_background',
				'label' => esc_html__( 'Background', 'elementskit' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elementskit-tootltip-testimonial .elementskit-commentor-content, {{WRAPPER}} .elementskit-single-testimonial-slider, {{WRAPPER}} .elementskit-testimonial_card, {{WRAPPER}} .elementskit-tootltip-testimonial .elementskit-commentor-content::before',
			]
		);

		 $this->add_responsive_control(
            'ekit_testimonial_layout_margin',
            [
                'label'         => esc_html__('Column Gap', 'elementskit'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-tootltip-testimonial .elementskit-commentor-content, {{WRAPPER}} .elementskit-single-testimonial-slider, {{WRAPPER}}  .elementskit-testimonial_card' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


		 $this->add_responsive_control(
			'ekit_testimonial_layout_padding',
			[
				'label' =>esc_html__( 'Padding', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-tootltip-testimonial .elementskit-commentor-content, {{WRAPPER}} .elementskit-single-testimonial-slider, {{WRAPPER}}  .elementskit-testimonial_card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_client_parent_container_margin',
			[
				'label' => esc_html__( 'Margin', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-testimonial-slider-block-style' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'ekit_testimonial_style' => ['style4']
				]
			]
		);


		//  $this->add_responsive_control(
		// 	'ekit_testimonial_layout_border_radius',
		// 	[
		// 		'label' =>esc_html__( 'Border Radius', 'elementskit' ),
		// 		'type' => Controls_Manager::DIMENSIONS,
		// 		'size_units' => [ 'px'],
		// 		'default' => [
		// 			'top' => '',
		// 			'right' => '',
		// 			'bottom' => '' ,
		// 			'left' => '',
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .elementskit-tootltip-testimonial .elementskit-commentor-content, {{WRAPPER}} .elementskit-single-testimonial-slider, {{WRAPPER}} .elementskit-testimonial_card' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		// 		],
		// 	]
		// );

		$this->add_responsive_control(
			'ekit_testimonial_layout_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-tootltip-testimonial .elementskit-commentor-content, {{WRAPPER}} .elementskit-single-testimonial-slider, {{WRAPPER}} .elementskit-testimonial_card' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name'      => 'ekit_testimonial_layout_shadow',
                'selector'  => '{{WRAPPER}} .elementskit-tootltip-testimonial .elementskit-commentor-content, {{WRAPPER}} .elementskit-single-testimonial-slider, {{WRAPPER}}  .elementskit-testimonial_card',
            ]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ekit_testimonial_layout_border',
				'label' => esc_html__( 'Border', 'elementskit' ),
				'selector' => '{{WRAPPER}} .elementskit-single-testimonial-slider',
			]
		);

		$this->add_control(
			'ekit_testimonial_layout_active_hedaing',
			[
				'label' => esc_html__( 'Active', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'ekit_testimonial_layout_active_border_color',
			[
				'label' => esc_html__( 'Border Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementskit-single-testimonial-slider:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_testimonial_layout_active_background',
				'label' => esc_html__( 'Background', 'elementskit' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elementskit-single-testimonial-slider:before',
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
		    'ekit_testimonial_section_wraper_style', [
			    'label'	 => esc_html__( 'Wraper content style', 'elementskit' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
		    ]
		);
		

		$this->add_responsive_control(
			'ekit_testimonial_section_wraper_vertical_alignment',
			[
				'label' =>esc_html__( 'Vertical Alignment', 'elementskit' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start'    => [
						'title' =>esc_html__( 'Top', 'elementskit' ),
						'icon' => 'fa fa-caret-up',
					],
					'center' => [
						'title' =>esc_html__( 'Center', 'elementskit' ),
						'icon' => 'fa fa-align-center',
					],
					'flex-end' => [
						'title' =>esc_html__( 'Bottom', 'elementskit' ),
						'icon' => 'fa fa-caret-down',
					],
				],
				'selectors' => [
                    '{{WRAPPER}} .elementkit-testimonial-col' => 'align-self: {{VALUE}};'
                ],
				'default' => 'center',
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_section_wraper_horizontal_alignment',
			[
				'label' =>esc_html__( 'Horizontal Alignment', 'elementskit' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' =>esc_html__( 'Left', 'elementskit' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' =>esc_html__( 'Center', 'elementskit' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' =>esc_html__( 'Right', 'elementskit' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
                    '{{WRAPPER}} .elementskit-commentor-content' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .elementskit-testimonial_card' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .elementskit-profile-info' => 'text-align: {{VALUE}};',
                ],
				'default' => 'left',
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_section_wraper_padding',
			[
				'label' => esc_html__( 'Padding', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-commentor-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ekit_testimonial_section_wraper_use_height',
			[
				'label' => esc_html__( 'Use Fixed Height', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'elementskit' ),
				'label_off' => esc_html__( 'No', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_section_height',
			[
				'label' => esc_html__( 'Height', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 30,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 10,
						'max' => 1000,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 500,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-commentor-content' => 'min-height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ekit_testimonial_section_wraper_use_height' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		// description
		$this->start_controls_section(
			'ekit_testimonial_content_description',
			[
				'label' => esc_html__( 'Description', 'elementskit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ekit_testimonial_description_typography',
				'label' => esc_html__( 'Typography', 'elementskit' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .elementskit-single-testimonial-slider  .elementskit-commentor-content > p, {{WRAPPER}} .elementskit-testimonial_card .elementskit-commentor-coment',
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_description_margin',
			[
				'label' => esc_html__( 'Margin', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-single-testimonial-slider  .elementskit-commentor-content > p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .elementskit-testimonial_card .elementskit-commentor-coment' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ekit_testimonial_description_color',
			[
				'label' => esc_html__( 'Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementskit-single-testimonial-slider  .elementskit-commentor-content > p' => 'color: {{VALUE}}',
					'{{WRAPPER}} .elementskit-testimonial_card .elementskit-commentor-coment' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'ekit_testimonial_description_active_option',
			[
				'label' => esc_html__( 'Active', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'ekit_testimonial_description_active_color',
			[
				'label' => esc_html__( 'Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementskit-single-testimonial-slider:hover  .elementskit-commentor-content > p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		// Testimonial Review Rating

	    $this->start_controls_section(
		    'ekit_testimonial_section_testimonial_ratting_style', [
			    'label'	 => esc_html__( 'Rating', 'elementskit' ),
			    'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [
					'ekit_testimonial_style' => ['style3', 'style4', 'style5', 'style6'],
					'ekit_testimonial_rating_enable' => 'yes'
				]
		    ]
	    );

	    // Testimonial Review ratting Color
	    $this->add_responsive_control(
		    'ekit_testimonial_review_ratting_color', [
			    'label'		 =>esc_html__( 'Color', 'elementskit' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '#fec42d',
			    'selectors'	 => [
				    '{{WRAPPER}} .elementskit-stars > li > a' => 'color: {{VALUE}};'
			    ],
		    ]
	    );

		 $this->add_responsive_control(
            'ekit_testimonial_review_ratting_font_size',
            [
                'label'         => esc_html__('Font Size', 'elementskit'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-stars > li > a' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
		);

		$this->add_responsive_control(
			'ekit_testimonial_review_ratting_right_spacing',
			[
				'label' => esc_html__( 'Items Margin Right', 'elementskit' ),
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
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-stars > li:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_review_ratting_spacing',
			[
				'label' => esc_html__( 'Review Margin', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-stars' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

	    $this->end_controls_section();

		$this->start_controls_section(
		    'ekit_testimonial_section_wathermark_style', [
			    'label'	 => esc_html__( 'Quote icon', 'elementskit' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [
					'ekit_testimonial_wartermark_enable' => 'yes',
				]
		    ]
		);

		$this->start_controls_tabs(
            'ekit_testimonial_client_watermark_color_tabs'
        );

        $this->start_controls_tab(
            'ekit_testimonial_client_watermark_normal_color_tab',
            [
                'label' => esc_html__( 'Normal', 'elementskit' ),
            ]
		);

		// Testimonial wathermark Color
	    $this->add_responsive_control(
		    'ekit_testimonial_section_wathermark_color', [
			    'label'		 =>esc_html__( 'Color', 'elementskit' ),
			    'type'		 => Controls_Manager::COLOR,
			    'selectors'	 => [
				    '{{WRAPPER}} .elementskit-single-testimonial-slider .elementskit-watermark-icon > i' => 'color: {{VALUE}};',
				    '{{WRAPPER}} .elementskit-testimonial-slider-block-style .elementskit-commentor-content > i' => 'color: {{VALUE}};',
				    '{{WRAPPER}} .elementskit-testimonial-slider-block-style-two .elementskit-icon-content > i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementskit-testimonial-slider-block-style-three .elementskit-icon-content > i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementskit-watermark-icon svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};'
			    ],
		    ]
	    );

		$this->end_controls_tab();

        $this->start_controls_tab(
            'ekit_testimonial_client_watermark_active_color_tab',
            [
                'label' => esc_html__( 'Hover', 'elementskit' ),
            ]
		);

		$this->add_responsive_control(
            'ekit_testimonial_section_wathermark_active_color',
            [
                'label'      => esc_html__( 'Color', 'elementskit' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .elementskit-single-testimonial-slider:hover .elementskit-watermark-icon > i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementskit-testimonial-slider-block-style .elementskit-commentor-content > i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementskit-testimonial-slider-block-style-two .elementskit-icon-content > i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementskit-testimonial-slider-block-style-three .elementskit-icon-content > i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementskit-single-testimonial-slider:hover .elementskit-watermark-icon svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'ekit_testimonial_client_watermark_color_tab_end',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

	    // Testimonial wathermark font size
		$this->add_responsive_control(
			'ekit_testimonial_section_wathermark_typography',
			[
				'label' => esc_html__( 'Font Size', 'elementskit' ),
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
					'size' => 48,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-watermark-icon > i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementskit-testimonial-slider-block-style .elementskit-commentor-content > i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementskit-testimonial-slider-block-style-two .elementskit-icon-content > i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementskit-testimonial-slider-block-style-three .elementskit-icon-content > i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementskit-watermark-icon svg'	=> 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_section_wathermark_margin_bottom',
			[
				'label' => esc_html__( 'Margin Bottom', 'elementskit' ),
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
					'size' => 23,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-testimonial-slider-block-style .elementskit-commentor-content > i' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					// '{{WRAPPER}} .elementskit-testimonial-slider-block-style-two .elementskit-icon-content > i' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementskit-testimonial-slider-block-style-three .elementskit-icon-content > i' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					// '{{WRAPPER}} .elementskit-watermark-icon svg'	=> 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementskit-watermark-icon'	=> 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_section_wathermark_icon_padding',
			[
				'label' => esc_html__( 'Padding', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-commentor-content > i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .elementskit-icon-content > i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .elementskit-watermark-icon > i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .elementskit-watermark-icon svg'	=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_testimonial_section_wathermark_icon_badge_background',
				'label' => esc_html__( 'Background', 'elementskit' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elementskit-commentor-content > i, {{WRAPPER}} .elementskit-icon-content > i,{{WRAPPER}} .elementskit-watermark-icon > i, {{WRAPPER}} .elementskit-watermark-icon svg',
				'condition' => [
					'ekit_testimonial_style!' => 'style6'
				]
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_section_wathermark_icon_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-commentor-content > i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .elementskit-icon-content > i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .elementskit-watermark-icon > i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .elementskit-watermark-icon svg'	=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'ekit_testimonial_style!' => 'style6'
				],
			]
		);

		$this->add_control(
			'ekit_testimonial_section_wathermark_badge_devider',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
				'condition' => [
					'ekit_testimonial_wartermark_mask_show_badge' => 'yes'
				]
			]
		);

		// watermark badge
		$this->add_responsive_control(
			'ekit_testimonial_section_wathermark_badge_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-testimonial-slider-block-style-three .elementskit-icon-content.commentor-badge::before' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ekit_testimonial_wartermark_mask_show_badge' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_testimonial_section_wathermark_badge_background',
				'label' => esc_html__( 'Background', 'elementskit' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elementskit-testimonial-slider-block-style-three .elementskit-icon-content.commentor-badge::before',
				'condition' => [
					'ekit_testimonial_wartermark_mask_show_badge' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		// title separetor
		$this->start_controls_section(
			'ekit_testimonial_title_separetor_tab',
			[
				'label' => esc_html__( 'Title Separetor', 'elementskit' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'ekit_testimonial_title_separetor' => 'yes'
				]
			]
		);

		$this->start_controls_tabs(
            'ekit_testimonial_client_title_separetor_color_tabs'
        );

        $this->start_controls_tab(
            'ekit_testimonial_client_title_separetor_normal_color_tab',
            [
                'label' => esc_html__( 'Normal', 'elementskit' ),
            ]
		);

		$this->add_control(
            'ekit_testimonial_title_separator_color',
            [
                'label'      => esc_html__( 'Separator Color', 'elementskit' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .elementskit-single-testimonial-slider .elementskit-border-hr' => 'background-color: {{VALUE}};',
                ],
            ]
        );

		$this->end_controls_tab();

        $this->start_controls_tab(
            'ekit_testimonial_client_title_separetor_active_color_tab',
            [
                'label' => esc_html__( 'Hover', 'elementskit' ),
            ]
		);

		$this->add_control(
            'ekit_testimonial_title_separator_active_color',
            [
                'label'      => esc_html__( 'Separator Color', 'elementskit' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .elementskit-single-testimonial-slider:hover .elementskit-border-hr' => 'background-color: {{VALUE}};',
                ],
            ]
        );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'ekit_testimonial_client_title_separetor_color_tab_end',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

        $this->add_responsive_control(
			'ekit_testimonial_title_separator_width',
			[
				'label' => esc_html__( 'Width', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 40,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-single-testimonial-slider .elementskit-border-hr' => 'width: {{SIZE}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'ekit_testimonial_title_separator_height',
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
					'size' => 2,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-single-testimonial-slider .elementskit-border-hr' => 'height: {{SIZE}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'ekit_testimonial_title_separator_margin',
			[
				'label' => esc_html__( 'Margin', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-single-testimonial-slider .elementskit-border-hr' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);

		$this->end_controls_section();

		// client style
		$this->start_controls_section(
			'ekit_testimonial_client_content_section',
			[
				'label' => esc_html__( 'Client', 'elementskit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		// client name heading
		$this->add_control(
			'ekit_testimonial_client_name_heading',
			[
				'label' => esc_html__( 'Client Name', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


		$this->start_controls_tabs(
            'ekit_testimonial_client_name_color_tabs'
        );

        $this->start_controls_tab(
            'ekit_testimonial_client_name_normal_color_tab',
            [
                'label' => esc_html__( 'Normal', 'elementskit' ),
            ]
		);

		// Client Name Color
		$this->add_control(
		    'ekit_testimonial_client_name_normal_color', [
			    'label'		 =>esc_html__( 'Color', 'elementskit' ),
			    'type'		 => Controls_Manager::COLOR,
			    'selectors'	 => [
				    '{{WRAPPER}} .elementskit-profile-info .elementskit-author-name' => 'color: {{VALUE}};'
			    ],
		    ]
	    );

		$this->end_controls_tab();

        $this->start_controls_tab(
            'ekit_testimonial_client_name_active_color_tab',
            [
                'label' => esc_html__( 'Hover', 'elementskit' ),
            ]
		);

		// Client Name Color
		$this->add_control(
		    'ekit_testimonial_client_name_active_color', [
			    'label'		 =>esc_html__( 'Color', 'elementskit' ),
			    'type'		 => Controls_Manager::COLOR,
			    'selectors'	 => [
				    '{{WRAPPER}} .elementskit-single-testimonial-slider:hover .elementskit-author-name' => 'color: {{VALUE}};'
			    ],
		    ]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'ekit_testimonial_client_name_color_tab_end',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

        // Client name typography
	    $this->add_group_control(
		    Group_Control_Typography::get_type(), [
			    'name'		 => 'ekit_testimonial_client_name_typography',
			    'selector'	 => '{{WRAPPER}} .elementskit-profile-info .elementskit-author-name',
		    ]
		);

		// client name margin bottom
		$this->add_responsive_control(
			'ekit_testimonial_client_name_spacing_bottom',
			[
				'label' => esc_html__( 'Margin Bottom', 'elementskit' ),
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
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-profile-info .elementskit-author-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// client designation heading
		$this->add_control(
			'ekit_testimonial_client_designation_heading',
			[
				'label' => esc_html__( 'Client Designation', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs(
            'ekit_testimonial_client_designation_color_tabs'
        );

        $this->start_controls_tab(
            'ekit_testimonial_client_designation_normal_color_tab',
            [
                'label' => esc_html__( 'Normal', 'elementskit' ),
            ]
		);

		// Designation Color
	    $this->add_control(
		    'ekit_testimonial_designation_normal_color', [
			    'label'		 =>esc_html__( 'Color', 'elementskit' ),
			    'type'		 => Controls_Manager::COLOR,
			    'selectors'	 => [
				    '{{WRAPPER}} .elementskit-profile-info .elementskit-author-des' => 'color: {{VALUE}};'
			    ],
		    ]
	    );

		$this->end_controls_tab();

        $this->start_controls_tab(
            'ekit_testimonial_client_designation_active_color_tab',
            [
                'label' => esc_html__( 'Hover', 'elementskit' ),
            ]
		);

		// Designation Color
	    $this->add_control(
		    'ekit_testimonial_designation_active_color', [
			    'label'		 =>esc_html__( 'Color', 'elementskit' ),
			    'type'		 => Controls_Manager::COLOR,
			    'selectors'	 => [
				    '{{WRAPPER}} .elementskit-single-testimonial-slider:hover .elementskit-author-des' => 'color: {{VALUE}};'
			    ],
		    ]
	    );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'ekit_testimonial_client_designation_color_tab_end',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_client_spacing',
			[
				'label' => esc_html__( 'Margin', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-commentor-bio' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

	    // Designation typography
	    $this->add_group_control(
		    Group_Control_Typography::get_type(), [
			    'name'		 => 'ekit_testimonial_designation_typography',
			    'selector'	 => '{{WRAPPER}} .elementskit-single-testimonial-slider .elementskit-author-des',
		    ]
		);

		// client logo heading
		$this->add_control(
			'ekit_testimonial_client_logo_heading',
			[
				'label' => esc_html__( 'Client Logo', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'ekit_testimonial_style' => ['style1', 'style2']
				]
			]
		);

		// client logo margin bottom
		$this->add_responsive_control(
			'ekit_testimonial_client_logo_margin_bottom',
			[
				'label' => esc_html__( 'Margin Bottom', 'elementskit' ),
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
					'size' => 32,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-commentor-content .elementskit-client_logo' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ekit_testimonial_style' => ['style1', 'style2']
				]
			]
		);

		// client image heading
		$this->add_control(
			'ekit_testimonial_client_image_heading',
			[
				'label' => esc_html__( 'Client Image', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'ekit_testimonial_style' => ['style1', 'style4', 'style5', 'style6']
				]
			]
		);

		// client image overlay
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_testimonial_client_image_background',
				'label' => esc_html__( 'Background', 'elementskit' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elementskit-profile-image-card::before',
				'condition' => [
					'ekit_testimonial_style' => ['style1']
				]
			]
		);

		$this->add_control(
			'ekit_testimonial_client_area_alignment',
			[
				'label' =>esc_html__( 'Alignment', 'elementskit' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'client_left'    => [
						'title' =>esc_html__( 'Left', 'elementskit' ),
						'icon' => 'fa fa-align-left',
					],
					'client_center' => [
						'title' =>esc_html__( 'Center', 'elementskit' ),
						'icon' => 'fa fa-align-center',
					],
					'client_right' => [
						'title' =>esc_html__( 'Right', 'elementskit' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'client_center',
				'condition' => [
					'ekit_testimonial_style' => ['style4', 'style5', 'style6']
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ekit_testimonial_client_image_border',
				'label' => esc_html__( 'Border', 'elementskit' ),
				'selector' => '{{WRAPPER}} .elementskit-commentor-image > img',
				'condition' => [
					'ekit_testimonial_style' => ['style4', 'style5', 'style6']
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ekit_testimonial_client_image_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'elementskit' ),
				'selector' => '{{WRAPPER}} .elementskit-commentor-image > img',
				'condition' => [
					'ekit_testimonial_style' => ['style4', 'style5', 'style6']
				]
			]
		);
		$this->add_control(
			'ekit_testimonial_client_image_margin_',
			[
				'label' => __( 'Margin', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-commentor-bio .elementskit-commentor-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'ekit_testimonial_style!' => ['style4', 'style5']
				]
			]
		);
		$this->add_responsive_control(
			'ekit_testimonial_client_image_margin_bottom',
			[
				'label' => esc_html__( 'Margin Bottom', 'elementskit' ),
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
					'{{WRAPPER}} .elementskit-commentor-bio .elementskit-commentor-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ekit_testimonial_style' => ['style4']
				]
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_client_image_margin_right',
			[
				'label' => esc_html__( 'Margin Right', 'elementskit' ),
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
					'{{WRAPPER}} .elementskit-commentor-bio .elementskit-commentor-image' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ekit_testimonial_style' => ['style5']
				]
			]
		);

		$this->add_responsive_control(
            'ekit_testimonial_client_image_size',
            [
                'label'   => esc_html__('Image Size', 'elementskit'),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
				],
                'default' => [
					'unit' => 'px',
                    'size' => 70,
				],
				'condition' => [
					'ekit_testimonial_style' => ['style4', 'style5', 'style6']
				]
            ]
		);

		$this->add_responsive_control(
			'ekit_testimonial_client_author_container_top',
			[
				'label' => esc_html__( 'Bottom', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => -98,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-commentor-bio' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ekit_testimonial_style' => ['style4']
				]
			]
		);

		$this->end_controls_section();

		// dot style
		$this->start_controls_section(
			'ekit_testimonial_client_dot_tab',
			[
				'label' => esc_html__( 'Dot', 'elementskit' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'ekit_testimonial_show_dot' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_client_dot_bottom',
			[
				'label' => esc_html__( 'Dot Top Spacing', 'elementskit' ),
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
					'size' => -50,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-testimonial-slider .slick-dots' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_client_dot_width',
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
					'size' => 8,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-testimonial-slider .slick-dots li button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_client_dot_height',
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
					'size' => 8,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-testimonial-slider .slick-dots li button' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_client_dot_border_radius',
			[
				'label' => esc_html__( 'Border radius', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-testimonial-slider .slick-dots li button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_client_dot_spacing',
			[
				'label' => esc_html__( 'Margin right', 'elementskit' ),
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
					'size' => 12,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-testimonial-slider .slick-dots li:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_testimonial_client_dot_background',
				'label' => esc_html__( 'Background', 'elementskit' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elementskit-testimonial-slider .slick-dots li button',
			]
		);

		$this->add_control(
			'ekit_testimonial_client_dot_active_heading',
			[
				'label' => esc_html__( 'Active', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_testimonial_client_dot_active_background',
				'label' => esc_html__( 'Background', 'elementskit' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elementskit-testimonial-slider .slick-dots li.slick-active button',
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_client_dot_active_width',
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
					'size' => 8,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-testimonial-slider .slick-dots li.slick-active button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_client_dot_active_height',
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
					'size' => 8,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-testimonial-slider .slick-dots li.slick-active button' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_client_dot_active_scale',
			[
				'label' => esc_html__( 'Scale', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => .5,
						'max' => 3,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1.2,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-testimonial-slider .slick-dots li.slick-active button' => 'transform: scale({{SIZE}});',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'ekit_testimonial_nav_style_tab',
			[
				'label' => esc_html__( 'Nav', 'elementskit' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'ekit_testimonial_show_arrow' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_nav_font_size',
			[
				'label' => esc_html__( 'Font Size', 'elementskit' ),
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
					'size' => 36,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-testimonial-slider .slick-prev' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementskit-testimonial-slider .slick-next' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_nav_right_icon',
			[
				'label' => esc_html__( 'Prev', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-testimonial-slider .slick-prev' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_nav_left_icon',
			[
				'label' => esc_html__( 'Next', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-testimonial-slider .slick-next' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_nav_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-testimonial-slider .slick-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .elementskit-testimonial-slider .slick-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_nav_width',
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
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-testimonial-slider .slick-prev' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementskit-testimonial-slider .slick-next' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_testimonial_nav_height',
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
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-testimonial-slider .slick-prev' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementskit-testimonial-slider .slick-next' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
            'ekit_testimonial_nav_vertical_align',
            [
                'label' => esc_html__( 'vertical_align', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px','%' ],
                'range' => [
                    '%' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-testimonial-slider .slick-arrow' => ' -webkit-transform: translateY({{SIZE}}{{UNIT}}); -ms-transform: translateY({{SIZE}}{{UNIT}}); transform: translateY({{SIZE}}{{UNIT}});',
                ],
            ]
        );


        $this->start_controls_tabs(
            'ekit_testimonial_nav_hover_normal_tabs'
        );

        $this->start_controls_tab(
            'ekit_testimonial_nav_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'elementskit' ),
            ]
		);

		$this->add_responsive_control(
			'ekit_testimonial_nav_font_color_normal',
			[
				'label' => esc_html__( 'Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .elementskit-testimonial-slider .slick-prev' => 'color: {{VALUE}}',
					'{{WRAPPER}} .elementskit-testimonial-slider .slick-next' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_testimonial_nav_background_normal',
				'label' => esc_html__( 'Background', 'elementskit' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elementskit-testimonial-slider .slick-prev, {{WRAPPER}} .elementskit-testimonial-slider .slick-next',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ekit_testimonial_nav_box_shadow_normal',
				'label' => esc_html__( 'Box Shadow', 'elementskit' ),
				'selector' => '{{WRAPPER}} .elementskit-testimonial-slider .slick-prev, {{WRAPPER}} .elementskit-testimonial-slider .slick-next',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ekit_testimonial_nav_border_normal',
				'label' => esc_html__( 'Border', 'elementskit' ),
				'selector' => '{{WRAPPER}} .elementskit-testimonial-slider .slick-prev, {{WRAPPER}} .elementskit-testimonial-slider .slick-next',
			]
		);

		$this->end_controls_tab();

        $this->start_controls_tab(
            'ekit_testimonial_nav_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'elementskit' ),
            ]
		);

		$this->add_responsive_control(
			'ekit_testimonial_nav_font_color_hover',
			[
				'label' => esc_html__( 'Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .elementskit-testimonial-slider .slick-prev:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .elementskit-testimonial-slider .slick-next:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_testimonial_nav_background_hover',
				'label' => esc_html__( 'Background', 'elementskit' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elementskit-testimonial-slider .slick-prev:hover, {{WRAPPER}} .elementskit-testimonial-slider .slick-next:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ekit_testimonial_nav_box_shadow_hover',
				'label' => esc_html__( 'Box Shadow', 'elementskit' ),
				'selector' => '{{WRAPPER}} .elementskit-testimonial-slider .slick-prev:hover, {{WRAPPER}} .elementskit-testimonial-slider .slick-next:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ekit_testimonial_nav_border_hover',
				'label' => esc_html__( 'Border', 'elementskit' ),
				'selector' => '{{WRAPPER}} .elementskit-testimonial-slider .slick-prev:hover, {{WRAPPER}} .elementskit-testimonial-slider .slick-next:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->insert_pro_message();
    }

    protected function render( ) {
        echo '<div class="ekit-wid-con" >';
            $this->render_raw();
        echo '</div>';
    }

    protected function render_raw( ) {

		$testimonials = [];
		$settings = $this->get_settings_for_display();
		extract($settings);
		$wrapper_data   = 	$ekit_testimonial_slidetoshow != "" ? "data-slidestoshow='$ekit_testimonial_slidetoshow' " : "";
		$wrapper_data  .= 	$ekit_testimonial_slidetoshow_tablet != "" ? "data-slidestoshowtablet= '$ekit_testimonial_slidetoshow_tablet' " : "";
		$wrapper_data  .= 	$ekit_testimonial_slidetoshow_mobile != "" ? "data-slidestoshowmobile= '$ekit_testimonial_slidetoshow_mobile' " : "";
		$wrapper_data  .= 	$ekit_testimonial_slidesToScroll != "" ? "data-slidestoscroll= '$ekit_testimonial_slidesToScroll' " : "";
		$wrapper_data  .= 	$ekit_testimonial_slidesToScroll_tablet != "" ? "data-slidesToScroll_tablet= '$ekit_testimonial_slidesToScroll_tablet' " : "";
		$wrapper_data  .= 	$ekit_testimonial_slidesToScroll_mobile != "" ? "data-slidesToScroll_mobile= '$ekit_testimonial_slidesToScroll_mobile' " : "";
		$wrapper_data  .= 	$ekit_testimonial_speed !="" ? "data-speed= '$ekit_testimonial_speed' " : "";
		$wrapper_data  .= 	$ekit_testimonial_autoplay != "" ? "data-autoplay= '$ekit_testimonial_autoplay' " : "";
		$wrapper_data  .= 	$ekit_testimonial_show_arrow != "" ? "data-show_arrow= '$ekit_testimonial_show_arrow' " : "";
		$wrapper_data  .= 	$ekit_testimonial_show_dot != "" ? "data-show_dot= '$ekit_testimonial_show_dot' " : "";
		$wrapper_data  .= 	is_rtl() ? "data-rtl='true'" : "";

		// new icon
		$migrated = isset( $settings['__fa4_migrated']['ekit_testimonial_left_arrows'] );
		// Check if its a new widget without previously selected icon using the old Icon control
		$is_new = empty( $settings['ekit_testimonial_left_arrow'] );

		$wrapper_data  .= 	($is_new || $migrated) ? $settings['ekit_testimonial_left_arrows']['library'] != 'svg' ? 'data-left_icon="'. $settings['ekit_testimonial_left_arrows']['value'] .'"' : '' : 'data-left_icon="'. $settings['ekit_testimonial_left_arrow'] .'"';

		// new icon
		$migrated = isset( $settings['__fa4_migrated']['ekit_testimonial_right_arrows'] );
		// Check if its a new widget without previously selected icon using the old Icon control
		$is_new = empty( $settings['ekit_testimonial_right_arrow'] );
		$wrapper_data  .= 	($is_new || $migrated) ? $settings['ekit_testimonial_left_arrows']['library'] != 'svg' ? ' data-right_icon="'. $settings['ekit_testimonial_right_arrows']['value'] .'"' : '' : ' data-right_icon="'. $settings['ekit_testimonial_right_arrow'] .'"';
		$wrapper_data  .= 	$ekit_testimonial_pause_on_hover != "" ? "data-pause_on_hover= '$ekit_testimonial_pause_on_hover' " : "";


        $testimonials = isset($ekit_testimonial_data) ? $ekit_testimonial_data : [];
		$style = isset($ekit_testimonial_style) ? $ekit_testimonial_style : 'default';
		switch ($ekit_testimonial_style) {
			case 'default':
				$wrapper_class = "elementskit-default-testimonial";
				break;
			default:
				$wrapper_class = "elementskit-default-testimonial";
				break;
		}

		if (is_array($testimonials) && !empty($testimonials)):


			require Handler::get_dir() . 'style/'.$style.'.php';
	 	endif; // end if check testimonila array
    }

    protected function _content_template() { }
}