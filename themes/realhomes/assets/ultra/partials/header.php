<?php
/**
 * Header Template
 *
 * @since      4.0.0
 * @subpackage ultra
 * @package    realhomes
 */

$post_id                = get_the_ID();
$default_mobile         = '';
$custom_header          = get_option( 'realhomes_custom_header', 'default' );
$custom_header_property = get_option( 'realhomes_custom_header_property_single', 'default' );
$post_custom_header     = get_post_meta( $post_id, 'REAL_HOMES_custom_header_display', true );

if ( 'true' === get_option( 'theme_sticky_header', 'false' ) ) {
	get_template_part( 'assets/ultra/partials/header/sticky-header' );
}
if ( ( is_singular( 'property' ) && 'default' === get_option( 'realhomes_custom_responsive_header_property_single', 'default' ) ) ||
	( ! is_singular( 'property' ) && 'default' === get_option( 'realhomes_custom_responsive_header', 'default' ) ) ) {
	$default_mobile = 'rhea_mobile_nav_is_default';
	get_template_part( 'assets/ultra/partials/header-responsive' );
}

if ( class_exists( 'RHEA_Elementor_Header_Footer' ) && ( 'default' !== $custom_header ||
		( is_singular( 'property' ) && 'default' !== $custom_header_property )
		|| ( ! empty( $post_custom_header ) && 'default' !== $post_custom_header ) ) ) {

	if ( ! empty( $post_custom_header ) && 'default' !== $post_custom_header ) {
		$custom_header_position = get_post_meta( $post_id, 'REAL_HOMES_custom_header_position', true );
	} else if ( ( is_singular( 'property' ) && 'default' !== $custom_header_property ) ) {
		$custom_header_position = get_option( 'realhomes_custom_header_position_property', 'relative' );
	} else if ( 'default' !== $custom_header ) {
		$custom_header_position = get_option( 'inspiry_custom_header_position', 'relative' );
	}
	?>
    <div class="rhea_long_screen_header_temp rhea-hide-before-load <?php echo sprintf( '%s rhea-custom-header-position-%s', esc_attr( $default_mobile ), esc_attr( $custom_header_position ) ); ?>">
		<?php do_action( 'realhomes_elementor_header_content' ); ?>
    </div>
	<?php
} else {
	?>
    <header id="masthead" class="site-header rh-ultra-header-wrapper">
		<?php get_template_part( 'assets/ultra/partials/header/site-logo' ); ?>
        <div class="rh-ultra-header-inner">
            <div class="rh-ultra-nav">
				<?php get_template_part( 'assets/ultra/partials/header/menu-list-large-screens' ); ?>
            </div>
            <div class="rh-ultra-nav-wrapper">
                <div class="rh-ultra-social-contacts">
					<?php
					get_template_part( 'assets/ultra/partials/header/social-icons' );
					get_template_part( 'assets/ultra/partials/header/user-phone' );
					get_template_part( 'assets/ultra/partials/header/user-menu' );
					get_template_part( 'assets/ultra/partials/header/submit-property' );
					?>
                </div>
            </div>
        </div>
    </header>
	<?php
}

if ( ! realhomes_is_half_map_template() && ! is_page_template( 'templates/half-map-layout.php' ) && ! is_page_template( 'templates/properties-search-half-map.php' ) ) {
	// Elementor Search Form
	get_template_part( 'assets/ultra/partials/properties/search/elementor-search-form' );
}