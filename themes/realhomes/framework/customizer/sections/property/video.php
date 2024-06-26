<?php
/**
 * Section:    `Video`
 * Panel:    `Property Detail Page`
 *
 * @since 2.6.3
 */

if ( ! function_exists( 'inspiry_property_video_customizer' ) ) :

	/**
	 * inspiry_property_video_customizer.
	 *
	 * @since  2.6.3
	 *
	 * @param WP_Customize_Manager $wp_customize
	 *
	 */
	function inspiry_property_video_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Video Section
		 */

		$wp_customize->add_section( 'inspiry_property_video', array(
			'title'    => esc_html__( 'Video', 'framework' ),
			'panel'    => 'inspiry_property_panel',
			'priority' => 11
		) );

		/* Show/Hide Video */
		$wp_customize->add_setting( 'theme_display_video', array(
			'type'              => 'option',
			'default'           => 'true',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'theme_display_video', array(
			'label'   => esc_html__( 'Property Video', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_property_video',
			'choices' => array(
				'true'  => esc_html__( 'Show', 'framework' ),
				'false' => esc_html__( 'Hide', 'framework' ),
			),
		) );

		/* Video Title */
		$wp_customize->add_setting( 'theme_property_video_title', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'default'           => esc_html__( 'Property Video', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_property_video_title', array(
			'label'   => esc_html__( 'Property Video Title', 'framework' ),
			'type'    => 'text',
			'section' => 'inspiry_property_video',
		) );

		/* Video Title Selective Refresh */
		$video_title_selector = '';
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$video_title_selector = '.property-video .video-label';
		} else {
			$video_title_selector = '.rh_property__video .rh_property__heading';
		}
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'theme_property_video_title', array(
				'selector'            => $video_title_selector,
				'container_inclusive' => false,
				'render_callback'     => 'inspiry_property_video_title_render',
			) );
		}

	}

	add_action( 'customize_register', 'inspiry_property_video_customizer' );
endif;


if ( ! function_exists( 'inspiry_property_video_defaults' ) ) :

	/**
	 * inspiry_property_video_defaults.
	 *
	 * @since  2.6.3
	 */
	function inspiry_property_video_defaults( WP_Customize_Manager $wp_customize ) {
		$property_video_settings_ids = array(
			'theme_display_video',
			'theme_property_video_title',
		);
		inspiry_initialize_defaults( $wp_customize, $property_video_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_property_video_defaults' );
endif;


if ( ! function_exists( 'inspiry_property_video_title_render' ) ) {
	function inspiry_property_video_title_render() {
		if ( get_option( 'theme_property_video_title' ) ) {
			echo esc_html( get_option( 'theme_property_video_title' ) );
		}
	}
}
