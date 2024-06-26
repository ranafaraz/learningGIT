<?php
/**
 * Template for Single Property or Property Detail Page
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

get_header();

if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('single-property')) {
	$realhomes_elementor_single_property_display = get_post_meta(get_the_ID(), 'realhomes_elementor_single_property_display', true); // meta value for single property post design template
	$realhomes_elementor_property_single_template = get_option('realhomes_elementor_property_single_template', 'default'); // global option for single property template
	if (class_exists('RHEA_Elementor_Header_Footer') && ('default' !== $realhomes_elementor_property_single_template || (!empty($realhomes_elementor_single_property_display) && 'default' !== $realhomes_elementor_single_property_display))) {
		?>
		<div class="rh-ultra-property-wrapper rh-ultra-content-container">
			<?php do_action('realhomes_elementor_single_property_content'); ?>
		</div>
		<?php
	} else {
		$theme_property_detail_variation = get_option('theme_property_detail_variation', 'default');
		// Property detail page sections
		$sortable_property_sections = array(
			'content' => 'true',
			'additional-details' => 'true',
			'common-note' => get_option('theme_display_common_note', 'true'),
			'entry-date' => 'true',
			'features' => 'true',
			'attachments' => get_option('theme_display_attachments', 'true'),
			'floor-plans' => 'true',
			'video' => get_option('theme_display_video', 'true'),
			'virtual-tour' => get_option('inspiry_display_virtual_tour', 'false'),
			'map' => get_option('theme_display_google_map', 'true'),
			'walkscore' => get_option('inspiry_display_walkscore', 'false'),
			'yelp-nearby-places' => get_option('inspiry_display_yelp_nearby_places', 'false'),
			'energy-performance' => get_option('inspiry_display_energy_performance', 'true'),
			'property-views' => get_option('inspiry_display_property_views', 'true'),
			'rvr/guests-accommodation' => get_option('inspiry_guests_accommodation_display', 'true'),
			'rvr/price-details' => get_option('inspiry_price_details_display', 'true'),
			'rvr/seasonal-prices' => get_option('inspiry_seasonal_prices_display', 'true'),
			'rvr/availability-calendar' => get_option('inspiry_display_availability_calendar', 'true'),
			'schedule-a-tour' => 'true',
			'children' => 'true',
			'agent' => ('default' === $theme_property_detail_variation && get_option('theme_display_agent_info', 'true')) ? 'true' : 'false',
			'mortgage-calculator' => get_option('inspiry_mc_display', 'false'),
		);
		$sortable_property_sections = apply_filters('realhomes_property_default_sections', $sortable_property_sections);
		$property_sections_order = array_keys($sortable_property_sections);
		$order_settings = get_theme_mod('inspiry_property_sections_order_default', 'default');
		if ('custom' === $order_settings) {
			$property_sections_order = get_option('inspiry_property_sections_order_mod');
			$property_sections_order = explode(',', $property_sections_order);
		}
		?>
		<div class="rh-ultra-property-wrapper rh-ultra-content-container">
			<?php
			do_action('inspiry_before_page_contents');
			if (have_posts()) {
				while (have_posts()) {
					the_post();
					get_template_part('assets/ultra/partials/property/single/slider');
					if (!post_password_required()) {
						?>
						<div class="rh-ultra-property-content">
							<div class="rh-ultra-property-content-box">
								<?php
								get_template_part('assets/ultra/partials/property/single/overview');
								$prop_detail_login = inspiry_prop_detail_login();
								if ('yes' == $prop_detail_login && !is_user_logged_in()) {
									?>
									<div class="rh_form rh_property_detail_login">
										<?php
										get_template_part('assets/ultra/partials/member/login-form');
										get_template_part('assets/ultra/partials/member/register-form');
										?>
									</div>
									<?php
								} else {
									get_template_part('assets/ultra/partials/property/single/meta-icons');
									// Display sections according to their order
									if (!empty($property_sections_order) && is_array($property_sections_order)) {
										foreach ($property_sections_order as $section) {
											if (isset($sortable_property_sections[$section]) && 'true' === $sortable_property_sections[$section]) {
												get_template_part('assets/ultra/partials/property/single/' . $section);
											}
										}
									}
									?>
									<section class="property-comments realhomes_comments rh-ultra-property-comment margin-bottom-40px">
										<?php
										/**
										 * Comments
										 *
										 * If comments are open or we have at least one comment, load up the comment template.
										 */
										if (comments_open() || get_comments_number()) {
											comments_template();
										}
										?>
									</section>
									<?php
								}
								?>
							</div>
							<div class="rh-ultra-property-sidebar">
								<?php
								if ('agent-in-sidebar' === $theme_property_detail_variation) {
									?>
									<aside class="rh-property-sidebar rh-sidebar sidebar">
										<?php
										/**
										 * Action hook to display contents above agent.
										 *
										 * @since 4.1.1
										 */
										do_action('realhomes_above_single_property_sidebar_agent');

										get_template_part('assets/ultra/partials/property/single/agent-for-sidebar');

										$attached_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar('property-sidebar');
										if (is_active_sidebar($attached_sidebar)) {
											dynamic_sidebar($attached_sidebar);
										}
										?>
									</aside>
									<?php
								} else {
									get_sidebar('property');
								}
								?>
							</div>
						</div>
						<?php
					}
				}
				get_template_part('assets/ultra/partials/property/single/similar-properties');
			}
			?>
		</div>
		<?php
	}
}

get_footer();

