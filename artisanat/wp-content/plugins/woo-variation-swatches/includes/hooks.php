<?php
	
	defined( 'ABSPATH' ) or die( 'Keep Quit' );
	
	
	add_action( 'wp_ajax_nopriv_wvs_get_available_variations', 'wvs_get_available_product_variations' );
	
	add_action( 'wp_ajax_wvs_get_available_variations', 'wvs_get_available_product_variations' );
	
	add_filter( 'product_attributes_type_selector', 'wvs_product_attributes_types' );
	
	add_action( 'init', 'wvs_settings', 2 );
	
	add_action( 'admin_init', 'wvs_add_product_taxonomy_meta' );
	
	// From WC 3.6+
	if ( defined( 'WC_VERSION' ) && version_compare( '3.6', WC_VERSION, '<=' ) ) {
		add_action( 'woocommerce_product_option_terms', 'wvs_product_option_terms', 20, 3 );
	} else {
		add_action( 'woocommerce_product_option_terms', 'wvs_product_option_terms_old', 20, 2 );
	}
	
	// Dokan Support
	add_action( 'dokan_product_option_terms', 'dokan_support_wvs_product_option_terms', 20, 2 );
	
	add_filter( 'woocommerce_ajax_variation_threshold', 'wvs_ajax_variation_threshold', 8 );
	
	add_filter( 'woocommerce_dropdown_variation_attribute_options_html', 'wvs_variation_attribute_options_html', 200, 2 );
	
	// Add WooCommerce Default Image
	add_filter( 'wp_get_attachment_image_attributes', function ( $attr ) {
		if ( ! is_admin() ) {
			$classes = (array) explode( ' ', $attr[ 'class' ] );
			
			array_push( $classes, 'wp-post-image' );
			
			$attr[ 'class' ] = implode( ' ', array_unique( $classes ) );
		}
		
		
		return $attr;
	}, 9 );
	
	add_filter( 'script_loader_tag', function ( $tag, $handle, $src ) {
		
		$defer_load_js = (bool) woo_variation_swatches()->get_option( 'defer_load_js' );
		
		if ( $defer_load_js ) {
			$handles = array( 'woo-variation-swatches-pro', 'wc-add-to-cart-variation', 'woo-variation-swatches' );
			
			if ( ! wp_is_mobile() && in_array( $handle, $handles ) && ( strpos( $tag, 'plugins' . DIRECTORY_SEPARATOR . 'woo-variation-swatches' ) !== false ) ) {
				return str_ireplace( ' src=', ' defer src=', $tag );
			}
		}
		
		return $tag;
		
	}, 10, 3 );
	
	if ( ! class_exists( 'Woo_Variation_Swatches_Pro' ) ) {
		add_filter( 'woocommerce_product_data_tabs', 'add_wvs_pro_preview_tab' );
		
		add_filter( 'woocommerce_product_data_panels', 'add_wvs_pro_preview_tab_panel' );
	}
	
	add_action( 'woocommerce_save_product_variation', function ( $variation_id ) {
		$product        = wc_get_product( $variation_id );
		$product_id     = $product->get_parent_id();
		$attribute_keys = array_keys( $product->get_variation_attributes() );
		
		foreach ( $attribute_keys as $attribute_id ) {
			$archive_transient_name = 'wvs_attribute_html_archive_' . $product_id . "_" . $attribute_id;
			$product_transient_name = 'wvs_attribute_html_' . $product_id . "_" . $attribute_id;
			delete_transient( $archive_transient_name );
			delete_transient( $product_transient_name );
		}
	} );
	
	add_action( 'woocommerce_update_product_variation', function ( $variation_id ) {
		$product        = wc_get_product( $variation_id );
		$product_id     = $product->get_parent_id();
		$attribute_keys = array_keys( $product->get_variation_attributes() );
		
		foreach ( $attribute_keys as $attribute_id ) {
			$archive_transient_name = 'wvs_attribute_html_archive_' . $product_id . "_" . $attribute_id;
			$product_transient_name = 'wvs_attribute_html_' . $product_id . "_" . $attribute_id;
			delete_transient( $archive_transient_name );
			delete_transient( $product_transient_name );
		}
	} );
	
	add_action( 'woocommerce_delete_product_transients', function ( $product_id ) {
		
		$product = wc_get_product( $product_id );
		
		if ( $product && $product->is_type( 'variable' ) ) {
			$attribute_keys = array_keys( $product->get_variation_attributes() );
			
			foreach ( $attribute_keys as $attribute_id ) {
				$archive_transient_name = 'wvs_attribute_html_archive_' . $product_id . "_" . wc_variation_attribute_name( $attribute_id );
				$product_transient_name = 'wvs_attribute_html_' . $product_id . "_" . wc_variation_attribute_name( $attribute_id );
				delete_transient( $archive_transient_name );
				delete_transient( $product_transient_name );
			}
		}
	} );
	
	// Clean transient
	add_action( 'woocommerce_attribute_updated', function ( $attribute_id, $attribute, $old_attribute_name ) {
		$transient     = sprintf( 'wvs_get_wc_attribute_taxonomy_%s', wc_attribute_taxonomy_name( $attribute[ 'attribute_name' ] ) );
		$old_transient = sprintf( 'wvs_get_wc_attribute_taxonomy_%s', wc_attribute_taxonomy_name( $old_attribute_name ) );
		delete_transient( $transient );
		delete_transient( $old_transient );
	}, 20, 3 );
	
	// Clean transient
	add_action( 'woocommerce_attribute_deleted', function ( $attribute_id, $attribute_name, $taxonomy ) {
		$transient = sprintf( 'wvs_get_wc_attribute_taxonomy_%s', $taxonomy );
		delete_transient( $transient );
	}, 20, 3 );
	
	// Clean transient
	add_action( 'woocommerce_attribute_added', function ( $attribute_id, $attribute ) {
		$transient = sprintf( 'wvs_get_wc_attribute_taxonomy_%s', wc_attribute_taxonomy_name( $attribute[ 'attribute_name' ] ) );
		delete_transient( $transient );
	}, 20, 2 );
	