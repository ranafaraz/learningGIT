<?php
/**
 * Single agency Card
 *
 * Displays agency info for agency detail page.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

$agency_id = get_the_ID();
?>
<article class="agency-card single-agency-card">
	<div class="agency-card-inner">
		<figure class="agency-thumbnail">
			<?php
			if (!empty(get_the_post_thumbnail($agency_id))) {
				?>
				<a title="<?php the_title_attribute(); ?>" href="<?php echo get_permalink($agency_id); ?>">
					<?php echo get_the_post_thumbnail($agency_id, 'agent-image'); ?>
				</a>
				<?php
			} else {
				?>
				<a title="<?php the_title_attribute(); ?>" href="<?php echo get_permalink($agency_id); ?>">
					<?php inspiry_image_placeholder('agent-image'); ?>
				</a>
				<?php
			}
			?>
		</figure>

		<div class="agency-details">
			<header class="agency-card-header">
				<div class="agency-card-header-inner">
					<h1 class="agency-title">
						<?php
						echo get_the_title($agency_id);
						realhomes_verification_badge('agency', $agency_id);
						?>
					</h1>
					<?php
					$facebook_url = get_post_meta($agency_id, 'REAL_HOMES_facebook_url', true);
					$twitter_url = get_post_meta($agency_id, 'REAL_HOMES_twitter_url', true);
					$linked_in_url = get_post_meta($agency_id, 'REAL_HOMES_linked_in_url', true);
					$instagram_url = get_post_meta($agency_id, 'inspiry_instagram_url', true);
					$youtube_url = get_post_meta($agency_id, 'inspiry_youtube_url', true);
					$pinterest_url = get_post_meta($agency_id, 'inspiry_pinterest_url', true);
					$agency_website = get_post_meta($agency_id, 'REAL_HOMES_website', true);

					if (
						!empty($facebook_url) ||
						!empty($twitter_url) ||
						!empty($linked_in_url) ||
						!empty($instagram_url) ||
						!empty($youtube_url) ||
						!empty($pinterest_url) ||
						!empty($agency_website)
					) {
						?>
						<div class="agency-social-links">
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

							if (!empty($agency_website)) {
								?>
								<a class="website-icon" target="_blank" href="<?php echo esc_url($agency_website); ?>"><i
										class="fas fa-globe fa-lg"></i></a>
								<?php
							}
							?>
						</div>
						<?php
					}
					?>
				</div>
				<?php
				if ('show' === get_option('inspiry_agencies_properties_count', 'show')) {
					$agency_properties = 0;

					if (function_exists('ere_get_agent_properties_count')) {
						$listed_properties = ere_get_agency_properties_count($agency_id);
						if (!empty($listed_properties)) {
							$agency_properties = $listed_properties;
						}
					}

					$listed_properties_text = sprintf(_n('%s Listed Property', '%s Listed Properties', $agency_properties, 'framework'), $agency_properties);
					?>
					<span class="agency-listing-count"><?php echo esc_html($listed_properties_text); ?></span>
					<?php
				}
				?>
				<div class="agency-details-separator"></div>
			</header>

			<div class="agency-contacts-list">
				<?php
				$agency_mobile = get_post_meta($agency_id, 'REAL_HOMES_mobile_number', true);
				$agency_whatsapp = get_post_meta($agency_id, 'REAL_HOMES_whatsapp_number', true);
				$agency_office_phone = get_post_meta($agency_id, 'REAL_HOMES_office_number', true);
				$agency_office_fax = get_post_meta($agency_id, 'REAL_HOMES_fax_number', true);
				// $agency_email = get_post_meta($agency_id, 'REAL_HOMES_agency_email', true);
				$agency_address = get_post_meta($agency_id, 'REAL_HOMES_address', true);

				if (!empty($agency_office_phone)) {
					?>
					<div class="agency-contact-item">
						<?php inspiry_safe_include_svg('/icons/card-number.svg'); ?>
						<div class="agency-contact-item-inner">
							<h4 class="agency-contact-item-label"><?php esc_html_e('Office', 'framework'); ?></h4>
							<a
								href="tel:<?php echo esc_attr(str_replace(' ', '', $agency_office_phone)); ?>"><?php echo esc_html($agency_office_phone); ?></a>
						</div>
					</div>
					<?php
				}
				if (!empty($agency_mobile)) {
					?>
					<div class="agency-contact-item">
						<?php inspiry_safe_include_svg('/icons/phone.svg'); ?>
						<div class="agency-contact-item-inner">
							<h4 class="agency-contact-item-label"><?php esc_html_e('Mobile', 'framework'); ?></h4>
							<a
								href="tel:<?php echo esc_attr(str_replace(' ', '', $agency_mobile)); ?>"><?php echo esc_html($agency_mobile); ?></a>
						</div>
					</div>
					<?php
				}
				if (!empty($agency_whatsapp)) {
					?>
					<div class="agency-contact-item">
						<?php inspiry_safe_include_svg('/icons/whatsapp.svg'); ?>
						<div class="agency-contact-item-inner">
							<h4 class="agency-contact-item-label"><?php esc_html_e('WhatsApp', 'framework'); ?></h4>
							<a
								href="https://wa.me/<?php echo esc_attr(str_replace(' ', '', $agency_whatsapp)); ?>"><?php echo esc_html($agency_whatsapp); ?></a>
						</div>
					</div>
					<?php
				}
				if (!empty($agency_office_fax)) {
					?>
					<div class="agency-contact-item">
						<?php inspiry_safe_include_svg('/icons/print.svg'); ?>
						<div class="agency-contact-item-inner">
							<h4 class="agency-contact-item-label"><?php esc_html_e('Fax', 'framework'); ?></h4>
							<a
								href="fax:<?php echo esc_attr(str_replace(' ', '', $agency_office_fax)); ?>"><?php echo esc_html($agency_office_fax); ?></a>
						</div>
					</div>
					<?php
				}
				/*
						if (!empty($agency_email)) {
							?>
							<div class="agency-contact-item">
								<?php inspiry_safe_include_svg('/icons/email.svg'); ?>
								<div class="agency-contact-item-inner">
									<h4 class="agency-contact-item-label"><?php esc_html_e('Email', 'framework'); ?></h4>
									<a
										href="mailto:<?php echo esc_attr(antispambot($agency_email)); ?>"><?php echo esc_html(antispambot($agency_email)); ?></a>
								</div>
							</div>
							<?php
						}
						*/
				if (!empty($agency_address)) {
					?>
					<div class="agency-contact-item agency-contact-item-address">
						<?php inspiry_safe_include_svg('/icons/pin-line.svg'); ?>
						<div class="agency-contact-item-inner">
							<h4 class="agency-contact-item-label"><?php esc_html_e('Address', 'framework'); ?></h4>
							<span><?php echo inspiry_kses($agency_address); ?></span>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
	<?php
	if (get_the_content()) {
		?>
		<div class="agency-content">
			<h3 class="agency-content-heading rh-page-heading"><?php esc_html_e('About', 'framework') ?></h3>
			<?php the_content(); ?>
		</div>
		<?php
	}


	if (function_exists('realhomes_generate_properties_stats_chart') && 'show' === get_option('realhomes_agency_single_stats_charts', 'show')) {
		?>
		<div class="stats-charts-wrap agency">
			<h3>
				<?php echo esc_html(get_option('realhomes_agency_stats_section_title', esc_html__('Progress & Stats', 'framework'))); ?>
			</h3>
			<div class="stats-wrapper">
				<div class="tax-stats property-city">
					<h3>
						<?php echo preg_replace('/^(\w+)/isux', '<span>$1</span>', esc_html__('Property Location', 'framework')); ?>
					</h3>
					<?php realhomes_generate_properties_stats_chart($agency_id, 'property-city', 'agency'); ?>
				</div>
				<div class="tax-stats property-type">
					<h3><?php echo preg_replace('/^(\w+)/isux', '<span>$1</span>', esc_html__('Property Type', 'framework')); ?>
					</h3>
					<?php realhomes_generate_properties_stats_chart($agency_id, 'property-type', 'agency'); ?>
				</div>
				<div class="tax-stats property-status">
					<h3>
						<?php echo preg_replace('/^(\w+)/isux', '<span>$1</span>', esc_html__('Property Status', 'framework')); ?>
					</h3>
					<?php realhomes_generate_properties_stats_chart($agency_id, 'property-status', 'agency'); ?>
				</div>
			</div>
		</div>
		<?php
	}
	?>
</article><!-- /.agency-card -->