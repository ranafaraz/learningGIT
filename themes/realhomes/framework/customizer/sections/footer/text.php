<?php
/**
 * Section:    `Text`
 * Panel:    `Footer`
 *
 * @since 2.6.3
 */

if ( ! function_exists( 'inspiry_footer_text_customizer' ) ) :

	/**
	 * inspiry_footer_text_customizer.
	 *
	 * @since  2.6.3
	 *
	 * @param WP_Customize_Manager $wp_customize
	 *
	 */
	function inspiry_footer_text_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Footer Text Section
		 */
		$wp_customize->add_section( 'inspiry_footer_text', array(
			'title' => esc_html__( 'Copyright & Designed by Texts', 'framework' ),
			'panel' => 'inspiry_footer_panel',
		) );

		/* Copyright Text */
		$wp_customize->add_setting( 'inspiry_copyright_text_display', array(
			'type'              => 'option',
			'default'           => 'true',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'inspiry_copyright_text_display', array(
			'label'   => esc_html__( 'Copyright Text Display', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_footer_text',
			'choices' => array(
				'true'  => esc_html__( 'Show', 'framework' ),
				'false' => esc_html__( 'Hide', 'framework' ),
			),
		) );

		$wp_customize->add_setting( 'theme_copyright_text', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'wp_kses_data',
		) );
		$wp_customize->add_control( 'theme_copyright_text', array(
			'label'   => esc_html__( 'Copyright Text', 'framework' ),
			'type'    => 'textarea',
			'section' => 'inspiry_footer_text',
		) );

		/* Copyright Text Selective Refresh */
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$footer_copyright_selector = '#footer-bottom p.copyright';
		} else if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$footer_copyright_selector = '.rh_footer .rh_footer__wrap p.copyrights';
		} else if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {
			$footer_copyright_selector = '.site-footer-bottom .copyrights';
		}
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'theme_copyright_text', array(
				'selector'            => $footer_copyright_selector,
				'container_inclusive' => false,
				'render_callback'     => 'inspiry_copyright_text_render',
			) );
		}

		/* Designed By Text */
		$wp_customize->add_setting( 'theme_designed_by_text', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'default'           => 'Designed by <a href="http://www.inspirythemes.com">Inspiry Themes</a>',
			'sanitize_callback' => 'wp_kses_data',
		) );
		$wp_customize->add_control( 'theme_designed_by_text', array(
			'label'   => esc_html__( 'Designed by Text', 'framework' ),
			'type'    => 'textarea',
			'section' => 'inspiry_footer_text',
		) );

		/* Designed By Text Selective Refresh */
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$footer_designed_selector = '#footer-bottom p.designed-by';
		} else if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$footer_designed_selector = '.rh_footer .rh_footer__wrap p.designed-by';
		} else if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {
			$footer_designed_selector = '.site-footer-bottom .designed-by';
		}
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'theme_designed_by_text', array(
				'selector'            => $footer_designed_selector,
				'container_inclusive' => false,
				'render_callback'     => 'inspiry_designed_by_text_render',
			) );
		}

		if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {
			$wp_customize->add_setting(
				'realhomes_footer_designed_text', array(
					'type'              => 'option',
					'default'           => 'left',
					'sanitize_callback' => 'inspiry_sanitize_select',
				)
			);

			$footer_columns = array(
				'left'          => esc_html__( 'Left', 'framework' ),
				'right'         => esc_html__( 'Right', 'framework' ),
				'center'        => esc_html__( 'Center', 'framework' ),
				'space-between' => esc_html__( 'Space Between', 'framework' ),
				'space-even'    => esc_html__( 'Space Evenly', 'framework' ),
				'space-around'  => esc_html__( 'Space Around', 'framework' ),
			);


			$wp_customize->add_control(
				'realhomes_footer_designed_text', array(
					'label'   => esc_html__( 'Text Position for "Copyright & Designed By"  ', 'framework' ),
					'type'    => 'select',
					'section' => 'inspiry_footer_text',
					'choices' => $footer_columns,
				)
			);
		}
	}

	add_action( 'customize_register', 'inspiry_footer_text_customizer' );
endif;


if ( ! function_exists( 'inspiry_footer_text_defaults' ) ) :

	/**
	 * inspiry_footer_text_defaults.
	 *
	 * @since  2.6.3
	 */
	function inspiry_footer_text_defaults( WP_Customize_Manager $wp_customize ) {
		$footer_text_settings_ids = array(
			'theme_designed_by_text'
		);
		inspiry_initialize_defaults( $wp_customize, $footer_text_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_footer_text_defaults' );
endif;


if ( ! function_exists( 'inspiry_copyright_text_render' ) ) {
	function inspiry_copyright_text_render() {
		if ( get_option( 'theme_copyright_text' ) ) {
			echo get_option( 'theme_copyright_text' );
		}
	}
}


if ( ! function_exists( 'inspiry_designed_by_text_render' ) ) {
	function inspiry_designed_by_text_render() {
		if ( get_option( 'theme_designed_by_text' ) ) {
			echo get_option( 'theme_designed_by_text' );
		}
	}
}
