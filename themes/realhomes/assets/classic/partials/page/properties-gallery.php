<?php
/**
 * Properties Gallery Template
 *
 * @since       4.2.0
 * @package     realhomes
 * @subpackage  classic
 */

get_header();

$number_of_columns = get_post_meta( get_the_ID(), 'realhomes_properties_gallery_column', true );
$gallery_columns   = 'gallery-3-columns';

if ( '2' === $number_of_columns ) {
	$gallery_columns = 'gallery-2-columns';

} else if ( '4' === $number_of_columns ) {
	$gallery_columns = 'gallery-4-columns';
}

get_template_part( 'assets/classic/partials/properties/gallery', null, array(
	'gallery_columns' => $gallery_columns
) );

get_footer();