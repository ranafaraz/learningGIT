<?php
/**
 * Section:     Booking Form
 * Panel:       Property Detail Page
 *
 * @since 4.3.1
 */

if ( ! function_exists( 'realhomes_property_single_booking_form_customizer' ) ) {
	/**
	 * Generating the customizer options for rvr booking form
	 *
	 * @since  4.3.1
	 *
	 * @param WP_Customize_Manager $wp_customize
	 *
	 */
	function realhomes_property_single_booking_form_customizer( WP_Customize_Manager $wp_customize ) {

		$wp_customize->add_section( 'realhomes_property_single_booking_form_section', array(
			'title'    => esc_html__( 'Booking Form', 'framework' ),
			'panel'    => 'inspiry_property_panel',
			'priority' => 11
		) );

		/* Notice to inform about form only available for full width property template */
		$wp_customize->add_setting( 'realhomes_property_single_booking_form_options_notice' );
		$wp_customize->add_control(
			new Realhomes_Customizer_Notice_Control( $wp_customize, 'realhomes_property_single_booking_form_options_notice',
				array(
					'label'             => esc_html__( 'Notice:', 'framework' ),
					'description'       => esc_html__( 'Booking form is available for full width property template only.', 'framework' ),
					'section'           => 'realhomes_property_single_booking_form_section',
					'sanitize_callback' => 'wp_kses_post'
				) )
		);

		/* Show/Hide Booking Form */
		$wp_customize->add_setting( 'realhomes_property_single_display_booking_form', array(
			'type'              => 'option',
			'default'           => 'true',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'realhomes_property_single_display_booking_form', array(
			'label'   => esc_html__( 'Show Booking Form', 'framework' ),
			'type'    => 'radio',
			'section' => 'realhomes_property_single_booking_form_section',
			'choices' => array(
				'true'  => esc_html__( 'Show', 'framework' ),
				'false' => esc_html__( 'Hide', 'framework' ),
			),
		) );

		/* Booking Form Title */
		$wp_customize->add_setting( 'realhomes_property_single_booking_form_title', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'default'           => esc_html__( 'Request A Booking', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_property_single_booking_form_title', array(
			'label'   => esc_html__( 'Booking Form Title', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_property_single_booking_form_section',
		) );

		/* Booking Form Name Label */
		$wp_customize->add_setting( 'realhomes_booking_form_name_label', array(
			'type'              => 'option',
			'transport'         => 'refresh',
			'default'           => esc_html__( 'Name', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_booking_form_name_label', array(
			'label'   => esc_html__( 'Name Field Label', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_property_single_booking_form_section',
		) );

		/* Booking Form Name Placeholder */
		$wp_customize->add_setting( 'realhomes_booking_form_name_placeholder', array(
			'type'              => 'option',
			'transport'         => 'refresh',
			'default'           => esc_html__( 'Name', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_booking_form_name_placeholder', array(
			'label'   => esc_html__( 'Name Field Placeholder', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_property_single_booking_form_section',
		) );

		/* Booking Form Email Label */
		$wp_customize->add_setting( 'realhomes_booking_form_email_label', array(
			'type'              => 'option',
			'transport'         => 'refresh',
			'default'           => esc_html__( 'Email', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_booking_form_email_label', array(
			'label'   => esc_html__( 'Email Field Label', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_property_single_booking_form_section',
		) );

		/* Booking Form Email Placeholder */
		$wp_customize->add_setting( 'realhomes_booking_form_email_placeholder', array(
			'type'              => 'option',
			'transport'         => 'refresh',
			'default'           => esc_html__( 'Email', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_booking_form_email_placeholder', array(
			'label'   => esc_html__( 'Email Field Placeholder', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_property_single_booking_form_section',
		) );

		/* Booking Form Phone Label */
		$wp_customize->add_setting( 'realhomes_booking_form_phone_label', array(
			'type'              => 'option',
			'transport'         => 'refresh',
			'default'           => esc_html__( 'Phone', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_booking_form_phone_label', array(
			'label'   => esc_html__( 'Phone Field Label', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_property_single_booking_form_section',
		) );

		/* Booking Form Phone Placeholder */
		$wp_customize->add_setting( 'realhomes_booking_form_phone_placeholder', array(
			'type'              => 'option',
			'transport'         => 'refresh',
			'default'           => esc_html__( 'Phone', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_booking_form_phone_placeholder', array(
			'label'   => esc_html__( 'Phone Field Placeholder', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_property_single_booking_form_section',
		) );

		/* Booking Form Check In Label */
		$wp_customize->add_setting( 'realhomes_booking_form_checkin_label', array(
			'type'              => 'option',
			'transport'         => 'refresh',
			'default'           => esc_html__( 'Check In', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_booking_form_checkin_label', array(
			'label'   => esc_html__( 'Check In Field Label', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_property_single_booking_form_section',
		) );

		/* Booking Form Check In Placeholder */
		$wp_customize->add_setting( 'realhomes_booking_form_checkin_placeholder', array(
			'type'              => 'option',
			'transport'         => 'refresh',
			'default'           => esc_html__( 'Check In', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_booking_form_checkin_placeholder', array(
			'label'   => esc_html__( 'Check In Field Placeholder', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_property_single_booking_form_section',
		) );

		/* Booking Form Check Out Label */
		$wp_customize->add_setting( 'realhomes_booking_form_checkout_label', array(
			'type'              => 'option',
			'transport'         => 'refresh',
			'default'           => esc_html__( 'Check Out', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_booking_form_checkout_label', array(
			'label'   => esc_html__( 'Check Out Field Label', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_property_single_booking_form_section',
		) );

		/* Booking Form Check Out Placeholder */
		$wp_customize->add_setting( 'realhomes_booking_form_checkout_placeholder', array(
			'type'              => 'option',
			'transport'         => 'refresh',
			'default'           => esc_html__( 'Check Out', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_booking_form_checkout_placeholder', array(
			'label'   => esc_html__( 'Check Out Field Placeholder', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_property_single_booking_form_section',
		) );

		/* Booking Form Adults Label */
		$wp_customize->add_setting( 'realhomes_booking_form_adults_label', array(
			'type'              => 'option',
			'transport'         => 'refresh',
			'default'           => esc_html__( 'Adults', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_booking_form_adults_label', array(
			'label'   => esc_html__( 'Adults Field Label', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_property_single_booking_form_section',
		) );

		/* Booking Form Children Label */
		$wp_customize->add_setting( 'realhomes_booking_form_children_label', array(
			'type'              => 'option',
			'transport'         => 'refresh',
			'default'           => esc_html__( 'Children', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_booking_form_children_label', array(
			'label'   => esc_html__( 'Children Field Label', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_property_single_booking_form_section',
		) );

		/* Booking Form Infants Label */
		$wp_customize->add_setting( 'realhomes_booking_form_infants_label', array(
			'type'              => 'option',
			'transport'         => 'refresh',
			'default'           => esc_html__( 'Infants', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_booking_form_infants_label', array(
			'label'   => esc_html__( 'Infants Field Label', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_property_single_booking_form_section',
		) );

		/* Booking Form Payable Label */
		$wp_customize->add_setting( 'realhomes_booking_form_payable_label', array(
			'type'              => 'option',
			'transport'         => 'refresh',
			'default'           => esc_html__( 'Payable', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_booking_form_payable_label', array(
			'label'   => esc_html__( 'Payable Label', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_property_single_booking_form_section',
		) );

		/* Booking Form Show Details Label */
		$wp_customize->add_setting( 'realhomes_booking_form_show_details_label', array(
			'type'              => 'option',
			'transport'         => 'refresh',
			'default'           => esc_html__( '(Show Details)', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_booking_form_show_details_label', array(
			'label'   => esc_html__( 'Show Details Label', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_property_single_booking_form_section',
		) );

		/* Booking Form Hide Details Label */
		$wp_customize->add_setting( 'realhomes_booking_form_hide_details_label', array(
			'type'              => 'option',
			'transport'         => 'refresh',
			'default'           => esc_html__( '(Hide Details)', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_booking_form_hide_details_label', array(
			'label'   => esc_html__( 'Hide Details Label', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_property_single_booking_form_section',
		) );

		/* Booking Form Submit Button Label */
		$wp_customize->add_setting( 'realhomes_booking_form_submit_label', array(
			'type'              => 'option',
			'transport'         => 'refresh',
			'default'           => esc_html__( 'Submit', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'realhomes_booking_form_submit_label', array(
			'label'   => esc_html__( 'Submit Button Label', 'framework' ),
			'type'    => 'text',
			'section' => 'realhomes_property_single_booking_form_section',
		) );







		/* Booking Form Selective Refreshs */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'realhomes_property_single_booking_form_title', array(
				'selector'            => '.single-booking-section .rh_property__heading',
				'container_inclusive' => false,
				'render_callback'     => 'realhomes_property_single_booking_form_title_render'
			) );
		}

	}

	add_action( 'customize_register', 'realhomes_property_single_booking_form_customizer' );
}


if ( ! function_exists( 'realhomes_property_single_booking_form_title_render' ) ) {
	/**
	 * Renders the title of booking form for customizer
	 *
	 * @since  4.3.1
	 */
	function realhomes_property_single_booking_form_title_render() {
		if ( get_option( 'realhomes_property_single_booking_form_title' ) ) {
			echo esc_html( get_option( 'realhomes_property_single_booking_form_title' ) );
		}
	}

}
