<?php
if ( ! function_exists( 'ere_agent_meta_boxes' ) ) :
	/**
	 * Contains agent's meta box declaration
	 *
	 * @param $meta_boxes
	 *
	 * @return array
	 */
	function ere_agent_meta_boxes( $meta_boxes ) {

		$meta_boxes[] = array(
			'id'         => 'agent-meta-box',
			'title'      => esc_html__( 'Agent Details', 'easy-real-estate' ),
			'post_types' => array( 'agent' ),
			'context'    => 'normal',
			'priority'   => 'high',
			'tabs'       => array(
				'agent-basic'   => array(
					'label' => esc_html__( 'Basic', 'easy-real-estate' ),
					'icon'  => 'dashicons-admin-home',
				),
				'agent-contact' => array(
					'label' => esc_html__( 'Contact', 'easy-real-estate' ),
					'icon'  => 'dashicons-phone',
				),
				'agent-social'  => array(
					'label' => esc_html__( 'Social', 'easy-real-estate' ),
					'icon'  => 'dashicons-networking',
				),
			),
			'tab_style'  => 'left',
			'fields'     => array(
				array(
					'name'    => esc_html__( 'Select Agency If Any', 'easy-real-estate' ),
					'id'      => 'REAL_HOMES_agency',
					'type'    => 'select',
					'options' => ere_get_agency_array(),
					'columns' => 6,
					'tab'     => 'agent-basic',
				),
				array(
					'name'    => esc_html__( 'Mark as Verified', 'easy-real-estate' ),
					'id'      => 'ere_agent_verification_status',
					'type'    => 'radio',
					'std'     => '0',
					'options' => array(
						'1' => esc_html__( 'Yes', 'easy-real-estate' ),
						'0' => esc_html__( 'No', 'easy-real-estate' ),
					),
					'columns' => 6,
					'tab'     => 'agent-basic',
				),
				array(
					'name'    => esc_html__( 'License Number', 'easy-real-estate' ),
					'id'      => 'REAL_HOMES_license_number',
					'type'    => 'text',
					'columns' => 6,
					'tab'     => 'agent-basic',
				),
				array(
					'name'    => esc_html__( 'Shortcode to Replace Default Agent Form', 'easy-real-estate' ),
					'id'      => "REAL_HOMES_custom_agent_contact_form",
					'desc'    => esc_html__( "Default agent form can be replaced with custom form using contact form 7 or WPForms plugin shortcode.", 'easy-real-estate' ),
					'type'    => 'text',
					'columns' => 6,
					'tab'     => 'agent-basic',
				),
				array(
					'name'    => esc_html__( 'Mobile Number', 'easy-real-estate' ),
					'id'      => "REAL_HOMES_mobile_number",
					'type'    => 'text',
					'columns' => 6,
					'tab'     => 'agent-contact',
				),
				array(
					'name'    => esc_html__( 'Office Number', 'easy-real-estate' ),
					'id'      => "REAL_HOMES_office_number",
					'type'    => 'text',
					'columns' => 6,
					'tab'     => 'agent-contact',
				),
				array(
					'name'    => esc_html__( 'WhatsApp Number', 'easy-real-estate' ),
					'id'      => "REAL_HOMES_whatsapp_number",
					'type'    => 'text',
					'columns' => 6,
					'tab'     => 'agent-contact',
				),
				array(
					'name'    => esc_html__( 'Fax Number', 'easy-real-estate' ),
					'id'      => "REAL_HOMES_fax_number",
					'type'    => 'text',
					'columns' => 6,
					'tab'     => 'agent-contact',
				),
				array(
					'name'    => esc_html__( 'Website', 'easy-real-estate' ),
					'id'      => "REAL_HOMES_website",
					'type'    => 'text',
					'columns' => 6,
					'tab'     => 'agent-contact',
				),
				array(
					'name'    => esc_html__( 'Email Address', 'easy-real-estate' ),
					'id'      => "REAL_HOMES_agent_email",
					'desc'    => esc_html__( 'Messages from default agent form on property single will be sent to this address.', 'easy-real-estate' ),
					'type'    => 'text',
					'columns' => 6,
					'tab'     => 'agent-contact',
				),
				array(
					'name'    => esc_html__( 'Address', 'easy-real-estate' ),
					'id'      => "REAL_HOMES_address",
					'type'    => 'textarea',
					'columns' => 12,
					'tab'     => 'agent-contact',
				),
				array(
					'name'    => esc_html__( 'Facebook URL', 'easy-real-estate' ),
					'id'      => "REAL_HOMES_facebook_url",
					'type'    => 'text',
					'columns' => 6,
					'tab'     => 'agent-social',
				),
				array(
					'name'    => esc_html__( 'Twitter URL', 'easy-real-estate' ),
					'id'      => "REAL_HOMES_twitter_url",
					'type'    => 'text',
					'columns' => 6,
					'tab'     => 'agent-social',
				),
				array(
					'name'    => esc_html__( 'LinkedIn URL', 'easy-real-estate' ),
					'id'      => "REAL_HOMES_linked_in_url",
					'type'    => 'text',
					'columns' => 6,
					'tab'     => 'agent-social',
				),
				array(
					'name'    => esc_html__( 'Instagram URL', 'easy-real-estate' ),
					'id'      => 'inspiry_instagram_url',
					'type'    => 'text',
					'columns' => 6,
					'tab'     => 'agent-social',
				),
				array(
					'name'    => esc_html__( 'Pinterest URL', 'easy-real-estate' ),
					'id'      => 'inspiry_pinterest_url',
					'type'    => 'text',
					'columns' => 6,
					'tab'     => 'agent-social',
				),
				array(
					'name'    => esc_html__( 'Youtube URL', 'easy-real-estate' ),
					'id'      => 'inspiry_youtube_url',
					'type'    => 'text',
					'columns' => 6,
					'tab'     => 'agent-social',
				),
			),
		);

		return apply_filters( 'ere_agent_meta_boxes', $meta_boxes );

	}

	add_filter( 'rwmb_meta_boxes', 'ere_agent_meta_boxes' );

endif;


if ( ! function_exists( 'ere_agency_meta_boxes' ) ) :
	/**
	 * Contains agency's meta box declaration
	 *
	 * @param $meta_boxes
	 *
	 * @return array
	 */
	function ere_agency_meta_boxes( $meta_boxes ) {

		$meta_boxes[] = array(
			'id'         => 'agency-meta-box',
			'title'      => esc_html__( 'Provide Related Information', 'easy-real-estate' ),
			'post_types' => array( 'agency' ),
			'context'    => 'normal',
			'priority'   => 'high',
			'tabs'       => array(
				'agency-basic'   => array(
					'label' => esc_html__( 'Basic', 'easy-real-estate' ),
					'icon'  => 'dashicons-admin-home',
				),
				'agency-contact' => array(
					'label' => esc_html__( 'Contact', 'easy-real-estate' ),
					'icon'  => 'dashicons-phone',
				),
				'agency-social'  => array(
					'label' => esc_html__( 'Social', 'easy-real-estate' ),
					'icon'  => 'dashicons-networking',
				),
			),
			'tab_style'  => 'left',
			'fields'     => array(
				array(
					'name'    => esc_html__( 'Shortcode to Replace Default Agency Form', 'easy-real-estate' ),
					'id'      => "REAL_HOMES_custom_agency_contact_form",
					'desc'    => esc_html__( "Default agency form can be replaced with custom form using contact form 7 or WPForms plugin shortcode.", 'easy-real-estate' ),
					'type'    => 'text',
					'columns' => 6,
					'tab'     => 'agency-basic',
				),
				array(
					'name'    => esc_html__( 'Mark as Verified', 'easy-real-estate' ),
					'id'      => 'ere_agency_verification_status',
					'type'    => 'radio',
					'std'     => '0',
					'options' => array(
						'1' => esc_html__( 'Yes', 'easy-real-estate' ),
						'0' => esc_html__( 'No', 'easy-real-estate' ),
					),
					'columns' => 6,
					'tab'     => 'agency-basic',
				),
				array(
					'name'    => esc_html__( 'Mobile Number', 'easy-real-estate' ),
					'id'      => "REAL_HOMES_mobile_number",
					'type'    => 'text',
					'columns' => 6,
					'tab'     => 'agency-contact',
				),
				array(
					'name'    => esc_html__( 'Office Number', 'easy-real-estate' ),
					'id'      => "REAL_HOMES_office_number",
					'type'    => 'text',
					'columns' => 6,
					'tab'     => 'agency-contact',
				),
				array(
					'name'    => esc_html__( 'WhatsApp Number', 'easy-real-estate' ),
					'id'      => "REAL_HOMES_whatsapp_number",
					'type'    => 'text',
					'columns' => 6,
					'tab'     => 'agency-contact',
				),
				array(
					'name'    => esc_html__( 'Fax Number', 'easy-real-estate' ),
					'id'      => "REAL_HOMES_fax_number",
					'type'    => 'text',
					'columns' => 6,
					'tab'     => 'agency-contact',
				),
				array(
					'name'    => esc_html__( 'Website', 'easy-real-estate' ),
					'id'      => "REAL_HOMES_website",
					'type'    => 'text',
					'columns' => 6,
					'tab'     => 'agency-contact',
				),
				array(
					'name'    => esc_html__( 'Email Address', 'easy-real-estate' ),
					'id'      => "REAL_HOMES_agency_email",
					'desc'    => esc_html__( 'Messages from default agency form will be sent to this address.', 'easy-real-estate' ),
					'type'    => 'text',
					'columns' => 6,
					'tab'     => 'agency-contact',
				),
				array(
					'name'    => esc_html__( 'Address', 'easy-real-estate' ),
					'id'      => "REAL_HOMES_address",
					'type'    => 'textarea',
					'columns' => 12,
					'tab'     => 'agency-contact',
				),

				array(
					'name'    => esc_html__( 'Facebook URL', 'easy-real-estate' ),
					'id'      => "REAL_HOMES_facebook_url",
					'type'    => 'text',
					'columns' => 6,
					'tab'     => 'agency-social',
				),
				array(
					'name'    => esc_html__( 'Twitter URL', 'easy-real-estate' ),
					'id'      => "REAL_HOMES_twitter_url",
					'type'    => 'text',
					'columns' => 6,
					'tab'     => 'agency-social',
				),
				array(
					'name'    => esc_html__( 'LinkedIn URL', 'easy-real-estate' ),
					'id'      => "REAL_HOMES_linked_in_url",
					'type'    => 'text',
					'columns' => 6,
					'tab'     => 'agency-social',
				),
				array(
					'name'    => esc_html__( 'Instagram URL', 'easy-real-estate' ),
					'id'      => 'inspiry_instagram_url',
					'type'    => 'text',
					'columns' => 6,
					'tab'     => 'agency-social',
				),
				array(
					'name'    => esc_html__( 'Pinterest URL', 'easy-real-estate' ),
					'id'      => 'inspiry_pinterest_url',
					'type'    => 'text',
					'columns' => 6,
					'tab'     => 'agency-social',
				),
				array(
					'name'    => esc_html__( 'Youtube URL', 'easy-real-estate' ),
					'id'      => 'inspiry_youtube_url',
					'type'    => 'text',
					'columns' => 6,
					'tab'     => 'agency-social',
				),
			),
		);

		return apply_filters( 'ere_agency_meta_boxes', $meta_boxes );

	}

	add_filter( 'rwmb_meta_boxes', 'ere_agency_meta_boxes' );

endif;