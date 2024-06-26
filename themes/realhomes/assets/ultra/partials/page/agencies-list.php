<?php
/**
 * Page: Agency Listing
 *
 * Page template for agencies listing.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

get_header();

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'agency-listings' ) ) {
	get_template_part( 'assets/ultra/partials/agency/list' );
}

get_footer();