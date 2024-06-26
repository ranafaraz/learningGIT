<?php
/**
 * Template: Properties Search
 *
 * Template for displaying searched properties.
 *
 * @since      2.7.0
 * @since      4.2.0
 * @package    realhomes
 * @subpackage classic
 */

$page_id = get_the_ID();

if ( get_post_meta( $page_id, 'realhomes_property_half_map', true ) ) {
	get_template_part( 'assets/classic/partials/page/search-half-map' );

} else {
	get_header();

	// Theme Home Page Module
	$theme_search_module = get_option( 'theme_search_module' );

	switch ( $theme_search_module ) {
		case 'properties-map':
			get_template_part( 'assets/classic/partials/banners/map' );
			break;

		default:
			get_template_part( 'assets/classic/partials/banners/default' );
			break;
	}

	$page_layout       = get_post_meta( $page_id, 'realhomes_page_layout', true );
	$property_card     = get_post_meta( $page_id, 'realhomes_property_card', true );
	$container_classes = array( 'searched-properties-template' );

	if ( empty( $page_layout ) || 'default' === $page_layout ) {
		$page_layout = 'fullwidth';
	}

	if ( 'fluid_width' === $page_layout ) {
		$container_classes[] = 'container-fluid searched-properties-fluidwidth-template';
	} else {
		$container_classes[] = 'container';
	}

	if ( 'fullwidth' === $page_layout ) {
		$container_classes[] = 'searched-properties-fullwidth-template';
	}

	if ( in_array( $page_layout, array( 'sidebar_left', 'sidebar_right' ) ) ) {
		$container_classes[] = 'listing-grid-layout searched-properties-sidebar-template';
	}

	if ( 'grid' === $property_card ) {
		$container_classes[] = 'searched-properties-grid-layout';
	} else {
		$container_classes[] = 'searched-properties-list-layout';
	}

	$property_args = array(
		'page_layout'   => $page_layout,
		'property_card' => $property_card,
	);
	?>
    <div class="contents <?php echo join( ' ', $container_classes ); ?> ">
		<?php
		// Display any contents after the page banner and before the contents.
		do_action( 'inspiry_before_page_contents' );

		$page_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar( 'property-search-sidebar' );
		if ( in_array( $page_layout, array( 'fullwidth', 'fluid_width' ) ) || ! is_active_sidebar( $page_sidebar ) ) {

			if ( 'fluid_width' === $page_layout ) {
				?>
                <div class="main-wrap">
					<?php get_template_part( 'assets/classic/partials/page/search-content', null, $property_args ); ?>
                </div><!-- .main-wrap -->
				<?php
			} else {
				?>
                <div class="row">
                    <div class="span12">
						<?php get_template_part( 'assets/classic/partials/page/search-content', null, $property_args ); ?>
                    </div><!-- .span12 -->
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
					<?php get_template_part( 'assets/classic/partials/page/search-content', null, $property_args ); ?>
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
	get_footer();
}