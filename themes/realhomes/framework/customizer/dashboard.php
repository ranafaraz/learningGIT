<?php
/**
 * Dashboard Settings
 *
 * @package realhomes/customizer
 */
if ( ! function_exists( 'inspiry_dashboard_customizer' ) ) {
	function inspiry_dashboard_customizer( WP_Customize_Manager $wp_customize ) {

		$wp_customize->add_panel( 'inspiry_dashboard_panel', array(
			'title'    => esc_html__( 'Dashboard', 'framework' ),
			'priority' => 128,
		) );

		// Dashboard Basic
		$wp_customize->add_section( 'inspiry_dashboard_basic', array(
			'title' => esc_html__( 'Basic', 'framework' ),
			'panel' => 'inspiry_dashboard_panel',
		) );

		// Dashboard Page
		$wp_customize->add_setting( 'inspiry_dashboard_page', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'inspiry_sanitize_select',
		) );
		$wp_customize->add_control( 'inspiry_dashboard_page', array(
			'label'       => esc_html__( 'Select Dashboard Page', 'framework' ),
			'description' => esc_html__( 'Selected page should have Dashboard Template assigned to it.', 'framework' ),
			'type'        => 'select',
			'section'     => 'inspiry_dashboard_basic',
			'choices'     => RH_Data::get_pages_array(),
		) );

		// Restrict Admin Dashboard Access.
		$wp_customize->add_setting( 'theme_restricted_level', array(
			'type'              => 'option',
			'default'           => '0',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'inspiry_sanitize_select',
		) );
		$wp_customize->add_control( 'theme_restricted_level', array(
			'label'       => esc_html__( 'Restrict Admin Side Access', 'framework' ),
			'description' => esc_html__( 'Restrict admin side access to any user level equal to or below the selected user level.', 'framework' ),
			'type'        => 'select',
			'section'     => 'inspiry_dashboard_basic',
			'choices'     => array(
				'0' => esc_html__( 'Subscriber ( Level 0 )', 'framework' ),
				'1' => esc_html__( 'Contributor ( Level 1 )', 'framework' ),
				'2' => esc_html__( 'Author ( Level 2 )', 'framework' ),
				// '7' => esc_html__( 'Editor ( Level 7 )','framework'),
			),
		) );

		// Logged-in User Greeting Text
		$wp_customize->add_setting( 'inspiry_user_greeting_text', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Hello', 'framework' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_user_greeting_text', array(
			'label'   => esc_html__( 'Greeting Text for Logged-in User', 'framework' ),
			'type'    => 'text',
			'section' => 'inspiry_dashboard_basic',
		) );

		// Dashboard Logo Link Behaviour
		$wp_customize->add_setting( 'realhomes_dashboard_logo_link', array(
			'type'              => 'option',
			'default'           => 'dashboard',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'realhomes_dashboard_logo_link', array(
			'label'   => esc_html__( 'Dashboard Logo Link', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_dashboard_basic',
			'choices' => array(
				'dashboard' => esc_html__( 'Dashboard Overview Page', 'framework' ),
				'homepage'  => esc_html__( 'Website Homepage', 'framework' ),
			),
		) );

		// Dashboard Module Display
		$wp_customize->add_setting( 'inspiry_dashboard_page_display', array(
			'type'              => 'option',
			'default'           => 'true',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'inspiry_dashboard_page_display', array(
			'label'   => esc_html__( 'Summarized Info on Dashboard', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_dashboard_basic',
			'choices' => array(
				'true'  => esc_html__( 'Enable', 'framework' ),
				'false' => esc_html__( 'Disable', 'framework' ),
			),
		) );

		// Properties Search Field
		$wp_customize->add_setting( 'inspiry_my_properties_search', array(
			'type'              => 'option',
			'default'           => 'show',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'inspiry_my_properties_search', array(
			'label'   => esc_html__( 'Properties Search Field', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_dashboard_basic',
			'choices' => array(
				'show' => esc_html__( 'Show', 'framework' ),
				'hide' => esc_html__( 'Hide', 'framework' )
			),
		) );

		// Posts Per Page
		$posts_per_page_list = realhomes_dashboard_posts_per_page_list();
		if ( is_array( $posts_per_page_list ) && ! empty( $posts_per_page_list ) ) {
			$wp_customize->add_setting( 'inspiry_dashboard_posts_per_page', array(
				'type'              => 'option',
				'default'           => '10',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'inspiry_sanitize_select',
			) );
			$wp_customize->add_control( 'inspiry_dashboard_posts_per_page', array(
				'label'   => esc_html__( 'Posts Per Page', 'framework' ),
				'type'    => 'select',
				'section' => 'inspiry_dashboard_basic',
				'choices' => $posts_per_page_list
			) );
		}

		// Dashboard Analytics
		$wp_customize->add_section( 'realhomes_dashboard_analytics', array(
			'title' => esc_html__( 'Analytics', 'framework' ),
			'panel' => 'inspiry_dashboard_panel',
		) );

		// Properties Search Field
		$wp_customize->add_setting( 'realhomes_dashboard_analytics_module', array(
			'type'              => 'option',
			'default'           => 'show',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'realhomes_dashboard_analytics_module', array(
			'label'   => esc_html__( 'Dashboard Analytics Module', 'framework' ),
			'type'    => 'radio',
			'section' => 'realhomes_dashboard_analytics',
			'choices' => array(
				'show' => esc_html__( 'Show', 'framework' ),
				'hide' => esc_html__( 'Hide', 'framework' )
			)
		) );

		/* Notification to enable analytics from ERE settings */
		$wp_customize->add_setting( 'realhomes_property_analytics_notice' );
		$wp_customize->add_control(
			new Realhomes_Customizer_Notice_Control( $wp_customize, 'realhomes_property_analytics_notice',
				array(
					'label'             => esc_html__( 'Notice:', 'framework' ),
					'description'       => sprintf( esc_html__( 'Make sure that analytics collection option is enabled in %s options.', 'framework' ), '<a class="customizer-link" target="_blank" href=' . admin_url() . 'admin.php?page=ere-settings&tab=property-analytics' . '>' . esc_html__( 'ERE Property Analytics', 'framework' ) . '</a>' ),
					'section'           => 'realhomes_dashboard_analytics',
					'sanitize_callback' => 'wp_kses_post',
					'active_callback'   => function ( $control ) {

						// If analytics are hidden on dashboard then no need to show this one
						if ( $control->manager->get_setting( 'realhomes_dashboard_analytics_module' )->value() === 'hide' ) {
							return false;
						}

						// If the property analytics collection option is disabled in user settings then it will show notice
						return 'enabled' !== get_option( 'inspiry_property_analytics_status', 'enabled' );
					}
				)
			)
		);

		// Submit Property
		$wp_customize->add_section( 'inspiry_members_submit', array(
			'title' => esc_html__( 'Submit Property', 'framework' ),
			'panel' => 'inspiry_dashboard_panel',
		) );

		// Submit Property Module
		$wp_customize->add_setting( 'inspiry_submit_property_module_display', array(
			'type'              => 'option',
			'default'           => 'true',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'inspiry_submit_property_module_display', array(
			'label'   => esc_html__( 'Submit Property Module', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_members_submit',
			'choices' => array(
				'true'  => esc_html__( 'Enable', 'framework' ),
				'false' => esc_html__( 'Disable', 'framework' ),
			),
		) );

		$wp_customize->add_setting( 'inspiry_dashboard_submit_page_layout', array(
			'type'              => 'option',
			'default'           => 'steps',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'inspiry_sanitize_select',
		) );
		$wp_customize->add_control( 'inspiry_dashboard_submit_page_layout', array(
			'label'   => esc_html__( 'Page Layout', 'framework' ),
			'type'    => 'select',
			'section' => 'inspiry_members_submit',
			'choices' => array(
				'steps' => esc_html__( 'Multi Steps', 'framework' ),
				'step'  => esc_html__( 'Single Step', 'framework' ),
			),
		) );

		/* Show submit button when user login */
		$show_submit_on_login_default = 'true';
		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$show_submit_on_login_default = 'false';
		}
		$wp_customize->add_setting( 'inspiry_show_submit_on_login', array(
			'type'              => 'option',
			'default'           => $show_submit_on_login_default,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_show_submit_on_login', array(
			'label'   => esc_html__( 'Submit Button in Header', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_members_submit',
			'choices' => array(
				'true'  => esc_html__( 'Show to Logged In Users Only', 'framework' ),
				'false' => esc_html__( 'Show to All Users', 'framework' ),
				'hide'  => esc_html__( 'Hide', 'framework' ),
			),
		) );

		/* Submit button text */
		$wp_customize->add_setting( 'theme_submit_button_text', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Submit', 'framework' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_submit_button_text', array(
			'label'           => esc_html__( 'Submit Button Text', 'framework' ),
			'type'            => 'text',
			'section'         => 'inspiry_members_submit',
			'active_callback' => function () {
				return ( 'hide' !== get_option( 'inspiry_show_submit_on_login', 'true' ) );
			},
		) );

		/* Guest Property Submission */
		$wp_customize->add_setting( 'inspiry_guest_submission', array(
			'type'              => 'option',
			'default'           => 'false',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_guest_submission', array(
			'label'   => esc_html__( 'Guest Property Submission', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_members_submit',
			'choices' => array(
				'true'  => esc_html__( 'Enable', 'framework' ),
				'false' => esc_html__( 'Disable', 'framework' ),
			),
		) );

		// Submit Property Form Fields
		$submit_property_form_fields = array(
			'title'              => esc_html__( 'Property Title', 'framework' ),
			'address-and-map'    => esc_html__( 'Property Address and Map', 'framework' ),
			'description'        => esc_html__( 'Property Description', 'framework' ),
			'price'              => esc_html__( 'Price', 'framework' ),
			'price-postfix'      => esc_html__( 'Price Postfix', 'framework' ),
			'old-price'          => esc_html__( 'Old Price', 'framework' ),
			'property-id'        => esc_html__( 'Property ID', 'framework' ),
			'parent'             => esc_html__( 'Parent Property', 'framework' ),
			'property-type'      => esc_html__( 'Type', 'framework' ),
			'property-status'    => esc_html__( 'Status', 'framework' ),
			'locations'          => esc_html__( 'Location', 'framework' ),
			'bedrooms'           => esc_html__( 'Bedrooms', 'framework' ),
			'bathrooms'          => esc_html__( 'Bathrooms', 'framework' ),
			'garages'            => esc_html__( 'Garages', 'framework' ),
			'area'               => esc_html__( 'Area', 'framework' ),
			'area-postfix'       => esc_html__( 'Area Postfix', 'framework' ),
			'lot-size'           => esc_html__( 'Lot Size', 'framework' ),
			'lot-size-postfix'   => esc_html__( 'Lot Size Postfix', 'framework' ),
			'year-built'         => esc_html__( 'Year Built', 'framework' ),
			'video'              => esc_html__( 'Video', 'framework' ),
			'virtual-tour'       => esc_html__( '360 Virtual Tour', 'framework' ),
			'mortgage-fields'    => esc_html__( 'Mortgage Calculator Fields', 'framework' ),
			'featured'           => esc_html__( 'Mark as Featured', 'framework' ),
			'gallery-type'       => esc_html__( 'Gallery Type', 'framework' ),
			'images'             => esc_html__( 'Property Images', 'framework' ),
			'attachments'        => esc_html__( 'Property Attachments', 'framework' ),
			'slider-image'       => esc_html__( 'Homepage Slider Image', 'framework' ),
			'floor-plans'        => esc_html__( 'Floor Plans', 'framework' ),
			'additional-details' => esc_html__( 'Additional Details', 'framework' ),
			'features'           => esc_html__( 'Features', 'framework' ),
			'label-and-color'    => esc_html__( 'Label and Color', 'framework' ),
			'energy-performance' => esc_html__( 'Energy Performance', 'framework' ),
			'agent'              => esc_html__( 'Agent', 'framework' ),
			'owner-information'  => esc_html__( 'Owner Information', 'framework' ),
			'reviewer-message'   => esc_html__( 'Message to Reviewer', 'framework' ),
			'terms-conditions'   => esc_html__( 'Terms & Conditions', 'framework' ),
		);

		$wp_customize->add_setting( 'inspiry_submit_property_fields', array(
			'type'              => 'option',
			'default'           => array_keys( $submit_property_form_fields ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'inspiry_sanitize_multiple_checkboxes',
		) );
		$wp_customize->add_control( new Inspiry_Multiple_Checkbox_Customize_Control( $wp_customize, 'inspiry_submit_property_fields',
			array(
				'section' => 'inspiry_members_submit',
				'label'   => esc_html__( 'Enable/Disable Submit Property Form Fields?', 'framework' ),
				'choices' => $submit_property_form_fields
			)
		) );

		// Default agent option for user/agent area
		$wp_customize->add_setting( 'realhomes_default_selected_agent', array(
			'type'              => 'option',
			'default'           => 0,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'inspiry_sanitize_select',
		) );
		$wp_customize->add_control( 'realhomes_default_selected_agent', array(
			'label'           => esc_html__( 'Select Default Agent For Agent Area', 'framework' ),
			'description'     => esc_html__( 'Choose an agent to be automatically pre-selected on the "Submit Property" page within the "Agent & Reviewer" section.', 'framework' ),
			'type'            => 'select',
			'section'         => 'inspiry_members_submit',
			'choices'         => RH_Data::get_posts_array( 'agent' ),
			'active_callback' => 'inspiry_is_submit_property_field_terms'
		) );

		// terms & conditions field note
		$wp_customize->add_setting( 'inspiry_submit_property_terms_text', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Accept Terms & Conditions before property submission.', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'inspiry_submit_property_terms_text', array(
			'label'           => esc_html__( 'Terms & Conditions Note', 'framework' ),
			'description'     => '<strong>' . esc_html__( 'Important:', 'framework' ) . ' </strong>' . esc_html__( 'Please use {link text} pattern in your note text as it will be linked to the Terms & Conditions page.', 'framework' ),
			'type'            => 'text',
			'section'         => 'inspiry_members_submit',
			'active_callback' => 'inspiry_is_submit_property_field_terms'
		) );

		// terms and conditions detail page
		$wp_customize->add_setting( 'inspiry_submit_property_terms_page', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'inspiry_sanitize_select',
		) );
		$wp_customize->add_control( 'inspiry_submit_property_terms_page', array(
			'label'           => esc_html__( 'Select Terms & Conditions Page', 'framework' ),
			'description'     => esc_html__( 'Selected page should have terms & conditions details.', 'framework' ),
			'type'            => 'select',
			'section'         => 'inspiry_members_submit',
			'choices'         => RH_Data::get_pages_array(),
			'active_callback' => 'inspiry_is_submit_property_field_terms'
		) );

		// require to access the terms and conditions
		$wp_customize->add_setting( 'inspiry_submit_property_terms_require', array(
			'type'              => 'option',
			'default'           => true,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'inspiry_sanitize_checkbox',
		) );
		$wp_customize->add_control(
			'inspiry_submit_property_terms_require',
			array(
				'label'           => esc_html__( 'Require Terms & Conditions.', 'framework' ),
				'section'         => 'inspiry_members_submit',
				'type'            => 'checkbox',
				'active_callback' => 'inspiry_is_submit_property_field_terms'
			)
		);

		/* Submitted Property Status */
		$wp_customize->add_setting( 'theme_submitted_status', array(
			'type'              => 'option',
			'default'           => 'pending',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'inspiry_sanitize_select',
		) );
		$wp_customize->add_control( 'theme_submitted_status', array(
			'label'   => esc_html__( 'Default Status for Submitted Property', 'framework' ),
			'type'    => 'select',
			'section' => 'inspiry_members_submit',
			'choices' => array(
				'pending' => esc_html__( 'Pending ( Recommended )', 'framework' ),
				'publish' => esc_html__( 'Publish', 'framework' ),
			),
		) );

		/* Updated Property Status */
		$wp_customize->add_setting( 'inspiry_updated_property_status', array(
			'type'              => 'option',
			'default'           => 'publish',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'inspiry_sanitize_select',
		) );
		$wp_customize->add_control( 'inspiry_updated_property_status', array(
			'label'   => esc_html__( 'Default Status for Updated Property', 'framework' ),
			'type'    => 'select',
			'section' => 'inspiry_members_submit',
			'choices' => array(
				'publish' => esc_html__( 'Publish', 'framework' ),
				'pending' => esc_html__( 'Pending ( Recommended )', 'framework' ),
			),
		) );

		$wp_customize->add_setting( 'inspiry_submit_max_number_images', array(
			'type'              => 'option',
			'default'           => 48,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_submit_max_number_images', array(
			'label'   => esc_html__( 'Max Number of Images to Upload', 'framework' ),
			'type'    => 'number',
			'section' => 'inspiry_members_submit',
		) );

		$wp_customize->add_setting( 'inspiry_allowed_max_attachments', array(
			'type'              => 'option',
			'default'           => 15,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_allowed_max_attachments', array(
			'label'   => esc_html__( 'Max Number of Attachments to Upload', 'framework' ),
			'type'    => 'number',
			'section' => 'inspiry_members_submit',
		) );

		/*  Property default additional details */
		$wp_customize->add_setting( 'inspiry_property_additional_details', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'inspiry_property_additional_details', array(
			'label'       => esc_html__( 'Default Additional Details', 'framework' ),
			'description' => wp_kses( __( 'Add title and value \'colon\' separated and fields \'comma\' separated. <br><br><strong>For Example</strong>: <pre>Plot Size:300,Built Year:2017</pre>', 'framework' ), array(
				'br'     => array(),
				'strong' => array(),
				'pre'    => array(),
			) ),
			'type'        => 'textarea',
			'section'     => 'inspiry_members_submit',
		) );

		/* Message after Submit */
		$wp_customize->add_setting( 'theme_submit_message', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Thanks for Submitting Property!', 'framework' ),
			'sanitize_callback' => 'inspiry_sanitize_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'theme_submit_message', array(
			'label'       => esc_html__( 'Message After Successful Submit', 'framework' ),
			'description' => esc_html__( 'a, strong, em and i HTML tags are allowed in the message.', 'framework' ),
			'type'        => 'textarea',
			'section'     => 'inspiry_members_submit',
		) );

		/* After Property Submit Redirect Page */
		$wp_customize->add_setting( 'inspiry_property_submit_redirect_page', array(
			'type'              => 'option',
			'sanitize_callback' => 'inspiry_sanitize_select',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'inspiry_property_submit_redirect_page', array(
			'label'       => esc_html__( 'Redirect to Selected Page After Submission', 'framework' ),
			'description' => esc_html__( 'This not applies on guest submission.', 'framework' ),
			'type'        => 'select',
			'section'     => 'inspiry_members_submit',
			'choices'     => RH_Data::get_pages_array(),
		) );

		/* Submit Notice */
		$wp_customize->add_setting( 'theme_submit_notice_email', array(
			'type'              => 'option',
			'default'           => get_option( 'admin_email' ),
			'sanitize_callback' => 'sanitize_email',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'theme_submit_notice_email', array(
			'label'   => esc_html__( 'Email Address to Received Submission Notices', 'framework' ),
			'type'    => 'email',
			'section' => 'inspiry_members_submit',
		) );

		// Submit Property Labels
		$wp_customize->add_section( 'realhomes_submit_property_labels', array(
			'title' => esc_html__( 'Submit Property Labels', 'framework' ),
			'panel' => 'inspiry_dashboard_panel',
		) );

		// Property Title Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_title_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Property Title', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_title_label', array(
			'label'       => esc_html__( 'Property Title', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Title Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Address Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_address_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Address', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_address_label', array(
			'label'       => esc_html__( 'Property Address', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Address Field in the MAP section', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Find Address Button Label
		$wp_customize->add_setting( 'realhomes_submit_property_find_address_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Find Address', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_find_address_label', array(
			'label'       => esc_html__( 'Find Address', 'framework' ),
			'description' => esc_html__( 'Find Address Button in the map section', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Description Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_description_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Property Description', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_description_label', array(
			'label'       => esc_html__( 'Property Description', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Description Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Price Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_price_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Sale or Rent Price', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_price_label', array(
			'label'       => esc_html__( 'Property Price', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Price Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Old Price Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_old_price_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Old Price', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_old_price_label', array(
			'label'       => esc_html__( 'Property Old Price', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Old Price Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Price Prefix Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_price_prefix_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Price Prefix Text', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_price_prefix_label', array(
			'label'       => esc_html__( 'Property Price Prefix', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Price Prefix Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Price Postfix Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_price_postfix_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Price Postfix Text', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_price_postfix_label', array(
			'label'       => esc_html__( 'Property Price Postfix', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Price Postfix Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property ID Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_id_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Property ID', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_id_label', array(
			'label'       => esc_html__( 'Property ID', 'framework' ),
			'description' => esc_html__( 'Label Text for Property ID Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Parent Property Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_parent_property_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Parent Property', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_parent_property_label', array(
			'label'       => esc_html__( 'Parent Property', 'framework' ),
			'description' => esc_html__( 'Label Text for Parent Property Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Type Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_type_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Type', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_type_label', array(
			'label'       => esc_html__( 'Property Type', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Type Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Status Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_status_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Status', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_status_label', array(
			'label'       => esc_html__( 'Property Status', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Status Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Bedroom Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_bedroom_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Bedroom', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_bedroom_label', array(
			'label'       => esc_html__( 'Property Bedroom', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Bedroom Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Bathroom Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_bathroom_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Bathroom', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_bathroom_label', array(
			'label'       => esc_html__( 'Property Bathroom', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Bathroom Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Garage Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_garage_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Garages or Parking Spaces', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_garage_label', array(
			'label'       => esc_html__( 'Property Garage', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Garage Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Area Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_area_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Area', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_area_label', array(
			'label'       => esc_html__( 'Property Area', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Area Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Area Postfix Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_area_postfix_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Area Postfix', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_area_postfix_label', array(
			'label'       => esc_html__( 'Property Area Postfix', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Area Postfix Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Lot Size Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_lot_size_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Lot Size', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_lot_size_label', array(
			'label'       => esc_html__( 'Property Lot Size', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Lot Size Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Lot Size Postfix Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_lot_size_postfix_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Lot Size Postfix Text', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_lot_size_postfix_label', array(
			'label'       => esc_html__( 'Property Lot Size Postfix', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Lot Size Postfix Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Year Built Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_year_built_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Year Built', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_year_built_label', array(
			'label'       => esc_html__( 'Property Year Built', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Year Built Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Images Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_images_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Property Images', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_images_label', array(
			'label'       => esc_html__( 'Property Images', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Images Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Gallery Type Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_gallery_type_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Change Gallery Type', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_gallery_type_label', array(
			'label'       => esc_html__( 'Change Gallery Type', 'framework' ),
			'description' => esc_html__( 'Label Text for Change Gallery Type Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Attachments Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_attachments_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Property Attachments', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_attachments_label', array(
			'label'       => esc_html__( 'Property Attachments', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Attachments Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Homepage Slider Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_homepage_slider_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Do you want to add this property in Homepage Slider?', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_homepage_slider_label', array(
			'label'       => esc_html__( 'Homepage Slider', 'framework' ),
			'description' => esc_html__( 'Label Text for Homepage Slider Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Floor Plans Section Label
		$wp_customize->add_setting( 'realhomes_submit_property_floor_plans_section_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Floor Plans', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_floor_plans_section_label', array(
			'label'       => esc_html__( 'Section Floor Plans', 'framework' ),
			'description' => esc_html__( 'Label Text for Floor Plans section', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );


		// Property Floor Plan Name Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_floor_name_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Floor Name', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_floor_name_label', array(
			'label'       => esc_html__( 'Floor Name', 'framework' ),
			'description' => esc_html__( 'Label Text for Floor Name Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Floor Plan Image Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_floor_image_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Floor Plan Image', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_floor_image_label', array(
			'label'       => esc_html__( 'Floor Plan Image', 'framework' ),
			'description' => esc_html__( 'Label Text for Floor Plan Image Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Floor Plan Description Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_floor_description_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Description', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_floor_description_label', array(
			'label'       => esc_html__( 'Floor Plan Description', 'framework' ),
			'description' => esc_html__( 'Label Text for Floor Plan Description Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Floor Plan Price Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_floor_price_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Floor Price', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_floor_price_label', array(
			'label'       => esc_html__( 'Floor Price', 'framework' ),
			'description' => esc_html__( 'Label Text for Floor Price Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Floor Plan Price Postfix Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_floor_price_postfix_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Price Postfix', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_floor_price_postfix_label', array(
			'label'       => esc_html__( 'Floor Price Postfix', 'framework' ),
			'description' => esc_html__( 'Label Text for Floor Price Postfix Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Floor Plan Size Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_floor_size_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Floor Size', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_floor_size_label', array(
			'label'       => esc_html__( 'Floor Size', 'framework' ),
			'description' => esc_html__( 'Label Text for Floor Size Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Floor Plan Size Postfix Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_floor_size_postfix_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Size Postfix', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_floor_size_postfix_label', array(
			'label'       => esc_html__( 'Floor Size Postfix', 'framework' ),
			'description' => esc_html__( 'Label Text for Floor Size Postfix Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Floor Plan Bedrooms Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_floor_beds_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Bedrooms', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_floor_beds_label', array(
			'label'       => esc_html__( 'Floor Bedrooms Postfix', 'framework' ),
			'description' => esc_html__( 'Label Text for Floor Bedrooms Postfix Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Floor Plan Bathrooms Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_floor_baths_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Bathrooms', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_floor_baths_label', array(
			'label'       => esc_html__( 'Floor Bathrooms Postfix', 'framework' ),
			'description' => esc_html__( 'Label Text for Floor Bathrooms Postfix Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// 360 Virtual Tour Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_virtual_tour_label', array(
			'type'              => 'option',
			'default'           => esc_html__( '360 Virtual Tour', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_virtual_tour_label', array(
			'label'       => esc_html__( 'Property 360 Virtual Tour', 'framework' ),
			'description' => esc_html__( 'Label Text for Property 360 Virtual Tour Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Additional Details Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_additional_details_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Additional Details', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_additional_details_label', array(
			'label'       => esc_html__( 'Property Additional Details', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Additional Details Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Features Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_features_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Features', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_features_label', array(
			'label'       => esc_html__( 'Property Features', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Features Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Label Text Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_label_text', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Property Label Text', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_label_text', array(
			'label'       => esc_html__( 'Property Label Text', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Label Text Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Label Text Sub Heading Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_label_text_sub', array(
			'type'              => 'option',
			'default'           => esc_html__( 'You can add a property label to display on property thumbnails. Example: Hot Deal', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_label_text_sub', array(
			'label'       => esc_html__( 'Property Label Text Sub Heading', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Label Text Sub Heading', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Label Background Color Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_label_bg_color', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Label Background Color', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_label_bg_color', array(
			'label'       => esc_html__( 'Label Background Color', 'framework' ),
			'description' => esc_html__( 'Label Text for Label Background Color Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Background Color Sub Heading Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_label_bg_sub', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Set a label background color. Otherwise label text will be displayed with transparent background.', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_label_bg_sub', array(
			'label'       => esc_html__( 'Background Color Sub Heading', 'framework' ),
			'description' => esc_html__( 'Sub Heading for Label Background Color', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Energy Performance Section Label
		$wp_customize->add_setting( 'realhomes_submit_property_ep_section_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Energy Performance', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_ep_section_label', array(
			'label'       => esc_html__( 'Property Energy Performance Section', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Energy Performance Section', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Energy Class Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_energy_class_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Energy Class', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_energy_class_label', array(
			'label'       => esc_html__( 'Property Energy Class', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Energy Class Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Energy Performance Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_energy_performance_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Energy Performance', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_energy_performance_label', array(
			'label'       => esc_html__( 'Property Energy Performance', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Energy Performance Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// EPC Current Rating Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_epc_current_rating_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'EPC Current Rating', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_epc_current_rating_label', array(
			'label'       => esc_html__( 'Property EPC Current Rating', 'framework' ),
			'description' => esc_html__( 'Label Text for Property EPC Current Rating Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// EPC Potential Rating Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_epc_potential_rating_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'EPC Potential Rating', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_epc_potential_rating_label', array(
			'label'       => esc_html__( 'Property EPC Potential Rating', 'framework' ),
			'description' => esc_html__( 'Label Text for Property EPC Potential Rating Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Agent Display Label
		$wp_customize->add_setting( 'realhomes_submit_property_agent_info_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'What to display in agent information box?', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_agent_info_label', array(
			'label'       => esc_html__( 'What to display in agent information box?', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Agent Information section', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Agent Display Option One Label
		$wp_customize->add_setting( 'realhomes_submit_property_agent_option_one_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'None ( Agent information box will not be displayed )', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_agent_option_one_label', array(
			'label'       => esc_html__( 'First Agent Field Options', 'framework' ),
			'description' => esc_html__( 'Label Text for First Agent Field Option', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Agent Display Option Two Label
		$wp_customize->add_setting( 'realhomes_submit_property_agent_option_two_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'My profile information.', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_agent_option_two_label', array(
			'label'       => esc_html__( 'Second Agent Field Options', 'framework' ),
			'description' => esc_html__( 'Label Text for Second Agent Field Option', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Agent Display Option Two Sub Label
		$wp_customize->add_setting( 'realhomes_submit_property_agent_option_two_sub_label', array(
			'type'              => 'option',
			'default'           => esc_html__( '( Edit Profile Information )', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_agent_option_two_sub_label', array(
			'label'       => esc_html__( '( Edit Profile Information )', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Agent Field Options', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Agent Display Option Three Label
		$wp_customize->add_setting( 'realhomes_submit_property_agent_option_three_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Display agent(s) information.', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_agent_option_three_label', array(
			'label'       => esc_html__( 'Third Agent Field Options', 'framework' ),
			'description' => esc_html__( 'Label Text for Third Agent Field Option', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Owner Name Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_owner_name_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Property Owner Name', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_owner_name_label', array(
			'label'       => esc_html__( 'Property Owner Name Field', 'framework' ),
			'description' => esc_html__( 'Label Text for Property Owner Name Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Owner Contact Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_owner_contact_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Owner Contact', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_owner_contact_label', array(
			'label'       => esc_html__( 'Owner Contact Field', 'framework' ),
			'description' => esc_html__( 'Label Text for Owner Contact Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Property Owner Address Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_owner_address_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Owner Address', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_owner_address_label', array(
			'label'       => esc_html__( 'Owner Address Field', 'framework' ),
			'description' => esc_html__( 'Label Text for Owner Address Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// Message to the Reviewer Field Label
		$wp_customize->add_setting( 'realhomes_submit_property_message_to_the_reviewer_label', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Message to the Reviewer', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_submit_property_message_to_the_reviewer_label', array(
			'label'       => esc_html__( 'Message to the Reviewer Field', 'framework' ),
			'description' => esc_html__( 'Label Text for Message to the Reviewer Field', 'framework' ),
			'type'        => 'text',
			'section'     => 'realhomes_submit_property_labels',
		) );

		// My Properties
		$wp_customize->add_section( 'inspiry_members_properties', array(
			'title' => esc_html__( 'My Properties', 'framework' ),
			'panel' => 'inspiry_dashboard_panel',
		) );

		// My Properties Module
		$wp_customize->add_setting( 'inspiry_properties_module_display', array(
			'type'              => 'option',
			'default'           => 'true',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'inspiry_properties_module_display', array(
			'label'   => esc_html__( 'My Properties Module', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_members_properties',
			'choices' => array(
				'true'  => esc_html__( 'Enable', 'framework' ),
				'false' => esc_html__( 'Disable', 'framework' ),
			),
		) );

		if ( function_exists( 'rvr_is_enabled' ) && rvr_is_enabled() ) {
			// Bookings Section
			$wp_customize->add_section( 'realhomes_dashboard_bookings', array(
				'title' => esc_html__( 'Bookings & Reservations', 'framework' ),
				'panel' => 'inspiry_dashboard_panel',
			) );

			// Bookings Module
			$wp_customize->add_setting( 'realhomes_bookings_module_display', array(
				'type'              => 'option',
				'default'           => 'true',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'realhomes_bookings_module_display', array(
				'label'   => esc_html__( 'Bookings Module', 'framework' ),
				'type'    => 'radio',
				'section' => 'realhomes_dashboard_bookings',
				'choices' => array(
					'true'  => esc_html__( 'Enable', 'framework' ),
					'false' => esc_html__( 'Disable', 'framework' ),
				),
			) );

			// Reservations Module
			$wp_customize->add_setting( 'realhomes_reservations_module_display', array(
				'type'              => 'option',
				'default'           => 'true',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'realhomes_reservations_module_display', array(
				'label'   => esc_html__( 'Reservations Module', 'framework' ),
				'type'    => 'radio',
				'section' => 'realhomes_dashboard_bookings',
				'choices' => array(
					'true'  => esc_html__( 'Enable', 'framework' ),
					'false' => esc_html__( 'Disable', 'framework' ),
				),
			) );

			// Invoices Module
			$wp_customize->add_setting( 'realhomes_invoices_module_display', array(
				'type'              => 'option',
				'default'           => 'true',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'realhomes_invoices_module_display', array(
				'label'   => esc_html__( 'Invoices Module', 'framework' ),
				'type'    => 'radio',
				'section' => 'realhomes_dashboard_bookings',
				'choices' => array(
					'true'  => esc_html__( 'Enable', 'framework' ),
					'false' => esc_html__( 'Disable', 'framework' ),
				),
			) );
		}

		// Agents Section
		$wp_customize->add_section( 'realhomes_dashboard_agents_section', array(
			'title' => esc_html__( 'Agents', 'framework' ),
			'panel' => 'inspiry_dashboard_panel',
		) );

		// Agencies Section
		$wp_customize->add_section( 'realhomes_dashboard_agencies_section', array(
			'title' => esc_html__( 'Agencies', 'framework' ),
			'panel' => 'inspiry_dashboard_panel',
		) );

		// Agencies Module
		$wp_customize->add_setting( 'realhomes_agencies_module_display', array(
			'type'              => 'option',
			'default'           => 'false',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'realhomes_agencies_module_display', array(
			'label'   => esc_html__( 'Agencies Module', 'framework' ),
			'type'    => 'radio',
			'section' => 'realhomes_dashboard_agencies_section',
			'choices' => array(
				'true'  => esc_html__( 'Enable', 'framework' ),
				'false' => esc_html__( 'Disable', 'framework' ),
			),
		) );

		$wp_customize->add_setting( 'realhomes_add_agency_module_display', array(
			'type'              => 'option',
			'default'           => 'false',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'realhomes_add_agency_module_display', array(
			'label'   => esc_html__( 'Add New Agency Module', 'framework' ),
			'type'    => 'radio',
			'section' => 'realhomes_dashboard_agencies_section',
			'choices' => array(
				'true'  => esc_html__( 'Enable', 'framework' ),
				'false' => esc_html__( 'Disable', 'framework' ),
			),
		) );

		// Submitted agency status
		$wp_customize->add_setting( 'realhomes_submitted_agency_status', array(
			'type'              => 'option',
			'default'           => 'pending',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'inspiry_sanitize_select',
		) );
		$wp_customize->add_control( 'realhomes_submitted_agency_status', array(
			'label'   => esc_html__( 'Default Status for Submitted Agency', 'framework' ),
			'type'    => 'select',
			'section' => 'realhomes_dashboard_agencies_section',
			'choices' => array(
				'pending' => esc_html__( 'Pending ( Recommended )', 'framework' ),
				'publish' => esc_html__( 'Publish', 'framework' ),
			),
		) );

		// Updated agency status
		$wp_customize->add_setting( 'realhomes_updated_agency_status', array(
			'type'              => 'option',
			'default'           => 'publish',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'inspiry_sanitize_select',
		) );
		$wp_customize->add_control( 'realhomes_updated_agency_status', array(
			'label'   => esc_html__( 'Default Status for Updated Agency', 'framework' ),
			'type'    => 'select',
			'section' => 'realhomes_dashboard_agencies_section',
			'choices' => array(
				'publish' => esc_html__( 'Publish', 'framework' ),
				'pending' => esc_html__( 'Pending ( Recommended )', 'framework' ),
			),
		) );

		// After agency submit redirect Page
		$wp_customize->add_setting( 'realhomes_after_agency_submit_redirect_page', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'inspiry_sanitize_select',
		) );
		$wp_customize->add_control( 'realhomes_after_agency_submit_redirect_page', array(
			'label'       => esc_html__( 'Redirect to Selected Page After Submission', 'framework' ),
			'description' => esc_html__( 'Choose a page to redirect users to it after successful submission an agency. Keeping it on the default page is recommended for better user experience.', 'framework' ),
			'type'        => 'select',
			'section'     => 'realhomes_dashboard_agencies_section',
			'choices'     => RH_Data::get_pages_array(),
		) );

		$wp_customize->add_setting( 'realhomes_agency_submit_notice_email', array(
			'type'              => 'option',
			'default'           => get_option( 'admin_email' ),
			'sanitize_callback' => 'sanitize_email',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_agency_submit_notice_email', array(
			'label'   => esc_html__( 'Email Address to Received Submission Notices', 'framework' ),
			'type'    => 'email',
			'section' => 'realhomes_dashboard_agencies_section',
		) );

		// Agents Module
		$wp_customize->add_setting( 'realhomes_agents_module_display', array(
			'type'              => 'option',
			'default'           => 'false',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'realhomes_agents_module_display', array(
			'label'   => esc_html__( 'Agents Module', 'framework' ),
			'type'    => 'radio',
			'section' => 'realhomes_dashboard_agents_section',
			'choices' => array(
				'true'  => esc_html__( 'Enable', 'framework' ),
				'false' => esc_html__( 'Disable', 'framework' ),
			),
		) );

		$wp_customize->add_setting( 'realhomes_add_agent_module_display', array(
			'type'              => 'option',
			'default'           => 'false',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'realhomes_add_agent_module_display', array(
			'label'   => esc_html__( 'Add New Agent Module', 'framework' ),
			'type'    => 'radio',
			'section' => 'realhomes_dashboard_agents_section',
			'choices' => array(
				'true'  => esc_html__( 'Enable', 'framework' ),
				'false' => esc_html__( 'Disable', 'framework' ),
			),
		) );

		// Submitted agent status
		$wp_customize->add_setting( 'realhomes_submitted_agent_status', array(
			'type'              => 'option',
			'default'           => 'pending',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'inspiry_sanitize_select',
		) );
		$wp_customize->add_control( 'realhomes_submitted_agent_status', array(
			'label'   => esc_html__( 'Default Status for Submitted Agent', 'framework' ),
			'type'    => 'select',
			'section' => 'realhomes_dashboard_agents_section',
			'choices' => array(
				'pending' => esc_html__( 'Pending ( Recommended )', 'framework' ),
				'publish' => esc_html__( 'Publish', 'framework' ),
			),
		) );

		// Updated agent status
		$wp_customize->add_setting( 'realhomes_updated_agent_status', array(
			'type'              => 'option',
			'default'           => 'publish',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'inspiry_sanitize_select',
		) );
		$wp_customize->add_control( 'realhomes_updated_agent_status', array(
			'label'   => esc_html__( 'Default Status for Updated Agent', 'framework' ),
			'type'    => 'select',
			'section' => 'realhomes_dashboard_agents_section',
			'choices' => array(
				'publish' => esc_html__( 'Publish', 'framework' ),
				'pending' => esc_html__( 'Pending ( Recommended )', 'framework' ),
			),
		) );

		// After agent submit redirect Page
		$wp_customize->add_setting( 'realhomes_after_agent_submit_redirect_page', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'inspiry_sanitize_select',
		) );
		$wp_customize->add_control( 'realhomes_after_agent_submit_redirect_page', array(
			'label'       => esc_html__( 'Redirect to Selected Page After Submission', 'framework' ),
			'description' => esc_html__( 'Choose a page to redirect users to it after successful submission an agent. Keeping it on the default page is recommended for better user experience.', 'framework' ),
			'type'        => 'select',
			'section'     => 'realhomes_dashboard_agents_section',
			'choices'     => RH_Data::get_pages_array(),
		) );

		$wp_customize->add_setting( 'realhomes_agent_submit_notice_email', array(
			'type'              => 'option',
			'default'           => get_option( 'admin_email' ),
			'sanitize_callback' => 'sanitize_email',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'realhomes_agent_submit_notice_email', array(
			'label'   => esc_html__( 'Email Address to Received Submission Notices', 'framework' ),
			'type'    => 'email',
			'section' => 'realhomes_dashboard_agents_section',
		) );

		// My profile
		$wp_customize->add_section( 'inspiry_members_profile', array(
			'title' => esc_html__( 'My Profile', 'framework' ),
			'panel' => 'inspiry_dashboard_panel',
		) );

		// My profile module
		$wp_customize->add_setting( 'inspiry_profile_module_display', array(
			'type'              => 'option',
			'default'           => 'true',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'inspiry_profile_module_display', array(
			'label'   => esc_html__( 'My Profile Module', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_members_profile',
			'choices' => array(
				'true'  => esc_html__( 'Enable', 'framework' ),
				'false' => esc_html__( 'Disable', 'framework' ),
			),
		) );

		// My favorites
		$wp_customize->add_section( 'inspiry_members_favorites', array(
			'title' => esc_html__( 'My Favorites', 'framework' ),
			'panel' => 'inspiry_dashboard_panel',
		) );

		// My favorites module
		$wp_customize->add_setting( 'inspiry_favorites_module_display', array(
			'type'              => 'option',
			'default'           => 'true',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'inspiry_favorites_module_display', array(
			'label'   => esc_html__( 'My Favorites Module', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_members_favorites',
			'choices' => array(
				'true'  => esc_html__( 'Enable', 'framework' ),
				'false' => esc_html__( 'Disable', 'framework' ),
			),
		) );

		// Enable/Disable add to favorites
		$wp_customize->add_setting( 'theme_enable_fav_button', array(
			'type'              => 'option',
			'default'           => 'true',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'theme_enable_fav_button', array(
			'label'   => esc_html__( 'Add to Favorites Button on Property Detail Page', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_members_favorites',
			'choices' => array(
				'true'  => esc_html__( 'Show', 'framework' ),
				'false' => esc_html__( 'Hide', 'framework' ),
			),
		) );

		// Require login to favorite properties
		$wp_customize->add_setting( 'inspiry_login_on_fav', array(
			'type'              => 'option',
			'default'           => 'no',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'inspiry_login_on_fav', array(
			'label'   => esc_html__( 'Require Login for Add to Favorites.', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_members_favorites',
			'choices' => array(
				'yes' => esc_html__( 'Yes', 'framework' ),
				'no'  => esc_html__( 'No', 'framework' ),
			),
		) );

		$wp_customize->add_section(
			'realhomes_saved_searches',
			array(
				'title' => esc_html__( 'Saved Searches', 'framework' ),
				'panel' => 'inspiry_dashboard_panel',
			)
		);

		$wp_customize->add_setting(
			'realhomes_saved_searches_enabled', array(
				'type'              => 'option',
				'default'           => 'yes',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			)
		);

		$wp_customize->add_control(
			'realhomes_saved_searches_enabled',
			array(
				'label'       => esc_html__( 'Enable Saved Searches? ', 'framework' ),
				'description' => esc_html__( 'Enabling this feature will display a "Save Search" button at the top of search results. It will also add a "Saved Searches" menu item to the user menu.', 'framework' ),
				'type'        => 'radio',
				'section'     => 'realhomes_saved_searches',
				'choices'     => array(
					'yes' => esc_html__( 'Yes', 'framework' ),
					'no'  => esc_html__( 'No', 'framework' ),
				),
			)
		);

		$wp_customize->add_setting(
			'realhomes_search_emails_frequency', array(
				'type'              => 'option',
				'default'           => 'daily',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			)
		);

		$wp_customize->add_control(
			'realhomes_search_emails_frequency',
			array(
				'label'   => esc_html__( 'Search Emails Frequency', 'framework' ),
				'type'    => 'radio',
				'section' => 'realhomes_saved_searches',
				'choices' => array(
					'daily'  => esc_html__( 'Daily', 'framework' ),
					'weekly' => esc_html__( 'Weekly', 'framework' ),
				),
			)
		);

		$wp_customize->add_setting(
			'realhomes_saved_searches_labels_separator',
			array(
				'sanitize_callback' => 'inspiry_sanitize',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'realhomes_saved_searches_labels_separator',
				array(
					'section' => 'realhomes_saved_searches',
				)
			)
		);

		$wp_customize->add_setting(
			'realhomes_save_search_btn_label',
			array(
				'type'              => 'option',
				'default'           => esc_html__( 'Save Search', 'framework' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'realhomes_save_search_btn_label',
			array(
				'label'   => esc_html__( 'Save Search Button Label', 'framework' ),
				'type'    => 'text',
				'section' => 'realhomes_saved_searches',
			)
		);

		$wp_customize->add_setting(
			'realhomes_search_saved_btn_label',
			array(
				'type'              => 'option',
				'default'           => esc_html__( 'Search Saved', 'framework' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'realhomes_search_saved_btn_label',
			array(
				'label'   => esc_html__( 'Search Saved Button Label', 'framework' ),
				'type'    => 'text',
				'section' => 'realhomes_saved_searches',
			)
		);

		$wp_customize->add_setting(
			'realhomes_save_search_btn_tooltip',
			array(
				'type'              => 'option',
				'default'           => esc_html__( 'Receive email notification for the latest properties matching your search criteria.', 'framework' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'realhomes_save_search_btn_tooltip',
			array(
				'label'   => esc_html__( 'Save Search Button Tooltip Text', 'framework' ),
				'type'    => 'textarea',
				'section' => 'realhomes_saved_searches',
			)
		);

		$wp_customize->add_setting(
			'realhomes_saved_searches_label',
			array(
				'type'              => 'option',
				'default'           => esc_html__( 'My Saved Searches', 'framework' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'realhomes_saved_searches_label',
			array(
				'label'   => esc_html__( '"My Saved Searches" Menu Button and Page Name', 'framework' ),
				'type'    => 'text',
				'section' => 'realhomes_saved_searches',
			)
		);

		$wp_customize->add_setting(
			'realhomes_saved_searches_all_users_label',
			array(
				'type'              => 'option',
				'default'           => esc_html__( 'All Users Saved Searches', 'framework' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'realhomes_saved_searches_all_users_label',
			array(
				'label'       => esc_html__( '"All Users Saved Searches" Sub Menu Button and Page Name', 'framework' ),
				'description' => esc_html__( 'Sub Menu will be displayed only for "Administrator" ', 'framework' ),
				'type'        => 'text',
				'section'     => 'realhomes_saved_searches',
			)
		);

		/**
		 * Saved Search Email Template Setting
		 */
		$wp_customize->add_setting(
			'realhomes_saved_searches_email_separator',
			array(
				'sanitize_callback' => 'inspiry_sanitize',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'realhomes_saved_searches_email_separator',
				array(
					'section' => 'realhomes_saved_searches',
				)
			)
		);

		// Email subject.
		$wp_customize->add_setting(
			'realhomes_saved_search_email_subject',
			array(
				'type'              => 'option',
				'default'           => esc_html__( 'Check Out Latest Properties Matching Your Saved Search Criteria', 'framework' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'realhomes_saved_search_email_subject',
			array(
				'label'   => esc_html__( 'Saved Search Email Subject', 'framework' ),
				'type'    => 'textarea',
				'section' => 'realhomes_saved_searches',
			)
		);

		// Email header text.
		$wp_customize->add_setting(
			'realhomes_saved_search_email_header',
			array(
				'type'              => 'option',
				'default'           => esc_html__( 'Following new properties are listed matching your search criteria. You can check the [search results here].', 'framework' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'realhomes_saved_search_email_header',
			array(
				'label'       => esc_html__( 'Saved Search Email Header Text', 'framework' ),
				'description' => esc_html__( 'Wrapped text within square brackets [] will be linked to the saved search results page.', 'framework' ),
				'type'        => 'textarea',
				'section'     => 'realhomes_saved_searches',
			)
		);

		// Email footer text.
		$wp_customize->add_setting(
			'realhomes_saved_search_email_footer',
			array(
				'type'              => 'option',
				'default'           => esc_html__( 'To stop getting such emails, Simply remove related saved search from your account.', 'framework' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'realhomes_saved_search_email_footer',
			array(
				'label'   => esc_html__( 'Saved Search Email Footer Text', 'framework' ),
				'type'    => 'textarea',
				'section' => 'realhomes_saved_searches',
			)
		);

		// User & Agent/Agency Sync
		$wp_customize->add_section(
			'inspiry_members_user_sync',
			array(
				'title' => esc_html__( 'User & Agent/Agency Sync', 'framework' ),
				'panel' => 'inspiry_dashboard_panel',
			)
		);

		/* Enable/Disable User Sync with Agents/Agencies */
		$wp_customize->add_setting( 'realhomes_users_options_notice' );
		$wp_customize->add_control(
			new Realhomes_Customizer_Notice_Control( $wp_customize, 'realhomes_users_options_notice',
			array(
				'label'   => esc_html__( 'Notice:', 'framework' ),
				'description'   => sprintf( esc_html__('All users synchronization with post types (agent, agency, etc) related option are moved to %s', 'framework' ), '<a class="customizer-link" target="_blank" href=' . admin_url() . 'admin.php?page=ere-settings&tab=users' . '>' . esc_html__( 'ERE User options.', 'framework' ) . '</a>' ),
				'section' => 'inspiry_members_user_sync',
				'sanitize_callback' => 'wp_kses_post'
			) )
		);

		/**
		 * Dashboard customizer settings for membership plugin pages.
		 * @since  3.12
		 */
		if ( class_exists( 'IMS_Helper_Functions' ) ) {

			// Membership Section
			$wp_customize->add_section( 'inspiry_membership_section', array(
				'title' => esc_html__( 'Membership', 'framework' ),
				'panel' => 'inspiry_dashboard_panel',
			) );

			$wp_customize->add_setting( 'inspiry_disable_submit_property', array(
				'type'              => 'option',
				'default'           => 'true',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'inspiry_disable_submit_property', array(
				'label'   => esc_html__( 'Disable Submit Property Functionality for Users without Membership Package?', 'framework' ),
				'type'    => 'radio',
				'section' => 'inspiry_membership_section',
				'choices' => array(
					'true'  => esc_html__( 'Yes', 'framework' ),
					'false' => esc_html__( 'No', 'framework' )
				),
			) );

			$wp_customize->add_setting( 'inspiry_text_before_price', array(
				'type'              => 'option',
				'default'           => esc_html__( 'Starting at', 'framework' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'inspiry_text_before_price', array(
				'label'   => esc_html__( 'Membership Package Text Before Price', 'framework' ),
				'type'    => 'text',
				'section' => 'inspiry_membership_section',
			) );

			$wp_customize->add_setting( 'inspiry_package_btn_text', array(
				'type'              => 'option',
				'default'           => esc_html__( 'Get Started', 'framework' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'inspiry_package_btn_text', array(
				'label'   => esc_html__( 'Membership Package Button Text', 'framework' ),
				'type'    => 'text',
				'section' => 'inspiry_membership_section',
			) );

			$wp_customize->add_setting( 'inspiry_current_package_btn_text', array(
				'type'              => 'option',
				'default'           => esc_html__( 'Current Package', 'framework' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'inspiry_current_package_btn_text', array(
				'label'   => esc_html__( 'Membership Current Package Button Text', 'framework' ),
				'type'    => 'text',
				'section' => 'inspiry_membership_section',
			) );

			$wp_customize->add_setting( 'inspiry_checkout_badges_display', array(
				'type'              => 'option',
				'default'           => 'show',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'inspiry_checkout_badges_display', array(
				'label'   => esc_html__( 'Checkout Page Payment Methods Badges', 'framework' ),
				'type'    => 'radio',
				'section' => 'inspiry_membership_section',
				'choices' => array(
					'show' => esc_html__( 'Show', 'framework' ),
					'hide' => esc_html__( 'Hide', 'framework' )
				),
			) );

			$wp_customize->add_setting( 'inspiry_order_dialog_heading', array(
				'type'              => 'option',
				'default'           => esc_html__( 'Thank you!', 'framework' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'inspiry_order_dialog_heading', array(
				'label'   => esc_html__( 'Order Page Dialog Box Heading', 'framework' ),
				'type'    => 'text',
				'section' => 'inspiry_membership_section',
			) );

			$wp_customize->add_setting( 'realhomes_order_dialog_description', array(
				'type'              => 'option',
				'default'           => esc_html__( 'For payment instructions please check your email.', 'framework' ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'realhomes_order_dialog_description', array(
				'label'   => esc_html__( 'Order Page Dialog Box Description', 'framework' ),
				'type'    => 'text',
				'section' => 'inspiry_membership_section',
			) );
		}

		/**
		 * Customizer settings generated using default menu labels to get custom labels for dashboard sidebar menu.
		 * @since  4.1.0
		 */
		$menu_default_labels = realhomes_dashboard_menu_items_default_labels();
		if ( is_array( $menu_default_labels ) && ! empty( $menu_default_labels ) ) {

			$wp_customize->add_section( 'realhomes_dashboard_menu_custom_labels', array(
				'title' => esc_html__( 'Dashboard Menu Custom Labels', 'framework' ),
				'panel' => 'inspiry_dashboard_panel',
			) );

			foreach ( $menu_default_labels as $menu_item => $default_labels ) {

				if ( isset( $default_labels['0'] ) ) {
					$menu_title = $default_labels['0'];

					// Menu heading
					$heading = 'realhomes_dashboard_' . $menu_item . '_section_heading';
					$wp_customize->add_setting( $heading, array( 'sanitize_callback' => 'sanitize_text_field', ) );
					$wp_customize->add_control( new Inspiry_Heading_Customize_Control( $wp_customize, $heading,
						array(
							'label'   => $menu_title,
							'section' => 'realhomes_dashboard_menu_custom_labels',
						)
					) );

					// Menu title setting
					$menu_id = 'realhomes_dashboard_' . $menu_item . '_menu_label';
					$wp_customize->add_setting( $menu_id, array(
						'type'              => 'option',
						'default'           => $menu_title,
						'sanitize_callback' => 'sanitize_text_field',
					) );
					$wp_customize->add_control( $menu_id, array(
						'label'   => esc_html__( 'Menu Title', 'framework' ),
						'section' => 'realhomes_dashboard_menu_custom_labels',
					) );

					if ( isset( $default_labels['1'] ) ) {
						// Page title setting
						$page_id = 'realhomes_dashboard_' . $menu_item . '_page_label';
						$wp_customize->add_setting( $page_id, array(
							'type'              => 'option',
							'default'           => $default_labels['1'],
							'transport'         => 'postMessage',
							'sanitize_callback' => 'sanitize_text_field',
						) );
						$wp_customize->add_control( $page_id, array(
							'label'   => esc_html__( 'Page Title', 'framework' ),
							'section' => 'realhomes_dashboard_menu_custom_labels',
						) );
					}
				}
			}
		}

		/**
		 * Dashboard styles customizer settings.
		 * @since  3.12
		 */
		$wp_customize->add_section( 'inspiry_dashboard_styles', array(
			'title' => esc_html__( 'Styles', 'framework' ),
			'panel' => 'inspiry_dashboard_panel',
		) );

		$wp_customize->add_setting( 'realhomes_dashboard_color_scheme', array(
			'type'              => 'option',
			'default'           => 'default',
			'sanitize_callback' => 'inspiry_sanitize_select',
		) );
		$wp_customize->add_control( 'realhomes_dashboard_color_scheme', array(
			'label'   => esc_html__( 'Color Scheme', 'framework' ),
			'type'    => 'select',
			'section' => 'inspiry_dashboard_styles',
			'choices' => realhomes_dashboard_color_schemes_list(),
		) );

		$color_settings = realhomes_dashboard_color_settings();
		if ( is_array( $color_settings ) && ! empty( $color_settings ) ) {
			foreach ( $color_settings as $setting ) {
				$id = 'inspiry_dashboard_' . $setting['id'];
				$wp_customize->add_setting( $id, array(
					'type'              => 'option',
					'default'           => $setting['default'],
					'sanitize_callback' => 'sanitize_hex_color',
				) );
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id,
					array(
						'label'           => $setting['label'],
						'section'         => 'inspiry_dashboard_styles',
						'active_callback' => 'realhomes_is_dashboard_custom_color_scheme'
					)
				) );
			}
		}
	}

	add_action( 'customize_register', 'inspiry_dashboard_customizer' );
}

if ( ! function_exists( 'inspiry_dashboard_defaults' ) ) {
	/**
	 * Set default values for dashboard settings
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	function inspiry_dashboard_defaults( WP_Customize_Manager $wp_customize ) {
		$dashboard_settings_ids = array(
			'theme_restricted_level',
			'theme_submitted_status',
			'theme_submit_default_address',
			'theme_submit_default_location',
			'theme_submit_message',
			'theme_submit_notice_email',
			'theme_enable_fav_button',
			'theme_submit_button_text',
			'inspiry_guest_submission',
			'inspiry_submit_property_fields',
			'inspiry_submit_property_terms_text',
			'inspiry_updated_property_status',
			'inspiry_user_greeting_text',
			'inspiry_dashboard_page_display',
			'inspiry_my_properties_search',
			'inspiry_dashboard_posts_per_page',
			'inspiry_submit_property_module_display',
			'inspiry_dashboard_submit_page_layout',
			'inspiry_show_submit_on_login',
			'inspiry_submit_property_terms_require',
			'inspiry_submit_max_number_images',
			'inspiry_allowed_max_attachments',
			'inspiry_properties_module_display',
			'inspiry_profile_module_display',
			'inspiry_favorites_module_display',
			'inspiry_login_on_fav',
			'inspiry_user_sync',
			'inspiry_user_sync_avatar_fallback',
			'inspiry_disable_submit_property',
			'inspiry_text_before_price',
			'inspiry_package_btn_text',
			'inspiry_checkout_badges_display',
			'inspiry_order_dialog_heading',
		);
		inspiry_initialize_defaults( $wp_customize, $dashboard_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_dashboard_defaults' );
}

if ( ! function_exists( 'inspiry_is_submit_property_field_terms' ) ) {
	/**
	 * Check if terms and condidtions field is enabled on the property submit page.
	 *
	 * @return bool|int
	 */
	function inspiry_is_submit_property_field_terms() {

		$term_field_check = get_option( 'inspiry_submit_property_fields' );

		return ( false != strpos( implode( ' ', $term_field_check ), 'terms-conditions' ) ) ? true : false;
	}
}

if ( ! function_exists( 'inspiry_user_sync' ) ) {
	/**
	 * Check if User Sync function is enabled.
	 *
	 * @param object $control complete setting control.
	 *
	 * @return bool
	 */
	function inspiry_user_sync( $control ) {
		if ( 'true' === $control->manager->get_setting( 'inspiry_user_sync' )->value() ) {
			return true;
		}

		return false;
	}
}

if ( ! function_exists( 'realhomes_is_dashboard_custom_color_scheme' ) ) {
	/**
	 * Check for the dashboard custom color scheme.
	 *
	 * @since 4.0.0
	 *
	 * @return bool
	 */
	function realhomes_is_dashboard_custom_color_scheme() {

		if ( 'custom' === get_option( 'realhomes_dashboard_color_scheme', 'default' ) ) {
			return true;
		}

		return false;
	}
}