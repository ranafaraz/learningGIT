<?php
/**
 * Footer Template
 *
 * @package realhomes
 */

if ( ! is_page_template( 'templates/dashboard.php' ) ) {

	$sticky_footer = ( 'true' === get_option( 'realhomes_sticky_footer', 'true' ) && 'classic' !== INSPIRY_DESIGN_VARIATION );

	if ( $sticky_footer ) {
		?>
        <div class="<?php echo esc_attr( 'rh_sticky_wrapper_footer rh_apply_sticky_wrapper_footer rhea-hide-before-load' ); ?>">
		<?php
	}

	if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
		$realhomes_custom_footer_is_selected = get_option( 'realhomes_custom_footer_is_selected', 'default' );
		$realhomes_post_custom_footer        = get_post_meta( get_the_ID(), 'REAL_HOMES_custom_footer_display', true );

		if ( function_exists( 'hfe_footer_enabled' ) && true == hfe_footer_enabled() ) {
			hfe_render_footer();
		} else if ( class_exists( 'RHEA_Elementor_Header_Footer' ) &&
			( 'default' !== $realhomes_custom_footer_is_selected || ( ! empty( $realhomes_post_custom_footer ) && 'default' !== $realhomes_post_custom_footer ) ) ) {
			do_action( 'realhomes_elementor_footer_content' );
		} else {
			get_template_part( 'assets/' . INSPIRY_DESIGN_VARIATION . '/partials/footer' );
		}
	}

	if ( $sticky_footer ) {
		?>
        </div><!-- .rh_sticky_wrapper_footer -->
		<?php
	}

	inspiry_post_nav();

	if ( 'classic' !== INSPIRY_DESIGN_VARIATION ) {
		echo '</div>';
		// close .rh_wrap opened in header.php
	}

	if ( 'true' === get_option( 'inspiry_scroll_to_top', 'true' ) ) {
		?>
        <a href="#top" id="scroll-top" class="<?php echo esc_html( get_option( 'inspiry_scroll_to_top_position', 'stp_right' ) ); ?>"><i class="fas fa-chevron-up"></i></a>
		<?php
	}

	// Floating features.
	get_template_part( 'common/partials/floating-features' );
}

// Include login modal if login & register page URL is not configured
if ( ! is_user_logged_in() ) {
	$theme_login_url   = inspiry_get_login_register_url();
	$prop_detail_login = inspiry_prop_detail_login();
	$skip_prop_single  = ( 'yes' == $prop_detail_login && ! is_user_logged_in() && is_singular( 'property' ) );

	if ( empty( $theme_login_url ) && ( ! is_page_template( 'templates/login-register.php' ) ) &&
		! $skip_prop_single
	) {
		get_template_part( 'common/partials/login-modal' );
	}
}

// Includes the report a property modal.
if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
	if ( ( 'true' === get_option( 'realhomes_enable_report_property', 'false' ) ) && is_singular( 'property' ) ) {
		get_template_part( 'common/partials/report-property-modal' );
	}
}

wp_footer();
?>
</body></html>
