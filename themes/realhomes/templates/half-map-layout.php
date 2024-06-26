<?php
/**
 * Template Name: Properties with Half Map [Deprecated]
 *
 * @package realhomes/templates
 */

do_action( 'inspiry_before_properties_half_map_page_render', get_the_ID() );

get_template_part( 'assets/' . INSPIRY_DESIGN_VARIATION . '/partials/page/properties-with-map' );
