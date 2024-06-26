<?php
/**
 * Custom Header Footer Class
 *
 * @since 0.9.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class RHEA_Elementor_Header_Footer {

	private $wpml_is_active;
	public function __construct() {

		add_action( 'realhomes_elementor_header_content', array( $this, 'rhea_header' ), 10, 1 );
		add_action( 'realhomes_elementor_footer_content', array( $this, 'rhea_footer' ), 30, 1 );
		$this->wpml_is_active = rhea_wpml_is_active();
	}

	public static function elementor() {
		return \Elementor\Plugin::$instance;
	}

	/**
	 * Generate Header/Footer Contents
	 *
	 * @since 0.9.7
	 */
	public function rhea_elementor_contents( $id, $attributes = [] ) {

		$rhea_include_css = false;

		if ( isset( $attributes['css'] ) && 'false' !== $attributes['css'] ) {
			$rhea_include_css = (bool)$attributes['css'];
		}

		echo self::elementor()->frontend->get_builder_content_for_display( $id, $rhea_include_css );
	}

	/**
	 * Display Custom Header
	 *
	 * @since 0.9.7
	 */
	public function rhea_header() {

		// Getting custom header (if any) from page/post metabox
		$custom_header_for_post = get_post_meta( get_queried_object_id(), 'REAL_HOMES_custom_header_display', true );

		// Getting custom header (if any) from global Customizer settings
		$custom_header_ID = get_option( 'realhomes_custom_header', 'default' );

		// Getting custom header (if any) from global Customizer settings for Property
		$realhomes_custom_header_property_single = get_option( 'realhomes_custom_header_property_single', 'default' );

		if ( $this->wpml_is_active ) {
			$current_language = apply_filters( 'wpml_current_language', null );
		}

		if ( ! empty( $custom_header_for_post ) && 'default' !== $custom_header_for_post ) {
			if ( $this->wpml_is_active ) {
				$custom_header_for_post = apply_filters( 'wpml_object_id', $custom_header_for_post, 'elementor_library', false, $current_language );
			}
			self::rhea_elementor_contents( $custom_header_for_post );
		} else if ( is_singular( 'property' ) && 'default' !== $realhomes_custom_header_property_single ) {
			if ( $this->wpml_is_active ) {
				$realhomes_custom_header_property_single = apply_filters( 'wpml_object_id', $realhomes_custom_header_property_single, 'elementor_library', false, $current_language );
			}
			self::rhea_elementor_contents( $realhomes_custom_header_property_single );
		} else if ( ( $custom_header_ID ) && 'default' !== $custom_header_ID ) {
			if ( $this->wpml_is_active ) {
				$custom_header_ID = apply_filters( 'wpml_object_id', $custom_header_ID, 'elementor_library', false, $current_language );
			}
			self::rhea_elementor_contents( $custom_header_ID );
		} else {
			return;
		}

	}

	/**
	 * Display Custom Footer
	 *
	 * @since 0.9.7
	 */
	public function rhea_footer() {

		// Getting custom header (if any) from page/post metabox
		$custom_footer_for_post = get_post_meta( get_queried_object_id(), 'REAL_HOMES_custom_footer_display', true );

		// Getting custom header (if any) from page/post metabox
		$custom_footer_ID = get_option( 'realhomes_custom_footer_is_selected', 'default' );

		if ( $this->wpml_is_active ) {
			$current_language = apply_filters( 'wpml_current_language', null );
		}

		if ( ! empty( $custom_footer_for_post ) && 'default' !== $custom_footer_for_post ) {
			if ( $this->wpml_is_active ) {
				$custom_footer_for_post = apply_filters( 'wpml_object_id', $custom_footer_for_post, 'elementor_library', false, $current_language );
			}
			self::rhea_elementor_contents( $custom_footer_for_post );
		} else if ( $custom_footer_ID && 'default' !== $custom_footer_ID ) {
			if ( $this->wpml_is_active ) {
				$custom_footer_ID = apply_filters( 'wpml_object_id', $custom_footer_ID, 'elementor_library', false, $current_language );
			}
			self::rhea_elementor_contents( $custom_footer_ID );
		} else {
			return;
		}

	}

}

new RHEA_Elementor_Header_Footer();
