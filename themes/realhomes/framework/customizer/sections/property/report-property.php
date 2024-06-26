<?php
if ( ! function_exists( 'realhomes_report_property_customizer' ) ) {
	/**
	 * Property detail page report property customizer settings.
	 *
	 * @param WP_Customize_Manager $wp_customize
	 *
	 * @since 3.21.0
	 */
	function realhomes_report_property_customizer( WP_Customize_Manager $wp_customize ) {

		$defaults = realhomes_rpm_default_values();

		$wp_customize->add_section( 'realhomes_report_property_section', array(
			'title'    => esc_html__( 'Report Property', 'framework' ),
			'panel'    => 'inspiry_property_panel',
			'priority' => 7
		) );

		if ( 'classic' !== INSPIRY_DESIGN_VARIATION ) {

			$wp_customize->add_setting( 'realhomes_enable_report_property', array(
				'type'              => 'option',
				'default'           => 'false',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'realhomes_enable_report_property', array(
				'label'   => esc_html__( 'Report Property Functionality', 'framework' ),
				'type'    => 'radio',
				'section' => 'realhomes_report_property_section',
				'choices' => array(
					'true'  => esc_html__( 'Enable', 'framework' ),
					'false' => esc_html__( 'Disable', 'framework' ),
				),
			) );

			$wp_customize->add_setting( 'realhomes_rpm_title', array(
				'type'              => 'option',
				'default'           => $defaults['title'],
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'realhomes_rpm_title', array(
				'label'   => esc_html__( 'Modal Title', 'framework' ),
				'type'    => 'text',
				'section' => 'realhomes_report_property_section',
			) );

			$wp_customize->add_setting( 'realhomes_rpm_sub_title', array(
				'type'              => 'option',
				'default'           => $defaults['sub_title'],
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'realhomes_rpm_sub_title', array(
				'label'   => esc_html__( 'Modal Sub Title', 'framework' ),
				'type'    => 'text',
				'section' => 'realhomes_report_property_section',
			) );

			$wp_customize->add_setting( 'realhomes_rpm_form_main_options', array(
				'type'              => 'option',
				'default'           => $defaults['main_options'],
				'sanitize_callback' => 'sanitize_textarea_field',
			) );
			$wp_customize->add_control( 'realhomes_rpm_form_main_options', array(
				'label'       => esc_html__( 'Form Main Options', 'framework' ),
				'description' => esc_html__( 'Provide the comma separated values to show as main options.', 'framework' ),
				'type'        => 'textarea',
				'section'     => 'realhomes_report_property_section',
			) );

			$wp_customize->add_setting( 'realhomes_rpm_form_parent_item', array(
				'type'              => 'option',
				'default'           => 'true',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'realhomes_rpm_form_parent_item', array(
				'label'   => esc_html__( 'Show Parent Item in Main Options', 'framework' ),
				'type'    => 'radio',
				'section' => 'realhomes_report_property_section',
				'choices' => array(
					'true'  => esc_html__( 'Yes', 'framework' ),
					'false' => esc_html__( 'No', 'framework' ),
				),
			) );

			$wp_customize->add_setting( 'realhomes_rpm_form_parent_item_title', array(
				'type'              => 'option',
				'default'           => $defaults['parent_item_title'],
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'realhomes_rpm_form_parent_item_title', array(
				'label'   => esc_html__( 'Parent Item Title', 'framework' ),
				'type'    => 'text',
				'section' => 'realhomes_report_property_section',
			) );

			$wp_customize->add_setting( 'realhomes_rpm_form_child_options_title', array(
				'type'              => 'option',
				'default'           => $defaults['child_options_title'],
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'realhomes_rpm_form_child_options_title', array(
				'label'   => esc_html__( 'Child Options Title', 'framework' ),
				'type'    => 'text',
				'section' => 'realhomes_report_property_section',
			) );

			$wp_customize->add_setting( 'realhomes_rpm_form_parent_item_child_options', array(
				'type'              => 'option',
				'default'           => $defaults['parent_item_child_options'],
				'sanitize_callback' => 'sanitize_textarea_field',
			) );
			$wp_customize->add_control( 'realhomes_rpm_form_parent_item_child_options', array(
				'label'       => esc_html__( 'Child Options', 'framework' ),
				'description' => esc_html__( 'Provide the comma separated values to show as child options.', 'framework' ),
				'type'        => 'textarea',
				'section'     => 'realhomes_report_property_section',
			) );

			$wp_customize->add_setting( 'realhomes_rpm_form_custom_child_item', array(
				'type'              => 'option',
				'default'           => 'true',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'realhomes_rpm_form_custom_child_item', array(
				'label'   => esc_html__( 'Add Custom Child Option', 'framework' ),
				'type'    => 'radio',
				'section' => 'realhomes_report_property_section',
				'choices' => array(
					'true'  => esc_html__( 'Yes', 'framework' ),
					'false' => esc_html__( 'No', 'framework' ),
				),
			) );

			$wp_customize->add_setting( 'realhomes_rpm_form_custom_child_item_title', array(
				'type'              => 'option',
				'default'           => $defaults['child_item_title'],
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'realhomes_rpm_form_custom_child_item_title', array(
				'label'   => esc_html__( 'Custom Child Option Title', 'framework' ),
				'type'    => 'text',
				'section' => 'realhomes_report_property_section',
			) );

			$wp_customize->add_setting( 'realhomes_rpm_form_textarea_placeholder', array(
				'type'              => 'option',
				'default'           => $defaults['textarea_placeholder'],
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'realhomes_rpm_form_textarea_placeholder', array(
				'label'   => esc_html__( 'Textarea Placeholder Text', 'framework' ),
				'type'    => 'text',
				'section' => 'realhomes_report_property_section',
			) );

			$wp_customize->add_setting( 'realhomes_rpm_form_submit_button_label', array(
				'type'              => 'option',
				'default'           => $defaults['submit_button_label'],
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'realhomes_rpm_form_submit_button_label', array(
				'label'   => esc_html__( 'Submit Button Label', 'framework' ),
				'type'    => 'text',
				'section' => 'realhomes_report_property_section',
			) );

			$wp_customize->add_setting( 'realhomes_rpm_form_email', array(
				'type'              => 'option',
				'default'           => $defaults['target_email'],
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'realhomes_rpm_form_email', array(
				'label'       => esc_html__( 'Email Address to Receive Reports (required)', 'framework' ),
				'description' => esc_html__( 'By default admin email address will be used.', 'framework' ),
				'type'        => 'text',
				'section'     => 'realhomes_report_property_section',
			) );

			$wp_customize->add_setting( 'realhomes_rpm_form_email_response_title', array(
				'type'              => 'option',
				'default'           => $defaults['email_response_title'],
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'realhomes_rpm_form_email_response_title', array(
				'label'   => esc_html__( 'Email Response Title', 'framework' ),
				'type'    => 'text',
				'section' => 'realhomes_report_property_section',
			) );

			$wp_customize->add_setting( 'realhomes_rpm_form_email_response_text', array(
				'type'              => 'option',
				'default'           => $defaults['email_response_text'],
				'sanitize_callback' => 'sanitize_textarea_field',
			) );
			$wp_customize->add_control( 'realhomes_rpm_form_email_response_text', array(
				'label'   => esc_html__( 'Email Response Text', 'framework' ),
				'type'    => 'textarea',
				'section' => 'realhomes_report_property_section',
			) );

			$wp_customize->add_setting( 'realhomes_rpm_form_user_email', array(
				'type'              => 'option',
				'default'           => 'false',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'realhomes_rpm_form_user_email', array(
				'label'   => esc_html__( 'Require User Email while Reporting', 'framework' ),
				'type'    => 'radio',
				'section' => 'realhomes_report_property_section',
				'choices' => array(
					'true'  => esc_html__( 'Yes', 'framework' ),
					'false' => esc_html__( 'No', 'framework' ),
				),
			) );

		}
	}

	add_action( 'customize_register', 'realhomes_report_property_customizer' );
}

if ( ! function_exists( 'realhomes_rpm_default_values' ) ) {
	/**
	 * Provides the customizer settings defaults for report property modal.
	 *
	 * @return array
	 * @since 3.21.0
	 *
	 */
	function realhomes_rpm_default_values() {
		return array(
			'title'                     => esc_html__( 'Hey, What went wrong?', 'framework' ),
			'sub_title'                 => esc_html__( 'Report it now!', 'framework' ),
			'main_options'              => esc_html__( 'Seller not responding, Sold/Rented out', 'framework' ),
			'parent_item_title'         => esc_html__( 'Wrong Information', 'framework' ),
			'child_options_title'       => esc_html__( 'What do you think wrong Information?', 'framework' ),
			'parent_item_child_options' => esc_html__( 'Price, Area, Location, Fake listing, Incorrect photos', 'framework' ),
			'child_item_title'          => esc_html__( 'Other', 'framework' ),
			'textarea_placeholder'      => esc_html__( 'Ex. Tell us how can we improve this listing?', 'framework' ),
			'submit_button_label'       => esc_html__( 'Report', 'framework' ),
			'target_email'              => get_option( 'admin_email' ),
			'email_response_title'      => esc_html__( 'We got your Report', 'framework' ),
			'email_response_text'       => esc_html__( 'Thanks for your feedback to let us know what\'s going on.', 'framework' ),
		);
	}
}