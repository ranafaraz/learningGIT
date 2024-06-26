<?php
/**
 * Section:    `Schedule A tour`
 * Panel:    `Property Detail Page`
 *
 * @since   4.0.0
 * @package realhomes/customizer
 */

if ( ! function_exists( 'realhomes_schedule_a_tour_customizer' ) ) {

	/**
	 * realhomes_schedule_a_tour_customizer.
	 *
	 * @since  4.0.0
	 *
	 * @param WP_Customize_Manager $wp_customize
	 *
	 */
	function realhomes_schedule_a_tour_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Schedule A Tour
		 */
		$wp_customize->add_section( 'realhomes_schedule_a_tour', array(
			'title'    => esc_html__( 'Schedule A Tour', 'framework' ),
			'panel'    => 'inspiry_property_panel',
			'priority' => 21
		) );

		/* Schedule A Tour Title */
		$wp_customize->add_setting( 'realhomes_schedule_a_tour_title', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Schedule A Tour', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_schedule_a_tour_title', array(
			'label'   => esc_html__( 'Section Title', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_schedule_a_tour',
		) );

		/* Show/Hide Schedule A tour */
		$wp_customize->add_setting( 'realhomes_display_schedule_a_tour', array(
			'type'              => 'option',
			'default'           => 'false',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'realhomes_display_schedule_a_tour', array(
			'label'       => esc_html__( 'Schedule A Tour', 'framework' ),
			'type'        => 'radio',
			'section'     => 'realhomes_schedule_a_tour',
			'description' => esc_html__( 'You can handle property specific show/hide setting from its metabox section.', 'framework' ),
			'choices'     => array(
				'true'  => esc_html__( 'Enable', 'framework' ),
				'false' => esc_html__( 'Disable', 'framework' ),
			)
		) );

		/* Show/Hide Schedule A tour */
		$wp_customize->add_setting( 'realhomes_display_schedule_a_tour_for', array(
			'type'              => 'option',
			'default'           => 'new_properties',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'realhomes_display_schedule_a_tour_for', array(
			'label'       => esc_html__( 'Display control for properties', 'framework' ),
			'description' => esc_html__( 'Control if you want to display schedule form on existing properties or just the new ones.', 'framework' ),
			'type'        => 'radio',
			'section'     => 'realhomes_schedule_a_tour',
			'choices'     => array(
				'all_properties' => esc_html__( 'All Properties', 'framework' ),
				'new_properties' => esc_html__( 'Only New Properties', 'framework' ),
			)
		) );


		/* Schedule A Tour Date Placeholder */
		$wp_customize->add_setting( 'realhomes_sat_date_placeholder', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Select Date', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_sat_date_placeholder', array(
			'label'   => esc_html__( 'Date Field Placeholder', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_schedule_a_tour',
		) );

		/* Schedule A tour times */
		$wp_customize->add_setting( 'realhomes_schedule_time_slots', array(
			'type'              => 'option',
			'default'           => esc_html__( '10:00 am,10:15 pm,10:30 pm,12:00 pm,12:15 pm,12:30 pm,12:45 pm,01:00 pm,01:15 pm,01:30 pm,01:45 pm,02:00 pm,05:00 pm', 'framework' ),
			'sanitize_callback' => 'wp_kses_data',
		) );
		$wp_customize->add_control( 'realhomes_schedule_time_slots', array(
			'label'       => esc_html__( 'Time Slots', 'framework' ),
			'description' => esc_html__( 'Add time slots by providing comma (,) separated values. (For example: 12:00 am,12:15 am,12:30 am)', 'framework' ),
			'type'        => 'textarea',
			'section'     => 'realhomes_schedule_a_tour',
		) );

		/* Schedule A Tour In Person Type Label */
		$wp_customize->add_setting( 'realhomes_sat_type_in_person_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'In Person', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_sat_type_in_person_label', array(
			'label'   => esc_html__( 'Label for In Person Field', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_schedule_a_tour',
		) );

		/* Schedule A Tour Video Call Type Label */
		$wp_customize->add_setting( 'realhomes_sat_type_video_chat_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Video Chat', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_sat_type_video_chat_label', array(
			'label'   => esc_html__( 'Label for Video Chat Field', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_schedule_a_tour',
		) );

		/* Schedule A Tour Name Placeholder */
		$wp_customize->add_setting( 'realhomes_sat_name_placeholder', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Your Name', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_sat_name_placeholder', array(
			'label'   => esc_html__( 'Name Field Placeholder', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_schedule_a_tour',
		) );

		/* Schedule A Tour Phone Placeholder */
		$wp_customize->add_setting( 'realhomes_sat_phone_placeholder', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Your Phone', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_sat_phone_placeholder', array(
			'label'   => esc_html__( 'Phone Field Placeholder', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_schedule_a_tour',
		) );

		/* Schedule A Tour Email Placeholder */
		$wp_customize->add_setting( 'realhomes_sat_email_placeholder', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Your Email', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_sat_email_placeholder', array(
			'label'   => esc_html__( 'Email Field Placeholder', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_schedule_a_tour',
		) );

		/* Schedule A Tour Message Placeholder */
		$wp_customize->add_setting( 'realhomes_sat_message_placeholder', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Message', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_sat_message_placeholder', array(
			'label'   => esc_html__( 'Message Field Placeholder', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_schedule_a_tour',
		) );

		/* Schedule A Tour Button Text */
		$wp_customize->add_setting( 'realhomes_sat_button_text', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Schedule', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_sat_button_text', array(
			'label'   => esc_html__( 'Schedule Button Text', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_schedule_a_tour',
		) );

		/* Schedule A tour default description */
		$wp_customize->add_setting( 'realhomes_schedule_side_description', array(
			'type'              => 'option',
			'sanitize_callback' => 'wp_kses_post',
		) );
		$wp_customize->add_control( 'realhomes_schedule_side_description', array(
			'label'       => esc_html__( 'Description', 'framework' ),
			'description' => esc_html__( 'You can use common html tags in this area.', 'framework' ),
			'type'        => 'textarea',
			'section'     => 'realhomes_schedule_a_tour',
		) );

		$wp_customize->add_setting( 'realhomes_send_schedule_copy_to_admin', array(
			'type'              => 'option',
			'default'           => 'true',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'realhomes_send_schedule_copy_to_admin', array(
			'label'   => esc_html__( 'Send schedule copy to admin', 'framework' ),
			'type'    => 'radio',
			'section' => 'realhomes_schedule_a_tour',
			'choices' => array(
				'true'  => esc_html__( 'Yes', 'framework' ),
				'false' => esc_html__( 'No', 'framework' ),
			),
		) );

		/* GDPR Settings */
		$wp_customize->add_setting( 'realhomes_schedule_tour_GDPR_status', array(
			'type'              => 'option',
			'default'           => 0,
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'realhomes_schedule_tour_GDPR_status', array(
			'label'   => esc_html__( 'Show/Hide GDPR checkbox on schedule a tour form', 'framework' ),
			'type'    => 'radio',
			'section' => 'realhomes_schedule_a_tour',
			'choices' => array(
				1 => esc_html__( 'Show', 'framework' ),
				0 => esc_html__( 'Hide', 'framework' ),
			)
		) );

	}

	// Skipping the functionality form classic
	if ( 'classic' !== INSPIRY_DESIGN_VARIATION ) {
		add_action( 'customize_register', 'realhomes_schedule_a_tour_customizer' );
	}
}


if ( ! function_exists( 'realhomes_schedule_a_tour_defaults' ) ) {

	/**
	 * Initializing the default values upon saving using inspiry_initialize_defaults
	 * function as customizer api do not do so by default.
	 *
	 * @since  4.0.0
	 *
	 * @param WP_Customize_Manager $wp_customize - Instance of WP_Customize_Manager.
	 *
	 */
	function realhomes_schedule_a_tour_defaults( WP_Customize_Manager $wp_customize ) {
		$schedule_a_tour_settings_ids = array(
			'realhomes_display_schedule_a_tour',
			'realhomes_schedule_a_tour_title'
		);
		inspiry_initialize_defaults( $wp_customize, $schedule_a_tour_settings_ids );
	}

	add_action( 'customize_save_after', 'realhomes_schedule_a_tour_defaults' );
}


if ( ! function_exists( 'realhomes_schedule_a_tour_title_render' ) ) {
	/**
	 * The function is a callback which is used to refresh the title area only
	 * when it is updated in customizer settings
	 */
	function realhomes_schedule_a_tour_title_render() {

		if ( get_option( 'realhomes_schedule_a_tour_title' ) ) {

			echo esc_html( get_option( 'realhomes_schedule_a_tour_title' ) );

		}
	}
}
