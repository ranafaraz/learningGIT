<?php
/**
 * Section:  `Theme Round Corners`
 * Panel:    `Styles`
 *
 * @since   3.15
 * @package realhomes/customizer
 */

/**
 * Determines whether the round corners option is enabled.
 */
function realhomes_is_round_corners() {
	return ( 'enable' === get_option( 'realhomes_round_corners', 'disable' ) );
}

if ( ! function_exists( 'realhomes_ultra_border_radius_settings' ) ) {
	/**
	 * Returns the configuration array of border radius settings for ultra variation.
	 *
	 * @since   4.2.0
	 *
	 * @return array
	 */
	function realhomes_ultra_border_radius_settings() {
		$config = array();

		$config[] = array(
			'id'     => 'general',
			'label'  => esc_html__( 'General', 'framework' ),
			'values' => array(
				'xsmall'  => array(
					'label' => esc_html__( 'XSmall', 'framework' ),
					'value' => '5',
				),
				'small'   => array(
					'label' => esc_html__( 'Small', 'framework' ),
					'value' => '10',
				),
				'medium'  => array(
					'label' => esc_html__( 'Medium', 'framework' ),
					'value' => '15',
				),
				'large'   => array(
					'label' => esc_html__( 'Large', 'framework' ),
					'value' => '25',
				),
				'xlarge'  => array(
					'label' => esc_html__( 'XLarge', 'framework' ),
					'value' => '50',
				),
				'xxlarge' => array(
					'label' => esc_html__( 'XXLarge', 'framework' ),
					'value' => '100',
				),
			),
		);

		$config[] = array(
			'id'     => 'misc',
			'label'  => esc_html__( 'Misc', 'framework' ),
			'values' => array(
				'small'                => array(
					'label' => '',
					'value' => '30',
				),
				'dropdown_items'       => array(
					'label' => esc_html__( 'Header Menu Dropdown Items', 'framework' ),
					'value' => '2',
				),
			),
		);

		$config[] = array(
			'id'     => 'property_card',
			'label'  => esc_html__( 'Property Cards', 'framework' ),
			'values' => array(
				'grid_two'        => array(
					'label' => esc_html__( 'Grid Card Two and Gallery Card', 'framework' ),
					'value' => '12',
				),
				'grid_two_thumb'  => array(
					'label' => esc_html__( 'Grid Card Two Thumbnail', 'framework' ),
					'value' => '6',
				),
				'grid_two_button' => array(
					'label' => esc_html__( 'Grid Card Two Button', 'framework' ),
					'value' => '8',
				),
			),
		);

		return $config;
	}
}

if ( ! function_exists( 'realhomes_round_corners_customizer' ) ) {

	function realhomes_round_corners_customizer( WP_Customize_Manager $wp_customize ) {

		$wp_customize->add_section( 'realhomes_round_corners_section', array(
			'title' => esc_html__( 'Round Corners', 'framework' ),
			'panel' => 'inspiry_styles_panel',
		) );

		$wp_customize->add_setting( 'realhomes_round_corners', array(
			'type'              => 'option',
			'default'           => 'disable',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'realhomes_round_corners', array(
			'label'       => esc_html__( 'Round Corners for Theme Elements', 'framework' ),
			'description' => esc_html__( 'This option allows you to change corners of some common theme elements.', 'framework' ),
			'type'        => 'radio',
			'choices'     => array(
				'enable'  => esc_html__( 'Enable', 'framework' ),
				'disable' => esc_html__( 'Disable', 'framework' ),
			),
			'section'     => 'realhomes_round_corners_section',
		) );

		if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {

			$border_radius_settings = realhomes_ultra_border_radius_settings();
			if ( ! empty( $border_radius_settings ) ) {

				foreach ( $border_radius_settings as $settings_group ) {
					$group_id = $settings_group['id'];
					$label_id = sprintf( 'realhomes_%s_round_corner_section_label', $group_id );
					$wp_customize->add_setting( $label_id, array( 'sanitize_callback' => 'sanitize_text_field' ) );
					$wp_customize->add_control( new Inspiry_Heading_Customize_Control( $wp_customize, $label_id,
						array(
							'label'           => $settings_group['label'],
							'section'         => 'realhomes_round_corners_section',
							'active_callback' => 'realhomes_is_round_corners',
						)
					) );

					if ( ! empty( $settings_group['values'] ) ) {

						foreach ( $settings_group['values'] as $setting_id => $setting_values ) {
							$id = sprintf( 'realhomes_%s_round_corner_%s', $group_id, $setting_id );
							$wp_customize->add_setting( $id, array(
								'type'              => 'option',
								'default'           => $setting_values['value'],
								'sanitize_callback' => 'sanitize_text_field',
							) );
							$wp_customize->add_control( $id, array(
								'label'           => $setting_values['label'],
								'description'     => sprintf( esc_html__( 'Default Value: %s', 'framework' ), $setting_values['value'] ),
								'type'            => 'text',
								'section'         => 'realhomes_round_corners_section',
								'active_callback' => 'realhomes_is_round_corners'
							) );
						}
					}
				}
			}

		} else if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$round_corners_values = array(
				'small'  => '4',
				'medium' => '8',
				'large'  => '12',
			);

			foreach ( $round_corners_values as $label => $value ) {
				$id = 'realhomes_round_corners_' . $label;
				$wp_customize->add_setting( $id, array(
					'type'              => 'option',
					'default'           => $value,
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_control( $id, array(
					'label'           => ucfirst( $label ) . esc_html__( ' Round Corners Value', 'framework' ),
					'type'            => 'text',
					'section'         => 'realhomes_round_corners_section',
					'active_callback' => 'realhomes_is_round_corners'
				) );
			}
		}
	}

	add_action( 'customize_register', 'realhomes_round_corners_customizer' );
}