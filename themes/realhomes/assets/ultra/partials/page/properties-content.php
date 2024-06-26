<?php
/**
 * Properties page content.
 *
 * @since      4.2.0
 * @package    realhomes
 * @subpackage ultra
 */

$page_id = get_the_ID();

// Assigning properties count based on availability
$number_of_properties = intval( $args['properties_per_page'] );

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
$property_listing_args  = apply_filters( 'inspiry_properties_filter', $property_listing_args );
$property_listing_args  = sort_properties( $property_listing_args );
$property_listing_query = new WP_Query( $property_listing_args );

$page_layout         = $args['page_layout'];
$is_layout_type_full = in_array( $page_layout, array( 'fullwidth', 'fluid_width' ) );
$is_grid_card        = ( 'grid' === $args['property_card'] );

if ( isset( $_GET['view'] ) ) {
	$is_grid_card = 'grid' === $_GET['view'];
}

if ( $is_grid_card ) {
	$wrapper_classes       = 'rh-ultra-grid-wrapper rh-properties-listing';
	$inner_wrapper_classes = 'rh-ultra-grid-box rh-ultra-card-col-2';

	if ( $is_layout_type_full ) {
		if ( 'fullwidth' === $page_layout ) {
			$inner_wrapper_classes = 'rh-ultra-grid-box rh-ultra-card-col-3';
		} else if ( 'fluid_width' === $page_layout ) {
			$inner_wrapper_classes = 'rh-ultra-grid-box rh-ultra-card-col-4';
		}
	}
} else {
	$wrapper_classes       = 'rh-ultra-list-wrapper rh-properties-listing';
	$inner_wrapper_classes = 'rh-ultra-list-box rh-list-full-width';

	if ( $is_layout_type_full && 'fluid_width' === $page_layout ) {
		$inner_wrapper_classes = 'rh-ultra-list-box rh-list-full-width rh-ultra-card-col-2';
	}
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
				'listing_query' => $property_listing_query
			) );
			?>
        </div>
        <div class="rh-ultra-sorting-side">
			<?php
			get_template_part( 'assets/ultra/partials/properties/card-parts/sort-control' );
			get_template_part( 'assets/ultra/partials/properties/card-parts/layout-view', null, array( 'is_grid_card' => $is_grid_card ) );
			?>
        </div>
    </div>
    <div class="<?php echo esc_attr( $wrapper_classes ); ?>">
		<?php
		// Display page content area at top
		do_action( 'realhomes_content_area_at_top' );
		?>
        <div class="<?php echo esc_attr( $inner_wrapper_classes ); ?>">
			<?php
			if ( $property_listing_query->have_posts() ) {
				while ( $property_listing_query->have_posts() ) {
					$property_listing_query->the_post();

					if ( $is_grid_card ) {
						get_template_part( 'assets/ultra/partials/properties/grid-card-' . get_option( 'realhomes_property_card_variation', '1' ) );
					} else {
						get_template_part( 'assets/ultra/partials/properties/list-card-1' );
					}
				}

				wp_reset_postdata();
			}
			?>
        </div><!-- .rh_page__listing -->
		<?php
		if ( $property_listing_query->found_posts ) {
			?>
            <div class="rh-ultra-pagination">
				<?php
				if ( $args['ajax_pagination'] ) {
					realhomes_ajax_pagination( $property_listing_query->max_num_pages, $property_listing_query );
				} else {
					inspiry_theme_pagination( $property_listing_query->max_num_pages );
				}
				?>
            </div>
			<?php
		}
		?>
    </div>
<?php
if ( ! $property_listing_query->have_posts() ) {
	realhomes_print_no_result();
}

// Display page content area at bottom
do_action( 'realhomes_content_area_at_bottom' );