<?php

namespace PremiumAddons\Widgets;

use PremiumAddons\Helper_Functions;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use PremiumAddons\Includes;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Premium_Image_Separator extends Widget_Base {
    protected $templateInstance;

    public function getTemplateInstance() {
        return $this->templateInstance = Includes\premium_Template_Tags::getInstance();
    }

    public function get_name() {
        return 'premium-addon-image-separator';
    }

    public function get_title() {
		return sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __('Image Separator', 'premium-addons-for-elementor') );
	}

    public function get_style_depends() {
        return [
            'premium-addons'
        ];
    }
    
    public function get_icon() {
        return 'pa-image-separator';
    }

    public function get_categories() {
        return [ 'premium-elements' ];
    }
    
    public function get_custom_help_url() {
		return 'https://premiumaddons.com/support/';
	}

    // Adding the controls fields for the premium image separator
    // This will controls the animation, colors and background, dimensions etc
    protected function _register_controls() {

        /* Start Content Section */
        $this->start_controls_section('premium_image_separator_general_settings',
                [
                    'label'         => __('Image Settings', 'premium-addons-for-elementor')
                    ]
                );
        
        $this->add_control('separator_type',
            [
                'label'			=> __( 'Separator Type', 'premium-addons-for-elementor' ),
                'type' 			=> Controls_Manager::SELECT,
                'options'		=> [
                    'image' => __( 'Image', 'premium-addons-for-elementor'),
                    'icon'  => __('Icon', 'premium-addons-for-elementor')
                ],
                'default'		=> 'image'
            ]
        );                

        $this->add_control('premium_image_separator_image',
            [
                'label'         => __('Image', 'premium-addons-for-elementor'),
                'description'   => __('Choose the separator image', 'premium-addons-for-elementor' ),
                'type'          => Controls_Manager::MEDIA,
                'dynamic'       => [ 'active' => true ],
                'default'       => [
                    'url'	=> Utils::get_placeholder_image_src(),
                ],
                'label_block'   => true,
                'condition'     => [
                    'separator_type'    => 'image'
                ]
            ]
        );

        $this->add_control('separator_icon',
		  	[
		     	'label'			=> __( 'Select an Icon', 'premium-addons-for-elementor' ),
		     	'type'              => Controls_Manager::ICONS,
                'default' => [
                    'value'     => 'fas fa-grip-lines',
                    'library'   => 'fa-solid',
                ],
			  	'condition'		=> [
			  		'separator_type' => 'icon'
			  	]
		  	]
		);

        $this->add_responsive_control('premium_image_separator_image_size',
            [
                'label'         => __('Size', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em', '%'],
                'default'       => [
                    'unit'  => 'px',
                    'size'  => 200,
                ],
                'range'         => [
                    'px'    => [
                        'min'   => 1, 
                        'max'   => 800, 
                    ],
                    'em'    => [
                        'min'   => 1, 
                        'max'   => 30,
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-image-separator-container img'    => 'width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .premium-image-separator-container i'      => 'font-size: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .premium-image-separator-container svg'    => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}'
                ]
            ]
        );
        
        $this->add_responsive_control('premium_image_separator_image_gutter',
            [
                'label'         => __('Gutter (%)', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::NUMBER,
                'default'       => -50,
                'description'   => __('-50% is default. Increase to push the image outside or decrease to pull the image inside.','premium-addons-for-elementor'),
                'selectors'     => [
                    '{{WRAPPER}} .premium-image-separator-container' => 'transform: translateY( {{VALUE}}% );'
                ]
            ]
        );
        
        $this->add_control('premium_image_separator_image_align', 
            [
                'label'         => __('Alignment', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
                    'left'  => [
                        'title'     => __('Left', 'premium-addons-for-elementor'),
                        'icon'      => 'fa fa-align-left'
                    ],
                    'center'  => [
                        'title'     => __('Center', 'premium-addons-for-elementor'),
                        'icon'      => 'fa fa-align-center'
                    ],
                    'right'  => [
                        'title'     => __('Right', 'premium-addons-for-elementor'),
                        'icon'      => 'fa fa-align-right'
                    ],
                ],
                'default'       => 'center',
                'selectors'     => [
                    '{{WRAPPER}} .premium-image-separator-container'   => 'text-align: {{VALUE}};',
                ]
            ]
            );
        
        
        /*Add Link Switcher*/
        $this->add_control('premium_image_separator_link_switcher', 
                [
                    'label'         => __('Link', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::SWITCHER,
                    'description'   => __('Add a custom link or select an existing page link','premium-addons-for-elementor'),
                ]
                );
        
        $this->add_control('premium_image_separator_link_type', 
                [
                    'label'         => __('Link/URL', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::SELECT,
                    'options'       => [
                        'url'   => __('URL', 'premium-addons-for-elementor'),
                        'link'  => __('Existing Page', 'premium-addons-for-elementor'),
                    ],
                    'default'       => 'url',
                    'condition'     => [
                       'premium_image_separator_link_switcher'  => 'yes',
                    ],
                    'label_block'   => true,
                ]
                );
        
        $this->add_control('premium_image_separator_existing_page', 
                [
                    'label'         => __('Existing Page', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::SELECT2,
                    'options'       => $this->getTemplateInstance()->get_all_post(),
                    'condition'     => [
                       'premium_image_separator_link_switcher'  => 'yes',
                        'premium_image_separator_link_type'     => 'link',
                    ],
                    'multiple'      => false,
                    'label_block'   => true,
                ]
                );
        
        $this->add_control('premium_image_separator_image_link',
                [
                    'label'         => __('URL', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::TEXT,
                    'dynamic'       => [
                        'active'        => true,
                        'categories'    => [
                            TagsModule::POST_META_CATEGORY,
                            TagsModule::URL_CATEGORY
                        ]
                    ],
                    'condition'     => [
                        'premium_image_separator_link_switcher' => 'yes',
                        'premium_image_separator_link_type'     => 'url',
                    ],
                    'label_block'   => true
                ]
                );
        
        $this->add_control('premium_image_separator_image_link_text',
                [
                    'label'         => __('Image Hovering Title', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::TEXT,
                    'condition'     => [
                        'premium_image_separator_link_switcher' => 'yes',
                    ],
                    'label_block'   => true
                ]
                );
        
        /*Link Target*/ 
        $this->add_control('premium_image_separator_link_target',
                [
                    'label'         => __('Link Target', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::SELECT,
                    'description'   => __( ' Where would you like the link be opened?', 'premium-addons-for-elementor' ),
                    'options'       => [
                        'blank'  => ('Blank'),
                        'parent' => ('Parent'),
                        'self'   => ('Self'),
                        'top'    => ('Top'),
                        ],
                    'default'       => __('blank','premium-addons-for-elementor'),
                    'condition'     => [
                       'premium_image_separator_link_switcher'  => 'yes',
                    ],
                    'label_block'   => true,
                    ]
                );
       
        /*End Price Settings Section*/
        $this->end_controls_section();
        
        /*Start Style Section*/
        $this->start_controls_section('premium_image_separator_style',
            [
                'label'         => __('Separator', 'premium-addons-for-elementor'),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
                'selector' => '{{WRAPPER}} .premium-image-separator-container img',
                'condition'     => [
                    'separator_type'    => 'image'
                ]
			]
        );
        
        $this->add_control('icon_color',
		  	[
				'label'         => __( 'Color', 'premium-addons-for-elementor' ),
                'type' 			=> Controls_Manager::COLOR,
                'scheme' 		=> [
				    'type' 	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'selectors'     => [
					'{{WRAPPER}} .premium-image-separator-container i' => 'color: {{VALUE}}'
				],
			  	'condition'     => [
			  		'separator_type' => 'icon'
			  	]
			]
        );

        $this->add_control('icon_hover_color',
            [
                'label'         => __( 'Hover Color', 'premium-addons-for-elementor' ),
                'type' 			=> Controls_Manager::COLOR,
                'scheme' 		=> [
                    'type' 	=> Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-image-separator-container i:hover' => 'color: {{VALUE}}'
                ],
                'condition'     => [
                    'separator_type' => 'icon'
                ]
            ]
        );
        
        $this->add_control('icon_background_color',
		  	[
				'label'         => __( 'Background Color', 'premium-addons-for-elementor' ),
                'type' 			=> Controls_Manager::COLOR,
                'scheme' 		=> [
				    'type' 	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_2,
				],
				'selectors'     => [
					'{{WRAPPER}} .premium-image-separator-container i' => 'background-color: {{VALUE}}'
				],
			  	'condition'     => [
			  		'separator_type' => 'icon'
			  	]
			]
        );
 
        $this->add_control('icon_hover_background_color',
		  	[
				'label'         => __( 'Hover Background Color', 'premium-addons-for-elementor' ),
                'type' 			=> Controls_Manager::COLOR,
                'scheme' 		=> [
				    'type' 	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_2,
				],
				'selectors'     => [
					'{{WRAPPER}} .premium-image-separator-container i:hover' => 'background-color: {{VALUE}}'
				],
			  	'condition'     => [
			  		'separator_type' => 'icon'
			  	]
			]
        );

        $this->add_responsive_control('separator_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-image-separator-container i, {{WRAPPER}} .premium-image-separator-container img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'          => 'separator_shadow',
                'selector'      => '{{WRAPPER}} .premium-image-separator-container i',
                'condition'     => [
                    'separator_type' => 'icon'
                ]
            ]
        );
        
        $this->add_responsive_control('icon_padding',
            [
                'label'         => __('Padding', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-image-separator-container i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
                ],
                'condition'     => [
                    'separator_type' => 'icon'
                ]
            ]
        );
        
        $this->end_controls_section();
       
    }

    protected function render() {
        // get our input from the widget settings.
        $settings = $this->get_settings_for_display();
        
        $link_type = $settings['premium_image_separator_link_type'];
        
        $link_url = ( 'url' == $link_type ) ? $settings['premium_image_separator_image_link'] : get_permalink( $settings['premium_image_separator_existing_page'] );
        
        if( 'image' === $settings['separator_type'] )
            $alt = esc_attr( Control_Media::get_image_alt( $settings['premium_image_separator_image'] ) );
    ?>

    <div class="premium-image-separator-container">
        <?php if( 'image' === $settings['separator_type'] ) : ?>
            <img class="img-responsive" src="<?php echo $settings['premium_image_separator_image']['url']; ?>" alt="<?php echo $alt; ?>">
        <?php else:
            Icons_Manager::render_icon( $settings['separator_icon'], [ 'aria-hidden' => 'true' ] );
        endif;
        if (  $settings['premium_image_separator_link_switcher'] == 'yes' ) : ?>
            <a class="premium-image-separator-link" href="<?php echo $link_url; ?>" target="_<?php echo $settings['premium_image_separator_link_target']; ?>" title="<?php echo $settings['premium_image_separator_image_link_text']; ?>">
            </a>
        <?php endif; ?>
    </div>
    <?php
    }
    
    protected function _content_template() {
        ?>
        <#
            var linkType = settings.premium_image_separator_link_type,
            
                linkSwitch = settings.premium_image_separator_link_switcher,
                
                linkTarget = settings.premium_image_separator_link_target,
                
                linkTitle = settings.premium_image_separator_image_link_text,
            
                linkUrl = ( 'url' == linkType ) ? settings.premium_image_separator_image_link : settings.premium_image_separator_existing_page;

            if( 'image' === settings.separator_type ) {
                var imgUrl = settings.premium_image_separator_image.url;
            } else {
                var iconHTML = elementor.helpers.renderIcon( view, settings.separator_icon, { 'aria-hidden': true }, 'i' , 'object' );    
            }

        #>

        <div class="premium-image-separator-container">
            <# if( 'image' === settings.separator_type ) { #>
                <img alt="image separator" class="img-responsive" src="{{ imgUrl }}">
            <# } else { #>
                {{{ iconHTML.value }}} 
            <# }
            if( 'yes' == linkSwitch ) { #>
                <a class="premium-image-separator-link" href="{{ linkUrl }}" target="_{{ linkTarget }}" title="{{ linkTitle }}"></a>
            <# } #>
        </div>
        
        <?php  
    }
}