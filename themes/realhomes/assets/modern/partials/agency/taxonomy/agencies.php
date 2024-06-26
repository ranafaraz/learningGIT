<?php
/**
 * Template for agency location taxonomy archives.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage modern
 */

get_header();

// Page Head.
$header_variation = get_option( 'inspiry_listing_header_variation' );

if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) {
	get_template_part( 'assets/modern/partials/banner/header' );
} else if ( ! empty( $header_variation ) && ( 'banner' === $header_variation ) ) {
	get_template_part( 'assets/modern/partials/banner/taxonomy' );
}

if ( inspiry_show_header_search_form() ) {
	get_template_part( 'assets/modern/partials/properties/search/advance' );
}

get_template_part( 'assets/modern/partials/agency/taxonomy/agency-list' );

get_footer();
