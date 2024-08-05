<?php
/**
 * Search page content.
 *
 * @since      4.2.0
 * @package    realhomes
 * @subpackage ultra
 */

$page_id = get_the_ID();

// Assigning properties count based on availability
$number_of_properties = intval($args['properties_per_page']);

$paged = 1;
if (get_query_var('paged')) {
	$paged = get_query_var('paged');
} else if (get_query_var('page')) { // if is static front page
	$paged = get_query_var('page');
}

$search_args = array(
	'post_type' => 'property',
	'posts_per_page' => $number_of_properties,
	'paged' => $paged,
);

// Apply properties filter.
$search_args = apply_filters('real_homes_search_parameters', $search_args);
$search_args = sort_properties($search_args);
$search_query = new WP_Query($search_args);

$page_layout = $args['page_layout'];
$is_layout_type_full = in_array($page_layout, array('fullwidth', 'fluid_width'));
$is_grid_card = ('grid' === $args['property_card']);

if (isset($_GET['view'])) {
	$is_grid_card = 'grid' === $_GET['view'];
}

if ($is_grid_card) {
	$wrapper_classes = 'rh-ultra-grid-wrapper rh-properties-listing';
	$inner_wrapper_classes = 'rh-ultra-grid-box rh-ultra-card-col-2';

	if ($is_layout_type_full) {
		if ('fullwidth' === $page_layout) {
			$inner_wrapper_classes = 'rh-ultra-grid-box rh-ultra-card-col-3';
		} else if ('fluid_width' === $page_layout) {
			$inner_wrapper_classes = 'rh-ultra-grid-box rh-ultra-card-col-4';
		}
	}
} else {
	$wrapper_classes = 'rh-ultra-list-wrapper';
	$inner_wrapper_classes = 'rh-ultra-list-box';

	if ($is_layout_type_full && 'fluid_width' === $page_layout) {
		$inner_wrapper_classes = 'rh-ultra-list-box rh-ultra-card-col-2';
	}
}

// Display any contents after the page banner and before the contents.
do_action('inspiry_before_page_contents');
?>
<div class="rh-ultra-page-title-area">
	<div class="rh-ultra-title-side">
		<?php
		get_template_part('assets/ultra/partials/page-head');

		get_template_part(
			'assets/ultra/partials/properties/search/page-stats',
			'',
			array(
				'paged' => $paged,
				'listing_query' => $search_query
			)
		);
		?>
	</div>
	<div class="rh-ultra-sorting-side">
		<?php
		get_template_part('assets/ultra/partials/properties/save-alert-button', '', array('search_args' => $search_args));
		get_template_part('assets/ultra/partials/properties/card-parts/sort-control');
		// get_template_part( 'assets/ultra/partials/properties/card-parts/layout-view', null, array( 'is_grid_card' => $is_grid_card ) );
		?>
	</div>
</div>
<div class="<?php echo esc_attr($wrapper_classes); ?>">
	<?php
	// Display page content area at top
	do_action('realhomes_content_area_at_top');
	?>
	<div class="<?php echo esc_attr($inner_wrapper_classes); ?>">
		<?php
		if ($search_query->have_posts()) {
			while ($search_query->have_posts()) {
				$search_query->the_post();

				if ($is_grid_card) {
					get_template_part('assets/ultra/partials/properties/grid-card-' . get_option('realhomes_property_card_variation', '1'));
				} else {
					get_template_part('assets/ultra/partials/properties/list-card-1');
				}
			}

			wp_reset_postdata();
		} else {
			realhomes_print_no_result();
		}
		?>
	</div><!-- .rh_page__listing -->
	<div class="rh-ultra-pagination">
		<?php
		if ($args['ajax_pagination']) {
			realhomes_ajax_pagination($search_query->max_num_pages, $search_query);
		} else {
			inspiry_theme_pagination($search_query->max_num_pages);
		}
		?>
	</div>
	<?php
	// Display page content area at bottom
	do_action('realhomes_content_area_at_bottom');
	?>
</div>