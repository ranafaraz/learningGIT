<?php
/**
 * Adds Properties Filter Widget
 *
 * @since 2.0.3
 */

if ( ! class_exists( 'Properties_Filter_Widget' ) ) {

	class Properties_Filter_Widget extends WP_Widget {
		/**
		 * Registering widget with WordPress.
		 */
		public function __construct() {
			parent::__construct(
				'properties_filter_widget',
				esc_html__( 'RealHomes - Properties Filter Widget', 'easy-real-estate' ),
				array(
					'description' => esc_html__( 'This widget provides users with filter options to refine their search criteria for property listings templates.', 'easy-real-estate' )
				)
			);
		}

		/**
		 * Front-end display of widget.
		 *
		 * @param array $args     Widget arguments.
		 * @param array $instance Saved values from database.
		 *
		 * @see WP_Widget::widget()
		 *
		 */
		public function widget( $args, $instance ) {
			extract( $args );
			$title                 = apply_filters( 'widget_title', $instance['title'] );
			$property_types        = $instance['property-types'];
			$property_location     = $instance['property-location'];
			$property_status       = $instance['property-status'];
			$property_features     = $instance['property-features'];
			$checkboxes_view_limit = $instance['checkboxes-view-limit'];
			$hide_empty            = $instance['hide_empty'];
			$price_range           = $instance['price-ranges'];
			$custom_price_ranges   = $instance['custom-price-ranges'];
			$area_range            = $instance['area-ranges'];
			$custom_area_ranges    = $instance['custom-area-ranges'];
			$area_unit             = $instance['area-unit'];
			$bedroom_options       = $instance['bedroom-options'];
			$bedrooms_max_value    = $instance['bedrooms-max-value'];
			$bathroom_options      = $instance['bathroom-options'];
			$bathrooms_max_value   = $instance['bathrooms-max-value'];
			$garage_options        = $instance['garage-options'];
			$garages_max_value     = $instance['garages-max-value'];
			$agent_options         = $instance['agent-options'];
			$agent_display_type    = ! empty( $instance['agent-display-type'] ) ? $instance['agent-display-type'] : 'thumbnail';
			$agency_options        = $instance['agency-options'];
			$agency_display_type   = ! empty( $instance['agency-display-type'] ) ? $instance['agency-display-type'] : 'thumbnail';
			$property_id           = $instance['property-id'];
			$additional_fields     = $instance['additional-fields'];
			$hide_empty            = filter_var( $hide_empty, FILTER_VALIDATE_BOOLEAN ); // making sure if provided val is bool
			echo $before_widget;

			if ( ! empty( $title ) ) {
				echo '<h4 class="title filters-heading">' . esc_html( $title ) . '<i class="fa-duotone fa-filters"></i></h4>';
			}

			if (
				! (
					is_page_template( 'templates/list-layout.php' )
					|| is_page_template( 'templates/grid-layout.php' )
					|| is_page_template( 'templates/properties.php' )
				)
			) {

				echo '<p class="alert alert-error filters-wrong-template"><strong>' . esc_html__( 'Note:', 'easy-real-estate' ) . '</strong> ' . esc_html__( 'The properties filters widget is specifically designed to work with properties listing templates and cannot be used on other types of pages.', 'easy-real-estate' ) . '</p>';

			} else if ( function_exists( 'realhomes_is_header_search_form_configured' ) && realhomes_is_header_search_form_configured() ) {

				echo '<p class="alert alert-error filters-wrong-template"><strong>' . esc_html__( 'Note:', 'easy-real-estate' ) . '</strong> ' . esc_html__( 'Advance Search is already enabled in the header. For the filters to work you need to disable the header search form as they do not work simultaneously.', 'easy-real-estate' ) . '</p>';

			} else {
				?>
                <div class="filters-widget-wrap">
                    <div class="property-filters">
                        <div class="collapse-button">
                            <span class="pop-open-all hidden">
                                <span class="button-text"><?php esc_html_e( 'Open All', 'easy-real-estate' ); ?></span>&nbsp; <i class="fas fa-angle-double-down"></i>
                            </span>
                            <span class="pop-collapse-all">
                                <span class="button-text"><?php esc_html_e( 'Collapse All', 'easy-real-estate' ); ?></span>&nbsp; <i class="fas fa-angle-double-up"></i>
                            </span>
                        </div>
						<?php
						// Adding property type taxonomy filter
						if ( $property_types === 'true' && ere_taxonomy_has_terms('property-type', $hide_empty ) ) {
							?>
                            <div class="filter-wrapper property-types">
                                <h4><?php esc_html_e( 'Property Types', 'easy-real-estate' ); ?></h4>
                                <div class="filter-section terms-list" data-taxonomy="types" data-display-title="<?php esc_html_e( 'Type', 'easy-real-estate' ); ?>">
									<?php
									ere_process_filter_widget_taxonomies( 'property-type', $checkboxes_view_limit, $hide_empty );
									?>
                                </div>
                            </div>
							<?php
						}

						// Adding property city taxonomy filter
						if ( $property_location === 'true' && ere_taxonomy_has_terms('property-city', $hide_empty ) ) {
							?>
                            <div class="filter-wrapper property-locations">
                                <h4><?php esc_html_e( 'Property Locations', 'easy-real-estate' ); ?></h4>
                                <div class="filter-section terms-list" data-taxonomy="locations" data-display-title="<?php esc_html_e( 'Location', 'easy-real-estate' ); ?>">
									<?php
									ere_process_filter_widget_taxonomies( 'property-city', $checkboxes_view_limit, $hide_empty );
									?>
                                </div>
                            </div>
							<?php
						}

						// Adding property status taxonomy filter
						if ( $property_status === 'true' && ere_taxonomy_has_terms('property-status', $hide_empty ) ) {
							?>
                            <div class="filter-wrapper property-statuses">
                                <h4><?php esc_html_e( 'Property Status', 'easy-real-estate' ); ?></h4>
                                <div class="filter-section terms-list" data-taxonomy="statuses" data-display-title="<?php esc_html_e( 'Status', 'easy-real-estate' ); ?>">
									<?php
									ere_process_filter_widget_taxonomies( 'property-status', $checkboxes_view_limit, $hide_empty );
									?>
                                </div>
                            </div>
							<?php
						}

						// Adding property features filter
						if ( $property_features === 'true' && ere_taxonomy_has_terms('property-feature', $hide_empty ) ) {
							?>
                            <div class="filter-wrapper property-features">
                                <h4><?php esc_html_e( 'Property Features', 'easy-real-estate' ); ?></h4>
                                <div class="filter-section terms-list" data-taxonomy="features" data-display-title="<?php esc_html_e( 'Feature', 'easy-real-estate' ); ?>">
									<?php
									ere_process_filter_widget_taxonomies( 'property-feature', $checkboxes_view_limit, $hide_empty );
									?>
                                </div>
                            </div>
							<?php
						}

						// Adding price options
						if ( $price_range === 'true' ) {
							$price_ranges = array(
								'1000 - 5000',
								'5001 - 10000',
								'10001 - 50000',
								'50001 - 100000',
								'100000 - 150000',
								'150001 - 200000',
								'200001 - 250000'
							);

							// If custom price ranges area set in widget settings
							if ( ! empty( $custom_price_ranges ) ) {
								$custom_prices_array = preg_split( '/\r\n|\r|\n/', $custom_price_ranges );
								$price_ranges        = $custom_prices_array;
							}

							array_unshift( $price_ranges, esc_html__( 'All', 'easy-real-estate' ) );
							?>
                            <div class="filter-wrapper price-ranges">
                                <h4><?php esc_html_e( 'Price Ranges', 'easy-real-estate' ); ?></h4>
                                <div class="filter-section range-list">
									<?php
									if ( is_array( $price_ranges ) ) {
										foreach ( $price_ranges as $p_range ) {
											$prices   = '';
											$range_id = str_replace( ' ', '', $p_range );
											if ( $p_range === 'All' ) {
												$prices = $p_range;
											} else {
												$range_array = explode( ' - ', $p_range );
												if ( 1 < count( $range_array ) && is_numeric( $range_array[0] ) && is_numeric( $range_array[1] ) ) {
													$prices = ere_format_amount( $range_array[0] ) . ' - ' . ere_format_amount( $range_array[1] );
												}
											}
											if ( ! empty( $prices ) ) {
												?>
                                                <p class="radio-wrap" data-meta-name="price" data-display-title="<?php esc_html_e( 'Price', 'easy-real-estate' ); ?>">
                                                    <input type="radio" id="price-<?php echo esc_attr( $range_id ); ?>" data-display-value="<?php echo esc_attr( $prices ); ?>" name="price-range" value="<?php echo esc_attr( $p_range ); ?>">
                                                    <label for="price-<?php echo esc_attr( $range_id ); ?>"><span class="radio-fancy"></span><?php echo esc_html( $prices ); ?></label>
                                                </p>
												<?php
											}
										}
									}
									?>
                                </div>
                            </div>
							<?php
						}

						// Adding area options
						if ( $area_range === 'true' ) {
							$area_ranges = array(
								'50 - 100',
								'101 - 500',
								'501 - 1000',
								'1001 - 5000',
								'5001 - 10000'
							);

							// If custom area ranges area set in widget settings
							if ( ! empty( $custom_area_ranges ) ) {
								$custom_areas_array = preg_split( '/\r\n|\r|\n/', $custom_area_ranges );
								$area_ranges        = $custom_areas_array;
							}

							array_unshift( $area_ranges, esc_html__( 'All', 'easy-real-estate' ) );
							?>
                            <div class="filter-wrapper area-ranges">
                                <h4><?php esc_html_e( 'Area Ranges', 'easy-real-estate' ); ?></h4>
                                <div class="filter-section range-list">
									<?php
									if ( is_array( $area_ranges ) ) {
										foreach ( $area_ranges as $a_range ) {
											$areas    = '';
											$range_id = str_replace( ' ', '', $a_range );
											if ( $a_range === 'All' ) {
												$areas = $a_range;
											} else {
												$range_array = explode( ' - ', $a_range );
												if ( 1 < count( $range_array ) && is_numeric( $range_array[0] ) && is_numeric( $range_array[1] ) ) {
													$areas = $range_array[0] . ' <sub>' . $area_unit . '</sub>' . ' - ' . $range_array[1] . ' <sub>' . $area_unit . '</sub>';
												}
											}

											if ( ! empty( $areas ) ) {
												?>
                                                <p class="radio-wrap" data-meta-name="area" data-display-title="<?php esc_html_e( 'Area', 'easy-real-estate' ); ?>">
                                                    <input type="radio" id="area-<?php echo esc_attr( $range_id ); ?>" data-display-value="<?php echo wp_kses_post( $areas ); ?>" name="area-range" value="<?php echo esc_attr( $a_range ); ?>">
                                                    <label for="area-<?php echo esc_attr( $range_id ); ?>"><span class="radio-fancy"></span><?php echo wp_kses_post( $areas ); ?></label>
                                                </p>
												<?php
											}
										}
									}
									?>
                                </div>
                            </div>
							<?php
						}

						$agent_posts = wp_count_posts( 'agent' );
						if ( $agent_options === 'true' && intval( $agent_posts->publish ) > 0 ) {
							$agents_arguments = array(
								'post_type'       => 'agent',
								'view_limit'      => $checkboxes_view_limit,
								'wrapper_classes' => 'agent-options',
								'section_title'   => esc_html__( 'Agents', 'easy-real-estate' ),
								'display_type'    => $agent_display_type,
								'display_title'   => esc_html__( 'Agent', 'easy-real-estate' ),
								'target_id'       => 'agent'
							);
							ere_process_filter_widget_post_types( $agents_arguments );
						}

						$agency_posts = wp_count_posts( 'agency' );
						if ( $agency_options === 'true' && intval( $agency_posts->publish ) > 0 ) {
							$agency_arguments = array(
								'post_type'       => 'agency',
								'view_limit'      => $checkboxes_view_limit,
								'wrapper_classes' => 'agency-options',
								'section_title'   => esc_html__( 'Agencies', 'easy-real-estate' ),
								'display_type'    => $agency_display_type,
								'display_title'   => esc_html__( 'Agency', 'easy-real-estate' ),
								'target_id'       => 'agencies'
							);
							ere_process_filter_widget_post_types( $agency_arguments );
						}

						if ( $bedroom_options === 'true' ) {
							?>
                            <div class="filter-wrapper radio-buttons">
                                <h4><?php esc_html_e( 'Min Bedrooms', 'easy-real-estate' ); ?></h4>
                                <div class="filter-section buttons-list" data-meta-name="bedrooms" data-display-title="<?php esc_html_e( 'Min Beds', 'easy-real-estate' ); ?>">
                                    <div class="number-option-wrap bedroom-options">
                                        <span class="option-num">
                                            <input type="radio" name="min-bedrooms" id="min-bedroom-all" value="0" checked>
                                            <label for="min-bedroom-all"><?php esc_html_e( 'All', 'easy-real-estate' ) ?></label>
                                        </span>
										<?php
										if ( empty( $bedrooms_max_value ) || 0 > intval( $bedrooms_max_value ) ) {
											$bedrooms_max_value = 9;
										}
										for ( $bed = 1; $bed <= $bedrooms_max_value; $bed++ ) {
											?>
                                            <span class="option-num">
                                                <input type="radio" name="min-bedrooms" id="min-bedroom-<?php echo esc_attr( $bed ); ?>" value="<?php echo esc_html( $bed ); ?>">
                                                <label for="min-bedroom-<?php echo esc_attr( $bed ); ?>"><?php echo esc_html( $bed ); ?></label>
                                            </span>
											<?php
										}
										?>
                                    </div>
                                </div>
                            </div>
							<?php
						}

						if ( $bathroom_options === 'true' ) {
							?>
                            <div class="filter-wrapper radio-buttons">
                                <h4><?php esc_html_e( 'Min Bathrooms', 'easy-real-estate' ); ?></h4>
                                <div class="filter-section buttons-list" data-meta-name="bathrooms" data-display-title="<?php esc_html_e( 'Min Baths', 'easy-real-estate' ); ?>">
                                    <div class="number-option-wrap bathroom-options">
                                        <span class="option-num">
                                            <input type="radio" name="min-bathrooms" id="min-bathroom-all" value="0" checked>
                                            <label for="min-bathroom-all"><?php esc_html_e( 'All', 'easy-real-estate' ) ?></label>
                                        </span>
										<?php
										if ( empty( $bathrooms_max_value ) || 0 > intval( $bathrooms_max_value ) ) {
											$bathrooms_max_value = 12;
										}
										for ( $bath = 1; $bath <= $bathrooms_max_value; $bath++ ) {
											?>
                                            <span class="option-num">
                                                <input type="radio" name="min-bathrooms" id="min-bathroom-<?php echo esc_attr( $bath ); ?>" value="<?php echo esc_html( $bath ); ?>">
                                                <label for="min-bathroom-<?php echo esc_attr( $bath ); ?>"><?php echo esc_html( $bath ); ?></label>
                                            </span>
											<?php
										}
										?>
                                    </div>
                                </div>
                            </div>
							<?php
						}

						if ( $garage_options === 'true' ) {
							?>
                            <div class="filter-wrapper radio-buttons">
                                <h4><?php esc_html_e( 'Min Garages', 'easy-real-estate' ); ?></h4>
                                <div class="filter-section buttons-list" data-meta-name="garages" data-display-title="<?php esc_html_e( 'Min Garages', 'easy-real-estate' ); ?>">
                                    <div class="number-option-wrap garage-options">
                                        <span class="option-num">
                                            <input type="radio" name="min-garages" id="min-garage-all" value="0" checked>
                                            <label for="min-garage-all"><?php esc_html_e( 'All', 'easy-real-estate' ) ?></label>
                                        </span>
										<?php
										if ( empty( $garages_max_value ) || 0 > intval( $garages_max_value ) ) {
											$garages_max_value = 5;
										}
										for ( $garage = 1; $garage <= $garages_max_value; $garage++ ) {
											?>
                                            <span class="option-num">
                                                <input type="radio" name="min-garages" id="min-garage-<?php echo esc_attr( $garage ); ?>" value="<?php echo esc_html( $garage ); ?>">
                                                <label for="min-garage-<?php echo esc_attr( $garage ); ?>"><?php echo esc_html( $garage ); ?></label>
                                            </span>
											<?php
										}
										?>
                                    </div>
                                </div>
                            </div>
							<?php
						}

						if ( $property_id === 'true' ) {
							?>
                            <div class="filter-wrapper input-wrapper">
                                <h4 for="property-id"><?php esc_html_e( 'Property ID', 'easy-real-estate' ); ?></h4>
                                <div class="filter-section input-filter" data-meta-name="propertyID" data-display-title="<?php esc_html_e( 'Property ID', 'easy-real-estate' ); ?>">
                                    <p class="input-wrap" data-meta-name="propertyID">
                                        <input type="text" id="property-id" name="property-id" placeholder="<?php esc_html_e( 'Any', 'easy-real-estate' ); ?>">
                                    </p>
                                </div>
                            </div>
							<?php
						}

						// Adding additional meta details
						if ( $additional_fields === 'true' ) {
							$additional_fields = get_option( 'inspiry_property_additional_fields' );

							if ( isset( $additional_fields['inspiry_additional_fields_list'] ) && 0 < count( $additional_fields['inspiry_additional_fields_list'] ) ) {
								$additional_fields = $additional_fields['inspiry_additional_fields_list'];
								if ( is_array( $additional_fields ) && 0 < count( $additional_fields ) && ere_new_field_for_section( 'filters_widget', $additional_fields ) ) {
                                    ?>
                                    <div class="filter-wrapper additional-fields">
                                        <h4><?php esc_html_e( 'Additional Details', 'easy-real-estate' ); ?></h4>
                                        <div class="filter-section additional-items" data-meta-name="additional-fields">
                                            <?php
                                            foreach ( $additional_fields as $field ) {
                                                $field_name    = $field['field_name'] ?? '';
                                                $field_type    = $field['field_type'] ?? '';
                                                $field_display = $field['field_display'] ?? '';

	                                            if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
		                                            $field_reg_name = $field_name . ' Label';
		                                            $field_reg_value = $field_name . ' Value';
		                                            $field_name = apply_filters( 'wpml_translate_single_string', $field_name, 'Additional Fields', $field_reg_name, ICL_LANGUAGE_CODE );
	                                            }

                                                // Checking if this field is allowed to be displayed here
                                                if ( is_array( $field_display ) && in_array( 'filters_widget', $field_display ) ) {
                                                    $field_slug = 'inspiry_' . strtolower( str_replace( ' ', '_', $field_name ) );
                                                    ?>
                                                    <div class="additional-item <?php echo esc_attr( $field_slug );
                                                    echo ' ad-' . esc_attr( $field_type ) . '-wrap'; ?>">
                                                        <?php
                                                        if ( $field_type === 'text' ) {
                                                            ?>
                                                            <p class="input-wrap input-filter" data-field-name="<?php echo esc_attr( $field_name ); ?>">
                                                                <label for="<?php echo esc_attr( $field_slug ); ?>"><?php echo esc_html( $field_name ); ?></label>
                                                                <input type="text" id="<?php echo esc_attr( $field_slug ); ?>" name="<?php echo esc_attr( $field_slug ); ?>" placeholder="<?php esc_html_e( 'Any', 'easy-real-estate' ); ?>" value="">
                                                            </p>
                                                            <?php
                                                        } else if ( $field_type === 'select' ) {
                                                            $field_options = $field['field_options'];

	                                                        if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
		                                                        $field_options = apply_filters( 'wpml_translate_single_string', $field_options, 'Additional Fields', $field_reg_value, ICL_LANGUAGE_CODE );
	                                                        }

                                                            $field_options = explode( ', ', $field_options );
                                                            if ( is_array( $field_options ) && 0 < count( $field_options ) ) {
                                                                ?>
                                                                <p class="select-wrap select-filter" data-field-name="<?php echo esc_attr( $field_name ); ?>">
                                                                    <label for="<?php echo esc_attr( $field_slug ); ?>"><?php echo esc_html( $field_name ); ?></label>
                                                                    <select name="<?php echo esc_attr( $field_slug ); ?>" id="<?php echo esc_attr( $field_slug ); ?>">
                                                                        <option value=""><?php esc_html_e( 'None', 'easy-real-estate' ); ?></option>
                                                                        <?php
                                                                        foreach ( $field_options as $option ) {
                                                                            $option_slug = strtolower( str_replace( ' ', '-', $option ) );
                                                                            ?>
                                                                            <option value="<?php echo esc_attr( $option_slug ); ?>"><?php echo esc_html( $option ); ?></option>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </p>
                                                                <?php
                                                            }
                                                        } else if ( $field_type === 'radio' ) {
                                                            $field_options = $field['field_options'];

	                                                        if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
		                                                        $field_options = apply_filters( 'wpml_translate_single_string', $field_options, 'Additional Fields', $field_reg_value, ICL_LANGUAGE_CODE );
	                                                        }

	                                                        $field_options = explode( ', ', $field_options );
                                                            ?>
                                                            <div class="radio-filter" data-field-name="<?php echo esc_attr( $field_name ); ?>" data-field-slug="<?php echo esc_attr( $field_slug ); ?>">
                                                                <h5><?php echo esc_html( $field_name ); ?></h5>
                                                                <p class="radio-wrap">
                                                                    <input type="radio" id="<?php echo esc_attr( $field_slug ); ?>-none" name="<?php echo esc_attr( $field_slug ); ?>" value="">
                                                                    <label for="<?php echo esc_attr( $field_slug ); ?>-none"><span class="radio-fancy"></span> <?php esc_html_e( 'None', 'easy-real-estate' ); ?></label>
                                                                </p>
                                                                <?php
                                                                foreach ( $field_options as $option ) {
                                                                    $option_slug = strtolower( str_replace( ' ', '-', $option ) );
                                                                    ?>
                                                                    <p class="radio-wrap">
                                                                        <input type="radio" id="<?php echo esc_attr( $option_slug ); ?>" name="<?php echo esc_attr( $field_slug ); ?>" value="<?php echo esc_attr( $option ); ?>">
                                                                        <label for="<?php echo esc_attr( $option_slug ); ?>"><span class="radio-fancy"></span> <?php echo esc_attr( $option ); ?></label>
                                                                    </p>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>
                                                            <?php
                                                        } else if ( $field_type === 'checkbox_list' ) {
                                                            $field_options = $field['field_options'];

	                                                        if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
		                                                        $field_options = apply_filters( 'wpml_translate_single_string', $field_options, 'Additional Fields', $field_reg_value, ICL_LANGUAGE_CODE );
	                                                        }

                                                            $field_options = explode( ', ', $field_options );
                                                            ?>
                                                            <div class="checkbox-wrap checkbox-filter" data-field-name="<?php echo esc_attr( $field_name ); ?>" data-field-slug="<?php echo esc_attr( $field_slug ); ?>">
                                                                <h5><?php echo esc_html( $field_name ); ?></h5>
                                                                <?php
                                                                foreach ( $field_options as $option ) {
                                                                    $option_slug = strtolower( str_replace( ' ', '-', $option ) );
                                                                    ?>
                                                                    <p class="cb-wrap" data-field-name="<?php echo esc_attr( $field_name ); ?>">
                                                                        <input type="checkbox" id="<?php echo esc_attr( $option_slug ); ?>" name="<?php echo esc_attr( $field_slug ); ?>" value="<?php echo esc_attr( $option ); ?>">
                                                                        <label for="<?php echo esc_attr( $option_slug ); ?>"><?php echo esc_attr( $option ); ?><i>&#10003;</i></label>
                                                                    </p>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>
                                                            <?php
                                                        } else if ( $field_type === 'textarea' ) {
                                                            ?>
                                                            <p class="input-wrap input-filter" data-field-name="<?php echo esc_attr( $field_name ); ?>">
                                                                <label for="<?php echo esc_attr( $field_slug ); ?>"><?php echo esc_html( $field_name ); ?></label>
                                                                <input type="text" id="<?php echo esc_attr( $field_slug ); ?>" name="<?php echo esc_attr( $field_slug ); ?>" placeholder="<?php esc_html_e( 'Any', 'easy-real-estate' ); ?>">
                                                            </p>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
								}
							}
						}
						?>
                    </div> <!-- .property-filters -->
                </div>

				<?php
			}

			echo $after_widget;

			do_action( 'realhomes_after_filter_properties_widget' );
		}

		/**
		 * Back-end widget form.
		 *
		 * @param array $instance Previously saved values from database.
		 *
		 * @see WP_Widget::form()
		 *
		 */
		public function form( $instance ) {

			$title                 = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Filter Properties', 'easy-real-estate' );
			$hide_empty            = $instance['hide_empty'] ?? 'false';
			$property_types        = $instance['property-types'] ?? 'true';
			$property_location     = $instance['property-location'] ?? 'true';
			$property_status       = $instance['property-status'] ?? 'true';
			$property_features     = $instance['property-features'] ?? 'true';
			$checkboxes_view_limit = $instance['checkboxes-view-limit'] ?? 6;
			$price_ranges          = $instance['price-ranges'] ?? 'true';
			$custom_price_ranges   = $instance['custom-price-ranges'] ?? '';
			$area_ranges           = $instance['area-ranges'] ?? 'true';
			$custom_area_ranges    = $instance['custom-area-ranges'] ?? '';
			$area_unit             = $instance['area-unit'] ?? 'sq ft';
			$bedrooms_options      = $instance['bedroom-options'] ?? 'true';
			$bedrooms_max_value    = $instance['bedrooms-max-value'] ?? 9;
			$bathrooms_options     = $instance['bathroom-options'] ?? 'true';
			$bathrooms_max_value   = $instance['bathrooms-max-value'] ?? 9;
			$garages_options       = $instance['garage-options'] ?? 'true';
			$garages_max_value     = $instance['garages-max-value'] ?? 4;
			$agent_options         = $instance['agent-options'] ?? 'true';
			$agent_display_type    = $instance['agent-display-type'] ?? 'thumbnail';
			$agency_options        = $instance['agency-options'] ?? 'true';
			$agency_display_type   = $instance['agency-display-type'] ?? 'thumbnail';
			$property_id           = $instance['property-id'] ?? 'true';
			$additional_fields     = $instance['additional-fields'] ?? 'true';
			?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>

            <hr>

            <h4><?php esc_html_e( 'Show/Hide Taxonomies', 'easy-real-estate' ); ?></h4>
            <p>
                <input type="checkbox" id="<?php echo $this->get_field_id( 'property-types' ); ?>" name="<?php echo $this->get_field_name( 'property-types' ); ?>" value="true" <?php echo checked( $property_types, 'true' ); ?>>
                <label for="<?php echo $this->get_field_id( 'property-types' ); ?>"><?php esc_html_e( 'Property Type', 'easy-real-estate' ); ?></label>
            </p>

            <p>
                <input type="checkbox" id="<?php echo $this->get_field_id( 'property-location' ); ?>" name="<?php echo $this->get_field_name( 'property-location' ); ?>" value="true" <?php echo checked( $property_location, 'true' ); ?>>
                <label for="<?php echo $this->get_field_id( 'property-location' ); ?>"><?php esc_html_e( 'Property Location', 'easy-real-estate' ); ?></label>
            </p>
            <p>
                <input type="checkbox" id="<?php echo $this->get_field_id( 'property-status' ); ?>" name="<?php echo $this->get_field_name( 'property-status' ); ?>" value="true" <?php echo checked( $property_status, 'true' ); ?>>
                <label for="<?php echo $this->get_field_id( 'property-status' ); ?>"><?php esc_html_e( 'Property Status', 'easy-real-estate' ); ?></label>
            </p>

            <p>
                <input type="checkbox" id="<?php echo $this->get_field_id( 'property-features' ); ?>" name="<?php echo $this->get_field_name( 'property-features' ); ?>" value="true" <?php echo checked( $property_features, 'true' ); ?>>
                <label for="<?php echo $this->get_field_id( 'property-features' ); ?>"><?php esc_html_e( 'Property Features', 'easy-real-estate' ); ?></label>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'hide_empty' ) ); ?>"><?php esc_html_e( 'Hide Empty Taxonomies', 'easy-real-estate' ); ?></label><br>
                <select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'hide_empty' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'hide_empty' ) ); ?>">
                    <option value="true" <?php echo selected( 'true', $hide_empty ); ?>><?php esc_html_e( 'True', 'easy-real-estate' ) ?></option>
                    <option value="false" <?php echo selected( 'false', $hide_empty ); ?>><?php esc_html_e( 'False', 'easy-real-estate' ) ?></option>
                </select>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'checkboxes-view-limit' ); ?>"><?php esc_html_e( 'Checkboxes View Limit', 'easy-real-estate' ); ?></label><br>
                <input class="widefat" type="number" id="<?php echo $this->get_field_id( 'checkboxes-view-limit' ); ?>" name="<?php echo $this->get_field_name( 'checkboxes-view-limit' ); ?>" value="<?php echo esc_attr( $checkboxes_view_limit ); ?>">
            </p>

            <hr>

            <p class="price-ranges-wrapper">
                <input type="checkbox" id="<?php echo $this->get_field_id( 'price-ranges' ); ?>" name="<?php echo $this->get_field_name( 'price-ranges' ); ?>" value="true" <?php echo checked( $price_ranges, 'true' ); ?>>
                <label for="<?php echo $this->get_field_id( 'price-ranges' ); ?>"><?php esc_html_e( 'Price Ranges', 'easy-real-estate' ); ?></label>
            </p>

            <div id="price-ranges" class="clearfix">
                <p class="widget-fat">
                    <label for="<?php echo $this->get_field_id( 'custom-price-ranges' ); ?>-default"><?php esc_html_e( 'Custom Price Ranges (optional)', 'easy-real-estate' ); ?></label>
                    <textarea class="widefat" id="<?php echo $this->get_field_id( 'custom-price-ranges' ); ?>" name="<?php echo $this->get_field_name( 'custom-price-ranges' ); ?>" type="radio"><?php echo esc_html( $custom_price_ranges ); ?></textarea>
                    <span class="description"><?php esc_html_e( 'Leave this area empty for default values. Put each range in new line in the given format. ( i.e. 5000 - 10000 )', 'easy-real-estate' ); ?></span>
                </p>
            </div>

            <hr>

            <p>
                <input type="checkbox" id="<?php echo $this->get_field_id( 'area-ranges' ); ?>" name="<?php echo $this->get_field_name( 'area-ranges' ); ?>" value="true" <?php echo checked( $area_ranges, 'true' ); ?>>
                <label for="<?php echo $this->get_field_id( 'area-ranges' ); ?>"><?php esc_html_e( 'Area Ranges', 'easy-real-estate' ); ?></label>
            </p>

            <div id="area-ranges" class="clearfix">
                <p class="widget-fat">
                    <label for="<?php echo $this->get_field_id( 'custom-area-ranges' ); ?>-default"><?php esc_html_e( 'Custom Area Ranges (optional)', 'easy-real-estate' ); ?></label>
                    <textarea class="widefat" id="<?php echo $this->get_field_id( 'custom-area-ranges' ); ?>" name="<?php echo $this->get_field_name( 'custom-area-ranges' ); ?>" type="radio"><?php echo esc_html( $custom_area_ranges ); ?></textarea>
                    <span class="description"><?php esc_html_e( 'Leave this area empty for default values. Put each range in new line in the given format. ( i.e. 200 - 400 )', 'easy-real-estate' ); ?></span>
                </p>
            </div>

            <p>
                <label for="<?php echo $this->get_field_id( 'area-unit' ); ?>"><?php esc_html_e( 'Area Unit', 'easy-real-estate' ); ?></label><br>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'area-unit' ); ?>" name="<?php echo $this->get_field_name( 'area-unit' ); ?>" value="<?php echo esc_attr( $area_unit ); ?>">
            </p>

            <hr>

            <p class="widget-field-half">
                <input type="checkbox" id="<?php echo $this->get_field_id( 'agent-options' ); ?>" name="<?php echo $this->get_field_name( 'agent-options' ); ?>" value="true" <?php echo checked( $agent_options, 'true' ); ?>>
                <label for="<?php echo $this->get_field_id( 'agent-options' ); ?>"><?php esc_html_e( 'Agent Options', 'easy-real-estate' ); ?></label>
            </p>

            <p class="widget-field-half mini-option select-wrap">
                <label for="<?php echo $this->get_field_id( 'agent-display-type' ); ?>"><?php esc_html_e( 'Display Type', 'easy-real-estate' ); ?></label>
                <select name="<?php echo $this->get_field_name( 'agent-display-type' ); ?>" id="<?php echo $this->get_field_id( 'agent-display-type' ); ?>">
                    <option value="thumbnail" <?php echo selected( $agent_display_type, 'thumbnail' ); ?>><?php echo esc_html( 'Thumbnails', 'easy-real-estate' ); ?></option>
                    <option value="checkbox" <?php echo selected( $agent_display_type, 'checkbox' ); ?>><?php echo esc_html( 'Checkboxes', 'easy-real-estate' ); ?></option>
                </select>
            </p>

            <p class="widget-field-half">
                <input type="checkbox" id="<?php echo $this->get_field_id( 'agency-options' ); ?>" name="<?php echo $this->get_field_name( 'agency-options' ); ?>" value="true" <?php echo checked( $agency_options, 'true' ); ?>>
                <label for="<?php echo $this->get_field_id( 'agency-options' ); ?>"><?php esc_html_e( 'Agency Options', 'easy-real-estate' ); ?></label>
            </p>

            <p class="widget-field-half mini-option">
                <label for="<?php echo $this->get_field_id( 'agency-display-type' ); ?>"><?php esc_html_e( 'Display Type', 'easy-real-estate' ); ?></label>
                <select name="<?php echo $this->get_field_name( 'agency-display-type' ); ?>" id="<?php echo $this->get_field_id( 'agency-display-type' ); ?>">
                    <option value="thumbnail" <?php echo selected( $agency_display_type, 'thumbnail' ); ?>><?php echo esc_html( 'Thumbnails', 'easy-real-estate' ); ?></option>
                    <option value="checkbox" <?php echo selected( $agency_display_type, 'checkbox' ); ?>><?php echo esc_html( 'Checkboxes', 'easy-real-estate' ); ?></option>
                </select>
            </p>

            <hr>

            <p class="bedroom-options-wrapper">
                <input type="checkbox" id="<?php echo $this->get_field_id( 'bedroom-options' ); ?>" name="<?php echo $this->get_field_name( 'bedroom-options' ); ?>" value="true" <?php echo checked( $bedrooms_options, 'true' ); ?>>
                <label for="<?php echo $this->get_field_id( 'bedroom-options' ); ?>"><?php esc_html_e( 'Bedroom Options', 'easy-real-estate' ); ?></label>
            </p>

            <p class="bedrooms-max-value">
                <label for="<?php echo $this->get_field_id( 'bedrooms-max-value' ); ?>"><?php esc_html_e( 'Maximum Bedrooms', 'easy-real-estate' ); ?></label><br>
                <input class="widefat" type="number" id="<?php echo $this->get_field_id( 'bedrooms-max-value' ); ?>" name="<?php echo $this->get_field_name( 'bedrooms-max-value' ); ?>" value="<?php echo esc_attr( $bedrooms_max_value ); ?>">
            </p>

            <hr>

            <p class="bathroom-options-wrapper">
                <input type="checkbox" id="<?php echo $this->get_field_id( 'bathroom-options' ); ?>" name="<?php echo $this->get_field_name( 'bathroom-options' ); ?>" value="true" <?php echo checked( $bathrooms_options, 'true' ); ?>>
                <label for="<?php echo $this->get_field_id( 'bathroom-options' ); ?>"><?php esc_html_e( 'Bathroom Options', 'easy-real-estate' ); ?></label>
            </p>

            <p class="bathrooms-max-value">
                <label for="<?php echo $this->get_field_id( 'bathrooms-max-value' ); ?>"><?php esc_html_e( 'Maximum Bathrooms', 'easy-real-estate' ); ?></label><br>
                <input class="widefat" type="number" id="<?php echo $this->get_field_id( 'bathrooms-max-value' ); ?>" name="<?php echo $this->get_field_name( 'bathrooms-max-value' ); ?>" value="<?php echo esc_attr( $bathrooms_max_value ); ?>">
            </p>

            <hr>

            <p>
                <input type="checkbox" id="<?php echo $this->get_field_id( 'garage-options' ); ?>" name="<?php echo $this->get_field_name( 'garage-options' ); ?>" value="true" <?php echo checked( $garages_options, 'true' ); ?>>
                <label for="<?php echo $this->get_field_id( 'garage-options' ); ?>"><?php esc_html_e( 'Garage Options', 'easy-real-estate' ); ?></label>
            </p>

            <p class="garages-max-value">
                <label for="<?php echo $this->get_field_id( 'garages-max-value' ); ?>"><?php esc_html_e( 'Maximum Garages', 'easy-real-estate' ); ?></label><br>
                <input class="widefat" type="number" id="<?php echo $this->get_field_id( 'garages-max-value' ); ?>" name="<?php echo $this->get_field_name( 'garages-max-value' ); ?>" value="<?php echo esc_attr( $garages_max_value ); ?>">
            </p>

            <hr>

            <p>
                <input type="checkbox" id="<?php echo $this->get_field_id( 'property-id' ); ?>" name="<?php echo $this->get_field_name( 'property-id' ); ?>" value="true" <?php echo checked( $property_id, 'true' ); ?>>
                <label for="<?php echo $this->get_field_id( 'property-id' ); ?>"><?php esc_html_e( 'Property ID', 'easy-real-estate' ); ?></label>
            </p>

            <p>
                <input type="checkbox" id="<?php echo $this->get_field_id( 'additional-fields' ); ?>" name="<?php echo $this->get_field_name( 'additional-fields' ); ?>" value="true" <?php echo checked( $additional_fields, 'true' ); ?>>
                <label for="<?php echo $this->get_field_id( 'additional-fields' ); ?>"><?php esc_html_e( 'Additional Fields', 'easy-real-estate' ); ?></label>
            </p>

            <br>
			<?php
		}

		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 * @see WP_Widget::update()
		 *
		 */
		public function update( $new_instance, $old_instance ) {
			$instance                          = array();
			$instance['title']                 = ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['hide_empty']            = ! empty( $new_instance['hide_empty'] ) ? $new_instance['hide_empty'] : '';
			$instance['property-types']        = ! empty( $new_instance['property-types'] ) ? $new_instance['property-types'] : '';
			$instance['property-location']     = ! empty( $new_instance['property-location'] ) ? $new_instance['property-location'] : '';
			$instance['property-status']       = ! empty( $new_instance['property-status'] ) ? $new_instance['property-status'] : '';
			$instance['property-features']     = ! empty( $new_instance['property-features'] ) ? $new_instance['property-features'] : '';
			$instance['checkboxes-view-limit'] = ! empty( $new_instance['checkboxes-view-limit'] ) ? $new_instance['checkboxes-view-limit'] : '';
			$instance['price-ranges']          = ! empty( $new_instance['price-ranges'] ) ? $new_instance['price-ranges'] : '';
			$instance['custom-price-ranges']   = ! empty( $new_instance['custom-price-ranges'] ) ? $new_instance['custom-price-ranges'] : '';
			$instance['area-ranges']           = ! empty( $new_instance['area-ranges'] ) ? $new_instance['area-ranges'] : '';
			$instance['area-unit']             = ! empty( $new_instance['area-unit'] ) ? $new_instance['area-unit'] : '';
			$instance['custom-area-ranges']    = ! empty( $new_instance['custom-area-ranges'] ) ? $new_instance['custom-area-ranges'] : '';
			$instance['bedroom-options']       = ! empty( $new_instance['bedroom-options'] ) ? $new_instance['bedroom-options'] : '';
			$instance['bedrooms-max-value']    = ! empty( $new_instance['bedrooms-max-value'] ) ? $new_instance['bedrooms-max-value'] : '';
			$instance['bathroom-options']      = ! empty( $new_instance['bathroom-options'] ) ? $new_instance['bathroom-options'] : '';
			$instance['bathrooms-max-value']   = ! empty( $new_instance['bathrooms-max-value'] ) ? $new_instance['bathrooms-max-value'] : '';
			$instance['garage-options']        = ! empty( $new_instance['garage-options'] ) ? $new_instance['garage-options'] : '';
			$instance['garages-max-value']     = ! empty( $new_instance['garages-max-value'] ) ? $new_instance['garages-max-value'] : '';
			$instance['agent-options']         = ! empty( $new_instance['agent-options'] ) ? $new_instance['agent-options'] : '';
			$instance['agent-display-type']    = ! empty( $new_instance['agent-display-type'] ) ? $new_instance['agent-display-type'] : '';
			$instance['agency-options']        = ! empty( $new_instance['agency-options'] ) ? $new_instance['agency-options'] : '';
			$instance['agency-display-type']   = ! empty( $new_instance['agency-display-type'] ) ? $new_instance['agency-display-type'] : '';
			$instance['property-id']           = ! empty( $new_instance['property-id'] ) ? $new_instance['property-id'] : '';
			$instance['additional-fields']     = ! empty( $new_instance['additional-fields'] ) ? $new_instance['additional-fields'] : '';

			return $instance;
		}
	}
}

if ( ! function_exists( 'register_properties_filter_widget' ) ) {

	// Register Properties_Filter_Widget widget
	function register_properties_filter_widget() {
		register_widget( 'Properties_Filter_Widget' );
	}

	add_action( 'widgets_init', 'register_properties_filter_widget' );

}