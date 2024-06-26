<?php
/**
 * Custom Archive Pages Class
 *
 * @since 2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class RHEA_Elementor_Archive {

	private $wpml_is_active;
	private $current_language;

	public function __construct() {

		add_action( 'realhomes_elementor_property_archive_template', array( $this, 'rhea_property_archive' ), 10, 1 );
		add_action( 'realhomes_elementor_agent_archive_template', array( $this, 'rhea_agent_archive' ), 10, 1 );
		add_action( 'realhomes_elementor_agency_archive_template', array( $this, 'rhea_agency_archive' ), 10, 1 );
		$this->wpml_is_active = rhea_wpml_is_active();
		if ( $this->wpml_is_active ) {
			$this->current_language = apply_filters( 'wpml_current_language', null );
		}
	}

	public static function elementor() {
		return \Elementor\Plugin::$instance;
	}

	/**
	 * Generate Archive & Taxonomy Contents
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
	 * Display Custom Listing Design At Frontend For Property Archive and Taxonomy Template
	 *
	 * @since 2.3.0
	 */
	public function rhea_property_archive() {

		$realhomes_elementor_property_archive_template = get_option( 'realhomes_elementor_property_archive_template', 'default' );
		if ( ( $realhomes_elementor_property_archive_template ) && 'default' !== $realhomes_elementor_property_archive_template ) {
			if ( $this->wpml_is_active ) {
				$realhomes_elementor_property_archive_template = apply_filters( 'wpml_object_id', $realhomes_elementor_property_archive_template, 'elementor_library', false, $this->current_language );
			}
			self::rhea_elementor_contents( $realhomes_elementor_property_archive_template );
		} else {
			return;
		}

	}

	/**
	 * Display Custom Listing Design At Frontend For Agent Archive and Taxonomy Template
	 *
	 * @since 2.3.0
	 */
	public function rhea_agent_archive() {

		$realhomes_elementor_agent_archive_template = get_option( 'realhomes_elementor_agent_archive_template', 'default' );
		if ( ( $realhomes_elementor_agent_archive_template ) && 'default' !== $realhomes_elementor_agent_archive_template ) {
			if ( $this->wpml_is_active ) {
				$realhomes_elementor_agent_archive_template = apply_filters( 'wpml_object_id', $realhomes_elementor_agent_archive_template, 'elementor_library', false, $this->current_language );
			}
			self::rhea_elementor_contents( $realhomes_elementor_agent_archive_template );
		} else {
			return;
		}

	}

	/**
	 * Display Custom Listing Design At Frontend For Agency Archive and Taxonomy Template
	 *
	 * @since 2.3.0
	 */
	public function rhea_agency_archive() {

		$realhomes_elementor_agency_archive_template = get_option( 'realhomes_elementor_agency_archive_template', 'default' );
		if ( ( $realhomes_elementor_agency_archive_template ) && 'default' !== $realhomes_elementor_agency_archive_template ) {
			if ( $this->wpml_is_active ) {
				$realhomes_elementor_agency_archive_template = apply_filters( 'wpml_object_id', $realhomes_elementor_agency_archive_template, 'elementor_library', false, $this->current_language );
			}
			self::rhea_elementor_contents( $realhomes_elementor_agency_archive_template );
		} else {
			return;
		}

	}
}

new RHEA_Elementor_Archive();
