<?php
/**
 * Section: `Search Form Basics`
 * Panel:   `Properties Search`
 *
 * @since   2.6.3
 * @package realhomes/customizer
 */

if ( ! function_exists( 'inspiry_search_form_basics_customizer' ) ) :

	/**
	 * Search Form Basic Customizer Settings.
	 *
	 * @since  2.6.3
	 *
	 * @param WP_Customize_Manager $wp_customize - Instance of WP_Customize_Manager.
	 *
	 */
	function inspiry_search_form_basics_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Search Form Basics
		 */
		$wp_customize->add_section(
			'inspiry_properties_search_form', array(
				'title' => esc_html__( 'Search Form Basics', 'framework' ),
				'panel' => 'inspiry_properties_search_panel',
			)
		);

		if ( class_exists( 'RHEA_Elementor_Search_Form' ) ) {
			$wp_customize->add_setting( 'realhomes_custom_search_form', array(
				'sanitize_callback' => 'inspiry_sanitize_select',
				'type'              => 'option',
				'default'           => 'default',
			) );
			$wp_customize->add_control( 'realhomes_custom_search_form', array(
				'settings'    => 'realhomes_custom_search_form',
				'label'       => esc_html__( 'Custom Search Form Template', 'framework' ),
				'description' => esc_html__( 'Select Search Form template that has been created using Elementor page builder', 'framework' ),
				'type'        => 'select',
				'section'     => 'inspiry_properties_search_form',
				'choices'     => realhomes_get_elementor_library(),
			) );

			if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {

				$search_form_locations = array(
					'home'           => esc_html__( 'Home', 'framework' ),
					'search'         => esc_html__( 'Properties Search', 'framework' ),
					'half-map'       => esc_html__( 'Half Map Listings', 'framework' ),
					'properties'     => esc_html__( 'Properties Listings', 'framework' ),
					'property'       => esc_html__( 'Single Property', 'framework' ),
					'blog'           => esc_html__( 'Blog', 'framework' ),
					'post'           => esc_html__( 'Single Post', 'framework' ),
					'gallery'        => esc_html__( 'Gallery', 'framework' ),
					'agents'         => esc_html__( 'Agents', 'framework' ),
					'agent'          => esc_html__( 'Single Agent', 'framework' ),
					'agencies'       => esc_html__( 'Agencies', 'framework' ),
					'agency'         => esc_html__( 'Single Agency', 'framework' ),
					'compare'        => esc_html__( 'Compare', 'framework' ),
					'contact'        => esc_html__( 'Contact', 'framework' ),
					'login-register' => esc_html__( 'Login & Register', 'framework' ),
					'user-list'      => esc_html__( 'User List', 'framework' ),
				);

				$wp_customize->add_setting(
					'search_form_locations',
					array(
						'type'              => 'option',
						'transport'         => 'refresh',
						'sanitize_callback' => 'inspiry_sanitize_multiple_checkboxes',
					)
				);
				$wp_customize->add_control(
					new Inspiry_Multiple_Checkbox_Customize_Control(
						$wp_customize,
						'search_form_locations',
						array(
							'section'         => 'inspiry_properties_search_form',
							'label'           => esc_html__( 'Hide search form on locations below', 'framework' ),
							'description'     => esc_html__( 'Note: Search form can be added through Page MetaBox settings', 'framework' ),
							'choices'         => $search_form_locations,
							'active_callback' => 'realhomes_custom_search_form_not_default',
						)
					)
				);

				$wp_customize->add_setting( 'realhomes_custom_search_form_max_width', array(
					'sanitize_callback' => 'sanitize_text_field',
					'type'              => 'option',
				) );
				$wp_customize->add_control( 'realhomes_custom_search_form_max_width', array(
					'settings'        => 'realhomes_custom_search_form_max_width',
					'label'           => esc_html__( 'Search Form Max Width', 'framework' ),
					'description'     => esc_html__( 'Example: 1320px', 'framework' ),
					'type'            => 'text',
					'section'         => 'inspiry_properties_search_form',
					'active_callback' => 'realhomes_custom_search_form_not_default',

				) );

			}
			$wp_customize->add_setting( 'realhomes_custom_search_form_margin_top', array(
				'sanitize_callback' => 'sanitize_text_field',
				'type'              => 'option',
			) );
			$wp_customize->add_control( 'realhomes_custom_search_form_margin_top', array(
				'settings'        => 'realhomes_custom_search_form_margin_top',
				'label'           => esc_html__( 'Search Form Margin Top', 'framework' ),
				'description'     => esc_html__( 'Example: 50px,50%', 'framework' ),
				'type'            => 'text',
				'section'         => 'inspiry_properties_search_form',
				'active_callback' => 'realhomes_custom_search_form_not_default',

			) );
			$wp_customize->add_setting( 'realhomes_custom_search_form_margin_bottom', array(
				'sanitize_callback' => 'sanitize_text_field',
				'type'              => 'option',
			) );
			$wp_customize->add_control( 'realhomes_custom_search_form_margin_bottom', array(
				'settings'        => 'realhomes_custom_search_form_margin_bottom',
				'label'           => esc_html__( 'Search Form Margin Bottom', 'framework' ),
				'description'     => esc_html__( 'Example: 50px,50%', 'framework' ),
				'type'            => 'text',
				'section'         => 'inspiry_properties_search_form',
				'active_callback' => 'realhomes_custom_search_form_not_default',

			) );

		}


		if ( ! inspiry_is_rvr_enabled() && 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$wp_customize->add_setting(
				'inspiry_search_form_mod_layout_options', array(
					'type'              => 'option',
					'default'           => 'default',
					'sanitize_callback' => 'inspiry_sanitize_radio',
				)
			);

			$wp_customize->add_control( 'inspiry_search_form_mod_layout_options', array(
				'label'           => esc_html__( 'Search Form Layout ', 'framework' ),
				'description'     => esc_html__( 'Not applicable for Search Form Over Image ', 'framework' ),
				'type'            => 'radio',
				'section'         => 'inspiry_properties_search_form',
				'choices'         => array(
					'default' => esc_html__( 'Default', 'framework' ),
					'smart'   => esc_html__( 'Smart', 'framework' ),
				),
				'active_callback' => 'realhomes_custom_search_form_is_default',
			) );


		}


		/* Search Form Title */
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$wp_customize->add_setting(
				'theme_home_advance_search_title', array(
					'type'              => 'option',
					'transport'         => 'postMessage',
					'sanitize_callback' => 'sanitize_text_field',
					'default'           => esc_html__( 'Find Your Home', 'framework' ),
				)
			);
			$wp_customize->add_control(
				'theme_home_advance_search_title', array(
					'label'           => esc_html__( 'Search Form Title', 'framework' ),
					'type'            => 'text',
					'section'         => 'inspiry_properties_search_form',
					'active_callback' => 'realhomes_custom_search_form_is_default',
				)
			);
		}

		/* Search Form Title Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial(
				'theme_home_advance_search_title', array(
					'selector'            => '.search-heading',
					'container_inclusive' => false,
					'render_callback'     => 'inspiry_home_advance_search_title_render',
				)
			);
		}

		if ( 'ultra' !== INSPIRY_DESIGN_VARIATION ) {

			/* Search Fields */
			$get_stored_order = get_option( 'theme_search_fields' );

			if ( inspiry_is_rvr_enabled() ) {
				$search_fields = array(
					'location'     => esc_html__( 'Property Location', 'framework' ),
					'check-in-out' => esc_html__( 'Check In & Check Out' ),
					'guest'        => esc_html__( 'Guests', 'framework' ),
				);
			} else {

				$search_fields = array(
					'keyword-search'   => esc_html__( 'Keyword Search', 'framework' ),
					'property-id'      => esc_html__( 'Property ID', 'framework' ),
					'location'         => esc_html__( 'Property Location', 'framework' ),
					'status'           => esc_html__( 'Property Status', 'framework' ),
					'type'             => esc_html__( 'Property Type', 'framework' ),
					'agency'           => esc_html__( 'Agency', 'framework' ),
					'agent'            => esc_html__( 'Agent', 'framework' ),
					'min-beds'         => esc_html__( 'Min Beds', 'framework' ),
					'min-baths'        => esc_html__( 'Min Baths', 'framework' ),
					'min-max-price'    => esc_html__( 'Min and Max Price', 'framework' ),
					'min-max-area'     => esc_html__( 'Min and Max Area', 'framework' ),
					'min-max-lot-size' => esc_html__( 'Min and Max Lot Size', 'framework' ),
					'min-garages'      => esc_html__( 'Min Garages', 'framework' ),
				);
			}

			$search_fields = apply_filters( 'inspiry_sort_search_fields', $search_fields );

			if ( ! empty( $get_stored_order ) && is_array( $get_stored_order ) ) {
				$unique_fields = array_intersect_key( array_flip( $get_stored_order ), $search_fields );
				$search_fields = array_merge( $unique_fields, $search_fields );
			}

			if ( inspiry_is_rvr_enabled() ) {
				$default_search_fields = array( 'location', 'check-in-out', 'guest' );
			} else {
				$default_search_fields = array(
					'keyword-search',
					'property-id',
					'location',
					'status',
					'type',
					'min-beds',
					'min-baths',
					'min-max-price',
					'min-max-area',
					'min-max-lot-size'
				);
			}

			$wp_customize->add_setting(
				'theme_search_fields',
				array(
					'type'              => 'option',
					'default'           => $default_search_fields,
					'sanitize_callback' => 'inspiry_sanitize_multiple_checkboxes',
				)
			);
			$wp_customize->add_control(
				new Inspiry_Multiple_Checkbox_Customize_Control_sortable(
					$wp_customize,
					'theme_search_fields',
					array(
						'section'         => 'inspiry_properties_search_form',
						'label'           => esc_html__( 'Which fields you want to display in search form ?', 'framework' ),
						'choices'         => $search_fields,
						'active_callback' => 'realhomes_custom_search_form_is_default',
					)
				)
			);
		}

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$wp_customize->add_setting(
				'inspiry_search_advance_search_expander',
				array(
					'type'              => 'option',
					'default'           => 'true',
					'sanitize_callback' => 'inspiry_sanitize_radio',
				)
			);

			$descrition = '';
			if ( inspiry_is_rvr_enabled() ) {
				$descrition = esc_html__( 'It is only for (SFOI) search form over image.', 'framework' );
			}

			$wp_customize->add_control(
				'inspiry_search_advance_search_expander',
				array(
					'label'           => esc_html__( 'Advance Search Fields Button', 'framework' ),
					'description'     => $descrition,
					'type'            => 'radio',
					'section'         => 'inspiry_properties_search_form',
					'choices'         => array(
						'true'  => esc_html__( 'Show', 'framework' ),
						'false' => esc_html__( 'Hide', 'framework' ),
					),
					'active_callback' => 'realhomes_custom_search_form_is_default',
				)
			);
		}

		if ( ! inspiry_is_rvr_enabled() && 'modern' === INSPIRY_DESIGN_VARIATION ) {


			$wp_customize->add_setting( 'inspiry_search_fields_main_row', array(
				'type'              => 'option',
				'default'           => '4',
				'sanitize_callback' => 'inspiry_sanitize_select',
			) );

			$wp_customize->add_control( 'inspiry_search_fields_main_row', array(
				'label'           => esc_html__( 'Number Of Fields To Display In Top Row', 'framework' ),
				'description'     => esc_html__( 'Not applicable for Search Form Over Image ', 'framework' ),
				'type'            => 'select',
				'section'         => 'inspiry_properties_search_form',
				'choices'         => array(
					'1' => esc_html__( 'One', 'framework' ),
					'2' => esc_html__( 'Two', 'framework' ),
					'3' => esc_html__( 'Three', 'framework' ),
					'4' => esc_html__( 'Four', 'framework' ),
				),
				'active_callback' => 'realhomes_custom_search_form_is_default',
			) );

			$wp_customize->add_setting( 'inspiry_sfoi_fields_main_row', array(
				'type'              => 'option',
				'default'           => '2',
				'sanitize_callback' => 'inspiry_sanitize_select',
			) );

			$wp_customize->add_control( 'inspiry_sfoi_fields_main_row', array(
				'label'           => esc_html__( 'Number Of Fields To Display In Top Row', 'framework' ),
				'description'     => esc_html__( 'For Search Form Over Image Only', 'framework' ),
				'type'            => 'select',
				'section'         => 'inspiry_properties_search_form',
				'choices'         => array(
					'1' => esc_html__( 'One', 'framework' ),
					'2' => esc_html__( 'Two', 'framework' ),
					'3' => esc_html__( 'Three', 'framework' ),
				),
				'active_callback' => 'realhomes_custom_search_form_is_default',
			) );

			$wp_customize->add_setting(
				'inspiry_sfoi_classes', array(
					'type'              => 'option',
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				'inspiry_sfoi_classes', array(
					'label'           => esc_html__( 'Add classes to wrapper (Search Form Over Image)', 'framework' ),
					'description'     => esc_html__( 'Add Classes with spaces between ie. (rh-equal-width-top-fields) ', 'framework' ),
					'type'            => 'textarea',
					'section'         => 'inspiry_properties_search_form',
					'active_callback' => 'realhomes_custom_search_form_is_default',
				)
			);


		}


		/* Separator */
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {

			$wp_customize->add_setting( 'inspiry_keyword_separator', array( 'sanitize_callback' => 'sanitize_text_field', ) );
			$wp_customize->add_control(
				new Inspiry_Separator_Control(
					$wp_customize,
					'inspiry_keyword_separator',
					array(
						'section'         => 'inspiry_properties_search_form',
						'active_callback' => 'realhomes_custom_search_form_is_default',
					)
				)
			);

			/* Collapse sidebar Advance Search form fields */
			$wp_customize->add_setting( 'inspiry_sidebar_asf_collapse', array(
				'type'              => 'option',
				'default'           => 'no',
				'sanitize_callback' => 'inspiry_sanitize_select',
			) );

			$wp_customize->add_control( 'inspiry_sidebar_asf_collapse', array(
				'label'           => esc_html__( 'Collapse sidebar Advance Search form', 'framework' ),
				'description'     => esc_html__( 'Collapse more Advance Search form fields in sidebar by default.', 'framework' ),
				'type'            => 'select',
				'section'         => 'inspiry_properties_search_form',
				'choices'         => array(
					'no'  => esc_html__( 'Disable', 'framework' ),
					'yes' => esc_html__( 'Enable', 'framework' ),
				),
				'active_callback' => 'realhomes_custom_search_form_is_default',
			) );
		}

		/* Separator */
		$wp_customize->add_setting( 'inspiry_sidebar_asf_collapse_separator', array( 'sanitize_callback' => 'sanitize_text_field', ) );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_sidebar_asf_collapse_separator',
				array(
					'section'         => 'inspiry_properties_search_form',
					'active_callback' => 'realhomes_custom_search_form_is_default',
				)
			)
		);

		if ( inspiry_is_rvr_enabled() && 'classic' !== INSPIRY_DESIGN_VARIATION ) {

			// Fields for Geo-Location Feature which works only with Google Maps
			if ( 'google-maps' === inspiry_get_maps_type() ) {

				// Location field label
				$wp_customize->add_setting( 'realhomes_geolocation_label', array(
					'type'              => 'option',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_control( 'realhomes_geolocation_label', array(
					'label'           => esc_html__( 'Label for Geo Location Field', 'framework' ),
					'type'            => 'text',
					'section'         => 'inspiry_properties_search_form',
					'active_callback' => function() {
						return ( realhomes_custom_search_form_is_default() && realhomes_is_location_type_geolocation() );
					}
				) );

				$wp_customize->add_setting( 'realhomes_geolocation_placeholder_text', array(
					'type'              => 'option',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_control( 'realhomes_geolocation_placeholder_text', array(
					'label'           => esc_html__( 'Placeholder for Geo Location Field', 'framework' ),
					'type'            => 'text',
					'section'         => 'inspiry_properties_search_form',
					'active_callback' => function() {
						return ( realhomes_custom_search_form_is_default() && realhomes_is_location_type_geolocation() );
					}
				) );

			} else {

				/* City field label */
				$wp_customize->add_setting(
					'theme_location_title_1',
					array(
						'type'              => 'option',
						'sanitize_callback' => 'sanitize_text_field',
					)
				);
				$wp_customize->add_control(
					'theme_location_title_1',
					array(
						'label'           => esc_html__( 'Label for City', 'framework' ),
						'type'            => 'text',
						'section'         => 'inspiry_properties_search_form',
						'active_callback' => function() {
							return ( realhomes_custom_search_form_is_default() );
						}
					)
				);

				$wp_customize->add_setting(
					'inspiry_location_placeholder_1',
					array(
						'type'              => 'option',
						'sanitize_callback' => 'sanitize_text_field',
					)
				);
				$wp_customize->add_control(
					'inspiry_location_placeholder_1',
					array(
						'label'           => esc_html__( 'Placeholder for City Field', 'framework' ),
						'type'            => 'text',
						'section'         => 'inspiry_properties_search_form',
						'active_callback' => function() {
							return ( realhomes_custom_search_form_is_default() );
						}
					)
				);

			}

			/* Separator */
			$wp_customize->add_setting( 'inspiry_checkin_separator', array( 'sanitize_callback' => 'sanitize_text_field', ) );
			$wp_customize->add_control(
				new Inspiry_Separator_Control(
					$wp_customize,
					'inspiry_checkin_separator',
					array(
						'section'         => 'inspiry_properties_search_form',
						'active_callback' => 'realhomes_custom_search_form_is_default',
					)
				)
			);

			/* Check In Label */
			$wp_customize->add_setting(
				'inspiry_checkin_label',
				array(
					'type'              => 'option',
					'default'           => esc_html__( 'Check In', 'framework' ),
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				'inspiry_checkin_label',
				array(
					'label'           => esc_html__( 'Label for Check In', 'framework' ),
					'type'            => 'text',
					'section'         => 'inspiry_properties_search_form',
					'active_callback' => 'realhomes_custom_search_form_is_default',
				)
			);

			/* Check In Placeholder Text */
			$wp_customize->add_setting(
				'inspiry_checkin_placeholder_text',
				array(
					'type'              => 'option',
					'default'           => esc_html__( 'Any', 'framework' ),
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				'inspiry_checkin_placeholder_text',
				array(
					'label'           => esc_html__( 'Placeholder Text for Check In', 'framework' ),
					'type'            => 'text',
					'section'         => 'inspiry_properties_search_form',
					'active_callback' => 'realhomes_custom_search_form_is_default',
				)
			);

			/* Separator */
			$wp_customize->add_setting( 'inspiry_checkout_separator', array( 'sanitize_callback' => 'sanitize_text_field', ) );
			$wp_customize->add_control(
				new Inspiry_Separator_Control(
					$wp_customize,
					'inspiry_checkout_separator',
					array(
						'section'         => 'inspiry_properties_search_form',
						'active_callback' => 'realhomes_custom_search_form_is_default',
					)
				)
			);

			/* Check Out Label */
			$wp_customize->add_setting(
				'inspiry_checkout_label',
				array(
					'type'              => 'option',
					'default'           => esc_html__( 'Check Out', 'framework' ),
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				'inspiry_checkout_label',
				array(
					'label'           => esc_html__( 'Label for Check Out', 'framework' ),
					'type'            => 'text',
					'section'         => 'inspiry_properties_search_form',
					'active_callback' => 'realhomes_custom_search_form_is_default',
				)
			);

			/* Check Out Placeholder Text */
			$wp_customize->add_setting(
				'inspiry_checkout_placeholder_text',
				array(
					'type'              => 'option',
					'default'           => esc_html__( 'Any', 'framework' ),
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				'inspiry_checkout_placeholder_text',
				array(
					'label'           => esc_html__( 'Placeholder Text for Check Out', 'framework' ),
					'type'            => 'text',
					'section'         => 'inspiry_properties_search_form',
					'active_callback' => 'realhomes_custom_search_form_is_default',
				)
			);

			/* Separator */
			$wp_customize->add_setting( 'inspiry_guests_separator', array( 'sanitize_callback' => 'sanitize_text_field', ) );
			$wp_customize->add_control(
				new Inspiry_Separator_Control(
					$wp_customize,
					'inspiry_guests_separator',
					array(
						'section'         => 'inspiry_properties_search_form',
						'active_callback' => 'realhomes_custom_search_form_is_default',
					)
				)
			);

			/* No of Guest Label */
			$wp_customize->add_setting(
				'inspiry_guests_label',
				array(
					'type'              => 'option',
					'default'           => esc_html__( 'Guests', 'framework' ),
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				'inspiry_guests_label',
				array(
					'label'           => esc_html__( 'Label for Guests', 'framework' ),
					'type'            => 'text',
					'section'         => 'inspiry_properties_search_form',
					'active_callback' => 'realhomes_custom_search_form_is_default',
				)
			);

			/* Guests Placeholder Text */
			$wp_customize->add_setting(
				'inspiry_guests_placeholder_text',
				array(
					'type'              => 'option',
					'default'           => esc_html__( 'Any', 'framework' ),
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				'inspiry_guests_placeholder_text',
				array(
					'label'           => esc_html__( 'Placeholder Text for Guests', 'framework' ),
					'type'            => 'text',
					'section'         => 'inspiry_properties_search_form',
					'active_callback' => 'realhomes_custom_search_form_is_default',
				)
			);

			$wp_customize->add_setting( 'inspiry_search_agent_separator', array( 'sanitize_callback' => 'sanitize_text_field', ) );
			$wp_customize->add_control(
				new Inspiry_Separator_Control(
					$wp_customize,
					'inspiry_search_agent_separator',
					array(
						'section'         => 'inspiry_properties_search_form',
						'active_callback' => 'realhomes_custom_search_form_is_default',
					)
				)
			);
		}
		if ( 'ultra' !== INSPIRY_DESIGN_VARIATION ) {

			/* Search Button Text */
			$wp_customize->add_setting(
				'inspiry_search_button_text', array(
					'type'              => 'option',
					'transport'         => 'postMessage',
					'default'           => esc_html__( 'Search', 'framework' ),
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				'inspiry_search_button_text', array(
					'label'           => esc_html__( 'Search Button Text', 'framework' ),
					'type'            => 'text',
					'section'         => 'inspiry_properties_search_form',
					'active_callback' => 'realhomes_custom_search_form_is_default',
				)
			);

			/* Any Text */
			$wp_customize->add_setting(
				'inspiry_any_text', array(
					'type'              => 'option',
					'default'           => esc_html__( 'Any', 'framework' ),
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				'inspiry_any_text', array(
					'label'           => esc_html__( 'Any Text', 'framework' ),
					'type'            => 'text',
					'section'         => 'inspiry_properties_search_form',
					'active_callback' => 'realhomes_custom_search_form_is_default',
				)
			);
		}
	}

	add_action( 'customize_register', 'inspiry_search_form_basics_customizer' );
endif;

if ( ! function_exists( 'inspiry_search_form_basics_defaults' ) ) :

	/**
	 * inspiry_search_form_basics_defaults.
	 *
	 * @since  2.6.3
	 */
	function inspiry_search_form_basics_defaults( WP_Customize_Manager $wp_customize ) {
		$search_form_basics_settings_ids = array(
			'theme_home_advance_search_title',
			'theme_search_fields',
			'inspiry_keyword_label',
			'inspiry_keyword_placeholder_text',
			'inspiry_property_id_label',
			'inspiry_property_id_placeholder_text',
			'inspiry_property_status_label',
			'inspiry_property_type_label',
			'inspiry_agent_field_label',
			'inspiry_any_text',
			'inspiry_search_button_text',
			'inspiry_search_features_title',
		);
		inspiry_initialize_defaults( $wp_customize, $search_form_basics_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_search_form_basics_defaults' );
endif;

if ( ! function_exists( 'inspiry_home_advance_search_title_render' ) ) {
	function inspiry_home_advance_search_title_render() {
		if ( get_option( 'theme_home_advance_search_title' ) ) {
			echo '<i class="fas fa-search"></i>' . get_option( 'theme_home_advance_search_title' );
		}
	}
}

if ( ! function_exists( 'realhomes_custom_search_form_is_default' ) ) {
	/**
	 * Return True if Custom Search Form is set as Default
	 *
	 * @since RealHomes 3.20.0
	 * @return bool
	 */
	function realhomes_custom_search_form_is_default() {
		if ( class_exists( 'RHEA_Elementor_Search_Form' ) ) {
			$realhomes_custom_search_form = get_option( 'realhomes_custom_search_form' );
			if ( $realhomes_custom_search_form && 'default' !== $realhomes_custom_search_form ) {
				return false;
			}
		}

		return true;
	}
}

if ( ! function_exists( 'realhomes_custom_search_form_not_default' ) ) {
	/**
	 * Check if Custom Search Form is not set as Default
	 *
	 * @since RealHomes 3.20.0
	 * @return bool
	 */
	function realhomes_custom_search_form_not_default() {
		if ( class_exists( 'RHEA_Elementor_Search_Form' ) ) {
			$realhomes_custom_search_form = get_option( 'realhomes_custom_search_form' );
			if ( $realhomes_custom_search_form && 'default' !== $realhomes_custom_search_form ) {
				return true;
			}
		}

		return false;
	}
}