<?php

namespace PremiumAddons\Widgets;

use PremiumAddons\Helper_Functions;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Embed;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Premium_Videobox extends Widget_Base {
    
    public function get_name() {
        return 'premium-addon-video-box';
    }

    public function get_title() {
		return sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __('Video Box', 'premium-addons-for-elementor') );
	}

    public function get_icon() {
        return 'pa-video-box';
    }

    public function get_categories() {
        return [ 'premium-elements' ];
    }
    
    public function get_style_depends() {
        return [
            'premium-addons'
        ];
    }
    
    public function get_script_depends() {
        return [
            'premium-addons-js'
        ];
    }
    
    public function get_keywords() {
        return ['youtube', 'vimeo', 'self', 'hosted', 'media'];
    }
    
    public function get_custom_help_url() {
		return 'https://premiumaddons.com/support/';
	}

    // Adding the controls fields for Premium Video Box
    // This will controls the animation, colors and background, dimensions etc
    protected function _register_controls() {

        $this->start_controls_section('premium_video_box_general_settings',
            [
                'label'         => __('Video Box', 'premium-addons-for-elementor'),
            ]
        );
        
        $this->add_control('premium_video_box_video_type',
            [
                'label'         => __('Video Type', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'youtube',
                'options'       => [
                    'youtube'       => __('Youtube', 'premium-addons-for-elementor'),
                    'vimeo'         => __('Vimeo', 'premium-addons-for-elementor'),
                    'self'          => __('Self Hosted', 'premium-addons-for-elementor'),
                ]
            ]
        );
        
        $this->add_control('premium_video_box_video_id_embed_selection',
            [
                'label'         => __('Link', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::HIDDEN,
                'default'       => 'id',
                'options'       => [
                    'id'    => __('ID', 'premium-addons-for-elementor'),
                    'embed' => __('Embed URL', 'premium-addons-for-elementor'),
                ],
                'condition'     => [
                    'premium_video_box_video_type!' => 'self',
                ]
            ]
        );
        
        $this->add_control('premium_video_box_video_id', 
            [
                'label'         => __('Video ID', 'premium-addons-for-elementor'),
                'description'   => __('Enter the numbers and letters after the equal sign which located in your YouTube video link or after the slash sign in your Vimeo video link. For example, z1hQgVpfTKU', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::HIDDEN,
                'condition'     => [
                    'premium_video_box_video_type!' => 'self',
                    'premium_video_box_video_id_embed_selection' => 'id',
                ]
            ]
        );
        
        $this->add_control('premium_video_box_video_embed', 
            [
                'label'         => __('Embed URL', 'premium-addons-for-elementor'),
                'description'   => __('Enter your YouTube/Vimeo video link. For example, https://www.youtube.com/embed/z1hQgVpfTKU', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::HIDDEN,
                'condition'     => [
                    'premium_video_box_video_type!' => 'self',
                    'premium_video_box_video_id_embed_selection' => 'embed',
                ]
            ]
        );
        
        $this->add_control('premium_video_box_link', 
            [
                'label'         => __('Link', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => 'https://www.youtube.com/watch?v=07d2dXHYb94',
                'dynamic'       => [
                    'active' => true,
                    'categories' => [
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::URL_CATEGORY
                    ]
                ],
                'condition'     => [
                    'premium_video_box_video_type!' => 'self',
                ]
            ]
        );
        
        $this->add_control('premium_video_box_self_hosted',
            [
                'label'         => __('URL', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::MEDIA,
                'dynamic'       => [
                    'active' => true,
                    'categories' => [
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::URL_CATEGORY,
                    ],
                ],
                'media_type' => 'video',
                'condition'     => [
                    'premium_video_box_video_type' => 'self',
                ]
            ]
        );
      
        $this->add_control('premium_video_box_self_hosted_remote',
            [
                'label'         => __('Remote Video URL', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [
                    'active' => true,
                ],
                'label_block'   => true,
                'condition'     => [
                    'premium_video_box_video_type' => 'self',
                ]
            ]
        );
        
        $this->add_control('premium_video_box_controls',
            [
                'label'         => __('Player Controls', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Show/hide player controls', 'premium-addons-for-elementor'),
                'default'       => 'yes'
            ]
        );
        
        $this->add_control('premium_video_box_mute',
            [
                'label'         => __('Mute', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('This will play the video muted', 'premium-addons-for-elementor')
            ]
        );
        
        $this->add_control('premium_video_box_self_autoplay',
            [
                'label'         => __('Autoplay', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::SWITCHER,
            ]
        );
        
        $this->add_control('autoplay_notice',
			[
				'raw'           => __( 'Please note that autoplay option works only when Overlay option is disabled', 'premium-addons-for-elementor' ),
                'type'          => Controls_Manager::RAW_HTML,
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                'condition'     => [
                    'premium_video_box_self_autoplay'   => 'yes'
                ]    
			]
		);
        
        $this->add_control('premium_video_box_loop',
            [
                'label'         => __('Loop', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::SWITCHER,
            ]
        );
        
        $this->add_control('premium_video_box_start',
            [
                'label'     => __( 'Start Time', 'premium-addons-for-elementor' ),
                'type'      => Controls_Manager::NUMBER,
                'separator' => 'before',
                'description'=> __( 'Specify a start time (in seconds)', 'premium-addons-for-elementor' ),
                'condition'  => [
                    'premium_video_box_video_type!' => 'vimeo'
                ]
            ]
        );

        $this->add_control('premium_video_box_end',
            [
                'label'         => __( 'End Time', 'premium-addons-for-elementor' ),
                'type'          => Controls_Manager::NUMBER,
                'description'   => __( 'Specify an end time (in seconds)', 'premium-addons-for-elementor' ),
                'separator'     => 'after',
                'condition'     => [
                    'premium_video_box_video_type!' => 'vimeo'
                ]
            ]
        );
        
        $this->add_control('premium_video_box_suggested_videos',
            [
                'label'         => __('Suggested Videos From', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    ''      => __('Current Channel', 'premium-addons-for-elementor'),
                    'yes'   => __('Any Channel', 'premium-addons-for-elementor')
                ],
                'condition'     => [
                    'premium_video_box_video_type' => 'youtube',
                ]
            ]
        );
        
        $this->add_control('vimeo_controls_color',
            [
                'label'     => __( 'Controls Color', 'premium-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .premium-video-box-vimeo-title a, {{WRAPPER}} .premium-video-box-vimeo-byline a, {{WRAPPER}} .premium-video-box-vimeo-title a:hover, {{WRAPPER}} .premium-video-box-vimeo-byline a:hover, {{WRAPPER}} .premium-video-box-vimeo-title a:focus, {{WRAPPER}} .premium-video-box-vimeo-byline a:focus' => 'color: {{VALUE}}',
                ),
                'render_type'=> 'template',
                'condition' => [
                    'premium_video_box_video_type' => 'vimeo',
                ],
            ]
        );
        
        $this->add_control('vimeo_title',
			[
				'label' => __( 'Intro Title', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'elementor' ),
				'label_off' => __( 'Hide', 'elementor' ),
				'default' => 'yes',
				'condition' => [
					'premium_video_box_video_type' => 'vimeo',
				],
			]
		);

		$this->add_control('vimeo_portrait',
			[
				'label' => __( 'Intro Portrait', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'elementor' ),
				'label_off' => __( 'Hide', 'elementor' ),
				'default' => 'yes',
				'condition' => [
					'premium_video_box_video_type' => 'vimeo',
				],
			]
		);

		$this->add_control('vimeo_byline',
			[
				'label' => __( 'Intro Byline', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'elementor' ),
				'label_off' => __( 'Hide', 'elementor' ),
				'default' => 'yes',
				'condition' => [
					'premium_video_box_video_type' => 'vimeo',
				],
			]
		);

        $this->add_control('aspect_ratio',
            [
                'label'         => __( 'Aspect Ratio', 'premium-addons-for-elementor' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    '11'    => '1:1',
                    '169'   => '16:9',
                    '43'    => '4:3',
                    '32'    => '3:2',
                    '219'   => '21:9',
                ],
                'default'       => '169',
                'prefix_class'  => 'pa-aspect-ratio-',
                'frontend_available' => true,
            ]
        );
        
        $this->add_control('premium_video_box_image_switcher',
            [
                'label'         => __('Overlay', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes'
            ]
        );
        
        $this->add_control('premium_video_box_yt_thumbnail_size',
            [
                'label'     => __( 'Thumbnail Size', 'premium-addons-for-elementor' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'maxresdefault' => __( 'Maximum Resolution', 'premium-addons-for-elementor' ),
                    'hqdefault'     => __( 'High Quality', 'premium-addons-for-elementor' ),
                    'mqdefault'     => __( 'Medium Quality', 'premium-addons-for-elementor' ),
                    'sddefault'     => __( 'Standard Quality', 'premium-addons-for-elementor' ),
                ],
                'default'   => 'maxresdefault',
                'condition' => [
                    'premium_video_box_video_type'      => 'youtube',
                    'premium_video_box_image_switcher!' => 'yes'
                ],
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_video_box_image_settings', 
            [
                'label'         => __('Overlay', 'premium-addons-for-elementor'),
                'condition'     => [
                    'premium_video_box_image_switcher'  => 'yes'
                ]
            ]
        );
        
        $this->add_control('premium_video_box_image',
            [
                'label'         => __('Image', 'premium-addons-for-elementor'),
                'description'   => __('Choose an image for the video box', 'premium-addons-for-elementor' ),
                'type'          => Controls_Manager::MEDIA,
                'dynamic'       => [ 'active' => true ],
                'default'       => [
                    'url'	=> Utils::get_placeholder_image_src()
                ],
                'label_block'   => true,
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_video_box_play_icon_settings', 
            [
                'label'         => __('Play Icon', 'premium-addons-for-elementor')
            ]
        );
        
        $this->add_control('premium_video_box_play_icon_switcher',
            [
                'label'         => __('Play Icon', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes'
            ]
        );
        
        $this->add_control('premium_video_box_icon_hor_position', 
            [
                'label'         => __('Horizontal Position (%)', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::SLIDER,
                'label_block'   => true,
                'default'       => [
                    'size' => 50,
                ],
                'condition'     => [
                    'premium_video_box_play_icon_switcher'  => 'yes',
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-video-box-play-icon-container' => 'left: {{SIZE}}%;',
                ]
            ]
        );
        
        $this->add_control('premium_video_box_icon_ver_position', 
            [
                'label'         => __('Vertical Position (%)', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::SLIDER,
                'label_block'   => true,
                'default'       => [
                    'size' => 50,
                ],
                'condition'     => [
                    'premium_video_box_play_icon_switcher'  => 'yes',
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-video-box-play-icon-container' => 'top: {{SIZE}}%;',
                ]
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_video_box_description_text_section', 
            [
                'label'         => __('Description', 'premium-addons-for-elementor'),
            ]
        );
        
        $this->add_control('premium_video_box_video_text_switcher',
            [
                'label'         => __('Video Text', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::SWITCHER,
            ]
        );
        
        $this->add_control('premium_video_box_description_text', 
            [
                'label'         => __('Text', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::TEXTAREA,
                'dynamic'       => [ 'active' => true ],
                'default'       => __('Play Video','premium-addons-for-elementor'),
                'condition'     => [
                    'premium_video_box_video_text_switcher' => 'yes'
                ],
                'dynamic'       => [ 'active' => true ],
                'label_block'   => true,
            ]
        );
        
        $this->add_control('premium_video_box_description_ver_position', 
            [
                'label'         => __('Vertical Position (%)', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::SLIDER,
                'label_block'   => true,
                'default'       => [
                    'size' => 60,
                ],
                'condition'     => [
                    'premium_video_box_video_text_switcher' => 'yes'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-video-box-description-container' => 'top: {{SIZE}}%;',
                ]
            ]
        );
        
         $this->add_control('premium_video_box_description_hor_position', 
            [
                'label'         => __('Horizontal Position (%)', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::SLIDER,
                'label_block'   => true,
                'default'       => [
                    'size' => 50,
                    ],
                'condition'     => [
                    'premium_video_box_video_text_switcher' => 'yes'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-video-box-description-container' => 'left: {{SIZE}}%;',
                ]
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_video_box_text_style_section', 
            [
                'label'         => __('Video Box','premium-addons-for-elementor'),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'image_border',        
                'selector'      => '{{WRAPPER}} .premium-video-box-image-container, {{WRAPPER}} .premium-video-box-video-container',
            ]
        );
        
        //Border Radius Properties sepearated for responsive issues
        $this->add_responsive_control('premium_video_box_image_border_radius', 
            [
                'label'         => __('Border Radius', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%', 'em'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-video-box-image-container, {{WRAPPER}} .premium-video-box-video-container'  => 'border-top-left-radius: {{SIZE}}{{UNIT}}; border-top-right-radius: {{SIZE}}{{UNIT}}; border-bottom-left-radius: {{SIZE}}{{UNIT}}; border-bottom-right-radius: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'label'         => __('Shadow','premium-addons-for-elementor'),
                'name'          => 'box_shadow',
                'selector'      => '{{WRAPPER}} .premium-video-box-image-container',
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_video_box_icon_style', 
            [
                'label'         => __('Play Icon','premium-addons-for-elementor'),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'premium_video_box_play_icon_switcher'  => 'yes',
                ],
            ]
        );
        
        $this->add_control('premium_video_box_play_icon_color', 
            [
                'label'         => __('Color', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-video-box-play-icon'  => 'color: {{VALUE}};',
                ]
            ]
        );
        
        $this->add_control('premium_video_box_play_icon_color_hover', 
            [
                'label'         => __('Hover Color', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-video-box-play-icon-container:hover .premium-video-box-play-icon'  => 'color: {{VALUE}};',
                ]
            ]
        );
        
        $this->add_control('premium_video_box_play_icon_size',
            [
                'label'         => __('Size', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'unit'  => 'px',
                    'size'  => 30,
                ],
                'size_units'    => ['px', '%', 'em'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-video-box-play-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'          => 'premium_video_box_play_icon_background_color',
                'types'         => ['classic', 'gradient'],
                'selector'      => '{{WRAPPER}} .premium-video-box-play-icon-container',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'icon_border',   
                'selector'      => '{{WRAPPER}} .premium-video-box-play-icon-container',
            ]
        );
    
        $this->add_control('premium_video_box_icon_border_radius', 
            [
                'label'         => __('Border Radius', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'unit'  => 'px',
                    'size'  => 100,
                ],
                'size_units'    => ['px', '%', 'em'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-video-box-play-icon-container'  => 'border-radius: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        
        $this->add_responsive_control('premium_video_box_icon_padding',
            [
                'label'         => __('Padding', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::DIMENSIONS,
                'default'       => [
                    'top'   => 40,
                    'right' => 40,
                    'bottom'=> 40,
                    'left'  => 40,
                    'unit'  => 'px'
                ],
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-video-box-play-icon ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ]
            ]
        );
        
        $this->add_responsive_control('premium_video_box_icon_padding_hover',
            [
                'label'         => __('Hover Padding', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-video-box-play-icon:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        
        $this->end_controls_section();
       
        $this->start_controls_section('premium_video_box_text_style', 
            [
                'label'         => __('Video Text', 'premium-addons-for-elementor'),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'premium_video_box_video_text_switcher' => 'yes'
                ]
            ]
        );
        
        $this->add_control('premium_video_box_text_color',
            [
                'label'         => __('Text Color', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-video-box-text'   => 'color: {{VALUE}};',
                ]
            ]
        );
        
        $this->add_control('premium_video_box_text_color_hover',
            [
                'label'         => __('Hover Color', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-video-box-description-container:hover .premium-video-box-text'   => 'color: {{VALUE}};',
                ]
            ]
        );
       
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'text_typography',
                'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .premium-video-box-text',
            ]
        );
        
        $this->add_control('premium_video_box_text_background_color',
            [
                'label'         => __('Background Color', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-video-box-description-container'   => 'background-color: {{VALUE}};',
                ]
            ]
        );
        
        $this->add_responsive_control('premium_video_box_text_padding',
            [
                'label'         => __('Padding', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-video-box-description-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ],
                ]
            );
        
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'label'         => __('Shadow','premium-addons-for-elementor'),
                'name'          => 'premium_text_shadow',
                'selector'      => '{{WRAPPER}} .premium-video-box-text'
            ]
        );
        
        $this->end_controls_section();
    }

    protected function render() {
        
        $settings   = $this->get_settings_for_display();
        
        $id         = $this->get_id();
        
        $video_type = $settings['premium_video_box_video_type'];
        
        $params     = $this->get_video_params();
        
        $thumbnail  = $this->get_video_thumbnail( $params['id'] );
        
        $image      = sprintf( 'url(\'%s\')', $thumbnail );
        
        if( 'self' === $video_type ) {
            
            $overlay        = $settings['premium_video_box_image_switcher'];
            
            if( 'yes' !== $overlay )
                $image      = 'transparent';
            
            if ( empty( $settings['premium_video_box_self_hosted_remote'] ) ) {
                $hosted_url = $settings['premium_video_box_self_hosted']['url'];
            } else {
                $hosted_url = $settings['premium_video_box_self_hosted_remote'];
            }
        }
        
        $link       = $params['link'];
        
        $related = $settings['premium_video_box_suggested_videos'];
        
        $autoplay = $settings['premium_video_box_self_autoplay'];
        
        $mute = $settings['premium_video_box_mute'];
        
        $loop = $settings['premium_video_box_loop'];
        
        $controls = $settings['premium_video_box_controls'];
        
        $options = 'youtube' === $video_type ? '&rel=' : '?rel';
        $options .= 'yes' === $related ? '1' : '0';
        $options .= 'youtube' === $video_type ? '&mute=' : '&muted=';
        $options .= 'yes' === $mute ? '1' : '0';
        $options .= '&loop=';
        $options .= 'yes' === $loop ? '1' : '0';
        $options .= '&controls=';
        $options .= 'yes' === $controls ? '1' : '0';
        
        if( 'self' !== $video_type ) {
            if ( 'yes' === $autoplay && ! $this->has_image_overlay() ) {
                $options .= '&autoplay=1';
            }
        }
        
        if( 'vimeo' === $video_type ) {
            $options .= '&color=' . str_replace('#', '', $settings['vimeo_controls_color'] );
            
            if( 'yes' === $settings['vimeo_title'] ) {
                $options .= '&title=1';
            }
            
            if( 'yes' === $settings['vimeo_portrait'] ) {
                $options .= '&portrait=1';
            }
            
            if( 'yes' === $settings['vimeo_byline'] ) {
                $options .= '&byline=1';
            }
            
        }
        
        if ( $settings['premium_video_box_start'] || $settings['premium_video_box_end'] ) {
            
            if ( 'youtube' === $video_type ) {
                
                if ( $settings['premium_video_box_start'] ) {
                    $options .= '&start=' . $settings['premium_video_box_start'];
                }
                
                if ( $settings['premium_video_box_end'] ) {
                    $options .= '&end=' . $settings['premium_video_box_end'];
                }
                
            } elseif ( 'self' === $video_type ) {
                
                $hosted_url .= '#t=';
                
                if ( $settings['premium_video_box_start'] ) {
                    $hosted_url .= $settings['premium_video_box_start'];
                }
                
                if ( $settings['premium_video_box_end'] ) {
                    $hosted_url .= ',' . $settings['premium_video_box_end'];
                }
                
            }
            
        }
        
        if ( $loop ) {
            $options .= '&playlist=' . $params['id'];
        }
        
        if( 'self' === $video_type ) {
            
            $video_params = '';
            
            if( $controls ) {
                $video_params .= 'controls ';
            }
            if( $mute ) {
                $video_params .= 'muted ';
            }
            if( $loop ) {
                $video_params .= 'loop ';
            }
            if( $autoplay ) {
                $video_params .= 'autoplay';
            }
            
        }
        
        $this->add_inline_editing_attributes( 'premium_video_box_description_text' );
        
        $this->add_render_attribute('container', [
                'id'    => 'premium-video-box-container-' . $id,
                'class' => 'premium-video-box-container',
                'data-overlay'  => 'yes' === $settings['premium_video_box_image_switcher'] ? 'true' : 'false',
                'data-type'     => $video_type
            ]
        );
        
        $this->add_render_attribute('video_container', [
                'class' => 'premium-video-box-video-container',
            ]
        );
        
        
        if ( 'self' !== $video_type ) {
            $this->add_render_attribute('video_container', [
                    'data-src'  => $link . $options
                ]
            );
        }
        
    ?>

    <div <?php echo $this->get_render_attribute_string('container'); ?>>
        <?php $this->get_vimeo_header( $params['id'] ); ?>
        <div <?php echo $this->get_render_attribute_string('video_container'); ?>>
            <?php if ( 'self' === $video_type ) : ?>
                <video src="<?php echo esc_url( $hosted_url ); ?>" <?php echo $video_params; ?>></video>
            <?php endif; ?>
        </div>
            <div class="premium-video-box-image-container" style="background-image: <?php echo $image; ?>;">
        </div>
        
        <?php if( 'yes' === $settings['premium_video_box_play_icon_switcher'] && 'yes' !== $autoplay ) : ?>
            <div class="premium-video-box-play-icon-container">
                <i class="premium-video-box-play-icon fa fa-play fa-lg"></i>
            </div>
        <?php endif; ?>
        <?php if( $settings['premium_video_box_video_text_switcher'] == 'yes' && !empty( $settings['premium_video_box_description_text'] ) ) : ?>
            <div class="premium-video-box-description-container">
                <p class="premium-video-box-text"><span <?php echo $this->get_render_attribute_string('premium_video_box_description_text'); ?>><?php echo $settings['premium_video_box_description_text']; ?></span></p>
            </div>
        <?php endif; ?>
    </div>

    <?php
    }
    
    private function get_video_thumbnail( $id = '' ) {
        
        $settings       = $this->get_settings_for_display();
        
        $type           = $settings['premium_video_box_video_type'];
        
        $overlay        = $settings['premium_video_box_image_switcher'];
        
        if ( 'yes' !== $overlay ) {
            $size           = '';
            if( 'youtube' === $type ) {
                $size = $settings['premium_video_box_yt_thumbnail_size'];
            }
            $thumbnail_src  = Helper_Functions::get_video_thumbnail( $id, $type, $size );
        } else {
            $thumbnail_src  = $settings['premium_video_box_image']['url'];
        }
        
        return $thumbnail_src;
        
    }
    
    private function get_video_params() {
        
        $settings   = $this->get_settings_for_display();
        
        $type       = $settings['premium_video_box_video_type'];
        
        $identifier = $settings['premium_video_box_video_id_embed_selection'];
        
        $id         = $settings['premium_video_box_video_id'];
        
        $embed      = $settings['premium_video_box_video_embed'];
        
        $link       = $settings['premium_video_box_link'];
        
        if ( ! empty( $link ) ) {
            if ( 'youtube' === $type ) {
                $video_props    = Embed::get_video_properties( $link );
                $link           = Embed::get_embed_url( $link );
                $video_id       = $video_props['video_id'];
            } elseif ( 'vimeo' === $type ) {
                $mask = '/^.*vimeo\.com\/(?:[a-z]*\/)*([‌​0-9]{6,11})[?]?.*/';
                $video_id = substr( $link, strpos( $link, '.com/' ) + 5 );
				preg_match( $mask, $link, $matches );
				if( $matches ) {
					$video_id = $matches[1];
				} else {
					$video_id = substr( $link, strpos( $link, '.com/' ) + 5 );
				}
                $link = sprintf( 'https://player.vimeo.com/video/%s', $video_id );
            }
            
            $id = $video_id;
        } elseif ( ! empty( $id ) || ! empty ( $embed ) ) {
            
            if( 'id' === $identifier ) {
                $link = 'youtube' === $type ? sprintf('https://www.youtube.com/embed/%s', $id ) : sprintf('https://player.vimeo.com/video/%s', $id );
            } else {
                $link = $embed;
            }
            
        }
        
        return [ 
            'link' => $link,
            'id'    => $id
        ];
        
    }
    
    private function get_vimeo_header( $id ) {
        
        $settings = $this->get_settings_for_display();
        
        if( 'vimeo' !== $settings['premium_video_box_video_type'] ) {
            return;
        }
        
        if ( 'yes' === $settings['vimeo_portrait'] || 'yes' === $settings['vimeo_title'] || 'yes' === $settings['vimeo_byline']
		) {
            $vimeo_data = Helper_Functions::get_vimeo_video_data( $id );
        ?>
		<div class="premium-video-box-vimeo-wrap">
			<?php if ( 'yes' === $settings['vimeo_portrait'] ) { ?>
			<div class="premium-video-box-vimeo-portrait">
				<a href="<?php echo $vimeo_data['url']; ?>" target="_blank"><img src="<?php echo $vimeo_data['portrait']; ?>" alt=""></a>
			</div>
			<?php } ?>
			<?php
			if ( 'yes' === $settings['vimeo_title'] || 'yes' === $settings['vimeo_byline'] ) { ?>
			<div class="premium-video-box-vimeo-headers">
				<?php if ( 'yes' === $settings['vimeo_title'] ) { ?>
				<div class="premium-video-box-vimeo-title">
					<a href="<?php echo $settings['premium_video_box_link']; ?>" target="_blank"><?php echo $vimeo_data['title']; ?></a>
				</div>
				<?php } ?>
				<?php if ( 'yes' === $settings['vimeo_byline'] ) { ?>
				<div class="premium-video-box-vimeo-byline">
					<?php _e( 'from ', 'premium-addons-for-elementor' ); ?> <a href="<?php echo $vimeo_data['url']; ?>" target="_blank"><?php echo $vimeo_data['user']; ?></a>
				</div>
				<?php } ?>
			</div>
			<?php } ?>
		</div>
		<?php } ?>
        <?php
    }
    
    private function has_image_overlay() {
        
        $settings = $this->get_settings_for_display();

		return ! empty( $settings['premium_video_box_image']['url'] ) && 'yes' === $settings['premium_video_box_image_switcher'];
        
    }
    
}