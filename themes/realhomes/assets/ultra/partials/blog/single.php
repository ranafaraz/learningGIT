<?php
/**
 * Single Blog Post
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */
get_header();
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {
	?>
    <div class="rh-page-container container">
        <div class="row">
            <div class="col-8 main-content">
				<?php get_template_part( 'assets/ultra/partials/blog/content' ); ?>
            </div>
			<?php
			$attached_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar();
			if ( is_active_sidebar( $attached_sidebar ) ) {
				?>
                <div class="col-4 sidebar-content">
	                <?php get_sidebar(); ?>
                </div>
				<?php
			}
			?>
        </div>
    </div><!-- .rh-page-container -->
	<?php
}
get_footer();