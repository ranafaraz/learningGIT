<?php
/**
 * Page: Properties
 *
 * Template for displaying properties.
 *
 * @since      4.2.0
 * @package    realhomes
 * @subpackage ultra
 */

get_header();

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'properties-listing-page' ) ) {
	$page_id = get_the_ID();

	if ( get_post_meta( $page_id, 'realhomes_property_half_map', true ) ) {
		get_template_part( 'assets/ultra/partials/properties/half-map-list' );

	} else {
		// Getting current template's meta setting for properties count
		$template_properties_count = get_post_meta( $page_id, 'inspiry_posts_per_page', true );

		// Assigning properties count based on availability
		$number_of_properties = ( 0 < intval( $template_properties_count ) ) ? $template_properties_count : get_option( 'theme_number_of_properties', 6 );

		get_template_part( 'assets/ultra/partials/properties/common-top' );

		$page_layout       = get_post_meta( $page_id, 'realhomes_page_layout', true );
		$container_classes = array();

		if ( empty( $page_layout ) ) {
			$page_layout = 'default';
		}

		if ( 'fluid_width' === $page_layout ) {
			$container_classes[] = 'container-fluid';
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
        <section id="properties-listing" class="rh-page-container <?php echo join( ' ', $container_classes ); ?>" data-properties-count="<?php echo esc_attr( $number_of_properties ); ?>">
			<?php
			$page_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar( 'property-listing-sidebar' );

			if ( in_array( $page_layout, array( 'fullwidth', 'fluid_width' ) ) || ! is_active_sidebar( $page_sidebar ) ) {
				?>
                <div class="main-content">
					<?php get_template_part( 'assets/ultra/partials/page/properties-content', null, $property_args ); ?>
                </div><!-- .main-content -->
				<?php
			} else {
				$args = array(
					'sidebar'                   => $page_sidebar,
					'sidebar_container_classes' => 'rh-ultra-page-sidebar'
				);
				?>
                <div class="row">
					<?php
					if ( 'sidebar_left' === $page_layout ) {
						get_template_part( 'assets/ultra/partials/sidebar/sidebar', null, $args );
					}
					?>
                    <div class="col-8 main-content rh-ultra-page-content">
						<?php get_template_part( 'assets/ultra/partials/page/properties-content', null, $property_args ); ?>
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
	}
}

get_footer();