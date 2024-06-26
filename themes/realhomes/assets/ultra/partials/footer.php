<?php
/**
 * Action hook to display contents above footer.
 *
 * @since 4.1.1
 */
do_action( 'realhomes_before_footer' );
?>
<footer id="colophon" class="site-footer">
	<?php
	// Add custom footer background image.
	$site_footer_bg = get_option( 'realhomes_site_footer_bg' );
	if ( ! empty( $site_footer_bg ) ) {
		$site_footer_bg_style = "background-image: url('" . esc_url( $site_footer_bg ) . "');";
		?>
        <div class="site-footer-bg site-footer-custom-bg" style="<?php echo esc_attr( $site_footer_bg_style ); ?>"></div>
		<?php
	} else {
		?>
        <div class="site-footer-bg site-footer-default-bg"></div>
		<?php
	}
	?>
    <div class="container">
		<?php
		// Footer Top Area
		$logo_enabled = get_option( 'inspiry_enable_footer_logo', 'true' );
		$desc_enabled = get_option( 'inspiry_enable_footer_tagline', 'true' );

		if ( 'true' === $logo_enabled || 'true' === $desc_enabled || ( function_exists( 'ere_social_networks' ) && ere_social_networks( array( 'echo' => 0 ) ) ) ) {
			?>
            <div class="site-footer-top">
                <div class="site-footer-logo-wrapper">
					<?php
					$logo_path = get_option( 'inspiry_footer_logo' );
					if ( 'true' === $logo_enabled && ! empty( $logo_path ) ) {
						?>
                        <a title="<?php bloginfo( 'name' ); ?>" href="<?php echo esc_url( home_url() ); ?>">
                            <img src="<?php echo esc_url( $logo_path ); ?>" alt="<?php bloginfo( 'name' ); ?>">
                        </a>
						<?php
					} else if ( 'true' === $logo_enabled ) {
						?>
                        <h2 class="rh-ultra-footer-heading">
                            <a href="<?php echo esc_url( home_url() ); ?>" title="<?php bloginfo( 'name' ); ?>">
								<?php bloginfo( 'name' ); ?>
                            </a>
                        </h2>
						<?php
					}

					$description = get_option( 'inspiry_footer_tagline' );
					if ( 'true' === $desc_enabled && $description ) {
						echo '<p class="tag-line">';
						echo esc_html( $description );
						echo '</p>';
					}
					?>
                </div>
				<?php

				if ( function_exists( 'ere_social_networks' ) ) {

					$args = array(
						'container'       => 'div',
						'container_class' => 'site-footer-social-link',
						'icon_size_class' => '',
						'replace_icons'   => array(
							'facebook' => 'fab fa-facebook',
							'linkedin' => 'fab fa-linkedin-in',
							'youtube'  => 'fab fa-youtube',
						),
					);

					ere_social_networks( $args );
				}
				?>
            </div><!-- .site-footer-top -->
			<?php
		}

		// Footer Widget Area
		if ( is_active_sidebar( 'footer-first-column' ) || is_active_sidebar( 'footer-second-column' ) || is_active_sidebar( 'footer-third-column' ) || is_active_sidebar( 'footer-fourth-column' ) ) {

			$footer_columns = get_option( 'inspiry_footer_columns', '3' );
			switch ( $footer_columns ) {
				case '1':
					$column_class = 'column-1';
					break;
				case '2':
					$column_class = 'columns-2';
					break;
				case '4':
					$column_class = 'columns-4';
					break;
				default:
					$column_class = 'columns-3';
			}
			?>
            <aside class="row site-footer-widget-area">
                <div class="rh-footer-widgets <?php echo esc_attr( $column_class ); ?>">
					<?php
					if ( is_active_sidebar( 'footer-first-column' ) ) {
						dynamic_sidebar( 'footer-first-column' );
					}
					?>
                </div>
				<?php
				if ( intval( $footer_columns ) >= 2 ) {
					?>
                    <div class="rh-footer-widgets <?php echo esc_attr( $column_class ); ?>">
						<?php
						if ( is_active_sidebar( 'footer-second-column' ) ) {
							dynamic_sidebar( 'footer-second-column' );
						}
						?>
                    </div>
					<?php
				}

				if ( intval( $footer_columns ) >= 3 ) {
					?>
                    <div class="rh-footer-widgets <?php echo esc_attr( $column_class ); ?>">
						<?php
						if ( is_active_sidebar( 'footer-third-column' ) ) {
							dynamic_sidebar( 'footer-third-column' );
						}
						?>
                    </div>
					<?php
				}

				if ( intval( $footer_columns ) == 4 ) {
					?>
                    <div class="rh-footer-widgets <?php echo esc_attr( $column_class ); ?>">
						<?php
						if ( is_active_sidebar( 'footer-fourth-column' ) ) {
							dynamic_sidebar( 'footer-fourth-column' );
						}
						?>
                    </div>
					<?php
				}
				?>
            </aside><!-- .site-footer-widget-area -->
			<?php
		}

		$realhomes_footer_phone    = get_option( 'realhomes_footer_phone', '1-800-555-1234' );
		$realhomes_footer_whatsapp = get_option( 'realhomes_footer_whatsapp', '1-800-555-1234' );
		$realhomes_footer_email    = get_option( 'realhomes_footer_email', 'support@demosite.com' );
		if ( ! empty( $realhomes_footer_phone ) || ! empty( $realhomes_footer_whatsapp ) || ! empty( $realhomes_footer_email ) ) {
			?>
            <div class="site-footer-contacts-wrapper">
                <div class="site-footer-contacts">
					<?php
					$realhomes_footer_need_help = get_option( 'realhomes_footer_need_help', 'Need Help?' );
					if ( ! empty( $realhomes_footer_need_help ) ) {
						?>
                        <span class="rh-ultra-footer-help"><?php echo esc_html( $realhomes_footer_need_help ); ?></span>
						<?php
					}

					if ( ! empty( $realhomes_footer_phone ) ) {
						$phone_click = "tel://" . esc_attr( $realhomes_footer_phone );
						?>
                        <a class="rh-ultra-footer-number rh-ultra-user-phone-footer" target="_blank" href="<?php echo esc_url( $phone_click ); ?>">
							<?php inspiry_safe_include_svg( '/icons/phone.svg' ); ?>
                            <span><?php echo esc_html( $realhomes_footer_phone ); ?></span>
                        </a>
						<?php
					}

					if ( ! empty( $realhomes_footer_whatsapp ) ) {
						$whatsapp_click = "https://api.whatsapp.com/send?phone=" . esc_html( $realhomes_footer_whatsapp );
						?>
                        <a class="rh-ultra-footer-number rh-ultra-user-whatsapp-footer" target="_blank" href="<?php echo esc_url( $whatsapp_click ); ?>">
							<?php inspiry_safe_include_svg( '/icons/whatsapp.svg' ); ?>
                            <span><?php echo esc_html( $realhomes_footer_whatsapp ); ?></span>
                        </a>
						<?php
					}

					if ( ! empty( $realhomes_footer_email ) ) {
						?>
                        <a class="rh-ultra-footer-number rh-ultra-user-email-footer" target="_blank" href="mailto:<?php echo antispambot( sanitize_email( $realhomes_footer_email ) ); ?>">
							<?php inspiry_safe_include_svg( '/icons/email.svg' ); ?>
                            <span><?php echo antispambot( sanitize_email( $realhomes_footer_email ) ); ?></span>
                        </a>
						<?php
					}
					?>
                </div>
            </div>
			<?php
		}

		$copyright_text_display         = get_option( 'inspiry_copyright_text_display', 'true' );
		$designed_by                    = get_option( 'theme_designed_by_text' );
		$realhomes_footer_designed_text = get_option( 'realhomes_footer_designed_text', 'left' );
		if ( 'true' === $copyright_text_display || ! empty( $designed_by ) ) {
			?>
            <div class="site-footer-bottom <?php echo esc_attr( $realhomes_footer_designed_text ) ?>">
				<?php
				if ( 'true' === $copyright_text_display ) {
					?>
                    <p class="copyrights">
						<?php
						$copyrights = apply_filters( 'inspiry_copyright_text', get_option( 'theme_copyright_text' ) );
						if ( ! empty( $copyrights ) ) {
							echo wp_kses( $copyrights, inspiry_allowed_html() );
						} else {
							printf( '&copy; %s. %s', date_i18n( 'Y' ), esc_html__( 'All rights reserved.', 'framework' ) );
						}
						?>
                    </p>
					<?php
				}
				if ( ! empty( $designed_by ) ) {
					?>
                    <p class="designed-by">
						<?php echo wp_kses( apply_filters( 'inspiry_designed_by_text', $designed_by ), inspiry_allowed_html() ); ?>
                    </p>
					<?php
				}
				?>
            </div><!-- .site-footer-bottom -->
			<?php
		}
		?>
    </div>
</footer>