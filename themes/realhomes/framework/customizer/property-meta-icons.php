<?php
/**
 * Property meta custom icons settings file.
 *
 * @since   4.3.0
 *
 * @package realhomes/customizer
 */
if ( ! function_exists( 'realhomes_property_meta_custom_icons_customizer' ) ) {
	/**
	 * Generates the property meta custom icons customizer settings.
	 *
	 * @since 4.3.0
	 */
	function realhomes_property_meta_custom_icons_customizer( WP_Customize_Manager $wp_customize ) {

		$wp_customize->add_section( 'property_meta_custom_icons_section', array(
			'title'    => esc_html__( 'Property Meta Icons', 'framework' ),
			'priority' => 124,
		) );

		$wp_customize->add_setting( 'realhomes_custom_property_meta_icons', array(
			'type'              => 'option',
			'default'           => 'false',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'realhomes_custom_property_meta_icons', array(
			'label'   => esc_html__( 'Custom Icons', 'framework' ),
			'type'    => 'radio',
			'section' => 'property_meta_custom_icons_section',
			'choices' => array(
				'true'  => esc_html__( 'Enable', 'framework' ),
				'false' => esc_html__( 'Disable', 'framework' ),
			),
		) );

		$wp_customize->add_setting( 'realhomes_allow_svg_upload', array(
			'type'              => 'option',
			'default'           => 'false',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'realhomes_allow_svg_upload', array(
			'label'           => esc_html__( 'Enable SVG File Upload', 'framework' ),
			'description'     => sprintf( '<ul class="notice notice-error"><li><strong>%s</strong></li><li>%s</li><li>%s</li></ul>',
				esc_html__( 'Important Note', 'framework' ),
				esc_html__( 'Make sure that the SVG files are sanitized or you trust their source as SVG files can contain malicious code.', 'framework' ),
				esc_html__( 'Please refresh the customizer window after changing this setting.', 'framework' ) ),
			'type'            => 'radio',
			'section'         => 'property_meta_custom_icons_section',
			'choices'         => array(
				'true'  => esc_html__( 'Yes', 'framework' ),
				'false' => esc_html__( 'No', 'framework' ),
			),
			'active_callback' => 'realhomes_is_custom_property_meta_icons'
		) );

		$property_meta_fields = realhomes_property_meta_fields();
		if ( is_array( $property_meta_fields ) && ! empty( $property_meta_fields ) ) {
			foreach ( $property_meta_fields as $property_meta_field ) {
				$id = 'realhomes_' . $property_meta_field['id'] . '_property_meta_icon';
				$wp_customize->add_setting( $id, array(
					'type'              => 'option',
					'sanitize_callback' => 'esc_url_raw',
				) );
				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $id, array(
					'label'           => sprintf( esc_html__( '%s Icon', 'framework' ), $property_meta_field['label'] ),
					'description'     => esc_html__( 'Upload the icon.', 'framework' ),
					'section'         => 'property_meta_custom_icons_section',
					'active_callback' => 'realhomes_is_custom_property_meta_icons'
				) ) );
			}
		}
	}

	add_action( 'customize_register', 'realhomes_property_meta_custom_icons_customizer' );
}