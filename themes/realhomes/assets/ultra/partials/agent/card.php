<?php
/**
 * Agent Card
 *
 * Agent card for agent listing.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

$agent_id = get_the_ID();
?>
<article class="agent-card">
	<div class="agent-card-inner">
		<?php
		if (!empty(get_the_post_thumbnail($agent_id))) {
			?>
			<figure class="agent-thumbnail">
				<a title="<?php the_title_attribute(); ?>" href="<?php echo get_permalink($agent_id); ?>">
					<?php echo get_the_post_thumbnail($agent_id, 'agent-image'); ?>
				</a>
			</figure>
			<?php
		} else {
			?>
			<figure class="agent-thumbnail agent-thumb-placeholder">
				<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
					<i class="fas fa-user-tie"></i>
				</a>
			</figure>
			<?php
		}
		?>

		<div class="agent-details">
			<header class="agent-card-header">
				<h3 class="agent-title">
					<a href="<?php echo get_permalink($agent_id); ?>"><?php echo get_the_title($agent_id); ?></a>
					<?php
					if (0 < intval($agent_id)) {
						realhomes_verification_badge('agent', $agent_id);
					}
					?>
				</h3>
				<?php
				if (isset($args['excerpt']) && true === $args['excerpt']) {
					?>
					<p class="agent-description">
						<?php framework_excerpt(7, "&hellip;"); ?>
					</p>
					<?php

				} else {
					$agent_agency = get_post_meta(get_the_ID(), 'REAL_HOMES_agency', true);
					if (!empty($agent_agency) && ('-1' !== $agent_agency)) {
						?>
						<p class="agent-description">
							<?php
							printf('<span class="agent-agency">%s</span> <a href="%s">%s</a>', esc_html__('Company Agent at The', 'framework'), esc_url(get_the_permalink($agent_agency)), esc_html(get_the_title($agent_agency)));
							?>
						</p>
						<?php
					}
				}

				// Display average rating for the agent
				if (realhomes_get_rating_status()) {
					inspiry_rating_average();
				}
				?>
				<div class="agent-details-separator"></div>
			</header>

			<div class="agent-contacts-list">
				<?php
				$agent_office_phone = get_post_meta($agent_id, 'REAL_HOMES_office_number', true);
				$agent_mobile = get_post_meta($agent_id, 'REAL_HOMES_mobile_number', true);
				// $agent_email = get_post_meta($agent_id, 'REAL_HOMES_agent_email', true);
				
				if (!empty($agent_office_phone)) {
					?>
					<div class="agent-contact-item">
						<?php inspiry_safe_include_svg('/icons/phone.svg'); ?>
						<div class="agent-contact-item-inner">
							<h4 class="agent-contact-item-label"><?php esc_html_e('Office', 'framework'); ?></h4>
							<a
								href="tel:<?php echo esc_attr(str_replace(' ', '', $agent_office_phone)); ?>"><?php echo esc_html($agent_office_phone); ?></a>
						</div>
					</div>
					<?php
				}
				if (!empty($agent_mobile)) {
					?>
					<div class="agent-contact-item">
						<?php inspiry_safe_include_svg('/icons/phone.svg'); ?>
						<div class="agent-contact-item-inner">
							<h4 class="agent-contact-item-label"><?php esc_html_e('Mobile', 'framework'); ?></h4>
							<a
								href="tel:<?php echo esc_attr(str_replace(' ', '', $agent_mobile)); ?>"><?php echo esc_html($agent_mobile); ?></a>
						</div>
					</div>
					<?php
				}
				/*
						if (!empty($agent_email)) {
							?>
							<div class="agent-contact-item">
								<?php inspiry_safe_include_svg('/icons/email.svg'); ?>
								<div class="agent-contact-item-inner">
									<h4 class="agent-contact-item-label"><?php esc_html_e('Email', 'framework'); ?></h4>
									<a
										href="mailto:<?php echo esc_attr(antispambot($agent_email)); ?>"><?php echo esc_html(antispambot($agent_email)); ?></a>
								</div>
							</div>
							<?php
						}
						*/
				?>
			</div>

			<footer class="agent-card-footer">
				<?php
				$facebook_url = get_post_meta($agent_id, 'REAL_HOMES_facebook_url', true);
				$twitter_url = get_post_meta($agent_id, 'REAL_HOMES_twitter_url', true);
				$linked_in_url = get_post_meta($agent_id, 'REAL_HOMES_linked_in_url', true);
				$instagram_url = get_post_meta($agent_id, 'inspiry_instagram_url', true);
				$youtube_url = get_post_meta($agent_id, 'inspiry_youtube_url', true);
				$pinterest_url = get_post_meta($agent_id, 'inspiry_pinterest_url', true);
				$agent_website = get_post_meta($agent_id, 'REAL_HOMES_website', true);

				if (
					!empty($facebook_url) ||
					!empty($twitter_url) ||
					!empty($linked_in_url) ||
					!empty($instagram_url) ||
					!empty($youtube_url) ||
					!empty($pinterest_url) ||
					!empty($agent_website)
				) {
					?>
					<div class="agent-social-links">
						<?php
						if (!empty($facebook_url)) {
							?><a class="facebook" target="_blank" href="<?php echo esc_url($facebook_url); ?>">
								<i class="fab fa-facebook fa-lg"></i></a><?php
						}

						if (!empty($twitter_url)) {
							?><a class="twitter" target="_blank" href="<?php echo esc_url($twitter_url); ?>">
								<i class="fab fa-twitter fa-lg"></i></a><?php
						}

						if (!empty($linked_in_url)) {
							?><a class="linkedin" target="_blank" href="<?php echo esc_url($linked_in_url); ?>">
								<i class="fab fa-linkedin fa-lg"></i></a><?php
						}

						if (!empty($instagram_url)) {
							?><a class="instagram" target="_blank" href="<?php echo esc_url($instagram_url); ?>">
								<i class="fab fa-instagram fa-lg"></i></a><?php
						}
						if (!empty($youtube_url)) {
							?><a class="youtube" target="_blank" href="<?php echo esc_url($youtube_url); ?>">
								<i class="fab fa-youtube-square fa-lg"></i></a><?php
						}

						if (!empty($pinterest_url)) {
							?><a class="pinterest" target="_blank" href="<?php echo esc_url($pinterest_url); ?>">
								<i class="fab fa-pinterest fa-lg"></i></a><?php
						}

						if (!empty($agent_website)) {
							?>
							<a class="website-icon" target="_blank" href="<?php echo esc_url($agent_website); ?>"><i
									class="fas fa-globe fa-lg"></i></a>
							<?php
						}
						?>
					</div>
					<?php
				}

				if ('show' === get_option('inspiry_agent_properties_count', 'show')) {
					$agent_properties = 0;

					if (function_exists('ere_get_agent_properties_count')) {
						$listed_properties = ere_get_agent_properties_count($agent_id);
						if (!empty($listed_properties)) {
							$agent_properties = $listed_properties;
						}
					}

					$listed_properties_text = sprintf(_n('%s Listed Property', '%s Listed Properties', $agent_properties, 'framework'), $agent_properties);
					?>
					<a class="agent-listing-count"
						href="<?php echo get_permalink($agent_id); ?>"><?php echo esc_html($listed_properties_text); ?>
						<i class="fas fa-caret-right"></i>
					</a>
					<?php
				}
				?>
			</footer>
		</div>
	</div>
</article><!-- /.agent-card -->