<?php
/**
 * Agents Customizer Settings
 *
 * @package realhomes/customizer
 */

if ( ! function_exists( 'inspiry_agents_customizer' ) ) :
	function inspiry_agents_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Agents Section
		 */
		$wp_customize->add_section( 'inspiry_agents_pages', array(
			'title'    => esc_html__( 'Agents Pages', 'framework' ),
			'priority' => 125,
		) );

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			/* Header Banner or None */
			$wp_customize->add_setting( 'inspiry_agents_header_variation', array(
				'type'              => 'option',
				'default'           => 'banner',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'inspiry_agents_header_variation', array(
				'label'       => esc_html__( 'Header Variation', 'framework' ),
				'description' => esc_html__( 'Header variation to display on agent pages.', 'framework' ),
				'type'        => 'radio',
				'section'     => 'inspiry_agents_pages',
				'choices'     => array(
					'banner' => esc_html__( 'Banner', 'framework' ),
					'none'   => esc_html__( 'None', 'framework' ),
				),
			) );
		}

		/* Number of Agents  */
		$wp_customize->add_setting( 'theme_number_posts_agent', array(
			'type'              => 'option',
			'default'           => '3',
			'sanitize_callback' => 'inspiry_sanitize_select',
		) );
		$wp_customize->add_control( 'theme_number_posts_agent', array(
			'label'       => esc_html__( 'Number of Agents', 'framework' ),
			'description' => esc_html__( 'Select the maximum number of agents to display on an agents list page.', 'framework' ),
			'type'        => 'select',
			'section'     => 'inspiry_agents_pages',
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
			$wp_customize->add_setting( 'realhomes_single_agent_page_description', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'realhomes_single_agent_page_description', array(
				'label'   => esc_html__( 'Agent Single Page Description', 'framework' ),
				'type'    => 'text',
				'section' => 'inspiry_agents_pages',
			) );
			// Custom Agent Detail Page Template
			$wp_customize->add_setting( 'realhomes_elementor_agent_single_template', array(
				'type'              => 'option',
				'default'           => 'default',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'realhomes_elementor_agent_single_template', array(
				'label'       => esc_html__( 'Agent Single Elementor Template', 'framework' ),
				'description' => esc_html__( 'Select Agent Single Template designed using Elementor Page Builder. This option will be overridden if Elementor Pro version is being used to design Single Agent.', 'framework' ),
				'type'        => 'select',
				'section'     => 'inspiry_agents_pages',
				'choices'     => realhomes_get_elementor_library(),
			) );

			$wp_customize->add_setting(
				'realhomes_sample_agent_id', array(
					'type'              => 'option',
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				'realhomes_sample_agent_id', array(
					'label'       => esc_html__( 'Sample Agent ID For Elementor Editor', 'framework' ),
					'description' => esc_html__( 'Only for Elementor Editor to design Single Agent Template', 'framework' ),
					'type'        => 'text',
					'section'     => 'inspiry_agents_pages',
				)
			);

			$wp_customize->add_setting( 'realhomes_elementor_agent_archive_template', array(
				'type'              => 'option',
				'default'           => 'default',
				'sanitize_callback' => 'inspiry_sanitize_select',
			) );
			$wp_customize->add_control( 'realhomes_elementor_agent_archive_template', array(
				'label'       => esc_html__( 'Agents Archive Elementor Template', 'framework' ),
				'description' => esc_html__( 'Archive Template designed using Elementor Page Builder. This option will be overridden if Elementor Pro version is being used to design Archive.', 'framework' ),
				'type'        => 'select',
				'section'     => 'inspiry_agents_pages',
				'choices'     => realhomes_get_elementor_library(),
			) );


		}

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {

			$wp_customize->add_setting( 'realhomes_agent_search', array(
				'type'              => 'option',
				'default'           => 'no',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'realhomes_agent_search', array(
				'label'   => esc_html__( 'Enable Agent Search', 'framework' ),
				'type'    => 'radio',
				'section' => 'inspiry_agents_pages',
				'choices' => array(
					'yes' => esc_html__( 'Yes', 'framework' ),
					'no'  => esc_html__( 'No', 'framework' ),
				),
			) );

			$wp_customize->add_setting( 'realhomes_agent_keyword_placeholder', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => esc_html__( 'Name/Bio', 'framework' ),
			) );
			$wp_customize->add_control( 'realhomes_agent_keyword_placeholder', array(
				'label'   => esc_html__( 'Placeholder Text for Name/Bio Field', 'framework' ),
				'type'    => 'text',
				'section' => 'inspiry_agents_pages',
			) );
			$wp_customize->add_setting( 'realhomes_agent_number_of_properties_placeholder', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => esc_html__( 'Number Of Properties', 'framework' ),
			) );
			$wp_customize->add_control( 'realhomes_agent_number_of_properties_placeholder', array(
				'label'   => esc_html__( 'Placeholder Text for Number Of Properties Field', 'framework' ),
				'type'    => 'text',
				'section' => 'inspiry_agents_pages',
			) );
			$wp_customize->add_setting( 'realhomes_number_of_properties_values', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => '1,2,3,4,5,6,7,8,9,10',
			) );
			$wp_customize->add_control( 'realhomes_number_of_properties_values', array(
				'label'       => esc_html__( 'Number Of Properties Values', 'framework' ),
				'description' => esc_html__( 'Only provide comma separated numbers.', 'framework' ),
				'type'        => 'textarea',
				'section'     => 'inspiry_agents_pages',
			) );
			$wp_customize->add_setting( 'realhomes_agent_locations_placeholder', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => esc_html__( 'Locations', 'framework' ),
			) );
			$wp_customize->add_control( 'realhomes_agent_locations_placeholder', array(
				'label'   => esc_html__( 'Placeholder Text for Location', 'framework' ),
				'type'    => 'text',
				'section' => 'inspiry_agents_pages',
			) );
			$wp_customize->add_setting( 'realhomes_agent_verified_placeholder', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => esc_html__( 'Verified Agents', 'framework' ),
			) );
			$wp_customize->add_control( 'realhomes_agent_verified_placeholder', array(
				'label'   => esc_html__( 'Placeholder Text for Verified Agents Field', 'framework' ),
				'type'    => 'text',
				'section' => 'inspiry_agents_pages',
			) );

		}

		/* Agents Sorting */
		$wp_customize->add_setting( 'inspiry_agents_sorting', array(
			'type'              => 'option',
			'default'           => 'hide',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'inspiry_agents_sorting', array(
			'label'   => esc_html__( 'Agents Sort Control', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_agents_pages',
			'choices' => array(
				'show' => esc_html__( 'Show', 'framework' ),
				'hide' => esc_html__( 'Hide', 'framework' ),
			),
		) );

		/* Agent Stats Charts on detail page */
		$wp_customize->add_setting( 'realhomes_agent_single_stats_charts', array(
			'type'              => 'option',
			'default'           => 'show',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'realhomes_agent_single_stats_charts', array(
			'label'   => esc_html__( 'Properties Stats on Detail Page', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_agents_pages',
			'choices' => array(
				'show' => esc_html__( 'Show', 'framework' ),
				'hide' => esc_html__( 'Hide', 'framework' ),
			)
		) );

		// Agent charts section title
		$wp_customize->add_setting( 'realhomes_agent_stats_section_title', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => esc_html__( 'Progress & Stats', 'framework' ),
		) );
		$wp_customize->add_control( 'realhomes_agent_stats_section_title', array(
			'label'   => esc_html__( 'Agent Stats Section Title', 'framework' ),
			'type'    => 'text',
			'section' => 'inspiry_agents_pages',
		) );

		/* Agent Properties on Agent Single */
		$wp_customize->add_setting( 'inspiry_agent_single_properties', array(
			'type'              => 'option',
			'default'           => 'show',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'inspiry_agent_single_properties', array(
			'label'   => esc_html__( 'Properties on Agent Detail Page', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_agents_pages',
			'choices' => array(
				'show' => esc_html__( 'Show', 'framework' ),
				'hide' => esc_html__( 'Hide', 'framework' ),
			),
		) );

		/* Show/Hide Agent Listed Properties */
		$wp_customize->add_setting( 'inspiry_agent_properties_count', array(
			'type'              => 'option',
			'default'           => 'show',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'inspiry_agent_properties_count', array(
			'label'   => esc_html__( 'Agents Properties Count', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_agents_pages',
			'choices' => array(
				'show' => esc_html__( 'Show', 'framework' ),
				'hide' => esc_html__( 'Hide', 'framework' ),
			),
		) );

		/* Number of Agents  */
		$wp_customize->add_setting( 'theme_number_of_properties_agent', array(
			'type'              => 'option',
			'default'           => '6',
			'sanitize_callback' => 'inspiry_sanitize_select',
		) );
		$wp_customize->add_control( 'theme_number_of_properties_agent', array(
			'label'       => esc_html__( 'Number of Properties on Agent Detail Page', 'framework' ),
			'description' => esc_html__( 'Select the maximum number of properties to display on agent detail page.', 'framework' ),
			'type'        => 'select',
			'section'     => 'inspiry_agents_pages',
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

		$wp_customize->add_setting( 'realhomes_agents_verification_status', array(
			'type'              => 'option',
			'default'           => 'show',
			'sanitize_callback' => 'inspiry_sanitize_radio'
		) );
		$wp_customize->add_control( 'realhomes_agents_verification_status', array(
			'label'       => esc_html__( 'Agents Verification Status', 'framework' ),
			'description' => esc_html__( 'Show verification badge with verified agents.', 'framework' ),
			'type'        => 'radio',
			'section'     => 'inspiry_agents_pages',
			'choices'     => array(
				'show' => esc_html__( 'Show', 'framework' ),
				'hide' => esc_html__( 'Hide', 'framework' ),
			)
		) );

		/* Agent Ratings */
		$wp_customize->add_setting(
			'realhomes_agent_ratings', array(
				'type'              => 'option',
				'default'           => 'false',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			)
		);
		$wp_customize->add_control(
			'realhomes_agent_ratings', array(
				'label'   => esc_html__( 'Agent Ratings', 'framework' ),
				'type'    => 'radio',
				'section' => 'inspiry_agents_pages',
				'choices' => array(
					'true'  => esc_html__( 'Enable', 'framework' ),
					'false' => esc_html__( 'Disable', 'framework' ),
				),
			)
		);

		$wp_customize->add_setting( 'theme_custom_agent_contact_form', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_custom_agent_contact_form', array(
			'label'       => esc_html__( 'Shortcode to Replace Default Agent Form', 'framework' ),
			'description' => esc_html__( 'Default agent form can be replaced with custom form using contact form 7 or WPForms plugin shortcode.', 'framework' ),
			'type'        => 'text',
			'section'     => 'inspiry_agents_pages',
		) );
	}

	add_action( 'customize_register', 'inspiry_agents_customizer' );
endif;


if ( ! function_exists( 'inspiry_agents_defaults' ) ) :
	/**
	 * Set default values for agents settings
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	function inspiry_agents_defaults( WP_Customize_Manager $wp_customize ) {
		$agents_settings_ids = array(
			'inspiry_agents_header_variation',
			'theme_number_posts_agent',
			'theme_number_of_properties_agent',
		);
		inspiry_initialize_defaults( $wp_customize, $agents_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_agents_defaults' );
endif;
