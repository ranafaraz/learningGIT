<?php
/**
 * This file contains the functions for agent and agency submit email notifications.
 *
 * @since   2.2.0
 * @package easy-real-estate
 */

if ( ! function_exists( 'ere_agent_agency_submit_email_notification' ) ) {
	/**
	 * Submit email notification to agent or agency.
	 *
	 * @since 2.2.0
	 *
	 * @param int    $post_id   The ID of the submitted post.
	 * @param string $post_type The type of the submitted post.
	 */
	function ere_agent_agency_submit_email_notification( $post_id, $post_type ) {
		// Sanitize target email
		$target_email = sanitize_email( get_option( "realhomes_{$post_type}_submit_notice_email", get_option( 'admin_email' ) ) );

		// Validate the email address
		$target_email = is_email( $target_email );
		if ( ! $target_email ) {
			return false;
		}

		// Submitter information
		$current_user    = wp_get_current_user();
		$submitter_name  = $current_user->display_name;
		$submitter_email = $current_user->user_email;
		$site_name       = get_bloginfo( 'name' );

		// Email subject
		$email_subject = sprintf( esc_html__( 'A new %s is submitted by %s at %s', 'easy-real-estate' ), $post_type, $submitter_name, $site_name );

		// Start of email body
		$email_body = array();

		$email_body[] = array(
			'name'  => '',
			'value' => sprintf( esc_html__( 'A new %s is submitted by %s', 'easy-real-estate' ), $post_type, $submitter_name ),
		);

		// Preview link
		$preview_link = set_url_scheme( get_permalink( $post_id ) );
		$preview_link = esc_url( apply_filters( 'preview_post_link', add_query_arg( 'preview', 'true', $preview_link ) ) );
		if ( ! empty( $preview_link ) ) {
			$email_body[] = array(
				'name'  => sprintf( esc_html__( '%s Preview Link', 'easy-real-estate' ), ucfirst( $post_type ) ),
				'value' => '<a target="_blank" href="' . esc_url( $preview_link ) . '">' . sanitize_text_field( $_POST['post_title'] ) . '</a>',
			);
		}

		$email_body[] = array(
			'name'  => esc_html__( 'Submitter Email', 'easy-real-estate' ),
			'value' => $submitter_email,
		);

		// Generate email body using a template
		$email_body = ere_email_template( $email_body, "{$post_type}_submit_form" );

		// Email Headers (Reply To and Content Type)
		$headers   = array();
		$headers[] = "Reply-To: $submitter_name <$submitter_email>";
		$headers[] = "Content-Type: text/html; charset=UTF-8";
		$headers   = apply_filters( "ere_{$post_type}_submit_mail_header", $headers );

		// Send Email
		if ( ! wp_mail( $target_email, $email_subject, $email_body, $headers ) ) {
			inspiry_log( sprintf( esc_html__( 'Failed: To send %s submit notice', 'easy-real-estate' ), $post_type ) );
		}
	}
}

if ( ! function_exists( 'ere_agent_submit_email_notification' ) ) {
	/**
	 * Send email notification after an agent is submitted.
	 *
	 * @since 2.2.0
	 *
	 * @param int $agent_id The ID of the submitted agent.
	 */
	function ere_agent_submit_email_notification( $agent_id ) {
		ere_agent_agency_submit_email_notification( $agent_id, 'agent' );
	}

	add_action( 'realhomes_after_agent_submit', 'ere_agent_submit_email_notification' );
}

if ( ! function_exists( 'ere_agency_submit_email_notification' ) ) {
	/**
	 * Send email notification after an agency is submitted.
	 *
	 * @since 2.2.0
	 *
	 * @param int $agency_id The ID of the submitted agent.
	 */
	function ere_agency_submit_email_notification( $agency_id ) {
		ere_agent_agency_submit_email_notification( $agency_id, 'agency' );
	}

	add_action( 'realhomes_after_agency_submit', 'ere_agency_submit_email_notification' );
}