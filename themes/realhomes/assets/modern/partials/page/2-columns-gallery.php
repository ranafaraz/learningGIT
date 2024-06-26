<?php
/**
 * 2 Columns Gallery
 *
 * @since    3.0.0
 * @package  realhomes
 */

get_header();

$header_variation = get_option( 'inspiry_gallery_header_variation' );

if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) {
	get_template_part( 'assets/modern/partials/banner/header' );
} else if ( ! empty( $header_variation ) && ( 'banner' === $header_variation ) ) {
	get_template_part( 'assets/modern/partials/banner/gallery' );
}

if ( inspiry_show_header_search_form() ) {
	get_template_part( 'assets/modern/partials/properties/search/advance' );
}

get_template_part( 'assets/modern/partials/properties/gallery', null, array( 'gallery_column_class' => 'rh_gallery--2-columns' ) );

get_footer();
