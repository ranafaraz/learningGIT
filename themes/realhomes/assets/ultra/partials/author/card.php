<?php
/**
 * Author Head Card
 *
 * Head card for author template.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

global $current_author;

// Get Author Information.
$current_author_id = $current_author->ID;
$current_author_meta = get_user_meta($current_author_id);
?>
<article class="agent-card single-agent-card">
	<div class="agent-card-inner">
		<figure class="agent-thumbnail">
			<?php
			// Author profile image.
			if (isset($current_author_meta['profile_image_id'])) {
				$profile_image_id = intval($current_author_meta['profile_image_id'][0]);
				if ($profile_image_id) {
					echo wp_get_attachment_image($profile_image_id, 'agent-image');
				}
			} else {
				echo get_avatar($current_author->user_email, '210');
			}
			?>
		</figure>
		<div class="agent-details">
			<header class="agent-card-header">
				<div class="agent-card-header-inner">
					<?php
					if (!empty($current_author->display_name)) {
						?>
						<h2 class="agent-title"><?php echo esc_html($current_author->display_name); ?></h2>
						<?php
					}

					$facebook_url = (isset($current_author_meta['facebook_url'])) ? $current_author_meta['facebook_url'][0] : false;
					$twitter_url = (isset($current_author_meta['twitter_url'])) ? $current_author_meta['twitter_url'][0] : false;
					$linked_in_url = (isset($current_author_meta['linkedin_url'])) ? $current_author_meta['linkedin_url'][0] : false;
					$instagram_url = (isset($current_author_meta['instagram_url'])) ? $current_author_meta['instagram_url'][0] : false;
					$youtube_url = (isset($current_author_meta['youtube_url'])) ? $current_author_meta['youtube_url'][0] : false;
					$pinterest_url = (isset($current_author_meta['pinterest_url'])) ? $current_author_meta['pinterest_url'][0] : false;

					$agent_website = '';
					$authordata = get_userdata($current_author_id);
					if (isset($authordata->user_url) && !empty($authordata->user_url)) {
						$agent_website = $authordata->user_url;
					}

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
					?>
				</div>
				<?php
				$agent_agency = (isset($current_author_meta['inspiry_user_agency'])) ? $current_author_meta['inspiry_user_agency'][0] : false;
				if (!empty($agent_agency) && ('-1' !== $agent_agency)) {
					?>
					<p class="agent-description">
						<?php
						printf('<span class="agent-agency">%s</span> <a href="%s">%s</a>', esc_html__('Company Agent at The', 'framework'), esc_url(get_the_permalink($agent_agency)), esc_html(get_the_title($agent_agency)));
						?>
					</p>
					<?php
				}
				?>

				<?php
				//debug_it( $current_author_meta );
				if (isset($current_author_meta['inspiry_user_role']) && 'agent' == $current_author_meta['inspiry_user_role']) {
					$agent_properties = 0;
					$agent_id = (isset($current_author_meta['inspiry_role_post_id'])) ? $current_author_meta['inspiry_role_post_id'][0] : false;

					if (function_exists('ere_get_agent_properties_count')) {
						$listed_properties = ere_get_agent_properties_count($agent_id);
						if (!empty($listed_properties)) {
							$agent_properties = $listed_properties;
						}
					}

					$listed_properties_text = sprintf(_n('%s Listed Property', '%s Listed Properties', $agent_properties, 'framework'), $agent_properties);
					if ('show' === get_option('inspiry_agent_properties_count', 'show')) {
						?>
						<span class="agent-listing-count"><?php echo esc_html($listed_properties_text); ?></span>
						<?php
					}
				}
				?>
				<div class="agent-details-separator"></div>
			</header>

			<div class="agent-contacts-list">
				<?php
				$agent_mobile = (isset($current_author_meta['mobile_number'])) ? $current_author_meta['mobile_number'][0] : false;
				$agent_office_phone = (isset($current_author_meta['office_number'])) ? $current_author_meta['office_number'][0] : false;
				$agent_office_fax = (isset($current_author_meta['fax_number'])) ? $current_author_meta['fax_number'][0] : false;
				$agent_whatsapp = (isset($current_author_meta['whatsapp_number'])) ? $current_author_meta['whatsapp_number'][0] : false;
				$agent_address = (isset($current_author_meta['inspiry_user_address'])) ? $current_author_meta['inspiry_user_address'][0] : false;
				$agent_email = is_email($current_author->user_email);

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
				if (!empty($agent_whatsapp)) {
					?>
					<div class="agent-contact-item">
						<?php inspiry_safe_include_svg('/icons/whatsapp.svg'); ?>
						<div class="agent-contact-item-inner">
							<h4 class="agent-contact-item-label"><?php esc_html_e('WhatsApp', 'framework'); ?></h4>
							<a
								href="https://wa.me/<?php echo esc_attr(str_replace(' ', '', $agent_whatsapp)); ?>"><?php echo esc_html($agent_whatsapp); ?></a>
						</div>
					</div>
					<?php
				}
				if (!empty($agent_office_fax)) {
					?>
					<div class="agent-contact-item">
						<?php inspiry_safe_include_svg('/icons/print.svg'); ?>
						<div class="agent-contact-item-inner">
							<h4 class="agent-contact-item-label"><?php esc_html_e('Fax', 'framework'); ?></h4>
							<a
								href="fax:<?php echo esc_attr(str_replace(' ', '', $agent_office_fax)); ?>"><?php echo esc_html($agent_office_fax); ?></a>
						</div>
					</div>
					<?php
				}
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
				if (!empty($agent_address)) {
					?>
					<div class="agent-contact-item agent-contact-item-address">
						<?php inspiry_safe_include_svg('/icons/pin-line.svg'); ?>
						<div class="agent-contact-item-inner">
							<h4 class="agent-contact-item-label"><?php esc_html_e('Address', 'framework'); ?></h4>
							<span><?php echo inspiry_kses($agent_address); ?></span>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>

	<?php
	if (isset($current_author_meta['description'])) {
		?>
		<div class="agent-content">
			<h3 class="agent-content-heading rh-page-heading"><?php esc_html_e('About', 'framework') ?></h3>
			<p><?php echo esc_html($current_author_meta['description'][0]); ?></p>
		</div>
		<?php
	}
	?>
</article><!-- /.agent-card -->