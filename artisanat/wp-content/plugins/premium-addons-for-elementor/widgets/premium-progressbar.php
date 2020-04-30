<?php

namespace PremiumAddons\Widgets;

use PremiumAddons\Helper_Functions;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Premium_Progressbar extends Widget_Base {
    
    public function get_name() {
        return 'premium-addon-progressbar';
    }

    public function get_title() {
		return sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __('Progress Bar', 'premium-addons-for-elementor') );
	}
    
    public function get_icon() {
        return 'pa-progress-bar';
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
            'elementor-waypoints',
            'premium-addons-js'
        ];
    }
    
    public function get_custom_help_url() {
		return 'https://premiumaddons.com/support/';
	}

    // Adding the controls fields for the premium progress bar
    // This will controls the animation, colors and background, dimensions etc
    protected function _register_controls() {

        /* Start Progress Content Section */
        $this->start_controls_section('premium_progressbar_labels',
            [
                'label'         => __('Progress Bar Settings', 'premium-addons-for-elementor'),
            ]
        );
        
        $this->add_control('premium_progressbar_select_label', 
            [
                'label'         => __('Number of Labels', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::SELECT,
                'default'       =>'left_right_labels',
                'options'       => [
                    'left_right_labels'    => __('Left & Right Labels', 'premium-addons-for-elementor'),
                    'more_labels'          => __('Multiple Labels', 'premium-addons-for-elementor'),
                ],
            ]
        );
        
        /*Left Label*/ 
        $this->add_control('premium_progressbar_left_label',
            [
                'label'         => __('Title', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
                'default'       => __('My Skill','premium-addons-for-elementor'),
                'label_block'   => true,
                'condition'     =>[
                    'premium_progressbar_select_label' => 'left_right_labels'
                ]
            ]
        );

        /*Right Label*/ 
        $this->add_control('premium_progressbar_right_label',
            [
                'label'         => __('Percentage', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
                'default'       => __('50%','premium-addons-for-elementor'),
                'label_block'   => true,
                'condition'     =>[
                    'premium_progressbar_select_label' => 'left_right_labels'
                ]
            ]
        );
        
        $repeater = new REPEATER();
        
        $repeater->add_control('text',
            [
                'label'             => __( 'Label','premium-addons-for-elementor' ),
                'type'              => Controls_Manager::TEXT,
                'dynamic'           => [ 'active' => true ],
                'label_block'       => true,
                'placeholder'       => __( 'label','premium-addons-for-elementor' ),
                'default'           => __( 'label', 'premium-addons-for-elementor' ),
            ]
        );
        
        $repeater->add_control('number',
            [
                'label'             => __( 'Percentage', 'premium-addons-for-elementor' ),
                'dynamic'           => [ 'active' => true ],
                'type'              => Controls_Manager::TEXT,
                'default'           => 50,
            ]
        );
        
        $this->add_control('premium_progressbar_multiple_label',
            [
                'label'     => __('Label','premium-addons-for-elementor'),
                'type'      => Controls_Manager::REPEATER,
                'default'   => [
                    [
                        'text' => __( 'Label','premium-addons-for-elementor' ),
                        'number' => 50
                    ]
                    ],
                'fields'    => array_values( $repeater->get_controls() ),
                'condition' => [
                    'premium_progressbar_select_label'  =>'more_labels'
                ] 
            ]
        );
        
        $this->add_control('premium_progress_bar_space_percentage_switcher',
            [
                'label'      => __('Enable Percentage', 'premium-addons-for-elementor'),
                'type'       => Controls_Manager::SWITCHER,
                'default'     => 'yes',
                'description' => __('Enable percentage for labels','premium-addons-for-elementor'),
                'condition'   => [
                    'premium_progressbar_select_label'=>'more_labels',
                ]
            ]
        );
        
        $this->add_control('premium_progressbar_select_label_icon', 
            [
                'label'         => __('Labels Indicator', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::SELECT,
                'default'       =>'line_pin',
                'options'       => [
                    ''            => __('None','premium-addons-for-elementor'),
                    'line_pin'    => __('Pin', 'premium-addons-for-elementor'),
                    'arrow'       => __('Arrow','premium-addons-for-elementor'),
                ],
                'condition'     =>[
                    'premium_progressbar_select_label' => 'more_labels'
                ]
            ]
        );
        
        $this->add_control('premium_progressbar_more_labels_align',
            [
                'label'         => __('Labels Alignment','premuim-addons-for-elementor'),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
                    'left'      => [
                        'title'=> __( 'Left', 'premium-addons-for-elementor' ),
                        'icon' => 'fa fa-align-left',   
                    ],
                    'center'     => [
                        'title'=> __( 'Center', 'premium-addons-for-elementor' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right'     => [
                        'title'=> __( 'Right', 'premium-addons-for-elementor' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default'       => 'center',
                'condition'     =>[
                    'premium_progressbar_select_label' => 'more_labels'
                ]
            ]
        );
    
        /*Progressbar Width*/
        $this->add_control('premium_progressbar_progress_percentage',
            [
                'label'             => __('Value', 'premium-addons-for-elementor'),
                'type'              => Controls_Manager::TEXT,
                'dynamic'           => [ 'active' => true ],
                'default'           => 50
            ]
        );
        
        /*Progress Bar Style*/
        $this->add_control('premium_progressbar_progress_style', 
                [
                    'label'         => __('Type', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::SELECT,
                    'default'       => 'solid',
                    'options'       => [
                        'solid'    => __('Solid', 'premium-addons-for-elementor'),
                        'stripped' => __('Striped', 'premium-addons-for-elementor'),
                        ],
                    ]
                );
        
        $this->add_control('premium_progressbar_speed',
            [
                'label'             => __('Speed (milliseconds)', 'premium-addons-for-elementor'),
                'type'              => Controls_Manager::NUMBER
            ]
        );
        
        /*Progress Bar Animated*/
        $this->add_control('premium_progressbar_progress_animation', 
                [
                    'label'         => __('Animated', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::SWITCHER,
                    'condition'     => [
                        'premium_progressbar_progress_style'    => 'stripped'
                        ]
                    ]
                );
        
        /*End Progress General Section*/
        $this->end_controls_section();

        /*Start Styling Section*/
        /*Start progressbar Settings*/
        $this->start_controls_section('premium_progressbar_progress_bar_settings',
            [
                'label'             => __('Progress Bar', 'premium-addons-for-elementor'),
                'tab'               => Controls_Manager::TAB_STYLE,
            ]
        );
        
        /*Progressbar Height*/ 
        $this->add_control('premium_progressbar_progress_bar_height',
                [
                    'label'         => __('Height', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::SLIDER,
                    'default'       => [
                        'size'  => 25,
                        ],
                    'label_block'   => true,
                    'selectors'     => [
                        '{{WRAPPER}} .premium-progressbar-progress, {{WRAPPER}} .premium-progressbar-progress-bar' => 'height: {{SIZE}}px;',   
                    ]
                ]
                );

        /*Border Radius*/
        $this->add_control('premium_progressbar_progress_bar_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%', 'em'],
                    'default'       => [
                        'unit'  => 'px',
                        'size'  => 0,
                        ],
                    'range'         => [
                        'px'  => [
                            'min' => 0,
                            'max' => 60,
                            ],
                        ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-progressbar-progress-bar, {{WRAPPER}} .premium-progressbar-progress' => 'border-radius: {{SIZE}}{{UNIT}};',
                        ]
                    ]
                );
        
        $this->add_control('premium_progressbar_ind_background_hint',
                [
                    'label'             =>  __('Indicator Background', 'premium-addons-for-elementor'),
                    'type'              => Controls_Manager::HEADING,
                ]
                );
        
        /*Progress Bar Color Type*/
        $this->add_group_control(
            Group_Control_Background::get_type(),
                [
                    'name'              => 'premium_progressbar_progress_color',
                    'types'             => [ 'classic' , 'gradient' ],
                    'default'           => [
                        'color' => '#26beca',
                    ],
                    'selector'          => '{{WRAPPER}} .premium-progressbar-progress-bar',
                    ]
                );
        
        $this->add_control('premium_progressbar_main_background_hint',
                [
                    'label'             =>  __('Main Background', 'premium-addons-for-elementor'),
                    'type'              => Controls_Manager::HEADING,
                ]
                );
        
        /*Progress Bar Background Color*/
        $this->add_group_control(
            Group_Control_Background::get_type(),
                [
                    'name'              => 'premium_progressbar_background',
                    'types'             => [ 'classic' , 'gradient' ],
                    'selector'          => '{{WRAPPER}} .premium-progressbar-progress',
                    ]
                );
        $this->add_responsive_control('premium_progressbar_container_margin',
            [
                'label'             => __('Margin', 'premium-addons-for-elementor'),
                'type'              => Controls_Manager::DIMENSIONS,
                'size_units'        => [ 'px', 'em', '%' ],
                'selectors'         => [
                    '{{WRAPPER}} .premium-progressbar-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]      
        );
        /*End Progress Bar Section*/
        $this->end_controls_section();

        /*Start Labels Settings Section*/
        $this->start_controls_section('premium_progressbar_labels_section',
                [
                    'label'         => __('Labels', 'premium-addons-for-elementor'),
                    'tab'           => Controls_Manager::TAB_STYLE,
                    'condition'     => [
                        'premium_progressbar_select_label'  => 'left_right_labels'
                    ]
                ]
                );
        
        $this->add_control('premium_progressbar_left_label_hint',
                [
                    'label'             =>  __('Title', 'premium-addons-for-elementor'),
                    'type'              => Controls_Manager::HEADING,
                ]
                );
        
        /*Left Label Color*/
        $this->add_control('premium_progressbar_left_label_color',
                [
                    'label'         => __('Color', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors'     => [
                    '{{WRAPPER}} .premium-progressbar-left-label' => 'color: {{VALUE}};',
                ]
            ]
         );
        
        /*Left Label Typography*/
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'          => 'left_label_typography',
                    'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                    'selector'      => '{{WRAPPER}} .premium-progressbar-left-label',
                    ]
                );
        
        
        /*Left Label Margin*/
        $this->add_responsive_control('premium_progressbar_left_label_margin',
            [
                'label'             => __('Margin', 'premium-addons-for-elementor'),
                'type'              => Controls_Manager::DIMENSIONS,
                'size_units'        => [ 'px', 'em', '%' ],
                'selectors'         => [
                    '{{WRAPPER}} .premium-progressbar-left-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]      
        );
        
        $this->add_control('premium_progressbar_right_label_hint',
                [
                    'label'             =>  __('Percentage', 'premium-addons-for-elementor'),
                    'type'              => Controls_Manager::HEADING,
                    'separator'         => 'before'
                ]
                );
        
        /*Right Label Color*/
        $this->add_control('premium_progressbar_right_label_color',
             [
                'label'             => __('Color', 'premium-addons-for-elementor'),
                'type'              => Controls_Manager::COLOR,
                 'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                'selectors'        => [
                    '{{WRAPPER}} .premium-progressbar-right-label' => 'color: {{VALUE}};',
                ]
            ]
         );
        
        /*Right Label Typography*/
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'          => 'right_label_typography',
                    'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                    'selector'      => '{{WRAPPER}} .premium-progressbar-right-label',
                    ]
                );
        
        /*Right Label Margin*/
        $this->add_responsive_control('premium_progressbar_right_label_margin',
            [
                'label'             => __('Margin', 'premium-addons-for-elementor'),
                'type'              => Controls_Manager::DIMENSIONS,
                'size_units'        => [ 'px', 'em', '%' ],
                'selectors'         => [
                    '{{WRAPPER}} .premium-progressbar-right-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]      
        );
        

        /*End Labels Settings Section*/
        $this->end_controls_section();
        
        $this->start_controls_section('premium_progressbar_multiple_labels_section',
                [
                    'label'         => __('Multiple Labels', 'premium-addons-for-elementor'),
                    'tab'           => Controls_Manager::TAB_STYLE,
                    'condition'     =>[
                        'premium_progressbar_select_label'  => 'more_labels'
                    ]
                ]
                );
        $this->add_control('premium_progressbar_multiple_label_color',
             [
                'label'             => __('Labels\' Color', 'premium-addons-for-elementor'),
                'type'              => Controls_Manager::COLOR,
                 'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                'selectors'        => [
                    '{{WRAPPER}} .premium-progressbar-center-label' => 'color: {{VALUE}};',
                ]
            ]
         );
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [   
                    'label'         => __('Labels\' Typography', 'premium-addons-for-elementor'),
                    'name'          => 'more_label_typography',
                    'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                    'selector'      => '{{WRAPPER}} .premium-progressbar-center-label',
                        
                    ]
                );
        $this->add_control('premium_progressbar_value_label_color',
             [
                'label'             => __('Percentage Color', 'premium-addons-for-elementor'),
                'type'              => Controls_Manager::COLOR,
                 'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                 'condition'       =>[
                     'premium_progress_bar_space_percentage_switcher'=>'yes'
                 ],
                'selectors'        => [
                    '{{WRAPPER}} .premium-progressbar-percentage' => 'color: {{VALUE}};',
                ]
            ]
         );
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [   
                    'label'         => __('Percentage Typography','premium-addons-for-elementor'),
                    'name'          => 'percentage_typography',
                    'condition'       =>[
                         'premium_progress_bar_space_percentage_switcher'=>'yes'
                    ],
                    'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                    'selector'      => '{{WRAPPER}} .premium-progressbar-percentage',
                    ]
                );
         $this->end_controls_section();
         $this->start_controls_section('premium_progressbar_multiple_labels_arrow_section',
                [
                    'label'         => __('Arrow', 'premium-addons-for-elementor'),
                    'tab'           => Controls_Manager::TAB_STYLE,
                    'condition'     =>[
                        'premium_progressbar_select_label'  => 'more_labels',
                        'premium_progressbar_select_label_icon' => 'arrow'
                    ]
                ]
                );
        
         /*Arrow color*/
        $this->add_control('premium_progressbar_arrow_color',
                [
                    'label'         => __('Color', 'premium_elementor'),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'          => Scheme_Color::get_type(),
                        'value'         => Scheme_Color::COLOR_1,
                    ],
                    'condition'     =>[
                        'premium_progressbar_select_label_icon' => 'arrow'
                    ],
                     'selectors'     => [
                    '{{WRAPPER}} .premium-progressbar-arrow' => 'color: {{VALUE}};'
                ]
            ]
         );
                
        /*Arrow Size*/
	 $this->add_responsive_control('premium_arrow_size',
            [
                    'label'	       => __('Size','premium-addons-for-elementor'),
                    'type'             =>Controls_Manager::SLIDER,
                    'size_units'       => ['px', "em"],
                    'condition'        =>[
                        'premium_progressbar_select_label_icon' => 'arrow'
                    ],
                    'selectors'          => [
                        '{{WRAPPER}} .premium-progressbar-arrow' => 'border-width: {{SIZE}}{{UNIT}};'
                        ]
            ]
        );
       $this->end_controls_section();
       $this->start_controls_section('premium_progressbar_multiple_labels_pin_section',
                [
                    'label'         => __('Indicator', 'premium-addons-for-elementor'),
                    'tab'           => Controls_Manager::TAB_STYLE,
                    'condition'     =>[
                        'premium_progressbar_select_label'  => 'more_labels',
                        'premium_progressbar_select_label_icon' => 'line_pin'
                    ]
                ]
                );
        
       $this->add_control('premium_progressbar_line_pin_color',
                [
                    'label'             => __('Color', 'premium-addons-for-elementor'),
                    'type'              => Controls_Manager::COLOR,
                    'scheme'            => [
                        'type'               => Scheme_Color::get_type(),
                        'value'              => Scheme_Color::COLOR_2,
                    ],
                    'condition'         =>[
                        'premium_progressbar_select_label_icon' =>'line_pin'
                    ],
                     'selectors'        => [
                    '{{WRAPPER}} .premium-progressbar-pin' => 'border-color: {{VALUE}};'
                ]
            ]
         );
        $this->add_responsive_control('premium_pin_size',
            [
                    'label'	       => __('Size','premium-addons-for-elementor'),
                    'type'             =>Controls_Manager::SLIDER,
                    'size_units'       => ['px', "em"],
                    'condition'        =>[
                        'premium_progressbar_select_label_icon' => 'line_pin'
                    ],
                    'selectors'         => [
                        '{{WRAPPER}} .premium-progressbar-pin' => 'border-left-width: {{SIZE}}{{UNIT}};'
                        ]
            ]
        );
        $this->add_responsive_control('premium_pin_height',
            [
                    'label'	       => __('Height','premium-addons-for-elementor'),
                    'type'             =>Controls_Manager::SLIDER,
                    'size_units'       => ['px', "em"],
                    'condition'        =>[
                        'premium_progressbar_select_label_icon' => 'line_pin'
                    ],
                    'selectors'         => [
                        '{{WRAPPER}} .premium-progressbar-pin' => 'height: {{SIZE}}{{UNIT}};'
                        ]
            ]
        );
        $this->end_controls_section();
    }

    protected function render(){
        // get our input from the widget settings.
        $settings = $this->get_settings_for_display();
        $this->add_inline_editing_attributes('premium_progressbar_left_label');
        $this->add_inline_editing_attributes('premium_progressbar_right_label');
        
        $length = isset ( $settings['premium_progressbar_progress_percentage']['size'] ) ? $settings['premium_progressbar_progress_percentage']['size'] : $settings['premium_progressbar_progress_percentage'];
        
        $progressbar_settings = [
            'progress_length'   => $length,
            'speed'             => !empty( $settings['premium_progressbar_speed'] ) ? $settings['premium_progressbar_speed'] : 1000
        ];
?>

   <div class="premium-progressbar-container">
        <?php if ($settings['premium_progressbar_select_label'] === 'left_right_labels') :?>
            <p class="premium-progressbar-left-label"><span <?php echo $this->get_render_attribute_string('premium_progressbar_left_label'); ?>><?php echo $settings['premium_progressbar_left_label'];?></span></p>
        <p class="premium-progressbar-right-label"><span <?php echo $this->get_render_attribute_string('premium_progressbar_right_label'); ?>><?php echo $settings['premium_progressbar_right_label'];?></span></p>
        <?php endif;?>
        <?php if ($settings['premium_progressbar_select_label'] === 'more_labels'):?>
            <div class="premium-progressbar-container-label" style="position:relative;">
            <?php foreach($settings['premium_progressbar_multiple_label'] as $item){
                if($this->get_settings('premium_progressbar_more_labels_align') === 'center'){
                    if($settings['premium_progress_bar_space_percentage_switcher'] === 'yes'){
                       if($settings['premium_progressbar_select_label_icon'] === 'arrow')
                       { 
                            echo '<div class ="premium-progressbar-multiple-label" style="left:'.$item['number'].'%;"><p class = "premium-progressbar-center-label" style="transform:translateX(-45%);">'.$item['text'].' <span class="premium-progressbar-percentage">'.$item['number'].'%</span></p><p class="premium-progressbar-arrow" style="left:'.$item['number'].'%; transform:translateX(50%);"></p></div>';
                       }
                       elseif($settings['premium_progressbar_select_label_icon'] === 'line_pin'){

                           echo '<div class ="premium-progressbar-multiple-label" style="left:'.$item['number'].'%;"><p class = "premium-progressbar-center-label" style="transform:translateX(-45%);">'.$item['text'].' <span class="premium-progressbar-percentage">'.$item['number'].'%</span></p><p class="premium-progressbar-pin" style="left:'.$item['number'].'%; transform:translateX(50%);"></p></div>';
                        }
                        else {
                            echo '<div class ="premium-progressbar-multiple-label" style="left:'.$item['number'].'%;"><p class = "premium-progressbar-center-label" style="transform:translateX(-45%);">'.$item['text'].' <span class="premium-progressbar-percentage">'.$item['number'].'%</span></p></div>';

                        }
                    }
                    else{
                        if($settings['premium_progressbar_select_label_icon'] === 'arrow')
                       { 
                            echo '<div class ="premium-progressbar-multiple-label" style="left:'.$item['number'].'%;"><p class = "premium-progressbar-center-label" style="transform:translateX(-45%);">'.$item['text'].'</p><p class="premium-progressbar-arrow" style="left:'.$item['number'].'%; transform:translateX(50%);"></p></div>';
                       }
                       elseif($settings['premium_progressbar_select_label_icon'] === 'line_pin'){

                           echo '<div class ="premium-progressbar-multiple-label" style="left:'.$item['number'].'%;"><p class = "premium-progressbar-center-label" style="transform:translateX(-45%)">'.$item['text'].'</p><p class="premium-progressbar-pin" style="left:'.$item['number'].'%; transform:translateX(50%);"></p></div>';
                        }
                        else {
                            echo '<div class ="premium-progressbar-multiple-label" style="left:'.$item['number'].'%;"><p class = "premium-progressbar-center-label" style="transform:translateX(-45%);">'.$item['text'].'</p></div>';

                        }
                    }
                }
                elseif($this->get_settings('premium_progressbar_more_labels_align') === 'left'){
                    if($settings['premium_progress_bar_space_percentage_switcher'] === 'yes'){
                       if($settings['premium_progressbar_select_label_icon'] === 'arrow')
                       { 
                            echo '<div class ="premium-progressbar-multiple-label" style="left:'.$item['number'].'%;"><p class = "premium-progressbar-center-label" style="transform:translateX(-10%);">'.$item['text'].' <span class="premium-progressbar-percentage">'.$item['number'].'%</span></p><p class="premium-progressbar-arrow" style="left:'.$item['number'].'%; transform:translateX(50%);"></p></div>';
                       }
                       elseif($settings['premium_progressbar_select_label_icon'] === 'line_pin'){

                           echo '<div class ="premium-progressbar-multiple-label" style="left:'.$item['number'].'%;"><p class = "premium-progressbar-center-label" style="transform:translateX(-2%);">'.$item['text'].' <span class="premium-progressbar-percentage">'.$item['number'].'%</span></p><p class="premium-progressbar-pin" style="left:'.$item['number'].'%; transform:translateX(50%);"></p></div>';
                        }
                        else {
                            echo '<div class ="premium-progressbar-multiple-label" style="left:'.$item['number'].'%;"><p class = "premium-progressbar-center-label" style="transform:translateX(-2%);">'.$item['text'].' <span class="premium-progressbar-percentage">'.$item['number'].'%</span></p></div>';

                        }
                    }
                    else{
                        if($settings['premium_progressbar_select_label_icon'] === 'arrow')
                       { 
                            echo '<div class ="premium-progressbar-multiple-label" style="left:'.$item['number'].'%;"><p class = "premium-progressbar-center-label" style="transform:translateX(-10%);">'.$item['text'].'</p><p class="premium-progressbar-arrow" style="left:'.$item['number'].'%; transform:translateX(50%);"></p></div>';
                       }
                       elseif($settings['premium_progressbar_select_label_icon'] === 'line_pin'){

                           echo '<div class ="premium-progressbar-multiple-label" style="left:'.$item['number'].'%;"><p class = "premium-progressbar-center-label" style="transform:translateX(-2%);">'.$item['text'].'</p><p class="premium-progressbar-pin" style="left:'.$item['number'].'%; transform:translateX(50%);"></p></div>';
                        }
                        else {
                            echo '<div class ="premium-progressbar-multiple-label" style="left:'.$item['number'].'%;"><p class = "premium-progressbar-center-label" style="transform:translateX(-2%);">'.$item['text'].'</p></div>';

                        }
                    }
                }
                else{
                    if($settings['premium_progress_bar_space_percentage_switcher'] === 'yes'){
                       if($settings['premium_progressbar_select_label_icon'] === 'arrow')
                       { 
                            echo '<div class ="premium-progressbar-multiple-label" style="left:'.$item['number'].'%;"><p class = "premium-progressbar-center-label" style="transform:translateX(-82%);">'.$item['text'].' <span class="premium-progressbar-percentage">'.$item['number'].'%</span></p><p class="premium-progressbar-arrow" style="left:'.$item['number'].'%; transform:translateX(50%);"></p></div>';
                       }
                       elseif($settings['premium_progressbar_select_label_icon'] === 'line_pin'){

                           echo '<div class ="premium-progressbar-multiple-label" style="left:'.$item['number'].'%;"><p class = "premium-progressbar-center-label" style="transform:translateX(-95%);">'.$item['text'].' <span class="premium-progressbar-percentage">'.$item['number'].'%</span></p><p class="premium-progressbar-pin" style="left:'.$item['number'].'%; transform:translateX(50%);"></p></div>';
                        }
                        else {
                            echo '<div class ="premium-progressbar-multiple-label" style="left:'.$item['number'].'%;"><p class = "premium-progressbar-center-label" style="transform:translateX(-96%);">'.$item['text'].' <span class="premium-progressbar-percentage">'.$item['number'].'%</span></p></div>';

                        }
                    }
                    else{
                        if($settings['premium_progressbar_select_label_icon'] === 'arrow')
                       { 
                            echo '<div class ="premium-progressbar-multiple-label" style="left:'.$item['number'].'%;"><p class = "premium-progressbar-center-label" style="transform:translateX(-71%);">'.$item['text'].'</p><p class="premium-progressbar-arrow" style="left:'.$item['number'].'%; transform:translateX(50%);"></p></div>';
                       }
                       elseif($settings['premium_progressbar_select_label_icon'] === 'line_pin'){

                           echo '<div class ="premium-progressbar-multiple-label" style="left:'.$item['number'].'%;"><p class = "premium-progressbar-center-label" style="transform:translateX(-97%);">'.$item['text'].'</p><p class="premium-progressbar-pin" style="left:'.$item['number'].'%; transform:translateX(50%);"></p></div>';
                        }
                        else {
                            echo '<div class ="premium-progressbar-multiple-label" style="left:'.$item['number'].'%;"><p class = "premium-progressbar-center-label" style="transform:translateX(-96%);">'.$item['text'].'</p></div>';

                        }
                    }
                }

               }?>
            </div>
        <?php endif;?>
            <div class="clearfix"></div>
            <div class="pa-progress premium-progressbar-progress">
                <div class="premium-progressbar-progress-bar progress-bar <?php if( $settings['premium_progressbar_progress_style'] === 'solid' ){ echo "";} elseif( $settings['premium_progressbar_progress_style'] === 'stripped' ){ echo "progress-bar-striped";}?> <?php if( $settings['premium_progressbar_progress_animation'] === 'yes' ){ echo "active";}?>" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-settings='<?php echo wp_json_encode($progressbar_settings); ?>'>
                </div>
            </div>
        </div>
    <?php
    }
}