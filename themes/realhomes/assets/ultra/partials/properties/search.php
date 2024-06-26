<?php
/**
 * Properties Search
 *
 * Property search template.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

$page_id = get_the_ID();

if ( get_post_meta( $page_id, 'realhomes_property_half_map', true ) ) {
	get_template_part( 'assets/ultra/partials/page/search-half-map' );

} else {
	get_header();

	if ( 'map' === get_option( 'realhomes_search_results_page_map', 'map' ) ) {
		?>
        <div class="rh-ultra-properties-map">
			<?php get_template_part( 'assets/ultra/partials/properties/map' ); ?>
        </div>
		<?php
	}

	$number_of_properties = get_option( 'theme_properties_on_search', '6' );
	if ( ! $number_of_properties ) {
		$number_of_properties = 6;
	}

	$page_layout       = get_post_meta( $page_id, 'realhomes_page_layout', true );
	$container_classes = array();

	if ( empty( $page_layout ) ) {
		$page_layout = 'default';
	}

	if ( 'fluid_width' === $page_layout ) {
		$container_classes[] = 'container-fluid';
	} else if ( 'fullwidth' === $page_layout ) {
		$container_classes[] = 'container rh-list-full-width';
	} else {
		$container_classes[] = 'container';
	}

	$ajax_pagination_enabled = realhomes_get_ajax_pagination_status();
	if ( $ajax_pagination_enabled ) {
		$container_classes[] = 'ajax-pagination';
	}

	$property_card = get_post_meta( $page_id, 'realhomes_property_card', true );
	if ( 'grid' === $property_card ) {
		$container_classes[] = 'rh-ultra-grid-listing';
	} else {
		$container_classes[] = 'rh-ultra-list-layout-listing';
	}

	$property_args = array(
		'page_layout'         => $page_layout,
		'properties_per_page' => $number_of_properties,
		'property_card'       => $property_card,
		'ajax_pagination'     => $ajax_pagination_enabled
	);
	?>
    <section id="properties-listing" class="rh-page-container rh-ultra-search-page <?php echo join( ' ', $container_classes ); ?>" data-properties-count="<?php echo esc_attr( $number_of_properties ); ?>">
		<?php
		$page_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar( 'property-listing-sidebar' );

		if ( in_array( $page_layout, array( 'fullwidth', 'fluid_width' ) ) || ! is_active_sidebar( $page_sidebar ) ) {
			?>
            <div class="rh-ultra-search">
				<?php get_template_part( 'assets/ultra/partials/page/search-content', null, $property_args ); ?>
            </div><!-- .rh-ultra-search -->
			<?php
		} else {
			$args = array( 'sidebar' => $page_sidebar );
			?>
            <div class="row">
				<?php
				if ( 'sidebar_left' === $page_layout ) {
					get_template_part( 'assets/ultra/partials/sidebar/sidebar', null, $args );
				}
				?>
                <div class="col-8 main-content">
					<?php get_template_part( 'assets/ultra/partials/page/search-content', null, $property_args ); ?>
                </div><!-- .main-content -->
				<?php
				if ( in_array( $page_layout, array( 'default', 'sidebar_right' ) ) ) {
					get_template_part( 'assets/ultra/partials/sidebar/sidebar', null, $args );
				}
				?>
            </div><!-- .row -->
			<?php
		}
		?>
    </section><!-- .rh-page-container -->
	<?php

	get_footer();
}

