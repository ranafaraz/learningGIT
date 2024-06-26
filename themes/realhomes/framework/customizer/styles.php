<?php
/**
 * Styles Settings
 *
 * @since   1.0.0
 * @package realhomes/customizer
 */
if ( ! function_exists( 'inspiry_styles_customizer' ) ) {
	/**
	 * Customizer Section: Styles
	 *
	 * @since  1.0.0
	 *
	 * @param WP_Customize_Manager $wp_customize - Instance of WP_Customize_Manager.
	 *
	 */
	function inspiry_styles_customizer( WP_Customize_Manager $wp_customize ) {
		/**
		 * Styles Panel
		 */
		$wp_customize->add_panel( 'inspiry_styles_panel', array(
			'title'    => esc_html__( 'Styles', 'framework' ),
			'priority' => 2,
		) );
	}

	add_action( 'customize_register', 'inspiry_styles_customizer' );
}

/**
 * Typography
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/typography.php' );

/**
 * Round Corners
 */
if ( 'classic' !== INSPIRY_DESIGN_VARIATION ) {
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/round-corners.php' );
}

/**
 * Core Colors
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/core-colors.php' );

/**
 * Header Styles
 */
if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/ultra-header-styles.php' );
} else {
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/header-styles.php' );
}

if ( 'ultra' !== INSPIRY_DESIGN_VARIATION ) {

	/**
	 * Slider
	 */
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/slider.php' );

	/**
	 * Search Form
	 */
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/search-form.php' );

	/**
	 * Banner
	 */
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/banner.php' );

	/**
	 * Home Page Styles
	 */
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/home-page.php' );

	/**
	 * Property Item
	 */
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/property-item.php' );
}

/**
 * Buttons
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/buttons.php' );

if ( 'ultra' !== INSPIRY_DESIGN_VARIATION ) {

	/**
	 * News
	 */
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/news.php' );
}

/**
 * Gallery
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/gallery.php' );

/**
 * Footer
 */
if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {
	// Tooltip
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/ultra-tooltip.php' );

	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/ultra-footer.php' );
} else {
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/footer.php' );
}

if ( 'ultra' !== INSPIRY_DESIGN_VARIATION ) {
	/**
	 * Floating Features CSS
	 */
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/floating-features.php' );
}