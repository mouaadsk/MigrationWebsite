<?php
/**
 * Copyright (c) Facebook, Inc. and its affiliates. All Rights Reserved
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 *
 * @package FacebookCommerce
 */

namespace SkyVerge\WooCommerce\Facebook;

defined( 'ABSPATH' ) or exit;

/**
 * Admin handler.
 *
 * @since 1.10.0
 */
class Admin {


	/**
	 * Admin constructor.
	 *
	 * @since 1.10.0
	 */
	public function __construct() {

		// enqueue admin scripts
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

		$integration = facebook_for_woocommerce()->get_integration();

		// only alter the admin UI if the plugin is connected to Facebook and ready to sync products
		if ( ! $integration->get_page_access_token() || ! $integration->get_product_catalog_id() ) {
			return;
		}

		// add a modal in admin product pages
		add_action( 'admin_footer', [ $this, 'render_modal_template' ] );
		// may trigger the modal to open to warn the merchant about a conflict with the current product terms
		add_action( 'admin_footer', [ $this, 'validate_product_excluded_terms' ] );

		// add admin notification in case of site URL change
		add_action( 'admin_notices', [ $this, 'validate_cart_url' ] );

		// add columns for displaying Facebook sync enabled/disabled and catalog visibility status
		add_filter( 'manage_product_posts_columns',       [ $this, 'add_product_list_table_columns' ] );
		add_action( 'manage_product_posts_custom_column', [ $this, 'add_product_list_table_columns_content' ] );

		// add input to filter products by Facebook sync enabled
		add_action( 'restrict_manage_posts', [ $this, 'add_products_by_sync_enabled_input_filter' ], 40 );
		add_filter( 'request',               [ $this, 'filter_products_by_sync_enabled' ] );

		// add bulk actions to manage products sync
		add_filter( 'bulk_actions-edit-product',        [ $this, 'add_products_sync_bulk_actions' ], 40 );
		add_action( 'handle_bulk_actions-edit-product', [ $this, 'handle_products_sync_bulk_actions' ] );

		// add Product data tab
		add_filter( 'woocommerce_product_data_tabs',   [ $this, 'add_product_settings_tab' ] );
		add_action( 'woocommerce_product_data_panels', [ $this, 'add_product_settings_tab_content' ] );

		// add Variation edit fields
		add_action( 'woocommerce_product_after_variable_attributes', [ $this, 'add_product_variation_edit_fields' ], 10, 3 );
		add_action( 'woocommerce_save_product_variation', [ $this, 'save_product_variation_edit_fields' ], 10, 2 );
	}


	/**
	 * Enqueues admin scripts.
	 *
	 * @internal
	 *
	 * @since 1.10.0
	 */
	public function enqueue_scripts() {
		global $current_screen;

		$modal_screens = [
			'product',
			'edit-product',
		];

		if ( isset( $current_screen->id ) ) {

			if ( in_array( $current_screen->id, $modal_screens, true ) || facebook_for_woocommerce()->is_plugin_settings() ) {

				// enqueue modal functions
				wp_enqueue_script( 'facebook-for-woocommerce-modal', plugins_url( '/facebook-for-woocommerce/assets/js/facebook-for-woocommerce-modal.min.js' ), [ 'jquery', 'wc-backbone-modal', 'jquery-blockui' ], \WC_Facebookcommerce::PLUGIN_VERSION );
			}

			if ( 'product' === $current_screen->id || 'edit-product' === $current_screen->id ) {

				wp_enqueue_style( 'facebook-for-woocommerce-products-admin', plugins_url( '/facebook-for-woocommerce/assets/css/admin/facebook-for-woocommerce-products-admin.css' ), [], \WC_Facebookcommerce::PLUGIN_VERSION );

				wp_enqueue_script( 'facebook-for-woocommerce-products-admin', plugins_url( '/facebook-for-woocommerce/assets/js/admin/facebook-for-woocommerce-products-admin.min.js' ), [ 'jquery', 'wc-backbone-modal', 'jquery-blockui', 'facebook-for-woocommerce-modal' ], \WC_Facebookcommerce::PLUGIN_VERSION );

				wp_localize_script( 'facebook-for-woocommerce-products-admin', 'facebook_for_woocommerce_products_admin', [
					'ajax_url'                                  => admin_url( 'admin-ajax.php' ),
					'set_product_visibility_nonce'              => wp_create_nonce( 'set-products-visibility' ),
					'set_product_sync_prompt_nonce'             => wp_create_nonce( 'set-product-sync-prompt' ),
					'set_product_sync_bulk_action_prompt_nonce' => wp_create_nonce( 'set-product-sync-bulk-action-prompt' ),
				] );
			}

			if ( facebook_for_woocommerce()->is_plugin_settings() ) {

				wp_enqueue_script( 'facebook-for-woocommerce-settings-sync', plugins_url( '/facebook-for-woocommerce/assets/js/admin/facebook-for-woocommerce-settings-sync.min.js' ), [ 'jquery', 'wc-backbone-modal', 'jquery-blockui', 'facebook-for-woocommerce-modal' ], \WC_Facebookcommerce::PLUGIN_VERSION );

				/* translators: Placeholders %1$s - opening <strong> html tag, %2$s closing </strong> html tag, {count} number of remaining items */
				$sync_remaining_items_string = _n_noop( '%1$sProgress:%2$s {count} item remaining.', '%1$sProgress:%2$s {count} items remaining.', 'facebook-for-woocommerce' );

				wp_localize_script( 'facebook-for-woocommerce-settings-sync', 'facebook_for_woocommerce_settings_sync', [
					'ajax_url'                        => admin_url( 'admin-ajax.php' ),
					'set_excluded_terms_prompt_nonce' => wp_create_nonce( 'set-excluded-terms-prompt' ),
					'set_product_visibility_nonce'    => wp_create_nonce( 'set-products-visibility' ),
					'i18n'                            => [
						/* translators: Placeholders %s - html code for a spinner icon */
						'confirm_resync'                => esc_html__( 'Your products will now be resynced to Facebook, this may take some time.', 'facebook-for-woocommerce' ),
						'confirm_sync_test'             => esc_html__( 'Launch Test?', 'facebook-for-woocommerce' ),
						'confirm_sync'                  => esc_html__( "Facebook for WooCommerce automatically syncs your products on create/update. Are you sure you want to force product resync?\n\nThis will query all published products and may take some time. You only need to do this if your products are out of sync or some of your products did not sync.", 'facebook-for-woocommerce' ),
						'sync_in_progress'              => sprintf( esc_html__( 'Syncing... Keep this browser open until sync is complete. %s', 'facebook-for-woocommerce' ), '<span class="spinner is-active"></span>' ),
						'sync_remaining_items_singular' => sprintf( esc_html( translate_nooped_plural( $sync_remaining_items_string, 1 ) ), '<strong>', '</strong>', '<span class="spinner is-active"></span>' ),
						'sync_remaining_items_plural'   => sprintf( esc_html( translate_nooped_plural( $sync_remaining_items_string, 2 ) ), '<strong>', '</strong>', '<span class="spinner is-active"></span>' ),
						/* translators: Placeholders %1$s - opening <strong> html tag, %2$s closing </strong> html tag */
						'integration_test_sucessful'    => sprintf( esc_html__( '%1$sStatus:%2$s Test Pass.', 'facebook-for-woocommerce' ), '<strong>', '</strong>' ),
						/* translators: Placeholders %1$s - opening <strong> html tag, %2$s closing </strong> html tag */
						'integration_test_in_progress'  => sprintf( esc_html__( '%1$sStatus:%2$s Integration test in progress...', 'facebook-for-woocommerce' ), '<strong>', '</strong>' ),
						/* translators: Placeholders %1$s - opening <strong> html tag, %2$s closing </strong> html tag */
						'integration_test_failed'       => sprintf( esc_html__( '%1$sStatus:%2$s Test Fail.', 'facebook-for-woocommerce' ), '<strong>', '</strong>' ),
						'general_error'                 => esc_html__( 'There was an error trying to sync the products to Facebook.', 'facebook-for-woocommerce' ),
						'feed_upload_error'             => esc_html__( 'Something went wrong while uploading the product information, please try again.', 'facebook-for-woocommerce' ),
					],
				] );
			}
		}
	}


	/**
	 * Adds Facebook-related columns in the products edit screen.
	 *
	 * @internal
	 *
	 * @since 1.10.0
	 *
	 * @param array $columns array of keys and labels
	 * @return array
	 */
	public function add_product_list_table_columns( $columns ) {

		$columns['facebook_sync_enabled']       = __( 'FB Sync Enabled', 'facebook-for-woocommerce' );
		$columns['facebook_catalog_visibility'] = __( 'FB Catalog Visibility', 'facebook-for-woocommerce' );

		return $columns;
	}


	/**
	 * Outputs sync information for products in the edit screen.
	 *
	 * @internal
	 *
	 * @since 1.10.0
	 *
	 * @param string $column the current column in the posts table
	 */
	public function add_product_list_table_columns_content( $column ) {
		global $post;

		if ( 'facebook_sync_enabled' === $column ) :

			$product = wc_get_product( $post );

			if ( $product && Products::product_should_be_synced( $product ) ) :
				esc_html_e( 'Enabled', 'facebook-for-woocommerce' );
			else :
				esc_html_e( 'Disabled', 'facebook-for-woocommerce' );
			endif;

		elseif ( 'facebook_catalog_visibility' === $column ) :

			$integration         = facebook_for_woocommerce()->get_integration();
			$product             = wc_get_product( $post );
			$fb_product          = new \WC_Facebook_Product( $post );
			$fb_product_group_id = $integration && $product && $integration->get_product_fbid( \WC_Facebookcommerce_Integration::FB_PRODUCT_GROUP_ID, $post->ID, $fb_product );

			if ( ! $fb_product_group_id ) :

				?>
				<span
					class="facebook-for-woocommerce-product-visibility-toggle"
					style="cursor:default;"
					title="<?php
					/* translators: Points to a product that was never synced with Facebook */
					esc_attr_e( 'Never synced with Facebook.', 'facebook-for-woocommerce' ); ?>"
				>&ndash;</span>
				<?php

			else :

				$is_sync_enabled = Products::product_should_be_synced( $product );
				$is_visible      = Products::is_product_visible( $product );
				$is_hidden       = ! $is_visible;

				if ( $is_sync_enabled ) {
					/* translators: Action to hide a product (currently synced with Facebook) from the Facebook catalog */
					$visible_tooltip_text = __( 'Hide from Facebook catalog. Currently synced with Facebook.', 'facebook-for-woocommerce' );
					/* translators: Action to publish a product (currently synced with Facebook) in the Facebook catalog */
					$hidden_tooltip_text  = __( 'Publish in Facebook catalog. Currently synced with Facebook.', 'facebook-for-woocommerce' );
				} else {
					/* translators: Action to hide a product (currently not synced with Facebook) from the Facebook catalog */
					$visible_tooltip_text = __( 'Hide from Facebook catalog. Not synced with Facebook.', 'facebook-for-woocommerce' );
					/* translators: Action to publish a product (currently not synced with Facebook) in the Facebook catalog */
					$hidden_tooltip_text  = __( 'Publish in Facebook catalog. Not synced with Facebook.', 'facebook-for-woocommerce' );
				}

				?>
				<button
					id="facebook-for-woocommerce-product-visibility-show-<?php echo esc_attr( $post->ID ); ?>"
					class="button button-primary button-large facebook-for-woocommerce-product-visibility-toggle facebook-for-woocommerce-product-visibility-show"
					style="<?php echo $is_hidden ? 'display:block;' : 'display:none;'; ?>"
					data-action="show"
					data-product-id="<?php echo esc_attr( $post->ID ); ?>"
					title="<?php echo esc_attr( $hidden_tooltip_text ); ?>"
				><?php esc_html_e( 'Show', 'facebook-for-woocommerce' ); ?></button>
				<button
					id="facebook-for-woocommerce-product-visibility-hide-<?php echo esc_attr( $post->ID ); ?>"
					class="button button-large facebook-for-woocommerce-product-visibility-toggle facebook-for-woocommerce-product-visibility-hide"
					style="<?php echo $is_visible ? 'display:block;' : 'display:none;'; ?>"
					data-action="hide"
					data-product-id="<?php echo esc_attr( $post->ID ); ?>"
					title="<?php echo esc_attr( $visible_tooltip_text ); ?>"
				><?php esc_html_e( 'Hide', 'facebook-for-woocommerce' ); ?></button>
				<?php

			endif;

		endif;
	}


	/**
	 * Adds a dropdown input to let shop managers filter products by sync setting.
	 *
	 * @internal
	 *
	 * @since 1.10.0
	 */
	public function add_products_by_sync_enabled_input_filter() {
		global $typenow;

		if ( 'product' !== $typenow ) {
			return;
		}

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$choice = isset( $_GET['fb_sync_enabled'] ) ? (string) sanitize_text_field( wp_unslash( $_GET['fb_sync_enabled'] ) ) : '';

		?>
		<select name="fb_sync_enabled">
			<option value="" <?php selected( $choice, '' ); ?>><?php esc_html_e( 'Filter by Facebook sync setting', 'facebook-for-woocommerce' ); ?></option>
			<option value="yes" <?php selected( $choice, 'yes' ); ?>><?php esc_html_e( 'Facebook sync enabled', 'facebook-for-woocommerce' ); ?></option>
			<option value="no" <?php selected( $choice, 'no' ); ?>><?php esc_html_e( 'Facebook sync disabled', 'facebook-for-woocommerce' ); ?></option>
		</select>
		<?php
	}


	/**
	 * Filters products by Facebook sync setting.
	 *
	 * @internal
	 *
	 * @since 1.10.0
	 *
	 * @param array $query_vars product query vars for the edit screen
	 * @return array
	 */
	public function filter_products_by_sync_enabled( $query_vars ) {

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		if ( isset( $_REQUEST['fb_sync_enabled'] ) && in_array( $_REQUEST['fb_sync_enabled'], [ 'yes', 'no' ], true ) ) {

			// by default use an "AND" clause if multiple conditions exist for a meta query
			if ( ! empty( $query_vars['meta_query'] ) ) {
				$query_vars['meta_query']['relation'] = 'AND';
			} else {
				$query_vars['meta_query'] = [];
			}

			// when checking for products with sync enabled we need to check both "yes" and meta not set, this requires adding an "OR" clause
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			if ( 'yes' === $_REQUEST['fb_sync_enabled'] ) {

				$query_vars = $this->add_query_vars_to_find_products_with_sync_enabled( $query_vars );

			} else {

				$integration             = facebook_for_woocommerce()->get_integration();
				$excluded_categories_ids = $integration ? $integration->get_excluded_product_category_ids() : [];
				$exlcuded_tags_ids       = $integration ? $integration->get_excluded_product_tag_ids() : [];

				if ( $excluded_categories_ids || $exlcuded_tags_ids ) {

					// find the IDs of products that have sync enabled
					$products_query_vars = [
						'post_type'              => 'product',
						'post_status'            => ! empty( $query_vars['post_status'] ) ? $query_vars['post_status'] : 'any',
						'no_found_rows'          => true,
						'update_post_meta_cache' => false,
						'update_post_term_cache' => false,
						'fields'                 => 'ids',
						'nopaging'               => true,
					];

					$products_query_vars = $this->add_query_vars_to_find_products_with_sync_enabled( $products_query_vars );

					// exclude products that have sync enabled from the current query
					$query_vars['post__not_in'] = get_posts( $products_query_vars );

				} else {

					$query_vars['meta_query'][] = [
						'key'   => Products::SYNC_ENABLED_META_KEY,
						'value' => 'no',
					];
				}
			}
		}

		return $query_vars;
	}


	/**
	 * Adds query vars to limit the results to products that have sync enabled.
	 *
	 * @since 1.10.0
	 *
	 * @param array $query_vars
	 * @return array
	 */
	private function add_query_vars_to_find_products_with_sync_enabled( array $query_vars ) {

		$query_vars['meta_query']['relation'] = 'OR';
		$query_vars['meta_query'][]           = [
			'key'   => Products::SYNC_ENABLED_META_KEY,
			'value' => 'yes',
		];
		$query_vars['meta_query'][]           = [
			'key'     => Products::SYNC_ENABLED_META_KEY,
			'compare' => 'NOT EXISTS',
		];

		// check whether the product belongs to an excluded product category or tag
		$query_vars = $this->maybe_add_tax_query_for_excluded_taxonomies( $query_vars );

		return $query_vars;
	}


	/**
	 * Adds a tax query to filter out products in excluded product categories and product tags.
	 *
	 * @since 1.10.0
	 *
	 * @param array $query_vars product query vars for the edit screen
	 * @return array
	 */
	private function maybe_add_tax_query_for_excluded_taxonomies( $query_vars ) {

		$integration = facebook_for_woocommerce()->get_integration();

		if ( $integration ) {

			$tax_query               = [];
			$excluded_categories_ids = $integration->get_excluded_product_category_ids();

			if ( $excluded_categories_ids ) {
				$tax_query[] = [
					'taxonomy' => 'product_cat',
					'terms'    => $excluded_categories_ids,
					'field'    => 'term_id',
					'operator' => 'NOT IN',
				];
			}

			$excluded_tags_ids = $integration->get_excluded_product_tag_ids();

			if ( $excluded_tags_ids ) {
				$tax_query[] = [
					'taxonomy' => 'product_tag',
					'terms'    => $excluded_tags_ids,
					'field'    => 'term_id',
					'operator' => 'NOT IN',
				];
			}

			if ( $tax_query && empty( $query_vars['tax_query'] ) ) {
				$query_vars['tax_query'] = $tax_query;
			} elseif ( $tax_query && is_array( $query_vars ) ) {
				$query_vars['tax_query'][] = $tax_query;
			}
		}

		return $query_vars;
	}


	/**
	 * Adds bulk actions in the products edit screen.
	 *
	 * @internal
	 *
	 * @since 1.10.0
	 *
	 * @param array $bulk_actions array of bulk action keys and labels
	 * @return array
	 */
	public function add_products_sync_bulk_actions( $bulk_actions ) {

		$bulk_actions['facebook_include'] = __( 'Include in Facebook sync', 'facebook-for-woocommerce' );
		$bulk_actions['facebook_exclude'] = __( 'Exclude from Facebook sync', 'facebook-for-woocommerce' );

		return $bulk_actions;
	}


	/**
	 * Handles a Facebook product sync bulk action.
	 *
	 * @internal
	 *
	 * @since 1.10.0
	 *
	 * @param string $redirect admin URL used by WordPress to redirect after performing the bulk action
	 * @return string
	 */
	public function handle_products_sync_bulk_actions( $redirect ) {

		// primary dropdown at the top of the list table
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$action = isset( $_REQUEST['action'] ) && -1 !== (int) $_REQUEST['action'] ? sanitize_text_field( wp_unslash( $_REQUEST['action'] ) ) : null;

		// secondary dropdown at the bottom of the list table
		if ( ! $action ) {
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$action = isset( $_REQUEST['action2'] ) && -1 !== (int) $_REQUEST['action2'] ? sanitize_text_field( wp_unslash( $_REQUEST['action2'] ) ) : null;
		}

		if ( $action && in_array( $action, [ 'facebook_include', 'facebook_exclude' ], true ) ) {

			$products = [];

			// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$product_ids = isset( $_REQUEST['post'] ) && is_array( $_REQUEST['post'] ) ? array_map( 'absint', $_REQUEST['post'] ) : [];

			if ( ! empty( $product_ids ) ) {

				foreach ( $product_ids as $product_id ) {

					if ( $product = wc_get_product( $product_id ) ) {

						$products[] = $product;
					}
				}

				if ( 'facebook_include' === $action ) {

					Products::enable_sync_for_products( $products );

					// re-sync each product
					foreach ( $products as $product ) {
						facebook_for_woocommerce()->get_integration()->on_product_publish( $product->get_id() );
					}

				} elseif ( 'facebook_exclude' === $action ) {

					Products::disable_sync_for_products( $products );
				}
			}
		}

		return $redirect;
	}


	/**
	 * Prints a notice on products page in case the current cart URL is not the original sync URL.
	 *
	 * @internal
	 *
	 * TODO: update this method to use the notice handler once we framework the plugin {CW 2020-01-09}
	 *
	 * @since 1.10.0
	 */
	public function validate_cart_url() {
		global $current_screen;

		if ( isset( $current_screen->id ) && in_array( $current_screen->id, [ 'edit-product', 'product' ], true ) ) :

			$cart_url = get_option( \WC_Facebookcommerce_Integration::FB_CART_URL, '' );

			if ( ! empty( $cart_url ) && $cart_url !== wc_get_cart_url() ) :

				?>
				<div class="notice notice-warning">
					<?php printf(
						/* translators: Placeholders: %1$s - Facebook for Woocommerce, %2$s - opening HTML <a> link tag, %3$s - closing HTML </a> link tag */
						'<p>' . esc_html__( '%1$s: One or more of your products is using a checkout URL that may be different than your shop checkout URL. %2$sRe-sync your products to update checkout URLs on Facebook%3$s.', 'facebook-for-woocommerce' ) . '</p>',
						'<strong>' . esc_html__( 'Facebook for WooCommerce', 'facebook-for-woocommerce' ) . '</strong>',
						'<a href="' . esc_url( WOOCOMMERCE_FACEBOOK_PLUGIN_SETTINGS_URL ) . '">',
						'</a>'
					); ?>
				</div>
				<?php

			endif;

		endif;
	}


	/**
	 * Adds a new tab to the Product edit page.
	 *
	 * @internal
	 *
	 * @since 1.10.0
	 *
	 * @param array $tabs product tabs
	 * @return array
	 */
	public function add_product_settings_tab( $tabs ) {

		$tabs['fb_commerce_tab'] = [
			'label'  => __( 'Facebook', 'facebook-for-woocommerce' ),
			'target' => 'facebook_options',
			'class'  => [ 'show_if_simple' ],
		];

		return $tabs;
	}


	/**
	 * Adds content to the new Facebook tab on the Product edit page.
	 *
	 * @internal
	 *
	 * @since 1.10.0
	 */
	public function add_product_settings_tab_content() {
		global $post;

		// all products have sync enabled unless explicitly disabled
		$sync_enabled = 'no' !== get_post_meta( $post->ID, Products::SYNC_ENABLED_META_KEY, true );
		$description  = get_post_meta( $post->ID, \WC_Facebookcommerce_Integration::FB_PRODUCT_DESCRIPTION, true );
		$price        = get_post_meta( $post->ID, \WC_Facebook_Product::FB_PRODUCT_PRICE, true );
		$image_source = get_post_meta( $post->ID, Products::PRODUCT_IMAGE_SOURCE_META_KEY, true );
		$image        = get_post_meta( $post->ID, \WC_Facebook_Product::FB_PRODUCT_IMAGE, true );

		// 'id' attribute needs to match the 'target' parameter set above
		?>
		<div id='facebook_options' class='panel woocommerce_options_panel'>
			<div class='options_group'>
				<?php

				woocommerce_wp_checkbox( [
					'id'          => 'fb_sync_enabled',
					'label'       => __( 'Include in Facebook sync', 'facebook-for-woocommerce' ),
					'value'       => wc_bool_to_string( (bool) $sync_enabled ),
				] );

				woocommerce_wp_textarea_input( [
					'id'          => \WC_Facebookcommerce_Integration::FB_PRODUCT_DESCRIPTION,
					'label'       => __( 'Facebook Description', 'facebook-for-woocommerce' ),
					'desc_tip'    => true,
					'description' => __( 'Custom (plain-text only) description for product on Facebook. If blank, product description will be used. If product description is blank, shortname will be used.', 'facebook-for-woocommerce' ),
					'cols'        => 40,
					'rows'        => 20,
					'value'       => $description,
					'class'       => 'enable-if-sync-enabled',
				] );

				woocommerce_wp_radio( [
					'id'            => 'fb_product_image_source',
					'label'         => __( 'Facebook Product Image', 'facebook-for-woocommerce' ),
					'desc_tip'      => true,
					'description'   => __( 'Choose the product image that should be synced to the Facebook catalog for this product. If using a custom image, please enter an absolute URL (e.g. https://domain.com/image.jpg).', 'facebook-for-woocommerce' ),
					'options'       => [
						Products::PRODUCT_IMAGE_SOURCE_PRODUCT => __( 'Use WooCommerce image', 'facebook-for-woocommerce' ),
						Products::PRODUCT_IMAGE_SOURCE_CUSTOM  => __( 'Use custom image', 'facebook-for-woocommerce' ),
					],
					'value'         => $image_source ?: Products::PRODUCT_IMAGE_SOURCE_PRODUCT,
					'class'         => 'short enable-if-sync-enabled js-fb-product-image-source',
					'wrapper_class' => 'fb-product-image-source-field',
				] );

				woocommerce_wp_text_input( [
					'id'          => \WC_Facebook_Product::FB_PRODUCT_IMAGE,
					'label'       => __( 'Custom Image URL', 'facebook-for-woocommerce' ),
					'value'       => $image,
					'class'       => sprintf( 'enable-if-sync-enabled product-image-source-field show-if-product-image-source-%s', Products::PRODUCT_IMAGE_SOURCE_CUSTOM ),
				] );

				woocommerce_wp_text_input( [
					'id'          => \WC_Facebook_Product::FB_PRODUCT_PRICE,
					'label'       => sprintf(
						/* translators: Placeholders %1$s - WC currency symbol */
						__( 'Facebook Price (%1$s)', 'facebook-for-woocommerce' ),
						get_woocommerce_currency_symbol()
					),
					'desc_tip'    => true,
					'description' => __( 'Custom price for product on Facebook. Please enter in monetary decimal (.) format without thousand separators and currency symbols. If blank, product price will be used.', 'facebook-for-woocommerce' ),
					'cols'        => 40,
					'rows'        => 60,
					'value'       => $price,
					'class'       => 'enable-if-sync-enabled',
				] );

				?>
			</div>
		</div>
		<?php
	}


	/**
	 * Outputs the Facebook settings fields for a single variation.
	 *
	 * @internal
	 *
	 * @since 1.10.0
	 *
	 * @param int $index the index of the current variation
	 * @param array $variation_data unused
	 * @param \WC_Post $post the post type for the current variation
	 */
	public function add_product_variation_edit_fields( $index, $variation_data, $post ) {

		$variation = wc_get_product( $post );

		if ( ! $variation instanceof \WC_Product_Variation ) {
			return;
		}

		$parent = wc_get_product( $variation->get_parent_id() );

		if ( ! $parent instanceof \WC_Product ) {
			return;
		}

		$sync_enabled = $this->get_product_variation_meta( $variation, Products::SYNC_ENABLED_META_KEY, $parent );
		$description  = $this->get_product_variation_meta( $variation, \WC_Facebookcommerce_Integration::FB_PRODUCT_DESCRIPTION, $parent );
		$price        = $this->get_product_variation_meta( $variation, \WC_Facebook_Product::FB_PRODUCT_PRICE, $parent );
		$image_url    = $this->get_product_variation_meta( $variation, \WC_Facebook_Product::FB_PRODUCT_IMAGE, $parent );
		$image_source = $variation->get_meta( Products::PRODUCT_IMAGE_SOURCE_META_KEY );

		woocommerce_wp_checkbox( [
			'id'            => "variable_fb_sync_enabled$index",
			'name'          => "variable_fb_sync_enabled[$index]",
			'label'         => __( 'Include in Facebook sync', 'facebook-for-woocommerce' ),
			'value'         => wc_bool_to_string( 'no' !== $sync_enabled ),
			'class'         => 'checkbox js-variable-fb-sync-toggle',
			'wrapper_class' => 'fb-sync-enabled-field'
		] );

		woocommerce_wp_textarea_input( [
			'id'            => sprintf( 'variable_%s%s', \WC_Facebookcommerce_Integration::FB_PRODUCT_DESCRIPTION, $index ),
			'name'          => sprintf( "variable_%s[$index]", \WC_Facebookcommerce_Integration::FB_PRODUCT_DESCRIPTION ),
			'label'         => __( 'Facebook Description', 'facebook-for-woocommerce' ),
			'desc_tip'      => true,
			'description'   => __( 'Custom (plain-text only) description for product on Facebook. If blank, product description will be used. If product description is blank, shortname will be used.', 'facebook-for-woocommerce' ),
			'cols'          => 40,
			'rows'          => 5,
			'value'         => $description,
			'class'         => 'enable-if-sync-enabled',
			'wrapper_class' => 'form-row form-row-full',
		] );

		woocommerce_wp_radio( [
			'id'            => "variable_fb_product_image_source$index",
			'name'          => "variable_fb_product_image_source[$index]",
			'label'         => __( 'Facebook Product Image', 'facebook-for-woocommerce' ),
			'desc_tip'      => true,
			'description'   => __( 'Choose the product image that should be synced to the Facebook catalog for this product. If using a custom image, please enter an absolute URL (e.g. https://domain.com/image.jpg).', 'facebook-for-woocommerce' ),
			'options'       => [
				Products::PRODUCT_IMAGE_SOURCE_PRODUCT        => __( 'Use variation image', 'facebook-for-woocommerce' ),
				Products::PRODUCT_IMAGE_SOURCE_PARENT_PRODUCT => __( 'Use parent image', 'facebook-for-woocommerce' ),
				Products::PRODUCT_IMAGE_SOURCE_CUSTOM         => __( 'Use custom image', 'facebook-for-woocommerce' ),
			],
			'value'         => $image_source ?: Products::PRODUCT_IMAGE_SOURCE_PRODUCT,
			'class'         => 'enable-if-sync-enabled js-fb-product-image-source',
			'wrapper_class' => 'fb-product-image-source-field',
		] );

		woocommerce_wp_text_input( [
			'id'            => sprintf( 'variable_%s%s', \WC_Facebook_Product::FB_PRODUCT_IMAGE, $index ),
			'name'          => sprintf( "variable_%s[$index]", \WC_Facebook_Product::FB_PRODUCT_IMAGE ),
			'label'         => __( 'Custom Image URL', 'facebook-for-woocommerce' ),
			'value'         => $image_url,
			'class'         => sprintf( 'enable-if-sync-enabled product-image-source-field show-if-product-image-source-%s', Products::PRODUCT_IMAGE_SOURCE_CUSTOM ),
			'wrapper_class' => 'form-row form-row-full'
		] );

		woocommerce_wp_text_input( [
			'id'            => sprintf( 'variable_%s%s', \WC_Facebook_Product::FB_PRODUCT_PRICE, $index ),
			'name'          => sprintf( "variable_%s[$index]", \WC_Facebook_Product::FB_PRODUCT_PRICE ),
			'label'         => sprintf(
				/* translators: Placeholders %1$s - WC currency symbol */
				__( 'Facebook Price (%1$s)', 'facebook-for-woocommerce' ),
				get_woocommerce_currency_symbol()
			),
			'desc_tip'      => true,
			'description'   => __( 'Custom price for product on Facebook. Please enter in monetary decimal (.) format without thousand separators and currency symbols. If blank, product price will be used.', 'facebook-for-woocommerce' ),
			'value'         => wc_format_decimal( $price ),
			'class'         => 'enable-if-sync-enabled',
			'wrapper_class' => 'form-row form-full',
		] );
	}


	/**
	 * Gets the stored value for the given meta of a product variation.
	 *
	 * If no value is found, we try to use the value stored in the parent product.
	 *
	 * @since 1.10.0
	 *
	 * @param \WC_Product_Variation $variation the product variation
	 * @param string $key the name of the meta to retrieve
	 * @param \WC_Product $parent the parent product
	 * @return mixed
	 */
	private function get_product_variation_meta( $variation, $key, $parent ) {

		$value = $variation->get_meta( $key );

		if ( '' === $value && $parent instanceof \WC_Product ) {
			$value = $parent->get_meta( $key );
		}

		return $value;
	}


	/**
	 * Saves the submitted Facebook settings for each variation.
	 *
	 * @internal
	 *
	 * @since 1.10.0
	 *
	 * @param int $variation_id the ID of the product variation being edited
	 * @param int $index the index of the current variation
	 */
	public function save_product_variation_edit_fields( $variation_id, $index ) {

		$variation = wc_get_product( $variation_id );

		if ( ! $variation instanceof \WC_Product_Variation ) {
			return;
		}

		// phpcs:disable WordPress.Security.NonceVerification.Missing
		if ( isset( $_POST['variable_fb_sync_enabled'][ $index ] ) && 'yes' === $_POST['variable_fb_sync_enabled'][ $index ] ) {

			Products::enable_sync_for_products( [ $variation ] );

			$posted_param = 'variable_' . \WC_Facebookcommerce_Integration::FB_PRODUCT_DESCRIPTION;
			$description  = isset( $_POST[ $posted_param ][ $index ] ) ? sanitize_text_field( wp_unslash( $_POST[ $posted_param ][ $index ] ) ) : null;

			$posted_param = 'variable_fb_product_image_source';
			$image_source = isset( $_POST[ $posted_param ][ $index ] ) ? sanitize_key( wp_unslash( $_POST[ $posted_param ][ $index ] ) ) : '';

			$posted_param = 'variable_' . \WC_Facebook_Product::FB_PRODUCT_IMAGE;
			$image_url    = isset( $_POST[ $posted_param ][ $index ] ) ? esc_url_raw( wp_unslash( $_POST[ $posted_param ][ $index ] ) ) : null;

			$posted_param = 'variable_' . \WC_Facebook_Product::FB_PRODUCT_PRICE;
			$price        = isset( $_POST[ $posted_param ][ $index ] ) ? wc_format_decimal( $_POST[ $posted_param ][ $index ] ) : '';

			$variation->update_meta_data( \WC_Facebookcommerce_Integration::FB_PRODUCT_DESCRIPTION, $description );
			$variation->update_meta_data( Products::PRODUCT_IMAGE_SOURCE_META_KEY, $image_source );
			$variation->update_meta_data( \WC_Facebook_Product::FB_PRODUCT_IMAGE, $image_url );
			$variation->update_meta_data( \WC_Facebook_Product::FB_PRODUCT_PRICE, $price );
			$variation->save_meta_data();

		} else {

			Products::disable_sync_for_products( [ $variation ] );

		}
		// phpcs:enable WordPress.Security.NonceVerification.Missing
	}


	/**
	 * Outputs a modal template in admin product pages.
	 *
	 * @internal
	 *
	 * @since 1.10.0
	 */
	public function render_modal_template() {
		global $current_screen;

		// bail if not on the products, product edit, or settings screen
		if ( ! $current_screen || ! in_array( $current_screen->id, [ 'edit-product', 'product', 'woocommerce_page_wc-settings' ], true ) ) {
			return;
		}

		?>
		<script type="text/template" id="tmpl-facebook-for-woocommerce-modal">
			<div class="wc-backbone-modal facebook-for-woocommerce-modal">
				<div class="wc-backbone-modal-content">
					<section class="wc-backbone-modal-main" role="main">
						<header class="wc-backbone-modal-header">
							<h1><?php esc_html_e( 'Facebook for WooCommerce', 'facebook-for-woocommerce' ); ?></h1>
							<button class="modal-close modal-close-link dashicons dashicons-no-alt">
								<span class="screen-reader-text"><?php esc_html_e( 'Close modal panel', 'facebook-for-woocommerce' ); ?></span>
							</button>
						</header>
						<article>{{{data.message}}}</article>
						<footer>
							<div class="inner">{{{data.buttons}}}</div>
						</footer>
					</section>
				</div>
			</div>
			<div class="wc-backbone-modal-backdrop modal-close"></div>
		</script>
		<?php
	}


	/**
	 * Maybe triggers the modal to open on the product edit screen on page load.
	 *
	 * If the product is set to be synced in Facebook, but belongs to a term that is set to be excluded, the modal prompts the merchant for action.
	 *
	 * @internal
	 *
	 * @since 1.10.0
	 */
	public function validate_product_excluded_terms() {
		global $current_screen, $post;

		if ( $post && $current_screen && $current_screen->id === 'product' ) :

			$product = wc_get_product( $post );

			if ( $product instanceof \WC_Product
			     && Products::is_sync_enabled_for_product( $product )
			     && Products::is_sync_excluded_for_product_terms( $product )
			) :

				?>
				<script type="text/javascript">
					jQuery( document ).ready( function( $ ) {

						var productID   = parseInt( $( 'input#post_ID' ).val(), 10 ),
							productTag  = $( 'textarea[name=\"tax_input[product_tag]\"]' ).val().split( ',' ),
							productCat  = [];

						$( '#taxonomy-product_cat input[name=\"tax_input[product_cat][]\"]:checked' ).each( function() {
							productCat.push( parseInt( $( this ).val(), 10 ) );
						} );

						$.post( facebook_for_woocommerce_products_admin.ajax_url, {
							action:      'facebook_for_woocommerce_set_product_sync_prompt',
							security:     facebook_for_woocommerce_products_admin.set_product_sync_prompt_nonce,
							sync_enabled: 'enabled',
							product:      productID,
							categories:   productCat,
							tags:         productTag
						}, function( response ) {

							if ( response && ! response.success ) {

								$( '#wc-backbone-modal-dialog .modal-close' ).trigger( 'click' );

								new $.WCBackboneModal.View( {
									target: 'facebook-for-woocommerce-modal',
									string: response.data
								} );
							}
						} );
					} );
				</script>
			<?php

			endif;

		endif;
	}


}
