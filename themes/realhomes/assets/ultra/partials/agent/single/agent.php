<?php
/**
 * Single Agent
 *
 * Template for single agent.
 *
 * @package    realhomes
 * @subpackage ultra
 * @since      4.0.0
 */

get_header();

if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('single-agent')) {
	$realhomes_elementor_agent_single_meta_template = get_post_meta(get_the_ID(), 'realhomes_elementor_single_agent_agency_template', true); // meta value for single Agent/Agency post design Elementor template
	$realhomes_elementor_agent_single_template = get_option('realhomes_elementor_agent_single_template', 'default'); // global option for single Agent Elementor template
	if (class_exists('RHEA_Elementor_Single_Agent') && ('default' !== $realhomes_elementor_agent_single_template || (!empty($realhomes_elementor_agent_single_meta_template) && 'default' !== $realhomes_elementor_agent_single_meta_template))) {
		do_action('realhomes_elementor_agent_single_template');
	} else {
		?>
		<div class="rh-page-container container">
			<div class="row">
				<div class="col-8 main-content">
					<?php
					get_template_part('assets/ultra/partials/page-head');

					// Display any contents after the page head and before the contents.
					do_action('inspiry_before_page_contents');
					?>
					<main id="main" class="rh-main main">
						<?php
						if (have_posts()) {
							while (have_posts()) {
								the_post();

								get_template_part('assets/ultra/partials/agent/single/card');
							}
						}
						?>
						<div class="agent-contact-form-wrapper">
							<h3 class="agent-contact-form-heading rh-page-heading"><?php esc_html_e('Contact me', 'framework'); ?></h3>
							<?php get_template_part('assets/ultra/partials/agent/single/contact-form'); ?>
						</div>
						<?php
						if ('show' === get_option('inspiry_agent_single_properties', 'show')) {
							?>
							<h3 class="agent-properties-heading rh-page-heading"><?php esc_html_e('My Listings', 'framework'); ?></h3>
							<div class="agent-properties">
								<?php
								global $paged;

								$number_of_properties = get_option('theme_number_of_properties_agent', '6');

								$agent_properties_args = array(
									'post_type' => 'property',
									'posts_per_page' => intval($number_of_properties),
									'meta_query' => array(
										array(
											'key' => 'REAL_HOMES_agents',
											'value' => get_the_ID(),
											'compare' => '=',
										),
									),
									'paged' => $paged,
								);

								$agent_properties_listing_query = new WP_Query(apply_filters('inspiry_agent_single_properties', $agent_properties_args));

								$listings_max_num_pages = null;

								if ($agent_properties_listing_query->have_posts()) {
									while ($agent_properties_listing_query->have_posts()) {
										$agent_properties_listing_query->the_post();

										// Display Property for Listing
										// get_template_part('assets/ultra/partials/properties/list-card-1');
										get_template_part('assets/ultra/partials/properties/grid-card-1');
									}

									$listings_max_num_pages = $agent_properties_listing_query->max_num_pages;

									wp_reset_postdata();
								} else {
									?>
									<div class="rh-alert-wrapper">
										<h4 class="no-results"><?php esc_html_e('No Property Found!', 'framework') ?></h4>
									</div>
									<?php
								}
								?>
							</div>
							<?php
							if (isset($listings_max_num_pages) && $listings_max_num_pages) {
								inspiry_theme_pagination($agent_properties_listing_query->max_num_pages);
							}
						}

						// If comments are open, or we have at least one comment, load up the comment template.
						if (comments_open() || get_comments_number()) {
							?>
							<section class="realhomes-comments">
								<?php
								comments_template();
								?>
							</section>
							<?php
						}
						?>
					</main>
				</div>
				<?php
				$attached_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar('agent-sidebar');
				if (is_active_sidebar($attached_sidebar)) {
					?>
					<div class="col-4 sidebar-content">
						<?php get_sidebar('agent'); ?>
					</div>
					<?php
				}
				?>
			</div>
		</div><!-- .rh-page-container -->
		<?php
	}
}
get_footer();
