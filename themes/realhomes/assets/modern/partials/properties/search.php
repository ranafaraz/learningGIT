<?php
/**
 * Template: Properties Search
 *
 * Template for displaying searched properties.
 *
 * @package    realhomes
 * @subpackage modern
 */

$page_id = get_the_ID();

if ( get_post_meta( $page_id, 'realhomes_property_half_map', true ) ) {
	get_template_part( 'assets/modern/partials/page/search-half-map' );

} else {
	get_header();

    // Header Variation
	$header_variation = get_option( 'inspiry_search_header_variation' );

	if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) {
		get_template_part( 'assets/modern/partials/banner/header' );
	} else if ( ! empty( $header_variation ) && ( 'banner' === $header_variation ) ) {
		get_template_part( 'assets/modern/partials/banner/image' );
	}

    // Search Form
	if ( inspiry_show_header_search_form() ) {
		get_template_part( 'assets/modern/partials/properties/search/advance' );
	}

	if ( inspiry_is_search_page_map_visible() ) {
		?>
        <div class="rh_map rh_map__search">
			<?php get_template_part( 'assets/modern/partials/properties/map' ); ?>
        </div><!-- .rh_map__search -->
		<?php
	}

	$number_of_properties = intval( get_option( 'theme_properties_on_search' ) );
	if ( ! $number_of_properties ) {
		$number_of_properties = 6;
	}

	$page_layout       = get_post_meta( $page_id, 'realhomes_page_layout', true );
	$container_classes = array();

	if ( empty( $page_layout ) ) {
		$page_layout = 'default';
	}

	if ( 'fluid_width' === $page_layout ) {
		$container_classes[] = 'rh_wrap--fluidwidth';
	} else {
		$container_classes[] = 'rh_wrap--padding';
	}

	// Ajax pagination
	$ajax_results_status = realhomes_get_ajax_search_results_status();
	if ( $ajax_results_status ) {
		$container_classes[] = 'realhomes_ajax_search';
	}

	// Ajax pagination
	$ajax_pagination_enabled = realhomes_get_ajax_pagination_status();
	if ( $ajax_pagination_enabled ) {
		$container_classes[] = 'ajax-pagination';
	}

	$property_card = get_post_meta( $page_id, 'realhomes_property_card', true );
	$is_grid_card  = ( 'grid' === $property_card );

	if ( isset( $_GET['view'] ) ) {
		$is_grid_card = 'grid' === $_GET['view'];
	}

	$get_content_position = get_post_meta( $page_id, 'REAL_HOMES_content_area_above_footer', true );

	$property_args = array(
		'page_layout'         => $page_layout,
		'properties_per_page' => $number_of_properties,
		'property_card'       => $property_card,
		'ajax_pagination'     => $ajax_pagination_enabled,
		'content_position'    => $get_content_position
	);
	?>
    <section id="properties-listing" class="rh_section rh_section--flex rh_wrap--topPadding <?php echo join( ' ', $container_classes ); ?>" data-properties-count="<?php echo esc_attr( $number_of_properties ); ?>">
		<?php
		$page_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar( 'property-listing-sidebar' );

		$no_map_class = '';
		if ( ! inspiry_is_search_page_map_visible() ) {
			$no_map_class = ' rh_page__listing_page-no-map';
		}

		if ( in_array( $page_layout, array( 'fullwidth', 'fluid_width' ) ) || ! is_active_sidebar( $page_sidebar ) ) {

			if ( $is_grid_card ) {
				$wrapper_class = 'listing__grid_fullwidth';
			} else {
				$wrapper_class = 'listing__list_fullwidth';
			}

			$wrapper_class .= $no_map_class;
			?>
            <div class="rh_page rh_page__listing_page rh_page__main <?php echo esc_attr( $wrapper_class ); ?>" data-search-url="<?php echo inspiry_get_search_page_url(); ?>">
				<?php get_template_part( 'assets/modern/partials/page/search-content', null, $property_args ); ?>
            </div><!-- .<?php echo esc_html( $wrapper_class ); ?> -->
			<?php
		} else {
			$args = array( 'sidebar' => $page_sidebar );

			if ( 'sidebar_left' === $page_layout ) {
				get_template_part( 'assets/modern/partials/sidebar/sidebar', null, $args );
			}
			?>
            <div class="rh_page rh_page__listing_page rh_page__main<?php echo esc_attr( $no_map_class ); ?>" data-search-url="<?php echo inspiry_get_search_page_url(); ?>">
				<?php get_template_part( 'assets/modern/partials/page/search-content', null, $property_args ); ?>
            </div><!-- .rh_page__main -->
			<?php
			if ( in_array( $page_layout, array( 'default', 'sidebar_right' ) ) ) {
				get_template_part( 'assets/modern/partials/sidebar/sidebar', null, $args );
			}
		}
		?>
    </section><!-- .rh_section -->
	<?php

	if ( '1' === $get_content_position ) {
		get_template_part( 'assets/modern/partials/properties/common-content' );
	}

	get_footer();
}