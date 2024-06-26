<?php
/**
 * Author Template
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

get_header();

global $wp_query, $current_author;
$current_author = $wp_query->get_queried_object();
?>
    <div class="rh-page-container container">
        <div class="row">
            <div class="col-8 main-content">
				<?php
				get_template_part( 'assets/ultra/partials/page-head' );

				// Display any contents after the page head and before the contents.
				do_action( 'inspiry_before_page_contents' );
				?>
                <main id="main" class="rh-main main">
					<?php get_template_part( 'assets/ultra/partials/author/card' ); ?>

                    <div class="agent-contact-form-wrapper">
                        <h3 class="agent-contact-form-heading rh-page-heading"><?php esc_html_e( 'Contact me', 'framework' ); ?></h3>
						<?php get_template_part( 'assets/ultra/partials/author/contact-form' ); ?>
                    </div>

                    <h3 class="agent-properties-heading rh-page-heading"><?php esc_html_e( 'My Listings', 'framework' ); ?></h3>
                    <div class="agent-properties">
						<?php
						if ( have_posts() ) {
							while ( have_posts() ) {
								the_post();

								get_template_part( 'assets/ultra/partials/properties/list-card-1' );
							}

							inspiry_theme_pagination( $wp_query->max_num_pages );
						} else {
							realhomes_print_no_result();
						}
						?>
                    </div>
                </main>
            </div>
			<?php
			$attached_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar( 'agent-sidebar' );
			if ( is_active_sidebar( $attached_sidebar ) ) {
				?>
                <div class="col-4 sidebar-content">
	                <?php get_sidebar( 'agent' ); ?>
                </div>
				<?php
			}
			?>
        </div>
    </div><!-- .rh-page-container -->
<?php
get_footer();