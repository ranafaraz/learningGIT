<?php
/**
* This file contains the login & password reset forms for login/register page template.
*
* @since      4.0.2
* @package    realhomes
* @subpackage ultra
*/
?>
<div class="rh_form__login">
    <form id="rh_modal__login_form" class="rh_form__form rh-form" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" enctype="multipart/form-data">
        <p>
            <label class="info-text"><?php esc_html_e( 'Already a Member? Log in here.', 'framework' ); ?></label>
        </p>
        <p>
            <label for="username"><?php esc_html_e( 'Username', 'framework' ); ?><span>*</span></label>
            <input autocomplete="username" id="username" name="log" type="text" class="required" title="<?php esc_html_e( '* Provide username!', 'framework' ); ?>" autofocus required />
        </p>
        <p>
            <label for="password"><?php esc_html_e( 'Password', 'framework' ); ?><span>*</span></label>
            <input autocomplete="current-password" id="password" name="pwd" type="password" class="required" title="<?php esc_html_e( '* Provide password!', 'framework' ); ?>" required />
        </p>
		<?php
		if ( class_exists( 'Easy_Real_Estate' ) ) {
			if ( ere_is_reCAPTCHA_configured() ) {
				$recaptcha_type = get_option( 'inspiry_reCAPTCHA_type', 'v2' );
				if ( 'v2' === $recaptcha_type ) {
					?>
                    <p><?php get_template_part( 'common/google-reCAPTCHA/google-reCAPTCHA' ); ?></p>
					<?php
				} else {
					get_template_part( 'common/google-reCAPTCHA/google-reCAPTCHA' );
				}
			}
		}

		// nonce for security.
		wp_nonce_field( 'inspiry-ajax-login-nonce', 'inspiry-secure-login' );
		?>
        <p class="rh_form_buttons">
            <input type="hidden" name="action" value="inspiry_ajax_login" />
            <input type="hidden" name="redirect_to" value="<?php echo esc_url( inspiry_get_login_redirect_Url() ); ?>" />
            <input type="hidden" name="user-cookie" value="1" />
            <button type="submit" id="login-button" class="rh_btn rh_btn--primary"><?php esc_html_e( 'Login', 'framework' ); ?></button>
        </p>
        <div class="rh_form__response">
            <p id="login-message" class="rh_form__msg"></p>
            <p id="login-error" class="rh_form__error"></p>
        </div>
        <p class="forgot-password">
            <a class="toggle-forgot-form" href="#"><?php esc_html_e( 'Forgot password!', 'framework' ) ?></a>
        </p>
    </form>

    <form id="rh_modal__forgot_form" class="rh-form" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" enctype="multipart/form-data">
        <p>
            <label for="reset_username_or_email"><?php esc_html_e( 'Username or Email', 'framework' ); ?><span>*</span></label>
            <input id="reset_username_or_email" name="reset_username_or_email" type="text" class="required" title="<?php esc_html_e( '* Provide username or email!', 'framework' ); ?>" required />
        </p>
		<?php
		if ( class_exists( 'Easy_Real_Estate' ) ) {
			if ( ere_is_reCAPTCHA_configured() ) {
				$recaptcha_type = get_option( 'inspiry_reCAPTCHA_type', 'v2' );
				if ( 'v2' === $recaptcha_type ) {
					?>
                    <p><?php get_template_part( 'common/google-reCAPTCHA/google-reCAPTCHA' ); ?></p>
					<?php
				} else {
					get_template_part( 'common/google-reCAPTCHA/google-reCAPTCHA' );
				}
			}
		}
		?>
        <p class="rh_form_buttons">
			<?php wp_nonce_field( 'inspiry-ajax-forgot-nonce', 'inspiry-secure-reset' ); ?>
            <input type="hidden" name="action" value="inspiry_ajax_forgot" />
            <input type="hidden" name="user-cookie" value="1" />
            <input type="submit" id="forgot-button" name="user-submit" value="<?php esc_html_e( 'Reset Password', 'framework' ); ?>" class="rh_btn rh_btn--secondary" />
        </p>
        <div class="rh_form__response">
            <p id="forgot-message" class="rh_form__msg"></p>
            <p id="forgot-error" class="rh_form__error"></p>
        </div>
    </form>
</div><!-- /.rh_form__login -->