<?php
/**
 * Properties Gallery Template
 *
 * @since      4.2.0
 * @package    realhomes
 * @subpackage modern
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

$number_of_columns    = get_post_meta( get_the_ID(), 'realhomes_properties_gallery_column', true );
$gallery_column_class = 'rh_gallery--3-columns';

if ( '2' === $number_of_columns ) {
	$gallery_column_class = 'rh_gallery--2-columns';
} else if ( '4' === $number_of_columns ) {
	$gallery_column_class = 'rh_gallery--4-columns';
}

get_template_part( 'assets/modern/partials/properties/gallery', null, array( 'gallery_column_class' => $gallery_column_class ) );

get_footer();