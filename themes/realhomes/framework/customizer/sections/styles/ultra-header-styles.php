<?php
if ( ! function_exists( 'realhomes_header_styles_customizer' ) ) {
	/**
	 * Adds ultra header styles customizer settings.
	 *
	 * @since 4.0.0
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	function realhomes_header_styles_customizer( WP_Customize_Manager $wp_customize ) {

		// Header Section
		$wp_customize->add_section( 'inspiry_header_styles', array(
			'title' => esc_html__( 'Header', 'framework' ),
			'panel' => 'inspiry_styles_panel',
		) );

		// Header Background Color
		$wp_customize->add_setting( 'theme_header_bg_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_header_bg_color',
			array(
				'label'   => esc_html__( 'Background Color', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );

		// Text Logo Colors
		$wp_customize->add_setting( 'theme_logo_text_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_logo_text_color',
			array(
				'label'   => esc_html__( 'Logo Text Color', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );

		$wp_customize->add_setting( 'theme_logo_text_hover_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_logo_text_hover_color',
			array(
				'label'   => esc_html__( 'Logo Text Hover Color', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );

		// Main Menu Colors
		$wp_customize->add_setting( 'theme_main_menu_text_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_main_menu_text_color',
			array(
				'label'   => esc_html__( 'Main Menu Text Color', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );

		$wp_customize->add_setting( 'theme_main_menu_text_hover_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_main_menu_text_hover_color',
			array(
				'label'   => esc_html__( 'Main Menu Text Hover Color', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );

		$wp_customize->add_setting( 'inspiry_main_menu_hover_bg', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspiry_main_menu_hover_bg',
			array(
				'label'   => esc_html__( 'Main Menu Hover Background', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );

		// Dropdown Menu Background Color
		$wp_customize->add_setting( 'theme_menu_bg_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_menu_bg_color',
			array(
				'label'   => esc_html__( 'Dropdown Background Color', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );

		// Dropdown Menu Text Color
		$wp_customize->add_setting( 'theme_menu_text_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_menu_text_color',
			array(
				'label'   => esc_html__( 'Dropdown Menu Text Color', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );

		// Dropdown Menu Text Hover Color
		$wp_customize->add_setting( 'theme_menu_hover_text_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_menu_hover_text_color',
			array(
				'label'   => esc_html__( 'Dropdown Menu Text Hover Color', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );

		// Dropdown Menu Background Color
		$wp_customize->add_setting( 'theme_menu_hover_bg_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_menu_hover_bg_color',
			array(
				'label'   => esc_html__( 'Dropdown Menu Hover Background Color', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );

		// Social Icon Colors
		$wp_customize->add_setting( 'theme_header_social_icon_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_header_social_icon_color',
			array(
				'label'   => esc_html__( 'Social Icons Color', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );

		$wp_customize->add_setting( 'theme_header_social_icon_color_hover', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_header_social_icon_color_hover',
			array(
				'label'   => esc_html__( 'Social Icons Hover Color', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );

		// User menu items separator
		$wp_customize->add_setting( 'realhomes_user_menu_separator', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'realhomes_user_menu_separator',
			array(
				'label'   => esc_html__( 'User Menu Items Separator', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );

		// Phone Number Colors
		$wp_customize->add_setting( 'theme_phone_text_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_phone_text_color',
			array(
				'label'   => esc_html__( 'Phone Number Color', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );

		$wp_customize->add_setting( 'theme_phone_text_color_hover', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_phone_text_color_hover',
			array(
				'label'   => esc_html__( 'Phone Number Hover Color', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );

		$wp_customize->add_setting( 'theme_responsive_submit_button_bg', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_responsive_submit_button_bg',
			array(
				'label'   => esc_html__( 'Submit Button Border Color', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );
		$wp_customize->add_setting( 'theme_responsive_submit_button_bg_hover', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_responsive_submit_button_bg_hover',
			array(
				'label'   => esc_html__( 'Submit Button Hover Background Color', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );

		$wp_customize->add_setting( 'theme_responsive_submit_button_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_responsive_submit_button_color',
			array(
				'label'   => esc_html__( 'Submit Button Text Color', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );

		$wp_customize->add_setting( 'theme_responsive_submit_button_color_hover', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_responsive_submit_button_color_hover',
			array(
				'label'   => esc_html__( 'Submit Button Hover Text Color', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );

		// Responsive Header Section
		$wp_customize->add_setting( 'inspiry_home_responsive_header_labels',
			array( 'sanitize_callback' => 'sanitize_text_field', )
		);
		$wp_customize->add_control( new Inspiry_Heading_Customize_Control( $wp_customize, 'inspiry_home_responsive_header_labels',
			array(
				'label'   => esc_html__( 'Responsive Header', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );

		$wp_customize->add_setting( 'theme_responsive_menu_icon_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_responsive_menu_icon_color',
			array(
				'label'   => esc_html__( 'Menu Icon Color', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );

		$wp_customize->add_setting( 'theme_responsive_menu_bg_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_responsive_menu_bg_color',
			array(
				'label'   => esc_html__( 'Menu Container Background Color', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );

		$wp_customize->add_setting( 'realhomes_responsive_menu_container_bg_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'realhomes_responsive_menu_container_bg_color',
			array(
				'label'   => esc_html__( 'Menu Head Background Color', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );

		$wp_customize->add_setting( 'theme_responsive_menu_text_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_responsive_menu_text_color',
			array(
				'label'   => esc_html__( 'Menu Text Color', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );

		$wp_customize->add_setting( 'theme_responsive_menu_text_hover_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_responsive_menu_text_hover_color',
			array(
				'label'   => esc_html__( 'Menu Text Hover Color', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );

		$wp_customize->add_setting( 'realhomes_responsive_menu_item_border_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'realhomes_responsive_menu_item_border_color',
			array(
				'label'   => esc_html__( 'Menu Item Border Color', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );

		$wp_customize->add_setting( 'realhomes_responsive_menu_item_hover_bg_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'realhomes_responsive_menu_item_hover_bg_color',
			array(
				'label'   => esc_html__( 'Menu Item Background Hover Color', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );

		// Sticky Header Section
		$wp_customize->add_setting( 'realhomes_sticky_header_labels',
			array( 'sanitize_callback' => 'sanitize_text_field', )
		);
		$wp_customize->add_control( new Inspiry_Heading_Customize_Control( $wp_customize, 'realhomes_sticky_header_labels',
			array(
				'label'   => esc_html__( 'Sticky Header', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );

		$wp_customize->add_setting( 'theme_modern_sticky_header_bg_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_modern_sticky_header_bg_color',
			array(
				'label'   => esc_html__( 'Background Color', 'framework' ),
				'section' => 'inspiry_header_styles',
			)
		) );
	}

	add_action( 'customize_register', 'realhomes_header_styles_customizer' );
}