<?php
/**
 * Section:  `Buttons`
 * Panel:    `Styles`
 *
 * @since   3.0.0
 * @package realhomes/customizer
 */
if ( ! function_exists( 'inspiry_styles_buttons_customizer' ) ) :
	/**
	 * inspiry_styles_buttons_customizer.
	 *
	 * @since  3.0.0
	 *
	 * @param WP_Customize_Manager $wp_customize - Instance of WP_Customize_Manager.
	 *
	 */
	function inspiry_styles_buttons_customizer( WP_Customize_Manager $wp_customize ) {

		// Buttons Section
		$wp_customize->add_section( 'inspiry_buttons_styles', array(
			'title' => esc_html__( 'Buttons', 'framework' ),
			'panel' => 'inspiry_styles_panel',
		) );

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$wp_customize->add_setting( 'inspiry_buttons_transition_style', array(
				'type'              => 'option',
				'default'           => 'default',
				'sanitize_callback' => 'inspiry_sanitize_select',
			) );
			$wp_customize->add_control( 'inspiry_buttons_transition_style', array(
				'label'   => esc_html__( 'Transition Style', 'framework' ),
				'type'    => 'select',
				'section' => 'inspiry_buttons_styles',
				'choices' => array(
					'default' => esc_html__( 'Default', 'framework' ),
					'style_1' => esc_html__( 'Style 1', 'framework' ),
					'style_2' => esc_html__( 'Style 2', 'framework' ),
					'style_3' => esc_html__( 'Style 3', 'framework' ),
					'style_4' => esc_html__( 'Style 4', 'framework' ),
					'style_5' => esc_html__( 'Style 5', 'framework' ),
				),
			) );
		}

		$wp_customize->add_setting( 'theme_button_text_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_button_text_color', array(
				'label'   => esc_html__( 'Color', 'framework' ),
				'section' => 'inspiry_buttons_styles',
			)
		) );

		$wp_customize->add_setting( 'theme_button_hover_text_color', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_button_hover_text_color', array(
				'label'   => esc_html__( 'Hover Color', 'framework' ),
				'section' => 'inspiry_buttons_styles',
			)
		) );

		$default_btn_bg_color = '';
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$default_btn_bg_color = '#ec894d';
		} else if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$default_btn_bg_color = '#1ea69a';
		}

		$wp_customize->add_setting( 'theme_button_bg_color', array(
			'type'              => 'option',
			'default'           => $default_btn_bg_color,
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_button_bg_color', array(
				'label'   => esc_html__( 'Background Color', 'framework' ),
				'section' => 'inspiry_buttons_styles'
			)
		) );

		$default_btn_hover_bg_color = '';
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$default_btn_hover_bg_color = '#e3712c';
		} else if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$default_btn_hover_bg_color = '#0b8278';
		}

		$wp_customize->add_setting( 'theme_button_hover_bg_color', array(
			'type'              => 'option',
			'default'           => $default_btn_hover_bg_color,
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_button_hover_bg_color', array(
				'label'   => esc_html__( 'Background Hover Color', 'framework' ),
				'section' => 'inspiry_buttons_styles'
			)
		) );

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {

			$wp_customize->add_setting( 'inspiry_submit_button_border_color', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspiry_submit_button_border_color', array(
					'label'           => esc_html__( 'Header Submit Button Border Color', 'framework' ),
					'section'         => 'inspiry_buttons_styles',
					'active_callback' => function () {
						if ( 'two' == get_option( 'inspiry_header_mod_variation_option' ) ||
							'three' == get_option( 'inspiry_header_mod_variation_option' ) ||
							'four' == get_option( 'inspiry_header_mod_variation_option' ) ) {
							return true;
						}

						return false;
					}
				)
			) );

			$wp_customize->add_setting( 'inspiry_submit_button_border_hover_color', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspiry_submit_button_border_hover_color', array(
					'label'           => esc_html__( 'Header Submit Button Border Hover Color', 'framework' ),
					'section'         => 'inspiry_buttons_styles',
					'active_callback' => function () {
						if ( 'two' == get_option( 'inspiry_header_mod_variation_option' ) ||
							'three' == get_option( 'inspiry_header_mod_variation_option' ) ||
							'four' == get_option( 'inspiry_header_mod_variation_option' ) ) {
							return true;
						}

						return false;
					}
				)
			) );
		}

		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {

			// Separator
			$wp_customize->add_setting( 'inspiry_scroll_to_top_separator', array( 'sanitize_callback' => 'sanitize_text_field', ) );
			$wp_customize->add_control( new Inspiry_Separator_Control( $wp_customize, 'inspiry_scroll_to_top_separator', array(
					'section' => 'inspiry_buttons_styles',
				)
			) );

			$wp_customize->add_setting( 'inspiry_back_to_top_bg_color', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspiry_back_to_top_bg_color', array(
					'label'       => esc_html__( 'Scroll to Top Button Background Color', 'framework' ),
					'section'     => 'inspiry_buttons_styles',
					'description' => esc_html__( 'Default color is #4dc7ec', 'framework' ),
				)
			) );

			$wp_customize->add_setting( 'inspiry_back_to_top_bg_hover_color', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspiry_back_to_top_bg_hover_color', array(
					'label'       => esc_html__( 'Scroll to Top Button Background Hover Color', 'framework' ),
					'section'     => 'inspiry_buttons_styles',
					'description' => esc_html__( 'Default color is #37b3d9', 'framework' ),
				)
			) );

			$wp_customize->add_setting( 'inspiry_back_to_top_color', array(
				'type'              => 'option',
				'default'           => '#fff',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspiry_back_to_top_color', array(
					'label'   => esc_html__( 'Scroll to Top Button Icon Color', 'framework' ),
					'section' => 'inspiry_buttons_styles',
				)
			) );
		}

	}

	add_action( 'customize_register', 'inspiry_styles_buttons_customizer' );
endif;

if ( ! function_exists( 'inspiry_styles_buttons_defaults' ) ) :
	/**
	 * inspiry_styles_buttons_defaults.
	 *
	 * @since  3.0.0
	 *
	 * @param WP_Customize_Manager $wp_customize - Instance of WP_Customize_Manager.
	 *
	 */
	function inspiry_styles_buttons_defaults( WP_Customize_Manager $wp_customize ) {
		$styles_buttons_settings_ids = array(
			'theme_button_text_color',
			'theme_button_bg_color',
			'theme_button_hover_text_color',
			'theme_button_hover_bg_color',
		);
		inspiry_initialize_defaults( $wp_customize, $styles_buttons_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_styles_buttons_defaults' );
endif;