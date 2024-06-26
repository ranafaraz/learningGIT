<?php
/**
 * Blog: Index Template
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

get_header();
?>
    <div class="rh-page-container container">
		<?php
		if ( 'fullwidth' === get_option( 'realhomes_blog_page_layout', 'default' ) ) {
			?>
            <div class="main-content blog-page-layout-fullwidth">
				<?php
				get_template_part( 'assets/ultra/partials/page-head' );

				// Display any contents after the page head and before the contents.
				do_action( 'inspiry_before_page_contents' );
				?>
                <main id="main" class="rh-main main">
					<?php get_template_part( 'assets/ultra/partials/blog/loop' ); ?>
                </main>
            </div>
			<?php
		} else {
			?>
            <div class="row">
                <div class="col-8 main-content blog-page-layout-default">
					<?php
					get_template_part( 'assets/ultra/partials/page-head' );

					// Display any contents after the page head and before the contents.
					do_action( 'inspiry_before_page_contents' );
					?>
                    <main id="main" class="rh-main main">
						<?php get_template_part( 'assets/ultra/partials/blog/loop' ); ?>
                    </main>
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
			<?php
		}
		?>
    </div><!-- .rh-page-container -->
<?php
get_footer();