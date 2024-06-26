<?php
/**
 * Template Name: Properties Gallery
 *
 * @since   4.2.0
 * @package realhomes/templates
 */

do_action( 'inspiry_before_properties_gallery_page_render', get_the_ID() );

get_template_part( 'assets/' . INSPIRY_DESIGN_VARIATION . '/partials/page/properties-gallery' );
