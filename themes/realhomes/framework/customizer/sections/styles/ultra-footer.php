<?php
if ( ! function_exists( 'realhomes_footer_styles_customizer' ) ) {
	/**
	 * Adds ultra footer styles customizer settings.
	 *
	 * @since 4.0.0
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	function realhomes_footer_styles_customizer( WP_Customize_Manager $wp_customize ) {

		// Footer Section
		$wp_customize->add_section( 'inspiry_footer_styles', array(
			'title' => esc_html__( 'Footer', 'framework' ),
			'panel' => 'inspiry_styles_panel',
		) );

		$wp_customize->add_setting( 'inspiry_footer_bg', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspiry_footer_bg',
			array(
				'label'   => esc_html__( 'Background Color', 'framework' ),
				'section' => 'inspiry_footer_styles',
			)
		) );

		$wp_customize->add_setting( 'theme_footer_widget_text_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_footer_widget_text_color',
			array(
				'label'   => esc_html__( 'Text Color', 'framework' ),
				'section' => 'inspiry_footer_styles',
			)
		) );

		$wp_customize->add_setting( 'theme_footer_widget_link_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_footer_widget_link_color',
			array(
				'label'   => esc_html__( 'Link Color', 'framework' ),
				'section' => 'inspiry_footer_styles',
			)
		) );

		$wp_customize->add_setting( 'theme_footer_widget_link_hover_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_footer_widget_link_hover_color',
			array(
				'label'   => esc_html__( 'Link Hover Color', 'framework' ),
				'section' => 'inspiry_footer_styles',
			)
		) );

		$wp_customize->add_setting( 'theme_footer_widget_title_hover_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_footer_widget_title_hover_color',
			array(
				'label'   => esc_html__( 'Widget Title Color', 'framework' ),
				'section' => 'inspiry_footer_styles',
			)
		) );

		// Footer Contacts Section
		$wp_customize->add_setting( 'realhomes_footer_contact_area_label',
			array( 'sanitize_callback' => 'sanitize_text_field', )
		);
		$wp_customize->add_control( new Inspiry_Heading_Customize_Control( $wp_customize, 'realhomes_footer_contact_area_label',
			array(
				'label'   => esc_html__( 'Contacts Area', 'framework' ),
				'section' => 'inspiry_footer_styles',
			)
		) );

		$wp_customize->add_setting( 'realhomes_footer_contacts_wrapper_bg_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'realhomes_footer_contacts_wrapper_bg_color',
			array(
				'label'   => esc_html__( 'Background Color', 'framework' ),
				'section' => 'inspiry_footer_styles',
			)
		) );

		$wp_customize->add_setting( 'realhomes_footer_contacts_heading_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'realhomes_footer_contacts_heading_color',
			array(
				'label'   => esc_html__( 'Heading Color', 'framework' ),
				'section' => 'inspiry_footer_styles',
			)
		) );

		$wp_customize->add_setting( 'realhomes_footer_contacts_button_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'realhomes_footer_contacts_button_color',
			array(
				'label'   => esc_html__( 'Button Color', 'framework' ),
				'section' => 'inspiry_footer_styles',
			)
		) );

		$wp_customize->add_setting( 'realhomes_footer_contacts_button_bg_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'realhomes_footer_contacts_button_bg_color',
			array(
				'label'   => esc_html__( 'Button Background Color', 'framework' ),
				'section' => 'inspiry_footer_styles',
			)
		) );

		$wp_customize->add_setting( 'realhomes_footer_contacts_button_hover_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'realhomes_footer_contacts_button_hover_color',
			array(
				'label'   => esc_html__( 'Button Hover Color', 'framework' ),
				'section' => 'inspiry_footer_styles',
			)
		) );

		$wp_customize->add_setting( 'realhomes_footer_contacts_button_bg_hover_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'realhomes_footer_contacts_button_bg_hover_color',
			array(
				'label'   => esc_html__( 'Button Hover Background Color', 'framework' ),
				'section' => 'inspiry_footer_styles',
			)
		) );

	}

	add_action( 'customize_register', 'realhomes_footer_styles_customizer' );
}