<?php
/**
 * Field: Agent
 *
 * @since    3.0.0
 * @package realhomes/dashboard
 */

$default_selection = 'my_profile_info';

// Auto assigns current agent/author on property submit when users synchronisation is enabled with Agents and Agencies.
$default_agent = 0;

$user_id = get_current_user_id();
$user_role = get_user_meta($user_id, 'inspiry_user_role', true);
$user_post_id = get_user_meta($user_id, 'inspiry_role_post_id', true);

if (0 < intval(get_option('realhomes_default_selected_agent'))) {
	$default_selection = 'agent_info';
	$default_agent = intval(get_option('realhomes_default_selected_agent'));
} else if (inspiry_is_user_sync_enabled()) {
	if ('agent' === $user_role) {
		if (!empty($user_post_id)) {
			$default_agent = $user_post_id;
		}
		$default_selection = 'my_profile_info';
	} else if ('agency' === $user_role) {
		$default_selection = 'agent_info';
	}
}

if (realhomes_dashboard_edit_property()) {
	global $post_meta_data;
	if (isset($post_meta_data['REAL_HOMES_agent_display_option'])) {
		if ($post_meta_data['REAL_HOMES_agent_display_option'][0] == 'none') {
			$default_selection = 'none';
		} else if ($post_meta_data['REAL_HOMES_agent_display_option'][0] == 'my_profile_info') {
			$default_selection = 'my_profile_info';

			if (isset($post_meta_data['REAL_HOMES_agents']) && $user_role === 'agency') {
				$default_selection = 'agent_info';
			}
		} else if ($post_meta_data['REAL_HOMES_agent_display_option'][0] == 'agent_info') {
			$default_selection = 'agent_info';

			if (
				$user_role === 'agent' && isset($post_meta_data['REAL_HOMES_agents']) &&
				in_array($user_post_id, $post_meta_data['REAL_HOMES_agents']) &&
				count($post_meta_data['REAL_HOMES_agents']) === 1
			) {
				$default_selection = 'my_profile_info';
			}
		}
	}
}

$property_agent_info_label = get_option('realhomes_submit_property_agent_info_label');
if (empty($property_agent_info_label)) {
	$property_agent_info_label = esc_html__('What to display in agent information box?', 'framework');
}

$property_agent_none_label = get_option('realhomes_submit_property_agent_option_one_label');
if (empty($property_agent_none_label)) {
	$property_agent_none_label = esc_html__('None ( Agent information box will not be displayed )', 'framework');
}

$property_profile_information_label = get_option('realhomes_submit_property_agent_option_two_label');
if (empty($property_profile_information_label)) {
	$property_profile_information_label = esc_html__('My profile information.', 'framework');
}

$property_edit_profile_information_label = get_option('realhomes_submit_property_agent_option_two_sub_label');
if (empty($property_edit_profile_information_label)) {
	$property_edit_profile_information_label = esc_html__('( Edit Profile Information )', 'framework');
}

$property_agent_information_label = get_option('realhomes_submit_property_agent_option_three_label');
if (empty($property_agent_information_label)) {
	$property_agent_information_label = esc_html__('Display agent(s) information.', 'framework');
}

$inspiry_user_role = $user_role;

if (realhomes_dashboard_edit_property()) {
	global $post_meta_data;
}

?>
<div class="property-agent-information">
	<label><?php echo esc_html($property_agent_info_label); ?></label>
	<ul class="list-unstyled agent-options-list">
		<?php /*
<li class="radio-field">
<input id="agent_option_none" type="radio" name="agent_display_option" value="none" <?php checked('none', $default_selection); ?> />
<label for="agent_option_none"><?php echo esc_html($property_agent_none_label); ?></label>
</li> */ ?>
		<?php if (is_user_logged_in()): ?>
			<li class="radio-field">
				<input id="agent_option_profile" type="radio" name="agent_display_option" value="my_profile_info" <?php checked('my_profile_info', $default_selection); ?> />
				<label for="agent_option_profile">
					<?php echo esc_html($property_profile_information_label); ?>
					<?php
					$profile_url = realhomes_get_dashboard_page_url('profile');
					if (!empty($profile_url)): ?>
						<a href="<?php echo esc_url($profile_url); ?>"
							target="_blank"><?php echo esc_html($property_edit_profile_information_label); ?></a>
					<?php else: ?>
						<a href="<?php echo esc_url(network_admin_url('profile.php')); ?>"
							target="_blank"><?php esc_html_e('( Edit Profile Information )', 'framework'); ?></a>
						<?php
					endif;
					?>
				</label>
			</li>
		<?php endif;
		if (
			$inspiry_user_role == 'agency' ||
			(realhomes_dashboard_edit_property() && $inspiry_user_role == 'agent' &&
				isset($post_meta_data['REAL_HOMES_agents']) && !empty($post_meta_data['REAL_HOMES_agents']) &&
				count(
					array_filter(
						$post_meta_data['REAL_HOMES_agents'],
						function ($value) {
							return !empty(trim($value));
						}
					)
				) > 1
			)
		) {
			?>
			<li class="radio-field">
				<input id="agent_option_agent" type="radio" name="agent_display_option" value="agent_info" <?php checked('agent_info', $default_selection); ?> 	<?php echo $inspiry_user_role == 'agent' ? 'disabled' : ''; ?> />
				<label for="agent_option_agent"><?php echo esc_html($property_agent_information_label); ?></label>
				<div class="agent-options-wrap">
					<span class="note"><?php esc_html_e('Select agent(s)', 'framework'); ?></span>
					<select name="agent_id[]" id="agent-selectbox" class="inspiry_select_picker_trigger show-tick" <?php echo $inspiry_user_role == 'agent' ? 'disabled' : '' ?> 	<?php
											$inspiry_search_form_multiselect_types = get_option('inspiry_search_form_multiselect_agents', 'yes');

											if ('yes' == $inspiry_search_form_multiselect_types) {
												?> multiple data-selected-text-format="count > 2"
							data-count-selected-text="{0} <?php esc_attr_e('Agents Selected', 'framework'); ?>" <?php
											}
											?> data-size="5"
						data-actions-box="true" title="<?php esc_attr_e('No Agent Selected', 'framework') ?>">
						<?php
						$postArgs = [
							'post_type' => 'agent'
						];

						if ($user_post_id) {
							if ($inspiry_user_role == 'agency') {
								$postArgs['meta_query'] = [
									[
										'key' => 'REAL_HOMES_agency',
										'value' => $user_post_id,
										'compare' => '=',
									],
								];
							}

							if (realhomes_dashboard_edit_property()) {
								if (isset($post_meta_data['REAL_HOMES_agents'])) {
									generate_posts_list($postArgs, $post_meta_data['REAL_HOMES_agents']);
								} else {
									generate_posts_list($postArgs, $default_agent);
								}
							} else {
								generate_posts_list($postArgs, $default_agent);
							}
						}
						?>
					</select>
				</div>
			</li>
			<?php
		}
		?>
	</ul>
</div>