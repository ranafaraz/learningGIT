<?php
/**
 * Properties page content.
 *
 * @since      4.2.0
 * @package    realhomes
 * @subpackage modern
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
$property_listing_args = apply_filters( 'inspiry_properties_filter', $property_listing_args );
$property_listing_args = sort_properties( $property_listing_args );

// Making the query scope global to use inside the template files
global $property_listing_query;

$property_listing_query = new WP_Query( $property_listing_args );

// Display any contents after the page banner and before the contents.
do_action( 'inspiry_before_page_contents' );

$page_layout         = $args['page_layout'];
$is_layout_type_full = in_array( $page_layout, array( 'fullwidth', 'fluid_width' ) );
$is_grid_card        = ( 'grid' === $args['property_card'] );

if ( isset( $_GET['view'] ) ) {
	$is_grid_card = 'grid' === $_GET['view'];
}

if ( $is_grid_card ) {
	$wrapper_classes = 'rh_page__listing rh_page__listing_grid';

	if ( 'fluid_width' === $page_layout ) {
		$page_grid_columns = '4';

	} else if ( 'fullwidth' === $page_layout ) {
		$page_grid_columns = get_post_meta( $page_id, 'realhomes_properties_grid_fullwidth_column', true );

		if ( 'default' === $page_grid_columns ) {
			$page_grid_columns = get_option( 'realhomes_grid_fullwidth_template_column', '3' );
		}

	} else if ( in_array( $page_layout, array( 'default', 'sidebar_right', 'sidebar_left', ) ) ) {
		$page_grid_columns = get_post_meta( $page_id, 'realhomes_properties_grid_column', true );

		if ( 'default' === $page_grid_columns ) {
			$page_grid_columns = get_option( 'realhomes_grid_template_column', '2' );
		}
	}

	$wrapper_classes .= sprintf( ' rh-grid-%s-columns', $page_grid_columns );

	$property_card_variation = get_post_meta( $page_id, 'realhomes_properties_card_variation', true );
	if ( empty( $property_card_variation ) || 'default' === $property_card_variation ) {
		$property_card_variation = get_option( 'inspiry_property_card_variation', '1' );
	}

} else {
	$wrapper_classes = 'rh_page__listing';

	if ( $is_layout_type_full && 'fluid_width' === $page_layout ) {
		$wrapper_classes .= ' rh-list-2-columns';
	}
}

if ( $property_listing_query->have_posts() ) {
	/**
	 * 1. Display page's title.
	 * 2. Display pagination stats
	 * 3. Display page's sort controls.
	 * 4. Display page's layout buttons.
	 */
	get_template_part( 'assets/modern/partials/properties/common-content-top' );

	if ( '1' !== $args['content_position'] ) {
		get_template_part( 'assets/modern/partials/properties/common-content' );
	}
	?>
    <div class="<?php echo esc_attr( $wrapper_classes ); ?>">
		<?php
		while ( $property_listing_query->have_posts() ) {
			$property_listing_query->the_post();

			if ( $is_grid_card ) {
				get_template_part( 'assets/modern/partials/properties/grid-card-' . $property_card_variation );
			} else {
				get_template_part( 'assets/modern/partials/properties/list-card' );
			}
		}

		wp_reset_postdata();
		?>
    </div><!-- .rh_page__listing -->
	<?php
} else {
	?>
    <div class="rh_alert-wrapper">
        <h4 class="no-results"><?php esc_html_e( 'No Results Found!', 'framework' ); ?></h4>
    </div>
	<?php
}

if ( $args['ajax_pagination'] ) {
	realhomes_ajax_pagination( $property_listing_query->max_num_pages, $property_listing_query );
} else {
	inspiry_theme_pagination( $property_listing_query->max_num_pages );
}
