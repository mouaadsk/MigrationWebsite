<?php
namespace ElementsKit\Compatibility\WPML\Widgets;

use WPML_Elementor_Module_With_Items;

if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Ekit_Image_Accordion
 *
 * @since 1.2.6
 */
class Ekit_Gallery extends WPML_Elementor_Module_With_Items {

	/**
	 * Retrieve the field name.
	 *
	 * @since 1.2.6
	 * @return string
	 */
	public function get_items_field() {
		return 'ekit_gallery_items';
	}

	/**
	 * Retrieve the fields inside the repeater
	 *
	 * @since 1.2.6
	 *
	 * @return array
	 */
	public function get_fields() {
		return array(
			'ekit_gallery_filter_label',
		);
	}

	/**
	 * Method for setting the title for each translatable field
	 *
	 * @since 1.2.6
	 *
	 * @param string $field The name of the field.
	 * @return string
	 */
	protected function get_title( $field ) {

		switch ( $field ) {
			case 'ekit_gallery_filter_label':
				return esc_html__( 'Filter Label (Gallery)', 'elementskit' );
				break;

			default:
				return '';
		}

	}

	/**
	 * Method for determining the editor type for each field
	 *
	 * @since 1.2.6
	 *
	 * @param  string $field Name of the field.
	 * @return string
	 */
	protected function get_editor_type( $field ) {

		switch ( $field ) {
			case 'ekit_gallery_filter_label':
				return 'LINE';

			default:
				return '';
		}

	}
}
