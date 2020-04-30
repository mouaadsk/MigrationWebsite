<?php
namespace Elementor;

use \ElementsKit\Elementskit_Widget_Post_List_Handler as Handler;
use \ElementsKit\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if (! defined( 'ABSPATH' ) ) exit;

class Elementskit_Widget_Post_List extends Widget_Base {
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
            'section_layout_options',
            [
                'label' => esc_html__( 'Show post by:', 'elementskit' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'selected',
				'options' => [
					'recent'           => esc_html__( 'Recent Post', 'elementskit' ),
					'popular'          => esc_html__( 'Popular Post', 'elementskit' ),
					'selected'         => esc_html__( 'Selected Post', 'elementskit' ),
				],

            ]
		);
		
		$this->add_control(
			'section_recent_post_limit',
			[
				'label'   => esc_html__( 'Product Limit', 'elementskit' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 5,
				'condition'	=> [
					'section_layout_options'	=> ['recent', 'popular']
				]
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
			'link',
			[
                'label' =>esc_html__('Select Post', 'elementskit'),
                'type'      => ElementsKit_Controls_Manager::AJAXSELECT2,
                'options'   =>'ajaxselect2/post_list',
                'label_block' => true,
                'multiple'  => false,
			]
		);

		$this->add_control(
			'icon_list',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{ text }}',
				'condition'	=> [
					'section_layout_options'	=> 'selected'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ekit_post_list_settings_tab',
			[
				'label' => esc_html__( 'Settings', 'elementskit' ),
				'tab' => Controls_Manager::TAB_CONTENT,
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

		$this->add_control(
			'show_feature_image',
			[
				'label' => esc_html__( 'Show Featured Image', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementskit' ),
				'label_off' => esc_html__( 'Hide', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'show_post_icon',
			[
				'label' => esc_html__( 'Show Icon', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementskit' ),
				'label_off' => esc_html__( 'Hide', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition'	=> [
					'show_feature_image!'	=> 'yes'
				]
			]
		);

		$this->add_control(
			'icons',
			[
				'label' => esc_html__( 'Icon', 'elementskit' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'fa4compatibility' => 'icon',
				'default'	=> [
					'value'	=> 'far fa-circle',
					'library'	=> 'regular'
				],
				'condition'	=> [
					'show_post_icon'		=> 'yes',
					'show_feature_image!'	=> 'yes'
				]
			]
		);

		$this->add_control(
			'show_post_meta',
			[
				'label' => esc_html__( 'Show Meta', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementskit' ),
				'label_off' => esc_html__( 'Hide', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		
		$this->add_control(
			'show_date_meta',
			[
				'label' => esc_html__( 'Show Date Meta', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementskit' ),
				'label_off' => esc_html__( 'Hide', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'show_post_meta' => 'yes',
				]
			]
		);

		$this->add_control(
			'date_meta__icons',
			[
				'label' => __( 'Date Meta Icon', 'elementskit' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'date_meta__icon',
                'default' => [
                    'value' => 'icon icon-calendar-page-empty',
                    'library' => 'ekiticons',
                ],
				'condition' => [
					'show_post_meta' => 'yes',
					'show_date_meta' => 'yes',
				]
			]
		);
		
		$this->add_control(
			'show_category_meta',
			[
				'label' => esc_html__( 'Show Category Meta', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementskit' ),
				'label_off' => esc_html__( 'Hide', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'show_post_meta' => 'yes',
				]
			]
		);

		$this->add_control(
			'category_meta__icons',
			[
				'label' => __( 'Category Meta Icon', 'elementskit' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'category_meta__icon',
                'default' => [
                    'value' => 'icon icon-folder',
                    'library' => 'ekiticons',
                ],
				'condition' => [
					'show_post_meta' => 'yes',
					'show_category_meta' => 'yes',
				]
			]
		);

		$this->add_control(
			'post_meta_position',
			[
				'label' => esc_html__( 'Meta Position', 'elementskit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'top_position',
				'options' => [
					'top_position'  => esc_html__( 'Top', 'elementskit' ),
					'bottom_position' => esc_html__( 'Bottom', 'elementskit' ),
				],
				'condition' => [
					'show_post_meta' => 'yes',
				]
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
			'space_between',
			[
				'label' => esc_html__( 'Space Between', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:last-child)' => 'padding-bottom: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:first-child)' => 'margin-top: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item' => 'margin-right: calc({{SIZE}}{{UNIT}}/2); margin-left: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .elementor-icon-list-items.elementor-inline-items' => 'margin-right: calc(-{{SIZE}}{{UNIT}}/2); margin-left: calc(-{{SIZE}}{{UNIT}}/2)',
					'body.rtl {{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item:after' => 'left: calc(-{{SIZE}}{{UNIT}}/2)',
					'body:not(.rtl) {{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item:after' => 'right: calc(-{{SIZE}}{{UNIT}}/2)',
				],
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
				'condition'	=> [
					'show_feature_image!'	=> 'yes',
				]
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-icon-list-icon svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label' => esc_html__( 'Hover', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-icon svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};',
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
				'default'	=> [
					'size'	=> 10
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
			'ekit_post_list_meta_style_tab',
			[
				'label' => esc_html__( 'Meta', 'elementskit' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_post_meta' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ekit_post_list_meta_content_typography',
				'label' => esc_html__( 'Typography', 'elementskit' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .elementor-icon-list-item .meta-lists > span',
			]
		);

		$this->add_responsive_control(
            'ekit_post_list_meta_content_icon_size',
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
                    '{{WRAPPER}} .elementor-icon-list-item .meta-lists > span i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-icon-list-item .meta-lists > span svg' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
			'ekit_post_list_meta_content_padding',
			[
				'label' => esc_html__( 'Padding', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item .meta-lists > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_post_list_meta_content_margin',
			[
				'label' => esc_html__( 'Margin', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item .meta-lists > span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->start_controls_tabs( 'ekit_post_list_normal_and_hover_tabs' );

		$this->start_controls_tab(
			'ekit_post_list_normal_tab',
			[
				'label' =>esc_html__( 'Normal', 'elementskit' ),
			]
		);

		$this->add_responsive_control(
			'ekit_post_list_meta_content_color',
			[
				'label' => esc_html__( 'Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#7f8595',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item .meta-lists > span' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-icon-list-item .meta-lists svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};'
				],
			]
		);

		$this->add_responsive_control(
			'ekit_post_list_meta_content_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item .meta-lists > span' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_post_list_meta_content_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item .meta-lists > span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ekit_post_list_hover_tab',
			[
				'label' =>esc_html__( 'Hover', 'elementskit' ),
			]
		);

		$this->add_responsive_control(
			'ekit_post_list_meta_content_color_hover',
			[
				'label' => esc_html__( 'Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item .meta-lists > span:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .elementor-icon-list-item .meta-lists > span:hover svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};'
				],
			]
		);

		$this->add_responsive_control(
			'ekit_post_list_meta_content_bg_color_hover',
			[
				'label' => esc_html__( 'Background Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item .meta-lists > span:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_post_list_meta_content_border_radius_hover',
			[
				'label' => esc_html__( 'Border Radius', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item .meta-lists > span:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	
	private function post_list($post, $item = null) {
		$settings = $this->get_settings_for_display();
		$categories = get_the_category($post->ID);
		$text = empty($item['text']) ? $post->post_title : $item['text'];

		ob_start();
		?>
			<li class="elementor-icon-list-item" >
				<a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
					<?php 
						if ($settings['show_feature_image'] == 'yes') {
							echo get_the_post_thumbnail($post->ID, 'full');
						} else {
							if ( $settings['show_post_icon'] === 'yes' ) { ?>
								<span class="elementor-icon-list-icon">
									<?php
										// new icon
										$migrated = isset( $settings['__fa4_migrated']['icons'] );
										// Check if its a new widget without previously selected icon using the old Icon control
										$is_new = empty( $settings['icon'] );
										if ( $is_new || $migrated ) {
											// new icon
											Icons_Manager::render_icon( $settings['icons'], [ 'aria-hidden' => 'true' ] );
										} else {
											?>
											<i class="<?php echo esc_attr($settings['icon']); ?>" aria-hidden="true"></i>
											<?php
										}
									?>
								</span>
							<?php }
						}
					?>
					<div class="ekit_post_list_content_wraper">
						<?php if ($settings['show_post_meta'] == 'yes') { 
							if ($settings['post_meta_position'] == 'top_position') {
						?>
						<?php if ($settings['show_date_meta'] == 'yes' || $settings['show_category_meta'] == 'yes') { ?>
						<div class="meta-lists">
							<?php if ($settings['show_date_meta'] == 'yes') { ?>
							<span class="meta-date">

								<?php
									// new icon
									$migrated = isset( $settings['__fa4_migrated']['date_meta__icons'] );
									// Check if its a new widget without previously selected icon using the old Icon control
									$is_new = empty( $settings['date_meta__icon'] );
									if ( $is_new || $migrated ) {
										// new icon
										Icons_Manager::render_icon( $settings['date_meta__icons'], [ 'aria-hidden' => 'true' ] );
									} else {
										?>
										<i class="<?php echo esc_attr($settings['date_meta__icon']); ?>" aria-hidden="true"></i>
										<?php
									}
								?>

								<?php echo get_the_date("d M Y", $post->ID); ?>
							</span>
							<?php }; ?>

							<?php 
								if ($settings['show_category_meta'] == 'yes') {
									$counter = 0;
									?>
									<span class="meta-category">
									<?php if (!empty($settings['category_meta__icons'])) { ?>

										<?php
											// new icon
											$migrated = isset( $settings['__fa4_migrated']['category_meta__icons'] );
											// Check if its a new widget without previously selected icon using the old Icon control
											$is_new = empty( $settings['category_meta__icon'] );
											if ( $is_new || $migrated ) {
												// new icon
												Icons_Manager::render_icon( $settings['category_meta__icons'], [ 'aria-hidden' => 'true' ] );
											} else {
												?>
												<i class="<?php echo esc_attr($settings['category_meta__icon']); ?>" aria-hidden="true"></i>
												<?php
											}
										?>

									<?php }
										echo (isset($categories[0])) ? esc_html( $categories[0]->name ) : 0;
									?>
									</span>
									<?php
								}
							?>
						</div>
						<?php 
						};
							}; 
						};
						?>

						<span class="elementor-icon-list-text"><?php echo esc_html($text, 'elementskit'); ?></span>

						<?php if ($settings['show_post_meta'] == 'yes') { 
							if ($settings['post_meta_position'] == 'bottom_position') {
						?>
						<?php if ($settings['show_date_meta'] == 'yes' || $settings['show_category_meta'] == 'yes') { ?>
						<div class="meta-lists">
							<?php if ($settings['show_date_meta'] == 'yes') { ?>
							<span class="meta-date">
								<?php
									// new icon
									$migrated = isset( $settings['__fa4_migrated']['date_meta__icons'] );
									// Check if its a new widget without previously selected icon using the old Icon control
									$is_new = empty( $settings['date_meta__icon'] );
									if ( $is_new || $migrated ) {
										// new icon
										Icons_Manager::render_icon( $settings['date_meta__icons'], [ 'aria-hidden' => 'true' ] );
									} else {
										?>
										<i class="<?php echo esc_attr($settings['date_meta__icon']); ?>" aria-hidden="true"></i>
										<?php
									}
								?>	

								<?php echo get_the_date("d M Y", $post->ID); ?>
							</span>
							<?php }; ?>

							<?php 
								if ($settings['show_category_meta'] == 'yes') {
									$counter = 0;
									?>
									<span class="meta-category">
									<?php if (!empty($settings['category_meta__icons'])) { ?>
										<?php
											// new icon
											$migrated = isset( $settings['__fa4_migrated']['category_meta__icons'] );
											// Check if its a new widget without previously selected icon using the old Icon control
											$is_new = empty( $settings['category_meta__icon'] );
											if ( $is_new || $migrated ) {
												// new icon
												Icons_Manager::render_icon( $settings['category_meta__icons'], [ 'aria-hidden' => 'true' ] );
											} else {
												?>
												<i class="<?php echo esc_attr($settings['category_meta__icon']); ?>" aria-hidden="true"></i>
												<?php
											}
										?>
									<?php }
									echo esc_html( $categories[0]->name ); ?>
									</span>
									<?php
								}
							?>
						</div>
						<?php 
						};
							}; 
						};
						?>
					</div>
				</a>
			</li>
		<?php
		return ob_get_clean();
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
		<ul <?php echo \ElementsKit\Utils::render($this->get_render_attribute_string( 'icon_list' )); ?>>
			<?php
			$post_args = array(
				'post_type'			=> 'post',
				'posts_per_page'	=> esc_html($settings['section_recent_post_limit'])
			);
			if($settings['section_layout_options'] === 'popular'){
				$post_args['meta_key']	= 'ekit_post_views_count';
				$post_args['orderby'] 	= 'meta_value_num';
				$post_args['order']		= 'DESC';
			}
			$posts = get_posts($post_args);

			
			
			if($settings['section_layout_options'] === 'recent' || $settings['section_layout_options'] === 'popular'){
				if(count($posts) > 0){
					foreach($posts as $post){
						echo $this->post_list($post);
					}
				} else {
					_e('Opps, No posts were found.', 'elementskit');
				}
			} else {
				foreach ( $settings['icon_list'] as $index => $item ) {
					$post = !empty( $item['link'] ) ? get_post($item['link']) : 0;
					if($post != null){ echo $this->post_list($post, $item); };
				};
			}
			
			?>
		</ul>
		<?php
	}


}
