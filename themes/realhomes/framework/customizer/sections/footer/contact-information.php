<?php
if ( ! function_exists( 'realhomes_footer_contact_information_customizer' ) ) {
	/**
	 * Footer Contact Information Options
	 *
	 * @since  4.0.0
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	function realhomes_footer_contact_information_customizer( WP_Customize_Manager $wp_customize ) {

		$wp_customize->add_section( 'realhomes_footer_contact_info', array(
			'title' => esc_html__( 'Contact Information', 'framework' ),
			'panel' => 'inspiry_footer_panel',
		) );

		$wp_customize->add_setting( 'realhomes_footer_need_help', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'default'           => esc_html__( 'Need Help?', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_footer_need_help', array(
			'label'   => esc_html__( 'Contact area title', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_footer_contact_info',
		) );
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'realhomes_footer_need_help', array(
				'selector'            => '.rh-ultra-footer-help',
				'render_callback'     => function () {
					return get_option( 'realhomes_footer_need_help' );
				},
			) );
		}

		$wp_customize->add_setting( 'realhomes_footer_phone', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'default'           => esc_html__( '1-800-555-1234', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_footer_phone', array(
			'label'   => esc_html__( 'Phone Number', 'framework' ),
			'type'    => 'tel',
			'section' => 'realhomes_footer_contact_info',
		) );
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'realhomes_footer_phone', array(
				'selector'            => '.rh-ultra-user-phone-footer span',
				'render_callback'     => function () {
					return get_option( 'realhomes_footer_phone' );
				},
			) );
		}

		$wp_customize->add_setting( 'realhomes_footer_whatsapp', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'default'           => esc_html__( '1-800-555-1234', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_footer_whatsapp', array(
			'label'   => esc_html__( 'WhatsApp Number', 'framework' ),
			'type'    => 'tel',
			'section' => 'realhomes_footer_contact_info',
		) );
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'realhomes_footer_whatsapp', array(
				'selector'            => '.rh-ultra-user-whatsapp-footer span',
				'render_callback'     => function () {
					return get_option( 'realhomes_footer_whatsapp' );
				},
			) );
		}

		$wp_customize->add_setting( 'realhomes_footer_email', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'default'           => esc_html__( 'info@demosite.com', 'framework' ),
			'sanitize_callback' => 'sanitize_email',
		) );
		$wp_customize->add_control( 'realhomes_footer_email', array(
			'label'   => esc_html__( 'Email Address', 'framework' ),
			'type'    => 'email',
			'section' => 'realhomes_footer_contact_info',
		) );
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'realhomes_footer_email', array(
				'selector'            => '.rh-ultra-user-email-footer span',
				'render_callback'     => function () {
					return get_option( 'realhomes_footer_email' );
				},
			) );
		}

	}

	add_action( 'customize_register', 'realhomes_footer_contact_information_customizer' );
}