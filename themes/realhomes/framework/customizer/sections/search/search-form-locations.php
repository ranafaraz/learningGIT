<?php
/**
 * Section:    `Search Form Locations`
 * Panel:    `Properties Search`
 *
 * @since 2.6.3
 */

if ( ! function_exists( 'inspiry_search_form_locations_customizer' ) ) :

	/**
	 * inspiry_search_form_locations_customizer.
	 *
	 * @since  2.6.3
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	function inspiry_search_form_locations_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Search Form Locations
		 */
		$wp_customize->add_section( 'inspiry_search_form_locations', array(
			'title' => esc_html__( 'Search Form Locations', 'framework' ),
			'panel' => 'inspiry_properties_search_panel',
		) );


		if ( ! inspiry_is_rvr_enabled() ) {
			/* Number of Location Boxes */
			$wp_customize->add_setting( 'theme_location_select_number', array(
				'type'              => 'option',
				'default'           => '1',
				'sanitize_callback' => 'inspiry_sanitize_select',
			) );
			$wp_customize->add_control( 'theme_location_select_number', array(
				'label'           => esc_html__( 'Number of Location Select Boxes', 'framework' ),
				'description'     => esc_html__( 'In case of 1 location box, all locations will be listed in that select box. In case of 2 or more, Each select box will list parent locations of a level that matches its number and all the remaining children locations will be listed in last select box.', 'framework' ),
				'type'            => 'select',
				'section'         => 'inspiry_search_form_locations',
				'choices'         => array(
					'1' => 1,
					'2' => 2,
					'3' => 3,
					'4' => 4,
				),
				'active_callback' => 'inspiry_ajax_location_field'
			) );

			/* 1st Location Box Title */
			$wp_customize->add_setting( 'theme_location_title_1', array(
				'type'              => 'option',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'theme_location_title_1', array(
				'label'       => esc_html__( 'Title for 1st Location Select Box', 'framework' ),
				'description' => esc_html__( 'Example: Country', 'framework' ),
				'type'        => 'text',
				'section'     => 'inspiry_search_form_locations',
			) );

			$wp_customize->add_setting( 'inspiry_location_placeholder_1', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'inspiry_location_placeholder_1', array(
				'label'   => esc_html__( 'Placeholder for 1st Location Field', 'framework' ),
				'type'    => 'text',
				'section' => 'inspiry_search_form_locations',
			) );

			$wp_customize->add_setting( 'inspiry_location_count_placeholder_1', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'inspiry_location_count_placeholder_1', array(
				'label'           => esc_html__( 'Location Selected Placeholder', 'framework' ),
				'description'     => esc_html__( 'When selected locations are greater than 2', 'framework' ),
				'type'            => 'text',
				'section'         => 'inspiry_search_form_locations',
				'active_callback' => 'inspiry_ajax_location_field_display'
			) );

			/* 2nd Location Box Title */
			$wp_customize->add_setting( 'theme_location_title_2', array(
				'type'              => 'option',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'theme_location_title_2', array(
				'label'           => esc_html__( 'Title for 2nd Location Select Box', 'framework' ),
				'description'     => esc_html__( 'Example: State', 'framework' ),
				'type'            => 'text',
				'section'         => 'inspiry_search_form_locations',
				'active_callback' => 'inspiry_ajax_location_field'
			) );

			$wp_customize->add_setting( 'inspiry_location_placeholder_2', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'inspiry_location_placeholder_2', array(
				'label'           => esc_html__( 'Placeholder for 2nd Location Field', 'framework' ),
				'type'            => 'text',
				'section'         => 'inspiry_search_form_locations',
				'active_callback' => 'inspiry_ajax_location_field'
			) );

			/* 3rd Location Box Title */
			$wp_customize->add_setting( 'theme_location_title_3', array(
				'type'              => 'option',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'theme_location_title_3', array(
				'label'           => esc_html__( 'Title for 3rd Location Select Box', 'framework' ),
				'description'     => esc_html__( 'Example: City', 'framework' ),
				'type'            => 'text',
				'section'         => 'inspiry_search_form_locations',
				'active_callback' => 'inspiry_ajax_location_field'
			) );

			$wp_customize->add_setting( 'inspiry_location_placeholder_3', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'inspiry_location_placeholder_3', array(
				'label'           => esc_html__( 'Placeholder for 3rd Location Field', 'framework' ),
				'type'            => 'text',
				'section'         => 'inspiry_search_form_locations',
				'active_callback' => 'inspiry_ajax_location_field'
			) );

			/* 4th Location Box Title */
			$wp_customize->add_setting( 'theme_location_title_4', array(
				'type'              => 'option',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'theme_location_title_4', array(
				'label'           => esc_html__( 'Title for 4th Location Select Box', 'framework' ),
				'description'     => esc_html__( 'Example: Area', 'framework' ),
				'type'            => 'text',
				'section'         => 'inspiry_search_form_locations',
				'active_callback' => 'inspiry_ajax_location_field'
			) );

			$wp_customize->add_setting( 'inspiry_location_placeholder_4', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'inspiry_location_placeholder_4', array(
				'label'           => esc_html__( 'Placeholder for 4th Location Field', 'framework' ),
				'type'            => 'text',
				'section'         => 'inspiry_search_form_locations',
				'active_callback' => 'inspiry_ajax_location_field'
			) );
		} else if ( 'classic' !== INSPIRY_DESIGN_VARIATION && 'google-maps' === inspiry_get_maps_type() ) {
			$wp_customize->add_setting( 'realhomes_location_field_type', array(
				'type'              => 'option',
				'default'           => 'default',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'realhomes_location_field_type', array(
				'label'   => esc_html__( 'Location Field Type', 'framework' ),
				'type'    => 'radio',
				'section' => 'inspiry_search_form_locations',
				'choices' => array(
					'default'      => esc_html__( 'Default', 'framework' ),
					'geo-location' => esc_html__( 'Geo Location', 'framework' ),
				),
			) );

			/* Geo Location Radius Range Type */
			$wp_customize->add_setting( 'realhomes_search_radius_range_type', array(
				'type'              => 'option',
				'default'           => 'miles',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'realhomes_search_radius_range_type', array(
				'label'           => esc_html__( 'Radius Range Type', 'framework' ),
				'type'            => 'radio',
				'section'         => 'inspiry_search_form_locations',
				'choices'         => array(
					'miles'      => esc_html__( 'Miles', 'framework' ),
					'kilometers' => esc_html__( 'Kilometers', 'framework' ),
				),
				'active_callback' => 'realhomes_is_location_type_geolocation'
			) );

			/* Geo Location Radius Range Initial Value */
			$wp_customize->add_setting( 'realhomes_search_radius_range_initial', array(
				'type'              => 'option',
				'default'           => '20',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'realhomes_search_radius_range_initial', array(
				'label'           => esc_html__( 'Initial Radius Range Value', 'framework' ),
				'description'     => esc_html__( 'Starting radius range for Geo Location search, specified in miles or kilometers (only numbers)', 'framework' ),
				'type'            => 'text',
				'section'         => 'inspiry_search_form_locations',
				'active_callback' => 'realhomes_is_location_type_geolocation'
			) );

			/* Geo Location Radius Range Minimum Value */
			$wp_customize->add_setting( 'realhomes_search_radius_range_min', array(
				'type'              => 'option',
				'default'           => '10',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'realhomes_search_radius_range_min', array(
				'label'           => esc_html__( 'Minimum Radius Range Value', 'framework' ),
				'description'     => esc_html__( 'Minimum radius range that user can choose for Geo Location search (only numbers)', 'framework' ),
				'type'            => 'text',
				'section'         => 'inspiry_search_form_locations',
				'active_callback' => 'realhomes_is_location_type_geolocation'
			) );

			/* Geo Location Radius Range Maximum Value */
			$wp_customize->add_setting( 'realhomes_search_radius_range_max', array(
				'type'              => 'option',
				'default'           => '50',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'realhomes_search_radius_range_max', array(
				'label'           => esc_html__( 'Maximum Radius Range Value', 'framework' ),
				'description'     => esc_html__( 'Maximum radius range that user can choose for Geo Location search (only numbers)', 'framework' ),
				'type'            => 'text',
				'section'         => 'inspiry_search_form_locations',
				'active_callback' => 'realhomes_is_location_type_geolocation'
			) );
		}

		// Setting to hide empty locations
		$wp_customize->add_setting( 'inspiry_hide_empty_locations', array(
			'type'              => 'option',
			'default'           => 'true',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'inspiry_hide_empty_locations', array(
			'label'           => esc_html__( 'Hide Empty Locations ?', 'framework' ),
			'description'     => esc_html__( 'Optimize Locations by hiding the ones with zero property.', 'framework' ),
			'type'            => 'radio',
			'section'         => 'inspiry_search_form_locations',
			'choices'         => array(
				'true'  => esc_html__( 'Yes', 'framework' ),
				'false' => esc_html__( 'No', 'framework' ),
			),
			'active_callback' => 'realhomes_is_location_type_default'
		) );

		// To enable dynamic location feature
		$wp_customize->add_setting( 'inspiry_ajax_location_field', array(
			'type'              => 'option',
			'default'           => 'no',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'inspiry_ajax_location_field', array(
			'label'           => esc_html__( 'Enable Dynamic Location Field', 'framework' ),
			'description'     => esc_html__( 'It is recommended for large number of locations. As it will allow search through all locations, but list 15 locations non-hierarchically in start and 15 more with each last scroll till all locations are listed.', 'framework' ),
			'type'            => 'radio',
			'section'         => 'inspiry_search_form_locations',
			'choices'         => array(
				'yes' => esc_html__( 'Yes', 'framework' ),
				'no'  => esc_html__( 'No', 'framework' ),
			),
			'active_callback' => 'realhomes_is_location_type_default'
		) );

		$wp_customize->add_setting(
			'inspiry_search_form_multiselect_locations', array(
				'type'              => 'option',
				'default'           => 'yes',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			)
		);
		$wp_customize->add_control( 'inspiry_search_form_multiselect_locations', array(
			'label'           => esc_html__( 'Enable Multi Select For Locations Field? ', 'framework' ),
			'description'     => esc_html__( 'Enabled for ( Dynamic Location ) or when ( Number of Location Select Boxes is equal to 1 )', 'framework' ),
			'type'            => 'radio',
			'section'         => 'inspiry_search_form_locations',
			'choices'         => array(
				'yes' => esc_html__( 'Yes', 'framework' ),
				'no'  => esc_html__( 'No', 'framework' ),
			),
			'active_callback' => 'realhomes_is_location_type_default'
		) );

	}

	add_action( 'customize_register', 'inspiry_search_form_locations_customizer' );
endif;

if ( ! function_exists( 'inspiry_search_form_locations_defaults' ) ) :

	/**
	 * inspiry_search_form_locations_defaults.
	 *
	 * @since  2.6.3
	 */
	function inspiry_search_form_locations_defaults( WP_Customize_Manager $wp_customize ) {
		$search_form_locations_settings_ids = array(
			'theme_location_select_number',
			'inspiry_hide_empty_locations',
		);
		inspiry_initialize_defaults( $wp_customize, $search_form_locations_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_search_form_locations_defaults' );
endif;

if ( ! function_exists( 'inspiry_ajax_location_field' ) ) {
	/**
	 * Check if Ajax feature is enabled for the search location field
	 *
	 * @param $control
	 *
	 * @return bool
	 */
	function inspiry_ajax_location_field( $control ) {

		if ( 'yes' === $control->manager->get_setting( 'inspiry_ajax_location_field' )->value() ) {
			return false;
		}

		return true;
	}
}

if ( ! function_exists( 'inspiry_ajax_location_field_display' ) ) {
	/**
	 * Display field if Ajax feature is enabled for the search location field
	 *
	 * @param $control
	 *
	 * @return bool
	 */
	function inspiry_ajax_location_field_display( $control ) {

		if ( 'yes' === $control->manager->get_setting( 'inspiry_ajax_location_field' )->value() ) {
			return true;
		}

		return false;
	}
}

if ( ! function_exists( 'realhomes_is_location_type_default' ) ) {
	/**
	 * Active callback function to display customizer settings based on location field type 'default' value.
	 *
	 * @since 4.1.0
	 *
	 * @return bool
	 */
	function realhomes_is_location_type_default(): bool {

		if ( 'default' === get_option( 'realhomes_location_field_type', 'default' ) ) {
			return true;
		}

		return false;
	}
}

if ( ! function_exists( 'realhomes_is_location_type_geolocation' ) ) {
	/**
	 * Active callback function to display customizer settings based on location field type 'geo-location' value.
	 *
	 * @since 4.1.0
	 *
	 * @return bool
	 */
	function realhomes_is_location_type_geolocation(): bool {

		if ( 'geo-location' === get_option( 'realhomes_location_field_type', 'default' ) ) {
			return true;
		}

		return false;
	}
}