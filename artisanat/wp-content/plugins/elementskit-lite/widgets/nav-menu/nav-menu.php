<?php

namespace Elementor;

use \ElementsKit\Elementskit_Widget_Nav_Menu_Handler as Handler;
use \ElementsKit\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Elementskit_Widget_Nav_Menu extends Widget_Base {
	use \ElementsKit\Widgets\Widget_Notice;

	public $base;

    public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );
		$this->add_script_depends('ekit-nav-menu');
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

    public function get_menus(){
        $list = [];
        $menus = wp_get_nav_menus();
        foreach($menus as $menu){
            $list[$menu->slug] = $menu->name;
        }

        return $list;
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'elementskit_content_tab',
            [
                'label' => esc_html__('Menu settings', 'elementskit'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
		);
		
		$this->add_control(
            'elementskit_one_page_enable',
            [
				'label' => esc_html__('Enable one page? ', 'elementskit'),
				'description'	=> esc_html__('This works in the current page.', 'elementskit'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' =>esc_html__( 'Yes', 'elementskit' ),
                'label_off' =>esc_html__( 'No', 'elementskit' ),
            ]
		);

        $this->add_control(
            'elementskit_nav_menu',
            [
                'label'     =>esc_html__( 'Select menu', 'elementskit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $this->get_menus(),
            ]
		);

		$this->add_control(
			'elementskit_nav_menu_logo',
			[
				'label' => esc_html__( 'Choose Mobile Menu Logo', 'elementskit' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'elementskit_nav_menu_logo_link_to',
			[
				'label' => esc_html__( 'Link', 'elementskit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'home',
				'options' => [
					'home' => esc_html__( 'Home', 'elementskit' ),
					'custom' => esc_html__( 'Custom URL', 'elementskit' ),
				],
			]
		);

		$this->add_control(
			'elementskit_nav_menu_logo_link',
			[
				'label' => esc_html__( 'Link', 'elementskit' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://your-link.com',
				'condition' => [
					'elementskit_nav_menu_logo_link_to' => 'custom',
				],
				'show_label' => false,
			]
		);

        $this->add_responsive_control(
			'elementskit_main_menu_position',
			[
				'label' => esc_html__( 'Horizontal main menu', 'elementskit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'elementskit-menu-po-left',
				'options' => [
					'elementskit-menu-po-left'  => esc_html__( 'Left', 'elementskit' ),
					'elementskit-menu-po-center' => esc_html__( 'Center', 'elementskit' ),
                    'elementskit-menu-po-right' => esc_html__( 'Right', 'elementskit' ),
                    'elementskit-menu-po-justified'  => esc_html__( 'Justified', 'elementskit' ),
				],
			]
		);

        $this->add_responsive_control(
			'elementskit_menubar_height',
			[
				'label' => esc_html__( 'Height', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 30,
						'max' => 300,
						'step' => 1,
                    ],
                    '%' => [
						'min' => 0,
						'max' => 100,
					],
                ],
                'devices' => [ 'desktop', 'tablet' ],
				'desktop_default' => [
					'size' => 80,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 100,
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-menu-container' => 'height: {{SIZE}}{{UNIT}};',
				],
				// 'condition' => [
				// 	'ekit_menu_style_lists!' => 'ekit_menu_style_vertical'
				// ]
			]
		);

        $this->add_responsive_control(
			'elementskit_border_radius',
			[
				'label' => esc_html__( 'Border radius', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'devices' => [ 'desktop', 'tablet' ],
                'size_units' => [ 'px' ],
                'desktop_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-menu-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'elementskit_menubar_background',
				'label' => esc_html__( 'Background', 'elementskit' ),
                'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elementskit-menu-container',
			]
        );

        $this->add_responsive_control(
            'elementskit_mobile_menu_panel_background',
            [
                'label' => esc_html__( 'Item text color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'tablet_default' => '#ffffff',
                'devices' => ['tablet'],
				'selectors' => [
					'{{WRAPPER}} .elementskit-menu-container' => 'background-image: linear-gradient(180deg, {{VALUE}} 0%, {{VALUE}} 100%);',
				],
            ]
        );

		$this->add_responsive_control(
			'elementskit_mobile_menu_panel_spacing',
			[
				'label' => esc_html__( 'Padding', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'tablet_default' => [
					'top' => '10',
                    'right' => '0',
                    'bottom' => '10',
                    'left' => '0',
                    'unit' => 'px',
				],
				'devices' => ['tablet'],
				'selectors' => [
					'{{WRAPPER}} .elementskit-nav-identity-panel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'elementskit_mobile_menu_panel_width',
			[
				'label' => esc_html__( 'Width', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'devices' => ['tablet'],
				'range' => [
					'px' => [
						'min' => 350,
						'max' => 700,
						'step' => 1,
                    ],
                    '%' => [
						'min' => 0,
						'max' => 100,
					],
                ],
                'tablet_default' => [
					'size' => 350,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-menu-container' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'elementskit_style_tab_menuitem',
            [
                'label' => esc_html__('Menu item style', 'elementskit'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'elementskit_content_typography',
				'label' => esc_html__( 'Typography', 'elementskit' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .elementskit-navbar-nav > li > a',
			]
		);
		
		$this->add_responsive_control(
			'ekit_menu_item_icon_spacing',
			[
				'label' => esc_html__( 'Menu Icon Padding', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-navbar-nav li a .ekit-menu-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'elementskit_menu_item_spacing',
			[
				'label' => esc_html__( 'Spacing', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'devices' => [ 'desktop', 'tablet' ],
                'desktop_default' => [
                    'top' => 0,
                    'right' => 15,
                    'bottom' => 0,
                    'left' => 15,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => 10,
                    'right' => 15,
                    'bottom' => 10,
                    'left' => 15,
                    'unit' => 'px',
                ],
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-navbar-nav > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->start_controls_tabs(
            'elementskit_nav_menu_tabs'
		);
			// Normal
			$this->start_controls_tab(
				'elementskit_nav_menu_normal_tab',
				[
					'label' => esc_html__( 'Normal', 'elementskit' ),
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'elementskit_item_background',
					'label' => esc_html__( 'Item background', 'elementskit' ),
					'types' => ['classic', 'gradient'],
					'selector' => '{{WRAPPER}} .elementskit-navbar-nav > li > a',
				]
			);

			$this->add_responsive_control(
				'elementskit_menu_text_color',
				[
					'label' => esc_html__( 'Item text color', 'elementskit' ),
					'type' => Controls_Manager::COLOR,
					'desktop_default' => '#000000',
					'tablet_default' => '#000000',
					'devices' => [ 'desktop', 'tablet'],
					'selectors' => [
						'{{WRAPPER}} .elementskit-navbar-nav > li > a' => 'color: {{VALUE}}',
					],
				]
			);
	
			$this->end_controls_tab();

			// Hover
			$this->start_controls_tab(
				'elementskit_nav_menu_hover_tab',
				[
					'label' => esc_html__( 'Hover', 'elementskit' ),
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'elementskit_item_background_hover',
					'label' => esc_html__( 'Item background', 'elementskit' ),
					'types' => ['classic', 'gradient'],
					'selector' => '{{WRAPPER}} .elementskit-navbar-nav > li > a:hover, {{WRAPPER}} .elementskit-navbar-nav > li > a:focus, {{WRAPPER}} .elementskit-navbar-nav > li > a:active, {{WRAPPER}} .elementskit-navbar-nav > li:hover > a',
				]
			);
	
			$this->add_responsive_control(
				'elementskit_item_color_hover',
				[
					'label' => esc_html__( 'Item text color', 'elementskit' ),
					'type' => Controls_Manager::COLOR,
					'devices' => [ 'desktop', 'tablet' ],
					'default' => '#707070',
					'selectors' => [
						'{{WRAPPER}} .elementskit-navbar-nav > li > a:hover' => 'color: {{VALUE}}',
						'{{WRAPPER}} .elementskit-navbar-nav > li > a:focus' => 'color: {{VALUE}}',
						'{{WRAPPER}} .elementskit-navbar-nav > li > a:active' => 'color: {{VALUE}}',
						'{{WRAPPER}} .elementskit-navbar-nav > li:hover > a' => 'color: {{VALUE}}',
						'{{WRAPPER}} .elementskit-navbar-nav > li:hover > a .elementskit-submenu-indicator' => 'color: {{VALUE}}',
						'{{WRAPPER}} .elementskit-navbar-nav > li > a:hover .elementskit-submenu-indicator' => 'color: {{VALUE}}',
						'{{WRAPPER}} .elementskit-navbar-nav > li > a:focus .elementskit-submenu-indicator' => 'color: {{VALUE}}',
						'{{WRAPPER}} .elementskit-navbar-nav > li > a:active .elementskit-submenu-indicator' => 'color: {{VALUE}}',
					],
				]
			);

			$this->end_controls_tab();

			// active
			$this->start_controls_tab(
				'elementskit_nav_menu_active_tab',
				[
					'label' => esc_html__( 'Active', 'elementskit' ),
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'		=> 'elementskit_nav_menu_active_bg_color',
					'label' 	=> esc_html__( 'Item background', 'elementskit' ),
					'types'		=> ['classic', 'gradient'],
					'selector'	=> '{{WRAPPER}} .elementskit-navbar-nav > li.current-menu-item > a,{{WRAPPER}} .elementskit-navbar-nav > li.current-menu-ancestor > a'
				]
			);
	
			$this->add_responsive_control(
				'elementskit_nav_menu_active_text_color',
				[
					'label' => esc_html__( 'Item text color (Active)', 'elementskit' ),
					'type' => Controls_Manager::COLOR,
					'devices' => [ 'desktop', 'tablet' ],
					'default' => '#707070',
					'selectors' => [
						'{{WRAPPER}} .elementskit-navbar-nav > li.current-menu-item > a' => 'color: {{VALUE}}',
						'{{WRAPPER}} .elementskit-navbar-nav > li.current-menu-ancestor > a' => 'color: {{VALUE}}',
						'{{WRAPPER}} .elementskit-navbar-nav > li.current-menu-ancestor > a .elementskit-submenu-indicator' => 'color: {{VALUE}}',
					],
				]
			);	

			$this->end_controls_tab();

		$this->end_controls_tabs();


        $this->end_controls_section();

        $this->start_controls_section(
            'elementskit_style_tab_submenu_item',
            [
                'label' => esc_html__('Submenu item style', 'elementskit'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'elementskit_style_tab_submenu_item_arrow',
			[
				'label' => esc_html__( 'Submenu Indicator', 'elementskit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'elementskit_line_arrow',
				'options' => [
					'elementskit_line_arrow'  => esc_html__( 'Line Arrow', 'elementskit' ),
					'elementskit_plus_icon' => esc_html__( 'Plus', 'elementskit' ),
					'elementskit_fill_arrow' => esc_html__( 'Fill Arrow', 'elementskit' ),
					'elementskit_none' => esc_html__( 'None', 'elementskit' ),
                ],
			]
		);
		
		$this->add_responsive_control(
			'elementskit_style_tab_submenu_indicator_color',
			[
				'label' => esc_html__( 'Indicator color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'devices' => [ 'desktop', 'tablet' ],
                'default' =>  '#000000',
				'selectors' => [
					'{{WRAPPER}} .elementskit-navbar-nav > li > a .elementskit-submenu-indicator' => 'color: {{VALUE}}',
				],
				'condition' => [
					'elementskit_style_tab_submenu_item_arrow!' => 'elementskit_none'
				]
			]
		);
		$this->add_responsive_control(
			'ekit_submenu_indicator_spacing',
			[
				'label' => esc_html__( 'Indicator Margin', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-navbar-nav-default .elementskit-dropdown-has>a .elementskit-submenu-indicator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'elementskit_style_tab_submenu_item_arrow!' => 'elementskit_none'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'elementskit_menu_item_typography',
				'label' => esc_html__( 'Typography', 'elementskit' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li > a',
			]
        );

		$this->add_responsive_control(
			'elementskit_submenu_item_spacing',
			[
				'label' => esc_html__( 'Spacing', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
				'devices' => [ 'desktop', 'tablet' ],
                'desktop_default' => [
                    'top' => 15,
                    'right' => 15,
                    'bottom' => 15,
                    'left' => 15,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => 15,
                    'right' => 15,
                    'bottom' => 15,
                    'left' => 15,
                    'unit' => 'px',
                ],
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'elementskit_submenu_active_hover_tabs'
		);
			$this->start_controls_tab(
				'elementskit_submenu_normal_tab',
				[
					'label'	=> esc_html__('Normal', 'elementskit')
				]
			);

			$this->add_responsive_control(
				'elementskit_submenu_item_color',
				[
					'label' => esc_html__( 'Item text color', 'elementskit' ),
					'type' => Controls_Manager::COLOR,
					'devices' => [ 'desktop', 'tablet' ],
					'default' => '#000000',
					'selectors' => [
						'{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li > a' => 'color: {{VALUE}}',
					],
					
				]
			);
	
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'elementskit_menu_item_background',
					'label' => esc_html__( 'Item background', 'elementskit' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li > a',
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'elementskit_submenu_hover_tab',
				[
					'label'	=> esc_html__('Hover', 'elementskit')
				]
			);
	
			$this->add_responsive_control(
				'elementskit_item_text_color_hover',
				[
					'label' => esc_html__( 'Item text color (hover)', 'elementskit' ),
					'type' => Controls_Manager::COLOR,
					'devices' => [ 'desktop', 'tablet' ],
					'default' => '#707070',
					'selectors' => [
						'{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li > a:hover' => 'color: {{VALUE}}',
						'{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li > a:focus' => 'color: {{VALUE}}',
						'{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li > a:active' => 'color: {{VALUE}}',
						'{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li:hover > a' => 'color: {{VALUE}}',
					],
				]
			);
	
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'elementskit_menu_item_background_hover',
					'label' => esc_html__( 'Item background (hover)', 'elementskit' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' => '
					{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li > a:hover,
					{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li > a:focus,
					{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li > a:active,
					{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li:hover > a',
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'elementskit_submenu_active_tab',
				[
					'label'	=> esc_html__('Active', 'elementskit')
				]
			);

			$this->add_responsive_control(
				'elementskit_nav_sub_menu_active_text_color',
				[
					'label' => esc_html__( 'Item text color (Active)', 'elementskit' ),
					'type' => Controls_Manager::COLOR,
					'devices' => [ 'desktop', 'tablet' ],
					'default' => '#707070',
					'selectors' => [
						'{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li.current-menu-item > a' => 'color: {{VALUE}} !important'
					],
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'		=> 'elementskit_nav_sub_menu_active_bg_color',
					'label' 	=> esc_html__( 'Item background (Active)', 'elementskit' ),
					'types'		=> ['classic', 'gradient'],
					'selector'	=> '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li.current-menu-item > a',
				]
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'elementskit_menu_item_border_heading',
			[
				'label' => esc_html__( 'Sub Menu Items Border', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'elementskit_menu_item_border',
				'label' => esc_html__( 'Border', 'elementskit' ),
				'selector' => '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li > a',
			]
		);

		$this->add_control(
			'elementskit_menu_item_border_last_child_heading',
			[
				'label' => esc_html__( 'Border Last Child', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'elementskit_menu_item_border_last_child',
				'label' => esc_html__( 'Border last Child', 'elementskit' ),
				'selector' => '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li:last-child > a',
			]
		);

		$this->add_control(
			'elementskit_menu_item_border_first_child_heading',
			[
				'label' => esc_html__( 'Border First Child', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'elementskit_menu_item_border_first_child',
				'label' => esc_html__( 'Border First Child', 'elementskit' ),
				'selector' => '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li:first-child > a',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'elementskit_style_tab_submenu_panel',
            [
                'label' => esc_html__('Submenu panel style', 'elementskit'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'elementskit_panel_submenu_border',
				'label' => esc_html__( 'Panel Menu Border', 'elementskit' ),
				'selector' => '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel',
			]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'elementskit_submenu_container_background',
                'label' => esc_html__( 'Container background', 'elementskit' ),
                'types' => [ 'classic','gradient' ],
                'selector' => '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel',
            ]
        );

        $this->add_responsive_control(
			'elementskit_submenu_panel_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'devices' => [ 'desktop', 'tablet' ],
                'desktop_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'elementskit_submenu_container_width',
			[
				'label' => esc_html__( 'Conatiner width', 'elementskit' ),
                'type' => Controls_Manager::TEXT,
                'devices' => [ 'desktop', 'tablet' ],
                'desktop_default' => '220px',
                'tablet_default' => '200px',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel' => 'min-width: {{VALUE}};',
                ]
			]
		);
		

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'elementskit_panel_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'elementskit' ),
				'selector' => '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'elementskit_menu_toggle_style_tab',
			[
				'label' => esc_html__( 'Humburger Style', 'elementskit' ),
                'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
			'elementskit_menu_toggle_style_title',
			[
				'label' => esc_html__( 'Humburger Toggle', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'elementskit_menu_toggle_icon_position',
			[
				'label' => esc_html__( 'Position', 'elementskit' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Top', 'elementskit' ),
						'icon' => 'fa fa-angle-left',
					],
					'right' => [
						'title' => esc_html__( 'Middle', 'elementskit' ),
						'icon' => 'fa fa-angle-right',
					],
				],
				'default' => 'right',
				'selectors' => [
					'{{WRAPPER}} .elementskit-menu-hamburger' => 'float: {{VALUE}}',
                ],
			]
		);

        $this->add_responsive_control(
			'elementskit_menu_toggle_spacing',
			[
				'label' => esc_html__( 'Padding', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
                'devices' => [ 'tablet' ],
                'tablet_default' => [
					'top' => '8',
                    'right' => '8',
                    'bottom' => '8',
                    'left' => '8',
                    'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-menu-hamburger' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'elementskit_menu_toggle_width',
			[
				'label' => esc_html__( 'Width', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 45,
						'max' => 100,
						'step' => 1,
					],
                ],
                'devices' => [ 'tablet' ],
				'tablet_default' => [
					'unit' => 'px',
					'size' => 45,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-menu-hamburger' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'elementskit_menu_toggle_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
                ],
                'devices' => [ 'tablet' ],
				'tablet_default' => [
					'unit' => 'px',
					'size' => 3,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-menu-hamburger' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->start_controls_tabs(
            'elementskit_menu_toggle_normal_and_hover_tabs'
        );

        $this->start_controls_tab(
            'elementskit_menu_toggle_normal',
            [
                'label' => esc_html__( 'Normal', 'elementskit' ),
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'elementskit_menu_toggle_background',
				'label' => esc_html__( 'Background', 'elementskit' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .elementskit-menu-hamburger',
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'elementskit_menu_toggle_border',
                'label' => esc_html__( 'Border', 'elementskit' ),
                'separator' => 'before',
				'selector' => '{{WRAPPER}} .elementskit-menu-hamburger',
			]
        );

        $this->add_control(
			'elementskit_menu_toggle_icon_color',
			[
				'label' => esc_html__( 'Humber Icon Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0, 0, 0, 0.5)',
				'selectors' => [
					'{{WRAPPER}} .elementskit-menu-hamburger .elementskit-menu-hamburger-icon' => 'background-color: {{VALUE}}',
				],
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'elementskit_menu_toggle_hover',
            [
                'label' => esc_html__( 'Hover', 'elementskit' ),
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'elementskit_menu_toggle_background_hover',
				'label' => esc_html__( 'Background', 'elementskit' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .elementskit-menu-hamburger:hover',
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'elementskit_menu_toggle_border_hover',
                'label' => esc_html__( 'Border', 'elementskit' ),
                'separator' => 'before',
				'selector' => '{{WRAPPER}} .elementskit-menu-hamburger:hover',
			]
        );

        $this->add_control(
			'elementskit_menu_toggle_icon_color_hover',
			[
				'label' => esc_html__( 'Humber Icon Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
                ],
                'default' => 'rgba(0, 0, 0, 0.5)',
				'selectors' => [
					'{{WRAPPER}} .elementskit-menu-hamburger:hover .elementskit-menu-hamburger-icon' => 'background-color: {{VALUE}}',
				],
			]
		);

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_control(
			'elementskit_menu_close_style_title',
			[
				'label' => esc_html__( 'Close Toggle', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'elementskit_menu_close_typography',
				'label' => esc_html__( 'Typography', 'elementskit' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .elementskit-menu-close',
			]
		);

        $this->add_responsive_control(
			'elementskit_menu_close_spacing',
			[
				'label' => esc_html__( 'Padding', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
                'devices' => [ 'tablet' ],
                'tablet_default' => [
					'top' => '8',
                    'right' => '8',
                    'bottom' => '8',
                    'left' => '8',
                    'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-menu-close' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'elementskit_menu_close_margin',
			[
				'label' => esc_html__( 'Margin', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
                'devices' => [ 'tablet' ],
                'tablet_default' => [
					'top' => '12',
                    'right' => '12',
                    'bottom' => '12',
                    'left' => '12',
                    'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-menu-close' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'elementskit_menu_close_width',
			[
				'label' => esc_html__( 'Width', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 45,
						'max' => 100,
						'step' => 1,
					],
                ],
                'devices' => [ 'tablet' ],
				'tablet_default' => [
					'unit' => 'px',
					'size' => 45,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-menu-close' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'elementskit_menu_close_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
                ],
                'devices' => [ 'tablet' ],
				'tablet_default' => [
					'unit' => 'px',
					'size' => 3,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-menu-close' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->start_controls_tabs(
            'elementskit_menu_close_normal_and_hover_tabs'
        );

        $this->start_controls_tab(
            'elementskit_menu_close_normal',
            [
                'label' => esc_html__( 'Normal', 'elementskit' ),
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'elementskit_menu_close_background',
				'label' => esc_html__( 'Background', 'elementskit' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .elementskit-menu-close',
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'elementskit_menu_close_border',
                'label' => esc_html__( 'Border', 'elementskit' ),
                'separator' => 'before',
				'selector' => '{{WRAPPER}} .elementskit-menu-close',
			]
        );

        $this->add_control(
			'elementskit_menu_close_icon_color',
			[
				'label' => esc_html__( 'Humber Icon Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
                ],
                'default' => 'rgba(51, 51, 51, 1)',
				'selectors' => [
					'{{WRAPPER}} .elementskit-menu-close' => 'color: {{VALUE}}',
				],
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'elementskit_menu_close_hover',
            [
                'label' => esc_html__( 'Hover', 'elementskit' ),
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'elementskit_menu_close_background_hover',
				'label' => esc_html__( 'Background', 'elementskit' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .elementskit-menu-close:hover',
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'elementskit_menu_close_border_hover',
                'label' => esc_html__( 'Border', 'elementskit' ),
                'separator' => 'before',
				'selector' => '{{WRAPPER}} .elementskit-menu-close:hover',
			]
        );

        $this->add_control(
			'elementskit_menu_close_icon_color_hover',
			[
				'label' => esc_html__( 'Humber Icon Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
                ],
                'default' => 'rgba(0, 0, 0, 0.5)',
				'selectors' => [
                    '{{WRAPPER}} .elementskit-menu-close:hover' => 'color: {{VALUE}}',
				],
			]
		);

        $this->end_controls_tab();

        $this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'elementskit_mobile_menu_logo_style_tab',
			[
				'label' => esc_html__( 'Mobile Menu Logo', 'elementskit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'elementskit_mobile_menu_logo_width',
			[
				'label' => esc_html__( 'Width', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 5,
					],
				],
				'tablet_default' => [
					'unit' => 'px',
					'size' => 160,
				],
				'mobile_default' => [
					'unit' => 'px',
					'size' => 120,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-nav-logo > img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'elementskit_mobile_menu_logo_height',
			[
				'label' => esc_html__( 'Height', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'tablet_default' => [
					'unit' => 'px',
					'size' => 60,
				],
				'mobile_default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-nav-logo > img' => 'max-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'elementskit_mobile_menu_logo_margin',
			[
				'label' => esc_html__( 'Margin', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'tablet_default' => [
					'top' => '5',
					'right' => '0',
					'bottom' => '5',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => 'false',
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-nav-logo' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'elementskit_mobile_menu_logo_padding',
			[
				'label' => esc_html__( 'Padding', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'tablet_default' => [
					'top' => '5',
					'right' => '5',
					'bottom' => '5',
					'left' => '5',
					'unit' => 'px',
					'isLinked' => 'true',
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit-nav-logo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		if($settings['elementskit_nav_menu'] != '' && wp_get_nav_menu_items($settings['elementskit_nav_menu']) !== false && count(wp_get_nav_menu_items($settings['elementskit_nav_menu'])) > 0){
			$link = '';
			if ($settings['elementskit_nav_menu_logo_link_to'] == 'home') {
				$link = get_home_url();
			} else {
				$link = $settings['elementskit_nav_menu_logo_link']['url'];
			}
			$target = '';
			if ($settings['elementskit_nav_menu_logo_link']['is_external'] == "on") {
				$target = "_blank";
			} else {
				$target = "_self";
			}
			$nofollow = '';
			if ($settings['elementskit_nav_menu_logo_link']['nofollow'] == "on") {
				$nofollow = "nofollow";
			} else {
				$nofollow = "";
			}
			$markup = '
				<div class="elementskit-nav-identity-panel">
					<div class="elementskit-site-title">
						<a class="elementskit-nav-logo" href="'.$link.'" target="'.$target.'" rel="'.$nofollow.'">
							<img src="'.$settings['elementskit_nav_menu_logo']['url'].'" alt="" >
						</a>
					</div>
					<button class="elementskit-menu-close elementskit-menu-toggler" type="button">X</button>
				</div>
			';
			$args = [
				'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>' . $markup,
				'container'       => 'div',
				'container_id'    => 'ekit-megamenu-' . $settings['elementskit_nav_menu'],
				'container_class' => 'elementskit-menu-container elementskit-menu-offcanvas-elements elementskit-navbar-nav-default ' . $settings['elementskit_style_tab_submenu_item_arrow'] . ' ekit-nav-menu-one-page-' . $settings['elementskit_one_page_enable'],
				'menu_id'         => 'main-menu',
				'menu'         	  => $settings['elementskit_nav_menu'],
				'menu_class'      => 'elementskit-navbar-nav ' . $settings['elementskit_main_menu_position'],
				'depth'           => 4,
				'echo'            => true,
				'fallback_cb'     => 'wp_page_menu',
				'walker'          => (class_exists('\ElementsKit\Elementskit_Menu_Walker') ? new \ElementsKit\Elementskit_Menu_Walker() : '' )
			];

			wp_nav_menu($args);
		}
    }
    protected function _content_template() { }
}