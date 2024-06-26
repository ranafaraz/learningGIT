<?php
/**
 * Page: Properties
 *
 * Template for displaying properties.
 *
 * @since      4.2.0
 * @package    realhomes
 * @subpackage classic
 */

get_header();

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'properties-listing-page' ) ) {
	$page_id = get_the_ID();

	if ( get_post_meta( $page_id, 'realhomes_property_half_map', true ) ) {
		get_template_part( 'assets/classic/partials/properties/half-map-list' );

	} else {
		// Properties page module.
		$theme_listing_module = get_option( 'theme_listing_module' );

		// Only for demo purpose.
		if ( isset( $_GET['module'] ) ) {
			$theme_listing_module = $_GET['module'];
		}

		switch ( $theme_listing_module ) {
			case 'properties-map':
				get_template_part( 'assets/classic/partials/banners/map' );
				break;

			default:
				get_template_part( 'assets/classic/partials/banners/default' );
				break;
		}

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

		if ( 'fullwidth' === $page_layout ) {
			$container_classes[] = 'listing-grid-full-width-layout';
		}

		$property_card = get_post_meta( $page_id, 'realhomes_property_card', true );
		if ( 'grid' === $property_card ) {
			$container_classes[] = 'properties-grid-layout';
		} else {
			$container_classes[] = 'properties-list-layout';
		}

		$property_args = array(
			'page_layout'   => $page_layout,
			'property_card' => $property_card,
		);
		?>
        <div class="contents listing-grid-layout <?php echo join( ' ', $container_classes ); ?> ">
			<?php
			// Display any contents after the page banner and before the contents.
			do_action( 'inspiry_before_page_contents' );

			$page_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar( 'property-listing-sidebar' );
			if ( in_array( $page_layout, array( 'fullwidth', 'fluid_width' ) ) || ! is_active_sidebar( $page_sidebar ) ) {

				if ( 'fluid_width' === $page_layout ) {
					?>
                    <div class="main-wrap">
						<?php get_template_part( 'assets/classic/partials/page/properties-content', null, $property_args ); ?>
                    </div><!-- .main-wrap -->
					<?php
				} else {
					?>
                    <div class="row">
                        <div class="main-wrap span12">
							<?php get_template_part( 'assets/classic/partials/page/properties-content', null, $property_args ); ?>
                        </div><!-- .main-wrap -->
                    </div><!-- .row -->
					<?php
				}

			} else {
				$args = array(
					'sidebar'                   => $page_sidebar,
					'sidebar_container_classes' => 'span3'
				);
				?>
                <div class="row">
					<?php
					if ( 'sidebar_left' === $page_layout ) {
						get_template_part( 'assets/classic/partials/sidebar/sidebar', null, $args );
					}
					?>
                    <div class="main-wrap span9">
						<?php get_template_part( 'assets/classic/partials/page/properties-content', null, $property_args ); ?>
                    </div><!-- .main-wrap -->
					<?php
					if ( in_array( $page_layout, array( 'default', 'sidebar_right' ) ) ) {
						get_template_part( 'assets/classic/partials/sidebar/sidebar', null, $args );
					}
					?>
                </div><!-- .row -->
				<?php
			}
			?>
        </div><!-- .listing-grid-layout -->
		<?php
	}
}

get_footer();