<?php
/**
 * Field: Reviewer Message
 *
 * @since    3.0.0
 * @package  realhomes/dashboard
 */

$property_mttr_label = get_option('realhomes_submit_property_message_to_the_reviewer_label');
if (empty($property_mttr_label)) {
	$property_mttr_label = esc_html__('Message to the Reviewer', 'framework');
}

$target_email = get_option('theme_submit_notice_email');
if (!empty($target_email)) {
	?>
	<div class="reviewer-message-field-wrapper">
		<p>
			<label for="message_to_reviewer"><?php echo esc_html($property_mttr_label); ?></label>
			<?php
			if (realhomes_dashboard_edit_property()) {
				global $post_meta_data;
				if (isset($post_meta_data['inspiry_message_to_reviewer'])) {
					printf('<span class="reviewer-message">%s</span>', esc_html($post_meta_data['inspiry_message_to_reviewer'][0]));
				}
			} else {
				?>
				<textarea name="message_to_reviewer" id="message_to_reviewer" cols="30" rows="8"></textarea>
				<?php
			}
			?>
		</p>
	</div>
	<?php
}