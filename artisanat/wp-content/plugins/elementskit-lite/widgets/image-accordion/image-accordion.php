<?php
namespace Elementor;

use \ElementsKit\Elementskit_Widget_Image_Accordion_Handler as Handler;
use \ElementsKit\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;


class Elementskit_Widget_Image_Accordion extends Widget_Base {
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
            'ekit_img_accordion_content_tab',
            [
                'label' => esc_html__('Content', 'elementskit'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'ekit_img_accordion_items',
            [
                'label' => esc_html__('Accordion Items', 'elementskit'),
                'type' => Controls_Manager::REPEATER,
                'separator' => 'before',
                'default' => [
                    [ 'ekit_img_accordion_title' => esc_html__('This is title','elementskit') ],
                    [ 'ekit_img_accordion_icon' => esc_attr('icon icon-minus') ],
                    [ 'ekit_img_accordion_link' => esc_url('#') ],
                    [ 'ekit_img_accordion_button_label' => esc_html__('Read More','elementskit') ],
                ],
                'fields' => [

                    [
                        'name' => 'ekit_img_accordion_active',
                        'label' => esc_html__('Active ? ', 'elementskit'),
                        'type' => Controls_Manager::SWITCHER,
                        'default' => 'no',
                        'label_on' =>esc_html__( 'Yes', 'elementskit' ),
                        'label_off' =>esc_html__( 'No', 'elementskit' ),
                    ],
                    [
                        'name' => 'ekit_img_accordion_bg',
                        'label' => esc_html__( 'Background Image', 'elementskit' ),
                        'type' => Controls_Manager::MEDIA,

                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name' => 'ekit_img_accordion_title',
                        'label' => esc_html__('Title', 'elementskit'),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,

                        'default' => esc_html__('Image accordion Title'),
                    ],
                    [   'name' => 'ekit_img_accordion_enable_icon',
                        'label' => esc_html__( 'Enable Icon', 'elementskit' ),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => esc_html__( 'Yes', 'elementskit' ),
                        'label_off' => esc_html__( 'No', 'elementskit' ),
                        'return_value' => 'yes',
                        'default' => '',
                    ],
                    [
                        'name' => 'ekit_img_accordion_title_icons',
                        'label' => esc_html__('Icon for title', 'elementskit'),
                        'type' => Controls_Manager::ICONS,
                        'fa4compatibility' => 'ekit_img_accordion_title_icon',
                        'default' => [
                            'value' => '',
                        ],
                        'condition' => [
                            'ekit_img_accordion_enable_icon' => 'yes',
                        ]
                    ],
                    [
                        'name' => 'ekit_img_accordion_title_icon_position',
                        'label' =>esc_html__( 'Icon Position', 'elementskit' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'left',
                        'options' => [
                            'left' =>esc_html__( 'Before', 'elementskit' ),
                            'right' =>esc_html__( 'After', 'elementskit' ),
                        ],
                        'condition' => [
                            'ekit_img_accordion_title_icons!' => '',
                            'ekit_img_accordion_enable_icon' => 'yes',
                        ],
                    ],

                    [   'name' => 'ekit_img_accordion_enable_button',
                        'label' => esc_html__( 'Enable Button', 'elementskit' ),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => esc_html__( 'Yes', 'elementskit' ),
                        'label_off' => esc_html__( 'No', 'elementskit' ),
                        'return_value' => 'yes',
                        'default' => 'yes',
                    ],

                    [
                        'name' => 'ekit_img_accordion_button_label',
                        'label' => esc_html__('Button Label', 'elementskit'),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => esc_html__('Read More','elementskit'),
                        'condition' => [
                            'ekit_img_accordion_enable_button' => 'yes',
                        ]
                    ],
                    [
                        'name' => 'ekit_img_accordion_button_url',
                        'label' => esc_html__('Button URL', 'elementskit'),
                        'type' => Controls_Manager::URL,
                        'condition' => [
                            'ekit_img_accordion_enable_button' => 'yes',
                        ]
                    ],
                    [   'name' => 'ekit_img_accordion_enable_pupup',
                        'label' => esc_html__( 'Enable Popup', 'elementskit' ),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => esc_html__( 'Yes', 'elementskit' ),
                        'label_off' => esc_html__( 'No', 'elementskit' ),
                        'return_value' => 'yes',
                        'default' => '',
                    ],

                    [
                        'name' => 'ekit_img_accordion_pup_up_icons',
                        'label' => esc_html__('Pupup Icon', 'elementskit'),
                        'type' => Controls_Manager::ICONS,
                        'fa4compatibility' => 'ekit_img_accordion_pup_up_icon',
                        'default' => [
                            'value' => 'icon icon-plus',
                            'library'   => 'ekiticons'
                        ],
                        'label_block' => true,
                        'condition' => [
                            'ekit_img_accordion_enable_pupup' => 'yes'
                        ]
                    ],
                    [   'name' => 'ekit_img_accordion_enable_project_link',
                        'label' => esc_html__( 'Enable Project Link', 'elementskit' ),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => esc_html__( 'Yes', 'elementskit' ),
                        'label_off' => esc_html__( 'No', 'elementskit' ),
                        'return_value' => 'yes',
                        'default' => '',
                    ],
                    [
                        'name' => 'ekit_img_accordion_project_link',
                        'label' => esc_html__( 'Project Link', 'elementskit' ),
                        'type' => Controls_Manager::URL,
                        'placeholder' => esc_html__( 'https://your-link.com', 'elementskit' ),
                        'show_external' => true,
                        'default' => [
                            'url' => '',
                            'is_external' => true,
                            'nofollow' => true,
                        ],
                        'condition' => [
                            'ekit_img_accordion_enable_project_link' => 'yes'
                        ]
                    ],

                    [
                        'name' => 'ekit_img_accordion_project_link_icons',
                        'label' => esc_html__('Project Link Icon', 'elementskit'),
                        'type' => Controls_Manager::ICONS,
                        'fa4compatibility' => 'ekit_img_accordion_project_link_icon',
                        'default' => [
                            'value' => 'icon icon icon-link',
                            'library'   => 'ekiticons'
                        ],
                        'label_block' => true,
                        'condition' => [
                            'ekit_img_accordion_enable_project_link' => 'yes'
                        ]
                    ],
                ],
                'title_field' => '{{ ekit_img_accordion_title }}',
            ]
        );


        $this->end_controls_section();

        /** Tab Style (Image accordion General Style) */
      $this->start_controls_section(
        'ekit_img_accordion_general_settings',
        [
          'label' => esc_html__( 'General', 'elementskit' ),
          'tab' => Controls_Manager::TAB_STYLE
        ]
      );

      $this->add_responsive_control(
        'ekit_img_accordion_min_height',
        [
            'label' => esc_html__( 'Min Height', 'elementskit' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],

            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 466,
            ],
            'selectors' => [
                '{{WRAPPER}} .elementskit-image-accordion-wraper .elementskit-single-image-accordion' => 'min-height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );


      $this->add_responsive_control(
        'ekit_img_accordion_gutter',
        [
          'label' => esc_html__( 'Gutter', 'elementskit' ),
          'type' => Controls_Manager::SLIDER,
          'range' => [
            'px' => [
                'min' => 0,
                'max' => 100,
            ],
        ],
          'selectors' => [
              '{{WRAPPER}} .elementskit-image-accordion-wraper .elementskit-single-image-accordion' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
          ],
        ]
      );
	   $this->add_control(
        'ekit_img_accordion_active_background_text',
        [
          'label' => esc_html__( 'Active Item Background', 'elementskit' ),
          'type' => Controls_Manager::HEADING,
          'separator' => 'before'
        ]
      );

      $this->add_group_control(
        Group_Control_Background::get_type(),
            array(
                'name'     => 'ekit_img_accordion_bg_active_color',
                'default' => '',
                'selector' => '{{WRAPPER}} .elementskit-image-accordion-wraper .elementskit-single-image-accordion.active:before',

			)
        );
      $this->add_responsive_control(
        'ekit_img_accordion_container_padding',
        [
          'label' => esc_html__( 'Padding', 'elementskit' ),
          'type' => Controls_Manager::DIMENSIONS,
          'size_units' => [ 'px', 'em', '%' ],
		  'separator' => 'before',
          'selectors' => [
              '{{WRAPPER}} .elementskit-image-accordion-wraper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ],
        ]
      );

      $this->add_responsive_control(
        'ekit_img_accordion_container_margin',
        [
          'label' => esc_html__( 'Margin', 'elementskit' ),
          'type' => Controls_Manager::DIMENSIONS,
          'size_units' => [ 'px', 'em', '%' ],
          'selectors' => [
              '{{WRAPPER}} .elementskit-image-accordion-wraper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ],
        ]
      );
      $this->add_group_control(
        Group_Control_Border::get_type(),
        [
          'name' => 'ekit_img_accordion_border_group',
          'label' => esc_html__( 'Border', 'elementskit' ),
          'selector' => '{{WRAPPER}} .elementskit-image-accordion-wraper',
        ]
      );

      $this->add_control(
        'ekit_img_accordion_border_radius',
        [
          'label' => esc_html__( 'Border Radius', 'elementskit' ),
          'type' => Controls_Manager::SLIDER,
          'default' => [
            'size' => 4,
          ],
          'range' => [
            'px' => [
              'max' => 500,
            ],
          ],
          'selectors' => [
            '{{WRAPPER}} .elementskit-image-accordion-wraper' => 'border-radius: {{SIZE}}px;',
          ],
        ]
      );
      $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        [
          'name' => 'ekit_img_accordion_shadow',
          'selector' => '{{WRAPPER}} .elementskit-image-accordion-wraper',
        ]
      );

      $this->end_controls_section();


        /** Tab Style (Image accordion Content Style) */
        $this->start_controls_section(
            'ekit_img_accordion_section_img_accordion_title_settings',
            [
            'label' => esc_html__( 'Title', 'elementskit' ),
            'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'ekit_img_accordion_section_img_accordion_icon_title',
            [
                'label' => esc_html_x( 'Margin', 'Border Control', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
				'default' => [
					'top' => '0',
					'bottom' => '20',
					'left' => '0',
					'right' => '0',
					'unit' => 'px',
				],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-single-image-accordion .elementskit-accordion-title-wraper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'ekit_img_accordion_section_img_accordion_title_icon_spacing',
            [
                'label' => esc_html_x( 'Title Icon Spacing', 'Border Control', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .elementskit-single-image-accordion .elementskit-accordion-title-wraper .icon-title > i, {{WRAPPER}} .elementskit-single-image-accordion .elementskit-accordion-title-wraper .icon-title > svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
			'ekit_img_accordion_title_color',
			[
			  'label' => esc_html__( 'Color', 'elementskit' ),
			  'type' => Controls_Manager::COLOR,
			  'default' => '#fff',
			  'selectors' => [
                '{{WRAPPER}} .elementskit-image-accordion-wraper .elementskit-accordion-title-wraper .elementskit-accordion-title ' => 'color: {{VALUE}};',
                '{{WRAPPER}} .elementskit-image-accordion-wraper .elementskit-accordion-title-wraper .elementskit-accordion-title svg path' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
			  ],
			]
          );
          
          $this->add_responsive_control(
            'ekit_img_accordion_title_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-image-accordion-wraper .elementskit-accordion-title-wraper .elementskit-accordion-title i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementskit-image-accordion-wraper .elementskit-accordion-title-wraper .elementskit-accordion-title svg' => 'max-width: {{SIZE}}{{UNIT}}; height: auto',
                ],
            ]
        );

		  $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
			  'name' => 'ekit_img_accordion_title_typography_group',
			  'selector' => '{{WRAPPER}} .elementskit-image-accordion-wraper .elementskit-accordion-title-wraper .elementskit-accordion-title',
			]
		  );

      $this->end_controls_section();


      $this->end_controls_section();
        /** Tab Style (Image accordion Content Style) */
        $this->start_controls_section(
            'ekit_img_accordion_section_img_accordion_content_settings',
            [
            'label' => esc_html__( 'Content', 'elementskit' ),
            'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_responsive_control(
            'ekit_img_accordion_section_img_accordion_content_align',
            [
                'label' =>esc_html__( 'Alignment', 'elementskit' ),
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
                    '{{WRAPPER}} .elementskit-single-image-accordion .elementskit-accordion-content' => 'text-align: {{VALUE}};'
                ],
                'default' => 'center',
            ]
        );
        $this->add_responsive_control(
            'ekit_img_accordion_section_img_accordion_content_padding',
            [
                'label' =>esc_html__( 'Padding', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-single-image-accordion .elementskit-accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ekit_img_accordion_section_img_accordion_content_position',
            [
                'label' => esc_html__( 'Vertical Position', 'elementskit' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Top', 'elementskit' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'elementskit' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Bottom', 'elementskit' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-image-accordion-wraper .elementskit-single-image-accordion' => 'align-items: {{VALUE}}',
                ],
            ]
        );


      $this->end_controls_section();

        // Button
        $this->start_controls_section(
            'ekit_img_accordion_button_style_settings',
            [
                'label' => esc_html__( 'Button', 'elementskit' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ekit_img_accordion_text_padding',
            [
                'label' =>esc_html__( 'Padding', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default' => [
                    'top' => 15,
                    'right' => 20,
                    'bottom' => 15,
                    'left' => 20,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-accordion-content .elementskit-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ekit_img_accordion_btn_typography',
                'label' =>esc_html__( 'Typography', 'elementskit' ),
                'selector' => '{{WRAPPER}} .elementskit-accordion-content .elementskit-btn',
            ]
        );

        $this->start_controls_tabs( 'ekit_img_accordion_tabs_button_style' );

        $this->start_controls_tab(
            'ekit_img_accordion_tab_button_normal',
            [
                'label' =>esc_html__( 'Normal', 'elementskit' ),
            ]
        );

        $this->add_control(
            'ekit_img_accordion_btn_text_color',
            [
                'label' =>esc_html__( 'Text Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-accordion-content .elementskit-btn' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'ekit_img_accordion_btn_bg_color_group',
				'label' => esc_html__( 'Background', 'elementskit' ),
                'selector' => '{{WRAPPER}} .elementskit-accordion-content .elementskit-btn',
				'fields_options' => [
                    'background' => [
						'color' => [
								'default' => '#fff'
							],
                    ],

				],

            )
        );

		$this->add_control(
            'ekit_img_accordion_btn_border_color',
            [
                'label' => esc_html__( 'Border', 'elementskit' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',

            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ekit_img_accordion_btn_border_group',
                'label' => esc_html__( 'Border', 'elementskit' ),
                'selector' => '{{WRAPPER}} .elementskit-accordion-content .elementskit-btn',
				'fields_options' => [
                    'border' => [
                        'default' => 'solid',
                    ],
                    'width' => [
                        'default' => [
                            'top' => '1',
                            'right' => '1',
                            'bottom' => '1',
                            'left' => '1',
                            'unit' => 'px'
                        ],
                    ],
                    'color' => [
                        'default' => '#ffffff',
                    ],
                ],
            ]
        );
        $this->add_control(
            'ekit_img_accordion_btn_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
				'default' => ['top' => '5', 'bottom' => '5', 'left' => '5', 'right' => '5', 'unit' => 'px'],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-accordion-content .elementskit-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ekit_img_accordion_btn_tab_button_hover',
            [
                'label' =>esc_html__( 'Hover', 'elementskit' ),
            ]
        );

        $this->add_control(
            'ekit_img_accordion_btn_hover_color',
            [
                'label' =>esc_html__( 'Text Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-accordion-content .elementskit-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'ekit_img_accordion_btn_bg_hover_color_group',
                'default' => '',
                'selector' => '{{WRAPPER}} .elementskit-accordion-content .elementskit-btn:hover',
            )
        );
        $this->add_control(
            'ekit_img_accordion_btn_border_color_hover',
            [
                'label' => esc_html__( 'Border', 'elementskit' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ekit_img_accordion_btn_border_hover_group',
                'label' => esc_html__( 'Border', 'elementskit' ),
                'selector' => '{{WRAPPER}} .elementskit-accordion-content .elementskit-btn:hover',
            ]
        );
        $this->add_control(
            'btn_border_radius_hover',
            [
                'label' => esc_html__( 'Border Radius', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-accordion-content .elementskit-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->end_controls_section();
        // PopUp

        $this->start_controls_section(
            'ekit_img_accordion_style_section',
            [
                'label' => esc_html__( 'Action Icon', 'elementskit' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ekit_img_accordion_section_img_accordion_icon_left_spacing',
            [
                'label' => esc_html__( 'Icon Left Spacing', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-single-image-accordion .elementskit-icon-wraper > a:not(:last-child)' => 'margin-right: {{SIZE}}px',
                ],
            ]
        );

        $this->add_control(
            'ekit_img_accordion_section_img_accordion_icon_spacing',
            [
                'label' => esc_html_x( 'Icon Container Spacing', 'Border Control', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .elementskit-single-image-accordion .elementskit-icon-wraper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs('ekit_img_accordion_pup_up_style_tabs');

        $this->start_controls_tab(
            'ekit_img_accordion_pupup_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'elementskit' ),
            ]
        );
        $this->add_control(
            'ekit_img_accordion_pup_up_icon_color',
            [
                'label' => esc_html__( 'Popup Icon color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementskit-icon-wraper a:first-child' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementskit-icon-wraper a:first-child svg path'   => 'stroke: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ekit_img_accordion_pup_up_project_color',
            [
                'label' => esc_html__( 'Link Icon color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementskit-icon-wraper a:last-child' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementskit-icon-wraper a:last-child svg path'   => 'stroke: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ekit_img_accordion_pup_up_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'elementskit' ),
            ]
        );

        $this->add_control(
            'ekit_img_accordion_pup_up_icon_color_hover',
            [
                'label' => esc_html__( 'Popup Icon color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementskit-icon-wraper a:first-child:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementskit-icon-wraper a:first-child:hover svg path'   => 'stroke: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ekit_img_accordion_pup_up_project_color_hover',
            [
                'label' => esc_html__( 'Link Icon color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementskit-icon-wraper a:last-child:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementskit-icon-wraper a:last-child:hover svg path'   => 'stroke: {{VALUE}}; fill: {{VALUE}};',
                ],
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
        $settings = $this->get_settings_for_display();
        extract($settings); ?>

        <div class="elementskit-image-accordion-wraper">
            <?php foreach ( $ekit_img_accordion_items as $item ) : ?>
            <div class="elementskit-single-image-accordion <?php echo \ElementsKit\Utils::render(($item['ekit_img_accordion_active'] == 'yes') ? 'active' : '') ; ?>" style="background-image: url(<?php echo esc_url($item['ekit_img_accordion_bg']['url']); ?>)">
                <div class="elementskit-accordion-content">
                   <?php if($item['ekit_img_accordion_enable_pupup'] == 'yes' || $item['ekit_img_accordion_enable_project_link'] == 'yes') {


                       if (!empty($item['ekit_img_accordion_project_link']['url'])) {

                           $this->add_render_attribute('projectlink', 'href', $item['ekit_img_accordion_project_link']['url']);

                           if ($item['ekit_img_accordion_project_link']['is_external']) {
                               $this->add_render_attribute('projectlink', 'target', '_blank');
                           }

                           if (!empty($item['ekit_img_accordion_project_link']['nofollow'])) {
                               $this->add_render_attribute('projectlink', 'rel', 'nofollow');
                           }
                       }

                       ?>
                    <div class="elementskit-icon-wraper">
                       <?php if($item['ekit_img_accordion_enable_pupup'] == 'yes') { ?>
                            <a href="<?php echo esc_url($item['ekit_img_accordion_bg']['url']); ?>" class="icon-outline circle" data-effect="mfp-zoom-out">
                            <?php

                                $migrated = isset( $item['__fa4_migrated']['ekit_img_accordion_pup_up_icons'] );
                                // Check if its a new widget without previously selected icon using the old Icon control
                                $is_new = empty( $item['ekit_img_accordion_pup_up_icon'] );
                                if ( $is_new || $migrated ) {

                                    // new icon
                                    Icons_Manager::render_icon( $item['ekit_img_accordion_pup_up_icons'], [ 'aria-hidden' => 'true'] );
                                } else {
                                    ?>
                                    <i class="<?php echo $item['ekit_img_accordion_pup_up_icon']; ?>" aria-hidden="true"></i>
                                    <?php
                                }
                            ?>
                            </a>
                       <?php } ?>
                       <?php if($item['ekit_img_accordion_enable_project_link'] == 'yes') {?>
                            <a href="<?php echo esc_url( $item['ekit_img_accordion_project_link']['url'] ) ?>" class="icon-outline circle">
                            <?php
                                $migrated = isset( $item['__fa4_migrated']['ekit_img_accordion_project_link_icons'] );
                                // Check if its a new widget without previously selected icon using the old Icon control
                                $is_new = empty( $item['ekit_img_accordion_project_link_icon'] );
                                if ( $is_new || $migrated ) {

                                    // new icon
                                    Icons_Manager::render_icon( $item['ekit_img_accordion_project_link_icons'], [ 'aria-hidden' => 'true'] );
                                } else {
                                    ?>
                                    <i class="<?php echo $item['ekit_img_accordion_project_link_icon']; ?>" aria-hidden="true"></i>
                                    <?php
                                }
                            ?>
                            </a>
                        <?php } ?>
                    </div>
                    <?php } ?>
                    <div class="elementskit-accordion-title-wraper">
                        <h2 class="elementskit-accordion-title <?php echo esc_attr($item['ekit_img_accordion_title_icons'] != '') ? 'icon-title' : ''?>">
                        <?php if($item['ekit_img_accordion_enable_icon']  == 'yes'): ?>
                        <?php if($item['ekit_img_accordion_title_icon_position'] == 'left'): ?>
                            <!-- same-1 -->
                            <?php

                                $migrated = isset( $item['__fa4_migrated']['ekit_img_accordion_title_icons'] );
                                // Check if its a new widget without previously selected icon using the old Icon control
                                $is_new = empty( $item['ekit_img_accordion_title_icon'] );
                                if ( $is_new || $migrated ) {

                                    // new icon
                                    Icons_Manager::render_icon( $item['ekit_img_accordion_title_icons'], [ 'aria-hidden' => 'true'] );
                                } else {
                                    ?>
                                    <i class="<?php echo $item['ekit_img_accordion_title_icon']; ?>" aria-hidden="true"></i>
                                    <?php
                                }
                            ?>
                        <?php endif; ?>
                        <?php endif; ?>

                        <?php echo esc_html($item['ekit_img_accordion_title']); ?>

                        <?php if($item['ekit_img_accordion_enable_icon']  == 'yes'): ?>
                        <?php if($item['ekit_img_accordion_title_icon_position'] == 'right'): ?>
                            <!-- same-1 -->
                            <?php

                                $migrated = isset( $item['__fa4_migrated']['ekit_img_accordion_title_icons'] );
                                // Check if its a new widget without previously selected icon using the old Icon control
                                $is_new = empty( $item['ekit_img_accordion_title_icon'] );
                                if ( $is_new || $migrated ) {

                                    // new icon
                                    Icons_Manager::render_icon( $item['ekit_img_accordion_title_icons'], [ 'aria-hidden' => 'true'] );
                                } else {
                                    ?>
                                    <i class="<?php echo $item['ekit_img_accordion_title_icon']; ?>" aria-hidden="true"></i>
                                    <?php
                                }
                            ?>
                        <?php endif; ?>
                        <?php endif; ?>
                        </h2>
                    </div>
                    <?php if($item['ekit_img_accordion_enable_button'] == 'yes'): ?>
                        <div class="elementskit-btn-wraper">
                            <a class="elementskit-btn" href="<?php echo esc_url($item['ekit_img_accordion_button_url']['url']);?>">
                                <?php echo esc_html($item['ekit_img_accordion_button_label']);?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php endforeach; ?>
        </div>

    <?php }
    protected function _content_template() { }
}