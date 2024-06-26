<?php
/**
 * Section:  `Search Form`
 * Panel:    `Styles`
 *
 * @package realhomes/customizer
 */
if ( ! function_exists( 'inspiry_styles_search_form_customizer' ) ) {
	function inspiry_styles_search_form_customizer( WP_Customize_Manager $wp_customize ) {
		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {

			$wp_customize->add_section( 'inspiry_search_form_styles', array(
				'title' => esc_html__( 'Search Form', 'framework' ),
				'panel' => 'inspiry_styles_panel',
			) );


			$wp_customize->add_setting( 'inspiry_search_form_primary_color', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'inspiry_search_form_primary_color',
					array(
						'label'   => esc_html__( 'Primary Color', 'framework' ),
						'section' => 'inspiry_search_form_styles',
					)
				)
			);

			$wp_customize->add_setting( 'inspiry_search_form_secondary_color', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'inspiry_search_form_secondary_color',
					array(
						'label'   => esc_html__( 'Secondary Color', 'framework' ),
						'section' => 'inspiry_search_form_styles',
					)
				)
			);

			$wp_customize->add_setting( 'inspiry_search_form_active_text', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'inspiry_search_form_active_text',
					array(
						'label'   => esc_html__( 'Button & Dropdown Text Color', 'framework' ),
						'section' => 'inspiry_search_form_styles',
					)
				)
			);

			$wp_customize->add_setting( 'inspiry_advance_search_btn_bg', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'inspiry_advance_search_btn_bg',
					array(
						'label'       => esc_html__( 'Advance Search Button Background', 'framework' ),
						'section'     => 'inspiry_search_form_styles',
						'description' => esc_html__( 'Default color is #18998e', 'framework' ),
					)
				)
			);

			$wp_customize->add_setting( 'inspiry_advance_search_btn_hover_bg', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'inspiry_advance_search_btn_hover_bg',
					array(
						'label'       => esc_html__( 'Advance Search Button Hover Background', 'framework' ),
						'section'     => 'inspiry_search_form_styles',
						'description' => esc_html__( 'Default color is #179086', 'framework' ),
					)
				)
			);

			$wp_customize->add_setting( 'inspiry_advance_search_btn_text', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'inspiry_advance_search_btn_text',
					array(
						'label'       => esc_html__( 'Advance Search Button Icon', 'framework' ),
						'section'     => 'inspiry_search_form_styles',
						'description' => esc_html__( 'Default color is #ffffff', 'framework' ),
					)
				)
			);

			$wp_customize->add_setting( 'inspiry_advance_search_btn_text_hover', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'inspiry_advance_search_btn_text_hover',
					array(
						'label'       => esc_html__( 'Advance Search Button Icon Hover', 'framework' ),
						'section'     => 'inspiry_search_form_styles',
						'description' => esc_html__( 'Default color is #ffffff', 'framework' ),
					)
				)
			);

			$wp_customize->add_setting( 'inspiry_advance_search_arrow_and_text', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control( new WP_Customize_Color_Control(
				$wp_customize,
				'inspiry_advance_search_arrow_and_text',
				array(
					'label'           => esc_html__( 'Advance Search Arrow & Text', 'framework' ),
					'section'         => 'inspiry_search_form_styles',
					'description'     => esc_html__( 'Default color is #333333', 'framework' ),
					'active_callback' => function () {
						if ( 'default' == get_option( 'inspiry_search_form_mod_layout_options', 'default' ) ) {
							return true;
						}

						return false;
					}
				)
			) );
		}
	}

	add_action( 'customize_register', 'inspiry_styles_search_form_customizer' );
}
