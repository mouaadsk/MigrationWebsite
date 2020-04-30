<?php
namespace Elementor;

use \ElementsKit\Elementskit_Widget_Header_Info_Handler as Handler;
use \ElementsKit\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Elementskit_Widget_Header_Info extends Widget_Base
{
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

    protected function _register_controls()
    {

        $this->start_controls_section(
            'ekit_header_info',
            [
                'label' => esc_html__('Header Info', 'elementskit'),
            ]
        );

        $headerinfogroup = new Repeater();
        $headerinfogroup->add_control(
            'ekit_headerinfo_icons',
            [
                'label' => esc_html__('Icon', 'elementskit'),
                'label_block' => true,
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'ekit_headerinfo_icon',
                'default' => [
                    'value' => 'icon icon-facebook',
                    'library' => 'ekiticons',
                ],

            ]
        );

        $headerinfogroup->add_control(
            'ekit_headerinfo_text',
            [
                'label' => esc_html__('Text', 'elementskit'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => '463 7th Ave, NY 10018, USA',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        $headerinfogroup->add_control(
            'ekit_headerinfo_link',
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
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'ekit_headerinfo_group',
            [
                'label' => esc_html__( 'Header Info', 'elementskit' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $headerinfogroup->get_controls(),
                'default' => [
                    [
                        'ekit_headerinfo_text' => esc_html__( '463 7th Ave, NY 10018, USA', 'elementskit' ),

                    ],

                ],
                'title_field' => '{{{ ekit_headerinfo_text }}}',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'ekit_header_icon_style',
            [
                'label' => esc_html__( 'Header Info', 'elementskit' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'ekit_info_item_margin',
			[
				'label' => esc_html__( 'Margin', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ekit-header-info > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
        
        $this->add_responsive_control(
			'ekit_info_item_padding',
			[
				'label' => esc_html__( 'Padding', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ekit-header-info > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'ekit_info_text_color',
            [
                'label' => esc_html__( 'Text Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ekit-header-info > li > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'elementskit_content_typography',
                'label' => esc_html__( 'Typography', 'elementskit' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .ekit-header-info > li > a',
            ]
        );

        $this->add_control(
            'ekit_info_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ekit-header-info > li > a i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ekit-header-info > li > a svg path'   => 'stroke: {{VALUE}}; fill: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control(
            'ekit_simple_tab_title_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 5,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .ekit-header-info > li > a i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ekit-header-info > li > a svg' => 'max-width: {{SIZE}}{{UNIT}}; height: auto',
                ],
            ]
        );
        $this->add_responsive_control(
            'ekit_info_icon_spacing',
            [
                'label' => esc_html__( 'Icon Spacing', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ekit-header-info > li > a i, {{WRAPPER}} .ekit-header-info > li > a svg' => 'margin-right: {{SIZE}}{{UNIT}};',
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



        ?>
        <ul class="ekit-header-info">
            <?php
        if ( $settings['ekit_headerinfo_group'] ){
            foreach (  $settings['ekit_headerinfo_group'] as $item ){

                $target = $item['ekit_headerinfo_link']['is_external'] ? ' target="_blank"' : '';
                $nofollow = $item['ekit_headerinfo_link']['nofollow'] ? ' rel="nofollow"' : '';
                ?>
                    <li>
                        <a href="<?php echo esc_url($item['ekit_headerinfo_link']['url']);?>">

                            <?php
                                // new icon
                                $migrated = isset( $item['__fa4_migrated']['ekit_headerinfo_icons'] );
                                // Check if its a new widget without previously selected icon using the old Icon control
                                $is_new = empty( $item['ekit_headerinfo_icon'] );
                                if ( $is_new || $migrated ) {
                                    // new icon
                                    Icons_Manager::render_icon( $item['ekit_headerinfo_icons'], [ 'aria-hidden' => 'true' ] );
                                } else {
                                    ?>
                                    <i class="<?php echo esc_attr($item['ekit_headerinfo_icon']); ?>" aria-hidden="true"></i>
                                    <?php
                                }
                            ?>

                            <?php echo esc_html($item['ekit_headerinfo_text']);?>
                        </a>
                    </li>

                <?php


            }
        }
        ?>

        </ul>
<?php




    }
    protected function _content_template() { }






}