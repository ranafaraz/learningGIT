<?php
/**
 * Page Template
 *
 * Template for simple page.
 *
 * @since    3.0.0
 * @package  realhomes/modern
 */

get_header();

$header_variation = get_option( 'inspiry_pages_header_variation' );
if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) {
	get_template_part( 'assets/modern/partials/banner/header' );
} else if ( ! empty( $header_variation ) && ( 'banner' === $header_variation ) ) {
	get_template_part( 'assets/modern/partials/banner/image' );
}

if ( inspiry_show_header_search_form() ) {
	get_template_part( 'assets/modern/partials/properties/search/advance' );
}

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {

	$page_layout  = get_post_meta( get_the_ID(), 'realhomes_page_layout', true );
	$page_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar( 'default-page-sidebar' );

	if ( empty( $page_layout ) ) {
		$page_layout = 'default';
	}

	$container_class = 'rh_section--flex rh_wrap--padding';
	if ( 'fullwidth' === $page_layout ) {
		$container_class = 'rh_wrap rh_wrap--padding';
	} else if ( 'fluid_width' === $page_layout ) {
		$container_class = 'rh_wrap--fluidwidth';
	}
	?>
    <section class="rh_section rh_wrap--topPadding <?php echo esc_attr( $container_class ); ?>">
		<?php
		// Display any contents after the page banner and before the contents.
		do_action( 'inspiry_before_page_contents' );

		if ( in_array( $page_layout, array( 'fullwidth', 'fluid_width' ) ) || ! is_active_sidebar( $page_sidebar ) ) {
			?>
            <div class="rh_page">
				<?php get_template_part( 'assets/modern/partials/page/page-content' ); ?>
            </div><!-- .rh_page -->
			<?php
		} else {
			$args = array( 'sidebar' => $page_sidebar );

			if ( 'sidebar_left' === $page_layout ) {
				get_template_part( 'assets/modern/partials/sidebar/sidebar', null, $args );
			}
			?>
            <div class="rh_page rh_page__listing_page rh_page__main">
				<?php get_template_part( 'assets/modern/partials/page/page-content' ); ?>
            </div><!-- .rh_page -->
			<?php
			if ( in_array( $page_layout, array( 'default', 'sidebar_right' ) ) ) {
				get_template_part( 'assets/modern/partials/sidebar/sidebar', null, $args );
			}
		}
		?>
    </section><!-- .rh_section--flex -->
	<?php
}

get_footer();