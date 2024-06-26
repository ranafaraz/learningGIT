<?php
/**
 * Single Agency
 *
 * Template for single agency.
 *
 * @package    realhomes
 * @subpackage ultra
 * @since      4.0.0
 */

get_header();

if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('single-agency')) {
	$realhomes_elementor_agency_single_meta_template = get_post_meta(get_the_ID(), 'realhomes_elementor_single_agent_agency_template', true); // meta value for single Agent/Agency Elementor template
	$realhomes_elementor_agency_single_template = get_option('realhomes_elementor_agency_single_template', 'default'); // global option for single Agency Elementor template
	if (class_exists('RHEA_Elementor_Single_Agency') && ('default' !== $realhomes_elementor_agency_single_template || (!empty($realhomes_elementor_agency_single_meta_template) && 'default' !== $realhomes_elementor_agency_single_meta_template))) {
		do_action('realhomes_elementor_agency_single_template');
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

								get_template_part('assets/ultra/partials/agency/single/card');
							}
						}
						?>

						<div class="agency-contact-form-wrapper">
							<h3 class="agency-contact-form-heading rh-page-heading"><?php esc_html_e('Contact us', 'framework'); ?></h3>
							<?php get_template_part('assets/ultra/partials/agency/single/contact-form'); ?>
						</div>

						<h3 class="agency-agents-heading rh-page-heading"><?php esc_html_e('Our Agents', 'framework'); ?></h3>
						<div class="agency-agents">
							<?php
							$paged = 1;
							if (get_query_var('paged')) {
								$paged = get_query_var('paged');
							}

							$number_of_properties = get_option('inspiry_number_of_agents_agency', '6');

							$agency_agents_args = array(
								'post_type' => 'agent',
								'posts_per_page' => intval($number_of_properties),
								'meta_query' => array(
									array(
										'key' => 'REAL_HOMES_agency',
										'value' => get_the_ID(),
										'compare' => '=',
									),
								),
								'paged' => $paged,
							);

							$agency_agents_query = new WP_Query(apply_filters('realhomes_agency_agents', $agency_agents_args));

							if ($agency_agents_query->have_posts()) {
								$args = array(
									'excerpt' => true,
								);
								while ($agency_agents_query->have_posts()) {
									$agency_agents_query->the_post();

									get_template_part('assets/ultra/partials/agent/card', '', $args);
								}

								inspiry_theme_pagination($agency_agents_query->max_num_pages);

								wp_reset_postdata();
							} else {
								?>
								<div class="rh-alert-wrapper">
									<h6 class="no-results"><?php esc_html_e('No Agent Found!', 'framework') ?></h6>
								</div>
								<?php
							}
							?>
						</div>

						<?php
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
				$attached_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar('agency-sidebar');
				if (is_active_sidebar($attached_sidebar)) {
					?>
					<div class="col-4 sidebar-content">
						<?php get_sidebar('agency'); ?>
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
