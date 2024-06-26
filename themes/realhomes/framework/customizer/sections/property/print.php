<?php
/**
 * Section: Print
 * Panel: Property Detail Page
 *
 * @since 4.0.1
 */
if ( ! function_exists( 'realhomes_single_property_print_customizer' ) ) {
	/**
	 * Adds the print related settings for single property page sections.
	 *
	 * @since 4.0.1
	 */
	function realhomes_single_property_print_customizer( WP_Customize_Manager $wp_customize ) {

		$wp_customize->add_section( 'realhomes_single_property_print_section', array(
			'title' => esc_html__( 'Print', 'framework' ),
			'panel' => 'inspiry_property_panel',
		) );

		$wp_customize->add_setting( 'realhomes_single_property_print_setting', array(
			'type'              => 'option',
			'default'           => 'default',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'realhomes_single_property_print_setting', array(
			'label'   => esc_html__( 'Sections in Property Print', 'framework' ),
			'type'    => 'radio',
			'section' => 'realhomes_single_property_print_section',
			'choices' => array(
				'default' => esc_html__( 'Default', 'framework' ),
				'custom'  => esc_html__( 'Custom', 'framework' ),
			)
		) );

		$property_sections = realhomes_single_property_print_sections();
		if ( ! empty( $property_sections ) && is_array( $property_sections ) ) {
			$wp_customize->add_setting( 'realhomes_single_property_printable_sections', array(
				'type'              => 'option',
				'default'           => array_keys( $property_sections ),
				'sanitize_callback' => 'inspiry_sanitize_multiple_checkboxes'
			) );
			$wp_customize->add_control( new Inspiry_Multiple_Checkbox_Customize_Control( $wp_customize, 'realhomes_single_property_printable_sections',
				array(
					'label'           => esc_html__( 'Custom Sections Select for Property Print', 'framework' ),
					'description'     => esc_html__( 'Select the sections to add in property print.', 'framework' ),
					'section'         => 'realhomes_single_property_print_section',
					'choices'         => $property_sections,
					'active_callback' => 'realhomes_is_custom_print_setting'
				)
			) );
		}

		$wp_customize->add_setting( 'realhomes_property_media_in_print', array(
			'type'              => 'option',
			'default'           => 'gallery-images',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'realhomes_property_media_in_print', array(
			'label'   => esc_html__( 'Property Media in Print', 'framework' ),
			'type'    => 'radio',
			'section' => 'realhomes_single_property_print_section',
			'choices' => array(
				'gallery-images' => esc_html__( 'Gallery Images', 'framework' ),
				'featured-image' => esc_html__( 'Featured Image', 'framework' ),
			)
		) );

	}

	add_action( 'customize_register', 'realhomes_single_property_print_customizer' );
}