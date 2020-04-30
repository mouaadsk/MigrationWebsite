<?php
namespace Elementor;

use \ElementsKit\Elementskit_Widget_Team_Handler as Handler;
use \ElementsKit\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;


class Elementskit_Widget_Team extends Widget_Base {
    use \ElementsKit\Widgets\Widget_Notice;

    public $base;
    
    public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );
		$this->add_script_depends('magnific-popup');
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

        // Team Content
        $this->start_controls_section(
            'ekit_team_content', [
                'label' => esc_html__( 'Team Member Content', 'elementskit' ),
            ]
        );

        $this->add_control(
            'ekit_team_style',
            [
                'label' =>esc_html__( 'Style', 'elementskit' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__( 'Default', 'elementskit' ),
                    'overlay' => esc_html__( 'Overlay', 'elementskit' ),
                    'centered_style' => esc_html__( 'Centered ', 'elementskit' ),
                    'hover_info' => esc_html__( 'Hover on social', 'elementskit' ),
                    'overlay_details' => esc_html__( 'Overlay with details', 'elementskit' ),
                    'centered_style_details' => esc_html__( 'Centered with details ', 'elementskit' ),
                    'long_height_hover' => esc_html__( 'Long height with hover ', 'elementskit' ),
                    'long_height_details' => esc_html__( 'Long height with details ', 'elementskit' ),
                    'long_height_details_hover' => esc_html__( 'Long height with details & hover', 'elementskit' ),
                    'overlay_circle' => esc_html__( 'Overlay with circle shape', 'elementskit' ),
                    'overlay_circle_hover' => esc_html__( 'Overlay with circle shape & hover', 'elementskit' ),
                ],
            ]
        );

        $this->add_control(
            'ekit_team_image',
            [
                'label' => esc_html__( 'Choose Member Image', 'elementskit' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'ekit_team_thumbnail',
                'default' => 'large',
            ]
        );

        $this->add_control(
            'ekit_team_name',
            [
                'label' => esc_html__( 'Member Name', 'elementskit' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Jane Doe', 'elementskit' ),
                'placeholder' => esc_html__( 'Member Name', 'elementskit' ),
            ]
        );

        $this->add_control(
            'ekit_team_position',
            [
                'label' => esc_html__( 'Member Position', 'elementskit' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Designer', 'elementskit' ),
                'placeholder' => esc_html__( 'Member Position', 'elementskit' ),

            ]
        );

        // Show Icon
        $this->add_control(
			'ekit_team_toggle_icon',
			[
				'label' => esc_html__( 'Show Icon', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementskit' ),
				'label_off' => esc_html__( 'Hide', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'no',
                'condition' => [
                    'ekit_team_style' => 'default',
                ],
			]
        );
        $this->add_control(
            'ekit_team_top_icons',
            [
                'label' => esc_html__( 'Icon', 'elementskit' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'ekit_team_top_icon',
                'default' => [
                    'value' => 'icon icon-team1',
                    'library' => 'ekiticons',
                ],
                'condition' => [
                    'ekit_team_style' => 'default',
                    'ekit_team_toggle_icon' => 'yes',
                ],
            ]
        );
        
        // Show Description
        $this->add_control(
			'ekit_team_show_short_description',
			[
				'label' => esc_html__( 'Show Description', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementskit' ),
				'label_off' => esc_html__( 'Hide', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
        $this->add_control(
            'ekit_team_short_description',
            [
                'label' => esc_html__( 'About Member', 'elementskit' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'A small river named Duden flows by their place and supplies it with the necessary', 'elementskit' ),
                'placeholder' => esc_html__( 'About Member', 'elementskit' ),
                'condition' => [
                    'ekit_team_show_short_description' => 'yes'
                ],

            ]
        );

        $this->end_controls_section();


        // Team Social section

	   $this->start_controls_section(
            'ekit_team_section_social', [
                'label' => esc_html__( 'Social  Profiles', 'elementskit' ),
            ]
        );

        $this->add_control(
            'ekit_team_socail_enable',
            [
                'label' => esc_html__( 'Display Social Profiles?', 'elements-test' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'elements-test' ),
                'label_off' => esc_html__( 'Hide', 'elements-test' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $social = new Repeater();

        $social->add_control(
            'ekit_team_icons',
            [
                'label' => esc_html__( 'Icon', 'elementskit' ),
                'label_block' => true,
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'ekit_team_icon',
                'default' => [
                    'value' => 'icon icon-facebook',
                    'library' => 'ekiticons',
                ],
            ]
        );

        $social->add_control(
            'ekit_team_label',
            [
                'label' => esc_html__( 'Label', 'elementskit' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Facebook',
            ]
        );

        $social->add_control(
            'ekit_team_link',
            [
                'label' => esc_html__( 'Link', 'elementskit' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => 'https://facebook.com',
                ],
            ]
        );
        // start tab for content
        $social->start_controls_tabs(
            'ekit_team_socialmedia_tabs'
        );

        // start normal tab
        $social->start_controls_tab(
            'ekit_team_socialmedia_normal',
            [
                'label' => esc_html__( 'Normal', 'elementskit' ),
            ]
        );

        // set social icon color
        $social->add_control(
            'ekit_team_socialmedia_icon_color',
            [
                'label' =>esc_html__( 'Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} > a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}} > a svg path' => 'stroke: {{VALUE}}; fill: {{VALUE}};'
                ],
            ]
        );

        // set social icon background color
        $social->add_control(
            'ekit_team_socialmedia_icon_bg_color',
            [
                'label' =>esc_html__( 'Background Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#a1a1a1',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} > a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $social->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ekit_team_socialmedia_border',
                'label' => esc_html__( 'Border', 'elementskit' ),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} > a',
            ]
        );

        $social->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'ekit_team_socialmedia_icon_normal_text_shadow',
                'label' => esc_html__( 'Text Shadow', 'elementskit' ),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} > a',
            ]
        );

        $social->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name'       => 'ekit_team_socialmedai_list_box_shadow',
                'selector'   => '{{WRAPPER}} {{CURRENT_ITEM}} > a',
            ]
        );

        $social->end_controls_tab();
        // end normal tab

        //start hover tab
        $social->start_controls_tab(
            'ekit_team_socialmedia_hover',
            [
                'label' => esc_html__( 'Hover', 'elementskit' ),
            ]
        );

        // set social icon color
        $social->add_control(
            'ekit_team_socialmedia_icon_hover_color',
            [
                'label' =>esc_html__( 'Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} > a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}} > a:hover svg path'   => 'stroke: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );

        // set social icon background color
        $social->add_control(
            'ekit_team_socialmedia_icon_hover_bg_color',
            [
                'label' =>esc_html__( 'Background Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#3b5998',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} > a:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $social->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'ekit_team_socialmedia_icon_hover_text_shadow',
                'label' => esc_html__( 'Text Shadow', 'elementskit' ),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} > a:hover',
            ]
        );

        $social->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name'       => 'ekit_team_socialmedai_list_box_shadow_hover',
                'selector'   => '{{WRAPPER}} {{CURRENT_ITEM}} > a:hover',
            ]
        );

        $social->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ekit_team_socialmedia_border_hover',
                'label' => esc_html__( 'Border', 'elementskit' ),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} > a:hover',
            ]
        );

        $social->end_controls_tab();
        //end hover tab

        $social->end_controls_tabs();

        $this->add_control(
            'ekit_team_social_icons',
            [
                'label' => esc_html__('Add Icon', 'elementskit'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $social->get_controls(),
                'default' => [
                    [
                        'icon' => 'icon icon-facebook',
                        'label' => 'Facebook',
                    ],
                ],
                'title_field' => '{{{ ekit_team_label }}}',
                'condition' => [
                    'ekit_team_socail_enable' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'ekit_team_popup_details',
			[
				'label' => esc_html__( 'Pop Up And Sidebar Details', 'elementskit' ),
                'tab' => Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
			'ekit_team_chose_popup',
			[
				'label' => esc_html__( 'Show Popup', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

        $this->add_control(
			'ekit_team_chose_popup_style',
			[
				'label' => esc_html__( 'Popup Style', 'elementskit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'popup',
				'options' => [
					'popup'  => esc_html__( 'Popup', 'elementskit' ),
                ],
                'condition' => [
                    'ekit_team_chose_popup' => 'yes'
                ]
			]
        );

        $this->add_control(
            'ekit_team_description',
            [
                'label' => esc_html__( 'About Member', 'elementskit' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'A small river named Duden flows by their place and supplies it with the necessary', 'elementskit' ),
                'placeholder' => esc_html__( 'About Member', 'elementskit' ),
                'condition' => [
                    'ekit_team_chose_popup' => 'yes'
                ],

            ]
        );
        $this->add_control(
            'ekit_team_phone',
            [
                'label' => esc_html__( 'Phone', 'elementskit' ),
                'type' => Controls_Manager::TEXT,
                'default' => '+1 (859) 254-6589',
                'placeholder' => esc_html__( 'Phone Number', 'elementskit' ),
                'condition' => [
                    'ekit_team_chose_popup' => 'yes'
                ],

            ]
        );
        $this->add_control(
            'ekit_team_email',
            [
                'label' => esc_html__( 'Email', 'elementskit' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'info@example.com',
                'placeholder' => esc_html__( 'Email Address', 'elementskit' ),
                'condition' => [
                    'ekit_team_chose_popup' => 'yes'
                ],

            ]
        );

        $this->add_control(
            'ekit_team_chose_sidebar_direction',
            [
                'label' => esc_html__( 'Sidebar Direction', 'elementskit' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'elementskit_sidebar_left' => [
                        'title' => esc_html__( 'Left', 'elementskit' ),
                        'icon' => 'fa fa-caret-left',
                    ],
                    'elementskit_sidebar_right' => [
                        'title' => esc_html__( 'Right', 'elementskit' ),
                        'icon' => 'fa fa-caret-right',
                    ],
                ],
                'default' => 'elementskit_sidebar_right',
                'toggle' => true,
                'condition' => [
                    'ekit_team_chose_popup_style' => 'sidebar',
                    'ekit_team_chose_popup' => 'yes'
                ]
            ]
        );

        // Close icon change option
        $this->add_control(
            'ekit_team_close_icon_changes',
            [
                'label' => esc_html__( 'Close Icon', 'elementskit' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'ekit_team_close_icon_change',
                'default' => [
                    'value' => 'fas fa-times',
                    'library' => 'solid',
                ],
                'label_block' => true,
                'condition' => [
                    'ekit_team_chose_popup' => 'yes'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ekit_team_close_icon_alignment',
            [
                'label' => esc_html__( 'Close Icon Alignment', 'elementskit' ),
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
                // 'selectors' => [
                //     '.ekit-wid-con .modal-header'   => 'text-align: center'
                // ],
                'default' => 'right',
                'condition' => [
                    'ekit_team_chose_popup' => 'yes'
                ],
            ]
        );

		$this->end_controls_section();

        // start style section here

        // Team content section style start
        $this->start_controls_section(
            'ekit_team_content_style', [
                'label' => esc_html__( 'Content', 'elementskit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );



		$this->start_controls_tabs(
            'ekit_team_background_tabs'
        );
		// start normal tab
        $this->start_controls_tab(
            'ekit_team_content_normal',
            [
                'label' => esc_html__( 'Normal', 'elementskit' ),
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_team_background_content_normal',
				'label' => esc_html__( 'Background', 'elementskit' ),
                'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .profile-card, {{WRAPPER}} .profile-image-card',
			]
		);
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name'      => 'ekit_team_content_box_shadow',
                'selector'  => '{{WRAPPER}} .profile-card, {{WRAPPER}} .profile-image-card',
            ]
        );
		$this->end_controls_tab();

		$this->start_controls_tab(
            'ekit_team_content_hover',
            [
                'label' => esc_html__( 'Hover', 'elementskit' ),
            ]
        );


        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_team_background_content_hover',
				'label' => esc_html__( 'Background', 'elementskit' ),
                'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .profile-card:hover, {{WRAPPER}} .profile-image-card:hover, {{WRAPPER}} .profile-card::before, {{WRAPPER}} .profile-image-card::before, {{WRAPPER}} div .profile-card .profile-body::before, {{WRAPPER}} .image-card-v3 .profile-image-card:after',
			]
		);

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name'      => 'ekit_team_content_box_shadow_hover_group',
                'selector'  => '{{WRAPPER}} .profile-card:hover, {{WRAPPER}} .profile-image-card:hover',
            ]
        );
		$this->end_controls_tab();
		$this->end_controls_tabs();


		// contentmax height
        $this->add_responsive_control(
			'ekit_team_content_max_weight',
			[
				'label' => esc_html__( 'Max Height', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 380,
				],
				'selectors' => [
					'{{WRAPPER}} .profile-square-v .profile-card' => 'max-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ekit_team_style' => 'hover_info'
                ]
			]
		);

        // Text aliment

        $this->add_control(
            'ekit_team_content_text_align',
            [
                'label' => esc_html__( 'Alignment', 'elementskit' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__( 'Left', 'elementskit' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__( 'Center', 'elementskit' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__( 'Right', 'elementskit' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'text-center',
                'toggle' => true,
            ]
        );

        $this->add_responsive_control(
			'ekit_team_content_padding',
			[
				'label' =>esc_html__( 'Padding', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .profile-card, {{WRAPPER}} .profile-image-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'ekit_team_content_inner_padding',
            [
                'label' =>esc_html__( 'Content Padding', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .profile-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ekit_team_content_border_color_group',
                'label' => esc_html__( 'Border', 'elementskit' ),
                'selector' => '{{WRAPPER}} .profile-card, {{WRAPPER}} .profile-image-card',
            ]
        );

        $this->add_responsive_control(
			'ekit_team_content_border_radius',
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
					'{{WRAPPER}} .profile-card, {{WRAPPER}} .profile-image-card' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


        $this->add_control(
            'ekit_team_content_overly_color_heading',
            [
                'label' => esc_html__( 'Hover Overy Color', 'elementskit' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'ekit_team_style' => 'overlay_details'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ekit_team_content_overly_color',
                'label' => esc_html__( 'Background', 'elementskit' ),
                'types' => [ 'gradient'],
                'selector' => '{{WRAPPER}} .image-card-v2 .profile-image-card::before',
                'condition' => [
                       'ekit_team_style' => 'overlay_details'
                ]
            ]
        );

        $this->add_control(
            'ekit_team_remove_gutters',
            [
                'label' => esc_html__( 'Remove Gutter?', 'elementskit' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'elementskit' ),
                'label_off' => esc_html__( 'Yes', 'elementskit' ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );



        $this->end_controls_section();
        // team content section style end

        // Image Styles section
        $this->start_controls_section(
            'ekit_team_image_style', [
                'label' => esc_html__( 'Image', 'elementskit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_responsive_control(
            'ekit_team_image_weight',
            [
                'label' => esc_html__( 'Image Size', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'range'  => [
                    'px' => [
                        'min'   => 10,
                        'max'   => 300,
                    ],
                ],
				'selectors' => [
					'{{WRAPPER}} .profile-header > img, {{WRAPPER}} .profile-image-card img, {{WRAPPER}} .profile-image-card, {{WRAPPER}} .profile-header ' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
				],
				'default' => [
					'unit' => '%'
				]
            ]
        );

        $this->add_responsive_control(
            'ekit_team_image_height',
            [
                'label'         => esc_html__('Height', 'elementskit'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em'],
                'range'  => [
                    'px' => [
                        'min'   => 1,
                        'max'   => 500,
                    ],
                ],
                'condition' => [
                    'team_style!' => 'overlay',
                ],
                'selectors' => [
                    '{{WRAPPER}} .profile-card .profile-header' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ekit_team_image_height_margin_bottom',
            [
                'label' => esc_html__( 'Margin', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .profile-card .profile-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );



        $this->add_responsive_control(
            'ekit_team_image_width',
            [
                'label'         => esc_html__('Width', 'elementskit'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em', '%'],
                'range'  => [
                    'px' => [
                        'min'   => 1,
                        'max'   => 500,
                    ],
                ],
                'condition' => [
                    'team_style!' => 'overlay',
                ],
                'selectors' => [
                    '{{WRAPPER}} .profile-card .profile-header' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name'      => 'ekit_team_image_shadow',
                'selector'  => '{{WRAPPER}} .profile-card .profile-header',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ekit_team_image_border',
                'label' => esc_html__( 'Border', 'elementskit' ),
                'selector' => '{{WRAPPER}} .profile-card .profile-header',
            ]
        );

        $this->add_responsive_control(
            'ekit_team_image_radius',
            [
                'label' => esc_html__( 'Border radius', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],

				'selectors' => [
					'{{WRAPPER}} .profile-card .profile-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'default' => [
					'top' => '50',
					'right' => '50',
					'left' => '50',
					'bottom' => '50',
					'unit' => '%'
				]
            ]
        );

        $this->add_responsive_control(
            'ekit_team_image_margin',
            [
                'label' => esc_html__( 'Margin', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'condition' => [
                    'team_style!' => 'overlay',
                ],
                'selectors' => [
                    '{{WRAPPER}} .profile-card .profile-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ekit_team_image_background',
                'label' => esc_html__( 'Background', 'elementskit' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .profile-card .profile-header',
            ]
        );

		$this->add_control(
			'ekit_team_default_img_overlay_h',
			[
				'label' => esc_html__( 'Overlay', 'elementskit' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
                'condition' => [
                    'ekit_team_style' => 'default',
                ],
			]
		);
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ekit_team_default_img_overlay',
                'label' => esc_html__( 'Overlay', 'elementskit' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .profile-header:before',
                'condition' => [
                    'ekit_team_style' => 'default',
                ],
            ]
        );

        $this->end_controls_section();


        // Icon Styles
        $this->start_controls_section(
            'ekit_team_top_icon_style',
            [
                'label' => esc_html__( 'Icon', 'elementskit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ekit_team_style' => 'default',
                    'ekit_team_toggle_icon' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'ekit_team_top_icon_align',
            [
                'label' => esc_html__( 'Alignment', 'elementskit' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__( 'Left', 'elementskit' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Right', 'elementskit' ),
                        'icon' => 'fa fa-align-right',
                    ],
                    'end' => [
                        'title' => esc_html__( 'Right', 'elementskit' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
				'selectors' => [
                    '{{WRAPPER}} .profile-icon' => '-webkit-box-pack: {{VALUE}}; -ms-flex-pack: {{VALUE}}; justify-content: flex-{{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'ekit_team_top_icon_margin',
			[
				'label' => esc_html__( 'Margin', 'elementskit' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .profile-icon > i, {{WRAPPER}} .profile-icon > svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
        
        $this->add_responsive_control(
			'ekit_team_top_icon_padding',
			[
				'label' => esc_html__( 'Padding', 'elementskit' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .profile-icon > i, {{WRAPPER}} .profile-icon > svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'ekit_team_top_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .profile-icon > i, {{WRAPPER}} .profile-icon > svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'   => [
                    'top'   => '50',
                    'left'  => '50',
                    'right' => '50',
                    'bottom'=> '50',
                    'unit' => '%'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ekit_team_top_icon_shadow',
                'selector' => '{{WRAPPER}} .profile-icon > i, {{WRAPPER}} .profile-icon > svg',
            ]
        );
        
		$this->add_responsive_control(
            'ekit_team_top_icon_fsize',
            [
                'label' => esc_html__( 'Font Size', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'default' => [
                    'size' => 22,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .profile-icon > i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .profile-icon > svg'   => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'ekit_team_top_icon_hw',
			[
                'label' => esc_html__( 'Use Height Width', 'elementskit' ),
                'description'   => esc_html__('For svg icon, We don\'t need this. We will use font size and padding for adjusting size.', 'elementskit'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementskit' ),
				'label_off' => esc_html__( 'Hide', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        
		$this->add_responsive_control(
            'ekit_team_top_icon_width',
            [
                'label' => esc_html__( 'Width', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'size' => 60,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .profile-icon > i' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ekit_team_top_icon_hw' => 'yes'
                ],
            ]
        );
        
		$this->add_responsive_control(
            'ekit_team_top_icon_height',
            [
                'label' => esc_html__( 'Height', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'size' => 60,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .profile-icon > i' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ekit_team_top_icon_hw' => 'yes'
                ],
            ]
        );
        
		$this->add_responsive_control(
            'ekit_team_top_icon_lheight',
            [
                'label' => esc_html__( 'Line Height', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'size' => 60,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .profile-icon > i' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ekit_team_top_icon_hw' => 'yes'
                ],
            ]
        );

        $this->start_controls_tabs( 'top_icon_colors' );
            $this->start_controls_tab(
                'ekit_team_top_icon_colors_normal',
                [
                    'label' => esc_html__( 'Normal', 'elementskit' ),
                ]
            );
            $this->add_control(
                'ekit_team_top_icon_n_color',
                [
                    'label' => esc_html__( 'Color', 'elementskit' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#fff',
                    'selectors' => [
                        '{{WRAPPER}} .profile-icon > i' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .profile-icon > svg path'  => 'stroke: {{VALUE}}; fill: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'ekit_team_top_icon_n_bgcolor',
                [
                    'label' => esc_html__( 'Background Color', 'elementskit' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#fc0467',
                    'selectors' => [
                        '{{WRAPPER}} .profile-icon > i, {{WRAPPER}} .profile-icon > svg' => 'background-color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'ekit_team_top_icon_n_border',
                    'label' => esc_html__( 'Border', 'elementskit' ),
                    'selector' => '{{WRAPPER}} .profile-icon > i, {{WRAPPER}} .profile-icon > svg',
                ]
            );
            $this->end_controls_tab();
            
            $this->start_controls_tab(
                'ekit_team_top_icon_colors_hover',
                [
                    'label' => esc_html__( 'Hover', 'elementskit' ),
                ]
            );
                $this->add_control(
                    'ekit_team_top_icon_h_color',
                    [
                        'label' => esc_html__( 'Color', 'elementskit' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .profile-icon > i:hover' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .profile-icon > svg:hover path'    => 'stroke: {{VALUE}}; fill: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_control(
                    'ekit_team_top_icon_h_bgcolor',
                    [
                        'label' => esc_html__( 'Background Color', 'elementskit' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .profile-icon > i:hover, {{WRAPPER}} .profile-icon > svg:hover' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'ekit_team_top_icon_h_border',
                        'label' => esc_html__( 'Border', 'elementskit' ),
                        'selector' => '{{WRAPPER}} .profile-icon > i:hover, {{WRAPPER}} .profile-icon > svg:hover',
                    ]
                );
            $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();


        // Name Styles
        $this->start_controls_section(
            'ekit_team_name_style', [
                'label' => esc_html__( 'Name', 'elementskit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'       => 'ekit_team_name_typography',
                'selector'   => '{{WRAPPER}} .profile-body .profile-title',
            ]
        );

        $this->start_controls_tabs(
            'ekit_team_name_tabs'
        );

        $this->start_controls_tab(
            'ekit_team_name_normal',
            [
                'label' => esc_html__( 'Normal', 'elementskit' ),
            ]
        );

        $this->add_control(
            'ekit_team_name_color',
            [
                'label'      => esc_html__( 'Color', 'elementskit' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .profile-body .profile-title' => 'color: {{VALUE}};'
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'ekit_team_name_hover',
            [
                'label' => esc_html__( 'Hover', 'elementskit' ),
            ]
        );

        $this->add_control(
            'ekit_team_name_hover_color',
            [
                'label'      => esc_html__( 'Color', 'elementskit' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .profile-body:hover .profile-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .profile-card:hover .profile-title' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'ekit_team_name_margin',
            [
                'label'         => esc_html__('Margin Bottom', 'elementskit'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em'],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .profile-body .profile-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        // Position Styles
        $this->start_controls_section(
            'ekit_team_position_style', [
                'label' => esc_html__( 'Position', 'elementskit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'       => 'ekit_team_position_typography',
                'selector'   => '{{WRAPPER}} .profile-body .profile-designation',
            ]
        );

        $this->start_controls_tabs(
            'ekit_team_position_tabs'
        );

        $this->start_controls_tab(
            'ekit_team_position_normal',
            [
                'label' => esc_html__( 'Normal', 'elementskit' ),
            ]
        );

        $this->add_control(
            'ekit_team_position_color',
            [
                'label'      => esc_html__( 'Color', 'elementskit' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .profile-body .profile-designation' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ekit_team_position_hover',
            [
                'label' => esc_html__( 'Hover', 'elementskit' ),
            ]
        );

        $this->add_control(
            'ekit_team_position_hover_color',
            [
                'label'      => esc_html__( 'Color', 'elementskit' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .profile-card:hover .profile-body .profile-designation,
                    {{WRAPPER}} .profile-body .profile-designation:hover' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name'       => 'ekit_team_position_hover_shadow',
                'selector'   => '{{WRAPPER}} .profile-card:hover .profile-body .profile-designation,
                    {{WRAPPER}} .profile-body .profile-designation:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'ekit_team_position_margin_bottom',
            [
                'label' => esc_html__( 'Margin Bottom', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .profile-body .profile-designation' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        // Position Styles
        $this->start_controls_section(
            'ekit_team_text_content_style_tab', [
                'label' => esc_html__( 'Text Content', 'elementskit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'       => 'ekit_team_text_content_typography',
                'selector'   => '{{WRAPPER}} .profile-body .profile-content',
            ]
        );

        $this->start_controls_tabs(
            'ekit_team_text_content_tabs'
        );

        $this->start_controls_tab(
            'ekit_team_text_content_normal',
            [
                'label' => esc_html__( 'Normal', 'elementskit' ),
            ]
        );

        $this->add_control(
            'ekit_team_text_content_color',
            [
                'label'      => esc_html__( 'Color', 'elementskit' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .profile-body .profile-content' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ekit_team_text_content_hover',
            [
                'label' => esc_html__( 'Hover', 'elementskit' ),
            ]
        );

        $this->add_control(
            'ekit_team_text_content_hover_color',
            [
                'label'      => esc_html__( 'Color', 'elementskit' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .profile-card:hover .profile-body .profile-content' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .profile-image-card:hover .profile-body .profile-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
			'ekit_team_text_content_margin_bottom',
			[
				'label' => esc_html__( 'Margin', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .profile-body .profile-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
			]
		);


        $this->end_controls_section();


        // Social Styles
        $this->start_controls_section(
            'ekit_team_social_style', [
                'label' => esc_html__( 'Social  Profiles', 'elementskit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ekit_team_socail_enable' => 'yes'
                ]
            ]
        );

        // Alignment
        $this->add_responsive_control(
            'ekit_socialmedai_list_item_align',
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
				'selectors' => [
                    '{{WRAPPER}} .ekit-team-social-list > li > a' => 'text-align: {{VALUE}};',
                ],
            ]
        );

		// Display design
		 $this->add_responsive_control(
            'ekit_socialmedai_list_display',
            [
                'label' => esc_html__( 'Display', 'elementskit' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'inline-block',
                'options' => [
                    'inline-block' => esc_html__( 'Inline Block', 'elementskit' ),
                    'block' => esc_html__( 'Block', 'elementskit' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .ekit-team-social-list > li' => 'display: {{VALUE}};',
                ],
            ]
        );

		// text decoration
		 $this->add_responsive_control(
            'ekit_socialmedai_list_decoration_box',
            [
                'label' => esc_html__( 'Decoration', 'elementskit' ),
                'type' => Controls_Manager::SELECT,
				'default' => 'none',
                'options' => [
                    'none' => esc_html__( 'None', 'elementskit' ),
                    'underline' => esc_html__( 'Underline', 'elementskit' ),
                    'overline' => esc_html__( 'Overline', 'elementskit' ),
                    'line-through' => esc_html__( 'Line Through', 'elementskit' ),

                ],
                'selectors' => ['{{WRAPPER}} .ekit-team-social-list > li > a' => 'text-decoration: {{VALUE}};'],
            ]
        );


		// border radius
		 $this->add_responsive_control(
            'ekit_socialmedai_list_border_radius',
            [
                'label' => esc_html__( 'Border radius', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '50',
					'right' => '50',
					'bottom' => '50' ,
					'left' => '50',
					'unit' => '%',
				],
                'selectors' => [
                    '{{WRAPPER}} .ekit-team-social-list > li > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		// Padding style

		 $this->add_responsive_control(
            'ekit_socialmedai_list_padding',
            [
                'label'         => esc_html__('Padding', 'elementskit'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ekit-team-social-list > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		// margin style

		$this->add_responsive_control(
            'ekit_socialmedai_list_margin',
            [
                'label'         => esc_html__('Margin', 'elementskit'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ekit-team-social-list > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ekit_socialmedai_list_icon_size',
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
                    '{{WRAPPER}} .ekit-team-social-list > li > a i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ekit-team-social-list > li > a svg' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ekit_socialmedai_list_typography',
				'label' => esc_html__( 'Typography', 'elementskit' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .ekit-team-social-list > li > a',
			]
		);

        $this->add_control(
			'ekit_socialmedai_list_style_use_height_and_width',
			[
                'label' => esc_html__( 'Use Height Width', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementskit' ),
				'label_off' => esc_html__( 'Hide', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->add_responsive_control(
			'ekit_socialmedai_list_width',
			[
				'label' => esc_html__( 'Width', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .ekit-team-social-list > li > a' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ekit_socialmedai_list_style_use_height_and_width' => 'yes'
                ]
			]
		);

        $this->add_responsive_control(
			'ekit_socialmedai_list_height',
			[
				'label' => esc_html__( 'Height', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .ekit-team-social-list > li > a' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ekit_socialmedai_list_style_use_height_and_width' => 'yes'
                ]
			]
		);

        $this->add_responsive_control(
			'ekit_socialmedai_list_line_height',
			[
				'label' => esc_html__( 'Line Height', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .ekit-team-social-list > li > a' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ekit_socialmedai_list_style_use_height_and_width' => 'yes'
                ]
			]
		);

        $this->end_controls_section();


        // Overlay Styles
        $this->start_controls_section(
            'ekit_team_overlay_style', [
                'label' => esc_html__( 'Overlay', 'elementskit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'team_style' => 'overlay',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ekit_team_background_overlay',
                'label' => esc_html__( 'Background', 'elementskit' ),
                'types' => [ 'gradient' ],
                'selector' => '{{WRAPPER}} .profile-image-card:before',
            ]
        );

        $this->end_controls_section();


        // Modal Styles start here
        $this->start_controls_section(
            'ekit_team_modal_style', [
                'label' => esc_html__( 'Modal Controls', 'elementskit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ekit_team_chose_popup' => 'yes'
                ]
            ]
        );


        $this->add_control(
			'ekit_team_modal_heading',
			[
				'label' => esc_html__( 'Modal', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ekit_team_modal_background',
                'label' => esc_html__( 'Background', 'elementskit' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .elementskit-team-popup .modal-content, {{WRAPPER}} .elementskit-team-sidebar .elementskit-modal-dialog',
            ]
        );

        $this->add_control(
            'ekit_team_modal_image_heading',
            [
                'label' => esc_html__( 'Image', 'elementskit' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->add_responsive_control(
            'ekit_team_modal_image_margin',
            [
                'label' => esc_html__( 'Margin Bottom', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-team-sidebar .modal_image_wraper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
			'ekit_team_modal_name_heading',
			[
				'label' => esc_html__( 'Name', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            'ekit_team_modal_name_color',
            [
                'label'      => esc_html__( 'Color', 'elementskit' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .xs-modal-content .xs-modal-header .person-title' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'       => 'ekit_team_modal_name_typography',
                'selector'   => '{{WRAPPER}} .xs-modal-content .xs-modal-header .person-title',
            ]
        );

        $this->add_responsive_control(
            'ekit_team_modal_name_margin_bottom',
            [
                'label' => esc_html__( 'Margin Bottom', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .xs-modal-content .xs-modal-header .person-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
			'ekit_team_modal_position_heading',
			[
				'label' => esc_html__( 'Position', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            'ekit_team_modal_position_color',
            [
                'label'      => esc_html__( 'Color', 'elementskit' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .xs-modal-content .xs-modal-header .perosn-designation' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'       => 'ekit_team_modal_position_typography',
                'selector'   => '{{WRAPPER}} .xs-modal-content .xs-modal-header .perosn-designation',
            ]
        );
        $this->add_responsive_control(
            'ekit_team_modal_position_margin_bottom',
            [
                'label' => esc_html__( 'Margin Bottom', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .elementskit-team-sidebar .xs-modal-header' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
			'more_options',
			[
				'label' => esc_html__( 'Phone and Email', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'       => 'ekit_team_info_typography',
                'selector'   => '{{WRAPPER}} .border-lists>li strong,
                {{WRAPPER}} .xs-modal-content .border-lists li > a',
            ]
        );

        $this->add_control(
            'ekit_team_info_color',
            [
                'label'      => esc_html__( 'Color', 'elementskit' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .border-lists>li strong,
                    {{WRAPPER}} .xs-modal-content .border-lists li > a' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'ekit_team_info_hover_color',
            [
                'label'      => esc_html__( 'Color Hover', 'elementskit' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .xs-modal-content .border-lists li > a:hover' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ekit_team_close_icon',
            [
                'label' => esc_html__( 'Close Icon', 'elementskit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ekit_team_chose_popup' => 'yes'
                ]
            ]
        );

        $this->start_controls_tabs( 'ekit_icon_box_icon_colors' );

        $this->start_controls_tab(
            'ekit_team_icon_colors_normal',
            [
                'label' => esc_html__( 'Normal', 'elementskit' ),
            ]
        );

        $this->add_control(
            'ekit_team_icon_primary_color',
            [
                'label' => esc_html__( 'Icon Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#656565',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-team-popup .modal-content .modal-header span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementskit-team-popup .modal-content .modal-header span svg path' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ekit_team_icon_secondary_color_normal',
            [
                'label' => esc_html__( 'Icon BG Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-team-popup .modal-content .modal-header span' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ekit_team_border',
                'label' => esc_html__( 'Border', 'elementskit' ),
                'selector' => '{{WRAPPER}} .elementskit-team-popup .modal-content .modal-header span',
            ]
        );



        $this->add_responsive_control(
            'ekit_team_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-team-popup .modal-content .modal-header span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ekit_icon_icon_box_shadow_normal_group',
                'selector' => '{{WRAPPER}} .elementskit-team-popup .modal-content .modal-header span',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'ekit_team_icon_colors_hover',
            [
                'label' => esc_html__( 'Hover', 'elementskit' ),
            ]
        );

        $this->add_control(
            'ekit_team_hover_primary_color',
            [
                'label' => esc_html__( 'Icon Hover Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-team-popup .modal-content .modal-header span:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementskit-team-popup .modal-content .modal-header span:hover svg path' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ekit_team_hover_background_color',
            [
                'label' => esc_html__( 'Background Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-team-popup .modal-content .modal-header span:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ekit_team_border_icon_group',
                'label' => esc_html__( 'Border', 'elementskit' ),
                'selector' => '{{WRAPPER}} ..elementskit-team-popup .modal-content .modal-header span:hover',
            ]
        );

        $this->add_responsive_control(
            'ekit_icon_box_icons_hover_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-team-popup .modal-content .modal-header span:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ekit_team_shadow_group',
                'selector' => '{{WRAPPER}} .elementskit-team-popup .modal-content .modal-header span:hover',
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->add_responsive_control(
            'ekit_team_close_icon_size',
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
                    '{{WRAPPER}} .elementskit-team-popup .modal-content .modal-header span' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementskit-team-popup .modal-content .modal-header span svg' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'ekit_team_close_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-team-popup .modal-content .modal-header span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ekit_team_close_icon_enable_height_width',
            [
                'label' => esc_html__( 'Use height width', 'elementskit' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'elementskit' ),
                'label_off' => esc_html__( 'No', 'elementskit' ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_responsive_control(
            'ekit_team_close_icon_height',
            [
                'label' => esc_html__( 'Height', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-team-popup .modal-content .modal-header span ' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ekit_team_close_icon_enable_height_width' => 'yes',
                ],

            ]
        );

        $this->add_responsive_control(
            'ekit_team_close_icon_width',
            [
                'label' => esc_html__( 'Width', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-team-popup .modal-content .modal-header span' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                  'ekit_team_close_icon_enable_height_width' => 'yes',
              ],


            ]
        );

        $this->add_responsive_control(
            'ekit_team_close_icon_line_height',
            [
                'label' => esc_html__( 'Line Height', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-team-popup .modal-content .modal-header span' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ekit_team_close_icon_enable_height_width' => 'yes',
                ],

            ]
        );

        $this->add_responsive_control(
            'ekit_team_close_icon_vertical_align',
            [
                'label' => esc_html__( 'Vertical Position ', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-infobox .elementskit-box-header .elementskit-info-box-icon' => ' -webkit-transform: translateY({{SIZE}}{{UNIT}}); -ms-transform: translateY({{SIZE}}{{UNIT}}); transform: translateY({{SIZE}}{{UNIT}});',
                ],
                'condition' => [
                    'ekit_icon_box_icon_position!' => 'top'
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

        // Image sectionn
        $image_html = '';
        if (!empty($settings['ekit_team_image']['url'])) {

            $this->add_render_attribute('image', 'src', $settings['ekit_team_image']['url']);
            $this->add_render_attribute('image', 'alt', Control_Media::get_image_alt($settings['ekit_team_image']));
            $this->add_render_attribute('image', 'title', Control_Media::get_image_title($settings['ekit_team_image']));

            $image_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'ekit_team_thumbnail', 'ekit_team_image');

        }

        extract($settings);

        $ekit_sidebar_direction = '';
        if ($settings['ekit_team_chose_popup_style']== 'sidebar') {
            $ekit_sidebar_direction = $settings['ekit_team_chose_sidebar_direction'];
        }


        ?>
        <!-- This box for default design-->
        <?php if ( in_array($ekit_team_style, array('default', 'centered_style', 'centered_style_details', 'long_height_details', 'long_height_details_hover'))): ?>
            <?php if($ekit_team_style == 'centered_style'): ?> <div class="profile-square-v"> <?php endif; ?>
            <?php if($ekit_team_style == 'centered_style_details'): ?> <div class="profile-square-v square-v5 no_gutters"> <?php endif; ?>
            <?php if($ekit_team_style == 'long_height_details'): ?> <div class="profile-square-v square-v6 no_gutters"> <?php endif; ?>
            <?php if($ekit_team_style == 'long_height_details_hover'): ?> <div class="profile-square-v square-v6 square-v6-v2 no_gutters"> <?php endif; ?>
             <div class="profile-card <?php if(isset($ekit_team_content_text_align)) { echo esc_attr($ekit_team_content_text_align);} ?>">

            <?php if ($settings['ekit_team_chose_popup'] == 'yes') : ?>
                <a href="#ekit_team_modal_<?php echo esc_attr($this->get_id()); ?>" class="ekit-team-popup">
            <?php endif; ?>
            
                <div class="profile-header <?php echo esc_attr($ekit_team_style == 'default' ? 'ekit-img-overlay' : ''); ?>" <?php if ( (isset($settings['ekit_team_chose_popup']) ? $ekit_team_chose_popup : 'no')  == 'yes') :?> data-toggle="modal" data-target="ekit_team_modal_#<?php echo esc_attr($this->get_id()); ?>" <?php endif; ?>>
                    <?php echo \ElementsKit\Utils::kses($image_html); ?>
                </div><!-- .profile-header END -->
            <?php if ($settings['ekit_team_chose_popup'] == 'yes') : ?>
                </a>
            <?php endif; ?>
            

                <div class="profile-body">
                    <?php if ( 'default' == $ekit_team_style && 'yes' == $ekit_team_toggle_icon && !empty( $ekit_team_top_icons ) ): ?>
                    <div class="profile-icon">

                    <?php
                        // new icon
                        $migrated = isset( $settings['__fa4_migrated']['ekit_team_top_icons'] );
                        // Check if its a new widget without previously selected icon using the old Icon control
                        $is_new = empty( $settings['ekit_team_top_icon'] );
                        if ( $is_new || $migrated ) {
                            // new icon
                            Icons_Manager::render_icon( $settings['ekit_team_top_icons'], [ 'aria-hidden' => 'true' ] );
                        } else {
                            ?>
                            <i class="<?php echo esc_attr($settings['ekit_team_top_icon']); ?>" aria-hidden="true"></i>
                            <?php
                        }
                    ?>
                    </div>
                    <?php endif; ?>

                    <h2 class="profile-title">
                    <?php if ($settings['ekit_team_chose_popup'] == 'yes') : ?>
                        <a  href="#ekit_team_modal_<?php echo esc_attr($this->get_id()); ?>" class="ekit-team-popup">
                        <?php echo esc_html( $ekit_team_name ); ?>
                        </a>
                        <?php else: ?>
                        <?php echo esc_html( $ekit_team_name ); ?>
                    <?php endif; ?>
                    </h2>
                    <p class="profile-designation"><?php echo esc_html( $ekit_team_position ); ?></p>
                    <?php if($ekit_team_show_short_description == 'yes' && $ekit_team_short_description != ''): ?>
                    <p class="profile-content"><?php echo \ElementsKit\Utils::kses($ekit_team_short_description); ?></p>
                    <?php endif;?>
                </div><!-- .profile-body END -->

                <?php if(isset($ekit_team_socail_enable) AND $ekit_team_socail_enable == 'yes'){?>
                    <div class="profile-footer">
                        <ul class="ekit-team-social-list ">
                        <?php foreach ($ekit_team_social_icons as $icon): ?>
                                <li class="elementor-repeater-item-<?php echo esc_attr( $icon[ '_id' ] ); ?>"><a
                                    <?php if ( 'on' == $icon['ekit_team_link']['is_external'] ): ?>
                                        target="_blank"
                                    <?php endif; ?>
                                    <?php if ( 'on' == $icon['ekit_team_link']['nofollow'] ): ?>
                                        rel="nofollow"
                                    <?php endif;

                                    // new icon
                                    $migrated = isset( $icon['__fa4_migrated']['ekit_team_icons'] );
                                    // Check if its a new widget without previously selected icon using the old Icon control
                                    $is_new = empty( $icon['ekit_team_icon'] );

                                    $getClass = explode('-', ($is_new || $migrated) ? $icon['ekit_team_icons']['library'] != 'svg' ? $icon['ekit_team_icons']['value'] : '' : $icon['ekit_team_icon']);
                                     $iconClass = end($getClass);
                                  ?> href="<?php echo esc_url( $icon['ekit_team_link']['url'] ); ?>" class="<?php echo esc_attr( $iconClass ); ?>" >
                                    <?php
                                        if ( $is_new || $migrated ) {
                                            // new icon
                                            Icons_Manager::render_icon( $icon['ekit_team_icons'], [ 'aria-hidden' => 'true' ] );
                                        } else {
                                            ?>
                                            <i class="<?php echo esc_attr($icon['ekit_team_icon']); ?>" aria-hidden="true"></i>
                                            <?php
                                        }
                                    ?>  
                                </a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div><!-- .profile-footer END -->
                    <?php
                    }
                    ?>
                </div><!-- .profile-card END -->
                <?php if(in_array($ekit_team_style, array('centered_style', 'centered_style_details', 'long_height_details', 'long_height_details_hover')) ): ?> </div> <?php endif; ?>
            <?php endif; ?>
            <!-- This box for overlay design-->

            <?php if ( in_array($ekit_team_style, array('overlay', 'overlay_details', 'long_height_hover', 'overlay_circle', 'overlay_circle_hover')) ): ?>
                <?php if($ekit_team_style == 'overlay_details'): ?> <div class="image-card-v2"> <?php endif; ?>
                <?php if($ekit_team_style == 'long_height_hover'): ?> <div class="<?php echo esc_attr($settings['ekit_team_remove_gutters'] == 'yes' ? '' : 'small-gutters'); ?> image-card-v3"> <?php endif; ?>
                <?php if($ekit_team_style == 'overlay_circle'): ?> <div class="style-circle"> <?php endif; ?>
                <?php if($ekit_team_style == 'overlay_circle_hover'): ?> <div class="image-card-v2 style-circle"> <?php endif; ?>
                    <div class="profile-image-card <?php if(isset($ekit_team_content_text_align)) { echo esc_attr($ekit_team_content_text_align);} ?>">

                        <?php if($ekit_team_style == 'long_height_hover'){ ?>
                            <?php echo \ElementsKit\Utils::kses($image_html); ?>
                        <?php
                            $modalClass = 'team-sidebar_'.$ekit_team_style.'';
                        }else{
                            $modalClass = 'team-modal_'.$ekit_team_style.'';
                        ?>
                            <?php echo \ElementsKit\Utils::kses($image_html); ?>
                        <?php }?>
                        <div class="hover-area">
                            <div class="profile-body">
                                <h2 class="profile-title">
                                <?php if ($settings['ekit_team_chose_popup'] == 'yes') : ?>
                                    <a  href="#ekit_team_modal_<?php echo esc_attr($this->get_id()); ?>" class="ekit-team-popup">
                                    <?php echo esc_html( $ekit_team_name ); ?>
                                    </a>
                                    <?php else: ?>
                                    <?php echo esc_html( $ekit_team_name ); ?>
                                <?php endif; ?>
                                </h2>
                                <p class="profile-designation"><?php echo esc_html( $ekit_team_position ); ?></p>
                                <?php if($ekit_team_show_short_description == 'yes' && $ekit_team_short_description != ''): ?>
                                <p class="profile-content"><?php echo \ElementsKit\Utils::kses($ekit_team_short_description); ?></p>
                                <?php endif;?>
                            </div><!-- .profile-body END -->
                            <?php if(isset($ekit_team_socail_enable) && $ekit_team_socail_enable == 'yes'){?>
                                <div class="profile-footer">
                                    <ul class="ekit-team-social-list  ">
                                        <?php foreach ($ekit_team_social_icons as $icon): ?>
                                            <li class="elementor-repeater-item-<?php echo esc_attr( $icon[ '_id' ] ); ?>"><a
                                                <?php if ( 'on' == $icon['ekit_team_link']['is_external'] ): ?>
                                                    target="_blank"
                                                <?php endif; ?>
                                                <?php if ( 'on' == $icon['ekit_team_link']['nofollow'] ): ?>
                                                    rel="nofollow"
                                                <?php endif;
                                                // new icon
                                                $migrated = isset( $icon['__fa4_migrated']['ekit_team_icons'] );
                                                // Check if its a new widget without previously selected icon using the old Icon control
                                                $is_new = empty( $icon['ekit_team_icon'] );

                                                $getClass = explode('-', ($is_new || $migrated) ?  $icon['ekit_team_icons']['library'] != 'svg' ? $icon['ekit_team_icons']['value'] : '' : $icon['ekit_team_icon']);
                                                $iconClass = end($getClass);
                                              ?> href="<?php echo esc_url( $icon['ekit_team_link']['url'] ); ?>" class="<?php echo esc_attr( $iconClass ); ?>" >
                                                    <?php
                                                        if ( $is_new || $migrated ) {
                                                            // new icon
                                                            Icons_Manager::render_icon( $icon['ekit_team_icons'], [ 'aria-hidden' => 'true' ] );
                                                        } else {
                                                            ?>
                                                            <i class="<?php echo esc_attr($icon['ekit_team_icon']); ?>" aria-hidden="true"></i>
                                                            <?php
                                                        }
                                                    ?>   
                                            </a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div><!-- .profile-footer END -->
                            <?php
                            }
                            ?>
                        </div>
                    </div><!-- .profile-image-card END -->
                    <?php if(in_array($ekit_team_style, array('overlay_details', 'long_height_hover' , 'overlay_circle', 'overlay_circle_hover')) ): ?> </div> <?php endif; ?>

                <?php
                endif;
                if ( 'hover_info' == $ekit_team_style ):
                ?>
                <!-- This box for overlay design-->
                <div class="profile-square-v square-v4">
                    <div class="profile-card <?php if(isset($ekit_team_content_text_align)) { echo esc_attr($ekit_team_content_text_align);} ?>">
                        <div class="profile-header" <?php if ($settings['ekit_team_chose_popup'] == 'yes') :?> data-toggle="modal" data-target="#ekit_team_modal_<?php echo esc_attr($this->get_id()); ?>" <?php endif; ?>>
                            <?php echo \ElementsKit\Utils::kses($image_html); ?>
                        </div><!-- .profile-header END -->
                        <div class="profile-body">
                            <h2 class="profile-title">
                            <?php if ($settings['ekit_team_chose_popup'] == 'yes') : ?>
                                <a  href="#ekit_team_modal_<?php echo esc_attr($this->get_id()); ?>" class="ekit-team-popup">
                                <?php echo esc_html( $ekit_team_name ); ?>
                                </a>
                                <?php else: ?>
                                <?php echo esc_html( $ekit_team_name ); ?>
                            <?php endif; ?>
                            </h2>
                            <p class="profile-designation"><?php echo esc_html( $ekit_team_position ); ?></p>
                            <?php if($ekit_team_show_short_description == 'yes' && $ekit_team_short_description != ''): ?>
                            <p class="profile-content"><?php echo \ElementsKit\Utils::kses($ekit_team_short_description); ?></p>
                            <?php endif;?>
                            <?php if(isset($ekit_team_socail_enable) AND $ekit_team_socail_enable == 'yes'){?>
                                <ul class="ekit-team-social-list ">
                                    <?php foreach ($ekit_team_social_icons as $icon): ?>
                                        <li class="elementor-repeater-item-<?php echo esc_attr( $icon[ '_id' ] ); ?>"><a
                                            <?php if ( 'on' == $icon['ekit_team_link']['is_external'] ): ?>
                                                target="_blank"
                                            <?php endif; ?>
                                            <?php if ( 'on' == $icon['ekit_team_link']['nofollow'] ): ?>
                                                rel="nofollow"
                                            <?php endif;
                                            // new icon
                                            $migrated = isset( $icon['__fa4_migrated']['ekit_team_icons'] );
                                            // Check if its a new widget without previously selected icon using the old Icon control
                                            $is_new = empty( $icon['ekit_team_icon'] );

                                            $getClass = explode('-', ($is_new || $migrated) ?  $icon['ekit_team_icons']['library'] != 'svg' ?  $icon['ekit_team_icons']['value'] : '' : $icon['ekit_team_icon']);
                                             $iconClass = end($getClass);
                                            ?> href="<?php echo esc_url( $icon['ekit_team_link']['url'] ); ?>" class="<?php echo esc_attr( $iconClass ); ?>" >
                                                <?php
                                                    if ( $is_new || $migrated ) {
                                                        // new icon
                                                        Icons_Manager::render_icon( $icon['ekit_team_icons'], [ 'aria-hidden' => 'true' ] );
                                                    } else {
                                                        ?>
                                                        <i class="<?php echo esc_attr($icon['ekit_team_icon']); ?>" aria-hidden="true"></i>
                                                        <?php
                                                    }
                                                ?> 
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php
                            }
                            ?>
                        </div><!-- .profile-body END -->
                    </div><!-- .profile-card END -->
                </div>
            <?php endif; ?>

        <!-- start team modal Style -->
        <?php if ((isset($settings['ekit_team_chose_popup']) ? $ekit_team_chose_popup : 'no') == 'yes') : ?>
        <?php if ($settings['ekit_team_chose_popup_style'] == 'popup') : ?>
        <div class="zoom-anim-dialog mfp-hide elementskit-team-popup" id="ekit_team_modal_<?php echo esc_attr($this->get_id()); ?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header <?php echo esc_attr($ekit_team_close_icon_alignment); ?>">
                        <?php if($ekit_team_close_icon_changes != '') :  ?>


                        <span class="ekit-modal-close">
                            <?php
                            // var_dump($settings['ekit_accordion_right_icons']);
                                // new icon
                                $migrated = isset( $settings['__fa4_migrated']['ekit_team_close_icon_changes'] );
                                // Check if its a new widget without previously selected icon using the old Icon control
                                $is_new = empty( $settings['ekit_team_close_icon_change'] );
                                if ( $is_new || $migrated ) {
                                    // new icon
                                    Icons_Manager::render_icon( $settings['ekit_team_close_icon_changes'], [ 'aria-hidden' => 'true' ] );
                                } else {
                                    ?>
                                    <i class="<?php echo esc_attr($settings['ekit_team_close_icon_change']); ?>" aria-hidden="true"></i>
                                    <?php
                                }
                            ?>
                        </span>

                            

                        <?php else:  ?>
                        <span aria-hidden="true">&times;</span>
                        <?php endif; ?>

                    </div>
                    <div class="modal-body">
                        <div class="modal_image_wraper">
                            <div class="modal-img">
                            <?php echo \ElementsKit\Utils::kses($image_html); ?>
                            </div>
                        </div>
                        <div class="modal_content_wraper">
                            <div class="xs-modal-content">
                                <div class="xs-modal-header">
                                    <h2 class="person-title"><?php echo esc_html( $ekit_team_name ); ?></h2>
                                    <span class="perosn-designation"><?php echo esc_html( $ekit_team_position ); ?></span>
                                </div><!-- .xs-modal-header END -->
								<div class="xs-modal-body">
                                    <?php echo \ElementsKit\Utils::kses($ekit_team_description); ?>
                                </div><!-- .xs-modal-body END -->
                                <div class="xs-modal-footer">
                                    <?php if ( $ekit_team_phone || $ekit_team_email ): ?>
                                        <ul class="border-lists">
                                            <?php if ( $ekit_team_phone ): ?>
                                                <li><strong><?php esc_html_e( 'Phone', 'elementskit' ); ?>:</strong><a href="tel:<?php echo esc_attr( $ekit_team_phone ); ?>"><?php echo esc_html( $ekit_team_phone ); ?></a></li>
                                            <?php endif; ?>

                                            <?php if ( $ekit_team_email ): ?>
                                                <li><strong><?php esc_html_e( 'Email', 'elementskit' ); ?>:</strong><a href="mailto:<?php echo esc_attr( $ekit_team_email ); ?>"><?php echo esc_html( $ekit_team_email ); ?></a></li>
                                            <?php endif; ?>
                                        </ul>
                                    <?php endif; ?>
                                    <?php if(isset($ekit_team_socail_enable) AND $ekit_team_socail_enable == 'yes'){?>
                                    <ul class="ekit-team-social-list ">
                                        <?php foreach ($ekit_team_social_icons as $icon): ?>
                                            <li class="elementor-repeater-item-<?php echo esc_attr( $icon[ '_id' ] ); ?>"><a
                                                <?php if ( 'on' == $icon['ekit_team_link']['is_external'] ): ?>
                                                    target="_blank"
                                                <?php endif; ?>
                                                <?php if ( 'on' == $icon['ekit_team_link']['nofollow'] ): ?>
                                                    rel="nofollow"
                                                <?php endif; ?>

                                                href="<?php echo esc_url( $icon['ekit_team_link']['url'] ); ?>" class="social-icons elementor-social-icon-facebook">
                                                <?php
                                                    // new icon
                                                    $migrated = isset( $icon['__fa4_migrated']['ekit_team_icons'] );
                                                    // Check if its a new widget without previously selected icon using the old Icon control
                                                    $is_new = empty( $icon['ekit_team_icon'] );
                                                    if ( $is_new || $migrated ) {
                                                        // new icon
                                                        Icons_Manager::render_icon( $icon['ekit_team_icons'], [ 'aria-hidden' => 'true' ] );
                                                    } else {
                                                        ?>
                                                        <i class="<?php echo esc_attr($icon['ekit_team_icon']); ?>" aria-hidden="true"></i>
                                                        <?php
                                                    }
                                                ?> 
                                            </a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <?php
                                    }
                                    ?>
                                </div><!-- .xs-modal-footer END -->
                            </div><!-- .xs-modal-content END -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php else : ?>
        <div class="modal fade elementskit-team-sidebar <?php echo esc_attr($ekit_sidebar_direction); ?>" id="ekit_team_modal_<?php echo esc_attr($this->get_id()); ?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog elementskit-modal-dialog" role="document">
                <div class="elementskit-modal-content">
                    <div class="elementskit-modal-header <?php echo esc_attr($ekit_team_close_icon_alignment); ?>">
                        <button type="button" class="close <?php echo esc_attr($ekit_team_close_icon_alignment); ?>" data-dismiss="modal" aria-label="Close">
                            <?php if($ekit_team_close_icon_changes != '') :  ?>

                            <?php
                                // new icon
                                $migrated = isset( $settings['__fa4_migrated']['ekit_team_close_icon_changes'] );
                                // Check if its a new widget without previously selected icon using the old Icon control
                                $is_new = empty( $settings['ekit_team_close_icon_change'] );
                                
                                if($is_new || $migrated){
                                    echo '<span aria-hidden="true" class="mfp-close '. esc_attr($settings['ekit_team_close_icon_changes']['value']) .'"></span>';
                                } else {
                                    echo '<span aria-hidden="true" class="mfp-close '. esc_attr($settings['ekit_team_close_icon_change']) .'"></span>';
                                }
                            ?>
                               
                            <?php else:  ?>
                                <span aria-hidden="true">&times;</span>
                            <?php endif; ?>
                        </button>
                    </div>
                    <div class="elementskitmodal-body">
                        <div class="modal_image_wraper">
                            <div class="modal-img">
                            <?php echo \ElementsKit\Utils::kses($image_html); ?>
                            </div>
                        </div>
                        <div class="modal_content_wraper">
                            <div class="xs-modal-content">
                                <div class="xs-modal-header">
                                    <h2 class="person-title"><?php echo esc_html( $ekit_team_name ); ?></h2>
                                    <span class="perosn-designation"><?php echo esc_html( $ekit_team_position ); ?></span>
                                </div><!-- .xs-modal-header END -->
                                <div class="xs-modal-body">
                                    <?php echo \ElementsKit\Utils::kses($ekit_team_description); ?>
                                </div><!-- .xs-modal-body END -->
                                <div class="xs-modal-footer">
                                    <?php if ( $ekit_team_phone || $ekit_team_email ): ?>
                                        <ul class="border-lists">
                                            <?php if ( $ekit_team_phone ): ?>
                                                <li><strong><?php esc_html_e( 'Phone', 'elementskit' ); ?>:</strong><a href="tel:<?php echo esc_attr( $ekit_team_phone ); ?>"><?php echo esc_html( $ekit_team_phone ); ?></a></li>
                                            <?php endif; ?>

                                            <?php if ( $ekit_team_email ): ?>
                                                <li><strong><?php esc_html_e( 'Email', 'elementskit' ); ?>:</strong><a href="mailto:<?php echo esc_attr( $ekit_team_email ); ?>"><?php echo esc_html( $ekit_team_email ); ?></a></li>
                                            <?php endif; ?>
                                        </ul>
                                    <?php endif; ?>
                                    <?php if(isset($ekit_team_socail_enable) AND $ekit_team_socail_enable == 'yes'){?>
                                    <ul class="ekit-team-social-list ">
                                        <?php foreach ($ekit_team_social_icons as $icon): ?>
                                            <li class="elementor-repeater-item-<?php echo esc_attr( $icon[ '_id' ] ); ?>"><a
                                                <?php if ( 'on' == $icon['ekit_team_link']['is_external'] ): ?>
                                                    target="_blank"
                                                <?php endif; ?>
                                                <?php if ( 'on' == $icon['ekit_team_link']['nofollow'] ): ?>
                                                    rel="nofollow"
                                                <?php endif; ?>

                                                href="<?php echo esc_url( $icon['ekit_team_link']['url'] ); ?>" class="social-icons elementor-social-icon-facebook">
                                                <?php
                                                    if ( $is_new || $migrated ) {
                                                        // new icon
                                                        Icons_Manager::render_icon( $icon['ekit_team_icons'], [ 'aria-hidden' => 'true' ] );
                                                    } else {
                                                        ?>
                                                        <i class="<?php echo esc_attr($icon['ekit_team_icon']); ?>" aria-hidden="true"></i>
                                                        <?php
                                                    }
                                                ?> 
                                                </a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <?php
                                    }
                                    ?>
                                </div><!-- .xs-modal-footer END -->
                            </div><!-- .xs-modal-content END -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>

        <?php
    }

    protected function _content_template() { }
}
