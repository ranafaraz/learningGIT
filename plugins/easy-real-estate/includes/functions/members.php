<?php
/**
 * Members related functions.
 */
if ( ! function_exists( 'ere_ajax_reset_password' ) ) {
	/**
	 * AJAX reset password request handler
	 */
	function ere_ajax_reset_password() {

		// First check the nonce, if it fails the function will break
		check_ajax_referer( 'inspiry-ajax-forgot-nonce', 'inspiry-secure-reset' );

		if ( class_exists( 'Easy_Real_Estate' ) ) {
			/* Verify Google reCAPTCHA */
			ere_verify_google_recaptcha();
		}

		$account = $_POST['reset_username_or_email'];
		$error   = "";
		$get_by  = "";

		if ( empty( $account ) ) {
			$error = esc_html__( 'Provide a valid username or email address!', 'easy-real-estate' );
		} else {
			if ( is_email( $account ) ) {
				if ( email_exists( $account ) ) {
					$get_by = 'email';
				} else {
					$error = esc_html__( 'No user found for given email!', 'easy-real-estate' );
				}
			} else if ( validate_username( $account ) ) {
				if ( username_exists( $account ) ) {
					$get_by = 'login';
				} else {
					$error = esc_html__( 'No user found for given username!', 'easy-real-estate' );
				}
			} else {
				$error = esc_html__( 'Invalid username or email!', 'easy-real-estate' );
			}
		}

		if ( empty ( $error ) ) {

			// Generate new random password
			$random_password = wp_generate_password();

			// Get user data by field ( fields are id, slug, email or login )
			$target_user = get_user_by( $get_by, $account );

			$update_user = wp_update_user( array(
				'ID'        => $target_user->ID,
				'user_pass' => $random_password
			) );

			// if  update_user return true then send user an email containing the new password
			if ( $update_user ) {

				$to = $target_user->user_email;

				/*
				 * The blogname option is escaped with esc_html on the way into the database in sanitize_option
				 * we want to reverse this for the plain text arena of emails.
				 */
				$website_name = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );

				$subject = sprintf( esc_html__( 'Your New Password For %s', 'easy-real-estate' ), $website_name );

				$message   = array();
				$message[] = array(
					'name'  => esc_html__( 'Your New Password', 'easy-real-estate' ),
					'value' => $random_password
				);
				$message   = ere_email_template( $message, 'inspiry_password_reset_form' );

				/*
			     * Email Headers ( Reply To and Content Type )
			     */
				$headers   = array();
				$headers[] = "Content-Type: text/html; charset=UTF-8";
				$headers   = apply_filters( "inspiry_password_reset_header", $headers );    // just in case if you want to modify the header in child theme

				$mail = wp_mail( $to, $subject, $message, $headers );

				if ( $mail ) {
					$success = esc_html__( 'Check your email for new password', 'easy-real-estate' );
				} else {
					$error = esc_html__( 'Failed to send you new password email!', 'easy-real-estate' );
				}

			} else {
				$error = esc_html__( 'Oops! Something went wrong while resetting your password!', 'easy-real-estate' );
			}
		}

		if ( ! empty( $error ) ) {
			echo json_encode(
				array(
					'success' => false,
					'message' => $error
				)
			);
		} else if ( ! empty( $success ) ) {
			echo json_encode(
				array(
					'success' => true,
					'message' => $success
				)
			);
		}

		die();
	}

	// Enable the user with no privileges to request ajax password reset
	add_action( 'wp_ajax_nopriv_inspiry_ajax_forgot', 'ere_ajax_reset_password' );
}

if ( ! function_exists( 'ere_new_user_notification' ) ) {
	/**
	 * Email confirmation email to newly-registered user.
	 *
	 * A new user registration notification is sent to admin email
	 *
	 * @param $user_id
	 * @param $user_password
	 */
	function ere_new_user_notification( $user_id, $user_password ) {

		$user            = get_userdata( $user_id );
		$email_templates = ere_get_email_templates();

		// The blogname option is escaped with esc_html on the way into the database in sanitize_option
		// we want to reverse this for the plain text arena of emails.
		$blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );

		$headers = array( 'Content-Type: text/html; charset=UTF-8' );
		$headers = apply_filters( 'inspiry_registration_notification_mail_header', $headers );

		// Admin Email
		$admin_message = array();

		$admin_message[] = array(
			'name'  => '',
			'value' => esc_html__( 'A new user is registered on your site with the following information.', 'easy-real-estate' ),
		);

		$admin_message[] = array(
			'name'  => esc_html__( 'Username', 'easy-real-estate' ),
			'value' => $user->user_login,
		);

		$admin_message[] = array(
			'name'  => esc_html__( 'Email', 'easy-real-estate' ),
			'value' => $user->user_email,
		);

		$admin_message = apply_filters( 'inspiry_new_user_admin_notification', $admin_message, $user, $user_password );
		$admin_message = ere_apply_email_template( $admin_message, 'user_registration_form', $email_templates['field'], $email_templates['email'] );
		wp_mail( get_option( 'admin_email' ), sprintf( __( '[%s] New User Registration', 'easy-real-estate' ), $blogname ), $admin_message, $headers );

		// Newly Registered User Email
		$user_message = array();

		$user_message[] = array(
			'name'  => '',
			'value' => sprintf( __( 'Welcome to %s', 'easy-real-estate' ), $blogname ),
		);

		$user_message[] = array(
			'name'  => esc_html__( 'Your Username', 'easy-real-estate' ),
			'value' => $user->user_login,
		);

		// Send password reset link to user
		if ( 'yes' === get_option( 'realhomes_email_confirmation_before_login', 'no' ) ) {

			$key = get_password_reset_key( $user );
			if ( ! is_wp_error( $key ) ) {
				$user_message[] = array(
					'name'  => esc_html__( 'To set your password, visit the following address', 'easy-real-estate' ),
					'value' => network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user->user_login ), 'login' ),
				);
			}

			$user_message[] = array(
				'name'  => esc_html__( 'Login URL', 'easy-real-estate' ),
				'value' => wp_login_url(),
			);

		} else {
			$user_message[] = array(
				'name'  => esc_html__( 'Your Password', 'easy-real-estate' ),
				'value' => $user_password,
			);

			$user_message[] = array(
				'name'  => '',
				'value' => esc_html__( 'It is highly recommended to change your password after login.', 'easy-real-estate' ) . '<br/>' . esc_html__( 'For more details visit:', 'easy-real-estate' ) . ' ' . home_url( '/' ),
			);
		}

		$user_message = apply_filters( 'inspiry_new_user_welcome_notification', $user_message, $user, $user_password );
		$user_message = ere_apply_email_template( $user_message, 'user_registration_form', $email_templates['field'], $email_templates['email'] );
		wp_mail( $user->user_email, sprintf( __( 'Welcome to %s', 'easy-real-estate' ), $blogname ), $user_message, $headers );
	}
}

if ( ! function_exists( 'ere_is_user_restricted' ) ) {
	/**
	 * Checks if current user is restricted or not
	 *
	 * @return bool
	 */
	function ere_is_user_restricted() {
		$current_user = wp_get_current_user();

		// get restricted level from theme options
		$restricted_level = get_option( 'theme_restricted_level' );
		if ( ! empty( $restricted_level ) ) {
			$restricted_level = intval( $restricted_level );
		} else {
			$restricted_level = 0;
		}

		// Redirects user below a certain user level to home url
		// Ref: https://codex.wordpress.org/Roles_and_Capabilities#User_Level_to_Role_Conversion
		if ( $current_user->user_level <= $restricted_level ) {
			return true;
		}

		return false;
	}
}

if ( ! function_exists( 'ere_hide_admin_bar' ) ) {
	/**
	 * Hide the admin bar on front end for users with user level equal to or below restricted level
	 */
	function ere_hide_admin_bar() {
		if ( is_user_logged_in() ) {
			if ( ere_is_user_restricted() ) {
				add_filter( 'show_admin_bar', '__return_false' );
			}
		}
	}

	add_action( 'init', 'ere_hide_admin_bar', 9 );
}


if ( ! function_exists( 'ere_update_user_approval_status' ) ) {
	/**
	 * Updates user approve status meta against the ajax request
	 *
	 * @since 2.2.0
	 *
	 * @return bool
	 */
	function ere_update_user_approval_status() {

		if ( ! isset( $_POST['user_id'] ) || ! isset( $_POST['new_status'] ) ) {
			die( esc_html__( 'Error: Missing details.', 'easy-real-estate' ) );
        }
		$user_id    = intval( $_POST['user_id'] );
		$new_status = $_POST['new_status'];

		// Update user meta
		update_user_meta( $user_id, 'ere_user_approval_status', $new_status );

		// Send a response
		echo esc_html__( 'Success!', 'easy-real-estate' );

		wp_die(); // Terminating the AJAX request
	}

	add_action( 'wp_ajax_update_user_approve_status', 'ere_update_user_approval_status' );
}

if ( ! function_exists( 'ere_set_registered_user_status_to_pending' ) ) {
	/**
	 * Add pending value to newly registered user if approval functionality is enabled
	 *
	 * @since 2.2.0
	 *
	 * @param int $user_id
	 */
	function ere_set_registered_user_status_to_pending( $user_id ) {

		update_user_meta( $user_id, 'ere_user_approval_status', get_option( 'ere_registered_user_default_status', 'pending' ) );

	}

	add_action( 'user_register', 'ere_set_registered_user_status_to_pending', 10, 1 );
}


if ( ! function_exists( 'ere_check_user_status_on_login' ) ) {
	/**
	 * Check user approval status upon login and act accordingly
	 *
	 * @since 2.2.0
	 *
	 * @param object $user
	 *
	 * @return WP_Error|string|boolean
	 */
	function ere_check_user_status_on_login( $user ) {
		// If username and password are correct
		if ( $user instanceof WP_User ) {

			// Getting user approval status
			$user_status = get_user_meta( $user->ID, 'ere_user_approval_status', true );

			if ( $user_status === 'pending' ) {
				return new WP_Error(
                    'ere_user_no_approval_message',
                    get_option( 'ere_pending_users_error_statement', esc_html__( 'Access approval is pending for this user.', 'easy-real-estate' ) )
                );
			} else if ( $user_status === 'denied' ) {
				return new WP_Error(
                    'ere_user_no_approval_message',
                    get_option( 'ere_denied_users_error_statement', esc_html__( 'Access is denied for this user. Please contact the website administrator.', 'easy-real-estate' ) )
                );
			}
		}

		return $user;
	}

	add_filter( 'authenticate', 'ere_check_user_status_on_login', 21 );
}


if ( ! function_exists( 'ere_update_users_paged_list' ) ) {
	/**
	 * Generate and return the users list based on the selected page for sent user approve status
	 *
	 * @since 2.2.0
	 *
	 * @return mixed
	 */
	function ere_update_users_paged_list() {

		if ( ! isset( $_POST['page_num'] ) || ! isset( $_POST['status'] ) ) {
			echo json_encode( array( 'success' => false ) );
			die();
        }

		// Get data from AJAX request
		$page_num = $_POST['page_num'];
		$status   = $_POST['status'];

        if ( empty( $status ) ) {
	        $status = 'pending';
        }

		$users = ere_get_users_by_approval_status( $status );
		$users_per_page = 20;
		$users_list     = array_slice( $users, ($page_num-1)*$users_per_page );

		if ( false !== $users_list && 0 < count( $users_list ) ) {

			ob_start();

			$users_counter = 1;
			foreach ( $users_list as $user ) {

				// Break if per page user exceeds
				if ( $users_counter > $users_per_page ) {
					break;
				}

				$user_status = ere_get_user_approval_status( $user->ID );
				?>
                <li class="user-item status-<?php echo esc_attr( $user_status ); ?>">
                    <ul>
                        <li class="user-id"><?php echo esc_html( $user->ID ); ?></li>
                        <li class="user-login"><?php echo esc_html( $user->user_login ); ?></li>
						<?php
						if ( '' !== $user->first_name && '' !== $user->last_name ) {
							$user_name = sprintf(
								$user->first_name,
								$user->last_name
							);
						} else {
							$user_name = $user->display_name;
						}
						?>
                        <li class="user-name"><?php echo esc_html( $user_name ); ?></li>
                        <li class="user-email"><?php echo esc_html( $user->user_email ); ?></li>
                        <li class="user-status <?php echo esc_attr( $user_status ); ?>"><?php echo esc_html( $user_status ); ?></li>
						<?php
						if ( $user_status == 'denied' || $user_status == 'pending' ) {
							$button_class = 'approved';
							$current_text = esc_html__( 'Approve', 'easy-real-estate' );
							$alter_text   = esc_html__( 'Deny', 'easy-real-estate' );
						} else {
							$button_class = 'denied';
							$current_text = esc_html__( 'Deny', 'easy-real-estate' );
							$alter_text   = esc_html__( 'Approve', 'easy-real-estate' );
						}
						?>
                        <li class="user-action">
                            <a class="button-primary <?php echo esc_attr( $button_class ); ?>" data-user-id="<?php echo esc_attr( $user->ID ); ?>" data-current-status="<?php echo esc_attr( $user_status ); ?>" data-new-status="<?php echo esc_attr( $button_class ); ?>" data-current-text="<?php echo esc_attr( $current_text ); ?>" data-alter-text="<?php echo esc_attr( $alter_text ); ?>"><?php echo esc_html( $current_text ); ?></a>
                            <p class="loader"><?php ere_safe_include_svg( '/images/loader.svg' ); ?></p>
                        </li>
                    </ul>
                </li>
				<?php
				$users_counter++;
			}

			$users_items = ob_get_contents();
			ob_end_clean();

			echo json_encode( array( 'success' => true, 'data'  => $users_items ) );
            die();

		}

		echo json_encode( array( 'success' => false ) );
		die;

	}

	add_action( 'wp_ajax_update_user_paged_items', 'ere_update_users_paged_list' );
}