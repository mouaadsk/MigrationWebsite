<?php

defined( 'ABSPATH' ) || exit;
/**
 * Plugin Name: ElementsKit Lite
 * Description: The most advanced addons for Elementor with tons of widgets, Header builder, Footer builder, Mega menu builder, layout pack and powerful custom controls.
 * Plugin URI: https://wpmet.com/
 * Author: Wpmet
 * Version: 1.5.0
 * Author URI: https://products.wpmet.com/elementskit
 *
 * Text Domain: elementskit
 *
 * @package ElementsKit
 * @category Free
 *
 * Elementskit is a powerful addon for Elementor page builder.
 * It includes most comprehensive modules, such as "header footer builder", "mega menu", 
 * "layout installer", "quick form builder" etc under the hood.
 * It has a tons of widgets to create any sites with an ease. It has some most unique 
 * and powerful custom controls for elementor, such as "image picker", "ajax select", "widget area".
 *
 */

register_activation_hook(__FILE__, function(){
	include_once plugin_dir_path( __FILE__ ) . 'autoloader.php';
	include_once plugin_dir_path( __FILE__ ) . 'core/hook-activation.php';
});

add_action('plugins_loaded', function(){
	include_once plugin_dir_path( __FILE__ ) . 'core.php';
}, 112);