<?php
/**
 * Properties Gallery Template
 *
 * @since      4.2.0
 * @package    realhomes
 * @subpackage ultra
 */

get_header();

$number_of_columns  = get_post_meta( get_the_ID(), 'realhomes_properties_gallery_column', true );
$gallery_columns    = 'properties-gallery-3-columns';
$gallery_properties = 15;

if ( '2' === $number_of_columns ) {
	$gallery_columns    = 'properties-gallery-2-columns';
	$gallery_properties = 10;

} else if ( '4' === $number_of_columns ) {
	$gallery_columns    = 'properties-gallery-4-columns';
	$gallery_properties = 20;
}

get_template_part( 'assets/ultra/partials/properties/gallery', null, array(
	'gallery_columns'    => $gallery_columns,
	'gallery_properties' => $gallery_properties,
) );

get_footer();