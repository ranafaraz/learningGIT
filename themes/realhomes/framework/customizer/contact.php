<?php
/**
 * Contact Page Customizer Settings
 *
 * @package realhomes/customizer
 */
if ( ! function_exists( 'inspiry_contact_customizer' ) ) {
	function inspiry_contact_customizer( WP_Customize_Manager $wp_customize ) {

		// Contact Section
		$wp_customize->add_section( 'inspiry_contact_section', array(
			'title'    => esc_html__( 'Contact Page', 'framework' ),
			'priority' => 125,
		) );

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			// Header variation
			$wp_customize->add_setting( 'inspiry_contact_header_variation', array(
				'type'              => 'option',
				'default'           => 'banner',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );

			$wp_customize->add_control( 'inspiry_contact_header_variation', array(
				'label'       => esc_html__( 'Header Variation', 'framework' ),
				'description' => esc_html__( 'Header variation to display on Contact Page.', 'framework' ),
				'type'        => 'radio',
				'section'     => 'inspiry_contact_section',
				'choices'     => array(
					'banner' => esc_html__( 'Banner', 'framework' ),
					'none'   => esc_html__( 'None', 'framework' ),
				),
			) );

		} else if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {

			// Show or Hide partners
			$wp_customize->add_setting( 'realhomes_show_partners', array(
				'type'              => 'option',
				'default'           => 'true',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'realhomes_show_partners', array(
				'label'   => esc_html__( 'Partners Section', 'framework' ),
				'type'    => 'radio',
				'section' => 'inspiry_contact_section',
				'choices' => array(
					'true'  => esc_html__( 'Show', 'framework' ),
					'false' => esc_html__( 'Hide', 'framework' ),
				),
			) );

			$wp_customize->add_setting( 'realhomes_partners_section_title', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'realhomes_partners_section_title', array(
				'label'           => esc_html__( 'Partners Section Title', 'framework' ),
				'type'            => 'text',
				'section'         => 'inspiry_contact_section',
				'active_callback' => function () {
					return ( 'true' === get_option( 'realhomes_show_partners', 'true' ) );
				}
			) );

			$wp_customize->add_setting( 'realhomes_partners_section_desc', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'realhomes_partners_section_desc', array(
				'label'           => esc_html__( 'Partners Section Description', 'framework' ),
				'type'            => 'text',
				'section'         => 'inspiry_contact_section',
				'active_callback' => function () {
					return ( 'true' === get_option( 'realhomes_show_partners', 'true' ) );
				}
			) );

			$wp_customize->add_setting( 'realhomes_number_of_partners', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'realhomes_number_of_partners', array(
				'label'           => esc_html__( 'Number of Partners', 'framework' ),
				'description'     => esc_html__( 'Use any integer value. To show all posts use -1 instead.', 'framework' ),
				'type'            => 'text',
				'section'         => 'inspiry_contact_section',
				'active_callback' => function () {
					return ( 'true' === get_option( 'realhomes_show_partners', 'true' ) );
				}
			) );

		}
	}

	add_action( 'customize_register', 'inspiry_contact_customizer' );
}