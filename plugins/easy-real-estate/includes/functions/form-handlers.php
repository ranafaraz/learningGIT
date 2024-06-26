<?php
/**
 * Functions related to Contact or Message Forms Handling
 */
if (!function_exists('ere_mail_from_name')) {
	/**
	 * Override 'WordPress' as from name in emails sent by wp_mail function
	 * @return string
	 */
	function ere_mail_from_name()
	{
		// The blogname option is escaped with esc_html on the way into the database in sanitize_option
		// we want to reverse this for the plain text arena of emails.
		return wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
	}

	add_filter('wp_mail_from_name', 'ere_mail_from_name');
}

if (!function_exists('ere_forms_safe_webhook_post')) {
	/**
	 * Sends a safe Webhook request using the POST method.
	 *
	 * @since 0.6.0
	 *
	 * @param array $form_data
	 * @param string $form_id
	 */
	function ere_forms_safe_webhook_post(array $form_data, $form_id = 'contact_form')
	{

		$exclude_fields = apply_filters(
			'ere_forms_webhook_exclude_fields',
			array(
				'action',
				'nonce',
				'target',
				'submit',
				'the_id',
				'agent_id',
				'property_id',
				'ere_cf_widget_target_email'
			),
			$form_id
		);

		$form_data = array_merge($form_data, array('form_id' => $form_id));

		if (!empty($form_data) && is_array($form_data)) {
			if (!empty($exclude_fields) && is_array($exclude_fields)) {
				foreach ($exclude_fields as $field) {
					if (isset($form_data[$field])) {
						unset($form_data[$field]);
					}
				}
			}
		}

		$webhook_url = get_option('ere_forms_webhook_url');
		if (!empty($webhook_url) && !empty($form_data)) {
			$args = apply_filters(
				'ere_forms_webhook_post_args',
				array(
					'body' => wp_json_encode($form_data),
					'headers' => array(
						'Content-Type' => 'application/json; charset=UTF-8',
					),
				)
			);

			wp_safe_remote_post($webhook_url, $args);
		}
	}
}

if (!function_exists('ere_send_contact_message')) {
	/**
	 * Handler for Contact form on contact page template
	 */
	function ere_send_contact_message()
	{

		if (isset($_POST['email'])):

			/*
			 * Verify Nonce
			 */
			if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'send_message_nonce')) {
				echo json_encode(
					array(
						'success' => false,
						'message' => esc_html__('Unverified Nonce!', 'easy-real-estate')
					)
				);
				die;
			}

			/* Verify Google reCAPTCHA */
			ere_verify_google_recaptcha();

			/*
			 * Sanitize and Validate Target email address that will be configured from theme options
			 */
			if (isset($_POST['the_id'])) {
				$to_email = sanitize_email(get_post_meta($_POST['the_id'], 'theme_contact_email', true));
			} elseif (isset($_POST['ere_cf_widget_target_email'])) {
				$to_email = sanitize_email($_POST['ere_cf_widget_target_email']);
			} else {
				$to_email = sanitize_email(get_option('theme_contact_email'));
			}

			$to_email = is_email($to_email);

			if (!$to_email) {
				echo json_encode(
					array(
						'success' => false,
						'message' => esc_html__('Target Email address is not properly configured!', 'easy-real-estate')
					)
				);
				die;
			}

			/*
			 * Sanitize and Validate contact form input data
			 */
			$from_name = sanitize_text_field($_POST['name']);
			$phone_number = sanitize_text_field($_POST['number']);
			$message = stripslashes($_POST['message']);

			$from_email = sanitize_email($_POST['email']);
			$from_email = is_email($from_email);
			if (!$from_email) {
				echo json_encode(
					array(
						'success' => false,
						'message' => esc_html__('Provided Email address is invalid!', 'easy-real-estate')
					)
				);
				die;
			}

			/*
			 * Email Subject
			 */
			$email_subject = esc_html__('New message sent by', 'easy-real-estate') . ' ' . $from_name . ' ' . esc_html__('using contact form at', 'easy-real-estate') . ' ' . get_bloginfo('name');

			/*
			 * Email Body
			 */
			$email_body = array();

			if (isset($_POST['property_title'])) {
				$property_title = sanitize_text_field($_POST['property_title']);
				if (!empty($property_title)) {
					$email_body[] = array(
						'name' => esc_html__('Property Title', 'easy-real-estate'),
						'value' => $property_title,
					);
				}
			}

			if (isset($_POST['property_permalink'])) {
				$property_permalink = esc_url($_POST['property_permalink']);
				if (!empty($property_permalink)) {
					$email_body[] = array(
						'name' => esc_html__('Property URL', 'easy-real-estate'),
						'value' => $property_permalink,
					);
				}
			}

			$email_body[] = array(
				'name' => esc_html__('Name', 'easy-real-estate'),
				'value' => $from_name,
			);

			if (!empty($phone_number)) {
				$email_body[] = array(
					'name' => esc_html__('Phone Number', 'easy-real-estate'),
					'value' => $phone_number,
				);
			}

			$email_body[] = array(
				'name' => esc_html__('Email', 'easy-real-estate'),
				'value' => $from_email,
			);

			$email_body[] = array(
				'name' => esc_html__('Message', 'easy-real-estate'),
				'value' => $message,
			);

			if ('1' == get_option('inspiry_gdpr_in_email', '0') && isset($_POST['gdpr'])) {
				$GDPR_agreement = $_POST['gdpr'];
				if (!empty($GDPR_agreement)) {
					$email_body[] = array(
						'name' => esc_html__('GDPR Agreement', 'easy-real-estate'),
						'value' => $GDPR_agreement,
					);
				}
			}

			$email_body = ere_email_template($email_body);

			/*
			 * Email Headers ( Reply To and Content Type )
			 */
			$headers = array();

			/* Send CC of contact form message if configured */
			if (isset($_POST['the_id'])) {
				$cc_email = sanitize_email(get_post_meta($_POST['the_id'], 'theme_contact_cc_email', true));
			} else {
				$cc_email = sanitize_email(get_option('theme_contact_cc_email'));
			}

			$cc_email = explode(',', $cc_email);
			if (!empty($cc_email)) {
				foreach ($cc_email as $ind_email) {
					$ind_email = sanitize_email($ind_email);
					$ind_email = is_email($ind_email);
					if ($ind_email) {
						$headers[] = "Cc: $ind_email";
					}
				}
			}

			/* Send BCC of contact form message if configured */
			if (isset($_POST['the_id'])) {
				$bcc_email = sanitize_email(get_post_meta($_POST['the_id'], 'theme_contact_bcc_email', true));
			} else {
				$bcc_email = sanitize_email(get_option('theme_contact_bcc_email'));
			}

			$bcc_email = explode(',', $bcc_email);
			if (!empty($bcc_email)) {
				foreach ($bcc_email as $ind_email) {
					$ind_email = sanitize_email($ind_email);
					$ind_email = is_email($ind_email);
					if ($ind_email) {
						$headers[] = "Bcc: $ind_email";
					}
				}
			}

			$headers[] = "Reply-To: $from_email";
			$headers[] = "Content-Type: text/html; charset=UTF-8";
			$headers = apply_filters("inspiry_contact_mail_header", $headers);    // just in case if you want to modify the header in child theme

			if (wp_mail($to_email, $email_subject, $email_body, $headers)) {

				if ('1' === get_option('ere_contact_form_webhook_integration', '0')) {
					ere_forms_safe_webhook_post($_POST);
				}

				echo json_encode(
					array(
						'success' => true,
						'message' => esc_html__('Message Sent Successfully!', 'easy-real-estate')
					)
				);
			} else {
				echo json_encode(
					array(
						'success' => false,
						'message' => esc_html__('Server Error: WordPress mail function failed!', 'easy-real-estate')
					)
				);
			}

		else:
			echo json_encode(
				array(
					'success' => false,
					'message' => esc_html__('Invalid Request !', 'easy-real-estate')
				)
			);
		endif;

		do_action('inspiry_after_contact_form_submit');

		die;

	}

	add_action('wp_ajax_nopriv_send_message', 'ere_send_contact_message');
	add_action('wp_ajax_send_message', 'ere_send_contact_message');
}

if (!function_exists('ere_send_contact_message_cfos')) {
	/**
	 * Handler for Contact form on contact page template
	 */
	function ere_send_contact_message_cfos()
	{

		if (isset($_POST['email'])):

			/*
			 * Verify Nonce
			 */
			if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'send_cfos_message_nonce')) {
				echo json_encode(
					array(
						'success' => false,
						'message' => esc_html__('Unverified Nonce!', 'easy-real-estate')
					)
				);
				die;
			}

			/* Verify Google reCAPTCHA */
			ere_verify_google_recaptcha();

			/*
			 * Sanitize and Validate Target email address that will be configured from theme options
			 */
			if (isset($_POST['the_id'])) {
				$to_email = sanitize_email(get_post_meta($_POST['the_id'], 'theme_contact_form_email_cfos', true));
			} else {
				$to_email = '';
			}

			$to_email = is_email($to_email);
			if (!$to_email) {
				echo json_encode(
					array(
						'success' => false,
						'message' => esc_html__('Target Email address is not properly configured!', 'easy-real-estate')
					)
				);
				die;
			}

			/*
			 * Sanitize and Validate contact form input data
			 */
			$from_name = sanitize_text_field($_POST['name']);
			$phone_number = sanitize_text_field($_POST['number']);
			$message = stripslashes($_POST['message']);

			$from_email = sanitize_email($_POST['email']);
			$from_email = is_email($from_email);
			if (!$from_email) {
				echo json_encode(
					array(
						'success' => false,
						'message' => esc_html__('Provided Email address is invalid!', 'easy-real-estate')
					)
				);
				die;
			}

			/*
			 * Email Subject
			 */
			$email_subject = esc_html__('New message sent by', 'easy-real-estate') . ' ' . $from_name . ' ' . esc_html__('using home contact form at', 'easy-real-estate') . ' ' . get_bloginfo('name');

			/*
			 * Email Body
			 */
			$email_body = array();

			$email_body[] = array(
				'name' => esc_html__('Name', 'easy-real-estate'),
				'value' => $from_name,
			);

			if (!empty($phone_number)) {
				$email_body[] = array(
					'name' => esc_html__('Phone Number', 'easy-real-estate'),
					'value' => $phone_number,
				);
			}

			$email_body[] = array(
				'name' => esc_html__('Email', 'easy-real-estate'),
				'value' => $from_email,
			);

			$email_body[] = array(
				'name' => esc_html__('Message', 'easy-real-estate'),
				'value' => $message,
			);

			if ('1' == get_option('inspiry_gdpr_in_email', '0') && isset($_POST['gdpr'])) {
				$GDPR_agreement = $_POST['gdpr'];
				if (!empty($GDPR_agreement)) {
					$email_body[] = array(
						'name' => esc_html__('GDPR Agreement', 'easy-real-estate'),
						'value' => $GDPR_agreement,
					);
				}
			}

			$email_body = ere_email_template($email_body, 'contact_form_over_slider');

			/*
			 * Email Headers ( Reply To and Content Type )
			 */
			$headers = array();

			/* Send CC of contact form message if configured */
			if (isset($_POST['the_id'])) {
				$cc_email = sanitize_email(get_post_meta($_POST['the_id'], 'theme_contact_form_email_cc_cfos', true));
			} else {
				$cc_email = '';
			}

			$cc_email = explode(',', $cc_email);
			if (!empty($cc_email)) {
				foreach ($cc_email as $ind_email) {
					$ind_email = sanitize_email($ind_email);
					$ind_email = is_email($ind_email);
					if ($ind_email) {
						$headers[] = "Cc: $ind_email";
					}
				}
			}

			/* Send BCC of contact form message if configured */
			if (isset($_POST['the_id'])) {
				$bcc_email = sanitize_email(get_post_meta($_POST['the_id'], 'theme_contact_form_email_bcc_cfos', true));
			} else {
				$bcc_email = '';
			}

			$bcc_email = explode(',', $bcc_email);
			if (!empty($bcc_email)) {
				foreach ($bcc_email as $ind_email) {
					$ind_email = sanitize_email($ind_email);
					$ind_email = is_email($ind_email);
					if ($ind_email) {
						$headers[] = "Bcc: $ind_email";
					}
				}
			}

			$headers[] = "Reply-To: $from_email";
			$headers[] = "Content-Type: text/html; charset=UTF-8";
			$headers = apply_filters("inspiry_contact_mail_header", $headers);    // just in case if you want to modify the header in child theme

			if (wp_mail($to_email, $email_subject, $email_body, $headers)) {

				if ('1' === get_option('ere_contact_form_webhook_integration', '0')) {
					ere_forms_safe_webhook_post($_POST, 'contact_form_over_slider');
				}

				echo json_encode(
					array(
						'success' => true,
						'message' => esc_html__('Message Sent Successfully!', 'easy-real-estate')
					)
				);
			} else {
				echo json_encode(
					array(
						'success' => false,
						'message' => esc_html__('Server Error: WordPress mail function failed!', 'easy-real-estate')
					)
				);
			}

		else:
			echo json_encode(
				array(
					'success' => false,
					'message' => esc_html__('Invalid Request !', 'easy-real-estate')
				)
			);
		endif;

		do_action('inspiry_after_contact_form_submit');

		die;
	}

	add_action('wp_ajax_nopriv_send_message_cfos', 'ere_send_contact_message_cfos');
	add_action('wp_ajax_send_message_cfos', 'ere_send_contact_message_cfos');
}

if (!function_exists('ere_send_message_to_agent')) {
	/**
	 * Handler for agent's contact form
	 */
	function ere_send_message_to_agent()
	{
		if (isset($_POST['email'])):
			/*
			 *  Verify Nonce
			 */
			$nonce = $_POST['nonce'];
			if (!wp_verify_nonce($nonce, 'agent_message_nonce')) {
				echo json_encode(
					array(
						'success' => false,
						'message' => esc_html__('Unverified Nonce!', 'easy-real-estate')
					)
				);
				die;
			}

			/* Verify Google reCAPTCHA */
			ere_verify_google_recaptcha();

			/* Sanitize and Validate Target email address that is coming from agent form */
			$to_email = sanitize_email($_POST['target']);
			$to_email = is_email($to_email);
			if (!$to_email) {
				echo json_encode(
					array(
						'success' => false,
						'message' => esc_html__('Target Email address is not properly configured!', 'easy-real-estate')
					)
				);
				die;
			}

			/* Sanitize and Validate contact form input data */
			$from_name = sanitize_text_field($_POST['name']);
			$from_phone = sanitize_text_field($_POST['phone']);
			$message = stripslashes($_POST['message']);

			/*
			 * From email
			 */
			$from_email = sanitize_email($_POST['email']);
			$from_email = is_email($from_email);
			if (!$from_email) {
				echo json_encode(
					array(
						'success' => false,
						'message' => esc_html__('Provided Email address is invalid!', 'easy-real-estate')
					)
				);
				die;
			}

			/*
			 * Email Subject
			 */
			$is_agency_form = (isset($_POST['form_of']) && 'agency' == $_POST['form_of']);
			$form_of = $is_agency_form ? esc_html__('using agency contact form at', 'easy-real-estate') : esc_html__('using agent contact form at', 'easy-real-estate');
			$email_subject = esc_html__('New message sent by', 'easy-real-estate') . ' ' . $from_name . ' ' . $form_of . ' ' . get_bloginfo('name');

			/*
			 * Email body
			 */
			$email_body = array();

			if (isset($_POST['property_title'])) {
				$property_title = sanitize_text_field($_POST['property_title']);
				if (!empty($property_title)) {
					$email_body[] = array(
						'name' => esc_html__('Property Title', 'easy-real-estate'),
						'value' => $property_title,
					);
				}
			}

			if (isset($_POST['property_permalink'])) {
				$property_permalink = esc_url($_POST['property_permalink']);
				if (!empty($property_permalink)) {
					$email_body[] = array(
						'name' => esc_html__('Property URL', 'easy-real-estate'),
						'value' => $property_permalink,
					);
				}
			}

			$email_body[] = array(
				'name' => esc_html__('Name', 'easy-real-estate'),
				'value' => $from_name,
			);

			$email_body[] = array(
				'name' => esc_html__('Email', 'easy-real-estate'),
				'value' => $from_email,
			);

			if (!empty($from_phone)) {
				$email_body[] = array(
					'name' => esc_html__('Contact Number', 'easy-real-estate'),
					'value' => $from_phone,
				);
			}

			$email_body[] = array(
				'name' => esc_html__('Message', 'easy-real-estate'),
				'value' => $message,
			);

			if ('1' == get_option('inspiry_gdpr_in_email', '0') && isset($_POST['gdpr'])) {
				$GDPR_agreement = $_POST['gdpr'];
				if (!empty($GDPR_agreement)) {
					$email_body[] = array(
						'name' => esc_html__('GDPR Agreement', 'easy-real-estate'),
						'value' => $GDPR_agreement,
					);
				}
			}

			$email_body_copy = $email_body;

			$email_body = ere_email_template($email_body, 'agent_contact_form');

			/*
			 * Email Headers ( Reply To and Content Type )
			 */
			$headers = array();
			$headers[] = "Reply-To: $from_email";
			$headers[] = "Content-Type: text/html; charset=UTF-8";
			$headers = apply_filters("inspiry_agent_mail_header", $headers);    // just in case if you want to modify the header in child theme

			/* Send copy of message to admin if configured */
			// Old code - adding multiple CC emails
			// $theme_send_message_copy = get_option('theme_send_message_copy', 'false');
			// if ($theme_send_message_copy == 'true') {
			// 	$cc_email = get_option('theme_message_copy_email');
			// 	$cc_email = explode(',', $cc_email);
			// 	if (!empty($cc_email)) {
			// 		foreach ($cc_email as $ind_email) {
			// 			$ind_email = sanitize_email($ind_email);
			// 			$ind_email = is_email($ind_email);
			// 			if ($ind_email) {
			// 				$headers[] = "Cc: $ind_email";
			// 			}
			// 		}
			// 	}
			// }

			if (wp_mail($to_email, $email_subject, $email_body, $headers)) {
				if ('1' === get_option('ere_agency_form_webhook_integration', '0') && $is_agency_form) {
					ere_forms_safe_webhook_post($_POST, 'agency_contact_form');
				} elseif ('1' === get_option('ere_agent_form_webhook_integration', '0')) {
					ere_forms_safe_webhook_post($_POST, 'agent_contact_form');
				}

				$theme_send_message_copy = get_option('theme_send_message_copy', 'false');
				if ($theme_send_message_copy == 'true') {
					$admin_emails_option = get_option('theme_message_copy_email');
					$admin_emails = explode(',', $admin_emails_option);
					if (!empty($admin_emails)) {
						foreach ($admin_emails as $admin_email) {
							$admin_email = sanitize_email($admin_email);
							$admin_email = is_email($admin_email);
							if ($admin_email) {
								// Get agent/agency info
								$agent = [];
								$agency = [];

								if ($is_agency_form) {
									$agency_id = $_POST['agent_id'];
									$agency_post = get_post($agency_id);
									$agency['name'] = $agency_post->post_title;
									$agency['link'] = get_permalink($agency_id);
								} else {
									$agent_id = $_POST['agent_id'];
									$agent_post = get_post($agent_id);
									$agent['name'] = $agent_post->post_title;
									$agent['link'] = get_permalink($agent_id);
								}

								$email_subject = esc_html__('Copy of Message Sent by', 'easy-real-estate') . ' ' . $from_name . ' ' . $form_of . ' ' . get_bloginfo('name');
								$email_body_copy[] = array(
									'name' => esc_html__($is_agency_form ? 'To Agency' : 'To Agent', 'easy-real-estate'),
									'value' => $is_agency_form ? $agency['name'] : $agent['name'],
								);
								$email_body_copy[] = array(
									'name' => esc_html__($is_agency_form ? 'Agency Link' : 'Agent Link', 'easy-real-estate'),
									'value' => $is_agency_form ? $agency['link'] : $agent['link'],
								);
								$email_body = ere_email_template($email_body_copy, 'agent_contact_form');

								wp_mail($admin_email, $email_subject, $email_body, $headers);
							}
						}
					}
				}

				echo json_encode(
					array(
						'success' => true,
						'message' => esc_html__('Message Sent Successfully!', 'easy-real-estate')
					)
				);
			} else {
				echo json_encode(
					array(
						'success' => false,
						'message' => esc_html__('Server Error: WordPress mail function failed!', 'easy-real-estate')
					)
				);
			}

		else:
			echo json_encode(
				array(
					'success' => false,
					'message' => esc_html__('Invalid Request !', 'easy-real-estate')
				)
			);
		endif;

		do_action('inspiry_after_agent_form_submit');

		die;
	}

	add_action('wp_ajax_nopriv_send_message_to_agent', 'ere_send_message_to_agent');
	add_action('wp_ajax_send_message_to_agent', 'ere_send_message_to_agent');
}

if (!function_exists('ere_report_property_email')) {
	/**
	 * Handler for report property form
	 *
	 * @since 1.1.7
	 */
	function ere_report_property_email()
	{

		if (isset($_POST['target'])) {

			// Verify Nonce
			$nonce = $_POST['nonce'];
			if (!wp_verify_nonce($nonce, 'realhomes_report_property_form_nonce')) {
				echo json_encode(
					array(
						'success' => false,
						'title' => esc_html__('Security Issue', 'easy-real-estate'),
						'message' => esc_html__('Unverified Nonce!', 'easy-real-estate')
					)
				);
				die;
			}

			// Sanitize and validate target and from email addresses that are coming from the form.
			$to_email = sanitize_email($_POST['target']);
			$to_email = is_email($to_email);
			if (!$to_email) {
				echo json_encode(
					array(
						'success' => false,
						'title' => esc_html__('Email Error', 'easy-real-estate'),
						'message' => esc_html__('Target email address is not properly configured!', 'easy-real-estate')
					)
				);
				die;
			}

			$from_email = '';
			if (isset($_POST['email'])) {
				$from_email = sanitize_email($_POST['email']);
				$from_email = is_email($from_email);
				if (empty($from_email)) {
					echo json_encode(
						array(
							'success' => false,
							'title' => esc_html__('Invalid Email', 'easy-real-estate'),
							'message' => esc_html__('Provided email address is invalid!', 'easy-real-estate')
						)
					);
					die;
				}
			}

			$rpm_defaults = realhomes_rpm_default_values();
			$email_body = array();
			$email_subject = get_bloginfo('name') . ' - ' . esc_html__('A New Report is Received!', 'easy-real-estate');
			$title_field_label = esc_html__('User Feedback', 'easy-real-estate');

			if (isset($_POST['property_title'])) {
				$property_title = sanitize_text_field($_POST['property_title']);
				if (!empty($property_title)) {
					$email_body[] = array(
						'name' => esc_html__('Property Title', 'easy-real-estate'),
						'value' => esc_html($property_title),
					);
				}
			}

			if (isset($_POST['property_permalink'])) {
				$property_permalink = esc_url($_POST['property_permalink']);
				if (!empty($property_permalink)) {
					$email_body[] = array(
						'name' => esc_html__('Property URL', 'easy-real-estate'),
						'value' => esc_url($property_permalink),
					);
				}
			}

			// See if parent field is provided to send child fields in feedback email.
			$is_parent_item = ('true' === get_option('realhomes_rpm_form_parent_item', 'true'));
			if ($is_parent_item && isset($_POST['feedback-child-options'])) {
				$child_options = $_POST['feedback-child-options'];

				if (!empty($child_options) && is_array($child_options)) {
					$is_child_item = ('true' === get_option('realhomes_rpm_form_custom_child_item', 'true'));
					$child_item_title = get_option('realhomes_rpm_form_custom_child_item_title', $rpm_defaults['child_item_title']);
					$child_option_values = array();

					foreach ($child_options as $value) {
						$value = sanitize_text_field($value);
						if (!empty($value) && ($child_item_title !== $value)) {
							$child_option_values[] = esc_html($value);
						}
					}

					if (!empty($child_option_values)) {

						// Appends the parent filed title.
						$parent_item_title = get_option('realhomes_rpm_form_parent_item_title', $rpm_defaults['parent_item_title']);
						if (!empty($parent_item_title)) {
							$title_field_label .= ': ' . esc_html($parent_item_title);
						}

						$email_body[] = array(
							'name' => esc_html($title_field_label),
							'value' => join(", ", $child_option_values),
						);
					}

					if ($is_child_item && isset($_POST['feedback-custom-message'])) {
						$message = stripslashes($_POST['feedback-custom-message']);

						if (!empty($message)) {
							$email_body[] = array(
								'name' => esc_html__('User Message', 'easy-real-estate'),
								'value' => esc_html($message),
							);
						}
					}
				}

			} elseif (isset($_POST['feedback-option'])) {
				$parent_option = sanitize_text_field($_POST['feedback-option']);
				if (!empty($parent_option)) {
					$email_body[] = array(
						'name' => esc_html($title_field_label),
						'value' => esc_html($parent_option),
					);
				}
			}

			if (!empty($from_email)) {
				$email_body[] = array(
					'name' => esc_html__('User Email', 'easy-real-estate'),
					'value' => esc_html($from_email),
				);
			}

			$email_body = ere_email_template($email_body, 'report_property_form');

			// Email Headers ( Reply To and Content Type )
			$headers = array();

			if (!empty($from_email)) {
				$headers[] = "Reply-To: <$from_email>";
			}

			$headers[] = "Content-Type: text/html; charset=UTF-8";
			$headers = apply_filters("ere_report_property_mail_header", $headers); // just in case if you want to modify the header in child theme

			if (wp_mail($to_email, $email_subject, $email_body, $headers)) {
				$response_title = get_option('realhomes_rpm_form_email_response_title', $rpm_defaults['email_response_title']);
				$response_text = get_option('realhomes_rpm_form_email_response_text', $rpm_defaults['email_response_text']);

				if (empty($response_title)) {
					$response_text = $rpm_defaults['email_response_title'];
				}

				if (empty($response_text)) {
					$response_text = $rpm_defaults['email_response_text'];
				}

				echo json_encode(
					array(
						'success' => true,
						'title' => esc_html($response_title),
						'message' => esc_html($response_text)
					)
				);
			} else {
				echo json_encode(
					array(
						'success' => false,
						'title' => esc_html__('Server Error', 'easy-real-estate'),
						'message' => esc_html__('WordPress mail function failed!', 'easy-real-estate')
					)
				);
			}

		} else {
			echo json_encode(
				array(
					'success' => false,
					'title' => esc_html__('Invalid Request!', 'easy-real-estate'),
					'message' => esc_html__('The email address is not properly configured!', 'easy-real-estate')
				)
			);
		}

		die;
	}

	add_action('wp_ajax_nopriv_report_property_email', 'ere_report_property_email');
	add_action('wp_ajax_report_property_email', 'ere_report_property_email');
}

if (!function_exists('ere_mail_wrapper')) {
	/**
	 * @param $to_email
	 * @param $email_subject
	 * @param $email_body
	 * @param $headers
	 *
	 * @return bool
	 */
	function ere_mail_wrapper($to_email, $email_subject, $email_body, $headers)
	{
		return wp_mail($to_email, $email_subject, $email_body, $headers);
	}
}

if (!function_exists('ere_get_email_templates')) {
	/**
	 * Returns email templates HTML code.
	 *
	 * @return array
	 */
	function ere_get_email_templates()
	{

		$email_templates = array();
		ob_start();
		include (ERE_PLUGIN_DIR . 'includes/email-template/field-template.php');
		$email_templates['field'] = ob_get_clean();

		ob_start();
		include (ERE_PLUGIN_DIR . 'includes/email-template/email-template.php');
		$email_templates['email'] = ob_get_clean();

		return $email_templates;
	}
}

if (!function_exists('ere_apply_email_template')) {
	/**
	 * Applies the email template.
	 *
	 * @param array $form_fields
	 * @param string $form_id
	 * @param string $field_template
	 * @param string $email_template
	 *
	 * @return string
	 */
	function ere_apply_email_template($form_fields, $form_id, $field_template, $email_template)
	{

		$form_fields = apply_filters('ere_email_template_form_fields', $form_fields, $form_id);

		$body = esc_html__('No field provided.', 'easy-real-estate');

		if (!empty($form_fields) && is_array($form_fields)) {
			$body = '';
			$index = 1;
			foreach ($form_fields as $form_field) {
				$field = $field_template;
				if (1 === $index) {
					$field = str_replace('border-top:1px solid #dddddd;', '', $field);
				}

				if (!empty($form_field['value'])) {
					$field = str_replace('{{name}}', $form_field['name'], $field);
					$field = str_replace('{{value}}', $form_field['value'], $field);
					$body .= wpautop($field);
				}

				$index++;
			}
		}

		$template = str_replace('{{body_fields}}', $body, $email_template);
		$template = make_clickable($template);

		return apply_filters('ere_email_template', $template, $form_id);
	}
}

if (!function_exists('ere_email_template')) {
	/**
	 * Build the email template.
	 *
	 * @param array $form_fields
	 * @param string $form_id
	 *
	 * @return string
	 */
	function ere_email_template($form_fields, $form_id = 'contact_form')
	{
		$email_templates = ere_get_email_templates();

		return ere_apply_email_template($form_fields, $form_id, $email_templates['field'], $email_templates['email']);
	}
}

if (!function_exists('ere_email_template_customizer')) {
	/**
	 * Email Template Customizer Settings
	 */
	function ere_email_template_customizer(WP_Customize_Manager $wp_customize)
	{

		/**
		 * Email Template Section
		 */
		$wp_customize->add_section(
			'ere_email_template_section',
			array(
				'title' => esc_html__('Email Template', 'easy-real-estate'),
				'priority' => 135,
			)
		);

		$wp_customize->add_setting('ere_email_color_scheme_label', array('sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control(
			new Inspiry_Heading_Customize_Control(
				$wp_customize,
				'ere_email_color_scheme_label',
				array(
					'label' => esc_html__('Email Content Settings', 'easy-real-estate'),
					'section' => 'ere_email_template_section',
				)
			)
		);

		/* Header Content */
		$wp_customize->add_setting(
			'ere_email_template_header_content',
			array(
				'type' => 'option',
				'default' => 'image',
				'transport' => 'postMessage',
				'sanitize_callback' => 'ere_sanitize_radio',
			)
		);
		$wp_customize->add_control(
			'ere_email_template_header_content',
			array(
				'label' => esc_html__('Header Content', 'easy-real-estate'),
				'description' => esc_html__('Content to include in email template header', 'easy-real-estate'),
				'type' => 'radio',
				'section' => 'ere_email_template_section',
				'choices' => array(
					'image' => esc_html__('Logo or Custom Image', 'easy-real-estate'),
					'title' => esc_html__('Title ( by default: Site Title )', 'easy-real-estate'),
					'both' => esc_html__('Both', 'easy-real-estate'),
					'none' => esc_html__('None', 'easy-real-estate'),
				),
			)
		);

		/* Header Image */
		$wp_customize->add_setting(
			'ere_email_template_header_image',
			array(
				'type' => 'option',
				'transport' => 'postMessage',
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'ere_email_template_header_image',
				array(
					'label' => esc_html__('Header Image', 'easy-real-estate'),
					'section' => 'ere_email_template_section',
				)
			)
		);

		/* Header Title */
		$wp_customize->add_setting(
			'ere_email_template_header_title',
			array(
				'type' => 'option',
				'transport' => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'ere_email_template_header_title',
			array(
				'label' => esc_html__('Header Title', 'easy-real-estate'),
				'type' => 'text',
				'section' => 'ere_email_template_section',
			)
		);

		/* Footer Text */
		$wp_customize->add_setting(
			'ere_email_template_footer_text',
			array(
				'type' => 'option',
				'transport' => 'postMessage',
				'sanitize_callback' => 'wp_kses_data',
			)
		);
		$wp_customize->add_control(
			'ere_email_template_footer_text',
			array(
				'label' => esc_html__('Footer Text', 'easy-real-estate'),
				'type' => 'textarea',
				'section' => 'ere_email_template_section',
			)
		);

		$wp_customize->add_setting('ere_email_color_scheme_style_label', array('sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control(
			new Inspiry_Heading_Customize_Control(
				$wp_customize,
				'ere_email_color_scheme_style_label',
				array(
					'label' => esc_html__('Email Styles', 'easy-real-estate'),
					'section' => 'ere_email_template_section',
				)
			)
		);

		// Color schemes
		$wp_customize->add_setting(
			'ere_email_color_scheme',
			array(
				'type' => 'option',
				'default' => 'default',
				'sanitize_callback' => 'inspiry_sanitize_select',
			)
		);
		$wp_customize->add_control(
			'ere_email_color_scheme',
			array(
				'label' => esc_html__('Email Template Color Scheme', 'easy-real-estate'),
				'type' => 'select',
				'section' => 'ere_email_template_section',
				'choices' => array(
					'default' => 'Default Colors',
					'custom' => 'Custom Colors',
				),
			)
		);

		/* Header Title Color */
		$wp_customize->add_setting(
			'ere_email_template_header_title_color',
			array(
				'type' => 'option',
				'default' => '#333333',
				'transport' => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'ere_email_template_header_title_color',
				array(
					'label' => esc_html__('Header Title Color', 'easy-real-estate'),
					'description' => esc_html__('This option will only work if Header Content is set to Title', 'easy-real-estate'),
					'section' => 'ere_email_template_section',
					'active_callback' => function () {
						$email_color_scheme = get_option('ere_email_color_scheme', 'default');
						if ('custom' === $email_color_scheme) {
							return true;
						}

						return false;
					},
				)
			)
		);

		/* Background Color */
		$wp_customize->add_setting(
			'ere_email_template_background_color',
			array(
				'type' => 'option',
				'default' => '#e9eaec',
				'transport' => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'ere_email_template_background_color',
				array(
					'label' => esc_html__('Background Color', 'easy-real-estate'),
					'section' => 'ere_email_template_section',
					'active_callback' => 'ere_is_email_custom_color_scheme'
				)
			)
		);

		/* Body Links Color */
		$wp_customize->add_setting(
			'ere_email_template_body_link_color',
			array(
				'type' => 'option',
				'default' => '#ff7f50',
				'transport' => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'ere_email_template_body_link_color',
				array(
					'label' => esc_html__('Body Links Color', 'easy-real-estate'),
					'section' => 'ere_email_template_section',
					'active_callback' => 'ere_is_email_custom_color_scheme'
				)
			)
		);

		/* Footer Text Color */
		$wp_customize->add_setting(
			'ere_email_template_footer_text_color',
			array(
				'type' => 'option',
				'default' => '#aaaaaa',
				'transport' => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'ere_email_template_footer_text_color',
				array(
					'label' => esc_html__('Footer Text Color', 'easy-real-estate'),
					'section' => 'ere_email_template_section',
					'active_callback' => 'ere_is_email_custom_color_scheme'
				)
			)
		);

		/* Footer Link Color */
		$wp_customize->add_setting(
			'ere_email_template_footer_link_color',
			array(
				'type' => 'option',
				'transport' => 'postMessage',
				'default' => '#949494',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'ere_email_template_footer_link_color',
				array(
					'label' => esc_html__('Footer Link Color', 'easy-real-estate'),
					'section' => 'ere_email_template_section',
					'active_callback' => 'ere_is_email_custom_color_scheme'
				)
			)
		);

	}

	add_action('customize_register', 'ere_email_template_customizer');
}

/**
 * Callback function for Email Template Styles fields
 *
 * @since 4.2.1
 *
 * @return bool
 */
function ere_is_email_custom_color_scheme()
{

	if ('custom' === get_option('ere_email_color_scheme', 'default')) {
		return true;
	}

	return false;
}

if (!function_exists('ere_sanitize_radio')) {
	/**
	 *
	 * @param $input
	 * @param $setting
	 *
	 * @return string
	 */
	function ere_sanitize_radio($input, $setting)
	{

		// input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
		$input = sanitize_key($input);

		// get the list of possible radio box options
		$choices = $setting->manager->get_control($setting->id)->choices;

		// return input if valid or return default option
		return (array_key_exists($input, $choices) ? $input : $setting->default);
	}
}

if (!function_exists('ere_schedule_property_tour')) {
	/**
	 * Schedule a tour request handler
	 *
	 * @since 2.0.0
	 */
	function ere_schedule_property_tour()
	{

		if (isset($_POST['sat-user-email']) && isset($_POST['property-id'])) {

			/* Verify Nonce */
			if (!isset($_POST['sat-nonce']) || !wp_verify_nonce($_POST['sat-nonce'], 'schedule_a_tour_nonce')) {
				echo json_encode(
					array(
						'success' => false,
						'message' => esc_html__('Unverified Nonce!', 'easy-real-estate')
					)
				);
				die;
			}

			$property_id = $_POST['property-id'];

			/* Verify Google reCAPTCHA */
			ere_verify_google_recaptcha();

			/**
			 * Setting target email based on user display type selection
			 *
			 * If display type is set to agent but agent email is not provided then property owner will
			 * receive the tour request.
			 **/
			if (0 < intval($property_id)) {
				$user_type = get_post_meta($property_id, 'REAL_HOMES_agent_display_option', true);
				$agents = get_post_meta($property_id, 'REAL_HOMES_agents');
				if ('agent_info' == $user_type && (is_array($agents) && 0 < count($agents))) {
					$to_email = '';
					$first = true;

					foreach ($agents as $agent) {
						$agent_email = get_post_meta($agent, 'REAL_HOMES_agent_email', true);
						if (!empty($agent_email) && is_email($agent_email)) {
							if ($first) {
								$first = false;
							} else {
								$to_email .= ',';
							}
							$to_email .= $agent_email;
						}
					}

				} else {
					$to_email = get_the_author_meta('email');
				}

			} else {
				echo json_encode(
					array(
						'success' => false,
						'message' => esc_html__('Property ID is not found!', 'easy-real-estate')
					)
				);
				die;
			}

			if (empty($to_email)) {
				echo json_encode(
					array(
						'success' => false,
						'message' => esc_html__('Target Email address is not properly configured!', 'easy-real-estate')
					)
				);
				die;
			}

			/* Sanitize and Validate contact form input data */
			$from_name = sanitize_text_field($_POST['sat-user-name']);
			$from_phone = sanitize_text_field($_POST['sat-user-phone']);
			$message = stripslashes($_POST['sat-user-message']);
			$selected_date = stripslashes($_POST['sat-date']);
			$selected_time = stripslashes($_POST['sat-time']);
			$tour_type = stripslashes($_POST['sat-tour-type']);

			/* From email */
			$from_email = sanitize_email($_POST['sat-user-email']);
			$from_email = is_email($from_email);
			if (!$from_email) {
				echo json_encode(
					array(
						'success' => false,
						'message' => esc_html__('Provided Email address is invalid!', 'easy-real-estate')
					)
				);
				die;
			}

			/* Email Subject */
			$email_subject = esc_html__('Property Tour is requested by - ', 'easy-real-estate') . ' ' . $from_name . ' - ' . get_bloginfo('name');

			/* Email body */
			$email_body = array();

			$property_title = get_the_title($property_id);
			if (!empty($property_title)) {
				$email_body[] = array(
					'name' => esc_html__('Property Title', 'easy-real-estate'),
					'value' => $property_title,
				);
			}

			$property_permalink = get_permalink($property_id);
			if (!empty($property_permalink)) {
				$email_body[] = array(
					'name' => esc_html__('Property URL', 'easy-real-estate'),
					'value' => $property_permalink,
				);
			}

			if (!empty($selected_date)) {
				$email_body[] = array(
					'name' => esc_html__('Selected Date', 'easy-real-estate'),
					'value' => $selected_date,
				);
			}

			if (!empty($selected_time)) {
				$email_body[] = array(
					'name' => esc_html__('Selected Time', 'easy-real-estate'),
					'value' => $selected_time,
				);
			}

			if (!empty($tour_type)) {
				$email_body[] = array(
					'name' => esc_html__('Tour Type', 'easy-real-estate'),
					'value' => $tour_type,
				);
			}

			if (!empty($from_name)) {
				$email_body[] = array(
					'name' => esc_html__('Name', 'easy-real-estate'),
					'value' => $from_name,
				);
			}

			$email_body[] = array(
				'name' => esc_html__('Email', 'easy-real-estate'),
				'value' => $from_email,
			);

			if (!empty($from_phone)) {
				$email_body[] = array(
					'name' => esc_html__('Contact Number', 'easy-real-estate'),
					'value' => $from_phone,
				);
			}

			if (!empty($message)) {
				$email_body[] = array(
					'name' => esc_html__('Message', 'easy-real-estate'),
					'value' => $message,
				);
			}

			if ('1' == get_option('inspiry_gdpr_in_email', '0') && isset($_POST['gdpr'])) {
				$GDPR_agreement = $_POST['gdpr'];
				if (!empty($GDPR_agreement)) {
					$email_body[] = array(
						'name' => esc_html__('GDPR Agreement', 'easy-real-estate'),
						'value' => $GDPR_agreement,
					);
				}
			}

			$email_body = ere_email_template($email_body, 'schedule-a-tour');

			/*
			 * Email Headers ( Reply To and Content Type )
			 */
			$headers = array();
			$headers[] = "Reply-To: $from_email";
			$headers[] = "Content-Type: text/html; charset=UTF-8";
			$headers = apply_filters('ere_schedule_tour_mail_header', $headers);    // just in case if you want to modify the header in child theme

			/* Send copy of message to admin if configured */
			if (get_option('realhomes_send_schedule_copy_to_admin') == 'true') {

				if (!str_contains($to_email, get_option('admin_email'))) {
					$admin_email = sanitize_email(get_option('admin_email'));
					$headers[] = 'Cc: $admin_email';
				}
			}

			$current_scheduled_times = get_post_meta($property_id, 'ere_property_scheduled_times', true);

			if (!is_array($current_scheduled_times)) {
				$current_scheduled_times = array();
			}

			$current_scheduled_times[] = array(
				'selected_date' => $selected_date,
				'selected_time' => $selected_time,
				'schedule_type' => $tour_type,
				'user_name' => $from_name,
				'user_phone' => $from_phone,
				'user_email' => $from_email,
				'user_message' => $message
			);

			// Adding the tour request to related meta array stack
			update_post_meta($property_id, 'ere_property_scheduled_times', $current_scheduled_times);

			// Sending email with requested tour information along with visitor's detail.
			if (wp_mail($to_email, $email_subject, $email_body, $headers)) {

				echo json_encode(
					array(
						'success' => true,
						'message' => esc_html__('Message Sent Successfully!', 'easy-real-estate')
					)
				);

			} else {
				echo json_encode(
					array(
						'success' => false,
						'message' => esc_html__('Server Error: WordPress mail function failed!', 'easy-real-estate')
					)
				);
			}

		} else {
			echo json_encode(
				array(
					'success' => false,
					'message' => esc_html__('Invalid Request!', 'easy-real-estate')
				)
			);
		}

		do_action('ere_after_schedule_tour_submit');

		die;
	}

	add_action('wp_ajax_nopriv_schedule_a_tour', 'ere_schedule_property_tour');
	add_action('wp_ajax_schedule_a_tour', 'ere_schedule_property_tour');
}