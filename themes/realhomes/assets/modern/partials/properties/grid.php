<?php
/**
 * Properties grid layout.
 *
 * Displays properties in grid layout.
 *
 * @since    3.3.2
 * @package  realhomes
 */

/*
 * 1. Apply sticky posts filter.
 * 2. Display Google Maps.
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
			$page_id = get_the_ID();

			$number_of_properties = intval( get_option( 'theme_number_of_properties' ) );
			if ( ! $number_of_properties ) {
				$number_of_properties = 6;
			}

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

			// Making the query scope global to use inside the template files
			global $property_listing_query;

			// Triggering the WP_Query for properties listing
			$property_listing_query = new WP_Query( $property_listing_args );

			if ( $property_listing_query->have_posts() ) {
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
				$get_content_position = get_post_meta( $page_id, 'REAL_HOMES_content_area_above_footer', true );

				if ( $get_content_position !== '1' ) {
					get_template_part( 'assets/modern/partials/properties/common-content' );
				}

				$page_grid_columns = get_post_meta( $page_id, 'realhomes_grid_template_column', true );

				if ( empty( $page_grid_columns ) || 'default' === $page_grid_columns ) {
					$page_grid_columns = get_option( 'realhomes_grid_template_column', '2' );
				}
				?>
                <div class="rh_page__listing rh_page__listing_grid <?php printf( 'rh-grid-%s-columns', esc_attr( $page_grid_columns ) ); ?>">
					<?php
					$property_card_variation = get_post_meta( $page_id, 'inspiry-property-card-meta-box', true );

					if ( empty( $property_card_variation ) || 'default' === $property_card_variation ) {
						$property_card_variation = get_option( 'inspiry_property_card_variation', '1' );
					}

					while ( $property_listing_query->have_posts() ) {
						$property_listing_query->the_post();

						// Display property for grid layout.
						get_template_part( 'assets/modern/partials/properties/grid-card-' . $property_card_variation );
					}

					wp_reset_postdata();
					?>
                </div><!-- /.rh_page__listing -->
				<?php
			} else {
				?>
                <div class="rh_alert-wrapper">
                    <h4 class="no-results"><?php esc_html_e( 'No Results Found!', 'framework' ); ?></h4>
                </div>
				<?php
			}

			if ( $ajax_pagination_enabled ) {
				realhomes_ajax_pagination( $property_listing_query->max_num_pages, $property_listing_query );
			} else {
				inspiry_theme_pagination( $property_listing_query->max_num_pages );
			}
			?>
        </div><!-- /.rh_page rh_page__main -->
	    <?php
	    $attached_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar( 'property-listing-sidebar' );
	    if ( is_active_sidebar( $attached_sidebar ) ) { ?>
            <div class="rh_page rh_page__sidebar">
	            <?php get_sidebar( 'property-listing' ); ?>
            </div><!-- /.rh_page rh_page__sidebar -->
	    <?php } ?>
    </section><!-- /.rh_section rh_wrap rh_wrap--padding -->
<?php
if ( '1' === $get_content_position ) {
	get_template_part( 'assets/modern/partials/properties/common-content' );
}