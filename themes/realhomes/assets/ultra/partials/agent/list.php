<?php
/**
 * Agents List
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */
?>
<div class="rh-page-container container">
	<div class="row">
		<div class="col-8 main-content">
			<?php
			get_template_part('assets/ultra/partials/page-head');

			// Display any contents after the page head and before the contents.
			do_action('inspiry_before_page_contents');

			// Display page content area at top
			do_action('realhomes_content_area_at_top');
			?>
			<main id="main" class="rh-main main">
				<?php
				$paged = 1;
				if (get_query_var('paged')) {
					$paged = get_query_var('paged');
				}

				$agents_query = array(
					'post_type' => 'agent',
					'posts_per_page' => intval(get_option('theme_number_posts_agent', '3')),
					'paged' => $paged,
				);

				// Filter out agents based on their post title (if any starts with 'agent_' then exclude it)
				$agents_query['s'] = '-agent_';

				// Exclude also specific agents
				$exclude_agents = [6220];
				$agents_query['post__not_in'] = $exclude_agents;

				$agents_query = inspiry_agents_sort_args($agents_query);
				$agent_listing_query = new WP_Query($agents_query);

				if ($agent_listing_query->have_posts()) {
					while ($agent_listing_query->have_posts()) {
						$agent_listing_query->the_post();

						get_template_part('assets/ultra/partials/agent/card');
					}

					inspiry_theme_pagination($agent_listing_query->max_num_pages);

					wp_reset_postdata();
				} else {
					realhomes_print_no_result();
				}
				?>
			</main>
			<?php
			// Display page content area at bottom
			do_action('realhomes_content_area_at_bottom');
			?>
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