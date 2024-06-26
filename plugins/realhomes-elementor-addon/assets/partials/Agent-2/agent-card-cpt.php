<?php
global $settings;
global $agent;
$display_verification_badge = $settings['show_verification_badge'];
$agent_id                   = intval( $agent['rhea_select_agent'] );
$agent_mobile               = get_post_meta( $agent_id, 'REAL_HOMES_mobile_number', true );
$agent_email                = get_post_meta( $agent_id, 'REAL_HOMES_agent_email', true );
$verification_status        = get_post_meta( $agent_id, 'ere_agent_verification_status', true );

$agent_id = intval( $agent['rhea_select_agent'] );

if ( $agent['rhea_agent_sub_title_type'] == 'custom' ) {
	$sub_title = $agent['rhea_agent_sub_title'];
} else {
	$agent_agency = get_post_meta( $agent_id, 'REAL_HOMES_agency', true );
	if ( $agent_agency > 0 ) {
		$sub_title = get_the_title( $agent_agency );
	}
}

if ( $agent['mobile_number'] === 'yes' ) {
	$agent_mobile = get_post_meta( $agent_id, 'REAL_HOMES_mobile_number', true );
}

if ( $agent['office_number'] === 'yes' ) {
	$agent_office_number = get_post_meta( $agent_id, 'REAL_HOMES_office_number', true );
}

if ( $agent['whatsapp_number'] === 'yes' ) {
	$agent_whatsapp = get_post_meta( $agent_id, 'REAL_HOMES_whatsapp_number', true );
}

if ( $agent['fax_number'] === 'yes' ) {
	$agent_fax = get_post_meta( $agent_id, 'REAL_HOMES_fax_number', true );
}

if ( $agent['license_number'] === 'yes' ) {
	$agent_license = get_post_meta( $agent_id, 'REAL_HOMES_license_number', true );
}

if ( $agent['agent_website'] === 'yes' ) {
	$agent_website = get_post_meta( $agent_id, 'REAL_HOMES_website', true );
}

if ( $agent['agent_email'] === 'yes' ) {
	$agent_email = get_post_meta( $agent_id, 'REAL_HOMES_agent_email', true );
}
?>

<article class="rhea_agent_two">
    <div class="rhea_agent_two_wrap">
		<?php
		if ( has_post_thumbnail( $agent_id ) ) {
			?>
            <div class="rhea_agent_two_thumbnail">
                <a href="<?php echo get_the_permalink( $agent_id ); ?>">
					<?php
					echo get_the_post_thumbnail( $agent_id, 'agent-image' );
					?>
                </a>
            </div>
			<?php
		}
		?>
        <div class="rhea_agent_two_details">
			<?php if ( $agent_id ) { ?>
                <h3 class="rhea_agent_two_title">
					<a href="<?php echo get_the_permalink( $agent_id ); ?>"><?php echo get_the_title( $agent_id ); ?></a> 
					<?php
					if ( 'yes' === $display_verification_badge && $verification_status ) {
                        ?>
                        <span class="rh_agent_verification__icon">
                            <?php
                            inspiry_safe_include_svg( '/icons/verified-check.svg', '/common/images' );
                            ?>
                        </span>
                        <?php
					}
					?>
                </h3>
			<?php }

			if ( $sub_title ) {
				?>
                <span class="rhea_agent_designation"><?php echo esc_html( $sub_title ); ?></span>
				<?php
			}

			if ( 'yes' == $agent['show_social_icons'] ) {
				$facebook_url  = get_post_meta( $agent_id, 'REAL_HOMES_facebook_url', true );
				$twitter_url   = get_post_meta( $agent_id, 'REAL_HOMES_twitter_url', true );
				$linked_in_url = get_post_meta( $agent_id, 'REAL_HOMES_linked_in_url', true );
				$instagram_url = get_post_meta( $agent_id, 'inspiry_instagram_url', true );
				$pinterest_url = get_post_meta( $agent_id, 'inspiry_pinterest_url', true );
				$youtube_url   = get_post_meta( $agent_id, 'inspiry_youtube_url', true );

				if (
					! empty( $facebook_url ) ||
					! empty( $twitter_url ) ||
					! empty( $linked_in_url ) ||
					! empty( $pinterest_url ) ||
					! empty( $youtube_url ) ||
					! empty( $instagram_url )
				) {
					?>
                    <ul class="rhea_agent_two_socials">
						<?php
						if ( ! empty( $facebook_url ) ) {
							?>
                            <li class="rhea_item_facebook">
                                <a target="_blank" href="<?php echo esc_url( $facebook_url ); ?>">
                                    <i class="fab fa-facebook fa-lg"></i>
                                </a>
                            </li>
							<?php
						}
						if ( ! empty( $twitter_url ) ) {
							?>
                            <li class="rhea_item_twitter">
                                <a target="_blank" href="<?php echo esc_url( $twitter_url ); ?>">
                                    <i class="fab fa-twitter fa-lg"></i>
                                </a>
                            </li>
							<?php
						}
						if ( ! empty( $linked_in_url ) ) {
							?>
                            <li class="rhea_item_linkedin">
                                <a target="_blank" href="<?php echo esc_url( $linked_in_url ); ?>">
                                    <i class="fab fa-linkedin fa-lg"></i>
                                </a>
                            </li>
							<?php
						}
						if ( ! empty( $instagram_url ) ) {
							?>
                            <li class="rhea_item_instagram">
                                <a target="_blank" href="<?php echo esc_url( $instagram_url ); ?>">
                                    <i class="fab fa-instagram fa-lg"></i>
                                </a>
                            </li>
							<?php
						}
						if ( ! empty( $pinterest_url ) ) {
							?>
                            <li class="rhea_item_pinterest">
                                <a target="_blank" href="<?php echo esc_url( $pinterest_url ); ?>">
                                    <i class="fab fa-pinterest fa-lg"></i>
                                </a>
                            </li>
							<?php
						}
						if ( ! empty( $youtube_url ) ) {
							?>
                            <li class="rhea_item_youtube">
                                <a target="_blank" href="<?php echo esc_url( $youtube_url ); ?>">
                                    <i class="fab fa-youtube fa-lg"></i>
                                </a>
                            </li>
							<?php
						}
						?>
                    </ul>
					<?php
				}
			}

			if ( 'yes' == $agent['show_excerpt'] ) {
				if ( $agent['rhea_agent_excerpt'] && ! empty( $agent['rhea_agent_excerpt'] ) ) {
					?>
                    <p class="rhea_agent_two_excerpt"><?php echo esc_html( $agent['rhea_agent_excerpt'] ); ?></p>
					<?php
				} elseif ( ( $agent_id ) && ! empty( get_the_excerpt( $agent_id ) ) ) {
					?>
                    <p class="rhea_agent_two_excerpt"><?php echo rhea_get_framework_excerpt_by_id( $agent_id, $agent['excerpt_length'] ); ?></p>
					<?php
				}
			}

			if ( ! empty( $agent_mobile ) ) {
				?>
                <div class="rhea_agent_two_meta number mobile">
                    <i class="fas fa-mobile-alt"></i>&nbsp;
                    <a href="tel:<?php echo esc_attr( $agent_mobile ); ?>">
						<?php echo esc_html( $agent_mobile ); ?>
                    </a>
                </div>
				<?php
			}

			if ( ! empty( $agent_office_number ) ) {
				?>
                <div class="rhea_agent_two_meta number office">
                    <i class="fas fa-phone-alt"></i>&nbsp;
                    <a href="tel:<?php echo esc_attr( $agent_office_number ); ?>">
						<?php echo esc_html( $agent_office_number ); ?>
                    </a>
                </div>
				<?php
			}

			if ( ! empty( $agent_whatsapp ) ) {
				$agent_whatsapp_link = 'https://wa.me/' . str_replace( '-', '', $agent_whatsapp );
				?>
                <div class="rhea_agent_two_meta number whatsapp">
                    <i class="fab fa-whatsapp"></i>&nbsp;
                    <a href="<?php echo esc_url( $agent_whatsapp_link ); ?>" target="_blank">
						<?php echo esc_html( $agent_whatsapp ); ?>
                    </a>
                </div>
				<?php
			}

			if ( ! empty( $agent_fax ) ) {
				?>
                <div class="rhea_agent_two_meta number fax">
                    <i class="fas fa-fax"></i>&nbsp;
                    <a href="fax:<?php echo esc_attr( $agent_fax ); ?>">
						<?php echo esc_html( $agent_fax ); ?>
                    </a>
                </div>
				<?php
			}

			if ( ! empty( $agent_license ) ) {
				?>
                <div class="rhea_agent_two_meta number license">
                    <i class="fas fa-id-card"></i>&nbsp;
					<?php echo esc_html( $agent_license ); ?>
                </div>
				<?php
			}

			if ( ! empty( $agent_website ) ) {
				?>
                <div class="rhea_agent_two_meta website">
                    <i class="fas fa-link"></i>&nbsp;
                    <a href="<?php echo esc_url( $agent_website ); ?>" target="_blank">
						<?php echo esc_url( $agent_website ); ?>
                    </a>
                </div>
				<?php
			}

			if ( ! empty( $agent_email ) ) {
				?>
                <div class="rhea_agent_two_meta email">
                    <i class="fas fa-envelope"></i>&nbsp;
                    <a href="mailto:<?php echo esc_attr( antispambot( $agent_email ) ); ?>">
						<?php echo esc_html( antispambot( $agent_email ) ); ?>
                    </a>
                </div>
				<?php
			}
			?>
        </div>
        <!-- ending .rhea_agent_two_details div -->
    </div>
    <!-- ending .rhea_agent_two_wrap div -->
</article>
<!-- ending .rhea_agent_two article -->