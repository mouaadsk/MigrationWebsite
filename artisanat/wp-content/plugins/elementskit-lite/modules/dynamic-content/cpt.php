<?php 
namespace ElementsKit\Modules\Dynamic_Content;

defined( 'ABSPATH' ) || exit;

class Cpt{

    public function __construct() {
        $this->post_type();  
    }

    public function post_type() {
        
        $labels = array(
            'name'                  => _x( 'Elementskit items', 'Post Type General Name', 'elementskit' ),
            'singular_name'         => _x( 'Elementskit item', 'Post Type Singular Name', 'elementskit' ),
            'menu_name'             => esc_html__( 'Elementskit item', 'elementskit' ),
            'name_admin_bar'        => esc_html__( 'Elementskit item', 'elementskit' ),
            'archives'              => esc_html__( 'Item Archives', 'elementskit' ),
            'attributes'            => esc_html__( 'Item Attributes', 'elementskit' ),
            'parent_item_colon'     => esc_html__( 'Parent Item:', 'elementskit' ),
            'all_items'             => esc_html__( 'All Items', 'elementskit' ),
            'add_new_item'          => esc_html__( 'Add New Item', 'elementskit' ),
            'add_new'               => esc_html__( 'Add New', 'elementskit' ),
            'new_item'              => esc_html__( 'New Item', 'elementskit' ),
            'edit_item'             => esc_html__( 'Edit Item', 'elementskit' ),
            'update_item'           => esc_html__( 'Update Item', 'elementskit' ),
            'view_item'             => esc_html__( 'View Item', 'elementskit' ),
            'view_items'            => esc_html__( 'View Items', 'elementskit' ),
            'search_items'          => esc_html__( 'Search Item', 'elementskit' ),
            'not_found'             => esc_html__( 'Not found', 'elementskit' ),
            'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'elementskit' ),
            'featured_image'        => esc_html__( 'Featured Image', 'elementskit' ),
            'set_featured_image'    => esc_html__( 'Set featured image', 'elementskit' ),
            'remove_featured_image' => esc_html__( 'Remove featured image', 'elementskit' ),
            'use_featured_image'    => esc_html__( 'Use as featured image', 'elementskit' ),
            'insert_into_item'      => esc_html__( 'Insert into item', 'elementskit' ),
            'uploaded_to_this_item' => esc_html__( 'Uploaded to this item', 'elementskit' ),
            'items_list'            => esc_html__( 'Items list', 'elementskit' ),
            'items_list_navigation' => esc_html__( 'Items list navigation', 'elementskit' ),
            'filter_items_list'     => esc_html__( 'Filter items list', 'elementskit' ),
        );
        $rewrite = array(
            'slug'                  => 'elementskit-content',
            'with_front'            => true,
            'pages'                 => false,
            'feeds'                 => false,
        );
        $args = array(
            'label'                 => esc_html__( 'Elementskit item', 'elementskit' ),
            'description'           => esc_html__( 'elementskit_content', 'elementskit' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'elementor', 'permalink' ),
            'hierarchical'          => true,
            'public'                => true,
            'show_ui'               => false,
            'show_in_menu'          => false,
            'menu_position'         => 5,
            'show_in_admin_bar'     => false,
            'show_in_nav_menus'     => false,
            'can_export'            => true,
            'has_archive'           => false,
            'publicly_queryable' => true,
            'rewrite'               => $rewrite,
            'query_var' => true,
            'exclude_from_search'   => true,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
            'rest_base'             => 'elementskit-content',
        );
        register_post_type( 'elementskit_content', $args );
    }

    public function flush_rewrites() {
        $this->post_type();
        flush_rewrite_rules();
    }
}