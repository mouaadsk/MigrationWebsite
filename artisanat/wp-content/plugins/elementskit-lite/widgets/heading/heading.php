<?php
namespace Elementor;

use \ElementsKit\Elementskit_Widget_Heading_Handler as Handler;
use \ElementsKit\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;


class Elementskit_Widget_Heading extends Widget_Base {
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
			'ekit_heading_section_title',
			array(
				'label' => esc_html__( 'Title', 'elementskit' ),
			)
		);

		$this->add_control(
			'ekit_heading_title', [
				'label'			 =>esc_html__( 'Heading Title', 'elementskit' ),
				'type'			 => Controls_Manager::TEXT,
				'description'	=> esc_html__( '"Focused Title" Settings will be worked, If you use this {{something}} format', 'elementskit' ),
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Grow your ', 'elementskit' ),
				'default'	 =>esc_html__( 'Grow your ', 'elementskit' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'ekit_heading_title_tag',
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
				'default' => 'h2',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ekit_heading_section_subtitle',
			array(
				'label' => esc_html__( 'Subtitle', 'elementskit' ),
			)
		);

		$this->add_control(
			'ekit_heading_sub_title_show',
			[
				'label' => esc_html__( 'Show Sub Title', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->add_control(
			'ekit_heading_sub_title_border',
			[
				'label' => esc_html__( 'Border Sub Title', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'condition' => [
					'ekit_heading_sub_title_show' => 'yes'
				]
			]
		);

		$this->add_control(
			'ekit_heading_sub_title', [
				'label'			 =>esc_html__( 'Heading Sub Title', 'elementskit' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Time has changed', 'elementskit' ),
				'default'		 =>esc_html__( 'Time has changed', 'elementskit' ),
				'condition' => [
					'ekit_heading_sub_title_show' => 'yes'
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'ekit_heading_sub_title_position',
			[
				'label' => esc_html__( 'Sub Title Position', 'elementskit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'after_title',
				'options' => [
					'before_title' => esc_html__( 'Before Title', 'elementskit' ),
					'after_title' => esc_html__( 'After Title', 'elementskit' ),
				],
				'condition' => [
					'ekit_heading_sub_title_show' => 'yes'
				]
			]
		);

		$this->add_control(
			'ekit_heading_sub_title_tag',
			[
				'label' => esc_html__( 'Sub Title HTML Tag', 'elementskit' ),
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
				'condition' => [
					'ekit_heading_sub_title_show' => 'yes'
				]
			]
		);
		$this->end_controls_section();

		//Title Description
		$this->start_controls_section(
			'ekit_heading_section_extra_title',
			array(
				'label' => esc_html__( 'Title Description', 'elementskit' ),
			)
		);

		$this->add_control(
			'ekit_heading_section_extra_title_show',
			[
				'label' => esc_html__( 'Show Description', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);

		$this->add_control(
			'ekit_heading_extra_title',
			[
				'label' => esc_html__( 'Heading Description', 'elementskit' ),
				'type' => Controls_Manager::WYSIWYG,
				'rows' => 10,
				'label_block'	 => true,
				'default'	 =>esc_html__( 'A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradise ', 'elementskit' ),
				'placeholder'	 =>esc_html__( 'Title Description', 'elementskit' ),
				'condition' => [
					'ekit_heading_section_extra_title_show' => 'yes'
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'ekit_heading_section_seperator',
			array(
				'label' => esc_html__( 'Seperator', 'elementskit' ),
			)
		);


		$this->add_control(
			'ekit_heading_show_seperator', [
				'label'			 =>esc_html__( 'Show Seperator', 'elementskit' ),
				'type'			 => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' =>esc_html__( 'Yes', 'elementskit' ),
				'label_off' =>esc_html__( 'No', 'elementskit' ),
			]

		);
		$this->add_control(
			'ekit_heading_seperator_style',
			[
				'label' => esc_html__( 'Seperator Style', 'elementskit' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'elementskit-border-divider ekit-dotted' => esc_html__( 'Dotted', 'elementor' ),
					'elementskit-border-divider elementskit-style-long' => esc_html__( 'Solid', 'elementor' ),
					'elementskit-border-star' => esc_html__( 'Solid with star', 'elementor' ),
					'elementskit-border-star elementskit-bullet' => esc_html__( 'Solid with bullet', 'elementor' ),
					'ekit_border_custom' => esc_html__( 'Custom', 'elementor' ),
				],
				'default' => 'elementskit-border-divider',
				'condition' => [
					'ekit_heading_show_seperator' => 'yes',
				],
			]
		);

		$this->add_control(
			'ekit_heading_seperator_position',
			[
				'label' => esc_html__( 'Seperator Position', 'elementskit' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'top' => esc_html__( 'Top', 'elementor' ),
					'before' => esc_html__( 'Before Title', 'elementor' ),
					'after' => esc_html__( 'After Title', 'elementor' ),
					'bottom' => esc_html__( 'Bottom', 'elementor' ),
				],
				'default' => 'after',
				'condition' => [
					'ekit_heading_show_seperator' => 'yes',
				],
			]
		);

		$this->add_control(
			'ekit_heading_seperator_image',
			[
				'label' => esc_html__( 'Choose Image', 'elementskit' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'ekit_heading_show_seperator' => 'yes',
					'ekit_heading_seperator_style' => 'ekit_border_custom',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'ekit_heading_seperator_image_size',
				'default' => 'large',
				'condition' => [
					'ekit_heading_show_seperator' => 'yes',
					'ekit_heading_seperator_style' => 'ekit_border_custom',
				],
            ]
        );

		$this->end_controls_section();
		
		$this->start_controls_section(
			'ekit_heading_section_general',
			array(
				'label' => esc_html__( 'General', 'elementskit' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'ekit_heading_title_align', [
				'label'			 =>esc_html__( 'Alignment', 'elementskit' ),
				'type'			 => Controls_Manager::CHOOSE,
				'options'		 => [
					'text_left'		 => [
						'title'	 =>esc_html__( 'Left', 'elementskit' ),
						'icon'	 => 'fa fa-align-left',
					],
					'text_center'	 => [
						'title'	 =>esc_html__( 'Center', 'elementskit' ),
						'icon'	 => 'fa fa-align-center',
					],
					'text_right'		 => [
						'title'	 =>esc_html__( 'Right', 'elementskit' ),
						'icon'	 => 'fa fa-align-right',
					],
					// 'text_justify'	 => [
					// 	'title'	 =>esc_html__( 'Justified', 'elementskit' ),
					// 	'icon'	 => 'fa fa-align-justify',
					// ],
				],
				'default'		 => 'text_left',
			]
		);

		$this->end_controls_section();


		//Title Style Section
		$this->start_controls_section(
			'ekit_heading_section_title_style', [
				'label'	 => esc_html__( 'Title', 'elementskit' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'ekit_heading_title_color', [
				'label'		 =>esc_html__( 'Title primary color', 'elementskit' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .elementskit-section-title-wraper .elementskit-section-title' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'ekit_heading_title_shadow',
                'selector' => '{{WRAPPER}} .elementskit-section-title-wraper .elementskit-section-title',

            ]
        );
		$this->add_responsive_control(
			'ekit_heading_title_margin',
			array(
				'label'      => esc_html__( 'Margin', 'elementskit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .elementskit-section-title-wraper .elementskit-section-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'ekit_heading_title_typography',
			'selector'	 => '{{WRAPPER}} .elementskit-section-title-wraper .elementskit-section-title',
			]
		);

		$this->end_controls_section();

		//Focused Title Style Section
		$this->start_controls_section(
			'ekit_heading_section_focused_title_style', [
				'label'	 => esc_html__( 'Focused Title', 'elementskit' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'ekit_heading_focused_title_color', [
				'label'		 =>esc_html__( 'Title primary color', 'elementskit' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors'	 => [
					'{{WRAPPER}} .elementskit-section-title-wraper .elementskit-section-title > span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'ekit_heading_focused_title_typography',
			'selector'	 => '{{WRAPPER}} .elementskit-section-title-wraper .elementskit-section-title > span',
			]
		);
		$this->add_responsive_control(
			'ekit_heading_title_text_decoration_color', [
				'label'		 =>esc_html__( 'Text decoration color', 'elementskit' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .elementskit-section-title-wraper .elementskit-section-title > span' => 'text-decoration-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'ekit_heading_focus_title_shadow',
                'selector' => '{{WRAPPER}} .elementskit-section-title-wraper .elementskit-section-title > span',

            ]
        );
		$this->add_responsive_control(
			'ekit_heading_focused_title_secondary_spacing',
			[
				'label' => esc_html__( 'Padding', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-section-title-wraper .elementskit-section-title > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'ekit_heading_use_focused_title_bg', [
				'label'			 =>esc_html__( 'Use background color on text', 'elementskit' ),
				'type'			 => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' =>esc_html__( 'Yes', 'elementskit' ),
				'label_off' =>esc_html__( 'No', 'elementskit' ),
				'condition' => [
					'ekit_heading_use_title_text_fill!' => 'yes'
				],
			]
		);
        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
				'name'     => 'ekit_heading_focused_title_secondary_bg',
				'label'		 => esc_html__( 'Focused Title Secondary BG', 'elementskit' ),
                'default' => '',
				'selector' => '{{WRAPPER}} .elementskit-section-title-wraper .elementskit-section-title > span',
				'condition' => [
					'ekit_heading_use_focused_title_bg' => 'yes',
					'ekit_heading_use_title_text_fill!' => 'yes'
				],
            )
		);
		$this->add_control(
			'ekit_heading_focused_title_secondary_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-section-title-wraper .elementskit-section-title > span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'ekit_heading_use_focused_title_bg' => 'yes',
					'ekit_heading_use_title_text_fill!' => 'yes'
				],
			]
		);
		$this->add_control(
			'ekit_heading_use_title_text_fill', [
				'label'			 =>esc_html__( 'Use text fill', 'elementskit' ),
				'type'			 => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' =>esc_html__( 'Yes', 'elementskit' ),
				'label_off' =>esc_html__( 'No', 'elementskit' ),
				'separetor' => 'before',
				'condition' => [
					'ekit_heading_use_focused_title_bg!' => 'yes'
				]
			]
		);
        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
				'name'     => 'ekit_heading_title_secondary_bg',
				'label'		 => esc_html__( 'Focused Title Secondary BG', 'elementskit' ),
                'default' => '',
				'selector' => '{{WRAPPER}} .elementskit-section-title-wraper .elementskit-section-title.text_fill > span',
				'condition' => [
					'ekit_heading_use_title_text_fill' => 'yes',
					'ekit_heading_use_focused_title_bg!' => 'yes'
				],
            )
        );
		$this->end_controls_section();

		//Sub title Style Section
		$this->start_controls_section(
			'ekit_heading_section_sub_title_style', [
				'label'	 => esc_html__( 'Sub Title', 'elementskit' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [
					'ekit_heading_sub_title_show' => 'yes',
					'ekit_heading_sub_title!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'ekit_heading_sub_title_color', [
				'label'		 => esc_html__( 'Color', 'elementskit' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .elementskit-section-title-wraper .elementskit-section-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'ekit_heading_sub_title_typography',
			'selector'	 => '{{WRAPPER}} .elementskit-section-title-wraper .elementskit-section-subtitle',
			]
		);

		$this->add_responsive_control(
			'ekit_heading_sub_title_margn',
			[
				'label' => esc_html__( 'Margin', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-section-title-wraper .elementskit-section-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ekit_heading_use_sub_title_text_fill', [
				'label'			 =>esc_html__( 'Use text fill', 'elementskit' ),
				'type'			 => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' =>esc_html__( 'Yes', 'elementskit' ),
				'label_off' =>esc_html__( 'No', 'elementskit' ),

			]
		);
        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
				'name'     => 'ekit_heading_sub_title_secondary_bg',
				'label'		 => esc_html__( 'Sub Title', 'elementskit' ),
                'default' => '',
				'selector' => '{{WRAPPER}} .elementskit-section-title-wraper .elementskit-section-subtitle',
				'condition' => [
					'ekit_heading_use_sub_title_text_fill' => 'yes',
				],
            )
		);

		$this->add_control(
			'ekit_heading_sub_title_border_hr',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
				'condition' => [
					'ekit_heading_sub_title_border' => 'yes',
				],
			]
		);

        $this->add_control(
            'ekit_heading_sub_title_border_heading_title_left',
            [
                'label' => esc_html__( 'Subtitle Border Left', 'elementskit' ),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'ekit_heading_sub_title_border' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
				'name'     => 'ekit_heading_sub_title_border_color_left',
				'label'		 => esc_html__( 'Sub Title', 'elementskit' ),
				'selector' => '{{WRAPPER}} .elementskit-section-subtitle.elementskit-style-border::before',
				'condition' => [
					'ekit_heading_sub_title_border' => 'yes',
				],
            )
		);

		
		$this->add_responsive_control(
			'ekit_heading_sub_title_border_left_width',
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
					'size' => 40,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-section-subtitle.elementskit-style-border::before' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ekit_heading_sub_title_border' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_heading_sub_title_border_heading_title_right_margin',
			[
				'label' => __( 'Margin', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-section-subtitle.elementskit-style-border::before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'ekit_heading_sub_title_border' => 'yes',
				],
			]
		);

        $this->add_control(
            'ekit_heading_sub_title_border_heading_title_right',
            [
                'label' => esc_html__( 'Subtitle Border Right color', 'elementskit' ),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'ekit_heading_sub_title_border' => 'yes',
                ],
            ]
		);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'ekit_heading_sub_title_border_color_right',
                'label'		 => esc_html__( 'Sub Title', 'elementskit' ),
                'selector' => '{{WRAPPER}} .elementskit-section-subtitle.elementskit-style-border::after',
                'condition' => [
                    'ekit_heading_sub_title_border' => 'yes',
                ],
            )
        );

		$this->add_responsive_control(
			'ekit_heading_sub_title_border_right_width',
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
					'size' => 40,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-section-subtitle.elementskit-style-border::after' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ekit_heading_sub_title_border' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_heading_sub_title_border_heading_title_left_margin',
			[
				'label' => __( 'Margin', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-section-subtitle.elementskit-style-border::after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'ekit_heading_sub_title_border' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_heading_sub_title_border_height',
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
					'size' => 3,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-section-subtitle.elementskit-style-border::before, {{WRAPPER}} .elementskit-section-subtitle.elementskit-style-border::after' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ekit_heading_sub_title_border' => 'yes',
				],
			]
		);

        $this->add_responsive_control(
            'ekit_heading_sub_title_vertical_alignment',
            [
                'label' => esc_html__( 'Vertical Position', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => -20,
                        'max' => 20,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-section-subtitle.elementskit-style-border::before, {{WRAPPER}} .elementskit-section-subtitle.elementskit-style-border::after' => 'transform: translateY({{SIZE}}{{UNIT}}); -webkit-transform: translateY({{SIZE}}{{UNIT}}); -ms-transform: translateY({{SIZE}}{{UNIT}})',
                ],
                'condition' => [
                    'ekit_heading_sub_title_border' => 'yes',
                ],
            ]
        );

		$this->end_controls_section();

		//Extra Title Style Section
		$this->start_controls_section(
			'ekit_heading_section_extra_title_style', [
				'label'	 => esc_html__( 'Title Description', 'elementskit' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [
					'ekit_heading_section_extra_title_show' => 'yes',
					'ekit_heading_extra_title!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'ekit_heading_extra_title_color', [
				'label'		 =>esc_html__( 'Title Description color', 'elementskit' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .elementskit-section-title-wraper p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'ekit_heading_extra_title_typography',
			'selector'	 => '{{WRAPPER}} .elementskit-section-title-wraper p',
			]
		);

		$this->add_responsive_control(
			'ekit_heading_extra_title_margin',
			array(
				'label'      => esc_html__( 'Margin', 'elementskit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .elementskit-section-title-wraper p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Seperator Style Section
		$this->start_controls_section(
			'ekit_heading_section_seperator_style', [
				'label'	 => esc_html__( 'Seperator', 'elementskit' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [
					'ekit_heading_show_seperator' => 'yes'
				]
			]
		);
		$this->add_responsive_control(
			'ekit_heading_seperator_width',
			[
				'label' => esc_html__( 'Width', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-section-title-wraper .elementskit-border-divider' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementskit-section-title-wraper .elementskit-border-divider.elementskit-style-long' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementskit-section-title-wraper .elementskit-border-star' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'		=> [
					'ekit_heading_seperator_style!' => 'ekit_border_custom'
				]
			]
		);

		$this->add_responsive_control(
			'ekit_heading_seperator_height',
			[
				'label' => esc_html__( 'Height', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 4,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-section-title-wraper .elementskit-border-divider, {{WRAPPER}} .elementskit-border-divider::before' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementskit-section-title-wraper .elementskit-border-divider.elementskit-style-long' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementskit-section-title-wraper .elementskit-border-star' => 'height: {{SIZE}}{{UNIT}};',
					
				],
				'condition'		=> [
					'ekit_heading_seperator_style!' => 'ekit_border_custom'
				]
			]
		);

		$this->add_responsive_control(
			'ekit_heading_seperator_margin',
			[
				'label' => esc_html__( 'Margin', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-section-title-wraper .ekit_heading_separetor_wraper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_heading_seperator_color', [
				'label'		 =>esc_html__( 'Seperator color', 'elementskit' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .elementskit-section-title-wraper .elementskit-border-divider' => 'background: linear-gradient(90deg, {{VALUE}} 0%, {{VALUE}} 100%);',
					'{{WRAPPER}} .elementskit-section-title-wraper .elementskit-border-divider:before' => 'background-color: {{VALUE}};box-shadow: 9px 0px 0px 0px {{VALUE}}, 18px 0px 0px 0px {{VALUE}};',
					'{{WRAPPER}} .elementskit-section-title-wraper .elementskit-border-divider.elementskit-style-long' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementskit-section-title-wraper .elementskit-border-star' => 'background: linear-gradient(90deg, {{VALUE}} 0%, {{VALUE}} 38%, rgba(255, 255, 255, 0) 38%, rgba(255, 255, 255, 0) 62%, {{VALUE}} 62%, {{VALUE}} 100%);',
					'{{WRAPPER}} .elementskit-section-title-wraper .elementskit-border-star:after' => 'background-color: {{VALUE}};',
				],
				'condition'		=> [
					'ekit_heading_seperator_style!' => 'ekit_border_custom'
				]
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

		// Image sectionn
        $image_html = '';
        if (!empty($settings['ekit_heading_seperator_image']['url'])) {

            $this->add_render_attribute('image', 'src', $settings['ekit_heading_seperator_image']['url']);
            $this->add_render_attribute('image', 'alt', Control_Media::get_image_alt($settings['ekit_heading_seperator_image']));
            $this->add_render_attribute('image', 'title', Control_Media::get_image_title($settings['ekit_heading_seperator_image']));

            $image_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'ekit_heading_seperator_image_size', 'ekit_heading_seperator_image');

        }

		$seperator = '';
		if ($ekit_heading_seperator_style != 'ekit_border_custom') {
			$seperator = ($ekit_heading_show_seperator == 'yes') ? '<div class="ekit_heading_separetor_wraper ekit_heading_'. $ekit_heading_seperator_style .'"><div class="'.$ekit_heading_seperator_style.'"></div></div>' : '';
		} else {
			$seperator = ($ekit_heading_show_seperator == 'yes') ? '<div class="ekit_heading_separetor_wraper ekit_heading_'. $ekit_heading_seperator_style .'"><div class="'.$ekit_heading_seperator_style.'">'.$image_html.'</div></div>' : '';
		}


		$title_text_fill = ($ekit_heading_use_title_text_fill == 'yes') ? 'text_fill' : '';

		$sub_title_text_fill =	 ($settings['ekit_heading_use_sub_title_text_fill'] == 'yes') ? 'elementskit-gradient-title' : '';

		$sub_title_border =	 ($settings['ekit_heading_sub_title_border'] == 'yes') ? 'elementskit-style-border' : '';


		echo '<div class="elementskit-section-title-wraper '.$ekit_heading_title_align.'   ekit_heading_tablet-'. $settings['ekit_heading_title_align_tablet'] .'   ekit_heading_mobile-'. $settings['ekit_heading_title_align_mobile'] .'">';

			echo ($ekit_heading_seperator_position == 'top') ? $seperator : '';
			if($ekit_heading_sub_title_position == 'before_title'){
				if((!empty($ekit_heading_sub_title) && ($settings['ekit_heading_sub_title_show'] == 'yes'))):
					echo '<'.$ekit_heading_sub_title_tag.' class="elementskit-section-subtitle '.$sub_title_text_fill.' '.$sub_title_border.'">'.esc_html( $ekit_heading_sub_title ).'</'.$ekit_heading_sub_title_tag.'>';
				endif;
			}
			echo ($ekit_heading_seperator_position == 'before') ? $seperator : '';
			if(!empty($ekit_heading_title)):
				echo '<'.$ekit_heading_title_tag.' class="elementskit-section-title '.$title_text_fill.'">
					'.\ElementsKit\Utils::kspan($ekit_heading_title).'
				</'.$ekit_heading_title_tag.'>';
			endif;
			echo ($ekit_heading_seperator_position == 'after') ? $seperator : '';
			if($ekit_heading_sub_title_position == 'after_title'){
				if(!empty($ekit_heading_sub_title) && ($settings['ekit_heading_sub_title_show'] == 'yes')):
					echo '<'.$ekit_heading_sub_title_tag.' class="elementskit-section-subtitle '.$sub_title_text_fill.' '.$sub_title_border.'">'.esc_html( $ekit_heading_sub_title ).'</'.$ekit_heading_sub_title_tag.'>';
				endif;
			}

			if((!empty($ekit_heading_extra_title)) && ($settings['ekit_heading_section_extra_title_show'] == 'yes')):
				echo \ElementsKit\Utils::kspan( wpautop($ekit_heading_extra_title) );
			endif;

			echo ($ekit_heading_seperator_position == 'bottom') ? $seperator : '';

		echo '</div>';


    }
    protected function _content_template() { }
}