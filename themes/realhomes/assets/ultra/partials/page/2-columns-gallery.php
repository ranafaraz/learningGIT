<?php
/**
 * Gallery 2 Columns Template
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

get_header();

get_template_part( 'assets/ultra/partials/properties/gallery', null, array(
	'gallery_columns'    => 'properties-gallery-2-columns',
	'gallery_properties' => 10,
) );

get_footer();