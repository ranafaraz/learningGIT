<?php
/**
 * Login Modal: Favourites Link in Nav Menu for Logged off Users
 *
 * @since   2.0.1
 * @updated 2.1.0
 * @package realhomes-elementor-addon
 */
global $settings;

$favorites_url = '';
if ( realhomes_get_dashboard_page_url() && realhomes_dashboard_module_enabled( 'inspiry_favorites_module_display' ) ) {
	$favorites_url = realhomes_get_dashboard_page_url( 'favorites' );
}

if ( ! empty( $favorites_url ) && 'all' === $settings['favorites_visibility'] ) {
	$require_login = get_option( 'inspiry_login_on_fav' );
	?>
    <div class="rhea_modal">
        <div class="rhea_modal__corner"></div>
        <div class="rhea_modal__wrap">
            <div class="rhea_modal__dashboard">
                <a href="<?php echo esc_url( $favorites_url ); ?>" class="rhea_modal__dash_link <?php echo ( 'yes' === $require_login ) ? 'ask-for-login' : ''; ?>">
					<?php include RHEA_ASSETS_DIR . '/icons/icon-dash-favorite.svg'; ?>
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
            </div>
        </div>
    </div>
	<?php
}
?>