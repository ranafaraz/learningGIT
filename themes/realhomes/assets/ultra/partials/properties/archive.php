<?php
/**
 * Property Archive
 *
 * Template for property archive.
 *
 * @package    realhomes
 * @subpackage ultra
 * @since      4.0.0
 */

get_header();

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'archive' ) ) {
	// global option for archive elementor template
	$realhomes_elementor_property_archive_template = get_option( 'realhomes_elementor_property_archive_template', 'default' );
	if ( class_exists( 'RHEA_Elementor_Archive' ) && ( 'default' !== $realhomes_elementor_property_archive_template ) ) {
		do_action( 'realhomes_elementor_property_archive_template' );
	} else {
		/*
		 * View type as grid layout can also have buttons to display list layout.
		 */

		if ( isset( $_GET['view'] ) ) {
			$view_type = sanitize_text_field( $_GET['view'] );
		} else {
			/* Theme Options Listing Layout */
			$view_type = get_option( 'theme_listing_layout', 'grid' );
		}

		if ( 'list' === $view_type ) {
			get_template_part( 'assets/ultra/partials/properties/archive/list' );
		} else {
			get_template_part( 'assets/ultra/partials/properties/archive/grid' );
		}
	}
}

get_footer();