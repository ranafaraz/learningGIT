<?php
/**
 * Header Modal
 *
 * Header modal for login in the header.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

$is_user_logged_in     = is_user_logged_in();
$favorites_after_login = get_option( 'inspiry_login_on_fav', 'no' );

$favorites_url = '';
if ( realhomes_get_dashboard_page_url() && realhomes_dashboard_module_enabled( 'inspiry_favorites_module_display' ) ) {
	$favorites_url = realhomes_get_dashboard_page_url( 'favorites' );
}

if ( $is_user_logged_in || ( ! empty( $favorites_url ) && 'no' === $favorites_after_login ) ) {
	?>
    <div class="rh-ultra-modal">
        <div class="rh_modal__corner"></div><!-- /.rh_modal__corner -->
        <div class="rh_modal__wrap">
			<?php
			if ( $is_user_logged_in ) {
				?>
                <div class="rh_user">
                    <div class="rh_user__avatar">
						<?php
						$current_user      = wp_get_current_user();
						$current_user_meta = get_user_meta( $current_user->ID );

						if ( isset( $current_user_meta['profile_image_id'][0] ) ) {
							echo wp_get_attachment_image( $current_user_meta['profile_image_id'][0], array(
								'40',
								'40'
							), "", array( "class" => "rh_modal_profile_img" ) );
						} else {
							$user_email    = $current_user->user_email;
							$user_gravatar = inspiry_get_gravatar( $user_email, '150' );
							?>
                            <img alt="<?php echo esc_attr( $current_user->display_name ); ?>" src="<?php echo esc_url( $user_gravatar ); ?>">
							<?php
						}
						?>
                    </div><!-- /.rh_user__avatar -->
                    <div class="rh_user__details">
                        <p class="rh_user__msg"><?php esc_html_e( 'Welcome', 'framework' ); ?></p>
                        <!-- /.rh_user__msg -->
                        <h3 class="rh_user__name"><?php echo esc_html( $current_user->display_name ); ?></h3>
                    </div><!-- /.rh_user__details -->
                </div><!-- /.rh_user -->
				<?php
			}
			?>
            <div class="rh_modal__dashboard rh-trigger-nav">
				<?php
				if ( 'show' === get_option( 'realhomes_dashboard_analytics_module', 'show' ) && inspiry_is_property_analytics_enabled() && realhomes_get_current_user_role_option( 'property_analytics' ) ) {
					$analytics_url = realhomes_get_dashboard_page_url( 'analytics' );
					?>
                    <a href="<?php echo esc_url( $analytics_url ); ?>" class="rh_modal__dash_link property-analytics">
                        <i class="fas fa-chart-line"></i>
                        <span><?php echo realhomes_dashboard_menu_item_label( 'analytics' ); ?></span>
                    </a>
					<?php
				}

                if ( ! empty( $favorites_url ) && 'no' === $favorites_after_login && ! $is_user_logged_in ) {
					?>
                    <a href="<?php echo esc_url( $favorites_url ); ?>" class="rh_modal__dash_link add-favorites-without-login">
						<?php inspiry_safe_include_svg( '/icons/user-dash/icon-dash-favorite.svg' ); ?>
                        <span><?php echo realhomes_dashboard_menu_item_label( 'favorites' ); ?></span>
                    </a>
					<?php
				}

				if ( realhomes_get_current_user_role_option( 'manage_profile' ) ) {
					$profile_url = '';
					if ( realhomes_get_dashboard_page_url() && realhomes_dashboard_module_enabled( 'inspiry_profile_module_display' ) ) {
						$profile_url = realhomes_get_dashboard_page_url( 'profile' );
					}

					if ( ! empty( $profile_url ) ) {
						?>
                        <a href="<?php echo esc_url( $profile_url ); ?>" class="rh_modal__dash_link">
							<?php inspiry_safe_include_svg( '/icons/user-dash/icon-dash-profile.svg' ); ?>
                            <span><?php echo realhomes_dashboard_menu_item_label( 'profile' ); ?></span>
                        </a>
						<?php
					}
				}

				if ( realhomes_get_current_user_role_option( 'manage_listings' ) ) {
					$my_properties_url = '';
					if ( realhomes_get_dashboard_page_url() && realhomes_dashboard_module_enabled( 'inspiry_properties_module_display' ) ) {
						$my_properties_url = realhomes_get_dashboard_page_url( 'properties' );
					}

					if ( ! empty( $my_properties_url ) && inspiry_no_membership_disable_stuff() ) {
						?>
                        <a href="<?php echo esc_url( $my_properties_url ); ?>" class="rh_modal__dash_link">
							<?php inspiry_safe_include_svg( '/icons/user-dash/icon-dash-my-properties.svg' ); ?>
                            <span><?php echo realhomes_dashboard_menu_item_label( 'properties' ); ?></span>
                        </a>
						<?php
					}
				}

				if ( realhomes_get_current_user_role_option( 'manage_favorites' ) ) {
					// Favorites page link
					if ( ! empty( $favorites_url ) ) {
						?>
                        <a href="<?php echo esc_url( $favorites_url ); ?>" class="rh_modal__dash_link">
							<?php inspiry_safe_include_svg( '/icons/user-dash/icon-dash-favorite.svg' ); ?>
                            <span><?php echo realhomes_dashboard_menu_item_label( 'favorites' ); ?></span>
                        </a>
						<?php
					}
				}

				if ( realhomes_get_current_user_role_option( 'manage_searches' ) && inspiry_is_save_search_enabled() ) {
					$saved_searches_url = '';
					if ( realhomes_get_dashboard_page_url() ) {
						$saved_searches_url = realhomes_get_dashboard_page_url( 'saved-searches' );
					}

					if ( ! empty( $saved_searches_url ) ) {
						?>
                        <a href="<?php echo esc_url( $saved_searches_url ); ?>" class="rh_modal__dash_link">
							<?php inspiry_safe_include_svg( 'images/icon-dash-alert.svg', '/common/' ); ?>
                            <span><?php echo realhomes_dashboard_menu_item_label( 'saved-searches' ); ?></span>
                        </a>
						<?php
					}
				}

				if ( function_exists( 'IMS_Helper_Functions' ) && realhomes_get_current_user_role_option( 'memberships' ) ) {
					$ims_helper_functions  = IMS_Helper_Functions();
					$is_memberships_enable = $ims_helper_functions::is_memberships();

					$membership_url = '';
					if ( realhomes_get_dashboard_page_url() ) {
						$membership_url = realhomes_get_dashboard_page_url( 'membership' );
					}

					if ( ! empty( $is_memberships_enable ) && ! empty( $membership_url ) ) {
						?>
                        <a href="<?php echo esc_url( $membership_url ); ?>" class="rh_modal__dash_link">
							<?php inspiry_safe_include_svg( '/icons/user-dash/icon-membership.svg' ); ?>
                            <span><?php echo realhomes_dashboard_menu_item_label( 'membership' ); ?></span>
                        </a>
						<?php
					}
				}

				if ( $is_user_logged_in ) {
					?>
                    <a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" class="rh_modal__dash_link">
						<?php inspiry_safe_include_svg( '/icons/user-dash/icon-dash-logout.svg' ); ?>
                        <span><?php echo realhomes_dashboard_menu_item_label( 'logout' ); ?></span>
                    </a>
					<?php
				}
				?>
            </div><!-- /.rh_modal__dashboard -->
        </div><!-- /.rh_modal__wrap -->
    </div><!-- /.rh-menu-modal -->
	<?php
}
?>




