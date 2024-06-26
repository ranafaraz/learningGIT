<?php
$show_rvr_booking_form = get_option( 'realhomes_property_single_display_booking_form', 'true' );
$booking_form_title    = get_option( 'realhomes_property_single_booking_form_title', esc_html__( 'Request a booking', 'framework' ) );
$property_id           = get_the_ID();

// Custom labels for the form
$name_label             = get_option( 'realhomes_booking_form_name_label', esc_html__( 'Name', 'framework' ) );
$name_placeholder       = get_option( 'realhomes_booking_form_name_placeholder', '' );
$email_label            = get_option( 'realhomes_booking_form_email_label', esc_html__( 'Email', 'framework' ) );
$email_placeholder      = get_option( 'realhomes_booking_form_email_placeholder', '' );
$phone_label            = get_option( 'realhomes_booking_form_phone_label', esc_html__( 'Phone', 'framework' ) );
$phone_placeholder      = get_option( 'realhomes_booking_form_phone_placeholder', '' );
$checkin_label          = get_option( 'realhomes_booking_form_checkin_label', esc_html__( 'Check In', 'framework' ) );
$checkin_placeholder    = get_option( 'realhomes_booking_form_checkin_placeholder', '' );
$checkout_label         = get_option( 'realhomes_booking_form_checkout_label', esc_html__( 'Check Out', 'framework' ) );
$checkout_placeholder   = get_option( 'realhomes_booking_form_checkout_placeholder', '' );
$email_error_message    = get_option( 'realhomes_booking_form_email_error_message', esc_html__( '* Email is required', 'framework' ) );
$checkin_error_message  = get_option( 'realhomes_booking_form_checkin_error_message', esc_html__( '* Check In date is required', 'framework' ) );
$checkout_error_message = get_option( 'realhomes_booking_form_checkout_error_message', esc_html__( '* Check Out date is required', 'framework' ) );
$adults_label           = get_option( 'realhomes_booking_form_adults_label', esc_html__( 'Adults', 'framework' ) );
$children_label         = get_option( 'realhomes_booking_form_children_label', esc_html__( 'Children', 'framework' ) );
$infants_label          = get_option( 'realhomes_booking_form_infants_label', esc_html__( 'Infants', 'framework' ) );
$payable_label          = get_option( 'realhomes_booking_form_payable_label', esc_html__( 'Payable', 'framework' ) );
$show_details_label     = get_option( 'realhomes_booking_form_show_details_label', esc_html__( '(Show Details)', 'framework' ) );
$hide_details_label     = get_option( 'realhomes_booking_form_hide_details_label', esc_html__( '(Hide Details)', 'framework' ) );
$submit_label           = get_option( 'realhomes_booking_form_submit_label', esc_html__( 'Submit', 'framework' ) );

// RVR - property booking form
if ( inspiry_is_rvr_enabled() && 'true' === $show_rvr_booking_form ) {
	?>
    <div class="rvr-booking-form-wrap single-booking-section">

        <h4 class="rh_property__heading"><?php echo esc_html( $booking_form_title ); ?></h4>

        <form class="rvr-booking-form" method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">

            <div class="field-wrap three-col">
                <label for="rvr-user-name"><?php echo esc_html( $name_label ); ?></label>
                <input id="rvr-user-name" type="text" class="form-control rh-ultra-field" name="user_name" placeholder="<?php echo esc_attr( $name_placeholder ); ?>">
            </div>

            <div class="field-wrap three-col">
                <div class="rh-ultra-form-field">
                    <label for="rvr-email"><?php echo esc_html( $email_label ); ?></label>
                    <input id="rvr-email" type="text" name="email" class="form-control rh-ultra-field required" placeholder="<?php echo esc_attr( $email_placeholder ); ?>" title="<?php echo esc_attr( $email_error_message ); ?>">
                </div>
            </div>

            <div class="field-wrap three-col">
                <label for="rvr-phone"><?php echo esc_html( $phone_label ); ?></label>
                <input id="rvr-phone" type="text" class="form-control rh-ultra-field" name="phone" placeholder="<?php echo esc_attr( $phone_placeholder ); ?>">
            </div>

            <div class="field-wrap four-col">
                <label for="rvr-check-in-booking"><?php echo esc_html( $checkin_label ); ?></label>
                <input id="rvr-check-in-booking" type="text" name="check_in" class="form-control rh-ultra-field rvr-check-in required" placeholder="<?php echo esc_attr( $checkin_placeholder ); ?>" title="<?php echo esc_attr( $checkin_error_message ); ?>" autocomplete="off">
            </div>

            <div class="field-wrap four-col">
                <label for="rvr-check-out-booking"><?php echo esc_html( $checkout_label ); ?></label>
                <input id="rvr-check-out-booking" type="text" name="check_out" class="form-control rh-ultra-field rvr-check-out required" placeholder="<?php echo esc_attr( $checkout_placeholder ); ?>" title="<?php echo esc_attr( $checkout_error_message ); ?>" autocomplete="off">
            </div>

			<?php
			$max_guests   = 10;
			$rvr_settings = get_option( 'rvr_settings' );

			if ( ! empty( $rvr_settings['max_guests'] ) ) {
				$max_guests = intval( $rvr_settings['max_guests'] );
			}
			?>
            <div class="field-wrap six-col">
                <label for="rvr-adult-"><?php echo esc_html( $adults_label ); ?></label>
                <select id="rvr-adult-" name="adult" class="rvr-adult rh-ultra-field inspiry_select_picker_trigger inspiry_bs_green show-tick">
					<?php
					for ( $num = 1; $num <= $max_guests; $num += 1 ) {
						echo "<option value='{$num}'>{$num}</option>";
					}
					?>
                </select>
            </div>

            <div class="field-wrap six-col">
                <label for="rvr-child-"><?php echo esc_html( $children_label ); ?></label>
                <select id="rvr-child-" name="child" class="rvr-child rh-ultra-field inspiry_select_picker_trigger inspiry_bs_green show-tick">
					<?php
					for ( $num = 0; $num <= $max_guests; $num += 1 ) {
						echo "<option value='{$num}'>{$num}</option>";
					}
					?>
                </select>
            </div>

            <div class="field-wrap infants six-col">
                <label for="rvr-infant-"><?php echo esc_html( $infants_label ); ?></label>
                <select id="rvr-infant-" name="infant" class="rvr-infant rh-ultra-field inspiry_select_picker_trigger inspiry_bs_green show-tick">
					<?php
					for ( $num = 0; $num <= $max_guests; $num += 1 ) {
						echo "<option value='{$num}'>{$num}</option>";
					}
					?>
                </select>
            </div>

	        <?php
	        // Additional fees calculation fields display.
	        $additional_amenities = get_post_meta( $property_id, 'rvr_additional_amenities', true );
	        if ( ! empty( $additional_amenities ) && is_array( $additional_amenities ) ) {

		        $amenities_counter = 1;
		        foreach ( $additional_amenities as $additional_amenity ) {

			        if ( ! empty( $additional_amenity['amenity_label'] ) && ! empty( $additional_amenity['amenity_price'] ) ) {
				        $amenity_label     = $additional_amenity['amenity_label'];
				        $amenity_price     = $additional_amenity['amenity_price'];
				        $price_calculation = $additional_amenity['price_calculation'];

				        switch ( $additional_amenity['price_calculation'] ) {
					        case 'per_night':
						        $price_info_label = esc_html__( 'per night', 'framework' );
						        break;
					        case 'per_guest':
						        $price_info_label = esc_html__( 'per guest', 'framework' );
						        break;
					        case 'per_night_guest':
						        $price_info_label = esc_html__( 'per night per guest', 'framework' );
						        break;
					        default:
						        $price_info_label = 'per stay';
				        }

				        if ( $amenities_counter === 1 ) {
					        ?>
                            <div class="rvr-additional-amenities">
					        <?php
				        }
				        ?>
                        <div class="amenity-field <?php echo sanitize_key( $amenity_label ); ?>-amenity-field">
                            <div class="amenity-desc">
                                <label for="<?php echo sanitize_key( $amenity_label ); ?>-amenity">
                                    <input id="<?php echo sanitize_key( $amenity_label ); ?>-amenity" name="<?php echo sanitize_key( $amenity_label ); ?>" data-label="<?php echo esc_attr( $amenity_label ); ?>" data-calculation="<?php echo esc_attr( $price_calculation ); ?>" data-amount="<?php echo floatVal( $amenity_price ); ?>" type="checkbox" value="<?php echo floatVal( $amenity_price ); ?>">
                                    <span><?php echo esc_html( $amenity_label ); ?></span>
                                </label>
                            </div>
                            <div class="amenity-price"><?php echo rhea_get_custom_price( $amenity_price ) . ' <span>' . esc_html( $price_info_label ) . '</span>'; ?></div>
                        </div>
				        <?php
				        $amenities_counter++;
			        }
		        } // ending foreach

		        if ( $amenities_counter > 1 ) {
			        ?>
                    </div>
			        <?php
		        }
	        }
	        ?>
            <div class="booking-cost">

                <!-- Booking payable amount field -->
                <div class="cost-field total-price-field">
                    <div class="cost-desc">
                        <strong><?php echo esc_html( $payable_label ); ?></strong>
                        <a class="rvr-show-details" data-alt-label="<?php echo esc_attr( $hide_details_label ); ?>"><?php echo esc_attr( $show_details_label ); ?></a>
                    </div>
                    <div class="cost-value"></div>
                </div>

                <!-- Booking cost details -->
                <div class="booking-cost-details">
                    <span class="close-button">x</span>
                    <div class="cost-field staying-nights-count-field">
                        <div class="cost-desc"><?php esc_html_e( 'Staying Nights', 'framework' ); ?></div>
                        <div class="cost-value"></div>
                    </div>
                    <div class="cost-field staying-nights-field">
                        <div class="cost-desc"><?php esc_html_e( 'Price For Staying Nights', 'framework' ); ?></div>
                        <div class="cost-value"></div>
                    </div>
					<?php
					// Additional fees calculation fields display.
					$additional_fees = get_post_meta( $property_id, 'rvr_additional_fees', true );
					if ( ! empty( $additional_fees ) && is_array( $additional_fees ) ) {
						foreach ( $additional_fees as $additional_fee ) {
							if ( ! empty( $additional_fee['rvr_fee_label'] ) && ! empty( $additional_fee['rvr_fee_amount'] ) ) {
								?>
                                <div class="cost-field <?php echo sanitize_key( $additional_fee['rvr_fee_label'] ); ?>-fee-field">
                                    <div class="cost-desc"><?php echo esc_html( $additional_fee['rvr_fee_label'] );
										echo ( 'percentage' === $additional_fee['rvr_fee_type'] ) ? ' <span>' . intVal( $additional_fee['rvr_fee_amount'] ) . '%</span>' : ''; ?></div>
                                    <div class="cost-value"></div>
                                </div>
								<?php
							}
						}
					}

					// Additional amenities calculation fields display.
					$additional_amenities = get_post_meta( $property_id, 'rvr_additional_amenities', true );
					if ( ! empty( $additional_amenities ) && is_array( $additional_amenities ) ) {
						foreach ( $additional_amenities as $additional_amenity ) {
							if ( ! empty( $additional_amenity['amenity_label'] ) && ! empty( $additional_amenity['amenity_price'] ) ) {
								?>
                                <div class="cost-field <?php echo sanitize_key( $additional_amenity['amenity_label'] ); ?>-amenity-field">
                                    <div class="cost-desc"><?php echo esc_html( $additional_amenity['amenity_label'] ); ?></div>
                                    <div class="cost-value"></div>
                                </div>
								<?php
							}
						}
					}

					// Guests capacity extension.
					$guests_capacity   = get_post_meta( $property_id, 'rvr_guests_capacity', true );
					$book_child_as     = get_post_meta( $property_id, 'rvr_book_child_as', true );
					$extra_guests      = get_post_meta( $property_id, 'rvr_guests_capacity_extend', true );
					$extra_guest_price = get_post_meta( $property_id, 'rvr_extra_guest_price', true );

					if ( 'allowed' === $extra_guests && ! empty( $extra_guest_price ) ) {
						?>
                        <div class="cost-field extra-guests-field">
                            <div class="cost-desc"><?php echo esc_html__( 'Extra Guests' ); ?>
                                <span>0</span></div>
                            <div class="cost-value"></div>
                        </div>
						<?php
					}

					// Govt tax and service charges percentages.
					$service_charges_percentage = get_post_meta( $property_id, 'rvr_service_charges', true );
					$govt_tax_percentage        = get_post_meta( $property_id, 'rvr_govt_tax', true );

					if ( ! empty( $service_charges_percentage ) ) {
						?>
                        <div class="cost-field services-charges-field">
                            <div class="cost-desc"><?php esc_html_e( 'Services Charges', 'framework' ); ?>
                                <span><?php echo floatval( $service_charges_percentage ); ?>%</span>
                            </div>
                            <div class="cost-value"></div>
                        </div>
						<?php
					}

					if ( ! empty( $govt_tax_percentage ) ) {
						?>
                        <div class="cost-field subtotal-price-field">
                            <div class="cost-desc">
                                <strong><?php esc_html_e( 'Subtotal', 'framework' ); ?></strong>
                            </div>
                            <div class="cost-value"></div>
                        </div>
                        <div class="cost-field govt-tax-field">
                            <div class="cost-desc"><?php esc_html_e( 'Government Taxes', 'framework' ); ?>
                                <span><?php echo floatval( $govt_tax_percentage ); ?>%</span></div>
                            <div class="cost-value"></div>
                        </div>
						<?php
					}
					?>
                    <div class="cost-field total-price-field">
                        <div class="cost-desc">
                            <strong><?php esc_html_e( 'Total Price', 'framework' ); ?></strong>
                        </div>
                        <div class="cost-value"></div>
                    </div>
                </div><!-- End of .booking-cost-details -->
            </div><!-- End of .booking-cost -->
            <div class="submission-area clearfix">
				<?php
				$additional_fees = get_post_meta( $property_id, 'rvr_additional_fees', true );
				if ( ! empty( $additional_fees ) && is_array( $additional_fees ) ) {
					echo '<div class="rvr-additional-fees">';
					foreach ( $additional_fees as $additional_fee ) {
						if ( ! empty( $additional_fee['rvr_fee_label'] ) && ! empty( $additional_fee['rvr_fee_amount'] ) ) {
							?>
                            <input type="hidden" name="<?php echo sanitize_key( $additional_fee['rvr_fee_label'] ); ?>" data-label="<?php echo esc_attr( $additional_fee['rvr_fee_label'] ); ?>" data-type="<?php echo esc_attr( $additional_fee['rvr_fee_type'] ); ?>" data-calculation="<?php echo esc_attr( $additional_fee['rvr_fee_calculation'] ); ?>" data-amount="<?php echo esc_html( $additional_fee['rvr_fee_amount'] ); ?>" />
							<?php
						}
					}
					echo '</div>';
				}

				// Property pricing flag if seasonal are available.
				$seasonal_prices  = get_post_meta( $property_id, 'rvr_seasonal_prices_table', true );
				$property_pricing = 'flat';
				if ( ! empty( $seasonal_prices ) && is_array( $seasonal_prices ) ) {
					$property_pricing = 'seasonal';
				}

				// Bulk prices data.
				$bulk_prices = get_post_meta( $property_id, 'rvr_bulk_pricing', true );
				if ( is_array( $bulk_prices ) && ! empty( $bulk_prices ) ) {
					sort( $bulk_prices );

					$bulk_price_pairs = array();
					foreach ( $bulk_prices as $bulk_price ) {
						if ( ! empty( $bulk_price['number_of_nights'] ) && ! empty( $bulk_price['number_of_nights'] ) ) {
							$bulk_price_pairs[ $bulk_price['number_of_nights'] ] = $bulk_price['price_per_night'];
						}
					}
					?>
                    <input type="hidden" name="bulk_prices" class="bulk-prices" value="<?php echo esc_html( htmlspecialchars( wp_json_encode( $bulk_price_pairs ) ) ); ?>" />
					<?php
				}

				if ( $rvr_settings['rvr_terms_info'] && ! empty( $rvr_settings['rvr_terms_anchor_text'] ) ) {
					?>
                    <div class="field-wrap full-width rvr-terms-conditions">
                        <input id="rvr-terms-conditions" type="checkbox" name="terms_conditions" class="required" title="<?php esc_html_e( 'Please accept the terms and conditions.', 'realhomes-vacation-rentals' ); ?>">
                        <label for="rvr-terms-conditions">
                            <span><?php echo wp_kses( $rvr_settings['rvr_terms_anchor_text'], wp_kses_allowed_html( 'post' ) ); ?></span>
                        </label>
                    </div>
					<?php
				}

				if ( function_exists( 'ere_is_reCAPTCHA_configured' ) && ere_is_reCAPTCHA_configured() ) {
					?>
                    <div class="rvr-reCAPTCHA-wrapper inspiry-recaptcha-wrapper clearfix g-recaptcha-type-<?php echo esc_attr( get_option( 'inspiry_reCAPTCHA_type', 'v2' ) ); ?>">
                        <div class="inspiry-google-recaptcha"></div>
                    </div>
					<?php
				}
				?>
                <input type="hidden" name="guests_capacity" class="guests-capacity" value="<?php echo esc_html( $guests_capacity ); ?>" />
                <input type="hidden" name="book_child_as" class="book-child-as" value="<?php echo esc_html( $book_child_as ); ?>" />
                <input type="hidden" name="extra_guests" class="extra-guests" value="<?php echo esc_html( $extra_guests ); ?>" />
                <input type="hidden" name="extra_guest_price" class="per-extra-guest-price" value="<?php echo esc_html( $extra_guest_price ); ?>" />
                <input type="hidden" name="property_pricing" class="property-pricing" value="<?php echo esc_attr( $property_pricing ); ?>" />
                <input type="hidden" name="property_id" class="property-id" value="<?php echo $property_id; ?>" />
                <input type="hidden" name="price_per_night" class="price-per-night" value="<?php echo intval( get_post_meta( $property_id, 'REAL_HOMES_property_price', true ) ); ?>" />
                <input type="hidden" name="service_charges" class="service-charges" value="<?php echo floatval( get_post_meta( $property_id, 'rvr_service_charges', true ) ); ?>" />
                <input type="hidden" name="govt_charges" class="govt-charges" value="<?php echo floatval( get_post_meta( $property_id, 'rvr_govt_tax', true ) ); ?>" />
                <input type="hidden" name="action" value="rvr_booking_request" />
                <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'rvr_booking_request' ); ?>" />
                <div class="rvr-booking-button-wrapper">
                    <input type="submit" value="<?php echo esc_attr( $submit_label ); ?>" class="rvr-booking-button rh-ultra-filled-button rh-ultra-button submit-button">
                    <span class="rvr-ajax-loader"><?php include INSPIRY_THEME_DIR . '/images/loading-bars.svg'; ?></span>
                </div>
                <div class="rvr-message-container"></div>
                <div class="rvr-error-container"></div>
            </div>
        </form>
    </div>
	<?php
}