<?php
/**
 *
 * 404 page.
 *
 * @package  realhomes
 * @subpackage modern
 */

get_header();
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {

    $header_variation = get_option( 'inspiry_pages_header_variation' );
	if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) {

        get_template_part( 'assets/modern/partials/banner/header' );

	} elseif ( ( 'banner' === $header_variation ) ) {
		// Banner Image.
		$banner_image_path = get_default_banner();
		?>
        <section class="rh_banner rh_banner__image" style="background-image: url('<?php echo esc_url( $banner_image_path ); ?>');">
            <div class="rh_banner__cover"></div>
        </section>
        <!-- /.rh_banner -->
		<?php
	}
    ?>
	<section class="rh_section rh_wrap--padding rh_wrap--topPadding">
		<div class="rh_page">
            <?php
            $main_404_image = ! empty( get_option('realhomes_404_main_image') ) ? get_option('realhomes_404_main_image') : INSPIRY_COMMON_URI . 'images/404-image.png';
            $main_404_title = ! empty( get_option('realhomes_404_main_title') ) ? get_option('realhomes_404_main_title') : esc_html__( 'It looks like you are lost!', 'framework' );
            $main_404_sub_title = ! empty( get_option('realhomes_404_sub_title') ) ? get_option('realhomes_404_sub_title') : esc_html__( 'Perhaps the above header navigation can help.', 'framework' );
            ?>
			<img src="<?php echo esc_url( $main_404_image ); ?>" alt="404">
			<h2><?php echo esc_html( $main_404_title ); ?></h2>
            <br>
            <h4 class="no-results-sub-title"><?php echo esc_html( $main_404_sub_title ); ?></h4>
			<?php
			if ( is_active_sidebar( '404-sidebar' ) ) {
				?>
				<div class="widgets-404">
					<?php dynamic_sidebar( '404-sidebar' ); ?>
				</div>
				<?php
			}
			?>
		</div>
		<!-- /.rh_page -->
	</section>
	<!-- /.rh_section rh_wrap rh_wrap--padding -->
	<?php
}
get_footer();
