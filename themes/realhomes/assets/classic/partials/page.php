<?php
/**
 * Page Template
 *
 * @package    realhomes
 * @subpackage classic
 */

get_header();

// Page Head
get_template_part( 'assets/classic/partials/banners/default' );

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {

	$page_layout  = get_post_meta( get_the_ID(), 'realhomes_page_layout', true );
	$page_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar( 'default-page-sidebar' );

	if ( empty( $page_layout ) ) {
		$page_layout = 'default';
	}

	$container_class = 'container';
	if ( 'fluid_width' === $page_layout ) {
		$container_class = 'container-fluid';
	}
	?>
    <div class="<?php echo esc_attr( $container_class ); ?> contents single">
		<?php
		if ( in_array( $page_layout, array( 'fullwidth', 'fluid_width' ) ) || ! is_active_sidebar( $page_sidebar ) ) {

			if ( 'fluid_width' === $page_layout ) {
				?>
                <div class="full-width-row">
                    <div class="main-wrap">
						<?php get_template_part( 'assets/classic/partials/page/page-content' ); ?>
                    </div><!-- .main-wrap -->
                </div><!-- .full-width-row -->
				<?php
			} else {
				?>
                <div class="row">
                    <div class="span12 main-wrap">
						<?php get_template_part( 'assets/classic/partials/page/page-content' ); ?>
                    </div><!-- .main-wrap -->
                </div><!-- .row -->
				<?php
			}
		} else {

			$args = array(
				'sidebar'                   => $page_sidebar,
				'sidebar_container_classes' => 'span4'
			);
			?>
            <div class="row">
				<?php
				if ( 'sidebar_left' === $page_layout ) {
					get_template_part( 'assets/classic/partials/sidebar/sidebar', null, $args );
				}
				?>
                <div class="span8 main-wrap">
					<?php get_template_part( 'assets/classic/partials/page/page-content' ); ?>
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
    </div><!-- .contents -->
	<?php
}

get_footer();