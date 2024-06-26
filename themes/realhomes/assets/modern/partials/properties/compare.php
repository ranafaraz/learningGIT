<?php
/**
 * Property: Compare Properties Template
 *
 * Page template for compare properties.
 *
 * @since    3.0.0
 * @package  realhomes/modern
 */

get_header();

$header_variation = get_option( 'inspiry_member_pages_header_variation', 'banner' );
if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) {
	get_template_part( 'assets/modern/partials/banner/header' );
} else if ( ! empty( $header_variation ) && ( 'banner' === $header_variation ) ) {
	get_template_part( 'assets/modern/partials/banner/image' );
}

if ( inspiry_show_header_search_form() ) {
	get_template_part( 'assets/modern/partials/properties/search/advance' );
}
?>
    <section class="rh_section rh_wrap rh_wrap--padding rh_wrap--topPadding">
		<?php
		// Display any contents after the page banner and before the contents.
		do_action( 'inspiry_before_page_contents' );
		?>
        <div class="rh_page">
			<?php
			if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) {
				?>
                <div class="rh_page__head">
                    <h2 class="rh_page__title">
						<?php
						$page_title = get_the_title( get_the_ID() );
						inspiry_get_exploded_heading( $page_title );
						?>
                    </h2>
                </div><!-- /.rh_page__head -->
				<?php
			}

			$get_content_position = get_post_meta( get_the_ID(), 'REAL_HOMES_content_area_above_footer', true );
			if ( $get_content_position !== '1' ) {
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						?>
                        <div class="rh_content <?php if ( get_the_content() ) {
							echo esc_attr( 'rh_page__content' );
						} ?>">
							<?php the_content(); ?>
                        </div><!-- /.rh_content -->
						<?php

					}
				}
			}
			?>
            <div class="rh_prop_compare">
				<?php get_template_part( 'common/partials/compare' ); ?>
            </div><!-- /.rh_prop_compare -->
        </div><!-- /.rh_page -->
    </section>
<?php
if ( '1' === $get_content_position ) {
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			?>
            <div class="rh_content <?php if ( get_the_content() ) {
				echo esc_attr( 'rh_page__content' );
			} ?>">
				<?php the_content(); ?>
            </div><!-- /.rh_content -->
			<?php
		}
	}
}

get_footer();