<?php
/**
 * This file contains card style one.
 *
 * @version 2.2.0
 */
global $settings;

$property_id = get_the_ID();
$is_featured = get_post_meta($property_id, 'REAL_HOMES_featured', true);
$label_text = get_post_meta($property_id, 'inspiry_property_label', true);
?>
<div class="rhea-ultra-property-card-outer">
	<div class="rhea-ultra-property-card">
		<div class="rhea-ultra-card-thumb-wrapper">
			<div class="rhea-ultra-property-thumb">
				<?php rhea_get_template_part('assets/partials/ultra/thumbnail'); ?>
			</div>
			<div class="rhea-ultra-top-tags-box">
				<div class="rhea-ultra-status-box">
					<?php
					if ('yes' == $settings['ere_show_property_status']) {
						if (function_exists('ere_get_property_statuses_ultra')) {
							ere_get_property_statuses_ultra($property_id, 'rhea-ultra-status');
						}
					}

					if ('yes' == $settings['ere_show_featured_tag']) {
						if (isset($is_featured) && $is_featured == '1') {
							?>
							<span class="rhea_ultra_featured">
								<?php
								if (!empty($settings['ere_property_featured_label'])) {
									echo esc_html($settings['ere_property_featured_label']);
								} else {
									esc_html_e('Featured', 'realhomes-elementor-addon');
								}
								?>
							</span>
							<?php
						}
					}

					if ('yes' == $settings['ere_show_label_tags']) {
						rhea_display_property_label($property_id, 'rhea_ultra_hot');
					}
					?>
				</div>
				<?php
				if ('yes' == $settings['ere_show_property_media_count']) {
					?>
					<div class="rhea-ultra-media-count-box">
						<?php rhea_get_template_part('assets/partials/ultra/media-count'); ?>
					</div>
					<?php
				}
				?>
			</div>
			<div class="rhea-ultra-bottom-box rhea-ultra-flex-end">
				<div class="rhea-ultra-action-buttons rh-ultra-action-light hover-light">
					<?php
					if ('yes' === $settings['ere_enable_fav_properties']) {
						if (function_exists('inspiry_favorite_button')) {
							inspiry_favorite_button($property_id, $settings['ere_property_fav_label'], $settings['ere_property_fav_added_label'], '/common/images/icons/ultra-favourite.svg', 'ultra');
						}
					}

					rhea_get_template_part('assets/partials/ultra/compare');
					?>
				</div>
			</div>
		</div>
		<div class="rhea-ultra-card-detail-wrapper">
			<?php
			rhea_get_template_part('assets/partials/ultra/heading');
			rhea_get_template_part('assets/partials/ultra/address');

			if ('yes' == $settings['ere_show_property_type']) {
				$type_terms = get_the_terms($property_id, "property-type");
				if (!empty($type_terms)) {
					if (function_exists('ere_get_property_types') && !empty(ere_get_property_types($property_id))) {
						?>
						<span class="rhea-ultra-property-types">
							<?php echo ere_get_property_types($property_id, true); ?>
						</span>
						<?php
					}
				}
			}
			?>
			<div
				class="rhea-ultra-price-meta-box <?php echo 'yes' !== $settings['show_price_slash'] ? esc_attr('hide-ultra-price-postfix-separator') : ' '; ?>">
				<?php
				rhea_get_template_part('assets/partials/ultra/price');
				rhea_get_template_part('assets/partials/ultra/grid-card-meta');
				?>
			</div>
			<div class="rvr_card_info_wrap">
				<?php
				if (rhea_is_rvr_enabled()) {
					if ($settings['rhea_rating_enable']) {
						?>
						<div class="rh-ultra-rvr-rating">
							<?php
							if ('true' === get_option('inspiry_property_ratings', 'false')) {
								inspiry_rating_average_plain();
							}
							?>
						</div>
						<?php
					}
				}
				?>
				<p class="added-date">
					<?php
					if ($settings['ere_property_rvt_date_added_label']) {
						echo '<span class="added-title">' . esc_html($settings['ere_property_rvt_date_added_label']) . '</span> ';
					}

					// Get the date components
					$day = get_the_date('j');  // Day without leading zeros
					$month = get_the_date('F');  // Full month name
					$year = get_the_date('Y');  // Full year
					
					// Format the date
					$formatted_date = $day . ' ב' . dirabe_get_hebrew_month($month) . ' ' . $year;
					echo $formatted_date;
					?>
				</p>
			</div>
		</div>
	</div>
</div>