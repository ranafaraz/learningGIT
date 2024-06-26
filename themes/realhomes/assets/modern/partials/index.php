<?php
/**
 * Blog: Index Template
 *
 * @package    realhomes
 * @subpackage modern
 */

global $post;

get_header();

$header_variation = get_option( 'inspiry_news_header_variation', 'banner' );

if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) {
	get_template_part( 'assets/modern/partials/banner/header' );
} else if ( ! empty( $header_variation ) && ( 'banner' === $header_variation ) ) {
	get_template_part( 'assets/modern/partials/banner/blog' );
}

if ( inspiry_show_header_search_form() ) {
	get_template_part( 'assets/modern/partials/properties/search/advance' );
}
?>
    <section class="rh_section rh_section--flex rh_wrap--padding rh_wrap--topPadding">
		<?php
		// Display any contents after the page banner and before the contents.
		do_action( 'inspiry_before_page_contents' );

		if ( 'fullwidth' === get_option( 'realhomes_blog_page_layout', 'default' ) ) {
			?>
            <div class="rh_page rh_page__listing_page rh_page__news blog-page-layout-fullwidth">
				<?php
				if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) {
					?>
                    <div class="rh_page__head">
                        <h2 class="rh_page__title">
							<?php
							$banner_title = get_option( 'theme_news_banner_title' );
							$banner_title = empty( $banner_title ) ? esc_html__( 'News', 'framework' ) : $banner_title;

							inspiry_get_exploded_heading( $banner_title );
							?>
                        </h2><!-- /.rh_page__title -->
                    </div><!-- /.rh_page__head -->
					<?php
				}

				get_template_part( 'assets/modern/partials/blog/loop' );
				?>
            </div><!-- /.rh_page rh_page__main -->
			<?php
		} else {
			?>
            <div class="rh_page rh_page__listing_page rh_page__news rh_page__main blog-page-layout-default">
				<?php
				if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) :
					?>
                    <div class="rh_page__head">
                        <h2 class="rh_page__title">
							<?php
							$banner_title = get_option( 'theme_news_banner_title' );
							$banner_title = empty( $banner_title ) ? esc_html__( 'News', 'framework' ) : $banner_title;

							inspiry_get_exploded_heading( $banner_title );
							?>
                        </h2><!-- /.rh_page__title -->
                    </div><!-- /.rh_page__head -->
				<?php
				endif;

				get_template_part( 'assets/modern/partials/blog/loop' );
				?>
            </div><!-- /.rh_page rh_page__main -->
			<?php
			$attached_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar();
			if ( is_active_sidebar( $attached_sidebar ) ) { ?>
                <div class="rh_page rh_page__sidebar">
					<?php get_sidebar(); ?>
                </div><!-- /.rh_page rh_page__sidebar -->
			<?php }
		}
		?>
    </section><!-- /.rh_section rh_wrap rh_wrap--padding -->
<?php
get_footer();

