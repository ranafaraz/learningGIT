<?php
/**
 * Template: Property Search Half Map
 *
 * Property search template.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */
get_header();

// Page Head.
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

				// Display page content area at top
				do_action( 'realhomes_content_area_at_top' );
				?>
                <div class="rh-ultra-list-box">
					<?php
					$number_of_properties = intval( get_option( 'theme_properties_on_search' ) );
					if ( ! $number_of_properties ) {
						$number_of_properties = 6;
					}

					$paged = 1;
					if ( get_query_var( 'paged' ) ) {
						$paged = get_query_var( 'paged' );
					} else if ( get_query_var( 'page' ) ) { // if is static front page
						$paged = get_query_var( 'page' );
					}

					$search_args = array(
						'post_type'      => 'property',
						'posts_per_page' => $number_of_properties,
						'paged'          => $paged,
					);

					/* Apply Search Filter */
					$search_args = apply_filters( 'real_homes_search_parameters', $search_args );

					/* Sort Properties */
					$search_args = sort_properties( $search_args );

					$search_query = new WP_Query( $search_args );

					// Elementor Search Form
					get_template_part( 'assets/ultra/partials/properties/search/elementor-search-form' );
					?>
                    <div class="rh-ultra-half-map-sorting">
						<?php
						get_template_part( 'assets/ultra/partials/properties/search/page-stats', '', array(
							'paged'         => $paged,
							'listing_query' => $search_query
						) );
						?>
                        <div class="rh-ultra-sorting-side">
							<?php
							get_template_part( 'assets/ultra/partials/properties/save-alert-button', '', array( 'search_args' => $search_args ) );
							get_template_part( 'assets/ultra/partials/properties/card-parts/sort-control' );
							get_template_part( 'assets/ultra/partials/properties/card-parts/layout-view' );
							?>
                        </div>
                    </div>
					<?php
					if ( $search_query->have_posts() ) {

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
							while ( $search_query->have_posts() ) {
								$search_query->the_post();

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
						realhomes_print_no_result( get_option( 'inspiry_search_template_no_result_text' ) );
					}
					?>
                </div><!-- /.rh_page rh_page__main -->
                <div class="rh-ultra-pagination">
					<?php
					if ( $ajax_pagination_enabled ) {
						realhomes_ajax_pagination( $search_query->max_num_pages, $search_query );
					} else {
						inspiry_theme_pagination( $search_query->max_num_pages );
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
<?php
get_footer();