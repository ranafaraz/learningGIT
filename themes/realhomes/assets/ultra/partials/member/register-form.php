<?php
/**
 * This file contains the register form for login/register page template.
 *
 * @since      4.0.2
 * @package    realhomes
 * @subpackage ultra
 */

if ( get_option( 'users_can_register' ) ) {
	?>
    <div class="rh_form__register">
        <form id="rh_modal__register_form" class="rh-form" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" enctype="multipart/form-data">
            <p>
                <label class="info-text"><?php esc_html_e( 'Do not have an account? Register here', 'framework' ); ?></label>
            </p>
            <p>
                <label for="register_username" class="hide"><?php esc_html_e( 'Username', 'framework' ); ?><span>*</span></label>
                <input id="register_username" name="register_username" type="text" class="required" title="<?php esc_html_e( '* Provide username!', 'framework' ); ?>" required />
            </p>
            <p>
                <label for="register_email" class="hide"><?php esc_html_e( 'Email', 'framework' ); ?><span>*</span></label>
                <input id="register_email" name="register_email" type="text" class="email required" title="<?php esc_html_e( '* Provide valid email address!', 'framework' ); ?>" required />
            </p>
			<?php
			/**
			 * Render custom user registration fields
			 */
			$user_fields = apply_filters( 'inspiry_additional_user_fields', array() );
			if ( is_array( $user_fields ) && ! empty( $user_fields ) ) {
				foreach ( $user_fields as $field ) {

					// Check if field is enabled for the Register Form
					if ( empty( $field['show'] ) || ! is_array( $field['show'] ) || ! in_array( 'register_form', $field['show'] ) ) {
						continue;
					}

					// Validate field data and render it
					if ( ! empty( $field['id'] ) && ! empty( $field['name'] ) ) {

						$required = false;
						if ( ! empty( $field['required'] ) && $field['required'] === true ) {
							$required = true;
						}

						?>
                        <p class="rh_form__row additional_user_fields">
                            <label for="<?php echo esc_attr( $field['id'] ); ?>" class="hide">
								<?php
								echo esc_html( $field['name'] );
								echo ( true === $required ) ? '<span>*</span>' : '';
								?>
                            </label>
							<?php
							if ( ! empty( $field['type'] ) && $field['type'] == 'select' && ! empty( $field['options'] ) && is_array( $field['options'] ) ) {
								?>
                                <select name="<?php echo esc_attr( $field['id'] ); ?>" id="<?php echo esc_attr( $field['id'] ); ?>"
									<?php
									echo ( ! empty( $field['title'] ) ) ? 'title="' . esc_attr( $field['title'] ) . '"' : '';
									echo ( true === $required ) ? 'class="required inspiry_select_picker_trigger inspiry_bs_default_mod inspiry_bs_green show-tick" required' : 'class="inspiry_select_picker_trigger inspiry_bs_default_mod inspiry_bs_green show-tick"';
									?>>
									<?php
									foreach ( $field['options'] as $key => $value ) {
										echo '<option value="' . esc_attr( $key ) . '">' . esc_html( $value ) . '</option>';
									}
									?>
                                </select>
								<?php
							} else {
								?>
                                <input type="text" id="<?php echo esc_attr( $field['id'] ); ?>" name="<?php echo esc_attr( $field['id'] ); ?>"
									<?php
									echo ( ! empty( $field['title'] ) ) ? 'title="' . esc_attr( $field['title'] ) . '"' : '';
									echo ( true === $required ) ? 'class="required" required' : '';
									?>
                                />
								<?php
							}
							?>
                        </p>
						<?php
					}
				}
			}

			$user_sync = inspiry_is_user_sync_enabled();
			if ( 'true' == $user_sync ) {
				$user_roles = inspiry_user_sync_roles();
				if ( ! empty( $user_roles ) && is_array( $user_roles ) ) {
					?>
                    <p class="rh_user_role">
                        <label for="user-role" class="hide"><?php esc_html_e( 'User Role', 'framework' ); ?>
                            <span>*</span></label>
                        <select name="user_role" id="user-role" class="inspiry_select_picker_trigger inspiry_bs_default_mod inspiry_bs_green show-tick">
                            <option value=""><?php esc_html_e( 'User Role', 'framework' ); ?></option>
							<?php
							foreach ( $user_roles as $key => $value ) {
								echo '<option value="' . esc_attr( $key ) . '">' . esc_html( $value ) . '</option>';
							}
							?>
                        </select>
                    </p>
					<?php
				}
			}

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
                <input type="hidden" name="user-cookie" value="1" />
                <input type="hidden" name="action" value="inspiry_ajax_register" />
		        <?php
		        // Nonce for security.
		        wp_nonce_field( 'inspiry-ajax-register-nonce', 'inspiry-secure-register' );
		        ?>
                <input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url( '/' ) ); ?>" />
                <input type="submit" id="register-button" name="user-submit" value="<?php esc_html_e( 'Register', 'framework' ); ?>" class="rh_btn rh_btn--secondary" />
            </p>
            <div class="rh_form__response">
                <p id="register-message" class="rh_form__msg"></p>
                <p id="register-error" class="rh_form__error"></p>
            </div>
        </form>
    </div><!-- /.rh_form__register -->
	<?php
}