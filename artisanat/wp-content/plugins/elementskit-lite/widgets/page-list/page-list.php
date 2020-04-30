<?php
namespace Elementor;

use \ElementsKit\Elementskit_Widget_Page_List_Handler as Handler;
use \ElementsKit\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if (! defined( 'ABSPATH' ) ) exit;

class Elementskit_Widget_Page_List extends Widget_Base {
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

	public function get_keywords() {
        return Handler::get_keywords();
    }

    public function get_categories() {
        return Handler::get_categories();
    }

	protected function _register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'List', 'elementskit' ),
			]
		);

		$this->add_control(
			'view',
			[
				'label' => esc_html__( 'Layout', 'elementskit' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'traditional',
				'options' => [
					'traditional' => [
						'title' => esc_html__( 'Default', 'elementskit' ),
						'icon' => 'eicon-editor-list-ul',
					],
					'inline' => [
						'title' => esc_html__( 'Inline', 'elementskit' ),
						'icon' => 'eicon-ellipsis-h',
					],
				],
				'render_type' => 'template',
				'classes' => 'elementor-control-start-end',
				'label_block' => false,
				'style_transfer' => true,
			]
		);

		// $this->add_responsive_control(
		// 	'ekit_page_list_text_align',
		// 	[
		// 		'label' => __( 'Alignment', 'elementskit' ),
		// 		'type' => Controls_Manager::CHOOSE,
		// 		'options' => [
		// 			'left' => [
		// 				'title' => __( 'Left', 'elementskit' ),
		// 				'icon' => 'fa fa-align-left',
		// 			],
		// 			'center' => [
		// 				'title' => __( 'Center', 'elementskit' ),
		// 				'icon' => 'fa fa-align-center',
		// 			],
		// 			'right' => [
		// 				'title' => __( 'Right', 'elementskit' ),
		// 				'icon' => 'fa fa-align-right',
		// 			],
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .elementor-icon-list-items' => 'text-align: {{VALUE}}',
		// 		],
		// 		'toggle' => true,
		// 		'condition' => [
		// 			'view' => 'inline'
		// 		]
		// 	]
		// );

		$this->add_control(
			'ekit_href_target',
			[
				'label' => esc_html__( 'Target', 'elementskit' ),
				'type' => Controls_Manager::SELECT,
				'default' => '_blank',
				'options' => [
					'_blank'  => esc_html__( 'Blank', 'elementskit' ),
					'self' => esc_html__( 'Self', 'elementskit' ),
				],
			]
		);

		$this->add_control(
			'ekit_href_rel',
			[
				'label' => esc_html__( 'Rel', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementskit' ),
				'label_off' => esc_html__( 'Hide', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'text',
			[
				'label' => esc_html__( 'Text', 'elementskit' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'List Title', 'elementskit' ),
			]
		);

		$repeater->add_control(
			'ekit_menu_widget_sub_title',
			[
				'label' => esc_html__( 'Sub Title', 'elementskit' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Type your title here', 'elementskit' ),
			]
		);

		$repeater->add_control(
			'ekit_page_list_show_icon',
			[
				'label' => esc_html__( 'Show Icon', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementskit' ),
				'label_off' => esc_html__( 'Hide', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$repeater->add_control(
			'icons',
			[
				'label' => esc_html__( 'Icon', 'elementskit' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'solid',
                ],
				'condition' => [
					'ekit_page_list_show_icon' => 'yes'
				],
			]
		);

		$repeater->add_responsive_control(
			'icon_color',
			[
				'label' => esc_html__( 'Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementor-icon-list-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementor-icon-list-icon svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};'
				],
				'condition' => [
					'ekit_page_list_show_icon' => 'yes'
				],
			]
		);

		$repeater->add_responsive_control(
			'ekit_menu_list_icon_vetical_align',
			[
				'label' => esc_html__( 'Vertical Alignment', 'elementskit' ),
				'type' => Controls_Manager::CHOOSE,
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
				'toggle' => true,
				'condition' => [
					'ekit_page_list_show_icon' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementor-icon-list-icon' => 'align-self: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'ekit_page_list_select_page_or_custom_link',
			[
				'label' => esc_html__( 'Selct Page / Custom Link', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'your-plugin' ),
				'label_off' => esc_html__( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$repeater->add_control(
			'link',
			[
                'label' =>esc_html__('Select Page', 'elementskit'),
				'type'      => ElementsKit_Controls_Manager::AJAXSELECT2,
				'options'   =>'ajaxselect2/page_list',
                'label_block' => true,
				'multiple'  => false,
				'condition' => [
					'ekit_page_list_select_page_or_custom_link' => 'yes'
				]
			]
		);

		$repeater->add_control(
			'ekit_page_list_website_link',
			[
				'label' => esc_html__( 'Link', 'elementskit' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'elementskit' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
				'condition' => [
					'ekit_page_list_select_page_or_custom_link!' => 'yes'
				]
			]
		);

		$repeater->add_control(
			'ekit_menu_list_show_label',
			[
				'label' => esc_html__( 'Show Label', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementskit' ),
				'label_off' => esc_html__( 'Hide', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$repeater->add_control(
			'ekit_menu_list_label_title',
			[
				'label' => esc_html__( 'Label', 'elementskit' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'elementskit' ),
				'placeholder' => esc_html__( 'Type your title here', 'elementskit' ),
				'condition' => [
					'ekit_menu_list_show_label' => 'yes'
				]
			]
		);

		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_menu_list_label_title_background',
				'label' => esc_html__( 'Background', 'elementskit' ),
				'types' => [ 'classic', ],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .ekit_menu_label',
				'exclude' => [
					'image'
				],
				'condition' => [
					'ekit_menu_list_show_label' => 'yes'
				]
			]
		);

		$repeater->add_responsive_control(
			'ekit_menu_list_label_title_color',
			[
				'label' => esc_html__( 'Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .ekit_menu_label' => 'color: {{VALUE}}',
				],
				'condition' => [
					'ekit_menu_list_show_label' => 'yes'
				]
			]
		);

		$repeater->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ekit_menu_list_label_title_typography',
				'label' => esc_html__( 'Typography', 'elementskit' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .ekit_menu_label',
				'condition' => [
					'ekit_menu_list_show_label' => 'yes'
				]
			]
		);
		$repeater->add_responsive_control(
			'ekit_menu_list_label_title_margin',
			[
				'label' => esc_html__( 'Margin', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .ekit_menu_label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'ekit_menu_list_show_label' => 'yes'
				]
			]
		);
		$repeater->add_responsive_control(
			'ekit_menu_list_label_title_padding',
			[
				'label' => esc_html__( 'Padding', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .ekit_menu_label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'ekit_menu_list_show_label' => 'yes'
				]
			]
		);
		$repeater->add_responsive_control(
			'ekit_menu_list_label_title_border_radius',
			[
				'label' => esc_html__( 'Border radius', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .ekit_menu_label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'ekit_menu_list_show_label' => 'yes'
				]
			]
		);

		$repeater->add_control(
			'ekit_menu_list_label_align',
			[
				'label' => esc_html__( 'Alignment', 'elementskit' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'ekit_badge_left' => [
						'title' => esc_html__( 'Left', 'elementskit' ),
						'icon' => 'fa fa-align-left',
					],
					'ekit_badge_right' => [
						'title' => esc_html__( 'Right', 'elementskit' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'ekit_badge_left',
				'toggle' => true,
				'condition' => [
					'ekit_menu_list_show_label' => 'yes'
				]
			]
		);

		$repeater->add_responsive_control(
			'ekit_menu_list_label_vetical_align_left',
			[
				'label' => esc_html__( 'Vertical Alignment', 'elementskit' ),
				'type' => Controls_Manager::CHOOSE,
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
				'toggle' => true,
				'condition' => [
					'ekit_menu_list_show_label' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .ekit_menu_label' => 'align-self: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_list',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ text }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_list',
			[
				'label' => esc_html__( 'List', 'elementskit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'ekit_page_list_padding',
			[
				'label' => esc_html__( 'Padding', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_page_list_margin',
			[
				'label' => esc_html__( 'Margin', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ekit_page_list_border',
				'label' => esc_html__( 'Border', 'elementskit' ),
				'selector' => '{{WRAPPER}} .elementor-icon-list-item > a',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_page_list_background',
				'label' => esc_html__( 'Background', 'elementskit' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elementor-icon-list-item > a',
				'exclude' => [
					'image'
				]
			]
		);
		$this->add_control(
			'ekit_page_list_background_title',
			[
				'label' => esc_html__( 'Hover', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_page_list_background_hover',
				'label' => esc_html__( 'Background Hover', 'elementskit' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elementor-icon-list-item > a:hover',
				'exclude' => [
					'image'
				]
			]
		);

		$this->add_control(
			'ekit_page_list_background_title_hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);


		$this->add_control(
			'icon_align',
			[
				'label' => esc_html__( 'Alignment', 'elementskit' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'elementskit' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementskit' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementskit' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'elementor-align-',
			]
		);

		$this->add_control(
			'divider',
			[
				'label' => esc_html__( 'Divider', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'Off', 'elementskit' ),
				'label_on' => esc_html__( 'On', 'elementskit' ),
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'content: ""',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'divider_style',
			[
				'label' => esc_html__( 'Style', 'elementskit' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'solid' => esc_html__( 'Solid', 'elementskit' ),
					'dotted' => esc_html__( 'Dotted', 'elementskit' ),
					'dashed' => esc_html__( 'Dashed', 'elementskit' ),
				],
				'default' => 'solid',
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:last-child):after' => 'border-top-style: {{VALUE}}',
					'{{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item:not(:last-child):after' => 'border-left-style: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'divider_weight',
			[
				'label' => esc_html__( 'Weight', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:last-child):after' => 'border-top-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .elementor-inline-items .elementor-icon-list-item:not(:last-child):after' => 'border-left-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_width',
			[
				'label' => esc_html__( 'Width', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'condition' => [
					'divider' => 'yes',
					'view!' => 'inline',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_height',
			[
				'label' => esc_html__( 'Height', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'condition' => [
					'divider' => 'yes',
					'view' => 'inline',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_color',
			[
				'label' => esc_html__( 'Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ddd',
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => esc_html__( 'Icon', 'elementskit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'icon_color_hover',
			[
				'label' => esc_html__( 'Hover', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-icon svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};'
				],
			]
		);
		$this->add_responsive_control(
			'ekit_icon_margin',
			[
				'label' => esc_html__( 'Margin', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 14,
				],
				'range' => [
					'px' => [
						'min' => 6,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-icon' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-icon-list-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-icon-list-icon svg'	=> 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_text_style',
			[
				'label' => esc_html__( 'Text', 'elementskit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-text' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
			]
		);

		$this->add_responsive_control(
			'ekit_text_margin',
			[
				'label' => esc_html__( 'Margin', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'text_color_hover',
			[
				'label' => esc_html__( 'Hover', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_indent',
			[
				'label' => esc_html__( 'Padding Left', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-text' => is_rtl() ? 'padding-right: {{SIZE}}{{UNIT}};' : 'padding-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'selector' => '{{WRAPPER}} .elementor-icon-list-item',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ekit_menu_subtitle_style_tab',
			[
				'label' => esc_html__( 'Subtitle', 'elementskit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ekit_menu_subtitle_typography',
				'label' => esc_html__( 'Typography', 'elementskit' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .ekit_menu_subtitle',
			]
		);

		$this->add_control(
			'ekit_menu_subtitle_color',
			[
				'label' => esc_html__( 'Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .ekit_menu_subtitle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'ekit_menu_subtitle_color_hover',
			[
				'label' => esc_html__( 'Color Hover', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item a:hover .ekit_menu_subtitle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_menu_subtitle_padding',
			[
				'label' => esc_html__( 'Padding', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ekit_menu_subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$this->add_render_attribute( 'icon_list', 'class', 'elementor-icon-list-items' );
		$this->add_render_attribute( 'list_item', 'class', 'elementor-icon-list-item' );

		if ( 'inline' === $settings['view'] ) {
			$this->add_render_attribute( 'icon_list', 'class', 'elementor-inline-items' );
			$this->add_render_attribute( 'list_item', 'class', 'elementor-inline-item' );
		}
		?>
		<div <?php echo \ElementsKit\Utils::render($this->get_render_attribute_string( 'icon_list' )); ?>>
			<?php
			foreach ( $settings['icon_list'] as $index => $item ) :
				$post = '';
				if ($item['ekit_page_list_select_page_or_custom_link'] == 'yes') {
					$post = !empty( $item['link'] ) ? get_post($item['link']) : 0;
				} else {
					$post = $item['ekit_page_list_website_link']['url'];
				}

				$href = '';
				if ($item['ekit_page_list_select_page_or_custom_link'] == 'yes') {
					$href = !empty($post) ? get_the_permalink($post->ID) : '';
				} else {
					$href = $post;
				}

				$target = '';
				if ($item['ekit_page_list_select_page_or_custom_link'] == 'yes') {
					$target = '_blank' === $settings['ekit_href_target'] ? ' target=_blank' : '';
					
				} else {
					$target = (isset($item['ekit_page_list_website_link']['is_external']) && $item['ekit_page_list_website_link']['is_external'] !='') ? ' target=_blank' : '';
				}
				
				$rel = '';
				if ($item['ekit_page_list_select_page_or_custom_link'] == 'yes') {
					$rel = $settings['ekit_href_rel'] == 'yes' ? 'nofollow' : '';
					$rel = $item['ekit_page_list_website_link']['nofollow'] ? 'nofollow' : '';
				}

                if($post != null):
					$text = empty($item['text']) ? $post->post_title : $item['text'];
				?>
				<div class="elementor-icon-list-item" >
					<a <?php echo esc_attr($target); ?> rel="<?php echo esc_attr($rel);?>"  href="<?php echo esc_url($href); ?>" class="elementor-repeater-item-<?php echo esc_attr( $item[ '_id' ] ); ?> <?php echo \ElementsKit\Utils::render($item['ekit_menu_list_label_align'])?>">
						<div class="ekit_page_list_content">
							<?php if ( ! empty( $item['icons'] ) && $item['ekit_page_list_show_icon'] == 'yes') : ?>
								<span class="elementor-icon-list-icon">
									<?php
										// new icon
										$migrated = isset( $item['__fa4_migrated']['icons'] );
										// Check if its a new widget without previously selected icon using the old Icon control
										$is_new = empty( $item['icon'] );
										if ( $is_new || $migrated ) {
											// new icon
											Icons_Manager::render_icon( $item['icons'], [ 'aria-hidden' => 'true' ] );
										} else {
											?>
											<i class="<?php echo esc_attr($item['icon']); ?>" aria-hidden="true"></i>
											<?php
										}
									?>
								</span>
							<?php endif; ?>
							<span class="elementor-icon-list-text">
								<span class="ekit_page_list_title_title"><?php echo \ElementsKit\Utils::render($text); ?></span>
								<?php if ($item['ekit_menu_widget_sub_title'] != '') : ?>
								<span class="ekit_menu_subtitle"><?php echo esc_html($item['ekit_menu_widget_sub_title']); ?></span>
								<?php endif; ?>
							</span>
						</div>
						<?php if ( ! empty( $item['ekit_menu_list_label_title'] ) && $item['ekit_menu_list_show_label'] == 'yes') : ?>
						<span class="ekit_menu_label">
							<?php echo \ElementsKit\Utils::render( $item['ekit_menu_list_label_title'] ); ?>
						</span>
						<?php endif; ?>
					</a>
				</div>
				<?php
                endif;
			endforeach;
			?>
		</div>
		<?php
	}


}
