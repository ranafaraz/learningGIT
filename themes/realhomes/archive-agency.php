<?php
/**
 * Agency Archive
 *
 * @package realhomes
 */

get_header();
// global option for archive Elementor template
$realhomes_elementor_property_archive_template = get_option( 'realhomes_elementor_agency_archive_template', 'default' );
if ( class_exists( 'RHEA_Elementor_Archive' ) && ( 'default' !== $realhomes_elementor_property_archive_template ) ) {
	do_action( 'realhomes_elementor_agency_archive_template' );
} else {
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
					<?php
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();

							get_template_part( 'assets/ultra/partials/agency/card' );
						}

						inspiry_theme_pagination();
					} else {
						realhomes_print_no_result();
					}
					?>
                </main>
            </div>
			<?php
			if ( is_active_sidebar( 'agency-sidebar' ) ) {
				?>
                <div class="col-4 sidebar-content">
					<?php get_sidebar( 'agency' ); ?>
                </div>
				<?php
			}
			?>
        </div>
    </div><!-- .rh-page-container -->
	<?php
}

get_footer();