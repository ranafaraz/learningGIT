<?php
/**
 * Section:  `Tooltip`
 * Panel:    `Styles`
 *
 * @since   4.3.0
 * @package realhomes/customizer
 */
if ( ! function_exists( 'realhomes_ultra_tooltip_customizer' ) ) :
	/**
	 * Adds and configures the RealHomes Ultra Tooltip section in the WordPress Customizer.
	 *
	 * @since   4.3.0
	 *
	 * @param   WP_Customize_Manager $wp_customize - The WordPress Customizer Manager instance.
	 */
	function realhomes_ultra_tooltip_customizer( WP_Customize_Manager $wp_customize ) {
		$wp_customize->add_section( 'realhomes_ultra_tooltip_styles', array(
			'title' => esc_html__( 'Tooltip', 'framework' ),
			'panel' => 'inspiry_styles_panel',
		) );

		$wp_customize->add_setting( 'realhomes_ultra_tooltip_bgcolor', array(
			'type'              => 'option',
			'default'           => '#000',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'realhomes_ultra_tooltip_bgcolor',
			array(
				'label'   => esc_html__( 'Tooltip Background', 'framework' ),
				'section' => 'realhomes_ultra_tooltip_styles',
			)
		) );

		$wp_customize->add_setting( 'realhomes_ultra_tooltip_color', array(
			'type'              => 'option',
			'default'           => '#fff',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'realhomes_ultra_tooltip_color',
			array(
				'label'   => esc_html__( 'Tooltip Color', 'framework' ),
				'section' => 'realhomes_ultra_tooltip_styles',
			)
		) );
	}

	add_action( 'customize_register', 'realhomes_ultra_tooltip_customizer' );
endif;