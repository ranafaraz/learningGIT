<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="realhomes-settings-wrap">
    <header class="settings-header">
        <h1><?php esc_html_e( 'Easy Real Estate', 'easy-real-estate' ); ?><span class="current-version-tag"><?php echo ERE_VERSION; ?></span></h1>
        <p class="credit">
            <a class="logo-wrap" href="https://themeforest.net/item/real-homes-wordpress-real-estate-theme/5373914?aid=inspirythemes" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" height="29" width="29" viewBox="0 0 36 41">
                    <style>
                        .a{
                            fill:#4E637B;
                        }
                        .b{
                            fill:white;
                        }
                        .c{
                            fill:#27313D !important;
                        }
                    </style><g>
                        <path d="M25.5 14.6C28.9 16.6 30.6 17.5 34 19.5L34 11.1C34 10.2 33.5 9.4 32.8 9 30.1 7.5 28.4 6.5 25.5 4.8L25.5 14.6Z" class="a"></path>
                        <path d="M15.8 38.4C16.5 38.8 17.4 38.8 18.2 38.4 20.8 36.9 22.5 35.9 25.5 34.2 22.1 32.2 20.4 31.3 17 29.3 13.6 31.3 11.9 32.2 8.5 34.2 11.5 35.9 13.1 36.9 15.8 38.4" mask="url(#mask-2)" class="a"></path>
                        <path d="M24.3 25.1C25 24.7 25.5 23.9 25.5 23L25.5 14.6 17 19.5 17 29.3 24.3 25.1Z" fill="#C8ED1E"></path>
                        <path d="M18.2 10.4C17.4 10 16.5 10 15.8 10.4L8.5 14.6 17 19.5 25.5 14.6 18.2 10.4Z" fill="#F9FAF8"></path>
                        <path d="M8.5 23C8.5 23.9 8.9 24.7 9.7 25.1L17 29.3 17 19.5 8.5 14.6 8.5 23Z" fill="#88B2D7"></path>
                        <path d="M8.5 14.6C5.1 16.6 3.4 17.5 0 19.5L0 11.1C0 10.2 0.5 9.4 1.2 9 3.8 7.5 5.5 6.5 8.5 4.8L8.5 14.6Z" mask="url(#mask-4)" class="a"></path>
                        <path d="M34 27.9L34 19.5 25.5 14.6 25.5 23C25.5 23.4 25.4 23.8 25.1 24.2L33.6 29.1C33.8 28.7 34 28.3 34 27.9" fill="#5E9E2D"></path>
                        <path d="M25.1 24.2C24.9 24.6 24.6 24.9 24.3 25.1L17 29.3 25.5 34.2 32.8 30C33.1 29.8 33.4 29.5 33.6 29.1L25.1 24.2Z" fill="#6FBF2C"></path>
                        <path d="M17 10.1C17.4 10.1 17.8 10.2 18.2 10.4L25.5 14.6 25.5 4.8 18.2 0.6C17.8 0.4 17.4 0.3 17 0.3L17 10.1Z" fill="#BDD2E1"></path>
                        <path d="M1.2 30L8.5 34.2 17 29.3 9.7 25.1C9.3 24.9 9 24.6 8.8 24.2L0.3 29.1C0.5 29.5 0.8 29.8 1.2 30" fill="#418EDA"></path>
                        <path d="M8.8 24.2C8.6 23.8 8.5 23.4 8.5 23L8.5 14.6 0 19.5 0 27.9C0 28.3 0.1 28.7 0.3 29.1L8.8 24.2Z" fill="#3570AA"></path>
                        <path d="M15.8 0.6L8.5 4.8 8.5 14.6 15.8 10.4C16.2 10.2 16.6 10.1 17 10.1L17 0.3C16.6 0.3 16.2 0.4 15.8 0.6" fill="#A7BAC8"></path>
                    </g>
                </svg>InspiryThemes
            </a>
        </p>
    </header>
    <div class="settings-content">


		<?php
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'easy-real-estate' ) );
		}

		$this->notice();

		$current_tab = 'price';
		if ( isset( $_GET['tab'] ) && array_key_exists( $_GET['tab'], $this->tabs() ) ) {
			$current_tab = $_GET['tab'];
		}
		$this->tabs_nav( $current_tab );
		?>
        <div class="form-wrapper">
			<?php
			if ( file_exists( ERE_PLUGIN_DIR . 'includes/settings/' . $current_tab . '.php' ) ) {
				require_once ERE_PLUGIN_DIR . 'includes/settings/' . $current_tab . '.php';
			}
			?>
        </div>
		<?php
		// Hook to add RHPE settings page
		do_action( 'rhpe_settings_page', $current_tab );

		?>
    </div>
    <footer class="settings-footer">
		<?php
		$doc_url = 'https://realhomes.io/documentation/';

		if ( ! empty( $_GET['tab'] ) ) {
			switch ( $_GET['tab'] ) {
				case 'price':
					$doc_url = 'https://realhomes.io/documentation/price-format-settings/';
					break;
				case 'slug':
					$doc_url = 'https://realhomes.io/documentation/url-slugs-settings/';
					break;
				case 'map':
					$doc_url = 'https://realhomes.io/documentation/google-maps-setup/';
					break;
				case 'captcha':
					$doc_url = 'https://realhomes.io/documentation/google-recaptcha-setup/';
					break;
				case 'social':
					$doc_url = 'https://realhomes.io/documentation/social-links/';
					break;
				case 'gdpr':
					$doc_url = 'https://realhomes.io/documentation/gdpr/';
					break;
				case 'property':
					$doc_url = 'https://realhomes.io/documentation/property-settings/';
					break;
				case 'property-analytics':
					$doc_url = 'https://realhomes.io/documentation/property-settings/#property-views';
					break;
				case 'webhooks':
					$doc_url = 'https://inspirythemes.com/setup-webhooks-in-realhomes-theme-to-get-push-notifications-to-your-apps/';
					break;
			}
		}

		?>
        <p>
            <span class="dashicons dashicons-editor-help"></span>
	        <?php printf( esc_html__( 'For help, please consult the %1$s documentation %2$s of the theme.', 'easy-real-estate' ), '<a href="' . esc_attr( $doc_url ) . '" target="_blank">', '</a>' ); ?>
        </p>
        <p>
            <span class="dashicons dashicons-feedback"></span>
			<?php printf( esc_html__( 'For feedback, please provide your %1$s feedback here! %2$s', 'easy-real-estate' ), '<a href="' . esc_url( add_query_arg( array( 'page' => 'realhomes-feedback' ), get_admin_url() . 'admin.php' ) ) . '" target="_blank">', '</a>' ); ?>
        </p>
    </footer>
</div><!-- /.wrap -->
