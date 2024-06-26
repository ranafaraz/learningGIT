<?php
/**
 * Design variation related functions
 *
 * This file contains all the functions related to design
 * variations of this theme.
 *
 * @package realhomes
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'inspiry_header_print_scripts' ) ) {
	/**
	 * Print header scripts.
	 */
	function inspiry_header_print_scripts() {
		?>
        <script>
			<?php
			// Generate ajax url to use across the website.
			$ajax_url = admin_url( 'admin-ajax.php' );
			$wpml_current_lang = apply_filters( 'wpml_current_language', null );
			if ( $wpml_current_lang && ! is_admin() ) {
				$ajax_url = add_query_arg( 'wpml_lang', $wpml_current_lang, $ajax_url );
			}
			?>// Declare some common JS variables.
            var ajaxurl = "<?php echo esc_url( $ajax_url ); ?>";
        </script>
		<?php
	}

	add_action( 'wp_print_scripts', 'inspiry_header_print_scripts' );
}

if ( ! function_exists( 'inspiry_enqueue_theme_styles' ) ) {
	/**
	 * Load Required CSS Styles
	 */
	function inspiry_enqueue_theme_styles() {
		if ( ! is_page_template( 'templates/dashboard.php' ) ) {
			if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
				inspiry_enqueue_classic_styles();
			} else if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
				inspiry_enqueue_modern_styles();
			} else if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {
				inspiry_enqueue_ultra_styles();
			}

			inspiry_enqueue_common_styles();
		}
	}

	add_action( 'wp_enqueue_scripts', 'inspiry_enqueue_theme_styles' );
}

if ( ! function_exists( 'inspiry_enqueue_theme_scripts' ) ) {
	/**
	 * Enqueue JavaScripts required for this theme
	 */
	function inspiry_enqueue_theme_scripts() {
		if ( ! is_page_template( 'templates/dashboard.php' ) ) {
			if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
				inspiry_enqueue_classic_scripts();
			} else if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
				inspiry_enqueue_modern_scripts();
			} else if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {
				inspiry_enqueue_ultra_scripts();
			}

			inspiry_enqueue_common_scripts();
		}
	}

	add_action( 'wp_enqueue_scripts', 'inspiry_enqueue_theme_scripts' );
}

if ( ! function_exists( 'inspiry_enqueue_classic_styles' ) ) {
	/**
	 * Function to load classic styles.
	 *
	 * @since 2.7.0
	 */
	function inspiry_enqueue_classic_styles() {
		if ( ! is_admin() ) {

			$js_dir_path  = '/assets/' . INSPIRY_DESIGN_VARIATION . '/scripts/';
			$css_dir_path = '/assets/' . INSPIRY_DESIGN_VARIATION . '/styles/';

			/*
			 * Register Default and Custom Styles
			 */
			wp_register_style(
				'parent-default',
				get_stylesheet_uri(),
				array(),
				INSPIRY_THEME_VERSION,
				'all'
			);

			// Flex Slider
			wp_dequeue_style( 'flexslider' );       // dequeue flexslider if it registered by a plugin.
			wp_deregister_style( 'flexslider' );    // deregister flexslider if it registered by a plugin.

			// Main CSS in minified format
			wp_enqueue_style(
				'main-css',
				get_theme_file_uri( $css_dir_path . 'css/main.min.css' ),
				array(),
				INSPIRY_THEME_VERSION,
				'all'
			);

			/*
			 * RTL Styles
			 */
			if ( is_rtl() ) {
				wp_enqueue_style(
					'rtl-main-css',
					get_theme_file_uri( $css_dir_path . 'css/rtl-main.min.css' ),
					array(),
					INSPIRY_THEME_VERSION,
					'all'
				);
			}

			wp_add_inline_style( 'main-css', apply_filters( 'realhomes_classic_custom_css', '' ) );

			/*
			 * IF Visual Composer Plugins installed and activated
			 */
			if ( class_exists( 'Vc_Manager' ) ) {
				wp_enqueue_style(
					'vc-css',
					get_theme_file_uri( $css_dir_path . 'css/visual-composer.min.css' ),
					array(),
					INSPIRY_THEME_VERSION,
					'all'
				);
			}

			// default css.
			wp_enqueue_style( 'parent-default' );
		}
	}
}

if ( ! function_exists( 'inspiry_enqueue_classic_scripts' ) ) {
	/**
	 * Function to load classic scripts.
	 *
	 * @since 2.7.0
	 */
	function inspiry_enqueue_classic_scripts() {
		if ( ! is_admin() ) {

			$js_dir_path = '/assets/' . INSPIRY_DESIGN_VARIATION . '/scripts/';

			// flexslider
			wp_dequeue_script( 'flexslider' );      // dequeue flexslider if it is enqueue by some plugin.

			/**
			 * Registering of Scripts
			 */

			// Search form script.
			wp_register_script(
				'inspiry-search',
				get_theme_file_uri( $js_dir_path . 'js/inspiry-search-form.js' ),
				array( 'jquery' ),
				INSPIRY_THEME_VERSION,
				true
			);

			// Theme's main script.
			wp_register_script(
				'custom',
				get_theme_file_uri( $js_dir_path . 'js/custom.js' ),
				array( 'jquery' ),
				INSPIRY_THEME_VERSION,
				true
			);

			/**
			 * Enqueue Scripts that are needed on all the pages
			 */
			wp_enqueue_script( 'jquery-ui-autocomplete' );
			wp_enqueue_script( 'jquery-form' );

			/*
			 * Classic Vendors Minified JS, includes the following scripts
             * 1. jquery.easing.min.js
             * 2. elastislide/jquery.elastislide.js
             * 3. jquery.jcarousel.min.js
             * 4. jquery.transit.min.js
			 */
			wp_enqueue_script(
				'classic-vendors-js',
				get_theme_file_uri( $js_dir_path . 'vendors/vendors.min.js' ),
				array( 'jquery', ),
				INSPIRY_THEME_VERSION,
				true
			);

			/**
			 * Maps Script
			 */
			$map_type = inspiry_get_maps_type();

			if ( 'google-maps' == $map_type ) {
				inspiry_enqueue_google_maps();
			} else if ( 'mapbox' == $map_type ) {
				realhomes_enqueue_mapbox();
			} else {
				inspiry_enqueue_open_street_map();
			}

			/* Print select status for rent to switch prices in properties search form */
			$rent_slug               = get_option( 'theme_status_for_rent' );
			$localized_search_params = array();
			if ( ! empty( $rent_slug ) ) {
				$localized_search_params['rent_slug'] = $rent_slug;
			}

			/* localize search parameters */
			wp_localize_script( 'inspiry-search', 'localizedSearchParams', $localized_search_params );

			/* Inspiry search form script */
			wp_enqueue_script( 'inspiry-search' );

			/*
			 * Google reCaptcha
			 */
			if ( class_exists( 'Easy_Real_Estate' ) ) {
				if ( ere_is_reCAPTCHA_configured() ) {

					$inspiry_contact_form_shortcode = get_option( 'inspiry_contact_form_shortcode' );
					$reCPATCHA_type                 = get_option( 'inspiry_reCAPTCHA_type', 'v2' );

					if ( 'v3' === $reCPATCHA_type ) {
						$render = get_option( 'theme_recaptcha_public_key' );
					} else {
						$render = 'explicit';
					}

					$recaptcha_src = esc_url_raw( add_query_arg( array(
						'render' => $render,
						'onload' => 'loadInspiryReCAPTCHA',
					), '//www.google.com/recaptcha/api.js' ) );

					if ( ! is_page_template( 'templates/contact.php' ) ) {
						// Enqueue google reCAPTCHA API.
						wp_enqueue_script(
							'rh-google-recaptcha',
							$recaptcha_src,
							array(),
							INSPIRY_THEME_VERSION,
							true
						);
					} else if ( empty( $inspiry_contact_form_shortcode ) ) {
						// Enqueue google reCAPTCHA API.
						wp_enqueue_script(
							'rh-google-recaptcha',
							$recaptcha_src,
							array(),
							INSPIRY_THEME_VERSION,
							true
						);
					}
				}
			}

			/* custom js localization */
			$localized_array = array(
				'nav_title'          => esc_html__( 'Go to...', 'framework' ),
				'more_search_fields' => esc_html__( 'More fields', 'framework' ),
				'less_search_fields' => esc_html__( 'Less fields', 'framework' )
			);
			wp_localize_script( 'custom', 'localized', $localized_array );


			$select_string = array(
				'select_noResult' => get_option( 'inspiry_select2_no_result_string', esc_html__( 'No Results Found!', 'framework' ) )
			);
			wp_localize_script( 'custom', 'localizeSelect', $select_string );

			if ( is_page_template( 'templates/home.php' ) ) {
				$inspiry_cfos_success_redirect_page = get_post_meta( get_the_ID(), 'inspiry_cfos_success_redirect_page', true );
				if ( ! empty( $inspiry_cfos_success_redirect_page ) ) {
					$CFOSData = array( 'redirectPageUrl' => get_the_permalink( $inspiry_cfos_success_redirect_page ) );
					wp_localize_script( 'custom', 'CFOSData', $CFOSData );
				}
			}

			if ( is_page_template( 'templates/contact.php' ) ) {
				$inspiry_contact_form_success_redirect_page = get_post_meta( get_the_ID(), 'inspiry_contact_form_success_redirect_page', true );
				if ( ! empty( $inspiry_contact_form_success_redirect_page ) ) {
					$contactFromData = array( 'redirectPageUrl' => get_the_permalink( $inspiry_contact_form_success_redirect_page ) );
					wp_localize_script( 'custom', 'contactFromData', $contactFromData );
				}
			}

			/* Finally enqueue theme's main script */
			wp_enqueue_script( 'custom' );

		}
	}

}

if ( ! function_exists( 'inspiry_enqueue_modern_styles' ) ) {
	/**
	 * Function to load modern styles.
	 *
	 * @since 3.0.0
	 */
	function inspiry_enqueue_modern_styles() {

		if ( ! is_admin() ) {

			$js_dir_path  = '/assets/' . INSPIRY_DESIGN_VARIATION . '/scripts/';
			$css_dir_path = '/assets/' . INSPIRY_DESIGN_VARIATION . '/styles/';

			/**
			 * Register Default and Custom Styles
			 */
			wp_register_style(
				'parent-default',
				get_stylesheet_uri(),
				array(),
				INSPIRY_THEME_VERSION,
				'all'
			);

			// Flex Slider
			wp_dequeue_style( 'flexslider' );       // dequeue flexslider if it registered by a plugin.
			wp_deregister_style( 'flexslider' );    // deregister flexslider if it registered by a plugin.

			if ( is_singular( 'property' ) ) {

				// entypo fonts.
				wp_enqueue_style(
					'entypo-fonts',
					get_theme_file_uri( $css_dir_path . 'css/entypo.min.css' ),
					array(),
					INSPIRY_THEME_VERSION,
					'all'
				);

				// enqueuing jquery ui datepicker if related section is enabled
				if ( realhomes_display_schedule_a_tour() ) {
					wp_enqueue_style(
						'jquery-ui-datepicker',
						'https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css',
						array(),
						INSPIRY_THEME_VERSION,
						'all'
					);
				}
			}

			/**
			 * Main CSS
			 */
			wp_enqueue_style(
				'main-css',
				get_theme_file_uri( $css_dir_path . 'css/main.min.css' ),
				array(),
				INSPIRY_THEME_VERSION,
				'all'
			);

			wp_add_inline_style( 'main-css', apply_filters( 'realhomes_modern_custom_css', '' ) );

			/**
			 * RTL Styles
			 */
			if ( is_rtl() ) {
				wp_enqueue_style(
					'rtl-main-css',
					get_theme_file_uri( $css_dir_path . 'css/rtl-main.min.css' ),
					array(),
					INSPIRY_THEME_VERSION,
					'all'
				);
			}

			// default css.
			wp_enqueue_style( 'parent-default' );

		}
	}
}

if ( ! function_exists( 'inspiry_enqueue_modern_scripts' ) ) {
	/**
	 * Function to load modern scripts.
	 *
	 * @since 3.0.0
	 */
	function inspiry_enqueue_modern_scripts() {

		if ( ! is_admin() ) {

			$js_dir_path = '/assets/' . INSPIRY_DESIGN_VARIATION . '/scripts/';

			// Flexslider.
			wp_dequeue_script( 'flexslider' );      // dequeue flexslider if it is enqueue by some plugin.

			// Progress bar.
			wp_register_script(
				'progress-bar',
				get_theme_file_uri( $js_dir_path . 'vendors/progressbar/dist/progressbar.min.js' ),
				array( 'jquery' ),
				'1.0.1',
				true
			);

			// Compatibility of Optima Express
			if ( class_exists( 'iHomefinderAdmin' ) ) {
				wp_enqueue_script(
					'ihm-bootstrap',
					get_theme_file_uri( $js_dir_path . 'vendors/ihm-bootstrap.min.js' ),
					array( 'jquery' ),
					'3.0.0',
					true
				);
			}

			/**
			 * Edit profile template
			 */
			wp_enqueue_script( 'progress-bar' );
			wp_enqueue_script( 'jquery-form' );

			/**
			 * Maps Script
			 */
			$map_type = inspiry_get_maps_type();

			if ( 'google-maps' == $map_type ) {
				inspiry_enqueue_google_maps();
			} else if ( 'mapbox' == $map_type ) {
				realhomes_enqueue_mapbox();
			} else {
				inspiry_enqueue_open_street_map();
			}

			// Search form script.
			wp_register_script(
				'inspiry-search',
				get_theme_file_uri( $js_dir_path . 'js/inspiry-search-form.js' ),
				array( 'jquery' ),
				INSPIRY_THEME_VERSION,
				true
			);

			// Theme's main script.
			wp_register_script(
				'custom',
				get_theme_file_uri( $js_dir_path . 'js/custom.js' ),
				array( 'jquery' ),
				INSPIRY_THEME_VERSION,
				true
			);

			// Ajax Search Script.
			$realhomes_ajax_search_status = realhomes_get_ajax_search_results_status();
			if ( $realhomes_ajax_search_status ) {
				wp_register_script(
					'ajax-search',
					get_theme_file_uri( $js_dir_path . 'js/ajax-search.js' ),
					array( 'jquery' ),
					INSPIRY_THEME_VERSION,
					true
				);
			}

			// Agent Search Script.
			wp_register_script(
				'agent-search',
				get_theme_file_uri( $js_dir_path . 'js/agent-search.js' ),
				array( 'jquery' ),
				INSPIRY_THEME_VERSION,
				true
			);

			// Agency Search Script.
			wp_register_script(
				'agency-search',
				get_theme_file_uri( $js_dir_path . 'js/agency-search.js' ),
				array( 'jquery' ),
				INSPIRY_THEME_VERSION,
				true
			);

			if ( is_singular( 'property' ) ) {

				wp_enqueue_script(
					'share-js',
					get_theme_file_uri( $js_dir_path . 'vendors/share.min.js' ),
					array( 'jquery' ),
					INSPIRY_THEME_VERSION,
					true
				);

				wp_enqueue_script(
					'property-share',
					get_theme_file_uri( $js_dir_path . 'js/property-share.js' ),
					array( 'jquery' ),
					INSPIRY_THEME_VERSION,
					true
				);

				if ( 'true' === get_option( 'realhomes_line_social_share', 'false' ) ) {
					$realhomes_line_social_share = "
					(function($) { 
					    'use strict';
						$(document).ready(function () {
							$(window).on('load', function () {
							    var shareThisDiv = $('.share-this');
							    shareThisDiv.addClass('realhomes-line-social-share-enabled');
								shareThisDiv.find('ul').append('<li class=\"entypo-line\" id=\"realhomes-line-social-share\"><i class=\"fab fa-line\"></i></li>');
							});
							$(document).on('click', '#realhomes-line-social-share', function () {
								window.open(
									'https://social-plugins.line.me/lineit/share?url=' + encodeURIComponent(window.location.href),
									'_blank',
									'location=yes,height=570,width=520,scrollbars=yes,status=yes'
								);
							});
						});
					})(jQuery);";
					wp_add_inline_script( 'property-share', $realhomes_line_social_share );
				}

				if ( realhomes_display_schedule_a_tour() ) {
					wp_enqueue_script( 'jquery-ui-datepicker' );
				}

				// Property detail page custom script.
				wp_enqueue_script(
					'property-detail-custom',
					get_theme_file_uri( $js_dir_path . 'js/property-detail.js' ),
					array( 'jquery' ),
					INSPIRY_THEME_VERSION,
					true
				);
			}


			/* Print select status for rent to switch prices in properties search form */
			$rent_slug               = get_option( 'theme_status_for_rent' );
			$localized_search_params = array();
			if ( ! empty( $rent_slug ) ) {
				$localized_search_params['rent_slug'] = $rent_slug;
			}

			/* localize search parameters */
			wp_localize_script( 'inspiry-search', 'localizedSearchParams', $localized_search_params );

			wp_localize_script( 'inspiry-search', 'frontEndAjaxUrl', array( 'sfoiajaxurl' => admin_url( 'admin-ajax.php' ) ) );

			/* Inspiry search form script */
			wp_enqueue_script( 'inspiry-search' );

			/**
			 * Google reCaptcha
			 */
			if ( class_exists( 'Easy_Real_Estate' ) ) {
				if ( ere_is_reCAPTCHA_configured() ) {

					$inspiry_contact_form_shortcode = get_option( 'inspiry_contact_form_shortcode' );
					$reCPATCHA_type                 = get_option( 'inspiry_reCAPTCHA_type', 'v2' );

					if ( 'v3' === $reCPATCHA_type ) {
						$render = get_option( 'theme_recaptcha_public_key' );
					} else {
						$render = 'explicit';
					}

					$modern_recaptcha_src = esc_url_raw( add_query_arg( array(
						'render' => $render,
						'onload' => 'loadInspiryReCAPTCHA',
					), '//www.google.com/recaptcha/api.js' ) );

					if ( ! is_page_template( 'templates/contact.php' ) ) {
						// Enqueue google reCAPTCHA API.
						wp_enqueue_script(
							'inspiry-google-recaptcha',
							$modern_recaptcha_src,
							array(),
							INSPIRY_THEME_VERSION,
							true
						);
					} else if ( empty( $inspiry_contact_form_shortcode ) ) {
						// Enqueue google reCAPTCHA API.
						wp_enqueue_script(
							'inspiry-google-recaptcha',
							$modern_recaptcha_src,
							array(),
							INSPIRY_THEME_VERSION,
							true
						);
					} else {
						remove_action( 'wp_footer', 'ere_recaptcha_callback_generator' );
					}
				}
			}

			$select_string = array(
				'select_noResult' => get_option( 'inspiry_select2_no_result_string', esc_html__( 'No Results Found!', 'framework' ) ),
			);
			wp_localize_script( 'custom', 'localizeSelect', $select_string );

			if ( is_page_template( 'templates/home.php' ) ) {
				$inspiry_cfos_success_redirect_page = get_post_meta( get_the_ID(), 'inspiry_cfos_success_redirect_page', true );
				if ( ! empty( $inspiry_cfos_success_redirect_page ) ) {
					$CFOSData = array( 'redirectPageUrl' => get_the_permalink( $inspiry_cfos_success_redirect_page ) );
					wp_localize_script( 'custom', 'CFOSData', $CFOSData );
				}
			}

			if ( is_page_template( 'templates/contact.php' ) ) {
				$inspiry_contact_form_success_redirect_page = get_post_meta( get_the_ID(), 'inspiry_contact_form_success_redirect_page', true );
				if ( ! empty( $inspiry_contact_form_success_redirect_page ) ) {
					$contactFromData = array( 'redirectPageUrl' => get_the_permalink( $inspiry_contact_form_success_redirect_page ) );
					wp_localize_script( 'custom', 'contactFromData', $contactFromData );
				}
			}

            // Enqueue the script needed for the radius search slider on search results page templates.
			if ( 'geo-location' === get_option( 'realhomes_location_field_type', 'default' ) && 'modern' === INSPIRY_DESIGN_VARIATION && inspiry_is_rvr_enabled() ) {
				if ( get_option( 'theme_search_module', 'properties-map' ) && inspiry_is_search_page_map_visible() && is_page_template( array(
						'templates/properties-search.php',
						'templates/properties-search-half-map.php',
						'templates/half-map-layout.php',
						'templates/properties-search-left-sidebar.php',
						'templates/properties-search-right-sidebar.php'
					) ) ) {
					wp_enqueue_script( 'jquery-ui-slider' );
				}
			}

            // Creating data Array for Ajax Pagination & Ajax Search Localization
			$localized_ajax_search_array = array(
				'additionalFields' => realhomes_get_additional_fields( 'search' ),
				'mapService'       => get_option( 'ere_theme_map_type', 'openstreetmaps' ),
			);

            // Localizing for pagination and stats
			wp_localize_script( 'custom', 'localized', $localized_ajax_search_array );
			wp_enqueue_script( 'custom' );

			// Localizing for Ajax Search
			if ( $realhomes_ajax_search_status ) {
				wp_localize_script( 'ajax-search', 'localized', $localized_ajax_search_array );
				wp_enqueue_script( 'ajax-search' );
			}

			if ( is_page_template( 'templates/agents-list.php' ) ) {
				wp_enqueue_script( 'agent-search' );
			}

			if ( is_page_template( 'templates/agencies-list.php' ) ) {
				wp_enqueue_script( 'agency-search' );
			}

		}
	}
}

if ( ! function_exists( 'inspiry_enqueue_ultra_styles' ) ) {

	function inspiry_enqueue_ultra_styles() {
		$js_dir_path  = '/assets/' . INSPIRY_DESIGN_VARIATION . '/scripts/';
		$css_dir_path = '/assets/' . INSPIRY_DESIGN_VARIATION . '/styles/';

		$inspiry_optimise_css = get_option( 'inspiry_optimise_css' );


		/**
		 * Register Default and Custom Styles
		 */
		wp_register_style(
			'parent-default',
			get_stylesheet_uri(),
			array(),
			INSPIRY_THEME_VERSION,
			'all'
		);

		if ( is_singular( 'property' ) ) {

			// entypo fonts.
			wp_enqueue_style(
				'entypo-fonts',
				get_theme_file_uri( $css_dir_path . 'css/entypo.min.css' ),
				array(),
				INSPIRY_THEME_VERSION,
				'all'
			);
		}
		if ( realhomes_display_schedule_a_tour() ) {
			wp_enqueue_style(
				'jquery-ui-datepicker',
				'http://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css',
				array(),
				INSPIRY_THEME_VERSION,
				'all'
			);
		}


		if ( 'true' === $inspiry_optimise_css ) {
			wp_enqueue_style(
				'main-css',
				get_theme_file_uri( $css_dir_path . 'css/main.min.css' ),
				array(),
				INSPIRY_THEME_VERSION,
				'all'
			);
		} else {
			wp_enqueue_style(
				'main-css',
				get_theme_file_uri( $css_dir_path . 'css/main.css' ),
				array(),
				INSPIRY_THEME_VERSION,
				'all'
			);
		}

		wp_add_inline_style( 'main-css', apply_filters( 'realhomes_ultra_custom_css', '' ) );

		wp_enqueue_style( 'parent-default' );
	}
}

if ( ! function_exists( 'inspiry_enqueue_ultra_scripts' ) ) {

	function inspiry_enqueue_ultra_scripts() {

		if ( is_admin() ) {
			return;
		}

		$js_dir_path = '/assets/' . INSPIRY_DESIGN_VARIATION . '/scripts/';

		// Maps Script
		$map_type = inspiry_get_maps_type();

		if ( 'google-maps' == $map_type ) {
			inspiry_enqueue_google_maps();
		} else if ( 'mapbox' == $map_type ) {
			realhomes_enqueue_mapbox();
		} else {
			inspiry_enqueue_open_street_map();
		}

		// Search form script.
		wp_register_script(
			'inspiry-search',
			get_theme_file_uri( $js_dir_path . 'js/inspiry-search-form.js' ),
			array( 'jquery' ),
			INSPIRY_THEME_VERSION,
			true
		);

		// Theme's main script.
		wp_register_script(
			'custom',
			get_theme_file_uri( $js_dir_path . 'js/custom.js' ),
			array( 'jquery' ),
			INSPIRY_THEME_VERSION,
			true
		);

//      To-Do: Uncomment below code when Ajax Search is added to Ultra
//		wp_register_script(
//			'ajax-search',
//			get_theme_file_uri( $js_dir_path . 'js/ajax-search.js' ),
//			array( 'jquery' ),
//			INSPIRY_THEME_VERSION,
//			true
//		);

		if ( realhomes_display_schedule_a_tour() ) {
			wp_enqueue_script( 'jquery-ui-datepicker' );
		}

		/* Print select status for rent to switch prices in properties search form */
		$rent_slug               = get_option( 'theme_status_for_rent' );
		$localized_search_params = array();
		if ( ! empty( $rent_slug ) ) {
			$localized_search_params['rent_slug'] = $rent_slug;
		}

		// localize search parameters
		wp_localize_script( 'inspiry-search', 'localizedSearchParams', $localized_search_params );

		// Search form script
		wp_enqueue_script( 'inspiry-search' );

		wp_enqueue_script( 'jquery-form' );

		// Google reCaptcha
		if ( class_exists( 'Easy_Real_Estate' ) ) {
			if ( ere_is_reCAPTCHA_configured() ) {
				$inspiry_contact_form_shortcode = get_option( 'inspiry_contact_form_shortcode' );
				$reCPATCHA_type                 = get_option( 'inspiry_reCAPTCHA_type', 'v2' );

				if ( 'v3' === $reCPATCHA_type ) {
					$render = get_option( 'theme_recaptcha_public_key' );
				} else {
					$render = 'explicit';
				}

				$modern_recaptcha_src = esc_url_raw( add_query_arg( array(
					'render' => $render,
					'onload' => 'loadInspiryReCAPTCHA',
				), '//www.google.com/recaptcha/api.js' ) );

				if ( ! is_page_template( 'templates/contact.php' ) ) {
					// Enqueue google reCAPTCHA API.
					wp_enqueue_script(
						'inspiry-google-recaptcha',
						$modern_recaptcha_src,
						array(),
						INSPIRY_THEME_VERSION,
						true
					);
				} else if ( empty( $inspiry_contact_form_shortcode ) ) {
					// Enqueue google reCAPTCHA API.
					wp_enqueue_script(
						'inspiry-google-recaptcha',
						$modern_recaptcha_src,
						array(),
						INSPIRY_THEME_VERSION,
						true
					);
				} else {
					remove_action( 'wp_footer', 'ere_recaptcha_callback_generator' );
				}
			}
		}

		if ( is_singular( 'property' ) ) {

			wp_enqueue_script(
				'share-js',
				get_theme_file_uri( $js_dir_path . 'js/share.min.js' ),
				array( 'jquery' ),
				INSPIRY_THEME_VERSION,
				true
			);

			wp_enqueue_script(
				'property-share',
				get_theme_file_uri( $js_dir_path . 'js/property-share.js' ),
				array( 'jquery' ),
				INSPIRY_THEME_VERSION,
				true
			);


			if ( 'true' === get_option( 'realhomes_line_social_share', 'false' ) ) {
				$realhomes_line_social_share = "
					(function($) { 
					    'use strict';
						$(document).ready(function () {
							$(window).on('load', function () {
							    var shareThisDiv = $('.share-this');
							    shareThisDiv.addClass('realhomes-line-social-share-enabled');
								shareThisDiv.find('ul').append('<li class=\"entypo-line\" id=\"realhomes-line-social-share\"><i class=\"fab fa-line\"></i></li>');
							});
							$(document).on('click', '#realhomes-line-social-share', function () {
								window.open(
									'https://social-plugins.line.me/lineit/share?url=' + encodeURIComponent(window.location.href),
									'_blank',
									'location=yes,height=570,width=520,scrollbars=yes,status=yes'
								);
							});
						});
					})(jQuery);";
				wp_add_inline_script( 'property-share', $realhomes_line_social_share );
			}
		}

		if ( is_page_template( 'templates/contact.php' ) ) {
			$inspiry_contact_form_success_redirect_page = get_post_meta( get_the_ID(), 'inspiry_contact_form_success_redirect_page', true );
			if ( ! empty( $inspiry_contact_form_success_redirect_page ) ) {
				$contactFromData = array( 'redirectPageUrl' => get_the_permalink( $inspiry_contact_form_success_redirect_page ) );
				wp_localize_script( 'custom', 'contactFromData', $contactFromData );
			}
		}

		$mobile_nav_labels = array(
			'labelClose' => esc_html__( 'Close', 'framework' ),
			'labelBack'  => esc_html__( 'Back', 'framework' ),
		);
		wp_localize_script( 'custom', 'mobileNavLabels', $mobile_nav_labels );

		// Localizing data for ajax pagination
		$localized_ajax_search_array = array(
			'additionalFields' => realhomes_get_additional_fields( 'search' ),
			'mapService'       => get_option( 'ere_theme_map_type', 'openstreetmaps' ),
		);
		wp_localize_script( 'custom', 'localized', $localized_ajax_search_array );
		wp_enqueue_script( 'custom' );

		// To-Do: Uncomment below code when Ajax Search is added to Ultra
		// wp_localize_script( 'ajax-search', 'localized', $localized_ajax_search_array );
		// wp_enqueue_script( 'ajax-search' );

	}
}

if ( ! function_exists( 'inspiry_enqueue_common_styles' ) ) {

	/**
	 * Function to load common styles.
	 *
	 * @since  3.0.2
	 */
	function inspiry_enqueue_common_styles() {

		$common_dir_path = '/common/';

		// Google Fonts
		wp_enqueue_style(
			'inspiry-google-fonts',
			inspiry_google_fonts(),
			array(),
			INSPIRY_THEME_VERSION
		);

		// FontAwesome 5 Stylesheet
		wp_enqueue_style( 'font-awesome-5-all',
			get_theme_file_uri( $common_dir_path . 'font-awesome/css/all.min.css' ),
			array(),
			'5.13.1',
			'all' );

		if ( realhomes_get_rating_status() ) {
			wp_enqueue_style(
				'rh-font-awesome-stars',
				get_theme_file_uri( $common_dir_path . 'font-awesome/css/fontawesome-stars.css' ),
				array(),
				'1.0.0',
				'all'
			);
		}

		// Contains vendors styles.
		wp_enqueue_style(
			'vendors-css',
			get_theme_file_uri( 'common/optimize/vendors.css' ),
			array(),
			INSPIRY_THEME_VERSION,
			'all'
		);

		// parent theme custom css
		wp_enqueue_style(
			'parent-custom',
			get_theme_file_uri( 'assets/' . INSPIRY_DESIGN_VARIATION . '/styles/css/custom.css' ),
			array(),
			INSPIRY_THEME_VERSION,
			'all'
		);

		wp_add_inline_style( 'parent-custom', apply_filters( 'realhomes_common_custom_css', '' ) );
	}
}

if ( ! function_exists( 'inspiry_enqueue_common_scripts' ) ) {

	/**
	 * Function to load common scripts.
	 *
	 * @since  3.0.2
	 */
	function inspiry_enqueue_common_scripts() {

		$common_js_dir_path = '/common/js/';

		wp_enqueue_script( 'jquery-ui-tooltip' );

		// Enqueue BarRating JS.
		if ( realhomes_get_rating_status() ) {
			// jQuery Bar Rating.
			wp_enqueue_script(
				'rh-jquery-bar-rating',
				get_theme_file_uri( $common_js_dir_path . 'jquery.barrating.min.js' ),
				array( 'jquery' ),
				INSPIRY_THEME_VERSION,
				true
			);
		}


		/**
		 * Login Script
		 */
		if ( ! is_user_logged_in() ) {
			wp_enqueue_script(
				'inspiry-login',
				get_theme_file_uri( 'common/js/inspiry-login.js' ),
				array( 'jquery' ),
				INSPIRY_THEME_VERSION,
				true
			);
		}

		if ( inspiry_is_rvr_enabled() ) {
			// Availability Calendar
			wp_enqueue_script(
				'availability-calendar',
				get_theme_file_uri( $common_js_dir_path . 'availability-calendar.min.js' ),
				array( 'jquery' ),
				INSPIRY_THEME_VERSION,
				true
			);
		}

		/**
		 * Script for comments reply
		 */
		if ( is_singular( 'post' ) || is_page() || is_singular( 'property' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}


		if ( ( 'enable' === get_option( 'theme_compare_properties_module' ) && get_option( 'inspiry_compare_page' ) ) ) {
			wp_enqueue_script(
				'compare-js',
				get_theme_file_uri( $common_js_dir_path . 'compare-properties.js' ),
				array( 'jquery' ),
				INSPIRY_THEME_VERSION,
				true
			);
		}

		wp_enqueue_script(
			'vendors-js',
			get_theme_file_uri( 'common/optimize/vendors.js' ),
			array( 'jquery' ),
			INSPIRY_THEME_VERSION,
			true
		);

		// Initialize gumshoe plugin using inline script for sticky header hash navigation.
		if ( 'classic' !== INSPIRY_DESIGN_VARIATION && 'true' === get_option( 'inspiry_update_sticky_header_nav_links', 'false' ) ) {
			wp_add_inline_script( 'vendors-js', '(function () {"use strict";const scrollSpy = new Gumshoe("#menu-main-menu a",{navClass: "active-menu-item", offset: 85,});})();' );
		}

		// locations related script
		wp_register_script(
			'realhomes-locations',
			get_theme_file_uri( $common_js_dir_path . 'locations.js' ),
			array( 'jquery' ),
			INSPIRY_THEME_VERSION,
			true
		);

		// Common Custom.
		wp_register_script(
			'common-custom',
			get_theme_file_uri( $common_js_dir_path . 'common-custom.js' ),
			array( 'jquery' ),
			INSPIRY_THEME_VERSION,
			true
		);

		wp_register_script(
			'inspiry-cfos-js',
			get_theme_file_uri( $common_js_dir_path . 'cfos.js' ),
			array( 'jquery', 'vendors-js' ),
			INSPIRY_THEME_VERSION,
			true
		);

		$utils_path = array(
			'stylesheet_directory' => get_theme_file_uri( 'common/js/utils.js' ),
		);
		wp_localize_script( 'inspiry-cfos-js', 'inspiryUtilsPath', $utils_path );

		$select_string = array(
			'select_noResult'  => get_option( 'inspiry_select2_no_result_string', esc_html__( 'No Results Found!', 'framework' ) ),
			'ajax_url'         => admin_url( 'admin-ajax.php' ),
			'page_template'    => get_page_template_slug(),
			'searching_string' => esc_html__( 'Searching...', 'framework' ),
			'loadingMore'      => esc_html__( 'Loading more results...', 'framework' ),
		);
		wp_localize_script( 'common-custom', 'localizeSelect', $select_string );

		if ( is_singular( 'property' ) ) {

			$inspiry_agent_form_success_redirect_page = get_option( 'inspiry_agent_form_success_redirect_page' );
			if ( ! empty( $inspiry_agent_form_success_redirect_page ) ) {
				$agentData = array( 'redirectPageUrl' => get_the_permalink( $inspiry_agent_form_success_redirect_page ) );
				wp_localize_script( 'common-custom', 'agentData', $agentData );
			}

			if ( 'enable' === get_option( 'inspiry_similar_properties_frontend_filters', 'disable' ) ) {

				$properties_per_page = get_option( 'theme_number_of_similar_properties' );
				if ( is_page_template( 'templates/property-full-width-layout.php' ) ) {
					$properties_per_page = 3;
				}

				$similarPropertiesData = array(
					'design'            => INSPIRY_DESIGN_VARIATION,
					'propertyId'        => get_the_ID(),
					'propertiesPerPage' => $properties_per_page,

				);

				wp_localize_script( 'common-custom', 'similarPropertiesData', $similarPropertiesData );
			}
		}

		wp_enqueue_script( 'realhomes-locations' );
		wp_enqueue_script( 'common-custom' );
		wp_enqueue_script( 'inspiry-cfos-js' );
	}
}

/**
 * Dynamic CSS
 */
if ( file_exists( INSPIRY_THEME_DIR . '/styles/css/dynamic-css.php' ) ) {
	include_once( INSPIRY_THEME_DIR . '/styles/css/dynamic-css.php' );
}

/**
 * Common Dynamic CSS
 */
if ( file_exists( INSPIRY_COMMON_DIR . '/css/dynamic-css.php' ) ) {
	include_once( INSPIRY_COMMON_DIR . '/css/dynamic-css.php' );
}

if ( ! function_exists( 'realhomes_css_vars' ) ) {
	/**
	 * Provides RealHomes design variations css variables.
	 *
	 * @since 3.14.0
	 *
	 * @param $custom_css
	 *
	 * @return string
	 */
	function realhomes_css_vars( $custom_css ) {

		$output = '';

		if ( 'default' !== get_option( 'realhomes_color_scheme', 'default' ) ) {
			// Modern variation color settings.
			$rh_global_color_primary   = get_option( 'theme_core_mod_color_green' );
			$rh_global_color_secondary = get_option( 'theme_core_mod_color_orange' );

			$core_colors = array(
				// Primary colors.
				'primary'         => $rh_global_color_primary,
				'primary-rgb'     => inspiry_hex_to_rgba( $rh_global_color_primary, false, true ),
				'primary-light'   => get_option( 'realhomes_color_primary_light' ),
				'primary-dark'    => get_option( 'theme_core_mod_color_green_dark' ),

				// Secondary colors.
				'secondary'       => $rh_global_color_secondary,
				'secondary-rgb'   => inspiry_hex_to_rgba( $rh_global_color_secondary, false, true ),
				'secondary-light' => get_option( 'realhomes_color_secondary_light' ),
				'secondary-dark'  => get_option( 'theme_core_mod_color_orange_dark' ),

				// Body, headings and links colors
				'text'            => get_option( 'inspiry_body_font_color' ),
				'headings'        => get_option( 'inspiry_heading_font_color' ),
				'headings-hover'  => get_option( 'realhomes_global_headings_hover_color' ),
				'link'            => get_option( 'realhomes_global_link_color' ),
				'link-hover'      => get_option( 'realhomes_global_link_hover_color' ),
			);

			if ( ! empty( $core_colors ) && is_array( $core_colors ) ) {
				foreach ( $core_colors as $key => $value ) {
					if ( ! empty( $value ) ) {
						$output .= sprintf( '--rh-global-color-%s: %s;', esc_html( $key ), esc_html( $value ) );
					}
				}
			}

			if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {
				// Mortgage calculator graph colors
				$output .= sprintf( '--rh-mc-cost-tax-color: %s;', inspiry_hex_darken( $rh_global_color_secondary, 5 ) );
				$output .= sprintf( '--rh-mc-cost-hoa-color: %s;', $rh_global_color_primary );
				$output .= sprintf( '--rh-mc-graph-item-opacity: %s;', '0.4' );
			}
		}

		// CSS variables to hold round corners values for modern or ultra design variation.
		if ( 'ultra' === INSPIRY_DESIGN_VARIATION && ( 'enable' === get_option( 'realhomes_round_corners', 'disable' ) ) ) {
			$border_radius_settings = realhomes_ultra_border_radius_settings();
			if ( ! empty( $border_radius_settings ) ) {
				foreach ( $border_radius_settings as $settings_group ) {
					if ( ! empty( $settings_group['values'] ) ) {
						$group_id = $settings_group['id'];
						foreach ( $settings_group['values'] as $setting_id => $setting_value ) {
							$id      = sprintf( 'realhomes_%s_round_corner_%s', $group_id, $setting_id );
							$css_var = sprintf( '--rh-round-corner-%s-%s', $group_id, $setting_id );
							$css_var = str_replace( '_', '-', $css_var );
							$output  .= sprintf( '%s: %spx;', $css_var, get_option( $id, $setting_value['value'] ) );
						}
					}
				}
			}

		} else if ( 'modern' === INSPIRY_DESIGN_VARIATION && ( 'enable' === get_option( 'realhomes_round_corners', 'disable' ) ) ) {
			$output .= sprintf( '--rh-small-border-radius: %spx;', get_option( 'realhomes_round_corners_small', '4' ) );
			$output .= sprintf( '--rh-medium-border-radius: %spx;', get_option( 'realhomes_round_corners_medium', '8' ) );
			$output .= sprintf( '--rh-large-border-radius: %spx;', get_option( 'realhomes_round_corners_large', '12' ) );

		} else if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			// CSS variables for classic design variation.
			$output .= sprintf( '--realhomes-core-color-orange-light: %s;', get_option( 'theme_core_color_orange_light', '#ec894d' ) );
			$output .= sprintf( '--realhomes-core-color-orange-dark: %s;', get_option( 'theme_core_color_orange_dark', '#dc7d44' ) );
			$output .= sprintf( '--realhomes-core-color-orange-glow: %s;', get_option( 'theme_core_color_orange_glow', '#e3712c' ) );
			$output .= sprintf( '--realhomes-core-color-orange-burnt: %s;', get_option( 'theme_core_color_orange_burnt', '#df5400' ) );
			$output .= sprintf( '--realhomes-core-color-blue-light: %s;', get_option( 'theme_core_color_blue_light', '#4dc7ec' ) );
			$output .= sprintf( '--realhomes-core-color-blue-dark: %s;', get_option( 'theme_core_color_blue_dark', '#37b3d9' ) );
		}

		$custom_css .= sprintf( ":root{%s}", $output );

		return $custom_css;
	}

	add_filter( 'realhomes_common_custom_css', 'realhomes_css_vars' );
}

if ( ! function_exists( 'realhomes_buttons_transition_style' ) ) {
	/**
	 * Adds the buttons transition style.
	 *
	 * @since 3.17.0
	 *
	 * @param $custom_css
	 *
	 * @return string
	 */
	function realhomes_buttons_transition_style( $custom_css ) {

		if ( 'modern' !== INSPIRY_DESIGN_VARIATION ) {
			return $custom_css;
		}

		$buttons_transition_style = get_option( 'inspiry_buttons_transition_style', 'default' );
		if ( 'default' === $buttons_transition_style ) {
			return $custom_css;
		}

		$output = '';

		// Common css that all buttons will share is written in this block. Then every block has its own specific styles under its condition block.
		if ( in_array( $buttons_transition_style, array( 'style_1', 'style_2', 'style_3', 'style_4', 'style_5' ) ) ) {
			$output = "
.rh-btn-primary,
.rh-btn-secondary,
.rhea-btn-primary,
.rhea-btn-secondary {
  position: relative;
  z-index: 1;
  overflow: hidden;
}
.rh-btn-primary:before,
.rh-btn-secondary:before,
.rhea-btn-primary:before,
.rhea-btn-secondary:before {
  display: block;
  content: '';
  position: absolute;
  z-index: -1;
  transition: all 0.3s ease-in-out;
}
.rh-btn-primary:hover:before,
.rh-btn-secondary:hover:before,
.rhea-btn-primary:hover:before,
.rhea-btn-secondary:hover:before {
  transition: all 0.3s ease-in-out;
}
.rh-btn-primary,
.rh-btn-primary:hover,
.rhea-btn-primary,
.rhea-btn-primary:hover {
  background: var(--rh-global-color-primary);
  color: #fff;
}
.rh-btn-primary:before, 
.rhea-btn-primary:before{
  background: var(--rh-global-color-primary-dark, rgba(0, 0, 0, .2));
}
.rh-btn-secondary,
.rh-btn-secondary:hover,
.rhea-btn-secondary,
.rhea-btn-secondary:hover {
  background: var(--rh-global-color-secondary);
  color: #fff;
}
.rh-btn-secondary:before,
.rhea-btn-secondary:before {
  background: var(--rh-global-color-secondary-dark, rgba(0, 0, 0, .2));
}
";

			// Customizer options related to button custom styles.
			$button_text_color = get_option( 'theme_button_text_color' );
			$button_text_hover = get_option( 'theme_button_hover_text_color' );
			$button_bg_color   = get_option( 'theme_button_bg_color' );
			$button_bg_hover   = get_option( 'theme_button_hover_bg_color' );

			if ( ! empty( $button_text_color ) ) {
				$output .= "
.rh-btn-primary,
.rhea-btn-primary {
  color: $button_text_color;
}
	            ";
			}

			if ( ! empty( $button_text_hover ) ) {
				$output .= "
.rh-btn-primary:hover,
.rhea-btn-primary:hover {
  color: $button_text_hover;
}
	            ";
			}

			if ( ! empty( $button_bg_color ) ) {
				$output .= "
.rh-btn-primary,
.rh-btn-primary:hover,
.rhea-btn-primary,
.rhea-btn-primary:hover {
  background: $button_bg_color;
}
	            ";
			}

			if ( ! empty( $button_bg_hover ) ) {
				$output .= "
.rh-btn-primary:before, 
.rhea-btn-primary:before{
  background: $button_bg_hover;
}
	            ";
			}

			if ( 'style_1' === $buttons_transition_style ) {
				$output .= "
.rh-btn-primary:before,
.rh-btn-secondary:before,
.rhea-btn-primary:before,
.rhea-btn-secondary:before {
  top: 0;
  right: 0;
  width: 0;
  height: 100%;
}
.rh-btn-primary:hover:before,
.rh-btn-secondary:hover:before,
.rhea-btn-primary:hover:before,
.rhea-btn-secondary:hover:before {
  right: auto;
  left: 0;
  width: 100%;
}
";
			} else if ( 'style_2' === $buttons_transition_style ) {
				$output .= "
.rh-btn-primary:before,
.rh-btn-secondary:before,
.rhea-btn-primary:before,
.rhea-btn-secondary:before {
  top: 0;
  left: 0;
  width: 0;
  height: 100%;
}
.rh-btn-primary:hover:before,
.rh-btn-secondary:hover:before,
.rhea-btn-primary:hover:before,
.rhea-btn-secondary:hover:before {
  left: auto;
  right: 0;
  width: 100%;
}
";
			} else if ( 'style_3' === $buttons_transition_style ) {
				$output .= "
.rh-btn-primary:before,
.rh-btn-secondary:before,
.rhea-btn-primary:before,
.rhea-btn-secondary:before {
  top: 0;
  left: 0;
  width: 100%;
  height: 0;
}
.rh-btn-primary:hover:before,
.rh-btn-secondary:hover:before,
.rhea-btn-primary:hover:before,
.rhea-btn-secondary:hover:before {
  top: auto;
  bottom: 0;
  height: 100%;
}
";
			} else if ( 'style_4' === $buttons_transition_style ) {
				$output .= "
.rh-btn-primary:before,
.rh-btn-secondary:before,
.rhea-btn-primary:before,
.rhea-btn-secondary:before {
  bottom: 0;
  left: 0;
  width: 100%;
  height: 0;
}

.rh-btn-primary:hover:before,
.rh-btn-secondary:hover:before,
.rhea-btn-primary:hover:before,
.rhea-btn-secondary:hover:before {
  top: 0;
  bottom: auto;
  height: 100%;
}
";
			} else if ( 'style_5' === $buttons_transition_style ) {
				$output .= "
.rh-btn-primary:before,
.rh-btn-secondary:before,
.rhea-btn-primary:before,
.rhea-btn-secondary:before {
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  width: 0;
  height: 0;
  margin: auto;
}
.rh-btn-primary:hover:before,
.rh-btn-secondary:hover:before,
.rhea-btn-primary:hover:before,
.rhea-btn-secondary:hover:before {
  width: 100%;
  height: 100%;
}
";
			}
		}

		$custom_css .= sprintf( "%s", $output );

		return $custom_css;
	}

	add_filter( 'realhomes_common_custom_css', 'realhomes_buttons_transition_style' );
}

if ( ! function_exists( 'realhomes_typography' ) ) {
	/**
	 * Adds custom typography styles for all variations in the theme.
	 *
	 * @since 4.0.0
	 *
	 * @param $custom_css
	 *
	 * @return string
	 */
	function realhomes_typography( $custom_css ) {

		$output       = '';
		$font_formats = array(
			'family' => "font-family: %s;\n",
			'weight' => "font-weight: %s;\n",
			'group'  => "\n%s{\n%s}",
		);

		// Default font selectors
		$base_font_selectors      = array( 'body' );
		$heading_font_selectors   = array( 'h1, h2, h3, h4, h5, h6' );
		$secondary_font_selectors = array();

		// Variations based font selectors
		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$base_font_selectors[] = '
             .rh_theme_card__priceLabel_sty span.rh_theme_card__status_sty, 
			 .rh_theme_card__priceLabel_sty .rh_theme_card__price_sty, 
			 .rh_my-property .rh_my-property__btns .stripe-button-el span
			 ';

			$secondary_font_selectors[] = '
			.rh_prop_stylish_card__excerpt p, 
			.rh_prop_stylish_card__excerpt .rh_agent_form .rh_agent_form__row,
			.rh_agent_form .rh_prop_stylish_card__excerpt .rh_agent_form__row
			';

		} else if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$heading_font_selectors[] = '
            .inner-wrapper .hentry p.info,
            .inner-wrapper .hentry p.tip,
            .inner-wrapper .hentry p.success,
            .inner-wrapper .hentry p.error,
            .main-menu ul li a,
            .inspiry-social-login .wp-social-login-connect-with,
            #overview .share-label,
            #overview .common-label,
            #overview .video-label,
            #overview .attachments-label,
            #overview .map-label,
            #overview .floor-plans .floor-plans-label,
            #dsidx-listings .dsidx-address a,
            #dsidx-listings .dsidx-price,
            #dsidx-listings .dsidx-listing-container .dsidx-listing .dsidx-primary-data .dsidx-address a,
            body .rh_prop_card__details_elementor h3 a,
            body .rh_section__agents_elementor .rh_agent_elementor .rh_agent__details h3 a,
            body .classic_properties_elementor_wrapper .rhea_property_title a
            ';

			$secondary_font_selectors[] = '
            .real-btn, .btn-blue, .btn-grey, input[type="submit"], .sidebar .widget .dsidx-widget .submit,
            input[type="number"], input[type="date"], input[type="tel"], input[type="url"], input[type="email"], input[type="text"], input[type="password"], textarea,
            .selectwrap,
            .more-details,
            .slide-description span, .slide-description .know-more,
            .advance-search,
            .select2-container .select2-selection,
            .property-item h4, .property-item h4 a,
            .property-item .property-meta,
            .es-carousel-wrapper ul li h4, .es-carousel-wrapper ul li .property-item h4 a, .property-item h4 .es-carousel-wrapper ul li a, .es-carousel-wrapper ul li h4 a, .property-item h4 .es-carousel-wrapper ul li a a,
            .es-carousel-wrapper ul li .price,
            #footer .widget, #footer .widget .title,
            #footer-bottom,
            .widget, .widget .title, .widget ul li, .widget .enquiry-form .agent-form-title,
            #footer .widget ul.featured-properties li h4,
            #footer .widget ul.featured-properties li .property-item h4 a,
            .property-item h4 #footer .widget ul.featured-properties li a,
            #footer .widget ul.featured-properties li h4 a,
            .property-item h4 #footer .widget ul.featured-properties li a a,
            ul.featured-properties li h4,
            ul.featured-properties li .property-item h4 a,
            .property-item h4 ul.featured-properties li a,
            ul.featured-properties li h4 a,
            ul.featured-properties li .property-item h4 a a,
            .property-item h4 ul.featured-properties li a a,
            .page-head .page-title, .post-title, .post-title a,
            .post-meta, #comments-title, #contact-form #reply-title, #respond #reply-title, .form-heading, #contact-form, #respond,
            .contact-page, #overview, #overview .property-item .price,
            #overview .child-properties h3,
            #overview .agent-detail h3,
            .infoBox .prop-title a,
            .infoBox span.price,
            .detail .list-container h3,
            .about-agent .contact-types,
            .listing-layout h4, .listing-layout .property-item h4 a, .property-item h4 .listing-layout a,
            #filter-by,
            .gallery-item .item-title,
            .dsidx-results li.dsidx-prop-summary .dsidx-prop-title,
            #dsidx.dsidx-details #dsidx-actions,
            #dsidx.dsidx-details .dsidx-contact-form table label, #dsidx.dsidx-details .dsidx-contact-form table input[type=button],
            #dsidx-header table#dsidx-primary-data th, #dsidx-header table#dsidx-primary-data td
            .sidebar .widget .dsidx-slideshow .featured-listing h4, .sidebar .widget .dsidx-slideshow .featured-listing .property-item h4 a, .property-item h4 .sidebar .widget .dsidx-slideshow .featured-listing a,
            .sidebar .widget .dsidx-expanded .featured-listing h4, .sidebar .widget .dsidx-expanded .featured-listing .property-item h4 a, .property-item h4 .sidebar .widget .dsidx-expanded .featured-listing a,
            .sidebar .widget .dsidx-search-widget span.select-wrapper,
            .sidebar .widget .dsidx-search-widget .dsidx-search-button .submit,
            .sidebar .widget .dsidx-widget-single-listing h3.widget-title,
            .login-register .main-wrap h3,
            .login-register .info-text, .login-register input[type="text"], .login-register input[type="password"], .login-register label,
            .inspiry-social-login .wp-social-login-provider,
            .my-properties .main-wrap h3,
            .my-properties .alert-wrapper h5,
            .my-property .cell h5 
			';
		}

		// Base font and font-weight styles.
		$base_font        = get_option( 'inspiry_body_font', 'Default' );
		$base_font_weight = get_option( 'inspiry_body_font_weight', 'Default' );
		if ( ! empty( $base_font_selectors ) && ( 'Default' !== $base_font || 'Default' !== $base_font_weight ) ) {
			$font_properties = '';

			// Font-family styles
			if ( 'Default' !== $base_font ) {
				$font_properties .= sprintf( $font_formats['family'], Inspiry_Google_Fonts::get_font_family( $base_font ) );
			}

			// Font-weight styles
			if ( 'Default' !== $base_font_weight ) {
				$font_properties .= sprintf( $font_formats['weight'], $base_font_weight );
			}

			$output .= sprintf( $font_formats['group'], implode( ",", $base_font_selectors ), $font_properties );
		}

		// Headings font and font-weight styles.
		$headings_font        = get_option( 'inspiry_heading_font', 'Default' );
		$headings_font_weight = get_option( 'inspiry_heading_font_weight', 'Default' );
		if ( ! empty( $heading_font_selectors ) && ( 'Default' !== $headings_font || 'Default' !== $headings_font_weight ) ) {
			$font_properties = '';

			// Font-family styles
			if ( 'Default' !== $headings_font ) {
				$font_properties .= sprintf( $font_formats['family'], Inspiry_Google_Fonts::get_font_family( $headings_font ) );
			}

			// Font-weight styles
			if ( 'Default' !== $headings_font_weight ) {
				$font_properties .= sprintf( $font_formats['weight'], $headings_font_weight );
			}

			$output .= sprintf( $font_formats['group'], implode( ",", $heading_font_selectors ), $font_properties );
		}

		// Secondary font and font-weight styles.
		$secondary_font        = get_option( 'inspiry_secondary_font', 'Default' );
		$secondary_font_weight = get_option( 'inspiry_secondary_font_weight', 'Default' );
		if ( ! empty( $secondary_font_selectors ) && ( 'Default' !== $secondary_font || 'Default' !== $secondary_font_weight ) ) {
			$font_properties = '';

			// Font-family styles
			if ( 'Default' !== $secondary_font ) {
				$font_properties .= sprintf( $font_formats['family'], Inspiry_Google_Fonts::get_font_family( $secondary_font ) );
			}

			// Font-weight styles
			if ( 'Default' !== $secondary_font_weight ) {
				$font_properties .= sprintf( $font_formats['weight'], $secondary_font_weight );
			}

			$output .= sprintf( $font_formats['group'], implode( ",", $secondary_font_selectors ), $font_properties );
		}

		// Concatenate font and font-weight styles with custom css.
		$custom_css .= $output;

		return $custom_css;
	}

	add_filter( 'realhomes_common_custom_css', 'realhomes_typography' );
}
