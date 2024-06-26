<?php
/**
 * RealHomes Admin Class.
 *
 * @since   3.8.4
 * @package realhomes/admin
 * @author  InspiryThemes
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * RealHomes Admin Class.
 */
class RH_Admin {

	public static $_instance;
	private $tabs_path = INSPIRY_FRAMEWORK . 'include/admin/tabs/';

	public function __construct() {

		// Admin menu.
		add_action( 'admin_menu', array( $this, 'real_homes_menu' ) );
		add_action( 'admin_menu', array( $this, 're_arrange_menu' ) );

		// Add realhomes demo import page to RealHomes Menu.
		if ( class_exists( 'RHDI_Plugin' ) ) {
			add_filter( 'ocdi/plugin_page_setup', array( $this, 'move_import_demo_data' ), 10, 1 );
		}

		// Enqueue admin styles.
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ), 10, 1 );

		// Enqueue admin scripts.
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ), 10, 1 );

		// Stops Elementor redirection after activation.
		add_action( 'admin_init', function () {
			if ( did_action( 'elementor/loaded' ) ) {
				remove_action( 'admin_init', [ \Elementor\Plugin::$instance->admin, 'maybe_redirect_to_getting_started' ] );
			}
		}, 1 );

		// RealHomes TGMPA Config File
		if ( file_exists( INSPIRY_FRAMEWORK . '/include/tgm/class-tgm-plugin-activation.php' ) && class_exists( 'ERE_Subscription_API' ) && ERE_Subscription_API::status() ) {
			require_once INSPIRY_FRAMEWORK . '/include/tgm/inspiry-required-plugins.php';
		}

		add_action( 'wp_ajax_inspiry_install_plugin', array( $this, 'inspiry_install_plugin' ) );
		add_action( 'wp_ajax_inspiry_activate_plugin', array( $this, 'inspiry_activate_plugin' ) );
		add_action( 'wp_ajax_inspiry_send_feedback', array( $this, 'inspiry_send_feedback' ) );
	}

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function real_homes_menu() {

		add_menu_page(
			esc_html__( 'RealHomes', 'framework' ),
			esc_html__( 'RealHomes', 'framework' ),
			'manage_options',
			'real_homes',
			'',
			get_template_directory_uri() . '/framework/include/admin/images/rh-menu-icon.svg',
			'7'
		);

		// Add all sub menus.
		$sub_menus = [];

		$sub_menus = $this->tabs_menu( $sub_menus );

		// Filter $_SERVER array.
		$server_array = filter_input_array( INPUT_SERVER );

		$customize_settings_slug = 'customize.php';
		if ( isset( $server_array['REQUEST_URI'] ) ) {
			$customize_settings_slug = add_query_arg( 'return', rawurlencode( remove_query_arg( wp_removable_query_args(), wp_unslash( $server_array['REQUEST_URI'] ) ) ), 'customize.php' );
		}

		$sub_menus['settings'] = array(
			'real_homes',
			esc_html__( 'Customize Settings', 'framework' ),
			esc_html__( 'Customize Settings', 'framework' ),
			'manage_options',
			$customize_settings_slug
		);

		// Add demo page if one click demo import plugin exists.
		if ( class_exists( 'RHDI_Plugin' ) && class_exists( 'ERE_Subscription_API' ) && ERE_Subscription_API::status() ) {
			$sub_menus['demoimport'] = array(
				'real_homes',
				esc_html__( 'Demo Import', 'framework' ),
				esc_html__( 'Demo Import', 'framework' ),
				'manage_options',
				'admin.php?page=realhomes-demo-import',
			);
		}

		// Third-party can add more sub_menus.
		$sub_menus = apply_filters( 'real_homes_sub_menus', $sub_menus, 20 );

		if ( $sub_menus ) {
			foreach ( $sub_menus as $sub_menu ) {
				call_user_func_array( 'add_submenu_page', $sub_menu );
			}
		}
	}

	public function tabs_menu( $sub_menus ) {
		$tabs = $this->tabs();
		if ( ! empty( $tabs ) && is_array( $tabs ) ) {
			foreach ( $tabs as $slug => $title ) {
				if ( file_exists( $this->tabs_path . $slug . '.php' ) ) {
					$sub_menus[ $slug ] = array( 'real_homes', $title, $title, 'manage_options', 'realhomes-' . $slug, array( $this, $slug . '_tab' ) );
				}
			}
		}

		return $sub_menus;
	}

	public function tabs() {
		$tabs = array(
			'design'   => esc_html__( 'Design', 'framework' ),
			'plugins'  => esc_html__( 'Plugins', 'framework' ),
			'feedback' => esc_html__( 'Feedback', 'framework' ),
			'help'     => esc_html__( 'Help', 'framework' ),
		);

		return $tabs;
	}

	public function re_arrange_menu() {
		global $submenu;
		unset( $submenu['real_homes'][0] );
	}

	public function move_import_demo_data( $args ) {

		// Check the args.
		if ( empty( $args ) || ! is_array( $args ) ) {
			return $args;
		}

		$args = array(
			'parent_slug' => 'admin.php',
			'page_title'  => esc_html__( 'RealHomes Demo Import', 'framework' ),
			'menu_title'  => esc_html__( 'Demo Import', 'framework' ),
			'capability'  => 'import',
			'menu_slug'   => 'realhomes-demo-import',
		);

		return $args;
	}

	public function header( $tab = 'design' ) {
		?>
        <div id="realhomes-settings-wrap">
        <header class="settings-header">
            <h1><?php esc_html_e( 'RealHomes', 'framework' ); ?><span class="current-version-tag"><?php echo INSPIRY_THEME_VERSION; ?></span></h1>
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
        <div class="realhomes-page-wrap settings-content">
		<?php

		if ( isset( $_POST['inspiry_settings_nonce'] ) && wp_verify_nonce( $_POST['inspiry_settings_nonce'], 'inspiry_settings_action' ) ) {
			$this->notice();
		}

		$this->tabs_nav( $tab );
	}

	public function footer() {

		$doc_url = 'https://realhomes.io/documentation/';

		if ( ! empty( $_GET['page'] ) ) {
			switch ( $_GET['page'] ) {
				case 'realhomes-design':
					$doc_url = 'https://realhomes.io/documentation/design-selection/';
					break;
				case 'realhomes-plugins':
					$doc_url = 'https://realhomes.io/documentation/plugins/';
					break;
				case 'realhomes-feedback':
					$doc_url = 'https://realhomes.io/documentation/feedback/';
					break;
				case 'realhomes-help':
					$doc_url = 'https://realhomes.io/documentation/help/';
					break;
			}
		}

		?>
        </div><!-- .settings-content -->
        <footer class="settings-footer">
            <p>
                <span class="dashicons dashicons-editor-help"></span>
				<?php printf( esc_html__( 'For help, please consult the %1$s documentation %2$s of the theme.', 'framework' ), '<a href="' . esc_url( $doc_url ) . '" target="_blank">', '</a>' ); ?>
            </p>
            <p>
                <span class="dashicons dashicons-feedback"></span>
				<?php printf( esc_html__( 'For feedback, please provide your %1$s feedback here! %2$s', 'framework' ), '<a href="' . esc_url( add_query_arg( array( 'page' => 'realhomes-feedback' ), get_admin_url() . 'admin.php' ) ) . '" target="_blank">', '</a>' ); ?>
            </p>
        </footer>
        </div><!-- /.wrap -->
		<?php
	}

	public function tabs_nav( $current_tab ) {
		$tabs = $this->tabs();
		?>
        <div class="nav-tab-wrapper">
			<?php
			if ( ! empty( $tabs ) && is_array( $tabs ) ) {
				foreach ( $tabs as $slug => $title ) {
					if ( file_exists( $this->tabs_path . $slug . '.php' ) ) {
						$active_tab = ( $current_tab === $slug ) ? ' nav-tab-active' : '';
						$admin_url  = ( $current_tab === $slug ) ? '#' : admin_url( 'admin.php?page=realhomes-' . $slug );
						echo '<a class="nav-tab ' . esc_attr( $active_tab ) . '" href="' . esc_url_raw( $admin_url ) . '" data-tab="' . esc_attr( $slug ) . '">' . esc_html( $title ) . '</a>';
					}
				}
			}
			?>
        </div>
		<?php
	}



	public function design_tab() {
		require_once $this->tabs_path . 'design.php';
	}

	public function plugins_tab() {
		require_once $this->tabs_path . 'plugins.php';
	}

	public function feedback_tab() {
		require_once $this->tabs_path . 'feedback.php';
	}

	public function help_tab() {
		require_once $this->tabs_path . 'help.php';
	}

	public function notice() {
		?>
        <div class="notice notice-success is-dismissible">
            <p><strong><?php esc_html_e( 'Settings saved successfully!', 'framework' ); ?></strong></p>
        </div>
		<?php
	}

	public function admin_styles() {

		wp_enqueue_style( 'inspiry-admin',
			get_template_directory_uri() . '/framework/include/admin/css/admin.css',
			array(),
			INSPIRY_THEME_VERSION,
			'all'
		);
	}

	public function admin_scripts() {

		// Add the color picker css & js files for the EPC color fields.
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_style( 'wp-color-picker' );

		wp_enqueue_script(
			'inspiry-admin-js',
			get_theme_file_uri( 'framework/include/admin/js/admin.js' ),
			array( 'jquery' ),
			INSPIRY_THEME_VERSION,
			true
		);

		wp_add_inline_script( 'inspiry-admin-js', $this->open_menu() );

		$inspiryPluginsSettings = array(
			'ajax_nonce' => wp_create_nonce( 'realhomes-plugins' ),
			'l10n'       => array(
				'installNow'  => esc_attr__( 'Install Now', 'framework' ),
				'installing'  => esc_attr__( 'Installing...', 'framework' ),
				'installed'   => esc_attr__( 'Installed!', 'framework' ),
				'activateNow' => esc_attr__( 'Activate Now', 'framework' ),
				'activating'  => esc_attr__( 'Activating...', 'framework' ),
				'activated'   => esc_attr__( 'Activated!', 'framework' ),
				'active'      => esc_attr__( 'Active', 'framework' ),
				'failed'      => esc_attr__( 'Failed!', 'framework' ),
			)
		);
		wp_localize_script( 'inspiry-admin-js', 'inspiryPluginsSettings', $inspiryPluginsSettings );
	}

	public function open_menu() {
		// Get Current Screen.
		$screen = get_current_screen();

		$menu_list = array(
			'admin_page_realhomes-demo-import'
		);

		$menu_arr = apply_filters( 'real_homes_open_menus_slugs', $menu_list );

		// Check if the current screen's ID has any of the above menu array items.
		if ( isset( $screen->id ) && in_array( $screen->id, $menu_arr ) ) {

			// Filter $_GET array for security.
			$get_array    = filter_input_array( INPUT_GET );
			$current_menu = '';

			if ( isset( $get_array['page'] ) && ( 'realhomes-demo-import' === $get_array['page'] ) ) {
				$current_menu = 'page=realhomes-demo-import';
			}

			if ( isset( $get_array['page'] ) && ( 'rvr-settings' === $get_array['page'] ) ) {
				$current_menu = 'page=rvr-settings';
			}

			if ( ! empty( $current_menu ) ) {
				$data = "
                function rhAdminOpenMenu(currentMenu){
                    $ = jQuery;
                    $(document).ready(function () {
                        $('body').removeClass('sticky-menu');
                        $('#toplevel_page_real_homes').addClass('wp-has-current-submenu wp-menu-open').removeClass('wp-not-current-submenu');
                        $('#toplevel_page_real_homes > a').addClass('wp-has-current-submenu wp-menu-open').removeClass('wp-not-current-submenu');
                        if (currentMenu) {
                            const anchors = $('#toplevel_page_real_homes ul').find('li').children('a');
                            anchors.each(function () {
                                 if (this.href.indexOf(currentMenu) >= 0) {
                                    $(this).parent('li').addClass('current');
                                }
                            });
                        }
                    });
                }
                ";
				$data .= 'rhAdminOpenMenu("' . esc_html( $current_menu ) . '")';

				return $data;
			}
		}
	}

	public function inspiry_send_feedback() {

		if ( isset( $_POST['inspiry_feedback_form_email'] ) ) {

			// Verify Nonce
			if ( ! isset( $_POST['inspiry_feedback_form_nonce'] ) || ! wp_verify_nonce( $_POST['inspiry_feedback_form_nonce'], 'inspiry_feedback_form_action' ) ) {
				echo json_encode( array(
					'success' => false,
					'message' => esc_html__( 'Unverified Nonce!', 'framework' ),
				) );
				die;
			}

			$to_email     = is_email( 'info@inspirythemes.com' );
			$current_user = wp_get_current_user();
			$site_url     = network_site_url( '/' );
			$website      = get_bloginfo( 'name' );
			$from_name    = $current_user->display_name;
			$feedback     = stripslashes( $_POST['inspiry_feedback_form_textarea'] );
			$from_email   = sanitize_email( $_POST['inspiry_feedback_form_email'] );
			$from_email   = is_email( $from_email );

			if ( ! $from_email ) {
				echo json_encode( array(
					'success' => false,
					'message' => esc_html__( 'Provided Email address is invalid!', 'framework' ),
				) );
				die;
			}

			// Email Subject
			$email_subject = esc_html__( 'Feedback received by', 'framework' ) . ' ' . $from_name . ' ' . esc_html__( ' from', 'framework' ) . ' ' . $website;

			// Email Body
			$email_body = esc_html__( "You have received a feedback from: ", 'framework' ) . $from_name . " <br/>";
			if ( ! empty( $website ) ) {
				$email_body .= esc_html__( "Website : ", 'framework' ) . '<a href="' . esc_url( $site_url ) . '" target="_blank">' . $website . "</a><br/><br/>";
			}
			$email_body .= esc_html__( "Their feedback is as follows.", 'framework' ) . " <br/>";
			$email_body .= wpautop( $feedback ) . " <br/>";
			$email_body .= esc_html__( "You can contact ", 'framework' ) . $from_name . esc_html__( " via email, ", 'framework' ) . $from_email;

			// Email Headers ( Reply To and Content Type )
			$headers   = array();
			$headers[] = "Reply-To: $from_name <$from_email>";
			$headers[] = "Content-Type: text/html; charset=UTF-8";
			$headers   = apply_filters( "inspiry_feedback_form_mail_header", $headers ); // just in case if you want to modify the header in child theme

			if ( function_exists( 'ere_mail_wrapper' ) ) {
				if ( ere_mail_wrapper( $to_email, $email_subject, $email_body, $headers ) ) {
					echo json_encode( array(
						'success' => true,
						'message' => esc_html__( "Thank you for your feedback!", 'framework' ),
					) );
				} else {
					echo json_encode( array(
						'success' => false,
						'message' => "Server Error: WordPress mail function failed, please try again!",
						// Error messages should not be translated
					) );
				}
			} else {
				echo json_encode( array(
					'success' => false,
					'message' => "Easy Real Estate Plugin Missing!", // Error messages should not be translated
				) );
			}

		} else {
			echo json_encode( array(
					'success' => false,
					'message' => "Invalid Request!", // Error messages should not be translated
				)
			);
		}

		do_action( 'inspiry_after_feedback_form_submit' );

		wp_die();
	}

	public function inspiry_plugins() {

		$inspiry_plugins = array();

		if ( class_exists( 'RealHomes_Helper' ) ) {

			// Easy Real Estate
			$inspiry_plugins[] = array(
				'name'              => 'Easy Real Estate',
				'slug'              => 'easy-real-estate',
				'file_path'         => 'easy-real-estate/easy-real-estate.php',
				'version'           => RealHomes_Helper::get_plugin_version( 'easy-real-estate' ),
				'source'            => 'https://inspiry-plugins.s3.us-east-2.amazonaws.com/easy-real-estate.zip',
				'required'          => true,
				'author'            => 'Inspiry Themes',
				'author_url'        => 'https://inspirythemes.com/',
				'short_description' => 'Provides real estate functionality for RealHomes theme.'
			);

			// Elementor Page Builder
			$inspiry_plugins[] = array(
				'name'              => 'Elementor Page Builder',
				'slug'              => 'elementor',
				'file_path'         => 'elementor/elementor.php',
				'version'           => '',
				'required'          => true,
				'author'            => 'Elementor.com',
				'author_url'        => 'https://elementor.com/',
				'short_description' => 'The most advanced frontend drag & drop page builder.',
				'icons'             => 'https://ps.w.org/elementor/assets/icon.svg'
			);

			// RealHomes Elementor Addon
			$inspiry_plugins[] = array(
				'name'              => 'RealHomes Elementor Addon',
				'slug'              => 'realhomes-elementor-addon',
				'file_path'         => 'realhomes-elementor-addon/realhomes-elementor-addon.php',
				'version'           => RealHomes_Helper::get_plugin_version( 'realhomes-elementor-addon' ),
				'source'            => 'https://inspiry-plugins.s3.us-east-2.amazonaws.com/realhomes-elementor-addon.zip',
				'required'          => true,
				'author'            => 'InspiryThemes',
				'author_url'        => 'https://inspirythemes.com/',
				'short_description' => 'Provides RealHomes based Elementor widgets.'
			);

			// RealHomes Vacation Rentals
			$inspiry_plugins[] = array(
				'name'              => 'RealHomes Vacation Rentals',
				'slug'              => 'realhomes-vacation-rentals',
				'file_path'         => 'realhomes-vacation-rentals/realhomes-vacation-rentals.php',
				'version'           => RealHomes_Helper::get_plugin_version( 'realhomes-vacation-rentals' ),
				'source'            => 'https://inspiry-plugins.s3.us-east-2.amazonaws.com/realhomes-vacation-rentals.zip',
				'required'          => false,
				'author'            => 'InspiryThemes',
				'author_url'        => 'https://inspirythemes.com/',
				'short_description' => 'Provides vacation rentals functionality.'
			);

			// RealHomes Currency Switcher
			$inspiry_plugins[] = array(
				'name'              => 'RealHomes Currency Switcher',
				'slug'              => 'realhomes-currency-switcher',
				'file_path'         => 'realhomes-currency-switcher/realhomes-currency-switcher.php',
				'version'           => '',
				'required'          => false,
				'author'            => 'InspiryThemes',
				'author_url'        => 'https://inspirythemes.com/',
				'short_description' => 'Provides multiple currencies support and currency switching functionality.',
				'icons'             => 'https://ps.w.org/realhomes-currency-switcher/assets/icon-256x256.png'
			);

			// Real Estate CRM
			$inspiry_plugins[] = array(
				'name'              => 'Real Estate CRM',
				'slug'              => 'real-estate-crm',
				'file_path'         => 'real-estate-crm/real-estate-crm.php',
				'version'           => RealHomes_Helper::get_plugin_version( 'real-estate-crm' ),
				'source'            => 'https://inspiry-plugins.s3.us-east-2.amazonaws.com/real-estate-crm.zip',
				'required'          => false,
				'author'            => 'InspiryThemes',
				'author_url'        => 'https://inspirythemes.com/',
				'short_description' => 'Provides CRM functionality for RealHomes theme.'
			);

			// RealHomes Property Expirator
			$inspiry_plugins[] = array(
				'name'              => 'RealHomes Property Expirator',
				'slug'              => 'realhomes-property-expirator',
				'file_path'         => 'realhomes-property-expirator/realhomes-property-expirator.php',
				'version'           => RealHomes_Helper::get_plugin_version( 'realhomes-property-expirator' ),
				'download_link'     => 'https://codecanyon.net/item/realhomes-property-expirator/25974343',
				'required'          => false,
				'premium'           => true,
				'author'            => 'InspiryThemes',
				'author_url'        => 'https://codecanyon.net/user/inspirythemes/portfolio',
				'short_description' => 'Provides property expiry functionality, Get certain things done on an expiry event.',
				'icons'             => get_template_directory_uri() . '/framework/include/admin/images/plugins/rh-pe-thumb.png'
			);

			// RealHomes Inspiry Memberships
			$inspiry_plugins[] = array(
				'name'              => 'Inspiry Memberships for RealHomes',
				'slug'              => 'inspiry-memberships',
				'file_path'         => 'inspiry-memberships/inspiry-memberships.php',
				'version'           => '',
				'required'          => false,
				'author'            => 'InspiryThemes',
				'author_url'        => 'https://inspirythemes.com/',
				'short_description' => 'Provides memberships functionality with PayPal, Stripe and Wire Transfer support.',
				'icons'             => 'https://ps.w.org/inspiry-memberships/assets/icon-256x256.png'
			);

			// RealHomes WooCommerce Payments Addon.
			$inspiry_plugins[] = array(
				'name'              => 'RealHomes WooCommerce Payments Addon',
				'slug'              => 'realhomes-wc-payments-addon',
				'file_path'         => 'realhomes-wc-payments-addon/realhomes-wc-payments-addon.php',
				'version'           => RealHomes_Helper::get_plugin_version( 'realhomes-wc-payments-addon' ),
				'source'            => 'https://inspiry-plugins.s3.us-east-2.amazonaws.com/realhomes-wc-payments-addon.zip',
				'required'          => false,
				'author'            => 'InspiryThemes',
				'author_url'        => 'https://inspirythemes.com/',
				'short_description' => 'Provides WooCommerce Payments support for RealHomes theme.'
			);

			// Inspiry Stripe Payments for RealHomes
			$inspiry_plugins[] = array(
				'name'              => 'Inspiry Stripe Payments for RealHomes',
				'slug'              => 'inspiry-stripe-payments',
				'file_path'         => 'inspiry-stripe-payments/inspiry-stripe-payments.php',
				'version'           => '',
				'required'          => false,
				'author'            => 'InspiryThemes',
				'author_url'        => 'https://inspirythemes.com/',
				'short_description' => 'Provides Stripe payments support for individual properties submitted from front-end.',
				'icons'             => 'https://ps.w.org/inspiry-stripe-payments/assets/icon-256x256.png'
			);

			// RealHomes PayPal Payments
			$inspiry_plugins[] = array(
				'name'              => 'RealHomes PayPal Payments',
				'slug'              => 'realhomes-paypal-payments',
				'file_path'         => 'realhomes-paypal-payments/realhomes-paypal-payments.php',
				'version'           => '',
				'required'          => false,
				'author'            => 'InspiryThemes',
				'author_url'        => 'https://inspirythemes.com/',
				'short_description' => 'Provides PayPal payments support for individual properties submitted from front-end.',
				'icons'             => 'https://ps.w.org/realhomes-paypal-payments/assets/icon-256x256.png'
			);

			// Quick and Easy FAQs
			$inspiry_plugins[] = array(
				'name'              => 'Quick and Easy FAQs',
				'slug'              => 'quick-and-easy-faqs',
				'file_path'         => 'quick-and-easy-faqs/quick-and-easy-faqs.php',
				'version'           => '',
				'required'          => false,
				'author'            => 'InspiryThemes',
				'author_url'        => 'https://themeforest.net/user/inspirythemes/portfolio?order_by=sales',
				'short_description' => 'A quick and easy way to add FAQs to your site.',
				'icons'             => 'https://ps.w.org/quick-and-easy-faqs/assets/icon-256x256.png'
			);

			// RealHomes Demo Import
			$inspiry_plugins[] = array(
				'name'              => 'RealHomes Demo Import',
				'slug'              => 'realhomes-demo-import',
				'file_path'         => 'realhomes-demo-import/realhomes-demo-import.php',
				'version'           => RealHomes_Helper::get_plugin_version( 'realhomes-demo-import' ),
				'source'            => 'https://inspiry-plugins.s3.us-east-2.amazonaws.com/realhomes-demo-import.zip',
				'required'          => false,
				'author'            => 'InspiryThemes',
				'author_url'        => 'http://www.inspirythemes.com',
				'short_description' => 'Import RealHomes demo contents with one click.',
				'icons'             => get_template_directory_uri() . '/framework/include/admin/images/plugins/rhdi-thumbnail.png'
			);

			// Slider Revolution
			$inspiry_plugins[] = array(
				'name'              => 'Slider Revolution',
				'slug'              => 'revslider',
				'file_path'         => 'revslider/revslider.php',
				'version'           => RealHomes_Helper::get_plugin_version( 'revslider' ),
				'source'            => 'https://inspiry-plugins.s3.us-east-2.amazonaws.com/revslider.zip',
				'required'          => false,
				'author'            => '',
				'author_url'        => '',
				'short_description' => 'Slider Revolution plugin',
				'icons'             => get_template_directory_uri() . '/framework/include/admin/images/plugins/revslider-thumb.png'
			);

		}

		return $inspiry_plugins;
	}

	public function inspiry_is_active_plugin( $plugin ) {
		return in_array( $plugin, (array)get_option( 'active_plugins', array() ) ) || is_plugin_active_for_network( $plugin );
	}

	public function inspiry_install_plugin() {

		check_ajax_referer( 'realhomes-plugins' );

		if ( empty( $_POST['slug'] ) ) {
			wp_send_json_error();
		}

		if ( ! current_user_can( 'install_plugins' ) ) {
			wp_send_json_error();
		}

		include_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
		include_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );

		$api = plugins_api(
			'plugin_information',
			array(
				'slug'   => sanitize_key( wp_unslash( $_POST['slug'] ) ),
				'fields' => array(
					'sections' => false,
				),
			)
		);

		$status        = null;
		$download_link = null;
		if ( isset( $_POST['source'] ) && ! empty( $_POST['source'] ) ) {
			$download_link = esc_url( $_POST['source'] );
		} else {
			if ( is_wp_error( $api ) ) {
				wp_send_json_error();
			}

			$download_link        = $api->download_link;
			$status['pluginName'] = $api->name;
		}

		$skin     = new WP_Ajax_Upgrader_Skin();
		$upgrader = new Plugin_Upgrader( $skin );
		$result   = $upgrader->install( $download_link );

		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			$status['debug'] = $skin->get_upgrade_messages();
		}

		if ( is_wp_error( $result ) ) {
			$status['errorCode']    = $result->get_error_code();
			$status['errorMessage'] = $result->get_error_message();
			wp_send_json_error( $status );
		} else if ( is_wp_error( $skin->result ) ) {
			$status['errorCode']    = $skin->result->get_error_code();
			$status['errorMessage'] = $skin->result->get_error_message();
			wp_send_json_error( $status );
		} else if ( $skin->get_errors()->has_errors() ) {
			$status['errorMessage'] = $skin->get_error_messages();
			wp_send_json_error( $status );
		} else if ( is_null( $result ) ) {
			global $wp_filesystem;
			$status['errorCode'] = 'unable_to_connect_to_filesystem';

			// Pass through the error from WP_Filesystem if one was raised.
			if ( $wp_filesystem instanceof WP_Filesystem_Base && is_wp_error( $wp_filesystem->errors ) && $wp_filesystem->errors->has_errors() ) {
				$status['errorMessage'] = esc_html( $wp_filesystem->errors->get_error_message() );
			}

			wp_send_json_error( $status );
		}

		$install_status = install_plugin_install_status( $api );
		$pagenow        = isset( $_POST['pagenow'] ) ? sanitize_key( $_POST['pagenow'] ) : '';

		// If installation request is coming from import page, do not return network activation link.
		$plugins_url = ( 'import' === $pagenow ) ? admin_url( 'plugins.php' ) : network_admin_url( 'plugins.php' );

		if ( current_user_can( 'activate_plugin', $install_status['file'] ) && is_plugin_inactive( $install_status['file'] ) ) {
			$status['activateUrl'] = add_query_arg(
				array(
					'_wpnonce' => wp_create_nonce( 'activate-plugin_' . $install_status['file'] ),
					'action'   => 'activate',
					'plugin'   => $install_status['file'],
				),
				$plugins_url
			);
		}

		if ( is_multisite() && current_user_can( 'manage_network_plugins' ) && 'import' !== $pagenow ) {
			$status['activateUrl'] = add_query_arg( array( 'networkwide' => 1 ), $status['activateUrl'] );
		}

		wp_send_json_success( $status );
	}

	public function inspiry_activate_plugin() {
		check_ajax_referer( 'realhomes-plugins' );

		$result   = activate_plugin( $_POST['plugin'] );
		$response = array();
		if ( is_wp_error( $result ) ) {
			$response['errorMessage'] = $result->get_error_message();
			wp_send_json_error( $response );
		} else {
			wp_send_json_success();
		}
	}

	protected function inspiry_postbox_posts( $posts = array(), $heading = "" ) {
		if ( isset( $heading ) && ! empty( $heading ) ) : ?>
            <h3 class="inspiry-postbox-heading"><?php echo esc_html( $heading ); ?></h3>
		<?php endif; ?><?php if ( ! empty( $posts ) && is_array( $posts ) ) : ?>
            <ul class="inspiry-postbox-posts">
				<?php foreach ( $posts as $post ) : ?>
                    <li>
						<?php if ( isset( $post['link'] ) && ! empty( $post['link'] ) ) : ?>
                            <a href="<?php echo esc_url( $post['link'] ); ?>" target="_blank"><?php echo esc_html( $post['title'] ); ?></a>
						<?php endif; ?>
						<?php if ( isset( $post['description'] ) && ! empty( $heading ) ) : ?>
                            <p class="inspiry-postbox-post-description">​<?php echo wp_kses( $post['description'], inspiry_allowed_html() ); ?></p>
						<?php endif; ?>
                    </li>
				<?php endforeach; ?>
            </ul>
		<?php
		endif;
	}

	protected function inspiry_quick_links( $links = array(), $target = "_blank" ) {
		if ( ! empty( $links ) && is_array( $links ) ) : ?>
            <ul class="inspiry-quick-links">
				<?php foreach ( $links as $link ) : ?>
                    <li>
                        <a href="<?php echo esc_url( $link['link'] ); ?>" <?php echo empty( $target ) ? '' : sprintf( 'target="%s"', esc_attr( $target ) ); ?>>
							<?php echo esc_html( $link['title'] ); ?>
                            <span aria-hidden="true" class="dashicons dashicons-external"></span>
                        </a>
                    </li>
				<?php endforeach; ?>
            </ul>
		<?php
		endif;
	}

	protected function inspiry_get_plugin_action_links( $plugin ) {
		if ( current_user_can( 'install_plugins' ) || current_user_can( 'update_plugins' ) ) {
			$slug         = $plugin['slug'];
			$file_path    = $plugin['file_path'];
			$status       = install_plugin_install_status( $plugin );
			$action_links = array();
			$plugin_exist = false;

			$validate_plugin = validate_plugin( $file_path );
			if ( ! is_wp_error( $validate_plugin ) ) {
				$plugin_exist = true;
			}

			if ( isset( $plugin['download_link'] ) && ! empty( $plugin['download_link'] && ! $plugin_exist ) ) {
				$status['status'] = 'download_link';
				$status['url']    = $plugin['download_link'];
			}

			switch ( $status['status'] ) {
				case 'download_link':
					$action_links[] = sprintf(
						'<a class="download-link button" href="%s" target="_blank">%s</a>',
						esc_url( $plugin['download_link'] ),
						esc_attr__( 'Buy Now', 'framework' )
					);
					break;
				case 'install':
					$install = esc_attr__( 'Install Now', 'framework' );
					if ( isset( $plugin['source'] ) && ! empty( $plugin['source'] ) ) {
						$action_links[] = sprintf(
							'<a class="install-now button" href="#" data-plugin="%s" data-slug="%s" data-source="%s">%s</a>',
							esc_attr( $file_path ),
							esc_attr( $slug ),
							esc_url( $plugin['source'] ),
							$install
						);
					} else {
						$action_links[] = sprintf(
							'<a class="install-now button" href="#" data-plugin="%s" data-slug="%s">%s</a>',
							esc_attr( $file_path ),
							esc_attr( $slug ),
							$install
						);
					}
					break;
				case 'update_available':
				case 'latest_installed':
				case 'newer_installed':
					if ( is_plugin_inactive( $file_path ) && current_user_can( 'activate_plugin', $file_path ) ) {
						$action_links[] = sprintf( '<a href="#" class="activate-now button" data-plugin="%s" data-slug="%s">%s</a>',
							esc_attr( $file_path ),
							esc_attr( $slug ),
							esc_attr__( 'Activate', 'framework' )
						);
					} else {
						$action_links[] = sprintf( '<button type="button" class="button button-disabled" disabled="disabled">%s</button>',
							esc_attr__( 'Active', 'framework' )
						);
					}
					break;
			}

			return $action_links;
		}
	}
}

/**
 * Initialize realhomes admin class.
 */
function inspiry_rh_admin() {
	return RH_Admin::instance();
}

inspiry_rh_admin();