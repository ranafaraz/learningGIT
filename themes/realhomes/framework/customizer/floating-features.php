<?php
/**
 * Misc Customizer Settings
 *
 * @package realhomes/customizer
 */
if ( ! function_exists( 'inspiry_floating_features_customizer' ) ) {
	function inspiry_floating_features_customizer( WP_Customize_Manager $wp_customize ) {

		$wp_customize->add_section( 'inspiry_floating_features_section', array(
			'title'    => esc_html__( 'Floating Features', 'framework' ),
			'priority' => 130,
		) );

		$wp_customize->add_setting( 'realhomes_popup_panel_section_label', array( 'sanitize_callback' => 'sanitize_text_field', ) );
		$wp_customize->add_control( new Inspiry_Heading_Customize_Control( $wp_customize, 'realhomes_popup_panel_section_label',
			array(
				'label'   => esc_html__( 'Floating Panel Common Settings', 'framework' ),
				'section' => 'inspiry_floating_features_section',
			)
		) );

		$wp_customize->add_setting( 'inspiry_floating_position', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_floating_position', array(
			'label'       => esc_html__( 'Position from Top', 'framework' ),
			'description' => esc_html__( 'i.e 150px or 10%', 'framework' ),
			'type'        => 'text',
			'section'     => 'inspiry_floating_features_section',
		) );

		$wp_customize->add_setting( 'inspiry_default_floating_bar_display', array(
			'default'           => 'show',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'inspiry_default_floating_bar_display', array(
			'label'       => esc_html__( 'Display on Small Devices', 'framework' ),
			'description' => esc_html__( 'On small devices, the panel will be displayed as a bar.', 'framework' ),
			'section'     => 'inspiry_floating_features_section',
			'type'        => 'radio',
			'settings'    => 'inspiry_default_floating_bar_display',
			'choices'     => array(
				'show' => esc_html__( 'Show', 'framework' ),
				'hide' => esc_html__( 'Hide', 'framework' ),
			),
		) );

		if ( function_exists( 'realhomes_currency_switcher_enabled' ) && realhomes_currency_switcher_enabled() ) {
			$wp_customize->add_setting( 'realhomes_currency_switcher_section_label', array( 'sanitize_callback' => 'sanitize_text_field', ) );
			$wp_customize->add_control( new Inspiry_Heading_Customize_Control( $wp_customize, 'realhomes_currency_switcher_section_label',
				array(
					'label'   => esc_html__( 'Currency Switcher Dropdown', 'framework' ),
					'section' => 'inspiry_floating_features_section',
				)
			) );

			$wp_customize->add_setting( 'inspiry_default_floating_button', array(
				'default'           => 'half',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'inspiry_default_floating_button', array(
				'label'    => esc_html__( 'Button Display', 'framework' ),
				'section'  => 'inspiry_floating_features_section',
				'type'     => 'radio',
				'settings' => 'inspiry_default_floating_button',
				'choices'  => array(
					'half' => esc_html__( 'Flag Only', 'framework' ),
					'full' => esc_html__( 'Flag and Currency', 'framework' ),
				),
			) );
		}
	}

	add_action( 'customize_register', 'inspiry_floating_features_customizer' );
}