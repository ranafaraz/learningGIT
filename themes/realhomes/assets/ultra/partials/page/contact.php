<?php
/**
 * Displays contact template related stuff.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */
get_header();

$page_id = get_the_ID();

// Retrieve page meta.
$page_meta = get_post_custom( $page_id );
?>
    <div class="rh-page-container container">
		<?php
		get_template_part( 'assets/ultra/partials/page-head' );

		// Display page content area at top
		do_action( 'realhomes_content_area_at_top' );

		// Contact Map
		$show_contact_map = isset( $page_meta['theme_show_contact_map'] ) ? $page_meta['theme_show_contact_map'][0] : '';
		if ( $show_contact_map ) {
			?>
            <!-- Map Container Works for Both Google Maps and Open Street Maps -->
            <div class="rh-ultra-contact-map">
                <div id="map_canvas" class="rh-map-canvas"></div>
            </div>
			<?php
		}

		$show_details = isset( $page_meta['theme_show_details'] ) ? $page_meta['theme_show_details'][0] : '';
		if ( $show_details ) {
			$contact_address = isset( $page_meta['theme_contact_address'] ) ? stripslashes( $page_meta['theme_contact_address'][0] ) : '';
			$contact_cell    = isset( $page_meta['theme_contact_cell'] ) ? $page_meta['theme_contact_cell'][0] : '';
			$contact_phone   = isset( $page_meta['theme_contact_phone'] ) ? $page_meta['theme_contact_phone'][0] : '';
			$contact_fax     = isset( $page_meta['theme_contact_fax'] ) ? $page_meta['theme_contact_fax'][0] : '';
			$contact_email   = isset( $page_meta['theme_contact_display_email'] ) ? $page_meta['theme_contact_display_email'][0] : '';
			if ( ! empty( $contact_address ) || ! empty( $contact_cell ) || ! empty( $contact_phone ) || ! empty( $contact_fax ) || ! empty( $contact_email )
			) {
				?>
                <div class="rh-ultra-contact-details">
					<?php
					if ( ! empty( $contact_phone ) ) {
						?>
                        <div class="rh-ultra-contact-item">
							<?php inspiry_safe_include_svg( '/icons/phone.svg' ); ?>
                            <div class="content">
                                <a href="tel:<?php echo esc_attr( str_replace( ' ', '', $contact_phone ) ); ?>"><?php echo esc_html( $contact_phone ); ?></a>
                            </div>
                        </div>
						<?php
					}

					if ( ! empty( $contact_cell ) ) {
						?>
                        <div class="rh-ultra-contact-item">
							<?php inspiry_safe_include_svg( '/icons/cell.svg' ); ?>
                            <div class="content">
                                <a href="tel:<?php echo esc_attr( str_replace( ' ', '', $contact_cell ) ); ?>"><?php echo esc_html( $contact_cell ); ?></a>
                            </div>
                        </div>
						<?php
					}

					if ( ! empty( $contact_fax ) ) {
						?>
                        <div class="rh-ultra-contact-item">
							<?php inspiry_safe_include_svg( '/icons/print.svg' ); ?>
                            <div class="content">
                                <a href="fax:<?php echo esc_attr( str_replace( ' ', '', $contact_fax ) ); ?>"><?php echo esc_html( $contact_fax ); ?></a>
                            </div>
                        </div>
						<?php
					}

					if ( ! empty( $contact_address ) ) {
						?>
                        <div class="rh-ultra-contact-item rh-contact-item-address">
							<?php inspiry_safe_include_svg( '/icons/pin-line.svg' ); ?>
                            <div class="content">
								<?php echo inspiry_kses( $contact_address ); ?>
                            </div>
                        </div>
						<?php
					}

					if ( ! empty( $contact_email ) ) {
						?>
                        <div class="rh-ultra-contact-item">
							<?php inspiry_safe_include_svg( '/icons/email.svg' ); ?>
                            <div class="content">
                                <a href="mailto:<?php echo esc_attr( antispambot( $contact_email ) ); ?>"><?php echo esc_html( antispambot( $contact_email ) ); ?></a>
                            </div>
                        </div>
						<?php
					}
					?>
                </div><!-- /.rh-ultra-contact-details -->
				<?php
			}
		}

		// Contact Form
		if ( empty( $page_meta['realhomes_show_contact_form'][0] ) || 'hide' !== $page_meta['realhomes_show_contact_form'][0] ) {
			?>
            <div class="rh-ultra-contact-form">
				<?php
				if ( isset( $page_meta['inspiry_contact_form_shortcode'] ) && ! empty( $page_meta['inspiry_contact_form_shortcode'][0] ) ) {
					// Contact Form Shortcode
					echo do_shortcode( $page_meta['inspiry_contact_form_shortcode'][0] );
				} else {
					// Default Contact Form.
					if ( isset( $page_meta['theme_contact_email'] ) && ! empty( $page_meta['theme_contact_email'][0] ) ) {
						$name_label                 = isset( $page_meta['theme_contact_form_name_label'] ) ? $page_meta['theme_contact_form_name_label'][0] : '';
						$email_label                = isset( $page_meta['theme_contact_form_email_label'] ) ? $page_meta['theme_contact_form_email_label'][0] : '';
						$number_label               = isset( $page_meta['theme_contact_form_number_label'] ) ? $page_meta['theme_contact_form_number_label'][0] : '';
						$message_label              = isset( $page_meta['theme_contact_form_message_label'] ) ? $page_meta['theme_contact_form_message_label'][0] : '';
						$contact_form_name_label    = empty( $name_label ) ? esc_html__( 'Name', 'framework' ) : $name_label;
						$contact_form_email_label   = empty( $email_label ) ? esc_html__( 'Email', 'framework' ) : $email_label;
						$contact_form_number_label  = empty( $number_label ) ? esc_html__( 'Phone', 'framework' ) : $number_label;
						$contact_form_message_label = empty( $message_label ) ? esc_html__( 'Message', 'framework' ) : $message_label;
						?>
                        <div class="rh-ultra-form rh-ultra-form-contact-us">
                            <form id="contact-form" class="contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
                                <div class="rh-ultra-fields-split">
                                    <div class="rh-ultra-form-field">
                                        <label for="name"><?php echo esc_html( $contact_form_name_label ); ?></label>
                                        <p class="rh-ultra-form-field-wrapper">
                                            <label><?php inspiry_safe_include_svg( '/ultra/icons/user.svg', '/assets/' ); ?></label>
                                            <input type="text" name="name" id="name" class="required rh-ultra-field" placeholder="<?php esc_attr_e( 'Your Name', 'framework' ); ?>" title="<?php esc_attr_e( '* Please provide your name', 'framework' ); ?>">
                                        </p>
                                    </div>
                                    <div class="rh-ultra-form-field">
                                        <label for="number"><?php echo esc_html( $contact_form_number_label ); ?></label>
                                        <p class="rh-ultra-form-field-wrapper">
                                            <label><?php inspiry_safe_include_svg( '/ultra/icons/phone.svg', '/assets/' ); ?></label>
                                            <input type="text" name="number" id="number" class="rh-ultra-field" placeholder="<?php esc_attr_e( 'Your Phone', 'framework' ); ?>">
                                        </p>
                                    </div>
                                </div>
                                <div class="rh-ultra-form-field">
                                    <label for="email"><?php echo esc_html( $contact_form_email_label ); ?></label>
                                    <p class="rh-ultra-form-field-wrapper">
                                        <label><?php inspiry_safe_include_svg( '/ultra/icons/email.svg', '/assets/' ); ?></label>
                                        <input type="text" name="email" id="email" class="email required rh-ultra-field" placeholder="<?php esc_attr_e( 'Your Email', 'framework' ); ?>" title="<?php esc_attr_e( '* Please provide a valid email address', 'framework' ); ?>">
                                    </p>
                                </div>
                                <div class="rh-ultra-form-field">
                                    <label for="message"><?php echo esc_html( $contact_form_message_label ); ?></label>
                                    <p class="rh-ultra-form-field-wrapper rh-ultra-form-textarea">
                                        <label><?php inspiry_safe_include_svg( '/ultra/icons/message.svg', '/assets/' ); ?></label>
                                        <textarea cols="40" rows="6" name="message" id="message" class="required rh-ultra-field" placeholder="<?php esc_attr_e( 'Your Message', 'framework' ); ?>" title="<?php esc_attr_e( '* Please provide your message', 'framework' ); ?>"></textarea>
                                    </p>
                                </div>
								<?php
								if ( function_exists( 'ere_gdpr_agreement' ) ) {
									ere_gdpr_agreement( array(
										'id'              => 'inspiry-gdpr',
										'container'       => 'p',
										'container_class' => 'rh-inspiry-gdpr',
										'title_class'     => 'gdpr-checkbox-label'
									) );
								}

								if ( class_exists( 'Easy_Real_Estate' ) ) {
									// Display reCAPTCHA if enabled and configured from customizer settings
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
                                <div class="rh-ultra-submit-wrapper">
                                    <input type="hidden" name="action" value="send_message" />
                                    <input type="hidden" name="the_id" value="<?php echo esc_attr( $page_id ); ?>" />
                                    <input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'send_message_nonce' ) ); ?>" />
                                    <button type="submit" name="submit" class="submit-button rh-btn rh-btn-primary"><?php esc_html_e( 'Send Message', 'framework' ); ?></button>
                                    <span class="ajax-loader rh-ultra-ajax-loader"><?php inspiry_safe_include_svg( '/icons/ball-triangle.svg' ); ?></span>
                                </div>
                                <div id="error-container" class="error-container"></div>
                                <div id="message-container" class="message-container"></div>
                            </form>
                        </div>
						<?php
					}
				}
				?>
            </div>
			<?php
		}

		if ( isset( $page_meta['REAL_HOMES_hide_partners'][0] ) && '1' !== $page_meta['REAL_HOMES_hide_partners'][0] ) {
			get_template_part( 'assets/ultra/partials/partners' );
		}
		// Display page content area at bottom
		do_action( 'realhomes_content_area_at_bottom' );
		?>
    </div><!-- .rh-page-container -->
<?php
get_footer();