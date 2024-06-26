<?php
/**
 * Properties List Layout
 *
 * Displays properties in list layout
 *
 * @package    realhomes
 * @subpackage modern
 */

/*
 * 1. Apply sticky posts filter.
 * 2. Display google maps.
 */
get_template_part( 'assets/modern/partials/properties/common-top' );

$ajax_pagination_enabled = realhomes_get_ajax_pagination_status();
$ajax_class              = '';

if ( $ajax_pagination_enabled ) {
	$ajax_class = 'ajax-pagination';
}

// getting current template's meta setting for properties count
$template_properties_count = get_post_meta( get_the_ID(), 'inspiry_posts_per_page', true );

// assigning properties count based on availability
$number_of_properties = ( 0 < intval( $template_properties_count ) ) ? $template_properties_count : intval( get_option( 'theme_number_of_properties', 6 ) );
?>

<section id="properties-listing" class="rh_section rh_section--flex rh_wrap--padding rh_wrap--topPadding <?php echo esc_attr( $ajax_class ); ?>" data-properties-count="<?php echo esc_attr( $number_of_properties ); ?>">
	<?php
	// Display any contents after the page banner and before the contents.
	do_action( 'inspiry_before_page_contents' );
	?>
    <div class="rh_page rh_page__listing_page rh_page__main">

		<?php
		global $paged;
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

		// making the query scope global to use inside the template files
		global $property_listing_query;

		// triggering the WP_Query for properties listing
		$property_listing_query = new WP_Query( $property_listing_args );

		if ( $property_listing_query->have_posts() ) :

			/*
			 * 1. Display page's title.
			 * 2. Display pagination stats
			 * 3. Display page's sort controls.
			 * 4. Display page's layout buttons.
			 */
			get_template_part( 'assets/modern/partials/properties/common-content-top' );

			/*
			 * 1. Display page contents.
			 * 2. Display compare properties module.
			 */
			$get_content_position = get_post_meta( get_the_ID(), 'REAL_HOMES_content_area_above_footer', true );

			if ( $get_content_position !== '1' ) {
				get_template_part( 'assets/modern/partials/properties/common-content' );
			}
			?>

            <div class="rh_page__listing">

				<?php
				while ( $property_listing_query->have_posts() ) :
					$property_listing_query->the_post();

					// display property for list layout.
					get_template_part( 'assets/modern/partials/properties/list-card' );

				endwhile;
				wp_reset_postdata();
				?>
            </div><!-- /.rh_page__listing -->
		<?php

		else :
			?>
            <div class="rh_alert-wrapper">
                <h4 class="no-results"><?php esc_html_e( 'No Results Found!', 'framework' ); ?></h4>
            </div>
		<?php
		endif;

		if ( $ajax_pagination_enabled ) {
			realhomes_ajax_pagination( $property_listing_query->max_num_pages, $property_listing_query );
		} else {
			inspiry_theme_pagination( $property_listing_query->max_num_pages );
		}
		?>

    </div>
    <!-- /.rh_page rh_page__main -->
	<?php
	$attached_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar( 'property-listing-sidebar' );
	if ( is_active_sidebar( $attached_sidebar ) ) { ?>
        <div class="rh_page rh_page__sidebar">
	        <?php get_sidebar( 'property-listing' ); ?>
        </div><!-- /.rh_page rh_page__sidebar -->
	<?php } ?>
</section>

<?php
if ( '1' === $get_content_position ) {
	get_template_part( 'assets/modern/partials/properties/common-content' );
}
?>
<!-- /.rh_section rh_wrap rh_wrap--padding -->
