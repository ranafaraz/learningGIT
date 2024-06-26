<?php
/**
 * Schedule a tour for single property
 *
 * @since      4.0.0
 * @subpackage modern
 *
 * @package    realhomes
 */

if ( realhomes_display_schedule_a_tour() ) {

	$property_id = get_the_ID();

	$section_title = get_option( 'realhomes_schedule_a_tour_title' );
	if ( empty( $section_title ) ) {
		$section_title = esc_html__( 'Schedule A Tour', 'framework' );
	}

	// getting schedule times for property
	$tour_times = get_post_meta( $property_id, 'ere_property_schedule_time_slots', true );
	if ( empty( $tour_times ) ) {
		// getting global schedule tour times in case the property specific are not set
		$tour_times = get_option( 'realhomes_schedule_time_slots' );
	}
	$tour_times_array     = explode( ',', $tour_times );
	$current_tours        = get_post_meta( $property_id, 'ere_current_approved_tours', true );
	$date_placeholder     = get_option( 'realhomes_sat_date_placeholder', esc_html__( 'Select Date', 'framework' ) );
	$in_person_label      = get_option( 'realhomes_sat_type_in_person_label', esc_html__( 'In Person', 'framework' ) );
	$video_chat_label     = get_option( 'realhomes_sat_type_video_chat_label', esc_html__( 'Video Chat', 'framework' ) );
	$name_placeholder     = get_option( 'realhomes_sat_name_placeholder', esc_html__( 'Your Name', 'framework' ) );
	$phone_placeholder    = get_option( 'realhomes_sat_phone_placeholder', esc_html__( 'Your Phone', 'framework' ) );
	$email_placeholder    = get_option( 'realhomes_sat_email_placeholder', esc_html__( 'Your Email', 'framework' ) );
	$message_placeholder  = get_option( 'realhomes_sat_message_placeholder', esc_html__( 'Message', 'framework' ) );
	$schedule_button_text = get_option( 'realhomes_sat_button_text', esc_html__( 'Schedule', 'framework' ) );
	$schedule_description = get_post_meta( $property_id, 'ere_property_schedule_description', true );
	if ( empty( $schedule_description ) ) {
		$schedule_description = get_option( 'realhomes_schedule_side_description' );
	}
	?>
    <div id="property-content-section-schedule-a-tour" class="property-content-section rh_property__sat_wrap">
        <h4 class="rh_property__heading rh_property__sat-heading"><?php echo esc_html( $section_title ); ?></h4>
        <div class="rh_property__sat clearfix">
            <div class="sat_left_side">
                <form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="schedule-a-tour">
                    <div class="schedule-fields">
                        <div class="rh_sat_field">
                            <div class="rh_form__item">
                                <input type="text" name="sat-date" id="sat-date" class="required" placeholder="<?php echo esc_attr( $date_placeholder ); ?>" title="<?php esc_attr_e( 'Select a suitable date.', 'framework' ); ?>" autocomplete="off" required>
                            </div>
                        </div>

						<?php
						if ( is_array( $tour_times_array ) && ! empty( $tour_times_array[0] ) ) {
							?>
                            <div class="rh_sat_field">
                                <div class="rh_form__item">
                                    <select name="sat-time" class="sat_times inspiry_select_picker_trigger inspiry_bs_default_mod inspiry_bs_green show-tick">
										<?php
										foreach ( $tour_times_array as $tour_time ) {
											echo '<option value="' . esc_attr( $tour_time ) . '">' . esc_html( $tour_time ) . '</option>' . PHP_EOL;
										}
										?>
                                    </select>
                                </div>
                            </div>
							<?php
						}
						?>
                    </div>

                    <div class="rh_sat_field tour-type">
                        <div class="middle-fields">
                            <div class="tour-field in-person">
                                <input type="radio" id="sat-in-person" name="sat-tour-type" value="<?php echo esc_attr( $in_person_label ); ?>" checked>
                                <label for="sat-in-person"><?php echo esc_html( $in_person_label ); ?></label>
                            </div>
                            <div class="tour-field video-chat">
                                <input type="radio" id="sat-video-chat" name="sat-tour-type" value="<?php echo esc_attr( $video_chat_label ); ?>">
                                <label for="sat-video-chat"><?php echo esc_html( $video_chat_label ); ?></label>
                            </div>
                        </div>
                    </div>

                    <div class="user-info">
                        <div class="rh_sat_field user-name">
                            <div class="rh_form__item">
                                <input type="text" name="sat-user-name" class="required" placeholder="<?php echo esc_attr( $name_placeholder ); ?>" title="<?php esc_html_e( 'Provide your name', 'framework' ); ?>" required>
                            </div>
                        </div>
                        <div class="rh_sat_field user-phone">
                            <div class="rh_form__item">
                                <input type="text" name="sat-user-phone" placeholder="<?php echo esc_attr( $phone_placeholder ); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="user-info-full">
                        <div class="rh_sat_field user-email">
                            <div class="rh_form__item">
                                <input type="text" name="sat-user-email" class="required" placeholder="<?php echo esc_attr( $email_placeholder ); ?>" title="<?php esc_html_e( 'Provide your email ID', 'framework' ); ?>" required>
                            </div>
                        </div>
                        <div class="rh_sat_field user-message">
                            <div class="rh_form__item">
                                <textarea name="sat-user-message" placeholder="<?php echo esc_attr( $message_placeholder ); ?>"></textarea>
                            </div>
                        </div>
                    </div>

	                <?php
	                if (
		                get_option( 'inspiry_gdpr', false )
		                && get_option( 'realhomes_schedule_tour_GDPR_status', false )
		                && function_exists( 'ere_gdpr_agreement' )
	                ) {
		                ere_gdpr_agreement( array(
			                'id'              => 'sat-gdpr',
			                'container'       => 'div',
			                'container_class' => 'rh_sat_field gdpr-field',
			                'title_class'     => 'gdpr-checkbox-label'
		                ) );
	                }

	                if ( class_exists( 'Easy_Real_Estate' ) ) {
		                /* Display reCAPTCHA if enabled and configured from customizer settings */
		                if ( ere_is_reCAPTCHA_configured() ) {
			                $recaptcha_type = get_option( 'inspiry_reCAPTCHA_type', 'v2' );
			                ?>
                            <div class="rh_contact__input rh_contact__input_recaptcha inspiry-recaptcha-wrapper clearfix g-recaptcha-type-<?php echo esc_attr( $recaptcha_type ); ?>">
                                <div class="inspiry-google-recaptcha"></div>
                            </div>
			                <?php
		                }
	                }
	                ?>
                    <div class="submit-wrap">
                        <input type="hidden" name="action" value="schedule_a_tour" />
                        <input type="hidden" name="property-id" value="<?php echo esc_attr( $property_id ); ?>" />
                        <input type="hidden" name="sat-nonce" value="<?php echo esc_attr( wp_create_nonce( 'schedule_a_tour_nonce' ) ); ?>" />
                        <input type="submit" id="schedule-submit" class="submit-button rh-btn rh-btn-primary rh_widget_form__submit" value="<?php echo esc_attr( $schedule_button_text ); ?>" />
                        <span id="sat-loader"><?php inspiry_safe_include_svg( '/images/loader.svg' ); ?></span>
                    </div>
                    <div id="error-container"></div>
                    <div id="message-container"></div>
                </form>
            </div><!-- End of the left side -->

            <div class="sat_right_side property-info">
                <div class="sat_property-thumbnail">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'property-detail-video-image' );
					}
					?>
                </div>
                <div class="additional-info">
					<?php echo wp_kses_post( $schedule_description ); ?>
                </div>
            </div><!-- End of the right side -->

        </div><!-- End of .rh_property__sat -->
    </div>
	<?php
}