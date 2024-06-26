<?php
/**
 * Agent/Agency Card
 *
 * Partial template for ultra-agent-agency-posts-card.php
 *
 * @since 2.3.0
 */
global $settings;

if ( 'yes' !== $settings['all_agent_agency_posts'] ) {
	if ( ! empty( $settings['agent_id'] ) ) {
		$agent_id = $settings['agent_id'];
	} else if ( is_singular( 'agent' ) || is_singular( 'agency' ) ) {
		$agent_id = get_the_ID();
	} else if ( rhea_is_preview_mode() ) {
		$agent_id = rhea_get_sample_agent_id();
	} else {
		return ;
	}
} else {
	$agent_id = get_the_ID();
}

$agent_title = get_the_title( $agent_id );

if ( ! empty( $agent_id ) ) {
	?>
    <article class="agent-card single-agent-card rhea-single-agent-card">
        <div class="agent-card-inner">
			<?php
			$the_post_thumbnail = get_the_post_thumbnail( $agent_id, 'agent-image', array( 'title' => esc_attr( $agent_title ), 'alt' => esc_attr( $agent_title ) ) );
			if ( ! empty( $the_post_thumbnail ) ) {
				?>
                <figure class="agent-thumbnail">
                    <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
						<?php echo $the_post_thumbnail; ?>
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
                    <div class="agent-card-header-inner">
                        <h2 class="agent-title">
                            <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
								<?php echo esc_html( $agent_title ); ?>
                            </a>
							<?php
							realhomes_verification_badge( 'agent', $agent_id );
							?>
                        </h2>
						<?php
						$facebook_url  = get_post_meta( $agent_id, 'REAL_HOMES_facebook_url', true );
						$twitter_url   = get_post_meta( $agent_id, 'REAL_HOMES_twitter_url', true );
						$linked_in_url = get_post_meta( $agent_id, 'REAL_HOMES_linked_in_url', true );
						$instagram_url = get_post_meta( $agent_id, 'inspiry_instagram_url', true );
						$youtube_url   = get_post_meta( $agent_id, 'inspiry_youtube_url', true );
						$pinterest_url = get_post_meta( $agent_id, 'inspiry_pinterest_url', true );
						$agent_website = get_post_meta( $agent_id, 'REAL_HOMES_website', true );

						if ( ! empty( $facebook_url ) ||
							! empty( $twitter_url ) ||
							! empty( $linked_in_url ) ||
							! empty( $instagram_url ) ||
							! empty( $youtube_url ) ||
							! empty( $pinterest_url ) ||
							! empty( $agent_website ) ) {
							?>
                            <div class="agent-social-links">
								<?php
								if ( ! empty( $facebook_url ) ) {
									?>
                                <a class="facebook" target="_blank" href="<?php echo esc_url( $facebook_url ); ?>">
                                        <i class="fab fa-facebook fa-lg"></i></a><?php
								}

								if ( ! empty( $twitter_url ) ) {
									?>
                                <a class="twitter" target="_blank" href="<?php echo esc_url( $twitter_url ); ?>">
                                        <i class="fab fa-twitter fa-lg"></i></a><?php
								}

								if ( ! empty( $linked_in_url ) ) {
									?>
                                <a class="linkedin" target="_blank" href="<?php echo esc_url( $linked_in_url ); ?>">
                                        <i class="fab fa-linkedin fa-lg"></i></a><?php
								}

								if ( ! empty( $instagram_url ) ) {
									?>
                                <a class="instagram" target="_blank" href="<?php echo esc_url( $instagram_url ); ?>">
                                        <i class="fab fa-instagram fa-lg"></i></a><?php
								}
								if ( ! empty( $youtube_url ) ) {
									?>
                                <a class="youtube" target="_blank" href="<?php echo esc_url( $youtube_url ); ?>">
                                        <i class="fab fa-youtube-square fa-lg"></i></a><?php
								}

								if ( ! empty( $pinterest_url ) ) {
									?>
                                <a class="pinterest" target="_blank" href="<?php echo esc_url( $pinterest_url ); ?>">
                                        <i class="fab fa-pinterest fa-lg"></i></a><?php
								}

								if ( ! empty( $agent_website ) ) {
									?>
                                    <a class="website-icon" target="_blank" href="<?php echo esc_url( $agent_website ); ?>"><i class="fas fa-globe fa-lg"></i></a>
									<?php
								}
								?>
                            </div>
							<?php
						}
						?>
                    </div>
					<?php

					if ( 'yes' === $settings['show_company_name'] ) {
						$agent_agency = get_post_meta( $agent_id, 'REAL_HOMES_agency', true );
						if ( ! empty( $agent_agency ) && ( 0 < $agent_agency ) ) {
							?>
                            <p class="agent-description">
								<?php
								printf( '<span class="agent-agency">%s</span> <a href="%s">%s</a>', esc_html( $settings['agency_prefix'] ), esc_url( get_the_permalink( $agent_agency ) ), esc_html( get_the_title( $agent_agency ) ) );
								?>
                            </p>

							<?php
						}
					}
					if ( 'yes' === $settings['show_property_counter'] ) {
						$agent_properties = 0;

						if ( function_exists( 'ere_get_agent_properties_count' ) ) {
							$listed_properties = ere_get_agent_properties_count( $agent_id );
							if ( ! empty( $listed_properties ) ) {
								$agent_properties = $listed_properties;
							}
						}

						$listed_properties_text = sprintf( _n( '%s Listed Property', '%s Listed Properties', $agent_properties, 'realhomes-elementor-addon' ), $agent_properties );
						?>
                        <span class="agent-listing-count"><?php echo esc_html( $listed_properties_text ); ?></span>
						<?php
					}
					?>
                    <div class="agent-details-separator"></div>
                </header>

                <div class="agent-contacts-list">
					<?php
					$agent_license_no   = get_post_meta( $agent_id, 'REAL_HOMES_license_number', true );
					$agent_mobile       = get_post_meta( $agent_id, 'REAL_HOMES_mobile_number', true );
					$agent_whatsapp     = get_post_meta( $agent_id, 'REAL_HOMES_whatsapp_number', true );
					$agent_office_phone = get_post_meta( $agent_id, 'REAL_HOMES_office_number', true );
					$agent_office_fax   = get_post_meta( $agent_id, 'REAL_HOMES_fax_number', true );
					$agent_email        = get_post_meta( $agent_id, 'REAL_HOMES_agent_email', true );
					$agent_address      = get_post_meta( $agent_id, 'REAL_HOMES_address', true );

					if ( ! empty( $agent_license_no ) ) {
						?>
                        <div class="agent-contact-item agent-license-number">
							<?php inspiry_safe_include_svg( '/icons/card-number.svg' ); ?>
                            <div class="agent-contact-item-inner">
                                <h4 class="agent-contact-item-label"><?php esc_html_e( 'License No', 'realhomes-elementor-addon' ); ?></h4>
                                <span><?php echo esc_html( $agent_license_no ); ?></span>
                            </div>
                        </div>
						<?php
					}
					if ( ! empty( $agent_office_phone ) ) {
						?>
                        <div class="agent-contact-item">
							<?php inspiry_safe_include_svg( '/icons/phone.svg' ); ?>
                            <div class="agent-contact-item-inner">
                                <h4 class="agent-contact-item-label"><?php esc_html_e( 'Office', 'realhomes-elementor-addon' ); ?></h4>
                                <a href="tel:<?php echo esc_attr( str_replace( ' ', '', $agent_office_phone ) ); ?>"><?php echo esc_html( $agent_office_phone ); ?></a>
                            </div>
                        </div>
						<?php
					}
					if ( ! empty( $agent_mobile ) ) {
						?>
                        <div class="agent-contact-item">
							<?php inspiry_safe_include_svg( '/icons/phone.svg' ); ?>
                            <div class="agent-contact-item-inner">
                                <h4 class="agent-contact-item-label"><?php esc_html_e( 'Mobile', 'realhomes-elementor-addon' ); ?></h4>
                                <a href="tel:<?php echo esc_attr( str_replace( ' ', '', $agent_mobile ) ); ?>"><?php echo esc_html( $agent_mobile ); ?></a>
                            </div>
                        </div>
						<?php
					}
					if ( ! empty( $agent_whatsapp ) ) {
						?>
                        <div class="agent-contact-item">
							<?php inspiry_safe_include_svg( '/icons/whatsapp.svg' ); ?>
                            <div class="agent-contact-item-inner">
                                <h4 class="agent-contact-item-label"><?php esc_html_e( 'WhatsApp', 'realhomes-elementor-addon' ); ?></h4>
                                <a href="https://wa.me/<?php echo esc_attr( str_replace( ' ', '', $agent_whatsapp ) ); ?>"><?php echo esc_html( $agent_whatsapp ); ?></a>
                            </div>
                        </div>
						<?php
					}
					if ( ! empty( $agent_office_fax ) ) {
						?>
                        <div class="agent-contact-item">
							<?php inspiry_safe_include_svg( '/icons/print.svg' ); ?>
                            <div class="agent-contact-item-inner">
                                <h4 class="agent-contact-item-label"><?php esc_html_e( 'Fax', 'realhomes-elementor-addon' ); ?></h4>
                                <a href="fax:<?php echo esc_attr( str_replace( ' ', '', $agent_office_fax ) ); ?>"><?php echo esc_html( $agent_office_fax ); ?></a>
                            </div>
                        </div>
						<?php
					}
					if ( ! empty( $agent_email ) ) {
						?>
                        <div class="agent-contact-item">
							<?php inspiry_safe_include_svg( '/icons/email.svg' ); ?>
                            <div class="agent-contact-item-inner">
                                <h4 class="agent-contact-item-label"><?php esc_html_e( 'Email', 'realhomes-elementor-addon' ); ?></h4>
                                <a href="mailto:<?php echo esc_attr( antispambot( $agent_email ) ); ?>"><?php echo esc_html( antispambot( $agent_email ) ); ?></a>
                            </div>
                        </div>
						<?php
					}
					if ( ! empty( $agent_address ) ) {
						?>
                        <div class="agent-contact-item agent-contact-item-address">
							<?php inspiry_safe_include_svg( '/icons/pin-line.svg' ); ?>
                            <div class="agent-contact-item-inner">
                                <h4 class="agent-contact-item-label"><?php esc_html_e( 'Address', 'realhomes-elementor-addon' ); ?></h4>
                                <span><?php echo inspiry_kses( $agent_address ); ?></span>
                            </div>
                        </div>
						<?php
					}
					?>
                </div>
            </div>
        </div>
		<?php
		if ( 'yes' === $settings['show_description'] ) {
			$agent_content = get_the_content( '', '', $agent_id );
			if ( $agent_content ) {
				?>
                <div class="agent-content">
                    <h3 class="agent-content-heading rh-page-heading"><?php echo esc_html( $settings['description_heading'] ) ?></h3>
					<?php echo $agent_content; ?>
                </div>
				<?php
			}
		}

		if ( 'yes' == $settings['show_progress_stats'] && function_exists( 'realhomes_generate_properties_stats_chart' ) ) {
			?>
            <div class="stats-charts-wrap">
                <h3><?php echo esc_html( $settings['progress_stats_heading'] ); ?></h3>
                <div class="stats-wrapper">
                    <div class="tax-stats property-city">
                        <h3><?php echo preg_replace( '/^(\w+)/isux', '<span>$1</span>', $settings['property_locations_label'] ); ?></h3>
						<?php realhomes_generate_properties_stats_chart( $agent_id ); ?>
                    </div>
                    <div class="tax-stats property-type">
                        <h3><?php echo preg_replace( '/^(\w+)/isux', '<span>$1</span>', $settings['property_types_label'] ); ?></h3>
						<?php realhomes_generate_properties_stats_chart( $agent_id, 'property-type' ); ?>
                    </div>
                    <div class="tax-stats property-status">
                        <h3><?php echo preg_replace( '/^(\w+)/isux', '<span>$1</span>', $settings['property_status_label'] ); ?></h3>
						<?php realhomes_generate_properties_stats_chart( $agent_id, 'property-status' ); ?>
                    </div>
                </div>
            </div>
			<?php
		}
		?>
    </article><!-- /.agent-card -->
	<?php
}
?>

