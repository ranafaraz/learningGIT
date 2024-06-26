<?php
/**
 * Custom Single Agency Class To Design and Display Agency Single Page Using Elementor
 *
 * @since 2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class RHEA_Elementor_Single_Agency {

	private $wpml_is_active;
	public function __construct() {

		add_action( 'realhomes_elementor_agency_single_template', array( $this, 'rhea_single_agency' ), 10, 1 );
		$this->wpml_is_active = rhea_wpml_is_active();
	}

	public static function elementor() {
		return \Elementor\Plugin::$instance;
	}

	/**
	 * Generate Single Agency Contents
	 * Used to render and return the post content with all the Elementor elements.
	 *
	 * @since 2.3.0
	 */
	public function rhea_elementor_contents( $id, $attributes = [] ) {

		$rhea_include_css = false;

		if ( isset( $attributes['css'] ) && 'false' !== $attributes['css'] ) {
			$rhea_include_css = (bool)$attributes['css'];
		}

		echo self::elementor()->frontend->get_builder_content_for_display( $id, $rhea_include_css );
	}

	/**
	 * Display Custom Single Agency At Frontend
	 *
	 * @since 2.3.0
	 */
	public function rhea_single_agency() {

		$custom_single_agency_template_meta   = get_post_meta( get_queried_object_id(), 'realhomes_elementor_single_agent_agency_template', true );
		$custom_single_agency_template_option = get_option( 'realhomes_elementor_agency_single_template', 'default' );
		// If WPML is active and this is a request for frontend, then we get translated ID of the custom header
		if ( $this->wpml_is_active ) {
			$current_language = apply_filters( 'wpml_current_language', null );
		}
		if ( ! empty( $custom_single_agency_template_meta ) && 'default' !== $custom_single_agency_template_meta ) {
			if ( $this->wpml_is_active ) {
				$custom_single_agency_template_meta = apply_filters( 'wpml_object_id', $custom_single_agency_template_meta, 'elementor_library', false, $current_language );
			}
			self::rhea_elementor_contents( $custom_single_agency_template_meta );
		} else if ( ( $custom_single_agency_template_option ) && 'default' !== $custom_single_agency_template_option ) {
			if ( $this->wpml_is_active ) {
				$custom_single_agency_template_option = apply_filters( 'wpml_object_id', $custom_single_agency_template_option, 'elementor_library', false, $current_language );
			}
			self::rhea_elementor_contents( $custom_single_agency_template_option );
		} else {
			return;
		}

	}
}

new RHEA_Elementor_Single_Agency();
