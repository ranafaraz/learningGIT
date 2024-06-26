<?php
/**
 * Footer Customizer Settings
 *
 * @package realhomes/customizer
 */
if ( ! function_exists( 'inspiry_footer_customizer' ) ) :
	function inspiry_footer_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Footer Panel
		 */
		$wp_customize->add_panel( 'inspiry_footer_panel', array(
			'title'    => esc_html__( 'Footer', 'framework' ),
			'priority' => 121,
		) );

		$wp_customize->add_section( 'realhomes_footer_basics', array(
			'title' => esc_html__( 'Basics', 'framework' ),
			'panel' => 'inspiry_footer_panel',
		) );

		if ( class_exists( 'RHEA_Elementor_Header_Footer' ) ) {
			$wp_customize->add_setting( 'realhomes_custom_footer_is_selected', array(
				'sanitize_callback' => 'inspiry_sanitize_select',
				'type'              => 'option',
				'default'           => 'default',
			) );
			$wp_customize->add_control( 'realhomes_custom_footer_is_selected', array(
				'label'   => esc_html__( 'Custom Footer Template', 'framework' ),
				'type'    => 'select',
				'section' => 'realhomes_footer_basics',
				'choices' => realhomes_get_elementor_library(),
			) );
		}

		if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {

			// Footer background setting
			$wp_customize->add_setting( 'realhomes_site_footer_bg', array(
				'type'              => 'option',
				'sanitize_callback' => 'esc_url_raw',
			) );
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'realhomes_site_footer_bg',
				array(
					'label'           => esc_html__( 'Footer Background', 'framework' ),
					'section'         => 'realhomes_footer_basics',
					'active_callback' => 'realhomes_custom_footer_is_default'
				)
			) );

			$wp_customize->add_setting( 'realhomes_site_footer_bg_opacity', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'realhomes_site_footer_bg_opacity', array(
				'label'           => esc_html__( 'Footer Background Opacity', 'framework' ),
				'description'     => esc_html__( 'Use to set the opacity from 1 to 100.', 'framework' ),
				'type'            => 'text',
				'section'         => 'realhomes_footer_basics',
				'active_callback' => 'realhomes_custom_footer_is_default'
			) );

			$wp_customize->add_setting( 'realhomes_site_footer_bg_opacity_mobile', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'realhomes_site_footer_bg_opacity_mobile', array(
				'label'           => esc_html__( 'Footer Background Opacity for Mobiles', 'framework' ),
				'description'     => esc_html__( 'Use to set the opacity from 1 to 100.', 'framework' ),
				'type'            => 'text',
				'section'         => 'realhomes_footer_basics',
				'active_callback' => 'realhomes_custom_footer_is_default'
			) );

		} else if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {

			// Footer Layout
			$wp_customize->add_setting( 'realhomes_footer_layout', array(
				'type'              => 'option',
				'default'           => 'default',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'realhomes_footer_layout', array(
				'label'           => esc_html__( 'Footer Layout', 'framework' ),
				'type'            => 'radio',
				'section'         => 'realhomes_footer_basics',
				'choices'         => array(
					'default'   => esc_html__( 'Default', 'framework' ),
					'centered'  => esc_html__( 'Centered', 'framework' ),
					'fullwidth' => esc_html__( 'Full Width', 'framework' ),
				),
				'active_callback' => 'realhomes_custom_footer_is_default'
			) );
		}

		if ( 'classic' !== INSPIRY_DESIGN_VARIATION ) {

			// Sticky Footer
			$wp_customize->add_setting( 'realhomes_sticky_footer', array(
				'type'              => 'option',
				'default'           => 'true',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'realhomes_sticky_footer', array(
				'label'   => esc_html__( 'Sticky Footer', 'framework' ),
				'type'    => 'radio',
				'section' => 'realhomes_footer_basics',
				'choices' => array(
					'true'  => 'Enable',
					'false' => 'Disable',
				),
			) );
		}

	}

	add_action( 'customize_register', 'inspiry_footer_customizer' );
endif;


/**
 * Partners
 */
if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/footer/partners.php' );
}

/**
 * Logo
 */
if ( 'classic' !== INSPIRY_DESIGN_VARIATION ) {
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/footer/logo.php' );
}

/**
 * Contact Info
 */
if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/footer/contact-information.php' );
}

/**
 * Layout
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/footer/layout.php' );

/**
 * Text
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/footer/text.php' );


if ( ! function_exists( 'realhomes_custom_footer_is_default' ) ) {
	/**
	 * Check Custom Footer option is selected as 'default'
	 *
	 * @since RealHomes 3.18.0
	 *
	 * @return bool
	 */
	function realhomes_custom_footer_is_default() {
		if ( class_exists( 'RHEA_Elementor_Header_Footer' ) ) {
			$realhomes_custom_footer_is_selected = get_option( 'realhomes_custom_footer_is_selected' );
			if ( $realhomes_custom_footer_is_selected && 'default' !== $realhomes_custom_footer_is_selected ) {
				return false;
			}
		}

		return true;
	}
}