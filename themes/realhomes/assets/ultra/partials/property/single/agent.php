<?php
/**
 * Agent of the single property.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

/**
 * A function that works as re-usable template
 *
 * @param array $args - agent box arguments.
 */
function display_agent_box( $args ) {
	$theme_display_agent_contact_info     = get_option( 'theme_display_agent_contact_info', 'true' );
	$theme_display_agent_description      = get_option( 'theme_display_agent_description', 'true' );
	$theme_display_agent_detail_page_link = get_option( 'theme_display_agent_detail_page_link', 'true' );
	$inspiry_property_agent_form          = get_option( 'inspiry_property_agent_form', 'true' );
	$agent_section_classes                = '';

	if ( 'false' === $theme_display_agent_contact_info ) {
		$agent_section_classes .= ' no-agent-contact-info';
	}

	if ( 'false' === $theme_display_agent_description ) {
		$agent_section_classes .= ' no-agent-description';
	}

	if ( 'false' === $theme_display_agent_detail_page_link ) {
		$agent_section_classes .= ' no-agent-know-more-btn';
	}

	if ( 'false' === $inspiry_property_agent_form ) {
		$agent_section_classes .= ' no-agent-contact-form';
	}

	$agent_section_classes .= ' ' . realhomes_printable_section( 'agent', false );
	?>
    <section class="rh-ultra-property-detail-agent rh_property_agent<?php echo esc_attr( $agent_section_classes ); ?> <?php echo esc_attr( ( ! empty( $args['agent_class'] ) ) ? $args['agent_class'] : '' ); ?>">
		<?php
		$realhomes_agent_section_title = get_option( 'realhomes_agent_section_title' );
		if ( ! empty( $realhomes_agent_section_title ) ) {
			?><h4 class="rh_property__heading"><?php echo esc_html( $realhomes_agent_section_title ); ?></h4><?php
		}
		?>
        <div class="rh-ultra-property-agent-info">
            <div class="rh-agent-thumb-title-wrapper">
                <!--            <div class="rh-side-thumb-box">-->
				<?php
				if ( isset( $args['display_author'] ) && ( $args['display_author'] ) ) {
					if ( isset( $args['profile_image_id'] ) && ( 0 < $args['profile_image_id'] ) ) :
						?>
                        <a class="agent-image" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
							<?php echo wp_get_attachment_image( $args['profile_image_id'], 'agent-image' ); ?>
                        </a>
					<?php
                    elseif ( isset( $args['agent_email'] ) ) :
						?>
                        <a class="agent-image" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
							<?php echo get_avatar( $args['agent_email'], '210' ); ?>
                        </a>
					<?php
					endif;
				} else if ( isset( $args['agent_id'] ) && ( ! empty( get_the_post_thumbnail( $args['agent_id'] ) ) ) ) {
					?>
                    <a class="agent-image" href="<?php echo esc_url( get_permalink( $args['agent_id'] ) ); ?>">
						<?php echo get_the_post_thumbnail( $args['agent_id'], 'agent-image' ); ?>
                    </a>
					<?php
				} else {
					?>
                    <a class="agent-image agent-property-placeholder" href="<?php echo esc_url( get_permalink( $args['agent_id'] ) ); ?>">
                        <i class="fas fa-user-tie"></i>
                    </a>
					<?php
				}

				if ( isset( $args['display_author'] ) && ( $args['display_author'] ) ) {
					$agent_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
				} else {
					$agent_url = get_permalink( $args['agent_id'] );
				}
				?>
                <!--            </div>-->
                <div class="rh-agent-title-wrapper">
                    <div class="rh-side-title-box">
						<?php
						if ( isset( $args['agent_label'] ) && ! empty( $args['agent_label'] ) ) {
							?>
                            <span class="rh-agent-label">
            <?php echo esc_html( $args['agent_label'] ) ?>
                  </span>
							<?php

						}

						if ( isset( $args['agent_title_text'] ) && ! empty( $args['agent_title_text'] ) ) {
							?>
                            <h3 class="rh_property_agent__title">
                                <a href="<?php echo esc_url( $agent_url ) ?>"><?php echo esc_html( $args['agent_title_text'] ); ?></a>
								<?php
								if ( 0 < intval( $args['agent_id'] ) ) {
									realhomes_verification_badge( 'agent', $args['agent_id'] );
								}
                                ?>
                            </h3>
							<?php
						}
						?>
                    </div>
					<?php
					if ( 'true' === $theme_display_agent_detail_page_link ) {
						$theme_agent_detail_page_link_text = get_option( 'theme_agent_detail_page_link_text', esc_html__( 'View My Listings', 'framework' ) );
						?>
                        <a class="rh-property-agent-link" href="<?php echo esc_url( $agent_url ) ?>"><?php echo esc_html( $theme_agent_detail_page_link_text ); ?></a>
						<?php
					}
					?>
                </div>
            </div>
			<?php if ( 'true' === $theme_display_agent_contact_info ) { ?>
                <div class="rh-property-agent-info-sidebar ">
					<?php
					if ( isset( $args['agent_office_phone'] ) && ! empty( $args['agent_office_phone'] ) ) {

						?>
                        <p class="contact office">
                            <span><?php esc_html_e( 'Office', 'framework' ); ?>:&nbsp;</span>
                            <a href="tel:<?php echo esc_html( $args['agent_office_phone'] ); ?>">
								<?php
								inspiry_safe_include_svg( '/ultra/icons/phone.svg', '/assets/' );
								echo esc_html( $args['agent_office_phone'] );
								?>
                            </a>
                        </p>
						<?php
					}
					if ( isset( $args['agent_mobile'] ) && ! empty( $args['agent_mobile'] ) ) {
						?>
                        <p class="contact mobile">
                            <span><?php esc_html_e( 'Mobile', 'framework' ); ?>:&nbsp;</span>
                            <a href="tel:<?php echo esc_html( $args['agent_mobile'] ); ?>">
								<?php
								inspiry_safe_include_svg( '/ultra/icons/phone.svg', '/assets/' );
								echo esc_html( $args['agent_mobile'] );
								?>
                            </a>
                        </p>
						<?php
					}
					if ( isset( $args['agent_office_fax'] ) && ! empty( $args['agent_office_fax'] ) ) {
						?>
                        <p class="contact fax">
                            <span><?php esc_html_e( 'Fax', 'framework' ); ?>:&nbsp;</span>
                            <a href="fax:<?php echo esc_html( $args['agent_office_fax'] ); ?>">
								<?php
								inspiry_safe_include_svg( '/ultra/icons/print.svg', '/assets/' );
								echo esc_html( $args['agent_office_fax'] );
								?>
                            </a>
                        </p>
						<?php
					}
					if ( isset( $args['agent_whatsapp'] ) && ! empty( $args['agent_whatsapp'] ) ) {
						?>
                        <p class="contact whatsapp">
                            <span><?php esc_html_e( 'WhatsApp', 'framework' ); ?>:&nbsp;</span>
                            <a href="https://wa.me/<?php echo esc_html( $args['agent_whatsapp'] ); ?>">
								<?php
								inspiry_safe_include_svg( '/ultra/icons/whatsapp.svg', '/assets/' );
								echo esc_html( $args['agent_whatsapp'] );
								?>
                            </a>
                        </p>
						<?php
					}
					if ( isset( $args['agent_email'] ) && ! empty( $args['agent_email'] ) ) {
						?>
                        <p class="contact email">
                            <span><?php esc_html_e( 'Email', 'framework' ); ?>:&nbsp;</span>
                            <a href="mailto:<?php echo esc_attr( antispambot( $args['agent_email'] ) ); ?>">
								<?php
								inspiry_safe_include_svg( '/ultra/icons/email.svg', '/assets/' );
								echo esc_html( antispambot( $args['agent_email'] ) );
								?>
                            </a>
                        </p>
						<?php
					}
					?>
                </div>
				<?php
			}
			?>
        </div>
		<?php
		if ( 'true' === $inspiry_property_agent_form ) :
			if ( inspiry_get_agent_custom_form( $args['agent_id'] ) ) :
				inspiry_agent_custom_form( $args['agent_id'] );
            elseif ( isset( $args['agent_email'] ) && ! empty( $args['agent_email'] ) ) :
				$agent_form_id = 'agent-form-id';
				if ( isset( $args['agent_id'] ) ) {
					$agent_form_id .= $args['agent_id'];
				}
				?>
                <div class="rh-property-agent-enquiry-form rh-ultra-form">
                    <form id="<?php echo esc_attr( $agent_form_id ); ?>" class="rh_widget_form agent-form" method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
                        <div class="rh-ultra-fields-split">
                            <p class="rh_widget_form__row rh-ultra-form-field-wrapper">
                                <label for="rh-enquiry-name">
									<?php inspiry_safe_include_svg( '/ultra/icons/user.svg', '/assets/' ); ?>
                                </label>
                                <input id="rh-enquiry-name" type="text" name="name" placeholder="<?php esc_html_e( 'Name', 'framework' ); ?>" class="required rh-ultra-field" title="<?php esc_html_e( '* Please provide your name', 'framework' ); ?>" />
                            </p>
                            <!-- /.rh_widget_form__row -->
                            <p class="rh_widget_form__row rh-ultra-form-field-wrapper">
                                <label for="rh-enquiry-email">
									<?php inspiry_safe_include_svg( '/ultra/icons/email.svg', '/assets/' ); ?>
                                </label>
                                <input id="rh-enquiry-email" type="text" name="email" placeholder="<?php esc_html_e( 'Email', 'framework' ); ?>" class="required rh-ultra-field" title="<?php esc_html_e( '* Please provide valid email address', 'framework' ); ?>" />
                            </p>
                        </div>
                        <!-- /.rh_widget_form__row -->
                        <p class="rh_widget_form__row rh-ultra-form-field-wrapper">
                            <label for="rh-enquiry-phone">
								<?php inspiry_safe_include_svg( '/ultra/icons/phone.svg', '/assets/' ); ?>
                            </label>
                            <input id="rh-enquiry-phone" type="text" name="phone" placeholder="<?php esc_html_e( 'Phone', 'framework' ); ?>" class="required rh-ultra-field" title="<?php esc_html_e( '* Please provide valid phone number', 'framework' ); ?>" />
                        </p>
                        <!-- /.rh_widget_form__row -->
                        <p class="rh_widget_form__row rh-ultra-form-field-wrapper rh-ultra-form-textarea">
                            <label for="rh-enquiry-message">
								<?php inspiry_safe_include_svg( '/ultra/icons/message.svg', '/assets/' ); ?>
                            </label>
                            <textarea id="rh-enquiry-message" cols="40" rows="6" name="message" placeholder="<?php esc_html_e( 'Message', 'framework' ); ?>" class="required rh-ultra-field" title="<?php esc_html_e( '* Please provide your message', 'framework' ); ?>"><?php
								printf( esc_textarea( realhomes_get_agent_default_message() ), esc_html( get_the_title( get_the_ID() ) ) );
								?></textarea>
                        </p>
                        <!-- /.rh_widget_form__row -->

						<?php
						if ( function_exists( 'ere_gdpr_agreement' ) ) {
							ere_gdpr_agreement( array(
								'id'              => 'rh_inspiry_gdpr',
								'container_class' => 'rh_inspiry_gdpr rh_widget_form__row',
								'title_class'     => 'gdpr-checkbox-label'
							) );
						}

						if ( class_exists( 'Easy_Real_Estate' ) ) {
							if ( ere_is_reCAPTCHA_configured() ) {
								$recaptcha_type = get_option( 'inspiry_reCAPTCHA_type', 'v2' );
								?>
                                <div class="rh_modal__recaptcha">
                                    <div class="inspiry-recaptcha-wrapper clearfix g-recaptcha-type-<?php echo esc_attr( $recaptcha_type ); ?>">
                                        <div class="inspiry-google-recaptcha"></div>
                                    </div>
                                </div>
								<?php
							}
						}
						?>

                        <input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'agent_message_nonce' ) ); ?>" />
                        <input type="hidden" name="target" value="<?php echo esc_attr( antispambot( $args['agent_email'] ) ); ?>">
						<?php
						if ( ! empty( $args['agent_id'] ) ) {
							?>
                            <input type="hidden" name="agent_id" value="<?php echo esc_attr( $args['agent_id'] ); ?>">
							<?php
						}
						if ( ! empty( $args['author_id'] ) ) {
							?>
                            <input type="hidden" name="author_id" value="<?php echo esc_attr( $args['author_id'] ) ?>">
							<?php
						}
						?>
                        <input type="hidden" name="author_name" value="<?php echo esc_attr( $args['agent_title_text'] ); ?>">
                        <input type="hidden" name="property_id" value="<?php echo esc_attr( get_the_ID() ) ?>">
                        <input type="hidden" name="action" value="send_message_to_agent" />
                        <input type="hidden" name="property_title" value="<?php echo esc_attr( get_the_title( get_the_ID() ) ); ?>" />
                        <input type="hidden" name="property_permalink" value="<?php echo esc_url_raw( get_permalink( get_the_ID() ) ); ?>" />

                        <button type="submit" name="submit" class="rh-ultra-filled-button rh-ultra-button submit-button">
                            <span class="btn-text"><?php esc_html_e( 'Send Message', 'framework' ); ?></span>
                            <span id="ajax-loader-<?php echo esc_attr( $agent_form_id ); ?>" class="ajax-loader"><?php inspiry_safe_include_svg( '/icons/ball-triangle.svg' ); ?></span>
                        </button>
                        <div class="error-container"></div>
                        <div class="message-container"></div>
                    </form>
                </div><!-- /.rh_property_agent__enquiry_form -->
			<?php endif; ?><?php endif; ?>
    </section>
	<?php
}

/**
 * Logic behind displaying agents / author information
 */
$display_agent_info   = get_option( 'theme_display_agent_info', 'true' );
$agent_display_option = get_post_meta( get_the_ID(), 'REAL_HOMES_agent_display_option', true );

if ( ( 'true' === $display_agent_info ) && ( 'none' != $agent_display_option ) ) {

	if ( 'my_profile_info' == $agent_display_option ) {

		$profile_args                        = array();
		$profile_args['display_author']      = true;
		$profile_args['agent_id']            = '';
		$profile_args['author_id']           = get_the_author_meta( 'ID' );
		$profile_args['author_display_name'] = get_the_author_meta( 'display_name' );
		$profile_args['agent_title_text']    = esc_html__( 'Submitted by', 'framework' ) . ' ' . get_the_author_meta( 'display_name' );
		$profile_args['profile_image_id']    = intval( get_the_author_meta( 'profile_image_id' ) );
		$profile_args['agents_count']        = 1;
		$profile_args['agent_mobile']        = get_the_author_meta( 'mobile_number' );
		$profile_args['agent_whatsapp']      = get_the_author_meta( 'mobile_whatsapp' );
		$profile_args['agent_office_phone']  = get_the_author_meta( 'office_number' );
		$profile_args['agent_office_fax']    = get_the_author_meta( 'fax_number' );
		$profile_args['agent_email']         = get_the_author_meta( 'user_email' );
		$profile_args['agent_description']   = get_framework_custom_excerpt( get_the_author_meta( 'description' ), 20 );
		display_agent_box( $profile_args );

	} else {

		$property_agents = get_post_meta( get_the_ID(), 'REAL_HOMES_agents' );
		// Remove invalid ids.
		$property_agents = array_filter( $property_agents, function ( $v ) {
			return ( $v > 0 );
		} );
		// Remove duplicated ids.
		$property_agents = array_unique( $property_agents );
		if ( ! empty( $property_agents ) ) {
			$agents_count = count( $property_agents );
			foreach ( $property_agents as $agent ) {
				if ( 0 < intval( $agent ) ) {
					$agent_args                       = array();
					$agent_args['agent_id']           = intval( $agent );
					$agent_args['agent_label']        = get_option( 'inspiry_property_agent_label', esc_html__( 'Agent', 'framework' ) );
					$agent_args['agents_count']       = $agents_count;
					$agent_args['agent_title_text']   = esc_html( get_the_title( $agent_args['agent_id'] ) );
					$agent_args['agent_mobile']       = get_post_meta( $agent_args['agent_id'], 'REAL_HOMES_mobile_number', true );
					$agent_args['agent_whatsapp']     = get_post_meta( $agent_args['agent_id'], 'REAL_HOMES_whatsapp_number', true );
					$agent_args['agent_office_phone'] = get_post_meta( $agent_args['agent_id'], 'REAL_HOMES_office_number', true );
					$agent_args['agent_office_fax']   = get_post_meta( $agent_args['agent_id'], 'REAL_HOMES_fax_number', true );
					$agent_args['agent_email']        = get_post_meta( $agent_args['agent_id'], 'REAL_HOMES_agent_email', true );

					/*
					 * Excerpt for agent is bit tricky as we have to get excerpt if available otherwise post contents
					 */
					$temp_agent_excerpt = get_post_field( 'post_excerpt', $agent_args['agent_id'] );
					if ( empty( $temp_agent_excerpt ) || is_wp_error( $temp_agent_excerpt ) ) {
						$agent_args['agent_excerpt'] = get_post_field( 'post_content', $agent_args['agent_id'] );
					} else {
						$agent_args['agent_excerpt'] = $temp_agent_excerpt;
					}

					$agent_args['agent_description'] = get_framework_custom_excerpt( $agent_args['agent_excerpt'], 20 );
					display_agent_box( $agent_args );
				}
			}
		}
	}
}
