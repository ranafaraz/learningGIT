<?php
/**
 * Blog banner.
 *
 * @package    realhomes
 * @subpackage modern
 */

$page_id = get_the_ID();

if ( is_home() ) {
	// If posts page is set in Reading Settings
	$page_for_posts = get_option( 'page_for_posts' );
	if ( ! empty( $page_for_posts ) ) {
		$page_id = $page_for_posts;
	}
}

// Revolution Slider if alias is provided and plugin is installed.
$rev_slider_alias = get_post_meta( $page_id, 'REAL_HOMES_rev_slider_alias', true );
if ( function_exists( 'putRevSlider' ) && ( ! empty( $rev_slider_alias ) ) ) {
	putRevSlider( $rev_slider_alias );
} else {
	$banner_title      = get_option( 'theme_news_banner_title' );
	$banner_title      = empty( $banner_title ) ? esc_html__( 'News', 'framework' ) : $banner_title;
	$banner_image_path = get_default_banner();

	$banner_image_id = get_post_meta( $page_id, 'REAL_HOMES_page_banner_image', true );
	if ( ! empty( $banner_image_id ) ) {
		$banner_image_path = wp_get_attachment_url( $banner_image_id );
	}
	?>
    <section id="rh-banner-attachment-<?php echo esc_attr( get_option( 'inspiry_banner_image_attachment', 'parallax' ) ); ?>" class="rh_banner rh_banner__image" style="background-image: url('<?php echo esc_url( $banner_image_path ); ?>');">
        <div class="rh_banner__cover"></div>
        <div class="rh_banner__wrap">
			<?php if ( is_single() ) { ?>
                <h2 class="rh_banner__title"><?php echo esc_html( $banner_title ); ?></h2>
			<?php } else { ?>
                <h1 class="rh_banner__title"><?php echo esc_html( $banner_title ); ?></h1>
			<?php } ?>
	        <?php if ( is_page_template( array( 'templates/properties.php', 'templates/list-layout.php', 'templates/list-layout-full-width.php', 'templates/grid-layout.php', 'templates/grid-layout-full-width.php' ) ) ) : ?>
                <div class="rh_banner__controls">
					<?php get_template_part( 'assets/modern/partials/properties/view-buttons' ); ?>
                </div>
			<?php endif; ?>
        </div>
    </section>
	<?php
}