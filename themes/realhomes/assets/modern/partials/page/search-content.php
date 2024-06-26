<?php
/**
 * Search page content.
 *
 * @since      4.2.0
 * @package    realhomes
 * @subpackage modern
 */

$page_id = get_the_ID();

// Assigning properties count based on availability
$number_of_properties = intval( $args['properties_per_page'] );

global $paged;
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

// Making the query scope global to use inside the template files
global $search_query;

$search_query = new WP_Query( $search_args );

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

	if ( $is_layout_type_full ) {
		if ( 'fullwidth' === $page_layout ) {
			$wrapper_classes .= ' rh-grid-3-columns';
		} else if ( 'fluid_width' === $page_layout ) {
			$wrapper_classes .= ' rh-grid-4-columns';
		}
	} else {
		$wrapper_classes .= ' rh-grid-2-columns';
	}

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

if ( $search_query->have_posts() ) {
	?>
    <div class="rh_page__head">
		<?php get_template_part( 'assets/modern/partials/properties/search/page-stats' ); ?>
        <div class="rh_page__controls">
			<?php
			get_template_part( 'assets/modern/partials/properties/save-alert-button', '', array( 'search_args' => $search_args ) );
			get_template_part( 'assets/modern/partials/properties/sort-controls' );
			?>
        </div><!-- .rh_page__controls -->
    </div><!-- .rh_page__head -->
	<?php

	if ( '1' !== $args['content_position'] ) {
		get_template_part( 'assets/modern/partials/properties/common-content' );
	}
	?>
    <div class="<?php echo esc_attr( $wrapper_classes ); ?>">
		<?php
		while ( $search_query->have_posts() ) {
			$search_query->the_post();

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
		<?php
		$inspiry_search_template_no_result_text = get_option( 'inspiry_search_template_no_result_text' );

		if ( ! empty( $inspiry_search_template_no_result_text ) ) {
			?>
            <h4><?php echo inspiry_kses( $inspiry_search_template_no_result_text ); ?></h4>
			<?php
		} else {
			?>
            <h4><?php esc_html_e( 'No Results Found!', 'framework' ); ?></h4>
			<?php
		}
		?>
    </div>
	<?php
}

if ( $args['ajax_pagination'] ) {
	realhomes_ajax_pagination( $search_query->max_num_pages, $search_query );
} else {
	inspiry_theme_pagination( $search_query->max_num_pages );
}