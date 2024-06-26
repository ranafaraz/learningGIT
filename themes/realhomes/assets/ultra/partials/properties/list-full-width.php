<?php
/**
 * Properties grid layout.
 *
 * Displays properties in grid layout.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */


/*
 * 1. Apply sticky posts filter.
 * 2. Display google maps.
 */

get_template_part( 'assets/ultra/partials/properties/common-top' );
$ajax_pagination_enabled = realhomes_get_ajax_pagination_status();
$ajax_class              = '';

if ( $ajax_pagination_enabled ) {
	$ajax_class = 'ajax-pagination';
}

$number_of_properties = intval( get_option( 'theme_number_of_properties' ) );
if ( ! $number_of_properties ) {
	$number_of_properties = 6;
}

$paged = 1;
if ( get_query_var( 'paged' ) ) {
	$paged = get_query_var( 'paged' );
} else if ( get_query_var( 'page' ) ) { // if is static front page
	$paged = get_query_var( 'page' );
}

$property_listing_args = array(
	'post_type'      => 'property',
	'posts_per_page' => $number_of_properties,
	'paged'          => $paged,
);

// Apply properties filter.
$property_listing_args = apply_filters( 'inspiry_properties_filter', $property_listing_args );

$property_listing_args = sort_properties( $property_listing_args );

$property_listing_query = new WP_Query( $property_listing_args );
?>

<section id="properties-listing" class="container rh-page-container rh-list-full-width rh-ultra-list-layout-listing <?php echo esc_attr( $ajax_class ) ?>">
	<?php $banner_title = get_post_meta( get_the_ID(), 'REAL_HOMES_banner_title', true );
	if ( empty( $banner_title ) ) {
		$banner_title = get_the_title( get_the_ID() );
	}
	// Display any contents after the page banner and before the contents.
	do_action( 'inspiry_before_page_contents' );
	?>
    <div class="row">
        <div class="col-12">
            <div class="rh-ultra-page-title-area">
                <div class="rh-ultra-title-side">
					<?php

					get_template_part( 'assets/ultra/partials/page-head' );
					get_template_part( 'assets/ultra/partials/properties/search/page-stats', '', array(
						'paged'         => $paged,
						'listing_query' => $property_listing_query
					) );

					?>
                </div>

                <div class="rh-ultra-sorting-side">

					<?php
					get_template_part( 'assets/ultra/partials/properties/card-parts/sort-control' );
					get_template_part( 'assets/ultra/partials/properties/card-parts/layout-view' );
					?>

                </div>
            </div>

            <div class="rh-ultra-list-wrapper">

				<?php
				// Display page content area at top
				do_action( 'realhomes_content_area_at_top' );
				?>

                <div class="rh-ultra-list-box">

					<?php


					if ( $property_listing_query->have_posts() ) :

						while ( $property_listing_query->have_posts() ) :
							$property_listing_query->the_post();

							// Display property for grid layout.
							get_template_part( 'assets/ultra/partials/properties/list-card-1' );

						endwhile;
						wp_reset_postdata();
					else :
						realhomes_print_no_result();
					endif;
					?>
                </div>
                <!-- /.rh_page__listing -->
                <div class="rh-ultra-pagination">
					<?php
					if ( $ajax_pagination_enabled ) {
						realhomes_ajax_pagination( $property_listing_query->max_num_pages, $property_listing_query );
					} else {
						inspiry_theme_pagination( $property_listing_query->max_num_pages );
					}
					?>
                </div>
				<?php
				// Display page content area at bottom
				do_action( 'realhomes_content_area_at_bottom' );
				?>
            </div>
        </div>
    </div>
</section>

