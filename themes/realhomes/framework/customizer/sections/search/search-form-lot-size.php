<?php

/**
 * Section:    `Search Form Lot Size`
 * Panel:    `Properties Search`
 *
 * @since 3.19.0
 */

if ( ! function_exists( 'realhomes_search_form_lot_size_customizer' ) ) :

	/**
	 * realhomes_search_form_lot_size_customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize
	 *
	 * @since  3.19.0
	 */
	function realhomes_search_form_lot_size_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Search Form Min & Max Lot Size
		 */
		$wp_customize->add_section( 'realhomes_search_form_lot_size', array(
			'title' => esc_html__( 'Search Form Lot Size', 'framework' ),
			'panel' => 'inspiry_properties_search_panel',
		) );

		/* Min Lot Size Label */
		$wp_customize->add_setting( 'realhomes_min_lot_size_label', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'default'           => esc_html__( 'Min Lot Size', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_min_lot_size_label', array(
			'label'   => esc_html__( 'Label for Min Lot Size Field', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_search_form_lot_size',
		) );

		/* Min Lot Size Label Selective Refresh */
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			if ( isset( $wp_customize->selective_refresh ) ) {
				$wp_customize->selective_refresh->add_partial( 'realhomes_min_lot_size_label', array(
					'selector'            => '.advance-search .option-bar label[for="min-lot-size"]',
					'container_inclusive' => false,
					'render_callback'     => 'realhomes_min_lot_size_label_render',
				) );
			}
		}

		/* Min Lot Size Placeholder Text */
		$wp_customize->add_setting( 'realhomes_min_lot_size_placeholder_text', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'default'           => esc_html__( 'Any', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_min_lot_size_placeholder_text', array(
			'label'   => esc_html__( 'Placeholder Text for Min Lot Size', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_search_form_lot_size',
		) );

		/* Max Lot Size Label */
		$wp_customize->add_setting( 'realhomes_max_lot_size_label', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'default'           => esc_html__( 'Max Lot Size', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_max_lot_size_label', array(
			'label'   => esc_html__( 'Label for Max Lot Size Field', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_search_form_lot_size',
		) );

		/* Max Lot Size Label Selective Refresh */
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			if ( isset( $wp_customize->selective_refresh ) ) {
				$wp_customize->selective_refresh->add_partial( 'realhomes_max_lot_size_label', array(
					'selector'            => '.advance-search .option-bar label[for="max-lot-size"]',
					'container_inclusive' => false,
					'render_callback'     => 'realhomes_max_lot_size_label',
				) );
			}
		}

		/* Max Lot Size Placeholder Text */
		$wp_customize->add_setting( 'realhomes_max_lot_size_placeholder_text', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'default'           => esc_html__( 'Any', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_max_lot_size_placeholder_text', array(
			'label'   => esc_html__( 'Placeholder Text for Max Lot Size', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_search_form_lot_size',
		) );

		/* Area Measurement Unit */
		$wp_customize->add_setting( 'realhomes_lot_size_unit', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'default'           => esc_html__( 'sq ft', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_lot_size_unit', array(
			'label'       => esc_html__( 'Area Measurement Unit for Min and Max Lot Size fields.', 'framework' ),
			'description' => esc_html__( 'Example: sq ft', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_search_form_lot_size',
		) );
	}

	add_action( 'customize_register', 'realhomes_search_form_lot_size_customizer' );
endif;


if ( ! function_exists( 'realhomes_search_form_lot_size_defaults' ) ) :

	/**
	 * realhomes_search_form_lot_size_defaults.
	 *
	 * @since  3.19.0
	 */
	function realhomes_search_form_lot_size_defaults( WP_Customize_Manager $wp_customize ) {
		$search_form_areas_settings_ids = array(
			'realhomes_min_lot_size_label',
			'realhomes_min_lot_size_placeholder_text',
			'realhomes_max_lot_size_label',
			'realhomes_max_lot_size_placeholder_text',
			'realhomes_lot_size_unit',
		);
		inspiry_initialize_defaults( $wp_customize, $search_form_areas_settings_ids );
	}

	add_action( 'customize_save_after', 'realhomes_search_form_lot_size_defaults' );
endif;

/**
 * realhomes_min_lot_size_label_render.
 *
 * @since  3.19.0
 */

if ( ! function_exists( 'realhomes_min_lot_size_label_render' ) ) {
	function realhomes_min_lot_size_label_render() {
		if ( get_option( 'realhomes_min_lot_size_label' ) ) {
			$area_unit = get_option( "realhomes_lot_size_unit" );
			echo get_option( 'realhomes_min_lot_size_label' );
			echo ' <span>' . esc_html( "($area_unit)" ) . '</span>';
		}
	}
}

/**
 * realhomes_max_lot_size_label.
 *
 * @since  3.19.0
 */

if ( ! function_exists( 'realhomes_max_lot_size_label' ) ) {
	function realhomes_max_lot_size_label() {
		if ( get_option( 'realhomes_max_lot_size_label' ) ) {
			$area_unit = get_option( "realhomes_lot_size_unit" );
			echo get_option( 'realhomes_max_lot_size_label' );
			echo ' <span>' . esc_html( "($area_unit)" ) . '</span>';
		}
	}
}
