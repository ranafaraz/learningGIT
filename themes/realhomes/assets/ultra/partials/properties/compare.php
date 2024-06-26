<?php
/**
 * Property: Compare Properties Template
 *
 * Page template for compare properties.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

get_header();
?>
    <section class="rh-page-container container rh-ultra-compare-properties">
		<?php get_template_part( 'assets/ultra/partials/page-head' ); ?>
        <div class="rh-ultra-compare-properties-inner">
			<?php
			do_action( 'inspiry_before_page_contents' );

			// Display page content area at top
			do_action( 'realhomes_content_area_at_top' );

            // Template file for compare properties.
			get_template_part( 'common/partials/compare' );

			// Display page content area at bottom
			do_action( 'realhomes_content_area_at_bottom' );
			?>
        </div>
    </section>
<?php
get_footer();