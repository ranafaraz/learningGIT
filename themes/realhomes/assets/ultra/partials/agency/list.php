<?php
/**
 * Agency List
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

				$agencies_args = array(
					'post_type' => 'agency',
					'posts_per_page' => intval(get_option('inspiry_number_posts_agency', 3)),
					'paged' => $paged,
				);

				// Filter out agents based on their post title (if any starts with 'agency_' then exclude it)
				$agencies_args['s'] = '-agency_';

				// Exclude also specific agents
				$exclude_agencies = [6213];
				$agencies_args['post__not_in'] = $exclude_agencies;

				$agencies_args = inspiry_agencies_sort_args($agencies_args);
				$agencies_query = new WP_Query(apply_filters('realhomes_agencies_list', $agencies_args));

				if ($agencies_query->have_posts()) {
					while ($agencies_query->have_posts()) {
						$agencies_query->the_post();

						get_template_part('assets/ultra/partials/agency/card');
					}

					inspiry_theme_pagination($agencies_query->max_num_pages);

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