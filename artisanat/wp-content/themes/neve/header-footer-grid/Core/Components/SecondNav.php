<?php
/**
 * Custom Component class for Header Footer Grid.
 *
 * Name:    Header Footer Grid
 * Author:  Bogdan Preda <bogdan.preda@themeisle.com>
 *
 * @version 1.0.0
 * @package HFG
 */

namespace HFG\Core\Components;

use HFG\Core\Settings;
use HFG\Core\Settings\Manager as SettingsManager;
use HFG\Main;

/**
 * Class Nav
 *
 * @package HFG\Core\Components
 */
class SecondNav extends Abstract_Component {

	const COMPONENT_ID   = 'secondary-menu';
	const STYLE_ID       = 'style';
	const COLOR_ID       = 'color';
	const HOVER_COLOR_ID = 'hover_color';
	const ITEM_HEIGHT    = 'item_height';
	const SPACING        = 'spacing';

	/**
	 * Nav constructor.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function init() {
		$this->set_property( 'label', __( 'Secondary Menu', 'neve' ) );
		$this->set_property( 'id', $this->get_class_const( 'COMPONENT_ID' ) );
		$this->set_property( 'width', 6 );
		$this->set_property( 'section', 'secondary_menu_primary' );
		$this->set_property( 'icon', 'tagcloud' );
		$this->set_property( 'has_font_family_control', true );
		$this->set_property( 'has_typeface_control', true );
		$this->set_property( 'default_typography_selector', $this->default_typography_selector . '.builder-item--' . $this->get_id() . ' #secondary-menu li > a' );
	}

	/**
	 * Called to register component controls.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function add_settings() {

		SettingsManager::get_instance()->add(
			[
				'id'                 => self::STYLE_ID,
				'group'              => $this->get_class_const( 'COMPONENT_ID' ),
				'tab'                => SettingsManager::TAB_STYLE,
				'transport'          => 'post' . $this->get_class_const( 'COMPONENT_ID' ),
				'sanitize_callback'  => 'wp_filter_nohtml_kses',
				'default'            => 'style-plain',
				'conditional_header' => true,
				'label'              => __( 'Hover Skin Mode', 'neve' ),
				'type'               => '\Neve\Customizer\Controls\React\Radio_Buttons',
				'section'            => $this->section,
				'options'            => [
					'large_buttons' => true,
					'is_for'        => 'menu',
				],
			]
		);

		SettingsManager::get_instance()->add(
			[
				'id'                    => self::COLOR_ID,
				'group'                 => $this->get_class_const( 'COMPONENT_ID' ),
				'tab'                   => SettingsManager::TAB_STYLE,
				'transport'             => 'postMessage',
				'sanitize_callback'     => 'sanitize_hex_color',
				'default'               => '#404248',
				'label'                 => __( 'Items Color', 'neve' ),
				'type'                  => 'neve_color_control',
				'section'               => $this->section,
				'conditional_header'    => true,
				'live_refresh_selector' => true,
				'live_refresh_css_prop' => [
					[
						'selector' => $this->default_typography_selector,
						'prop'     => 'color',
						'fallback' => 'inherit',
					],
				],
			]
		);

		SettingsManager::get_instance()->add(
			[
				'id'                    => self::HOVER_COLOR_ID,
				'group'                 => $this->get_class_const( 'COMPONENT_ID' ),
				'tab'                   => SettingsManager::TAB_STYLE,
				'transport'             => 'postMessage',
				'sanitize_callback'     => 'sanitize_hex_color',
				'default'               => '#0366d6',
				'label'                 => __( 'Items Hover Color', 'neve' ),
				'type'                  => 'neve_color_control',
				'section'               => $this->section,
				'conditional_header'    => true,
				'live_refresh_selector' => true,
				'live_refresh_css_prop' => [
					[
						'selector' => $this->default_typography_selector . ':after',
						'prop'     => 'background-color',
						'fallback' => 'inherit',
					],
					[
						'selector' => '.builder-item--' . $this->get_id() . ' .nav-menu-secondary:not(.style-full-height) #secondary-menu li:hover > a',
						'prop'     => 'color',
						'fallback' => 'inherit',
					],
				],
			]
		);

		SettingsManager::get_instance()->add(
			[
				'id'                => 'shortcut',
				'group'             => $this->get_class_const( 'COMPONENT_ID' ),
				'tab'               => SettingsManager::TAB_GENERAL,
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_attr',
				'label'             => __( 'Secondary Menu', 'neve' ),
				'type'              => '\Neve\Customizer\Controls\Button',
				'options'           => [
					'shortcut'     => true,
					'button_class' => 'nv-top-bar-menu-shortcut',
					'icon_class'   => 'menu',
					'button_text'  => __( 'Select Menu', 'neve' ),
				],
				'section'           => $this->section,
			]
		);

		SettingsManager::get_instance()->add(
			[
				'id'                 => self::SPACING,
				'group'              => $this->get_class_const( 'COMPONENT_ID' ),
				'tab'                => SettingsManager::TAB_LAYOUT,
				'section'            => $this->section,
				'label'              => __( 'Items Spacing (px)', 'neve' ),
				'type'               => 'Neve\Customizer\Controls\React\Range',
				'transport'          => 'post' . $this->get_class_const( 'COMPONENT_ID' ),
				'sanitize_callback'  => 'absint',
				'default'            => 20,
				'options'            => [
					'input_attrs' => [
						'min'        => 1,
						'max'        => 100,
						'defaultVal' => 20,
					],
				],
				'conditional_header' => true,
			]
		);

		SettingsManager::get_instance()->add(
			[
				'id'                 => self::ITEM_HEIGHT,
				'group'              => $this->get_class_const( 'COMPONENT_ID' ),
				'tab'                => SettingsManager::TAB_LAYOUT,
				'section'            => $this->section,
				'label'              => __( 'Items Height (px)', 'neve' ),
				'type'               => 'Neve\Customizer\Controls\React\Range',
				'transport'          => 'post' . $this->get_class_const( 'COMPONENT_ID' ),
				'sanitize_callback'  => 'absint',
				'default'            => 25,
				'options'            => [
					'input_attrs' => [
						'min'        => 1,
						'max'        => 100,
						'defaultVal' => 25,
					],
				],
				'conditional_header' => true,
			]
		);
	}

	/**
	 * The render method for the component.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function render_component() {
		Main::get_instance()->load( 'components/component-nav-secondary' );
	}

	/**
	 * Add styles to the component.
	 *
	 * @param array $css_array rules array.
	 *
	 * @return array
	 */
	public function add_style( array $css_array = array() ) {
		$color = get_theme_mod( $this->id . '_color' );
		if ( ! empty( $color ) ) {
			$css_array[ '.builder-item--' . $this->get_id() . ' #secondary-menu a' ] = array( 'color' => sanitize_hex_color( $color ) );
		}

		$hover_color = get_theme_mod( $this->id . '_hover_color' );
		if ( ! empty( $hover_color ) ) {
			$css_array[ '.builder-item--' . $this->get_id() . ' .nav-menu-secondary:not(.style-full-height) #secondary-menu li:hover > a' ] = array( 'color' => sanitize_hex_color( $hover_color ) );
			$css_array[ '.builder-item--' . $this->get_id() . ' #secondary-menu a:after' ] = array( 'background-color' => sanitize_hex_color( $hover_color ) );
		}

		$item_spacing = SettingsManager::get_instance()->get( $this->get_id() . '_' . self::SPACING );
		if ( ! empty( $item_spacing ) ) {
			$css_array[ '.hfg-item-right .builder-item--' . $this->get_id() . ' #secondary-menu > li:not(:first-child)' ] = [ 'margin-left' => absint( $item_spacing ) . 'px' ];
			$css_array[ '.hfg-item-center .builder-item--' . $this->get_id() . ' #secondary-menu li:not(:last-child), .hfg-item-left .builder-item--' . $this->get_id() . ' #secondary-menu > li:not(:last-child)' ] = [ 'margin-right' => absint( $item_spacing ) . 'px' ];
			$css_array[ '.builder-item--' . $this->get_id() . ' .style-full-height #secondary-menu > li > a:after' ]       = [
				'left'  => - $item_spacing / 2 . 'px',
				'right' => - $item_spacing / 2 . 'px',
			];
			$css_array[ '.builder-item--' . $this->get_id() . ' .style-full-height #secondary-menu > li:hover > a:after' ] = [
				'width' => 'calc(100% + ' . $item_spacing . 'px) !important;',
			];
		}

		$item_height = SettingsManager::get_instance()->get( $this->get_id() . '_' . self::ITEM_HEIGHT );
		if ( ! empty( $item_height ) ) {
			$css_array[ '.builder-item--' . $this->get_id() . ' #secondary-menu > li > a' ] = [ 'height' => absint( $item_height ) . 'px' ];
		}

		return parent::add_style( $css_array );
	}
}
