<?php
/**
 * Half Map with Properties List
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */


$ajax_pagination_enabled = realhomes_get_ajax_pagination_status();
$ajax_class              = '';

if ( $ajax_pagination_enabled ) {
	$ajax_class = 'ajax-pagination';
}
?>
<div class="rh-ultra-properties-half-map">
    <div class="rh-ultra-half-map">
		<?php get_template_part( 'assets/ultra/partials/properties/map' ); ?>
    </div>
    <div id="properties-listing" class="rh-ultra-half-map-list <?php echo esc_attr( $ajax_class ) ?>">
        <div class="rh-ultra-list-wrapper">
			<?php
			get_template_part( 'assets/ultra/partials/page-head' );

			?>

            <div class="rh-ultra-list-box">

				<?php
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

				//Elementor Search Form
				get_template_part( 'assets/ultra/partials/properties/search/elementor-search-form' );
				?>
                <div class="rh-ultra-half-map-sorting">
					<?php
					get_template_part( 'assets/ultra/partials/properties/search/page-stats', '', array(
						'paged'         => $paged,
						'listing_query' => $property_listing_query
					) );
					?>
                    <div class="rh-ultra-sorting-side">

						<?php
						get_template_part( 'assets/ultra/partials/properties/card-parts/sort-control' );
						get_template_part( 'assets/ultra/partials/properties/card-parts/layout-view' );
						?>

                    </div>

                </div>

				<?php
				// Display page content area at top
				do_action( 'realhomes_content_area_at_top' );

				if ( $property_listing_query->have_posts() ) {

					$view_type = 'list';
					if ( isset( $_GET['view'] ) ) {
						if ( 'grid' === $_GET['view'] ) {
							$view_type = 'grid';
						}
					}

					?>
                    <!--<div class="rh-ultra-listings-scrolled rh-ultra-half-layout---><?php //echo esc_attr( $view_type ) ?><!--">-->
                    <div class="rh-ultra-half-layout-<?php echo esc_attr( $view_type ) ?>">
						<?php
						while ( $property_listing_query->have_posts() ) {
							$property_listing_query->the_post();

							// Display property for grid layout.
							if ( 'list' === $view_type ) {
								get_template_part( 'assets/ultra/partials/properties/half-map-list-card' );
							} else {
								get_template_part( 'assets/ultra/partials/properties/half-map-grid-card' );

							}

						}
						wp_reset_postdata();
						?>
                    </div>
					<?php
				} else {
					realhomes_print_no_result();
				}
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
