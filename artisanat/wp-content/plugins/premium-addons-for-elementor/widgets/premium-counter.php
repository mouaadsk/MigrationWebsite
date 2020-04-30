<?php 

namespace PremiumAddons\Widgets;

use PremiumAddons\Helper_Functions;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;

if( ! defined( 'ABSPATH' ) ) exit; // No access of directly access

class Premium_Counter extends Widget_Base {

	public function get_name() {
		return 'premium-counter';
	}

	public function get_title() {
        return sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __('Counter', 'premium-addons-for-elementor') );
	}

	public function get_icon() {
		return 'pa-counter';
	}
    
    public function get_style_depends() {
        return [
            'premium-addons'
        ];
    }

	public function get_script_depends() {
		return [
            'jquery-numerator',
            'elementor-waypoints',
            'premium-addons-js',
        ];
	}

	public function get_categories() {
		return [ 'premium-elements' ];
	}
    
    public function get_custom_help_url() {
		return 'https://premiumaddons.com/support/';
	}

    // Adding the controls fields for the premium counter
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {
		$this->start_controls_section('premium_counter_global_settings',
			[
				'label'         => __( 'Counter', 'premium-addons-for-elementor' )
			]
		);
        
        $this->add_control('premium_counter_title',
			[
				'label'			=> __( 'Title', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
				'description'	=> __( 'Enter title for stats counter block', 'premium-addons-for-elementor'),
			]
		);
        
		$this->add_control('premium_counter_start_value',
			[
				'label'			=> __( 'Starting Number', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::NUMBER,
				'default'		=> 0
			]
		);
        
        $this->add_control('premium_counter_end_value',
			[
				'label'			=> __( 'Ending Number', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::NUMBER,
				'default'		=> 500
			]
		);

		$this->add_control('premium_counter_t_separator',
			[
				'label'			=> __( 'Thousands Separator', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
				'description'	=> __( 'Separator converts 125000 into 125,000', 'premium-addons-for-elementor' ),
				'default'		=> ','
			]
		);

		$this->add_control('premium_counter_d_after',
			[
				'label'			=> __( 'Digits After Decimal Point', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::NUMBER,
				'default'		=> 0
			]
		);

		$this->add_control('premium_counter_preffix',
			[
				'label'			=> __( 'Value Prefix', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
				'description'	=> __( 'Enter prefix for counter value', 'premium-addons-for-elementor' )
			]
		);

		$this->add_control('premium_counter_suffix',
			[
				'label'			=> __( 'Value suffix', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
				'description'	=> __( 'Enter suffix for counter value', 'premium-addons-for-elementor' )
			]
		);

		$this->add_control('premium_counter_speed',
			[
				'label'			=> __( 'Rolling Time', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::NUMBER,
				'description'	=> __( 'How long should it take to complete the digit?', 'premium-addons-for-elementor' ),
				'default'		=> 3
			]
		);
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_counter_display_options',
			[
				'label'         => __( 'Display Options', 'premium-addons-for-elementor' )
			]
		);

		$this->add_control('premium_counter_icon_image',
		  	[
		     	'label'			=> __( 'Icon Type', 'premium-addons-for-elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
                'description'   => __('Use a font awesome icon or upload a custom image', 'premium-addons-for-elementor'),
		     	'options'		=> [
		     		'icon'  => __('Font Awesome', 'premium-addons-for-elementor'),
		     		'custom'=> __( 'Custom Image', 'premium-addons-for-elementor')
		     	],
		     	'default'		=> 'icon'
		  	]
		);

		$this->add_control('premium_counter_icon_updated',
		  	[
		     	'label'			=> __( 'Select an Icon', 'premium-addons-for-elementor' ),
		     	'type'              => Controls_Manager::ICONS,
                'fa4compatibility'  => 'premium_counter_icon',
                'default' => [
                    'value'     => 'fas fa-clock',
                    'library'   => 'fa-solid',
                ],
			  	'condition'		=> [
			  		'premium_counter_icon_image' => 'icon'
			  	]
		  	]
		);

		$this->add_control('premium_counter_image_upload',
		  	[
		     	'label'			=> __( 'Upload Image', 'premium-addons-for-elementor' ),
		     	'type' 			=> Controls_Manager::MEDIA,
			  	'condition'			=> [
			  		'premium_counter_icon_image' => 'custom'
			  	],
			  	'default'		=> [
			  		'url' => Utils::get_placeholder_image_src(),
			  	]
		  	]
		);
        
        $this->add_control('premium_counter_icon_position',
			[
				'label'			=> __( 'Icon Position', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::SELECT,
                'description'	=> __( 'Choose a position for your icon', 'premium-addons-for-elementor'),
				'default'		=> 'no-animation',
				'options'		=> [
					'top'   => __( 'Top', 'premium-addons-for-elementor' ),
					'right' => __( 'Right', 'premium-addons-for-elementor' ),
					'left'  => __( 'Left', 'premium-addons-for-elementor' ),
					
				],
				'default' 		=> 'top',
				'separator' 	=> 'after'
			]
		);
        
        $this->add_control('premium_counter_icon_animation', 
            [
                'label'         => __('Animations', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::ANIMATION,
                'render_type'   => 'template'
            ]
            );
        
		
		$this->end_controls_section();
        
        $this->start_controls_section('premium_counter_icon_style_tab',
			[
				'label'         => __( 'Icon' , 'premium-addons-for-elementor' ),
				'tab' 			=> Controls_Manager::TAB_STYLE
			]
		);
        
        $this->add_control('premium_counter_icon_color',
		  	[
				'label'         => __( 'Color', 'premium-addons-for-elementor' ),
				'type' 			=> Controls_Manager::COLOR,
				'scheme' 		=> [
				    'type' 	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'selectors'     => [
					'{{WRAPPER}} .premium-counter-area .premium-counter-icon .icon i' => 'color: {{VALUE}};'
				],
			  	'condition'     => [
			  		'premium_counter_icon_image' => 'icon'
			  	]
			]
		);
        
        $this->add_responsive_control('premium_counter_icon_size',
		  	[
		     	'label'			=> __( 'Size', 'premium-addons-for-elementor' ),
		     	'type' 			=> Controls_Manager::SLIDER,
		     	'default' => [
					'size' => 70,
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 200,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .premium-counter-area .premium-counter-icon .icon' => 'font-size: {{SIZE}}{{UNIT}};'
				],
			  	'condition'     => [
			  		'premium_counter_icon_image' => 'icon'
			  	]
		  	]
		);

		$this->add_responsive_control('premium_counter_image_size',
		  	[
		     	'label'			=> __( 'Size', 'premium-addons-for-elementor' ),
		     	'type' 			=> Controls_Manager::SLIDER,
		     	'default' => [
					'size' => 60,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .premium-counter-area .premium-counter-icon img.custom-image' => 'width: {{SIZE}}%;'
				],
			  	'condition'     => [
			  		'premium_counter_icon_image' => 'custom'
			  	]
		  	]
		);

		$this->add_control('premium_counter_icon_style',
		  	[
				'label' 		=> __( 'Style', 'premium-addons-for-elementor' ),
				'type' 			=> Controls_Manager::SELECT,
                'description'   => __('We are giving you three quick preset if you are in a hurry. Otherwise, create your own with various options', 'premium-addons-for-elementor'),
				'options'		=> [
					'simple'=> __( 'Simple', 'premium-addons-for-elementor' ),
					'circle'=> __( 'Circle Background', 'premium-addons-for-elementor' ),
					'square'=> __( 'Square Background', 'premium-addons-for-elementor' ),
					'design'=> __( 'Design Your Own', 'premium-addons-for-elementor' )
				],
				'default' 		=> 'simple'
			]
		);

		$this->add_control('premium_counter_icon_bg',
			[
				'label' 		=> __( 'Background Color', 'premium-addons-for-elementor' ),
				'type' 			=> Controls_Manager::COLOR,
				'scheme' 		=> [
				    'type' 	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_2,
				],
				'condition'		=> [
					'premium_counter_icon_style!' => 'simple'
				],
				'selectors' => [
					'{{WRAPPER}} .premium-counter-area .premium-counter-icon .icon-bg' => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control('premium_counter_icon_bg_size',
		  	[
		     	'label'			=> __( 'Background size', 'premium-addons-for-elementor' ),
		     	'type' 			=> Controls_Manager::SLIDER,
		     	'default' => [
					'size' => 150,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 600,
					]
				],
				'condition'		=> [
					'premium_counter_icon_style!' => 'simple'
				],
				'selectors' => [
					'{{WRAPPER}} .premium-counter-area .premium-counter-icon span.icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
				]
		  	]
		);

		$this->add_responsive_control('premium_counter_icon_v_align',
		  	[
		     	'label'			=> __( 'Vertical Alignment', 'premium-addons-for-elementor' ),
		     	'type' 			=> Controls_Manager::SLIDER,
		     	'default' => [
					'size' => 150,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 600,
					]
				],
				'condition'		=> [
					'premium_counter_icon_style!' => 'simple'
				],
				'selectors' => [
					'{{WRAPPER}} .premium-counter-area .premium-counter-icon span.icon' => 'line-height: {{SIZE}}{{UNIT}};'
				]
		  	]
		);
        
        
        $this->add_group_control(
        Group_Control_Border::get_type(),
            [
                'name'          => 'premium_icon_border',
                'selector'      => '{{WRAPPER}} .premium-counter-area .premium-counter-icon .design',
                'condition'		=> [
					'premium_counter_icon_style' => 'design'
				]
            ]
            );

        $this->add_control('premium_icon_border_radius',
                [
                    'label'     => __('Border Radius', 'premium-addons-for-elementor'),
                    'type'      => Controls_Manager::SLIDER,
                    'size_units'=> ['px', '%' ,'em'],
                    'default'   => [
                        'unit'      => 'px',
                        'size'      => 0,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .premium-counter-area .premium-counter-icon .design' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ],
                    'condition'	=> [
					'premium_counter_icon_style' => 'design'
				]
                ]
                );
        
        $this->end_controls_section();
        
        
		$this->start_controls_section('premium_counter_title_style',
			[
				'label'         => __( 'Title' , 'premium-addons-for-elementor' ),
				'tab' 			=> Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control('premium_counter_title_color',
			[
				'label' 		=> __( 'Color', 'premium-addons-for-elementor' ),
				'type' 			=> Controls_Manager::COLOR,
				'scheme' 		=> [
				    'type' 	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'selectors'		=> [
					'{{WRAPPER}} .premium-counter-area .premium-counter-title' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'premium_counter_title_typho',
				'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
				'selector'      => '{{WRAPPER}} .premium-counter-area .premium-counter-title',
			]
		);
        
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'          => 'premium_counter_title_shadow',
                'selector'      => '{{WRAPPER}} .premium-counter-area .premium-counter-title',
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_counter_value_style',
            [
                'label'         => __('Value', 'premium-addons-for-elementor'),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
            );
        
		$this->add_control('premium_counter_value_color',
			[
				'label' 		=> __( 'Color', 'premium-addons-for-elementor' ),
				'type' 			=> Controls_Manager::COLOR,
				'scheme' 		=> [
				    'type' 	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'selectors'		=> [
					'{{WRAPPER}} .premium-counter-area .premium-counter-init' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'premium_counter_value_typho',
				'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
				'selector'      => '{{WRAPPER}} .premium-counter-area .premium-counter-init',
				'separator'		=> 'after'
			]
		);
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_counter_suffix_prefix_style',
            [
                'label'         => __('Prefix & Suffix', 'premium-addons-for-elementor'),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
            );
        
        $this->add_control('premium_counter_prefix_color',
			[
				'label' 		=> __( 'Prefix Color', 'premium-addons-for-elementor' ),
				'type' 			=> Controls_Manager::COLOR,
				'scheme' 		=> [
				    'type' 	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'selectors' 	=> [
					'{{WRAPPER}} .premium-counter-area span#prefix' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'premium_counter_prefix_typo',
				'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
				'selector'      => '{{WRAPPER}} .premium-counter-area span#prefix',
                'separator'     => 'after',
			]
		);

		$this->add_control('premium_counter_suffix_color',
			[
				'label' 		=> __( 'Suffix Color', 'premium-addons-for-elementor' ),
				'type' 			=> Controls_Manager::COLOR,
				'scheme' 		=> [
				    'type' 	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'selectors' 	=> [
					'{{WRAPPER}} .premium-counter-area span#suffix' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'premium_counter_suffix_typo',
				'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
				'selector'      => '{{WRAPPER}} .premium-counter-area span#suffix',
                'separator'     => 'after',
			]
		);

		$this->end_controls_section();

	}
    
    public function get_counter_content($settings, $direction) {

        $start_value = $settings['premium_counter_start_value'];
        
    ?>
    
        <div class="premium-init-wrapper <?php echo $direction; ?>">

            <?php if ( ! empty( $settings['premium_counter_preffix'] ) ) : ?>
                <span id="prefix" class="counter-su-pre"><?php echo $settings['premium_counter_preffix']; ?></span>
            <?php endif; ?>

            <span class="premium-counter-init" id="counter-<?php echo esc_attr($this->get_id()); ?>"><?php echo $start_value; ?></span>

            <?php if ( ! empty( $settings['premium_counter_suffix'] ) ) : ?>
                <span id="suffix" class="counter-su-pre"><?php echo $settings['premium_counter_suffix']; ?></span>
            <?php endif; ?>

            <?php if ( ! empty( $settings['premium_counter_title'] ) ) : ?>
                <h4 class="premium-counter-title">
                    <div <?php echo $this->get_render_attribute_string('premium_counter_title'); ?>>
                        <?php echo $settings['premium_counter_title'];?>
                    </div>
                </h4>
            <?php endif; ?>
        </div>

    <?php   
    }
    
    public function get_counter_icon( $settings, $direction ) {
        
        $icon_style = $settings['premium_counter_icon_style'] != 'simple' ? ' icon-bg ' . $settings['premium_counter_icon_style'] : '';
        
        $animation = $settings['premium_counter_icon_animation'];
        
        if ( $settings['premium_counter_icon_image'] === 'icon' ) {
            if ( ! empty ( $settings['premium_counter_icon'] )  ) {
                $this->add_render_attribute( 'icon', 'class', $settings['premium_counter_icon'] );
                $this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
            }
            
            $migrated = isset( $settings['__fa4_migrated']['premium_counter_icon_updated'] );
            $is_new = empty( $settings['premium_counter_icon'] ) && Icons_Manager::is_migration_allowed();
        } else {
            $alt = esc_attr( Control_Media::get_image_alt( $settings['premium_counter_image_upload'] ) );
            
            $this->add_render_attribute( 'image', 'class', 'custom-image' );
            $this->add_render_attribute( 'image', 'src', $settings['premium_counter_image_upload']['url'] );
            $this->add_render_attribute( 'image', 'alt', $alt );
        }
        
        $flex_width = '';
 		if( $settings['premium_counter_icon_image'] == 'custom' && $settings['premium_counter_icon_style'] == 'simple' ) {
 			$flex_width = ' flex-width ';
 		}
        
        ?>

        <div class="premium-counter-icon <?php echo $direction; ?>">
            
            <span class="icon<?php echo $flex_width; ?><?php echo $icon_style; ?>" data-animation="<?php echo $animation; ?>">
            
                <?php if( $settings['premium_counter_icon_image'] === 'icon' ) {
        
                    if ( $is_new || $migrated ) :
                        Icons_Manager::render_icon( $settings['premium_counter_icon_updated'], [ 'aria-hidden' => 'true' ] );
                    else: ?>
                        <i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
                    <?php endif;
                } else { ?>
                    <img <?php echo $this->get_render_attribute_string('image'); ?>>
                <?php } ?>
            
            </span>
        </div>

    <?php
    }

	protected function render() {
        
		$settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes('premium_counter_title');
         
		$position = $settings['premium_counter_icon_position'];
		
        $center = $position == 'top' ? ' center' : '';
        
        $left = $position == 'left' ? ' left' : '';
        
 		$flex_width = '';
 		if( $settings['premium_counter_icon_image'] == 'custom' && $settings['premium_counter_icon_style'] == 'simple' ) {
 			$flex_width = ' flex-width ';
 		}
        
        $this->add_render_attribute( 'counter', [
                'class' 			=> [ 'premium-counter', 'premium-counter-area' . $center ],
				'data-duration' 	=> $settings['premium_counter_speed'] * 1000,
				'data-from-value' 	=> $settings['premium_counter_start_value'],
				'data-to-value' 	=> $settings['premium_counter_end_value'],
                'data-delimiter'	=> $settings['premium_counter_t_separator'],
                'data-rounding' 	=> empty ( $settings['premium_counter_d_after'] ) ? 0  : $settings['premium_counter_d_after']
            ]
        );

		?>

        <div <?php echo $this->get_render_attribute_string('counter'); ?>>
            <?php if( $position == 'right' ) {
                $this->get_counter_content( $settings, $position );
                if( ! empty( $settings['premium_counter_icon_updated']['value'] ) || ! empty( $settings['premium_counter_icon'] ) || ! empty( $settings['premium_counter_image_upload']['url'] ) ) {
                    $this->get_counter_icon( $settings, $position );
                }
            
            } else { 
                if( ! empty( $settings['premium_counter_icon_updated']['value'] ) || ! empty( $settings['premium_counter_icon'] ) || ! empty( $settings['premium_counter_image_upload']['url'] ) ) {
                    $this->get_counter_icon( $settings, $left );
                } 
                $this->get_counter_content( $settings, $left );
            ?>

            <?php } ?>

        </div>

		<?php
	}
    
    protected function _content_template() {
        ?>
        <#
            
            var iconImage,
                position,
                center,
                left;
                
        
            view.addInlineEditingAttributes('title');
            
            position = settings.premium_counter_icon_position;

            center = 'top' === position ? ' center' : '';

            left = 'left' === center ? ' left' : '';

            var delimiter = settings.premium_counter_t_separator,
                round     = '' === settings.premium_counter_d_after ? 0 : settings.premium_counter_d_after;
            
            view.addRenderAttribute( 'counter', 'class', [ 'premium-counter', 'premium-counter-area' + center ] );
            view.addRenderAttribute( 'counter', 'data-duration', settings.premium_counter_speed * 1000 );
			view.addRenderAttribute( 'counter', 'data-from-value', settings.premium_counter_start_value );
            view.addRenderAttribute( 'counter', 'data-to-value', settings.premium_counter_end_value );
            view.addRenderAttribute( 'counter', 'data-delimiter', delimiter );
            view.addRenderAttribute( 'counter', 'data-rounding', round );
            
            function getCounterContent( direction ) {
            
                var startValue = settings.premium_counter_start_value;
                
                view.addRenderAttribute( 'counter_wrap', 'class', [ 'premium-init-wrapper', direction ] );
                
                view.addRenderAttribute( 'value', 'id', 'counter-' + view.getID() );
                
                view.addRenderAttribute( 'value', 'class', 'premium-counter-init' );
                
            #>
            
                <div {{{ view.getRenderAttributeString('counter_wrap') }}}>

                    <# if ( '' !== settings.premium_counter_preffix ) { #>
                        <span id="prefix" class="counter-su-pre">{{{ settings.premium_counter_preffix }}}</span>
                    <# } #>

                    <span {{{ view.getRenderAttributeString('value') }}}>{{{ startValue }}}</span>

                    <# if ( '' !== settings.premium_counter_suffix ) { #>
                        <span id="suffix" class="counter-su-pre">{{{ settings.premium_counter_suffix }}}</span>
                    <# } #>

                    <# if ( '' !== settings.premium_counter_title ) { #>
                        <h4 class="premium-counter-title">
                            <div {{{ view.getRenderAttributeString('title') }}}>
                                {{{ settings.premium_counter_title }}}
                            </div>
                        </h4>
                    <# } #>
                </div>
            
            <#
            }
            
            function getCounterIcon( direction ) {
            
                var iconStyle = 'simple' !== settings.premium_counter_icon_style ? ' icon-bg ' + settings.premium_counter_icon_style : '',
                    animation = settings.premium_counter_icon_animation,
                    flexWidth = '';
                
                var iconHTML = elementor.helpers.renderIcon( view, settings.premium_counter_icon_updated, { 'aria-hidden': true }, 'i' , 'object' ),
                    migrated = elementor.helpers.isIconMigrated( settings, 'premium_counter_icon_updated' );
                    
                if( 'custom' === settings.premium_counter_icon_image && 'simple' ===  settings.premium_counter_icon_style ) {
                    flexWidth = ' flex-width ';
                }
                
                view.addRenderAttribute( 'icon_wrap', 'class', [ 'premium-counter-icon', direction ] );
                
                var iconClass = 'icon' + flexWidth + iconStyle;
            
            #>

            <div {{{ view.getRenderAttributeString('icon_wrap') }}}>
                <span data-animation="{{ animation }}" class="{{ iconClass }}">
                    <# if( 'icon' === settings.premium_counter_icon_image ) {
                        if ( iconHTML && iconHTML.rendered && ( ! settings.premium_counter_icon || migrated ) ) { #>
                            {{{ iconHTML.value }}}
                        <# } else { #>
                            <i class="{{ settings.premium_counter_icon }}" aria-hidden="true"></i>
                        <# } #>
                    <# } else { #>
                        <img class="custom-image" src="{{ settings.premium_counter_image_upload.url }}">
                    <# } #>
                </span>
            </div>
            
            <#
            }
           
        #>
        
        <div {{{ view.getRenderAttributeString('counter') }}}>
            <# if( 'right' === position  ) {
            
                getCounterContent( position );
                
                if(  '' !== settings.premium_counter_icon_updated.value || '' !== settings.premium_counter_icon || '' !== settings.premium_counter_image_upload.url ) {
                    getCounterIcon( position );
                }
            
            } else {
            
                if(  '' !== settings.premium_counter_icon_updated.value || '' !== settings.premium_counter_icon || '' !== settings.premium_counter_image_upload.url ) {
                    getCounterIcon( position );
                }
                
                getCounterContent( position );
            
            } #>
        </div>
        
        <?php
    }
}