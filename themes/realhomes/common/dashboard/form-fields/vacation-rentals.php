<div class="dashboard-tab-content form-fields" data-content-title="<?php esc_html_e( 'Vacation Rentals', 'framework' ); ?>">
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <p>
                <label for="rvr_guests_capacity"><?php esc_html_e( 'Guests Capacity', 'framework' ); ?>
                    <span><?php esc_html_e( 'Example: 4', 'framework' ); ?></span>
                </label>
				<?php
				$guests_capacity = '';
				if ( realhomes_dashboard_edit_property() ) {
					global $post_meta_data;
					if ( isset( $post_meta_data['rvr_guests_capacity'] ) ) {
						$guests_capacity = $post_meta_data['rvr_guests_capacity'][0];
					}
				} else if ( isset( $_GET['rvr_guests_capacity'] ) && ! empty( $_GET['rvr_guests_capacity'] ) ) {
					$guests_capacity = $_GET['rvr_guests_capacity'];
				}
				?>
                <input id="rvr_guests_capacity" name="rvr_guests_capacity" type="text" value="<?php echo esc_attr( $guests_capacity ); ?>" />
            </p>
        </div>
        <div class="col-md-6 col-lg-4">
            <p>
                <label for="rvr_min_stay"><?php esc_html_e( 'Minimum Number of Nights to Stay', 'framework' ); ?>
                    <span><?php esc_html_e( 'Example: 1', 'framework' ); ?></span>
                </label>
				<?php
				$min_stay = '';
				if ( realhomes_dashboard_edit_property() ) {
					global $post_meta_data;
					if ( isset( $post_meta_data['rvr_min_stay'] ) ) {
						$min_stay = $post_meta_data['rvr_min_stay'][0];
					}
				}
				?>
                <input id="rvr_min_stay" name="rvr_min_stay" type="text" value="<?php echo esc_attr( $min_stay ); ?>" />
            </p>
        </div>
        <div class="col-md-6 col-lg-4">
            <p>
                <label for="rvr_govt_tax"><?php esc_html_e( 'Percentage of Govt Tax', 'framework' ); ?>
                    <span><?php esc_html_e( 'Example: 16', 'framework' ); ?></span>
                </label>
				<?php
				$gov_tax = '';
				if ( realhomes_dashboard_edit_property() ) {
					global $post_meta_data;
					if ( isset( $post_meta_data['rvr_govt_tax'] ) ) {
						$gov_tax = $post_meta_data['rvr_govt_tax'][0];
					}
				}
				?>
                <input id="rvr_govt_tax" name="rvr_govt_tax" type="text" value="<?php echo esc_attr( $gov_tax ); ?>" />
            </p>
        </div>
        <div class="col-md-6 col-lg-4">
            <p>
                <label for="rvr_service_charges"><?php esc_html_e( 'Percentage of Service Charges', 'framework' ); ?>
                    <span><?php esc_html_e( 'Example: 3', 'framework' ); ?></span>
                </label>
				<?php
				$service_charges = '';
				if ( realhomes_dashboard_edit_property() ) {
					global $post_meta_data;
					if ( isset( $post_meta_data['rvr_service_charges'] ) ) {
						$service_charges = $post_meta_data['rvr_service_charges'][0];
					}
				}
				?>
                <input id="rvr_service_charges" name="rvr_service_charges" type="text" value="<?php echo esc_attr( $service_charges ); ?>" />
            </p>
        </div>
        <div class="col-md-6 col-lg-4">
            <p>
                <label for="rvr_property_owner"><?php esc_html_e( 'Owner', 'framework' ); ?></label>
                <select name="rvr_property_owner" id="rvr_property_owner" class="inspiry_select_picker_trigger show-tick" title="<?php esc_attr_e( 'None', 'framework' ) ?>">
					<?php
					if ( realhomes_dashboard_edit_property() ) {
						global $post_meta_data;
						if ( isset( $post_meta_data['rvr_property_owner'] ) ) {
							generate_posts_list( 'owner', $post_meta_data['rvr_property_owner'] );
						} else {
							generate_posts_list( 'owner' );
						}
					} else {
						generate_posts_list( 'owner' );
					}
					?>
                </select>
            </p>
        </div>
    </div>

    <div class="inspiry-repeater-wrapper">
        <label class="label-boxed"><?php esc_html_e( 'Reserve Booking Dates', 'framework' ); ?></label>
        <div class="inspiry-repeater-header">
            <p class="reservation-note"><?php esc_html_e( 'Reservation Note', 'framework' ); ?></p>
            <p class="start-date"><?php esc_html_e( 'Start Date', 'framework' ); ?></p>
            <p class="end-date"><?php esc_html_e( 'End Date', 'framework' ); ?></p>
        </div>
        <div id="inspiry-repeater-container-rvr-reserve-booking-dates" class="inspiry-repeater-container">
			<?php
			$rvr_reserved_booking_dates_fields = array(
				array( 'name' => 'rvr_custom_reserved_dates[0][rvr_reserve_note]', 'class' => 'rvr_reserve_note' ),
				array( 'name' => 'rvr_custom_reserved_dates[0][rvr_reserve_start_date]', 'class' => 'rvr_reserve_start_date' ),
				array( 'name' => 'rvr_custom_reserved_dates[0][rvr_reserve_end_date]', 'class' => 'rvr_reserve_end_date' )
			);

			if ( realhomes_dashboard_edit_property() ) {
				global $target_property;

				$rvr_reserved_booking_dates = get_post_meta( $target_property->ID, 'rvr_custom_reserved_dates', true );
				if ( ! empty( $rvr_reserved_booking_dates ) ) {
					// Remove empty values.
					$rvr_reserved_booking_dates = array_filter( $rvr_reserved_booking_dates );
				}

				if ( ! empty( $rvr_reserved_booking_dates ) ) {
					foreach ( $rvr_reserved_booking_dates as $key => $rvr_reserved_booking_date ) {

						// Reservation Note
						$rvr_reserved_booking_dates_fields[0]['name']  = 'rvr_custom_reserved_dates[' . $key . '][rvr_reserve_note]';
						$rvr_reserved_booking_dates_fields[0]['value'] = $rvr_reserved_booking_date['rvr_reserve_note'];

						// Reservation Start Date
						$rvr_reserved_booking_dates_fields[1]['name']  = 'rvr_custom_reserved_dates[' . $key . '][rvr_reserve_start_date]';
						$rvr_reserved_booking_dates_fields[1]['value'] = $rvr_reserved_booking_date['rvr_reserve_start_date'];

						// Rservation End Date
						$rvr_reserved_booking_dates_fields[2]['name']  = 'rvr_custom_reserved_dates[' . $key . '][rvr_reserve_end_date]';
						$rvr_reserved_booking_dates_fields[2]['value'] = $rvr_reserved_booking_date['rvr_reserve_end_date'];

						inspiry_repeater_group( $rvr_reserved_booking_dates_fields, false, $key );

					}
				} else {
					inspiry_repeater_group( $rvr_reserved_booking_dates_fields );
				}
			} else {
				inspiry_repeater_group( $rvr_reserved_booking_dates_fields );
			}
			?>
        </div>
        <button class="inspiry-repeater-add-field-btn btn btn-primary">
            <i class="fas fa-plus"></i><?php esc_attr_e( 'Add More', 'framework' ); ?>
        </button>
    </div>

    <div class="inspiry-repeater-wrapper">
        <label class="label-boxed"><?php esc_html_e( 'Seasonal Prices', 'framework' ); ?></label>
        <div class="inspiry-repeater-header">
            <p class="start-date"><?php esc_html_e( 'Start Date', 'framework' ); ?></p>
            <p class="end-date"><?php esc_html_e( 'End Date', 'framework' ); ?></p>
            <p class="seasonal-price"><?php esc_html_e( 'Price', 'framework' ); ?></p>
        </div>
        <div id="inspiry-repeater-container-rvr-seasonal-prices" class="inspiry-repeater-container">
			<?php
			$rvr_seasonal_prices_fields = array(
				array( 'name' => 'rvr_custom_seasonal_prices[0][rvr_price_start_date]', 'class' => 'rvr_seasonal_start_date' ),
				array( 'name' => 'rvr_custom_seasonal_prices[0][rvr_price_end_date]', 'class' => 'rvr_seasonal_end_date' ),
				array( 'name' => 'rvr_custom_seasonal_prices[0][rvr_price_amount]', 'class' => 'rvr_seasonal_price' )
			);

			if ( realhomes_dashboard_edit_property() ) {
				global $target_property;

				$rvr_seasonal_prices = get_post_meta( $target_property->ID, 'rvr_seasonal_pricing', true );
				if ( ! empty( $rvr_seasonal_prices ) ) {
					// Remove empty values.
					$rvr_seasonal_prices = array_filter( $rvr_seasonal_prices );
				}

				if ( ! empty( $rvr_seasonal_prices ) ) {
					foreach ( $rvr_seasonal_prices as $key => $rvr_seasonal_price ) {

						// Seasonal Price Start Date
						$rvr_seasonal_prices_fields[0]['name']  = 'rvr_custom_seasonal_prices[' . $key . '][rvr_price_start_date]';
						$rvr_seasonal_prices_fields[0]['value'] = $rvr_seasonal_price['rvr_price_start_date'];

						// Seasonal Price End Date
						$rvr_seasonal_prices_fields[1]['name']  = 'rvr_custom_seasonal_prices[' . $key . '][rvr_price_end_date]';
						$rvr_seasonal_prices_fields[1]['value'] = $rvr_seasonal_price['rvr_price_end_date'];

						// Seasonal Price Field
						$rvr_seasonal_prices_fields[2]['name']  = 'rvr_custom_seasonal_prices[' . $key . '][rvr_price_amount]';
						$rvr_seasonal_prices_fields[2]['value'] = $rvr_seasonal_price['rvr_price_amount'];

						inspiry_repeater_group( $rvr_seasonal_prices_fields, false, $key );

					}
				} else {
					inspiry_repeater_group( $rvr_seasonal_prices_fields );
				}
			} else {
				inspiry_repeater_group( $rvr_seasonal_prices_fields );
			}
			?>
        </div>
        <button class="inspiry-repeater-add-field-btn btn btn-primary">
            <i class="fas fa-plus"></i><?php esc_attr_e( 'Add More', 'framework' ); ?>
        </button>
    </div>

    <div class="inspiry-repeater-wrapper">
        <label class="label-boxed"><?php esc_html_e( 'Outdoor Features', 'framework' ); ?></label>
        <div id="inspiry-repeater-container-rvr-outdoor-features" class="inspiry-repeater-container">
			<?php
			$rvr_outdoor_features_fields = array( array( 'name' => 'rvr_outdoor_features[]' ) );

			if ( realhomes_dashboard_edit_property() ) {
				global $target_property;

				$rvr_outdoor_features = get_post_meta( $target_property->ID, 'rvr_outdoor_features', true );
				if ( ! empty( $rvr_outdoor_features ) ) {
					// Remove empty values.
					$rvr_outdoor_features = array_filter( $rvr_outdoor_features );
				}

				if ( ! empty( $rvr_outdoor_features ) ) {
					foreach ( $rvr_outdoor_features as $key => $rvr_outdoor_feature ) {
						$rvr_outdoor_features_fields[0]['value'] = $rvr_outdoor_feature;
						inspiry_repeater_group( $rvr_outdoor_features_fields, false, $key );
					}
				} else {
					inspiry_repeater_group( $rvr_outdoor_features_fields );
				}
			} else {
				inspiry_repeater_group( $rvr_outdoor_features_fields );
			}
			?>
        </div>
        <button class="inspiry-repeater-add-field-btn btn btn-primary">
            <i class="fas fa-plus"></i><?php esc_attr_e( 'Add More', 'framework' ); ?>
        </button>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="inspiry-repeater-wrapper">
                <label class="label-boxed"><?php esc_html_e( 'What is included', 'framework' ); ?></label>
                <div id="inspiry-repeater-container-rvr-included" class="inspiry-repeater-container">
					<?php
					$rvr_included_fields = array( array( 'name' => 'rvr_included[]' ) );

					if ( realhomes_dashboard_edit_property() ) {
						global $target_property;

						$rvr_included = get_post_meta( $target_property->ID, 'rvr_included', true );
						if ( ! empty( $rvr_included ) ) {
							// Remove empty values.
							$rvr_included = array_filter( $rvr_included );
						}

						if ( ! empty( $rvr_included ) ) {
							foreach ( $rvr_included as $key => $rvr_included_field ) {
								$rvr_included_fields[0]['value'] = $rvr_included_field;
								inspiry_repeater_group( $rvr_included_fields, false, $key );
							}
						} else {
							inspiry_repeater_group( $rvr_included_fields );
						}
					} else {
						inspiry_repeater_group( $rvr_included_fields );
					}
					?>
                </div>
                <button class="inspiry-repeater-add-field-btn btn btn-primary">
                    <i class="fas fa-plus"></i><?php esc_attr_e( 'Add More', 'framework' ); ?>
                </button>
            </div>
        </div>
        <div class="col-md-6">
            <div class="inspiry-repeater-wrapper">
                <label class="label-boxed"><?php esc_html_e( 'What is not included', 'framework' ); ?></label>
                <div id="inspiry-repeater-container-rvr-not-included" class="inspiry-repeater-container">
					<?php
					$rvr_not_included_fields = array( array( 'name' => 'rvr_not_included[]' ) );

					if ( realhomes_dashboard_edit_property() ) {
						global $target_property;

						$rvr_not_included = get_post_meta( $target_property->ID, 'rvr_not_included', true );
						if ( ! empty( $rvr_not_included ) ) {
							// Remove empty values.
							$rvr_not_included = array_filter( $rvr_not_included );
						}

						if ( ! empty( $rvr_not_included ) ) {
							foreach ( $rvr_not_included as $key => $rvr_not_included_field ) {
								$rvr_not_included_fields[0]['value'] = $rvr_not_included_field;
								inspiry_repeater_group( $rvr_not_included_fields, false, $key );
							}
						} else {
							inspiry_repeater_group( $rvr_not_included_fields );
						}
					} else {
						inspiry_repeater_group( $rvr_not_included_fields );
					}
					?>
                </div>
                <button class="inspiry-repeater-add-field-btn btn btn-primary">
                    <i class="fas fa-plus"></i><?php esc_attr_e( 'Add More', 'framework' ); ?>
                </button>
            </div>
        </div>
    </div>

    <div class="inspiry-repeater-wrapper">
        <label class="label-boxed"><?php esc_html_e( 'Property Surroundings', 'framework' ); ?></label>
        <div class="inspiry-repeater-header">
            <p class="title"><?php esc_html_e( 'Point of Interest', 'framework' ); ?></p>
            <p class="value"><?php esc_html_e( 'Distance or How to approach', 'framework' ); ?></p>
        </div>
        <div id="inspiry-repeater-container-rvr-surroundings" class="inspiry-repeater-container">
			<?php
			$rvr_surroundings_fields = array(
				array( 'name' => 'rvr_surroundings[0][rvr_surrounding_point]' ),
				array( 'name' => 'rvr_surroundings[0][rvr_surrounding_point_distance]' )
			);

			if ( realhomes_dashboard_edit_property() ) {
				global $target_property;

				$rvr_surroundings = get_post_meta( $target_property->ID, 'rvr_surroundings', true );
				if ( ! empty( $rvr_surroundings ) ) {
					// Remove empty values.
					$rvr_surroundings = array_filter( $rvr_surroundings );
				}

				if ( ! empty( $rvr_surroundings ) ) {
					foreach ( $rvr_surroundings as $key => $rvr_surrounding ) {
						$rvr_surroundings_fields[0]['name']  = 'rvr_surroundings[' . $key . '][rvr_surrounding_point]';
						$rvr_surroundings_fields[0]['value'] = $rvr_surrounding['rvr_surrounding_point'];
						$rvr_surroundings_fields[1]['name']  = 'rvr_surroundings[' . $key . '][rvr_surrounding_point_distance]';
						$rvr_surroundings_fields[1]['value'] = $rvr_surrounding['rvr_surrounding_point_distance'];
						inspiry_repeater_group( $rvr_surroundings_fields, false, $key );
					}
				} else {
					inspiry_repeater_group( $rvr_surroundings_fields );
				}
			} else {
				inspiry_repeater_group( $rvr_surroundings_fields );
			}
			?>
        </div>
        <button class="inspiry-repeater-add-field-btn btn btn-primary">
            <i class="fas fa-plus"></i><?php esc_attr_e( 'Add More', 'framework' ); ?>
        </button>
    </div>

    <div class="inspiry-repeater-wrapper">
        <label class="label-boxed"><?php esc_html_e( 'Property Policies or Rules', 'framework' ); ?></label>
        <div class="inspiry-repeater-header">
            <p class="title"><?php esc_html_e( 'Policy Text', 'framework' ); ?></p>
            <p class="value"><?php esc_html_e( 'Font Awesome Icon (i.e far fa-star)', 'framework' ); ?></p>
        </div>
        <div id="inspiry-repeater-container-rvr-policies" class="inspiry-repeater-container">
			<?php
			$rvr_policies_fields = array(
				array( 'name' => 'rvr_policies[0}][rvr_policy_detail]' ),
				array( 'name' => 'rvr_policies[0}][rvr_policy_icon]' )
			);

			if ( realhomes_dashboard_edit_property() ) {
				global $target_property;

				$rvr_policies = get_post_meta( $target_property->ID, 'rvr_policies', true );
				if ( ! empty( $rvr_policies ) ) {
					// Remove empty values.
					$rvr_policies = array_filter( $rvr_policies );
				}

				if ( ! empty( $rvr_policies ) ) {
					foreach ( $rvr_policies as $key => $rvr_policy ) {
						$rvr_policies_fields[0]['name']  = 'rvr_policies[' . $key . '][rvr_policy_detail]';
						$rvr_policies_fields[0]['value'] = $rvr_policy['rvr_policy_detail'];
						$rvr_policies_fields[1]['name']  = 'rvr_policies[' . $key . '][rvr_policy_icon]';
						$rvr_policies_fields[1]['value'] = $rvr_policy['rvr_policy_icon'];
						inspiry_repeater_group( $rvr_policies_fields, false, $key );
					}
				} else {
					inspiry_repeater_group( $rvr_policies_fields );
				}
			} else {
				inspiry_repeater_group( $rvr_policies_fields );
			}
			?>
        </div>
        <button class="inspiry-repeater-add-field-btn btn btn-primary">
            <i class="fas fa-plus"></i><?php esc_attr_e( 'Add More', 'framework' ); ?>
        </button>
    </div>

    <div class="inspiry-repeater-wrapper">
        <label class="label-boxed"><?php esc_html_e( 'iCalendar Export', 'framework' ); ?></label>

		<?php
		// iCalendar import & export fields.
		if ( realhomes_dashboard_edit_property() ) {
			$icalendar_export_url = rvr_get_property_icalendar_export_url( $target_property->ID );

			if ( ! empty( $icalendar_export_url ) ) {
				$icalendar_file_url = rvr_get_property_icalendar_ics_file_url( $target_property->ID );

				$icalendar_data = '<strong>' . esc_html__( 'Feed URL', 'framework' ) . ':</strong> <code>' . esc_url( $icalendar_export_url ) . '</code>';
				$icalendar_data .= '<br><br>';
				$icalendar_data .= '<strong>' . esc_html__( 'File URL', 'framework' ) . ':</strong> <code>' . esc_url( $icalendar_file_url ) . '</code>';

				echo $icalendar_data;
			}
		} else {
			echo '<code>' . esc_html__( 'You must submit the property to retrieve the iCalendar export information.', 'framework' ) . '</code>';
		}
		?>
    </div>

    <div class="inspiry-repeater-wrapper">
        <label class="label-boxed"><?php esc_html_e( 'iCalendar Import', 'framework' ); ?></label>
        <div class="inspiry-repeater-header">
            <p class="title"><?php esc_html_e( 'Feed Name', 'framework' ); ?></p>
            <p class="value"><?php esc_html_e( 'Feed URL', 'framework' ); ?></p>
        </div>
        <div id="inspiry-repeater-container-rvr-icalendar" class="inspiry-repeater-container">
			<?php
            // Default array of icalendar fields
			$icalendar_fields = array(
				array( 'name' => 'rvr_import_icalendar_feed_list[0][feed_name]' ),
				array( 'name' => 'rvr_import_icalendar_feed_list[0][feed_url]' )
			);

			if ( realhomes_dashboard_edit_property() ) {
				global $target_property;

				$icalendar_imports = get_post_meta( $target_property->ID, 'rvr_import_icalendar_feed_list', true );
				if ( ! empty( $icalendar_imports ) ) {
					// Remove empty values.
					$icalendar_imports = array_values( array_filter( $icalendar_imports ) );
				}

				if ( ! empty( $icalendar_imports ) && is_array( $icalendar_imports ) ) {
					foreach ( $icalendar_imports as $key => $icalendar_import ) {
						$icalendar_fields[0]['name']  = 'rvr_import_icalendar_feed_list[' . $key . '][feed_name]';
						$icalendar_fields[0]['value'] = $icalendar_import['feed_name'];
						$icalendar_fields[1]['name']  = 'rvr_import_icalendar_feed_list[' . $key . '][feed_url]';
						$icalendar_fields[1]['value'] = $icalendar_import['feed_url'];
						inspiry_repeater_group( $icalendar_fields, false, $key );
					}
				} else {
					inspiry_repeater_group( $icalendar_fields );
				}
			} else {
				inspiry_repeater_group( $icalendar_fields );
			}
			?>
        </div>
        <button class="inspiry-repeater-add-field-btn btn btn-primary">
            <i class="fas fa-plus"></i><?php esc_attr_e( 'Add More', 'framework' ); ?>
        </button>
    </div>

</div>
