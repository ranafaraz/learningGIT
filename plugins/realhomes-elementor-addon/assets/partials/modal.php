<?php
/**
 * Header Modal
 *
 * Header modal for login in the header.
 *
 * @package realhomes_elementor_addon
 */

global $settings;
$current_user = wp_get_current_user();

?>

<div class="rhea_modal">
	<?php
	if ( is_user_logged_in() ) { ?>
        <div class="rhea_modal__corner"></div>
        <!-- /.rh_modal__corner -->

        <div class="rhea_modal__wrap">

			<?php
			if ( 'yes' == $settings['show_login_modal_avatar'] ||
			     'yes' == $settings['show_login_modal_user_name'] ) {
				?>
                <div class="rhea_user">
					<?php
					if ( 'yes' == $settings['show_login_modal_avatar'] ) {
						?>
                        <div class="rhea_user__avatar">
							<?php
							$current_user_meta = get_user_meta( $current_user->ID );

							if ( isset( $current_user_meta['profile_image_id'][0] ) ) {
								echo wp_get_attachment_image( $current_user_meta['profile_image_id'][0], array(
									'40',
									'40'
								), "", array( "class" => "rh_modal_profile_img" ) );
							} else {
								$default_avatar = get_option( 'avatar_default' );
								$global_avatar  = 'gravatar_default';

								if ( 'gravatar_default' !== $default_avatar &&  'blank' !== $default_avatar ) {

									$global_avatar = $default_avatar;

								}
								echo get_avatar(
									$current_user->user_email,
									'150',
									$global_avatar,
									$current_user->display_name,
									array(
										'class' => 'user-icon',
									)
								);
							}
							?>

                        </div>
						<?php
					}
					if ( 'yes' == $settings['show_login_modal_user_name'] ) {
						?>
                        <!-- /.rh_user__avatar -->
                        <div class="rhea_user__details">
                            <p class="rhea_user__msg">
								<?php
								if ( ! empty( $settings['rhea_login_welcome_label'] ) ) {
									echo esc_html( $settings['rhea_login_welcome_label'] );
								} else {
									esc_html_e( 'Welcome', 'realhomes-elementor-addon' );
								}
								?>
                            </p>
                            <!-- /.rh_user__msg -->
                            <h3 class="rhea_user__name">
								<?php echo esc_html( $current_user->display_name ); ?>
                            </h3>
                        </div>
						<?php
					}
					?>
                    <!-- /.rh_user__details -->
                </div>
				<?php
			}
			?>
            <!-- /.rh_user -->

            <div class="rhea_modal__dashboard">

				<?php
				if ( 'yes' == $settings['show_login_modal_analytics'] ) {
					if ( 'show' === get_option( 'realhomes_dashboard_analytics_module', 'show' ) && inspiry_is_property_analytics_enabled() && realhomes_get_current_user_role_option( 'property_analytics' ) ) {

						$analytics_url = realhomes_get_dashboard_page_url( 'analytics' );

						if ( ! empty( $analytics_url ) ) {
							?>
                            <a href="<?php echo esc_url( $analytics_url ); ?>" class="rhea_modal__dash_link property-analytics">
                                <i class="fas fa-chart-line"></i>
                                <span class="rhea_analytics_text">
                                    <?php
                                    if ( ! empty( $settings['rhea_analytics_label'] ) ) {
	                                    echo esc_html( $settings['rhea_analytics_label'] );
                                    } else {
	                                    esc_html_e( 'Analytics', 'realhomes-elementor-addon' );
                                    }
                                    ?>
                                </span>
                            </a>
							<?php
						}
					}
				}

				if ( 'yes' == $settings['show_login_modal_profile'] ) {
					$profile_url = '';
					if ( function_exists('realhomes_get_dashboard_page_url') && realhomes_get_dashboard_page_url() && realhomes_dashboard_module_enabled( 'inspiry_profile_module_display' ) ) {
						$profile_url = realhomes_get_dashboard_page_url( 'profile' );
					}
					if ( ! empty( $profile_url ) ) {
						?>
                        <a href="<?php echo esc_url( $profile_url ); ?>" class="rhea_modal__dash_link">
							<?php
							include RHEA_ASSETS_DIR . '/icons/icon-dash-profile.svg';
							?>
                            <span class="rhea_login_profile_text">
                                <?php
                                if ( ! empty( $settings['rhea_login_profile_label'] ) ) {
	                                echo esc_html( $settings['rhea_login_profile_label'] );
                                } else {
	                                esc_html_e( 'Profile', 'realhomes-elementor-addon' );
                                }
                                ?>
                            </span>
                        </a>
						<?php
					}
				}

				if ( 'yes' == $settings['show_login_modal_properties'] ) {
					$my_properties_url = '';
					if ( function_exists('realhomes_get_dashboard_page_url') && realhomes_get_dashboard_page_url() && realhomes_dashboard_module_enabled( 'inspiry_properties_module_display' ) ) {
						$my_properties_url = realhomes_get_dashboard_page_url( 'properties' );
					}
					if ( ! empty( $my_properties_url ) ) {
						?>
                        <a href="<?php echo esc_url( $my_properties_url ); ?>" class="rhea_modal__dash_link">
							<?php
							include RHEA_ASSETS_DIR . '/icons/icon-dash-my-properties.svg';
							?>
                            <span class="rhea_my_properties_text">
                                <?php
                                if ( ! empty( $settings['rhea_login_my_properties_label'] ) ) {
	                                echo esc_html( $settings['rhea_login_my_properties_label'] );
                                } else {
	                                esc_html_e( 'My Properties', 'realhomes-elementor-addon' );
                                }
                                ?>
                            </span>
                        </a>
						<?php
					}
				}
				if ( 'yes' == $settings['show_login_modal_favorites'] ) {
					$favorites_url = '';
					if ( function_exists('realhomes_get_dashboard_page_url') && realhomes_get_dashboard_page_url() && realhomes_dashboard_module_enabled( 'inspiry_favorites_module_display' ) ) {
						$favorites_url = realhomes_get_dashboard_page_url( 'favorites' );
					}
					if ( ! empty( $favorites_url ) ) {
						?>
                        <a href="<?php echo esc_url( $favorites_url ); ?>" class="rhea_modal__dash_link">
							<?php
							include RHEA_ASSETS_DIR . '/icons/icon-dash-favorite.svg';
							?>
                            <span class="rhea_login_favorites_text">
                                <?php
                                if ( ! empty( $settings['rhea_login_favorites_label'] ) ) {
	                                echo esc_html( $settings['rhea_login_favorites_label'] );
                                } else {
	                                esc_html_e( 'Favorites', 'realhomes-elementor-addon' );
                                }
                                ?>
                            </span>
                        </a>
						<?php
					}
				}

				if ( 'yes' == $settings['show_login_modal_saved_search'] && function_exists('inspiry_is_save_search_enabled') && inspiry_is_save_search_enabled() ) {
					$saved_searches_url = '';
					if ( function_exists('realhomes_get_dashboard_page_url') ) {
						$saved_searches_url = realhomes_get_dashboard_page_url( 'saved-searches' );
					}

					$saved_searches_label = get_option( 'realhomes_saved_searches_label', esc_html__( 'Saved Searches', 'realhomes-elementor-addon' ) );
					if ( ! empty( $saved_searches_url ) && ! empty( $saved_searches_label ) ) :
						?>
						<a href="<?php echo esc_url( $saved_searches_url ); ?>" class="rhea_modal__dash_link">
							<?php include RHEA_ASSETS_DIR . '/icons/icon-dash-alert.svg'; ?>
							<span><?php echo esc_html( $saved_searches_label ); ?></span>
						</a>
					<?php
					endif;
				}

				if ( function_exists( 'IMS_Helper_Functions' ) ) {
					$ims_helper_functions  = IMS_Helper_Functions();
					$is_memberships_enable = $ims_helper_functions::is_memberships();
				}

				$membership_url = '';
				if ( realhomes_get_dashboard_page_url() ) {
					$membership_url = realhomes_get_dashboard_page_url( 'membership' );
				}

				if ( ( ! empty( $is_memberships_enable ) ) && ! empty( $membership_url ) ) {
					?>
                    <a href="<?php echo esc_url( $membership_url ); ?>" class="rhea_modal__dash_link">
						<?php
						include RHEA_ASSETS_DIR . '/icons/icon-membership.svg';
						?>
                        <span class="rhea_login_membership_text">
                            <?php
                            if ( ! empty( $settings['rhea_login_membership_label'] ) ) {
	                            echo esc_html( $settings['rhea_login_membership_label'] );
                            } else {
	                            esc_html_e( 'Membership', 'realhomes-elementor-addon' );
                            }
                            ?>
                        </span>
                    </a>
					<?php
				}


				if ( $settings['rhea_login_add_more_repeater'] ) {
					foreach ( $settings['rhea_login_add_more_repeater'] as $item ) {
						if ( $item['rhea_page_url']['url'] ) {
							?>
                            <a href="<?php echo esc_url( $item['rhea_page_url']['url'] ); ?>"
                               class="rhea_modal__dash_link rhea_login_extended_link <?php echo esc_attr( 'elementor-repeater-item-' . $item['_id'] ); ?>">

								<?php if ( ! empty( $item['rhea_link_icon'] ) ) {
									\Elementor\Icons_Manager::render_icon( $item['rhea_link_icon'], [ 'aria-hidden' => 'true' ] );
								} ?>
                                <span class="rhea_login_extended">
                                <?php
                                if ( ! empty( $item['rhea_link_text'] ) ) {
	                                echo esc_html( $item['rhea_link_text'] );
                                }
                                ?>
                            </span>
                            </a>
							<?php
						}
					}
				}
				?>

                <a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" class="rhea_modal__dash_link">
					<?php
					include RHEA_ASSETS_DIR . '/icons/icon-dash-logout.svg';
					?>
                    <span class="rhea_logout_text">
                        <?php
                        if ( ! empty( $settings['rhea_log_out_label'] ) ) {
	                        echo esc_html( $settings['rhea_log_out_label'] );
                        } else {
	                        esc_html_e( 'Log Out', 'realhomes-elementor-addon' );
                        }
                        ?>
                    </span>
                </a>

            </div>
            <!-- /.rh_modal__dashboard -->
        </div>
        <!-- /.rh_modal__wrap -->
	<?php } ?>
</div>
<!-- /.rh_menu__modal -->




