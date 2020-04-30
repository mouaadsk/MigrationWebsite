<?php

namespace PremiumAddons\Widgets;

use PremiumAddons\Helper_Functions;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Premium_Testimonials extends Widget_Base {
    
    public function get_name() {
        return 'premium-addon-testimonials';
    }

    public function get_title() {
		return sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __('Testimonial', 'premium-addons-for-elementor') );
	}

    public function get_icon() {
        return 'pa-testimonials';
    }
    
    public function get_style_depends() {
        return [
            'premium-addons'
        ];
    }

    public function get_categories() {
        return [ 'premium-elements' ];
    }

    public function get_custom_help_url() {
		return 'https://premiumaddons.com/support/';
	}
    
    // Adding the controls fields for the premium testimonial
    // This will controls the animation, colors and background, dimensions etc
    protected function _register_controls() {   
        /*Testimonials Content Section */
        $this->start_controls_section('premium_testimonial_person_settings',
                [
                    'label'             => __('Author', 'premium-addons-for-elementor'),
                    ]
                );
        
        /*Person Image*/
        $this->add_control('premium_testimonial_person_image',
                [
                    'label'             => __('Image','premium-addons-for-elementor'),
                    'type'              => Controls_Manager::MEDIA,
                    'dynamic'       => [ 'active' => true ],
                    'default'      => [
                        'url'   => Utils::get_placeholder_image_src()
                    ],
                    'description'       => __( 'Choose an image for the author', 'premium-addons-for-elementor' ),
                    'show_label'        => true,
                    ]
                );        

        /*Person Image Shape*/
        $this->add_control('premium_testimonial_person_image_shape',
                [
                    'label'             => __('Image Style', 'premium-addons-for-elementor'),
                    'type'              => Controls_Manager::SELECT,
                    'description'       => __( 'Choose image style', 'premium-addons-for-elementor' ),
                    'options'           => [
                        'square'  => __('Square','premium-addons-for-elementor'),
                        'circle'  => __('Circle','premium-addons-for-elementor'),
                        'rounded' => __('Rounded','premium-addons-for-elementor'),
                        ],
                    'default'           => 'circle',
                    ]
                );
        
        /*Person Name*/ 
        $this->add_control('premium_testimonial_person_name',
                [
                    'label'             => __('Name', 'premium-addons-for-elementor'),
                    'type'              => Controls_Manager::TEXT,
                    'dynamic'           => [ 'active' => true ],
                    'default'           => __('Person Name', 'premium-addons-for-elementor'),
                    'description'       => __( 'Enter author name', 'premium-addons-for-elementor' ),
                    'label_block'       => true
                    ]
                );
        
        /*Name Title Tag*/
        $this->add_control('premium_testimonial_person_name_size',
            [
                'label'             => __('HTML Tag', 'premium-addons-for-elementor'),
                'type'              => Controls_Manager::SELECT,
                'description'       => __( 'Select a heading tag for author name', 'premium-addons-for-elementor' ),
                'options'       => [
                    'h1'    => 'H1',
                    'h2'    => 'H2',
                    'h3'    => 'H3',
                    'h4'    => 'H4',
                    'h5'    => 'H5',
                    'h6'    => 'H6',
                    'div'   => 'div',
                    'span'  => 'span',
                    'p'     => 'p',
                ],
                'default'           => 'h3',
                'label_block'       => true,
                ]
            );
        
        /*End Person Content Section*/
        $this->end_controls_section();

        /*Start Company Content Section*/       
        $this->start_controls_section('premium_testimonial_company_settings',
                [
                    'label'             => __('Company', 'premium-addons-for-elementor')
                    ]
                );
        
        /*Company Name*/
        $this->add_control('premium_testimonial_company_name',
                [
                    'label'             => __('Name', 'premium-addons-for-elementor'),
                    'type'              => Controls_Manager::TEXT,
                    'dynamic'           => [ 'active' => true ],
                    'default'           => __('Company Name','premium-addons-for-elementor'),
                    'description'       => __( 'Enter company name', 'premium-addons-for-elementor' ),
                    'label_block'       => true,
                    ]
                );
        
        /*Company Name Tag*/
        $this->add_control('premium_testimonial_company_name_size',
            [
                'label'             => __('HTML Tag', 'premium-addons-for-elementor'),
                'type'              => Controls_Manager::SELECT,
                'description'       => __( 'Select a heading tag for company name', 'premium-addons-for-elementor' ),
                'options'           => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div'   => 'div',
                    'span'  => 'span',
                    'p'     => 'p',
                ],
                'default'           => 'h4',
                'label_block'       => true,
            ]
        );
        
        $this->add_control('premium_testimonial_company_link_switcher',
                [
                    'label'         => __('Link', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::SWITCHER,
                    'default'       => 'yes',
                ]
                );
        
        /*Company Link */
        $this->add_control('premium_testimonial_company_link',
                [
                    'label'             => __('Link', 'premium-addons-for-elementor'),
                    'type'              => Controls_Manager::TEXT,
                    'dynamic'           => [
                    'active'            => true,
                    'categories'        => [
                            TagsModule::POST_META_CATEGORY,
                            TagsModule::URL_CATEGORY
                        ]
                    ],
                    'description'       => __( 'Add company URL', 'premium-addons-for-elementor' ),
                    'label_block'       => true,
                    'condition'         => [
                        'premium_testimonial_company_link_switcher' => 'yes'
                        ]
                    ]
                );
        
        /*Link Target*/ 
        $this->add_control('premium_testimonial_link_target',
                [
                    'label'             => __('Link Target', 'premium-addons-for-elementor'),
                    'type'              => Controls_Manager::SELECT,
                    'description'       => __( 'Select link target', 'premium-addons-for-elementor' ),
                    'options'           => [
                        'blank'  => __('Blank'),
                        'parent' => __('Parent'),
                        'self'   => __('Self'),
                        'top'    => __('Top'),
                        ],
                    'default'           => __('blank','premium-addons-for-elementor'),
                    'condition'         => [
                        'premium_testimonial_company_link_switcher' => 'yes'
                        ]
                    ]
                );
        
        /*End Company Content Section*/
        $this->end_controls_section();

        /*Start Testimonial Content Section*/
        $this->start_controls_section('premium_testimonial_settings',
            [
                'label'                 => __('Content', 'premium-addons-for-elementor'),
            ]
        );

        /*Testimonial Content*/
        $this->add_control('premium_testimonial_content',
                [    
                    'label'             => __('Testimonial Content', 'premium-addons-for-elementor'),
                    'type'              => Controls_Manager::WYSIWYG,
                    'dynamic'           => [ 'active' => true ],
                    'default'           => __('Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Cras mattis consectetur purus sit amet fermentum. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec id elit non mi porta gravida at eget metus.','premium-addons-for-elementor'),
                    'label_block'       => true,
                    ]
                );
        
        /*End Testimonial Content Section*/
        $this->end_controls_section();
        
        /*Image Styling*/
        $this->start_controls_section('premium_testimonial_image_style',
            [
                'label'             => __('Image', 'premium-addons-for-elementor'),
                'tab'               => Controls_Manager::TAB_STYLE, 
                ]
            );
        
        /*Image Size*/
        $this->add_control('premium_testimonial_img_size',
                [
                    'label'             => __('Size', 'premium-addons-for-elementor'),
                    'type'              => Controls_Manager::SLIDER,
                    'size_units'        => ['px', 'em'],
                    'default'           => [
                        'unit'  =>  'px',
                        'size'  =>  110,
                        ],
                    'range'             => [
                        'px'=> [
                            'min' => 10,
                            'max' => 150,
                        ]
                        ],
                    'selectors'         => [
                        '{{WRAPPER}} .premium-testimonial-img-wrapper'=> 'width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
                        ]
                    ]
                );

        /*Image Border Width*/
        $this->add_control('premium_testimonial_img_border_width',
                [
                    'label'             => __('Border Width (PX)', 'premium-addons-for-elementor'),
                    'type'              => Controls_Manager::SLIDER,
                    'default'           => [
                        'unit'  => 'px',
                        'size'  =>  2,
                        ],
                    'range'             => [
                        'px'=> [
                            'min' => 0,
                            'max' => 15,
                            ]
                        ],
                    'selectors'         => [
                        '{{WRAPPER}} .premium-testimonial-person-image' => 'border-width: {{SIZE}}{{UNIT}};',
                        ]
                    ]
                );
        
        /*Image Border Color*/
        $this->add_control('premium_testimonial_image_border_color',
             [
                'label'                 => __('Color', 'premium-addons-for-elementor'),
                'type'                  => Controls_Manager::COLOR,
                'scheme'            => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                 'selectors'            => [
                    '{{WRAPPER}} .premium-testimonial-img-wrapper' => 'color: {{VALUE}};',
                ]
            ]
        );
        
        $this->end_controls_section();
        
        /*Start Person Settings Section*/
        $this->start_controls_section('premium_testimonials_person_style', 
            [
                'label'                 => __('Author', 'premium-addons-for-elementor'),
                'tab'                   => Controls_Manager::TAB_STYLE, 
            ]
            );
        
        /*Person Name Color*/
        $this->add_control('premium_testimonial_person_name_color',
                [
                    'label'             => __('Color', 'premium-addons-for-elementor'),
                    'type'              => Controls_Manager::COLOR,
                    'scheme'            => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors'         => [
                        '{{WRAPPER}} .premium-testimonial-person-name' => 'color: {{VALUE}};',
                        ]
                    ]
                );
        
        /*Authohr Name Typography*/
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'          => 'author_name_typography',
                    'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                    'selector'      => '{{WRAPPER}} .premium-testimonial-person-name',
                ]
                );
        
        /*Separator Color*/
        $this->add_control('premium_testimonial_separator_color',
                [
                    'label'             => __('Divider Color', 'premium-addons-for-elementor'),
                    'type'              => Controls_Manager::COLOR,
                    'scheme'            => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors'         => [
                        '{{WRAPPER}} .premium-testimonial-separator' => 'color: {{VALUE}};',
                        ]
                    ]
                );
        
        $this->end_controls_section();
        
        /*Start Company Settings Section*/
        $this->start_controls_section('premium_testimonial_company_style',
                [
                    'label'             => __('Company', 'premium-addons-for-elementor'),
                    'tab'               => Controls_Manager::TAB_STYLE, 
                ]
                );

        /*Company Name Color*/
        $this->add_control('premium_testimonial_company_name_color',
                [
                    'label'             => __('Color', 'premium-addons-for-elementor'),
                    'type'              => Controls_Manager::COLOR,
                    'scheme'            => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors'         => [
                        '{{WRAPPER}} .premium-testimonial-company-link' => 'color: {{VALUE}};',
                        ]
                    ]
                );
        
        /*Company Typography*/
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'          => 'company_name_typography',
                    'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                    'selector'      => '{{WRAPPER}} .premium-testimonial-company-link',
                ]
                ); 

        /*End Color Section*/
        $this->end_controls_section();
        
        /*Start Content Settings Section*/
        $this->start_controls_section('premium_testimonial_content_style',
                [
                    'label'             => __('Content', 'premium-addons-for-elementor'),
                    'tab'               => Controls_Manager::TAB_STYLE, 
                ]
                );

        /*Content Color*/
        $this->add_control('premium_testimonial_content_color',
                [
                    'label'             => __('Color', 'premium-addons-for-elementor'),
                    'type'              => Controls_Manager::COLOR,
                    'scheme'            => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_3,
                    ],
                    'selectors'         => [
                        '{{WRAPPER}} .premium-testimonial-text-wrapper' => 'color: {{VALUE}};',
                        ]
                    ]
                );
        
        /*Content Typography*/
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'          => 'content_typography',
                    'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                    'selector'      => '{{WRAPPER}} .premium-testimonial-text-wrapper',
                ]
                ); 
        
        
        /*Testimonial Text Margin*/
        $this->add_responsive_control('premium_testimonial_margin',
            [
                'label'                 => __('Margin', 'premium-addons-for-elementor'),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => ['px', 'em', '%'],
                'default'               =>[
                    'top'   =>  15,
                    'bottom'=>  15,
                    'left'  =>  0 ,
                    'right' =>  0 ,
                    'unit'  => 'px',
                    ],
                'selectors'             => [
                    '{{WRAPPER}} .premium-testimonial-text-wrapper' => 'margin: {{top}}{{UNIT}} {{right}}{{UNIT}} {{bottom}}{{UNIT}} {{left}}{{UNIT}};',
                    ]
                ]
                );

        /*End Content Settings Section*/
        $this->end_controls_section();
        
        /*Start Quotes Style Section*/
        $this->start_controls_section('premium_testimonial_quotes',
                [
                    'label'             => __('Quotation Icon', 'premium-addons-for-elementor'),
                    'tab'               => Controls_Manager::TAB_STYLE,
                ]
                );
        
        /*Quotes Color*/ 
        $this->add_control('premium_testimonial_quote_icon_color',
                [
                   'label'              => __('Color','premium-addons-for-elementor'),
                   'type'               => Controls_Manager::COLOR,
                   'default'            => 'rgba(110,193,228,0.2)',
                    'selectors'         =>  [
                        '{{WRAPPER}} .fa'   =>  'color: {{VALUE}};',
                        ]
                    ]
                );

        /*Quotes Size*/
        $this->add_control('premium_testimonial_quotes_size',
                [
                    'label'             => __('Size', 'premium-addons-for-elementor'),
                    'type'              => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%', 'em'],
                    'default'           => [
                        'unit'  => 'px',
                        'size'  => 120,
                        ],
                    'range'             => [
                        'px' => [
                            'min' => 5,
                            'max' => 250,
                            ]
                        ],
                    'selectors'         => [
                        '{{WRAPPER}} .premium-testimonial-upper-quote, {{WRAPPER}} .premium-testimonial-lower-quote' => 'font-size: {{SIZE}}{{UNIT}};',
                        ]
                    ]
                );
        
        /*Upper Quote Position*/
        $this->add_responsive_control('premium_testimonial_upper_quote_position',
                [
                    'label'             => __('Top Icon Position', 'premium-addons-for-elementor'),
                    'type'              => Controls_Manager::DIMENSIONS,
                    'size_units'            => ['px', 'em', '%'],
                    'default'           =>[
                        'top'   =>  70,
                        'left'  =>  12 ,
                        'unit'  =>  'px',
                        ],
                    'selectors'         => [
                        '{{WRAPPER}} .premium-testimonial-upper-quote' => 'top: {{TOP}}{{UNIT}}; left:{{LEFT}}{{UNIT}};',
                        ]
                    ]
                );
        
        /*Lower Quote Position*/
        $this->add_responsive_control('premium_testimonial_lower_quote_position',
                [
                    'label'             => __('Bottom Icon Position', 'premium-addons-for-elementor'),
                    'type'              => Controls_Manager::DIMENSIONS,
                    'size_units'        => ['px', 'em', '%'],
                    'default'           =>[
                        'bottom'    =>  3,
                        'right'     =>  12,
                        'unit'      =>  'px',
                        ],
                    'selectors'         => [
                        '{{WRAPPER}} .premium-testimonial-lower-quote' => 'right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}};',
                        ]
                    ]
                );

        /*End Typography Section*/
        $this->end_controls_section();
        
        $this->start_controls_section('premium_testimonial_container_style',
            [
                'label'     => __('Container','premium-addons-for-elementor'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'              => 'premium_testimonial_background',
                'types'             => [ 'classic' , 'gradient' ],
                'selector'          => '{{WRAPPER}} .premium-testimonial-content-wrapper'
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'              => 'premium_testimonial_container_border',
                'selector'          => '{{WRAPPER}} .premium-testimonial-content-wrapper',
            ]
        );

        $this->add_control('premium_testimonial_container_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%', 'em'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-testimonial-content-wrapper' => 'border-radius: {{SIZE}}{{UNIT}}'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'              => 'premium_testimonial_container_box_shadow',
                'selector'          => '{{WRAPPER}} .premium-testimonial-content-wrapper',
            ]
        );
        
        $this->add_responsive_control('premium_testimonial_box_padding',
                [
                    'label'         => __('Padding', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-testimonial-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                        ]
                    ]
                );

        $this->end_controls_section();
        
    }

    protected function render() {
        
        $settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes('premium_testimonial_person_name');
        $this->add_inline_editing_attributes('premium_testimonial_company_name');
        $this->add_inline_editing_attributes('premium_testimonial_content', 'advanced');
        $person_title_tag = $settings['premium_testimonial_person_name_size'];
        
        $company_title_tag = $settings['premium_testimonial_company_name_size'];
        
        $image_src = '';
        
        if( ! empty( $settings['premium_testimonial_person_image']['url'] ) ) {
            $image_src = $settings['premium_testimonial_person_image']['url'];
            $alt = esc_attr( Control_Media::get_image_alt( $settings['premium_testimonial_person_image'] ) );
        }
        
        $this->add_render_attribute('testimonial', 'class', [
            'premium-testimonial-box'
        ]);
        
    ?>
    
    <div <?php echo $this->get_render_attribute_string('testimonial'); ?>>
        <div class="premium-testimonial-container">
            <i class="fa fa-quote-left premium-testimonial-upper-quote"></i>
            <div class="premium-testimonial-content-wrapper">
                <?php if ( ! empty( $image_src ) ) : ?>
                    <div class="premium-testimonial-img-wrapper" style="border-radius: <?php 
                        if( $settings['premium_testimonial_person_image_shape'] === 'circle' ) : echo "50%;";
                        elseif ( $settings['premium_testimonial_person_image_shape'] === 'square' ) : echo "0;";
                        elseif ( $settings['premium_testimonial_person_image_shape'] === 'rounded' ) : echo "15px;";
                        endif;?>">
                         <img src="<?php echo $image_src; ?>" alt="<?php echo $alt; ?>" class="premium-testimonial-person-image" 
                            style="border-radius: <?php
                            if ( $settings['premium_testimonial_person_image_shape'] === 'circle' ) : echo "50%;";
                            elseif ( $settings['premium_testimonial_person_image_shape'] === 'square' ) : echo "0;";
                            elseif ( $settings['premium_testimonial_person_image_shape'] === 'rounded' ) : echo "15px;";
                            endif; ?>">
                    </div>
                <?php endif; ?>

                <div class="premium-testimonial-text-wrapper">
                    <div <?php echo $this->get_render_attribute_string('premium_testimonial_content'); ?>>
                        <?php echo $settings['premium_testimonial_content']; ?>
                    </div>
                </div>

                <div class="premium-testimonial-author-info">
                    <<?php echo $person_title_tag; ?> class="premium-testimonial-person-name">
                        <span <?php echo $this->get_render_attribute_string('premium_testimonial_person_name'); ?>><?php echo $settings['premium_testimonial_person_name']; ?></span>
                    </<?php echo $person_title_tag; ?>>
                    
                    <span class="premium-testimonial-separator"> - </span>

                    <<?php echo $company_title_tag; ?> class="premium-testimonial-company-name">
                    <?php if( $settings['premium_testimonial_company_link_switcher'] === 'yes') : ?>
                        <a class="premium-testimonial-company-link" href="<?php echo $settings['premium_testimonial_company_link']; ?>" target="_<?php echo $settings['premium_testimonial_link_target']; ?>">
                            <span <?php echo $this->get_render_attribute_string('premium_testimonial_company_name'); ?>><?php echo $settings['premium_testimonial_company_name']; ?></span>
                        </a>
                    <?php else: ?>
                        <span class="premium-testimonial-company-link" <?php echo $this->get_render_attribute_string('premium_testimonial_company_name'); ?>>
                            <?php echo $settings['premium_testimonial_company_name']; ?>
                        </span>
                    <?php endif; ?>
                    </<?php echo $company_title_tag; ?>>
                </div>
            </div>
            <i class="fa fa-quote-right premium-testimonial-lower-quote"></i>
        </div>
    </div>
    <?php
    
    }
    
    protected function _content_template() {
        ?>
        <#
        
            view.addInlineEditingAttributes('premium_testimonial_person_name');
            view.addInlineEditingAttributes('premium_testimonial_company_name');
            view.addInlineEditingAttributes('premium_testimonial_content', 'advanced');
            view.addRenderAttribute('premium_testimonial_company_name', 'class', 'premium-testimonial-company-link');
            
            var personTag = settings.premium_testimonial_person_name_size,
                companyTag = settings.premium_testimonial_company_name_size,
                imageSrc = '',
                imageSrc,
                borderRadius;

            if( '' != settings.premium_testimonial_person_image.url ) {
                imageSrc = settings.premium_testimonial_person_image.url;
            }
                
            
            if( 'circle' == settings.premium_testimonial_person_image_shape ) {
                borderRadius = '50%;';
            } else if ( 'square' == settings.premium_testimonial_person_image_shape ) {
                borderRadius = '0;';
            } else if ( 'rounded' == settings.premium_testimonial_person_image_shape ) {
                borderRadius = '15px;';
            }
            
            view.addRenderAttribute('testimonial', 'class', [
                'premium-testimonial-box'
            ]);
            
        
        #>
        
            <div {{{ view.getRenderAttributeString('testimonial') }}}>
                <div class="premium-testimonial-container">
                    <i class="fa fa-quote-left premium-testimonial-upper-quote"></i>
                    <div class="premium-testimonial-content-wrapper">
                        <# if ( '' != imageSrc ) { #>
                            <div class="premium-testimonial-img-wrapper" style="border-radius: {{ borderRadius }}">
                                <img src="{{ imageSrc }}" alt="premium-image" class="premium-testimonial-person-image" style="border-radius: {{ borderRadius }}">
                            </div>
                        <# } #>
                        <div class="premium-testimonial-text-wrapper">
                            <div {{{ view.getRenderAttributeString('premium_testimonial_content') }}}>{{{ settings.premium_testimonial_content }}}</div>
                        </div>
                        
                        <div class="premium-testimonial-author-info">
                            <{{{personTag}}} class="premium-testimonial-person-name"><span {{{ view.getRenderAttributeString('premium_testimonial_person_name') }}}>{{{ settings.premium_testimonial_person_name }}}</span></{{{personTag}}}><span class="premium-testimonial-separator"> - </span>

                            <{{{companyTag}}} class="premium-testimonial-company-name"><a href="{{ settings.premium_testimonial_company_link }}" {{{ view.getRenderAttributeString('premium_testimonial_company_name') }}}>{{{ settings.premium_testimonial_company_name }}}</a></{{{companyTag}}}>
                        </div>
                        
                    </div>
                    
                    <i class="fa fa-quote-right premium-testimonial-lower-quote"></i>
                    
                </div>
            </div>
        
        <?php
    }

}