<div class="rh-page-head">
	<?php
	// Breadcrumbs
	realhomes_breadcrumbs();
	?>
	<div class="rh-page-head-bottom">
		<?php
		// Current page ID
		$page_id = get_the_ID();

		// Blog page
		$is_home = is_home();
		$is_blog_page = $is_home || (is_single() && 'post' === get_post_type());
		if ($is_blog_page) {
			// Static blog page ID
			$page_id = get_option('page_for_posts');
		}

		// Check for the current page's page head content display.
		if ('hide' !== get_post_meta($page_id, 'realhomes_page_head_content', true)) {
			// Page title and description
			$page_title = get_post_meta($page_id, 'realhomes_page_title', true);
			$page_description = get_post_meta($page_id, 'realhomes_page_description', true);

			if (empty($page_title)) {
				$page_title = get_the_title();

				// Override the title for blog and single blog post.
				if ($is_blog_page) {
					// Get blog page title from customizer setting.
					$page_title = get_option('theme_news_banner_title');

					if (empty($page_title)) {
						// Default title for blog page.
						$page_title = esc_html__('News', 'framework');
					}
				}
			}

			if (empty($page_description) && $is_blog_page) {
				// Override the description for blog and single blog post.
				$page_description = get_option('realhomes_blog_page_description', esc_html__('Check out market updates', 'framework'));
			}

			if (is_singular('agent')) {
				$page_title = esc_html__('Agent', 'framework');
				$page_description = get_option('realhomes_single_agent_page_description', esc_html__('Agent profile page', 'framework'));

			} else if (is_singular('agency')) {
				$page_title = esc_html__('Agency', 'framework');
				$page_description = get_option('realhomes_single_agency_page_description', esc_html__('Agency profile page', 'framework'));

			} else if (function_exists('is_product') && is_product()) {
				$page_title = '';
				$page_description = '';

			} else if (is_category()) {
				$page_title = sprintf(esc_html__('All Posts in "%s" Category', 'framework'), single_cat_title('', false));
				$page_description = esc_html__('Category archive page', 'framework');

			} else if (is_tag()) {
				$page_title = sprintf(esc_html__('All Posts in "%s" Tag', 'framework'), single_tag_title('', false));
				$page_description = esc_html__('Tag archive page', 'framework');

			} else if (is_author()) {
				$page_title = sprintf(esc_html__('All Properties By %s', 'framework'), esc_html(get_the_author()));
				$page_description = esc_html__('Author profile page', 'framework');

			} else if (is_archive()) {
				$page_title = esc_html__('Archives', 'framework');
				$page_description = esc_html__('Archive page', 'framework');

				if (is_post_type_archive()) {
					$page_title = post_type_archive_title('', false);

					if (function_exists('is_shop') && is_shop()) {
						$page_description = '';
					}

				} else if (is_tax()) {
					$page_title = esc_html(single_term_title('', false));
					$page_description = '';

				} else if (is_day()) {
					$page_title = sprintf(esc_html__('"%s" Archives', 'framework'), get_the_date());

				} else if (is_month()) {
					$page_title = sprintf(esc_html__('"%s" Archives', 'framework'), get_the_date('F Y'));

				} else if (is_year()) {
					$page_title = sprintf(esc_html__('"%s" Archives', 'framework'), get_the_date('Y'));
				}

			} else if (is_search()) {
				$page_title = sprintf(esc_html__('Search Results for "%s" Query', 'framework'), get_search_query());
				$page_description = esc_html__('Search results page', 'framework');

			} else if (is_404()) {
				$page_title = esc_html__('Page Not Found!', 'framework');
				$page_description = esc_html__('Nothing here!', 'framework');
			}
			?>
			<div class="rh-page-head-column">
				<?php
				if (!empty($page_title) && !isset($GLOBALS['custom_search_title'])) {
					// Check for listing pages to show page title using h1 tag instead of h2.
					$is_listing_page = ($is_home || is_page() || is_archive());
					if ($is_listing_page) {
						?>
						<h1 class="rh-page-title"><?php echo esc_html($page_title); ?></h1>
						<?php
					} else {
						?>
						<h2 class="rh-page-title"><?php echo esc_html($page_title); ?></h2>
						<?php
					}
				}

				if (!empty($page_description)) {
					?>
					<p class="rh-page-description"><?php echo esc_html($page_description); ?></p>
					<?php
				}
				?>
			</div>
			<?php
		}
		?>
		<div class="rh-page-head-column">
			<?php
			if (
				'show' === get_option('inspiry_gallery_properties_sorting', 'hide') && is_page_template(
					array(
						'templates/properties-gallery.php',
						'templates/2-columns-gallery.php',
						'templates/3-columns-gallery.php',
						'templates/4-columns-gallery.php'
					)
				)
			) {
				get_template_part('assets/ultra/partials/properties/card-parts/sort-control');
			} else {
				$is_agents_list = ('show' === get_option('inspiry_agents_sorting', 'hide') && is_page_template('templates/agents-list.php'));
				if ($is_agents_list || ('show' === get_option('inspiry_agencies_sort_controls', 'hide') && is_page_template('templates/agencies-list.php'))) {
					?>
					<div class="rh_sort_controls rh-hide-before-ready">
						<label for="sort-properties"><?php esc_html_e('Sort By:'); ?></label>
						<select name="sort-properties" id="sort-properties"
							class="inspiry_select_picker_trigger rh-ultra-select-dropdown rh-ultra-select-light show-tick">
							<?php
							if ($is_agents_list) {
								inspiry_agent_sort_options();
							} else {
								inspiry_agency_sort_options();
							}
							?>
						</select>
					</div>
					<?php
				}
			}
			?>
		</div>
	</div><!-- .rh-page-head-inner -->
</div><!-- .rh-page-head -->