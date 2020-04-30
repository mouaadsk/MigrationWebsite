<?php
namespace Elementor;

use \ElementsKit\Elementskit_Widget_Post_Grid_Handler as Handler;
use \ElementsKit\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Elementskit_Widget_Post_Grid extends Widget_Base {
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
            'content_tab',
            [
                'label' => esc_html__('Widget settings', 'elementskit'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'post_cat',
            [
                'label' =>esc_html__('Select Categories', 'elementskit'),
                'type'      => ElementsKit_Controls_Manager::AJAXSELECT2,
                'description'	=> esc_html__('To avail this option you need to set/add a featured image to posts..', 'elementskit'),
                'options'   =>'ajaxselect2/category',
                'label_block' => true,
                'multiple'  => true,
            ]
        );
        $this->add_control(
            'post_count',
            [
              'label'         => esc_html__( 'Post count', 'elementskit' ),
              'type'          => Controls_Manager::NUMBER,
              'default'       => esc_html__( '3', 'elementskit' )
            ]
          );

          $this->add_responsive_control(
            'count_col',
            [
                'label'     => esc_html__( 'Select Column', 'elementskit' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'ekit___column-2',
                'tablet_default' => 'ekit___column-2',
                'mobile_default' => 'ekit___column-2',
                'options'   => [
                      'ekit___column-2'     => esc_html__( '2 Column', 'elementskit' ),
                      'ekit___column-3'     => esc_html__( '3 Column', 'elementskit' ),
                      'ekit___column-4'     => esc_html__( '4 Column', 'elementskit' ),
                ],
            ]
        );
        $this->end_controls_section();

        // Style
        $this->start_controls_section(
            'style_tab',
            [
                'label' => esc_html__( 'Grid Styles', 'elementskit' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
			'post_grid_item_height',
			[
				'label'         => esc_html__( 'Use Fixed Height', 'elementskit' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px' ],
				'range'         => [
					'px' => [
						'min' => 30,
						'max' => 1000,
						'step' => 1,
					]
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 350,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 200,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 150,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .post_grid_img_thumb' => 'height: {{SIZE}}{{UNIT}};',
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
        $settings = $this->get_settings();

        extract($settings);

        $query = array(
            'post_type'         => 'post',
            'post_status'       => 'publish',
            'cat'               => $post_cat,
            'posts_per_page'    => $post_count,
        ); 
        
        $this->add_render_attribute(
            [
                'ekit-single-item' => [
                    'class' => [
                        'tab__post__single--item',
                        $count_col,
                        'tablet-' . $settings['count_col_tablet'],
                        'mobile-' . $settings['count_col_mobile'],
                        'post-count-' . $post_count
                    ],
                ],
            ]
        );

        ?>

        <div class="ekit--tab__post__details ekit--post_grid">
            <?php $xs_query = new \WP_Query( $query ); ?>
            <?php  if($xs_query->have_posts()): ?>
                <?php while ($xs_query->have_posts()) : ?>
                    <?php $xs_query->the_post(); ?>
                    <?php if(has_post_thumbnail()): ?>
                        <div <?php echo $this->get_render_attribute_string('ekit-single-item'); ?>>
                            <a href="<?php echo get_the_permalink(); ?>" class="tab__post--header">
                                <?php $img_url = get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>
                                <div class="post_grid_img_thumb" style="background-image: url('<?php echo esc_url($img_url); ?>')"></div>
                                <?php if(get_post_format()  == 'video') : ?>
                                    <div class="tab__post--icon">
                                        <span class="fa fa-play-circle-o"></span>
                                    </div>
                                <?php endif; ?>
                            </a>
                            <h3 class="tab__post--title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        </div>
                    <?php endif; ?>
                    
                <?php endwhile;
            endif;
            wp_reset_postdata(); ?>
        </div>
    <?php 
    }
    protected function _content_template() { }
}

?>