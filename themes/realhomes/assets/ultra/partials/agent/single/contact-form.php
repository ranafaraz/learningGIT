<?php
/**
 * Agent Contact Form
 *
 * Contact form for the agent.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

$agent_id    = get_the_ID();
$agent_email = get_post_meta( $agent_id, 'REAL_HOMES_agent_email', true );

if ( inspiry_get_agent_custom_form() ) {
	inspiry_agent_custom_form();
} else if ( is_email( $agent_email ) ) {
	$form_name_label    = esc_html__( 'Name', 'framework' );
	$form_email_label   = esc_html__( 'Email', 'framework' );
	$form_number_label  = esc_html__( 'Phone', 'framework' );
	$form_message_label = esc_html__( 'Message', 'framework' );
	?>
    <div class="rh-ultra-form">
        <form id="agent-single-form" class="contact-form agent-contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
            <div class="rh-ultra-fields-split">
                <div class="rh-ultra-form-field">
                    <label for="name"><?php echo esc_html( $form_name_label ); ?></label>
                    <p class="rh-ultra-form-field-wrapper">
                        <label><?php inspiry_safe_include_svg( '/ultra/icons/user.svg', '/assets/' ); ?></label>
                        <input type="text" name="name" id="name" class="required rh-ultra-field" placeholder="<?php esc_attr_e( 'Your Name', 'framework' ); ?>" title="<?php esc_attr_e( '* Please provide your name', 'framework' ); ?>">
                    </p>
                </div>
                <div class="rh-ultra-form-field">
                    <label for="number"><?php echo esc_html( $form_number_label ); ?></label>
                    <p class="rh-ultra-form-field-wrapper">
                        <label><?php inspiry_safe_include_svg( '/ultra/icons/phone.svg', '/assets/' ); ?></label>
                        <input type="text" name="number" id="number" class="rh-ultra-field" placeholder="<?php esc_attr_e( 'Your Phone', 'framework' ); ?>">
                    </p>
                </div>
            </div>
            <div class="rh-ultra-form-field">
                <label for="email"><?php echo esc_html( $form_email_label ); ?></label>
                <p class="rh-ultra-form-field-wrapper">
                    <label><?php inspiry_safe_include_svg( '/ultra/icons/email.svg', '/assets/' ); ?></label>
                    <input type="text" name="email" id="email" class="email required rh-ultra-field" placeholder="<?php esc_attr_e( 'Your Email', 'framework' ); ?>" title="<?php esc_attr_e( '* Please provide a valid email address', 'framework' ); ?>">
                </p>
            </div>
            <div class="rh-ultra-form-field">
                <label for="message"><?php echo esc_html( $form_message_label ); ?></label>
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
                    <div class="rh_contact__input rh_contact__input_recaptcha inspiry-recaptcha-wrapper g-recaptcha-type-<?php echo esc_attr( $recaptcha_type ); ?>">
                        <div class="inspiry-google-recaptcha"></div>
                    </div>
					<?php
				}
			}
			?>
            <div class="rh-ultra-submit-wrapper">
                <input type="hidden" name="action" value="send_message_to_agent" />
                <input type="hidden" name="agent_id" value="<?php echo esc_attr( $agent_id ); ?>">
                <input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'agent_message_nonce' ) ); ?>" />
                <input type="hidden" name="target" value="<?php echo esc_attr( antispambot( $agent_email ) ); ?>">
                <button type="submit" name="submit" class="submit-button rh-btn rh-btn-primary"><?php esc_html_e( 'Send Message', 'framework' ); ?></button>
                <span class="ajax-loader rh-ultra-ajax-loader"><?php inspiry_safe_include_svg( '/icons/ball-triangle.svg' ); ?></span>
            </div>
            <div id="error-container" class="error-container"></div>
            <div id="message-container" class="message-container"></div>
        </form>
    </div>
	<?php
}
