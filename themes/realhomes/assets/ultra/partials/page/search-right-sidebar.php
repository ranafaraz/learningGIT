<?php
/**
 * Properties search right sidebar.
 *
 * Displays properties in grid layout.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

get_header();

if ( 'map' === get_option( 'realhomes_search_results_page_map', 'map' ) ) {
	?>
    <div class="rh-ultra-properties-map">
		<?php get_template_part( 'assets/modern/partials/properties/map' ); ?>
    </div>
	<?php
}

/**
 * 1. Apply sticky posts filter.
 * 2. Display google maps.
 */

$ajax_pagination_enabled = realhomes_get_ajax_pagination_status();
$ajax_class              = '';

if ( $ajax_pagination_enabled ) {
	$ajax_class = 'ajax-pagination';
}

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

// Apply properties filter.
$search_args = apply_filters( 'real_homes_search_parameters', $search_args );

$search_args = sort_properties( $search_args );

$search_query = new WP_Query( $search_args );
?>
    <section id="properties-listing" class="rh-page-container container rh-ultra-list-layout-listing <?php echo esc_attr( $ajax_class ) ?>">
        <div class="rh-ultra-page-box">
            <div class="rh-ultra-page-content">
				<?php $banner_title = get_post_meta( get_the_ID(), 'REAL_HOMES_banner_title', true );
				if ( empty( $banner_title ) ) {
					$banner_title = get_the_title( get_the_ID() );
				}
				// Display any contents after the page banner and before the contents.
				do_action( 'inspiry_before_page_contents' );
				?>
                <div class="rh-ultra-page-title-area">
                    <div class="rh-ultra-title-side">
						<?php
						get_template_part( 'assets/ultra/partials/page-head' );

						get_template_part( 'assets/ultra/partials/properties/search/page-stats', '', array(
							'paged'         => $paged,
							'listing_query' => $search_query
						) );
						?>
                    </div>
                    <div class="rh-ultra-sorting-side">
						<?php
						get_template_part( 'assets/ultra/partials/properties/save-alert-button', '', array( 'search_args' => $search_args ) );
						get_template_part( 'assets/ultra/partials/properties/card-parts/sort-control' );
						get_template_part( 'assets/ultra/partials/properties/card-parts/layout-view' );
						?>
                    </div>
                </div>
				<?php
				// Display page content area at top
				do_action( 'realhomes_content_area_at_top' );
				?>
                <div class="rh-ultra-list-wrapper">
					<?php
					$view_type = 'list';
					if ( isset( $_GET['view'] ) ) {
						if ( 'grid' === $_GET['view'] ) {
							$view_type = 'grid';
						}
					}
					?>
                    <div class="rh-ultra-list-box <?php echo esc_attr( 'grid' === $view_type ? ' rh-ultra-grid-box rh-ultra-card-col-2' : '' ); ?>">
						<?php
						if ( $search_query->have_posts() ) :
							while ( $search_query->have_posts() ) :
								$search_query->the_post();

								if ( 'list' === $view_type ) {
									get_template_part( 'assets/ultra/partials/properties/list-card-1' );
								} else {
									get_template_part( 'assets/ultra/partials/properties/grid-card-' . get_option( 'realhomes_property_card_variation', '1' ) );
								}

							endwhile;
							wp_reset_postdata();
						else :
							realhomes_print_no_result();
						endif;
						?>
                    </div><!-- /.rh_page__listing -->
                    <div class="rh-ultra-pagination">
						<?php
						if ( $ajax_pagination_enabled ) {
							realhomes_ajax_pagination( $search_query->max_num_pages, $search_query );
						} else {
							inspiry_theme_pagination( $search_query->max_num_pages );
						}
						?>
                    </div>
                </div>
            </div>
			<?php
			$attached_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar( 'property-listing-sidebar' );
            if ( is_active_sidebar( $attached_sidebar ) ) : ?>
                <div class="rh-ultra-page-sidebar">
	                <?php get_sidebar( 'property-listing' ); ?>
                </div><!-- /.rh_page rh_page__sidebar -->
			<?php
			endif;
			// Display page content area at bottom
			do_action( 'realhomes_content_area_at_bottom' );
			?>
        </div>
    </section>
<?php
get_footer();