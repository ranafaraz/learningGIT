<?php
/**
 * Header Template
 *
 * @package    realhomes
 * @subpackage modern
 */
?>
    <div id="rh_progress"></div>
<?php
if ( 'true' === get_option( 'theme_sticky_header', 'false' ) ) {
	$sticky_header_class        = 'sticky_header_dark';
	$sticky_header_color_scheme = get_option( 'realhomes_sticky_header_color_scheme', 'dark' );
	if ( 'light' === $sticky_header_color_scheme ) {
		$sticky_header_class = 'sticky_header_light';
	} else if ( 'custom' === $sticky_header_color_scheme ) {
		$sticky_header_class = 'sticky_header_custom';
	}
	?>
    <div class="rh_mod_sticky_header <?php echo esc_attr( $sticky_header_class ); ?>">
		<?php get_template_part( 'assets/modern/partials/header/sticky-header' ); ?>
    </div>
	<?php
}

$default_mobile = '';
if ( 'default' === get_option( 'realhomes_custom_responsive_header', 'default' ) ) {
	$default_mobile = 'rhea_mobile_nav_is_default';
	?>
    <div class="rh_responsive_header_temp">
		<?php get_template_part( 'assets/modern/partials/header-responsive' ); ?>
    </div>
	<?php
}

$post_id                      = get_the_ID();
$realhomes_custom_header      = get_option( 'realhomes_custom_header', 'default' );
$realhomes_post_custom_header = get_post_meta( $post_id, 'REAL_HOMES_custom_header_display', true );

if ( class_exists( 'RHEA_Elementor_Header_Footer' ) && ( 'default' !== $realhomes_custom_header || ( ! empty( $realhomes_post_custom_header ) && 'default' !== $realhomes_post_custom_header ) ) ) {
	$custom_header_position = get_option( 'inspiry_custom_header_position', 'relative' );
	if ( ! empty( $realhomes_post_custom_header ) && 'default' !== $realhomes_post_custom_header ) {
		$custom_header_position = get_post_meta( $post_id, 'REAL_HOMES_custom_header_position', true );
	}
	?>
    <div class="rhea_long_screen_header_temp rhea-hide-before-load <?php echo sprintf( '%s rhea-custom-header-position-%s', esc_attr( $default_mobile ), esc_attr( $custom_header_position ) ); ?>">
		<?php do_action( 'realhomes_elementor_header_content' ); ?>
    </div>
	<?php
} else {
	?>
    <div class="rh_long_screen_header_temp <?php echo esc_attr( 'rh_header_layout_' . get_option( 'realhomes_header_layout', 'default' ) ); ?>">
		<?php
		$get_header_variations = apply_filters( 'inspiry_header_variation', get_option( 'inspiry_header_mod_variation_option', 'one' ) );
		switch ( $get_header_variations ) {
			case 'two':
				get_template_part( 'assets/modern/partials/header/header-var2' );
				break;
			case 'three':
				get_template_part( 'assets/modern/partials/header/header-var3' );
				break;
			case 'four':
				get_template_part( 'assets/modern/partials/header/header-var4' );
				break;
			default:
				get_template_part( 'assets/modern/partials/header/header-var1' );
		}
		?>
    </div>
	<?php
}