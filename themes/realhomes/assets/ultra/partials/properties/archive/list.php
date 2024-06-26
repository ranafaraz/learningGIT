<?php
/**
 * Property archive grid layout.
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
?>
<section id="properties-listing" class="rh-page-container container rh-ultra-list-layout-listing <?php echo esc_attr( $ajax_class ) ?>">
    <div class="row">
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
					if ( is_tax() ) {
						global $wp_query;
						$property_listing_args = array_merge( $wp_query->query_vars, $property_listing_args );
					}

					$property_listing_query = new WP_Query( $property_listing_args );

					get_template_part( 'assets/ultra/partials/page-head' );

					get_template_part( 'assets/ultra/partials/properties/search/page-stats', '', array( 'paged' => $paged, 'listing_query' => $property_listing_query ) );

					?>
                </div>

                <div class="rh-ultra-sorting-side">

                    <div class="rh_sort_controls rh-hide-before-ready">
                        <label for="sort-properties"><?php esc_html_e( 'Sort By:', 'framework' ); ?></label>
						<?php $sort_by = inspiry_get_properties_sort_by_value(); ?>
                        <select name="sort-properties" id="sort-properties" class="inspiry_select_picker_trigger rh-ultra-select-dropdown rh-ultra-select-light show-tick">
                            <option value="default"><?php esc_html_e( 'Default Order', 'framework' ); ?></option>
                            <option value="title-asc" <?php echo ( 'title-asc' == $sort_by ) ? 'selected' : ''; ?>><?php esc_html_e( 'Property Title A to Z', 'framework' ); ?></option>
                            <option value="title-desc" <?php echo ( 'title-desc' == $sort_by ) ? 'selected' : ''; ?>><?php esc_html_e( 'Property Title Z to A', 'framework' ); ?></option>
                            <option value="price-asc" <?php echo ( 'price-asc' == $sort_by ) ? 'selected' : ''; ?>><?php esc_html_e( 'Price Low to High', 'framework' ); ?></option>
                            <option value="price-desc" <?php echo ( 'price-desc' == $sort_by ) ? 'selected' : ''; ?>><?php esc_html_e( 'Price High to Low', 'framework' ); ?></option>
                            <option value="date-asc" <?php echo ( 'date-asc' == $sort_by ) ? 'selected' : ''; ?>><?php esc_html_e( 'Date Old to New', 'framework' ); ?></option>
                            <option value="date-desc" <?php echo ( 'date-desc' == $sort_by ) ? 'selected' : ''; ?>><?php esc_html_e( 'Date New to Old', 'framework' ); ?></option>
                        </select>
                    </div>

                    <div class="rh-ultra-view-type">
						<?php
						$page_url = null;
						// Page url.
						if ( is_post_type_archive( 'property' ) ) {
							$page_url = get_post_type_archive_link( 'property' );
						} else if ( is_tax() ) {

							$current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
							$page_url     = get_term_link( $current_term );

						} else {
							global $post;
							$page_url = get_permalink( get_the_ID() );
						}

						// Separator.
						$separator = ( null == parse_url( $page_url, PHP_URL_QUERY ) ) ? '?' : '&';

						// View Type.
						$view_type = 'list';
						if ( isset( $_GET['view'] ) ) {
							if ( 'grid' === $_GET['view'] ) {
								$view_type = 'grid';
							}
						} else {
							if ( is_page_template( 'templates/grid-layout.php' ) ) {
								$view_type = 'grid';
							}
						}
						?>
                        <a class="grid <?php echo ( 'grid' === $view_type ) ? 'active' : ''; ?>" href="<?php echo esc_url( $page_url . $separator . 'view=grid' ); ?>">
							<?php inspiry_safe_include_svg( '/icons/icon-sort-grid.svg' ); ?>
                        </a>
                        <a class="list <?php echo ( 'list' === $view_type ) ? 'active' : ''; ?>" href="<?php echo esc_url( $page_url . $separator . 'view=list' ); ?>">
							<?php inspiry_safe_include_svg( '/icons/icon-sort-list.svg' ); ?>
                        </a>
                    </div>
                </div>
            </div>
	        <?php inspiry_term_description(); ?>
            <div class="rh-ultra-list-wrapper">
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
                <div class="rh-ultra-pagination">
					<?php
					if ( $ajax_pagination_enabled ) {
						realhomes_ajax_pagination( $property_listing_query->max_num_pages, $property_listing_query );
					} else {
						inspiry_theme_pagination( $property_listing_query->max_num_pages );
					}
					?>
                </div>
            </div>
        </div>
		<?php if ( is_active_sidebar( 'property-listing-sidebar' ) ) : ?>
            <div class="rh-ultra-page-sidebar">
				<?php get_sidebar( 'property-listing' ); ?>
            </div>
		<?php endif; ?>
    </div>
</section>