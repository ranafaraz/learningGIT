<?php
/**
 * Banner: Image
 *
 * Image banner for page templates.
 *
 * @package    realhomes
 * @subpackage modern
 */

$page_id = get_the_ID();

// Revolution Slider if alias is provided and plugin is installed.
$rev_slider_alias = get_post_meta( $page_id, 'REAL_HOMES_rev_slider_alias', true );
if ( function_exists( 'putRevSlider' ) && ( ! empty( $rev_slider_alias ) ) ) {
	putRevSlider( $rev_slider_alias );
} else {
	// Banner Image.
	$banner_image_path = '';

	if ( is_page_template( 'templates/home.php' ) ) {
		$banner_image_id = get_post_meta( $page_id, 'REAL_HOMES_home_banner_image', true );
	} else {
		$banner_image_id = get_post_meta( $page_id, 'REAL_HOMES_page_banner_image', true );
	}

	if ( $banner_image_id ) {
		$banner_image_path = wp_get_attachment_url( $banner_image_id );
	} else {
		$banner_image_path = get_default_banner();
	}

	// Banner Title.
	$banner_title = get_post_meta( $page_id, 'REAL_HOMES_banner_title', true );
	if ( empty( $banner_title ) ) {
		$banner_title = get_the_title( $page_id );
	}

	if ( realhomes_is_woocommerce_activated() ) {
		if ( is_shop() ) {
			$banner_title = woocommerce_page_title( false );
		}
	}

	// website level banner title show/hide setting
	$hide_banner_title = get_option( 'theme_banner_titles' );
	if ( is_front_page() ) {
		$hide_banner_title = 'true';
	}
	?>
    <section id="rh-banner-attachment-<?php echo esc_attr( get_option( 'inspiry_banner_image_attachment', 'parallax' ) ); ?>" class="rh_banner rh_banner__image" style="background-image: url('<?php echo esc_url( $banner_image_path ); ?>');">
        <div class="rh_banner__cover"></div>
        <div class="rh_banner__wrap">
			<?php
			// Page level banner title show/hide setting
			$banner_title_display = get_post_meta( $page_id, 'REAL_HOMES_banner_title_display', true );

			if ( ( 'true' != $hide_banner_title ) && ( 'hide' != $banner_title_display ) ) {
				?><h1 class="rh_banner__title"><?php echo esc_html( $banner_title ); ?></h1><?php
			}
			?>
			<?php if ( ( is_page_template( array( 'templates/properties.php', 'templates/properties-search.php' ) ) && '1' !== get_post_meta( $page_id, 'realhomes_property_half_map', true ) ) || is_page_template( array(
					'templates/list-layout.php',
					'templates/list-layout-full-width.php',
					'templates/grid-layout.php',
					'templates/grid-layout-full-width.php'
				) ) ) : ?>
                <div class="rh_banner__controls">
					<?php get_template_part( 'assets/modern/partials/properties/view-buttons' ); ?>
                </div>
			<?php endif; ?>
        </div>
    </section>
	<?php
}
