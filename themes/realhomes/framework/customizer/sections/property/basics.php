<?php
/**
 * Section: `Basics`
 * Panel:   `Property Detail Page`
 *
 * @since   2.6.3
 * @package realhomes/customizer
 */

if ( ! function_exists( 'inspiry_property_basics_customizer' ) ) :

	/**
	 * inspiry_property_basics_customizer.
	 *
	 * @since  2.6.3
	 *
	 * @param WP_Customize_Manager $wp_customize
	 *
	 */
	function inspiry_property_basics_customizer( WP_Customize_Manager $wp_customize ) {

		// Basics Section
		$wp_customize->add_section(
			'inspiry_property_basics', array(
				'title'    => esc_html__( 'Basics', 'framework' ),
				'panel'    => 'inspiry_property_panel',
				'priority' => 2
			)
		);

        if ( class_exists( 'RHEA_Elementor_Header_Footer' ) ) {
            $wp_customize->add_setting( 'realhomes_custom_header_property_single', array(
                'sanitize_callback' => 'inspiry_sanitize_select',
                'type'              => 'option',
                'default'           => 'default',
            ) );
            $wp_customize->add_control( 'realhomes_custom_header_property_single', array(
                'settings' => 'realhomes_custom_header_property_single',
                'label'    => esc_html__( 'Custom Header Template', 'framework' ),
                'type'     => 'select',
                'section'  => 'inspiry_property_basics',
                'choices'  => realhomes_get_elementor_library(),
            ) );

            $wp_customize->add_setting( 'realhomes_custom_responsive_header_property_single', array(
                'sanitize_callback' => 'inspiry_sanitize_select',
                'type'              => 'option',
                'default'           => 'default',
            ) );
            $wp_customize->add_control( 'realhomes_custom_responsive_header_property_single', array(
                'settings'        => 'realhomes_custom_responsive_header_property_single',
                'label'           => esc_html__( 'Custom Mobile Header Template', 'framework' ),
                'type'            => 'select',
                'section'         => 'inspiry_property_basics',
                'choices' => array(
                    'default' => esc_html__( 'Default', 'framework' ),
                    'custom'  => esc_html__( 'Custom Elementor', 'framework' ),
                ),
                'active_callback' => 'realhomes_is_property_custom_header'
            ) );

            $wp_customize->add_setting( 'realhomes_custom_header_position_property', array(
                'type'              => 'option',
                'default'           => 'relative',
                'sanitize_callback' => 'inspiry_sanitize_radio'
            ) );
            $wp_customize->add_control( 'realhomes_custom_header_position_property', array(
                'label'           => esc_html__( 'Custom Header Position', 'framework' ),
                'type'            => 'radio',
                'section'         => 'inspiry_property_basics',
                'choices'         => array(
                    'relative' => esc_html__( 'Relative', 'framework' ),
                    'absolute' => esc_html__( 'Absolute', 'framework' ),
                ),
                'active_callback' => 'realhomes_is_property_custom_header'
            ) );

        }

		if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {
			// Custom Property Detail Page Template
			$wp_customize->add_setting( 'realhomes_elementor_property_single_template', array(
				'type'              => 'option',
				'default'           => 'default',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'realhomes_elementor_property_single_template', array(
				'label'       => esc_html__( 'Elementor Single Property Template', 'framework' ),
				'description' => esc_html__( 'Select Single Property Template designed using Elementor Page Builder. This option will be overridden if Elementor Pro version is being used to design Single Property.', 'framework' ),
				'type'        => 'select',
				'section'     => 'inspiry_property_basics',
				'choices'     => realhomes_get_elementor_library(),
			) );

			$wp_customize->add_setting(
				'realhomes_sample_property_id', array(
					'type'              => 'option',
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				'realhomes_sample_property_id', array(
					'label'       => esc_html__( 'Sample Property ID For Elementor Editor', 'framework' ),
					'description' => esc_html__( 'Only for Elementor Editor to design Single Property Template', 'framework' ),
					'type'        => 'text',
					'section'     => 'inspiry_property_basics',
				)
			);

		}

		// Property Detail Page Template
		$wp_customize->add_setting( 'inspiry_property_single_template', array(
			'type'              => 'option',
			'default'           => 'sidebar',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'inspiry_property_single_template', array(
			'label'       => esc_html__( 'Page Template for All Properties', 'framework' ),
			'description' => esc_html__( 'You can override this for a specific property using template in page attributes metabox.', 'framework' ),
			'type'        => 'radio',
			'section'     => 'inspiry_property_basics',
			'choices'     => array(
				'sidebar'   => esc_html__( 'Sidebar Template', 'framework' ),
				'fullwidth' => esc_html__( 'Full Width Template', 'framework' ),
			),
		) );

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {

			// Single Property Layout
			$wp_customize->add_setting( 'realhomes_single_property_variation', array(
				'type'              => 'option',
				'default'           => 'default',
				'sanitize_callback' => 'inspiry_sanitize_select',
			) );
			$wp_customize->add_control( 'realhomes_single_property_variation', array(
				'label'   => esc_html__( 'Single Property Variation', 'framework' ),
				'type'    => 'select',
				'section' => 'inspiry_property_basics',
				'choices' => array(
					'default'           => esc_html__( 'Default', 'framework' ),
					'gallery-fullwidth' => esc_html__( 'Gallery Full Width', 'framework' ),
				),
			) );

			// Property Content Layout
			$wp_customize->add_setting( 'realhomes_single_property_content_layout', array(
				'type'              => 'option',
				'default'           => 'default',
				'sanitize_callback' => 'inspiry_sanitize_select',
			) );
			$wp_customize->add_control( 'realhomes_single_property_content_layout', array(
				'label'   => esc_html__( 'Content Layout', 'framework' ),
				'type'    => 'select',
				'section' => 'inspiry_property_basics',
				'choices' => array(
					'default'         => esc_html__( 'Default', 'framework' ),
					'horizontal-tabs' => esc_html__( 'Horizontal Tabs', 'framework' ),
					'vertical-tabs'   => esc_html__( 'Vertical Tabs', 'framework' ),
					'accordion'       => esc_html__( 'Accordion', 'framework' ),
					'toggle'          => esc_html__( 'Toggle', 'framework' ),
					'isolated'        => esc_html__( 'Isolated Sections', 'framework' ),
				),
			) );

			// Property Content Section's Style
			$wp_customize->add_setting( 'realhomes_single_property_section_style', array(
				'type'              => 'option',
				'default'           => 'default',
				'sanitize_callback' => 'inspiry_sanitize_select',
			) );
			$wp_customize->add_control( 'realhomes_single_property_section_style', array(
				'label'           => esc_html__( 'Sections Style', 'framework' ),
				'type'            => 'select',
				'section'         => 'inspiry_property_basics',
				'choices'         => array(
					'default'  => esc_html__( 'Default', 'framework' ),
					'isolated' => esc_html__( 'Isolated Sections', 'framework' ),
				),
				'active_callback' => function () {
					return ( 'horizontal-tabs' === get_option( 'realhomes_single_property_content_layout', 'default' ) );
				},
			) );
		}

		// Require Login to Display Property Detail
		$wp_customize->add_setting(
			'inspiry_prop_detail_login', array(
				'type'              => 'option',
				'default'           => 'no',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			)
		);
		$wp_customize->add_control(
			'inspiry_prop_detail_login', array(
				'label'   => esc_html__( 'Require Login to Display Property Detail', 'framework' ),
				'type'    => 'radio',
				'section' => 'inspiry_property_basics',
				'choices' => array(
					'yes' => esc_html__( 'Yes', 'framework' ),
					'no'  => esc_html__( 'No', 'framework' ),
				),
			)
		);

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			/* Header Variation */
			$wp_customize->add_setting(
				'inspiry_property_detail_header_variation', array(
					'type'              => 'option',
					'default'           => 'banner',
					'sanitize_callback' => 'inspiry_sanitize_radio',
				)
			);

			$wp_customize->add_control(
				'inspiry_property_detail_header_variation', array(
					'label'       => esc_html__( 'Header Variation', 'framework' ),
					'description' => esc_html__( 'Header variation to display on Property Detail Page.', 'framework' ),
					'type'        => 'radio',
					'section'     => 'inspiry_property_basics',
					'choices'     => array(
						'banner' => esc_html__( 'Banner', 'framework' ),
						'none'   => esc_html__( 'None', 'framework' ),
					),
				)
			);
		}

		/* Property Ratings */
		$wp_customize->add_setting(
			'inspiry_property_ratings', array(
				'type'              => 'option',
				'default'           => 'false',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			)
		);
		$wp_customize->add_control(
			'inspiry_property_ratings', array(
				'label'   => esc_html__( 'Property Ratings', 'framework' ),
				'type'    => 'radio',
				'section' => 'inspiry_property_basics',
				'choices' => array(
					'true'  => esc_html__( 'Enable', 'framework' ),
					'false' => esc_html__( 'Disable', 'framework' ),
				),
			)
		);

		/* Display Property Address */
		$wp_customize->add_setting(
			'inspiry_display_property_address', array(
				'type'              => 'option',
				'default'           => 'true',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			)
		);
		$wp_customize->add_control(
			'inspiry_display_property_address', array(
				'label'   => esc_html__( 'Property Address', 'framework' ),
				'type'    => 'radio',
				'section' => 'inspiry_property_basics',
				'choices' => array(
					'true'  => esc_html__( 'Show', 'framework' ),
					'false' => esc_html__( 'Hide', 'framework' ),
				),
			)
		);

		/* Separator */
		$wp_customize->add_setting( 'inspiry_property_field_titles_separator', array( 'sanitize_callback' => 'sanitize_text_field', ) );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_property_field_titles_separator',
				array(
					'section' => 'inspiry_property_basics',
				)
			)
		);


		/* Property ID Field Title  */
		if ( 'modern' === INSPIRY_DESIGN_VARIATION || 'ultra' === INSPIRY_DESIGN_VARIATION ) {
			$wp_customize->add_setting(
				'inspiry_prop_id_field_label', array(
					'type'              => 'option',
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				'inspiry_prop_id_field_label', array(
					'label'       => esc_html__( 'Property ID Label', 'framework' ),
					'description' => esc_html__( 'This will overwrite the Property ID label.', 'framework' ),
					'type'        => 'text',
					'section'     => 'inspiry_property_basics',
				)
			);
		}

		/* Bedrooms Field Title  */
		$wp_customize->add_setting(
			'inspiry_bedrooms_field_label', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'inspiry_bedrooms_field_label', array(
				'label'       => esc_html__( 'Bedrooms field label', 'framework' ),
				'description' => esc_html__( 'This will overwrite the bedrooms field label.', 'framework' ),
				'type'        => 'text',
				'section'     => 'inspiry_property_basics',
			)
		);

		/* Bathrooms Field Title  */
		$wp_customize->add_setting(
			'inspiry_bathrooms_field_label', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'inspiry_bathrooms_field_label', array(
				'label'       => esc_html__( 'Bathrooms field label', 'framework' ),
				'description' => esc_html__( 'This will overwrite the bathrooms field label.', 'framework' ),
				'type'        => 'text',
				'section'     => 'inspiry_property_basics',
			)
		);


		if ( inspiry_is_rvr_enabled() ) {

			$wp_customize->add_setting(
				'inspiry_rvr_min_stay_label', array(
					'type'              => 'option',
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				'inspiry_rvr_min_stay_label', array(
					'label'       => esc_html__( 'Minimum Stay', 'framework' ),
					'description' => esc_html__( 'This will overwrite the minimum stay field label.', 'framework' ),
					'type'        => 'text',
					'section'     => 'inspiry_property_basics',
				)
			);

			$wp_customize->add_setting(
				'inspiry_rvr_guests_field_label', array(
					'type'              => 'option',
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				'inspiry_rvr_guests_field_label', array(
					'label'       => esc_html__( 'Guests Capacity', 'framework' ),
					'description' => esc_html__( 'This will overwrite the guests capacity field label.', 'framework' ),
					'type'        => 'text',
					'section'     => 'inspiry_property_basics',
				)
			);
		}


		/* Garages Field Title  */
		$wp_customize->add_setting(
			'inspiry_garages_field_label', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'inspiry_garages_field_label', array(
				'label'       => esc_html__( 'Garages field label', 'framework' ),
				'description' => esc_html__( 'This will overwrite the garages field label.', 'framework' ),
				'type'        => 'text',
				'section'     => 'inspiry_property_basics',
			)
		);

		/* Area Field Title  */
		$wp_customize->add_setting(
			'inspiry_area_field_label', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'inspiry_area_field_label', array(
				'label'       => esc_html__( 'Area field label', 'framework' ),
				'description' => esc_html__( 'This will overwrite the area field label.', 'framework' ),
				'type'        => 'text',
				'section'     => 'inspiry_property_basics',
			)
		);

		/* Year Built Field Title  */
		$wp_customize->add_setting(
			'inspiry_year_built_field_label', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'inspiry_year_built_field_label', array(
				'label'       => esc_html__( 'Year Built field label', 'framework' ),
				'description' => esc_html__( 'This will overwrite the year-built field label.', 'framework' ),
				'type'        => 'text',
				'section'     => 'inspiry_property_basics',
			)
		);

		/* Lot Size Field Title  */
		$wp_customize->add_setting(
			'inspiry_lot_size_field_label', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'inspiry_lot_size_field_label', array(
				'label'       => esc_html__( 'Lot Size field label', 'framework' ),
				'description' => esc_html__( 'This will overwrite the lot-size field label.', 'framework' ),
				'type'        => 'text',
				'section'     => 'inspiry_property_basics',
			)
		);

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			/* Separator */
			$wp_customize->add_setting( 'inspiry_property_share_titles_separator', array( 'sanitize_callback' => 'sanitize_text_field', ) );
			$wp_customize->add_control(
				new Inspiry_Separator_Control(
					$wp_customize,
					'inspiry_property_share_titles_separator',
					array(
						'section' => 'inspiry_property_basics',
					)
				)
			);

			$wp_customize->add_setting(
				'inspiry_share_property_label', array(
					'type'              => 'option',
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				'inspiry_share_property_label', array(
					'label'       => esc_html__( 'Share Label', 'framework' ),
					'description' => esc_html__( 'This will overwrite the share label.', 'framework' ),
					'type'        => 'text',
					'section'     => 'inspiry_property_basics',
				)
			);

			$wp_customize->add_setting(
				'inspiry_add_to_fav_property_label', array(
					'type'              => 'option',
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				'inspiry_add_to_fav_property_label', array(
					'label'       => esc_html__( 'Favourite Label', 'framework' ),
					'description' => esc_html__( 'This will overwrite the Favourite label.', 'framework' ),
					'type'        => 'text',
					'section'     => 'inspiry_property_basics',
				)
			);
			$wp_customize->add_setting(
				'inspiry_added_to_fav_property_label', array(
					'type'              => 'option',
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				'inspiry_added_to_fav_property_label', array(
					'label'       => esc_html__( 'Added To Favourite Label', 'framework' ),
					'description' => esc_html__( 'This will overwrite the Added To Favourite label.', 'framework' ),
					'type'        => 'text',
					'section'     => 'inspiry_property_basics',
				)
			);
			$wp_customize->add_setting(
				'inspiry_print_property_label', array(
					'type'              => 'option',
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				'inspiry_print_property_label', array(
					'label'       => esc_html__( 'Print Label', 'framework' ),
					'description' => esc_html__( 'This will overwrite the Print label.', 'framework' ),
					'type'        => 'text',
					'section'     => 'inspiry_property_basics',
				)
			);

		}

		/* Separator */
		$wp_customize->add_setting( 'theme_additional_details_title_separator', array( 'sanitize_callback' => 'sanitize_text_field', ) );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'theme_additional_details_title_separator',
				array(
					'section' => 'inspiry_property_basics',
				)
			)
		);

		if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {
			$wp_customize->add_setting(
				'inspiry_overview_property_label', array(
					'type'              => 'option',
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				'inspiry_overview_property_label', array(
					'label'       => esc_html__( 'Overview', 'framework' ),
					'description' => esc_html__( 'This will overwrite the Overview title.', 'framework' ),
					'type'        => 'text',
					'section'     => 'inspiry_property_basics',
				)
			);
		}


		if ( 'modern' === INSPIRY_DESIGN_VARIATION || 'ultra' === INSPIRY_DESIGN_VARIATION ) {
			$wp_customize->add_setting(
				'inspiry_description_property_label', array(
					'type'              => 'option',
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				'inspiry_description_property_label', array(
					'label'       => esc_html__( 'Description Title', 'framework' ),
					'description' => esc_html__( 'This will overwrite the Description title.', 'framework' ),
					'type'        => 'text',
					'section'     => 'inspiry_property_basics',
				)
			);
		}


		/* Additional Detail Title  */
		$wp_customize->add_setting(
			'theme_additional_details_title', array(
				'type'              => 'option',
				'transport'         => 'postMessage',
				'default'           => esc_html__( 'Additional Details', 'framework' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'theme_additional_details_title', array(
				'label'       => esc_html__( 'Additional Details Title', 'framework' ),
				'description' => esc_html__( 'This will only display if a property has additional details.', 'framework' ),
				'type'        => 'text',
				'section'     => 'inspiry_property_basics',
			)
		);

		if ( 'classic' !== INSPIRY_DESIGN_VARIATION ) {
			if ( isset( $wp_customize->selective_refresh ) ) {
				$wp_customize->selective_refresh->add_partial(
					'theme_additional_details_title', array(
						'selector'            => '.rh_property__additional_details',
						'container_inclusive' => false,
						'render_callback'     => 'theme_additional_details_title_render',
					)
				);
			}
		}

		/* Features Title  */
		$wp_customize->add_setting(
			'theme_property_features_title', array(
				'type'              => 'option',
				'transport'         => 'postMessage',
				'default'           => esc_html__( 'Features', 'framework' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'theme_property_features_title', array(
				'label'   => esc_html__( 'Features Title', 'framework' ),
				'type'    => 'text',
				'section' => 'inspiry_property_basics',
			)
		);

		/* Features Items Display  */
		$wp_customize->add_setting( 'inspiry_property_features_display', array(
				'type'              => 'option',
				'default'           => 'link',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			)
		);
		$wp_customize->add_control( 'inspiry_property_features_display', array(
				'label'   => esc_html__( 'Property Features Display', 'framework' ),
				'type'    => 'radio',
				'section' => 'inspiry_property_basics',
				'choices' => array(
					'link'  => esc_html__( 'Link to Archive', 'framework' ),
					'plain' => esc_html__( 'Plain Text', 'framework' ),
				),
			)
		);

		if ( 'classic' !== INSPIRY_DESIGN_VARIATION ) {
			if ( isset( $wp_customize->selective_refresh ) ) {
				$wp_customize->selective_refresh->add_partial(
					'theme_property_features_title', array(
						'selector'            => '.rh_property__features_wrap .rh_property__heading',
						'container_inclusive' => false,
						'render_callback'     => 'theme_property_features_title_render',
					)
				);
			}
		}

		/* Add/Remove  Open Graph Meta Tags */
		$wp_customize->add_setting(
			'theme_add_meta_tags', array(
				'type'              => 'option',
				'default'           => 'false',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			)
		);
		$wp_customize->add_control(
			'theme_add_meta_tags', array(
				'label'   => esc_html__( 'Open Graph Meta Tags', 'framework' ),
				'type'    => 'radio',
				'section' => 'inspiry_property_basics',
				'choices' => array(
					'true'  => esc_html__( 'Enable', 'framework' ),
					'false' => esc_html__( 'Disable', 'framework' ),
				),
			)
		);

		/* Link to Previous and Next Property */
		$wp_customize->add_setting(
			'inspiry_property_prev_next_link', array(
				'type'              => 'option',
				'default'           => 'true',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			)
		);
		$wp_customize->add_control(
			'inspiry_property_prev_next_link', array(
				'label'   => esc_html__( 'Link to Previous and Next Property', 'framework' ),
				'type'    => 'radio',
				'section' => 'inspiry_property_basics',
				'choices' => array(
					'true'  => esc_html__( 'Enable', 'framework' ),
					'false' => esc_html__( 'Disable', 'framework' ),
				),
			)
		);
	}

	add_action( 'customize_register', 'inspiry_property_basics_customizer' );
endif;


if ( ! function_exists( 'inspiry_property_basics_defaults' ) ) :

	/**
	 * inspiry_property_basics_defaults.
	 *
	 * @since  2.6.3
	 */
	function inspiry_property_basics_defaults( WP_Customize_Manager $wp_customize ) {
		$property_basics_settings_ids = array(
			'inspiry_property_single_template',
			'inspiry_property_detail_header_variation',
			'theme_additional_details_title',
			'theme_property_features_title',
			'theme_add_meta_tags',
			'inspiry_property_prev_next_link',
			'inspiry_property_ratings',
		);
		inspiry_initialize_defaults( $wp_customize, $property_basics_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_property_basics_defaults' );
endif;

if ( ! function_exists( 'theme_additional_details_title_render' ) ) {

	/**
	 * Partial Refresh Render
	 *
	 * @since  3.0.0
	 */
	function theme_additional_details_title_render() {
		if ( get_option( 'theme_additional_details_title' ) ) {
			echo esc_html( get_option( 'theme_additional_details_title' ) );
		}
	}
}

if ( ! function_exists( 'theme_property_features_title_render' ) ) {

	/**
	 * Partial Refresh Render
	 *
	 * @since  3.0.0
	 */
	function theme_property_features_title_render() {
		if ( get_option( 'theme_property_features_title' ) ) {
			echo esc_html( get_option( 'theme_property_features_title' ) );
		}
	}
}

if ( ! function_exists( 'realhomes_is_property_custom_header' ) ) {
    /**
     * Check if custom header is set for the property
     *
     * @since RealHomes 4.3.0
     *
     * @return bool
     */
    function realhomes_is_property_custom_header() {
        if ( class_exists( 'RHEA_Elementor_Header_Footer' ) ) {
            $realhomes_custom_header = get_option('realhomes_custom_header_property_single');
            if ( $realhomes_custom_header && 'default' !== $realhomes_custom_header ) {
                return true;
            }
        }

        return false;
    }
}