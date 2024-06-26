<?php
/**
 * Agencies Customizer Settings
 *
 * @package realhomes/customizer
 */

if ( ! function_exists( 'inspiry_agencies_customizer' ) ) :
	function inspiry_agencies_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Agencies Section
		 */
		$wp_customize->add_section( 'inspiry_agencies_pages', array(
			'title'    => esc_html__( 'Agencies Pages', 'framework' ),
			'priority' => 125,
		) );

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			/* Header Banner or None */
			$wp_customize->add_setting( 'inspiry_agencies_header_variation', array(
				'type'              => 'option',
				'default'           => 'banner',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'inspiry_agencies_header_variation', array(
				'label'       => esc_html__( 'Header Variation', 'framework' ),
				'description' => esc_html__( 'Header variation to display on agency pages.', 'framework' ),
				'type'        => 'radio',
				'section'     => 'inspiry_agencies_pages',
				'choices'     => array(
					'banner' => esc_html__( 'Banner', 'framework' ),
					'none'   => esc_html__( 'None', 'framework' ),
				),
			) );
		}

		if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {
			// Custom Agency Detail Page Template
			$wp_customize->add_setting( 'realhomes_elementor_agency_single_template', array(
				'type'              => 'option',
				'default'           => 'default',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'realhomes_elementor_agency_single_template', array(
				'label'       => esc_html__( 'Agency Single Elementor Template', 'framework' ),
				'description' => esc_html__( 'Select Agency Single Template designed using Elementor Page Builder. This option will be overridden if Elementor Pro version is being used to design Single Agency.', 'framework' ),
				'type'        => 'select',
				'section'     => 'inspiry_agencies_pages',
				'choices'     => realhomes_get_elementor_library(),
			) );

			$wp_customize->add_setting( 'realhomes_elementor_agency_archive_template', array(
				'type'              => 'option',
				'default'           => 'default',
				'sanitize_callback' => 'inspiry_sanitize_select',
			) );
			$wp_customize->add_control( 'realhomes_elementor_agency_archive_template', array(
				'label'       => esc_html__( 'Agency Archive Elementor Template', 'framework' ),
				'description' => esc_html__( 'Archive Template designed using Elementor Page Builder. This option will be overridden if Elementor Pro version is being used to design Archive.', 'framework' ),
				'type'        => 'select',
				'section'     => 'inspiry_agents_pages',
				'choices'     => realhomes_get_elementor_library(),
			) );

		}
		/* Number of Agencies  */
		$wp_customize->add_setting( 'inspiry_number_posts_agency', array(
			'type'              => 'option',
			'default'           => '3',
			'sanitize_callback' => 'inspiry_sanitize_select',
		) );
		$wp_customize->add_control( 'inspiry_number_posts_agency', array(
			'label'       => esc_html__( 'Number of Agencies', 'framework' ),
			'description' => esc_html__( 'Select the maximum number of agencies to display on an agencies list page.', 'framework' ),
			'type'        => 'select',
			'section'     => 'inspiry_agencies_pages',
			'choices'     => array(
				'1'  => 1,
				'2'  => 2,
				'3'  => 3,
				'4'  => 4,
				'5'  => 5,
				'6'  => 6,
				'7'  => 7,
				'8'  => 8,
				'9'  => 9,
				'10' => 10,
				'11' => 11,
				'12' => 12,
				'13' => 13,
				'14' => 14,
				'15' => 15,
				'16' => 16,
				'17' => 17,
				'18' => 18,
				'19' => 19,
				'20' => 20,
			),
		) );

		/* Number of Agencies  */
		$wp_customize->add_setting( 'inspiry_number_of_agents_agency', array(
			'type'              => 'option',
			'default'           => '6',
			'sanitize_callback' => 'inspiry_sanitize_select',
		) );
		$wp_customize->add_control( 'inspiry_number_of_agents_agency', array(
			'label'       => esc_html__( 'Number of Agents on Agency Detail Page', 'framework' ),
			'description' => esc_html__( 'Select the number of agents to display on agency detail page.', 'framework' ),
			'type'        => 'select',
			'section'     => 'inspiry_agencies_pages',
			'choices'     => array(
				'1'  => 1,
				'2'  => 2,
				'3'  => 3,
				'4'  => 4,
				'5'  => 5,
				'6'  => 6,
				'7'  => 7,
				'8'  => 8,
				'9'  => 9,
				'10' => 10,
				'11' => 11,
				'12' => 12,
				'13' => 13,
				'14' => 14,
				'15' => 15,
				'16' => 16,
				'17' => 17,
				'18' => 18,
				'19' => 19,
				'20' => 20,
			),
		) );
		if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {
			$wp_customize->add_setting( 'realhomes_single_agency_page_description', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'realhomes_single_agency_page_description', array(
				'label'   => esc_html__( 'Agency Single Page Description', 'framework' ),
				'type'    => 'text',
				'section' => 'inspiry_agencies_pages',
			) );
		}

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {

			$wp_customize->add_setting( 'realhomes_agency_search', array(
				'type'              => 'option',
				'default'           => 'no',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'realhomes_agency_search', array(
				'label'   => esc_html__( 'Enable Agency Search', 'framework' ),
				'type'    => 'radio',
				'section' => 'inspiry_agencies_pages',
				'choices' => array(
					'yes' => esc_html__( 'Yes', 'framework' ),
					'no'  => esc_html__( 'No', 'framework' ),
				),
			) );
			$wp_customize->add_setting( 'realhomes_agency_keyword_placeholder', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => esc_html__( 'Name/Bio', 'framework' ),
			) );
			$wp_customize->add_control( 'realhomes_agency_keyword_placeholder', array(
				'label'   => esc_html__( 'Placeholder Text for Name/Bio Field', 'framework' ),
				'type'    => 'text',
				'section' => 'inspiry_agencies_pages',
			) );
			$wp_customize->add_setting( 'realhomes_agency_locations_placeholder', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => esc_html__( 'Locations', 'framework' ),
			) );
			$wp_customize->add_control( 'realhomes_agency_locations_placeholder', array(
				'label'   => esc_html__( 'Placeholder Text for Locations Field', 'framework' ),
				'type'    => 'text',
				'section' => 'inspiry_agencies_pages',
			) );
		}

		$wp_customize->add_setting( 'inspiry_agencies_sort_controls', array(
			'type'              => 'option',
			'default'           => 'hide',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'inspiry_agencies_sort_controls', array(
			'label'   => esc_html__( 'Agencies Sort Control', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_agencies_pages',
			'choices' => array(
				'show' => esc_html__( 'Show', 'framework' ),
				'hide' => esc_html__( 'Hide', 'framework' ),
			),
		) );

		/* Agency Stats Charts on detail page */
		$wp_customize->add_setting( 'realhomes_agency_single_stats_charts', array(
			'type'              => 'option',
			'default'           => 'show',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'realhomes_agency_single_stats_charts', array(
			'label'   => esc_html__( 'Properties Stats on Detail Page', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_agencies_pages',
			'choices' => array(
				'show' => esc_html__( 'Show', 'framework' ),
				'hide' => esc_html__( 'Hide', 'framework' ),
			)
		) );

		// Agency stats charts section title
		$wp_customize->add_setting( 'realhomes_agency_stats_section_title', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => esc_html__( 'Progress & Stats', 'framework' ),
		) );
		$wp_customize->add_control( 'realhomes_agency_stats_section_title', array(
			'label'   => esc_html__( 'Agency Stats Section Title', 'framework' ),
			'type'    => 'text',
			'section' => 'inspiry_agencies_pages'
		) );

		$wp_customize->add_setting( 'inspiry_agencies_properties_count', array(
			'type'              => 'option',
			'default'           => 'hide',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'inspiry_agencies_properties_count', array(
			'label'   => esc_html__( 'Agencies Properties Count', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_agencies_pages',
			'choices' => array(
				'show' => esc_html__( 'Show', 'framework' ),
				'hide' => esc_html__( 'Hide', 'framework' ),
			),
		) );

		$wp_customize->add_setting( 'realhomes_agencies_verification_status', array(
			'type'              => 'option',
			'default'           => 'show',
			'sanitize_callback' => 'inspiry_sanitize_radio'
		) );
		$wp_customize->add_control( 'realhomes_agencies_verification_status', array(
			'label'       => esc_html__( 'Agencies Verification Status', 'framework' ),
			'description' => esc_html__( 'Show verification badge with verified agencies.', 'framework' ),
			'type'        => 'radio',
			'section'     => 'inspiry_agencies_pages',
			'choices'     => array(
				'show' => esc_html__( 'Show', 'framework' ),
				'hide' => esc_html__( 'Hide', 'framework' ),
			)
		) );

		/* Agency Ratings */
		$wp_customize->add_setting(
			'realhomes_agency_ratings', array(
				'type'              => 'option',
				'default'           => 'false',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			)
		);
		$wp_customize->add_control(
			'realhomes_agency_ratings', array(
				'label'   => esc_html__( 'Agency Ratings', 'framework' ),
				'type'    => 'radio',
				'section' => 'inspiry_agencies_pages',
				'choices' => array(
					'true'  => esc_html__( 'Enable', 'framework' ),
					'false' => esc_html__( 'Disable', 'framework' ),
				),
			)
		);

		$wp_customize->add_setting( 'theme_custom_agency_contact_form', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_custom_agency_contact_form', array(
			'label'       => esc_html__( 'Shortcode to Replace Default Agency Form', 'framework' ),
			'description' => esc_html__( 'Default agency form can be replaced with custom form using contact form 7 or WPForms plugin shortcode.', 'framework' ),
			'type'        => 'text',
			'section'     => 'inspiry_agencies_pages',
		) );

	}

	add_action( 'customize_register', 'inspiry_agencies_customizer' );
endif;


if ( ! function_exists( 'inspiry_agencies_defaults' ) ) :
	/**
	 * Set default values for agencies settings
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	function inspiry_agencies_defaults( WP_Customize_Manager $wp_customize ) {
		$agencies_settings_ids = array(
			'inspiry_agencies_header_variation',
			'inspiry_number_posts_agency',
			'inspiry_number_of_agents_agency',
		);
		inspiry_initialize_defaults( $wp_customize, $agencies_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_agencies_defaults' );
endif;
