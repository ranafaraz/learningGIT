<?php
/**
 * Dynamic CSS File
 *
 * Dynamic css for handling customizer style settings.
 *
 * @since   4.0.0
 *
 * @package realhomes/ultra
 */
if ( ! function_exists( 'realhomes_generate_dynamic_css' ) ) {
	/**
	 * Generate custom CSS.
	 *
	 * @since  4.0.0
	 *
	 * @param $custom_css
	 *
	 * @return string
	 */
	function realhomes_generate_dynamic_css( $custom_css ) {

		// Logo print filters
		$logo_print_filter = get_option( 'inspiry_logo_filter_for_print', 'none' );
		if ( 'none' !== $logo_print_filter ) {
			$custom_css .= '@media print { .rh-ultra-logo img {';
			$custom_css .= '-webkit-filter: ' . esc_html( $logo_print_filter ) . '(100%);';
			$custom_css .= 'filter: ' . esc_html( $logo_print_filter ) . '(100%); }}';
		}

		// Add Footer background image opacity settings
		$opacity_valid_values     = range( 1, 100 );
		$footer_bg_opacity_mobile = (int)get_option( 'realhomes_site_footer_bg_opacity_mobile' );
		if ( ! empty( $footer_bg_opacity_mobile ) ) {
			if ( in_array( $footer_bg_opacity_mobile, $opacity_valid_values ) ) {
				$custom_css .= '.site-footer-bg{ opacity:' . esc_html( $footer_bg_opacity_mobile / 100 ) . '}';
			}
		}

		$footer_bg_opacity = (int)get_option( 'realhomes_site_footer_bg_opacity' );
		if ( ! empty( $footer_bg_opacity ) ) {
			if ( in_array( $footer_bg_opacity, $opacity_valid_values ) ) {
				$custom_css .= '@media (min-width: 1024px) {.site-footer-bg{opacity: ' . esc_html( $footer_bg_opacity / 100 ) . ';}}';
			}
		}

		/** Skip the below css if custom colorscheme option is not selected. */
		if ( 'custom' !== get_option( 'realhomes_color_scheme', 'default' ) ) {
			return $custom_css;
		}

		$output_css = array();

		// Selection background color
		$selection_bg_color = get_option( 'realhomes_selection_bg_color' );

		$output_css[] = array(
			'elements' => '::selection',
			'property' => 'background-color',
			'value'    => $selection_bg_color,
		);
		$output_css[] = array(
			'elements' => '::-moz-selection',
			'property' => 'background-color',
			'value'    => $selection_bg_color,
		);

		// Header
		$menu_text_color       = get_option( 'theme_menu_text_color' );
		$menu_hover_text_color = get_option( 'theme_menu_hover_text_color' );

		$output_css[] = array(
			'elements' => '.rh-ultra-header-wrapper, .rh-responsive-header',
			'property' => 'background-color',
			'value'    => get_option( 'theme_header_bg_color' ),
		);
		$output_css[] = array(
			'elements' => '.rh-ultra-logo a, .rh-responsive-header .rh-logo-wrapper a',
			'property' => 'color',
			'value'    => get_option( 'theme_logo_text_color' ),
		);
		$output_css[] = array(
			'elements' => '.rh-ultra-logo a:hover, .rh-responsive-header .rh-logo-wrapper a:hover',
			'property' => 'color',
			'value'    => get_option( 'theme_logo_text_hover_color' ),
		);
		$output_css[] = array(
			'elements' => '.rh-ultra-main-menu li a',
			'property' => 'color',
			'value'    => get_option( 'theme_main_menu_text_color' ),
		);
		$output_css[] = array(
			'elements' => '.rh-ultra-main-menu li:hover > a, 
			.rh-ultra-main-menu li.current_page_item > a,
			.rh-ultra-main-menu li.current-menu-ancestor > a',
			'property' => 'color',
			'value'    => get_option( 'theme_main_menu_text_hover_color' ),
		);
		$output_css[] = array(
			'elements' => '.rh-ultra-main-menu li:hover > a,
			.rh-ultra-main-menu li ul li:hover > a,
			.rh-ultra-main-menu li.current_page_item > a,
			.rh-ultra-main-menu li.current-menu-ancestor > a',
			'property' => 'background-color',
			'value'    => get_option( 'inspiry_main_menu_hover_bg' ),
		);
		$output_css[] = array(
			'elements' => '.rh-ultra-main-menu li ul,
			.rh-ultra-menu-user-profile .rh-ultra-modal',
			'property' => 'background-color',
			'value'    => get_option( 'theme_menu_bg_color' ),
		);
		$output_css[] = array(
			'elements' => '.rh-ultra-main-menu li ul li a,
			.rh-ultra-menu-user-profile .rh_user p,
			.rh-ultra-menu-user-profile .rh_user h3,
			.rh-ultra-menu-user-profile .rh_modal__dashboard > a',
			'property' => 'color',
			'value'    => $menu_text_color,
		);
		$output_css[] = array(
			'elements' => '.rh-ultra-menu-user-profile .rh_modal__dashboard > a svg',
			'property' => 'fill',
			'value'    => $menu_text_color,
		);
		$output_css[] = array(
			'elements' => '.rh-ultra-main-menu li ul li:hover a,
			.rh-ultra-menu-user-profile .rh_modal__dashboard > a:hover',
			'property' => 'color',
			'value'    => $menu_hover_text_color,
		);
		$output_css[] = array(
			'elements' => '.rh-ultra-menu-user-profile .rh_modal__dashboard > a:hover svg',
			'property' => 'fill',
			'value'    => $menu_hover_text_color,
		);
		$output_css[] = array(
			'elements' => '.rh-ultra-main-menu li ul li:hover a,
			.rh-ultra-menu-user-profile .rh_modal__dashboard > a:hover',
			'property' => 'background-color',
			'value'    => get_option( 'theme_menu_hover_bg_color' ),
		);
		$output_css[] = array(
			'elements' => '.rh-ultra-header-social-list a',
			'property' => 'color',
			'value'    => get_option( 'theme_header_social_icon_color' ),
		);
		$output_css[] = array(
			'elements' => '.rh-ultra-header-social-list a:hover',
			'property' => 'background-color',
			'value'    => get_option( 'theme_header_social_icon_color_hover' ),
		);
		$output_css[] = array(
			'elements' => '.rh-ultra-social-contacts > div:not(:last-of-type, .rh-ultra-menu-user-profile):after',
			'property' => 'background-color',
			'value'    => get_option( 'realhomes_user_menu_separator' ),
		);
		$output_css[] = array(
			'elements' => '.rh-ultra-user-phone a',
			'property' => 'color',
			'value'    => get_option( 'theme_phone_text_color' ),
		);
		$output_css[] = array(
			'elements' => '.rh-ultra-user-phone a:hover',
			'property' => 'color',
			'value'    => get_option( 'theme_phone_text_color_hover' ),
		);
		$output_css[] = array(
			'elements' => '.rh-ultra-submit a',
			'property' => 'border-color',
			'value'    => get_option( 'theme_responsive_submit_button_bg' ),
		);
		$output_css[] = array(
			'elements' => '.rh-ultra-submit a',
			'property' => 'color',
			'value'    => get_option( 'theme_responsive_submit_button_color' ),
		);
		$output_css[] = array(
			'elements' => '.rh-ultra-submit a:hover',
			'property' => 'background-color',
			'value'    => get_option( 'theme_responsive_submit_button_bg_hover' ),
		);
		$output_css[] = array(
			'elements' => '.rh-ultra-submit a:hover',
			'property' => 'border-color',
			'value'    => get_option( 'theme_responsive_submit_button_bg_hover' ),
		);
		$output_css[] = array(
			'elements' => '.rh-ultra-submit a:hover',
			'property' => 'color',
			'value'    => get_option( 'theme_responsive_submit_button_color_hover' ),
		);

		// Responsive Header
		$output_css[] = array(
			'elements' => '.rh-responsive-header .hc-nav-trigger span,
			.rh-responsive-header .hc-nav-trigger span::after,
			.rh-responsive-header .hc-nav-trigger span::before',
			'property' => 'background-color',
			'value'    => get_option( 'theme_responsive_menu_icon_color' ),
		);
		$output_css[] = array(
			'elements' => 'body .hc-offcanvas-nav .nav-container,
			body .hc-offcanvas-nav .nav-wrapper,
			body .hc-offcanvas-nav ul',
			'property' => 'background-color',
			'value'    => get_option( 'theme_responsive_menu_bg_color' ),
		);
		$output_css[] = array(
			'elements' => 'body .hc-offcanvas-nav .nav-container,
			body .hc-offcanvas-nav .nav-wrapper,
			body .hc-offcanvas-nav ul',
			'property' => 'background-color',
			'value'    => get_option( 'theme_responsive_menu_bg_color' ),
		);
		$output_css[] = array(
			'elements' => 'body .hc-offcanvas-nav .nav-back a, 
			body .hc-offcanvas-nav .nav-content>.nav-close:first-child a, 
			body .hc-offcanvas-nav .nav-title+.nav-close a.has-label, 
			body .hc-offcanvas-nav li.nav-close a',
			'property' => array( 'background-color', 'border-top-color', 'border-bottom-color' ),
			'value'    => get_option( 'realhomes_responsive_menu_container_bg_color' ),
		);
		$output_css[] = array(
			'elements' => 'body .hc-offcanvas-nav .nav-back a:hover, 
			body .hc-offcanvas-nav .nav-content>.nav-close:first-child a:hover,
			body .hc-offcanvas-nav .nav-title+.nav-close a.has-label:hover, 
			body .hc-offcanvas-nav li.nav-close a:hover,
			body .hc-offcanvas-nav:not(.touch-device) li:not(.nav-item-custom) a:not([disabled]):hover',
			'property' => array( 'background-color' ),
			'value'    => get_option( 'realhomes_responsive_menu_item_hover_bg_color' ),
		);
		$output_css[] = array(
			'elements' => 'body .hc-offcanvas-nav .nav-wrapper>.nav-content>ul:first-of-type>li:first-child:not(.nav-back):not(.nav-close)>.nav-item-wrapper>.nav-item-link',
			'property' => 'border-top-color',
			'value'    => get_option( 'realhomes_responsive_menu_item_border_color' ),
		);
		$output_css[] = array(
			'elements' => 'body .hc-offcanvas-nav .nav-back a, 
			body .hc-offcanvas-nav .nav-item-link, 
			body .hc-offcanvas-nav li.nav-close a',
			'property' => 'border-bottom-color',
			'value'    => get_option( 'realhomes_responsive_menu_item_border_color' ),
		);
		$output_css[] = array(
			'elements' => 'body .hc-offcanvas-nav a.nav-next',
			'property' => array( 'border-left-color', 'border-bottom-color' ),
			'value'    => get_option( 'realhomes_responsive_menu_item_border_color' ),
		);
		$output_css[] = array(
			'elements' => 'body .hc-offcanvas-nav .nav-back a,
			 body .hc-offcanvas-nav .nav-item-link,
			 body .hc-offcanvas-nav li.nav-close a,
			 body .hc-offcanvas-nav .nav-content>.nav-close a,
			 body .hc-offcanvas-nav .nav-content > h2',
			'property' => 'color',
			'value'    => get_option( 'theme_responsive_menu_text_color' ),
		);
		$output_css[] = array(
			'elements' => 'body .hc-offcanvas-nav .nav-close-button span::after, 
			body .hc-offcanvas-nav .nav-close-button span::before,
			body .hc-offcanvas-nav .nav-back span::before,
			body .hc-offcanvas-nav .nav-next span::before',
			'property' => 'border-color',
			'value'    => get_option( 'theme_responsive_menu_text_color' ),
		);
		$output_css[] = array(
			'elements' => 'body .hc-offcanvas-nav .nav-back a:hover,
			 body .hc-offcanvas-nav .nav-item-link:hover,
			 body .hc-offcanvas-nav li.nav-close a:hover',
			'property' => 'color',
			'value'    => get_option( 'theme_responsive_menu_text_hover_color' ),
		);
		$output_css[] = array(
			'elements' => 'div.rh-ultra-tooltip, div.rh-ultra-tooltip .arrow::after',
			'property' => 'background',
			'value'    => get_option( 'realhomes_ultra_tooltip_bgcolor', '#000' ) . ' !important',
		);
		$output_css[] = array(
			'elements' => 'div.rh-ultra-tooltip, div.rh-ultra-tooltip .arrow::after',
			'property' => 'color',
			'value'    => get_option( 'realhomes_ultra_tooltip_color', '#fff' ) . ' !important',
		);

		// Sticky Header
		$output_css[] = array(
			'elements' => '.rh-sticky-header.sticked',
			'property' => 'background-color',
			'value'    => get_option( 'theme_modern_sticky_header_bg_color' ),
		);

		// Buttons
		$button_hover_text_color = get_option( 'theme_button_hover_text_color' );
		$button_bg_color         = get_option( 'theme_button_bg_color' );
		$button_hover_bg_color   = get_option( 'theme_button_hover_bg_color' );

		// Button primary
		$button_selectors       = '.rh-btn-primary, .pages-navigation a, .rh-form button, .rh-form input[type=submit], .post-password-form button, .post-password-form input[type=submit], .wpcf7-form button, .wpcf7-form input[type=submit], .wpforms-form button, .wpforms-form input[type=submit], button, .rh-filled-button, .rh-ultra-filled-button';
		$button_hover_selectors = '.rh-btn-primary:hover, .pages-navigation a:hover, .rh-form button:hover, .rh-form input[type=submit]:hover, .post-password-form button:hover, .post-password-form input[type=submit]:hover, .wpcf7-form button:hover, .wpcf7-form input[type=submit]:hover, .wpforms-form button:hover, .wpforms-form input[type=submit]:hover, button:hover, .rh-filled-button:hover, .rh-ultra-filled-button:hover';

		$output_css[] = array(
			'elements' => $button_selectors,
			'property' => 'background-color',
			'value'    => $button_bg_color,
		);
		$output_css[] = array(
			'elements' => $button_selectors,
			'property' => 'border-color',
			'value'    => $button_bg_color,
		);
		$output_css[] = array(
			'elements' => $button_selectors,
			'property' => 'color',
			'value'    => get_option( 'theme_button_text_color' ),
		);
		$output_css[] = array(
			'elements' => $button_hover_selectors,
			'property' => 'color',
			'value'    => $button_hover_text_color,
		);

		// Button outline primary
		$outline_button_selectors       = '.rh-btn-outline-primary, .rh-hollow-button,.rh-ultra-hollow-button';
		$outline_button_hover_selectors = '.rh-btn-outline-primary:hover, .rh-hollow-button:hover,.rh-ultra-hollow-button:hover';

		$output_css[] = array(
			'elements' => $outline_button_selectors,
			'property' => 'background-color',
			'value'    => 'transparent',
		);
		$output_css[] = array(
			'elements' => $outline_button_selectors,
			'property' => 'border-color',
			'value'    => $button_hover_bg_color,
		);
		$output_css[] = array(
			'elements' => $outline_button_selectors,
			'property' => 'color',
			'value'    => $button_hover_text_color,
		);
		$output_css[] = array(
			'elements' => $outline_button_hover_selectors,
			'property' => 'background-color',
			'value'    => $button_hover_bg_color,
		);
		$output_css[] = array(
			'elements' => $outline_button_hover_selectors,
			'property' => 'color',
			'value'    => $button_hover_text_color,
		);

		// Gallery
		$output_css[] = array(
			'elements' => '.property-gallery-item-media-container:before',
			'property' => 'background-color',
			'value'    => get_option( 'inspiry_gallery_hover_color' ),
		);
		$output_css[] = array(
			'elements' => '.property-gallery-item-media-container a svg',
			'property' => 'fill',
			'value'    => get_option( 'inspiry_gallery_button_color' ),
		);
		$output_css[] = array(
			'elements' => '.property-gallery-item-media-container a:hover svg',
			'property' => 'fill',
			'value'    => get_option( 'inspiry_gallery_button_hover_color' ),
		);
		$output_css[] = array(
			'elements' => '.property-gallery-item-media-container a',
			'property' => 'background-color',
			'value'    => get_option( 'inspiry_gallery_button_bg_color' ),
		);
		$output_css[] = array(
			'elements' => '.property-gallery-item-media-container a:hover',
			'property' => 'background-color',
			'value'    => get_option( 'inspiry_gallery_button_bg_hover_color' ),
		);

		// Footer
		$output_css[] = array(
			'elements' => '.site-footer',
			'property' => 'background-color',
			'value'    => get_option( 'inspiry_footer_bg' ),
		);
		$output_css[] = array(
			'elements' => '.site-footer',
			'property' => 'color',
			'value'    => get_option( 'theme_footer_widget_text_color' ),
		);
		$output_css[] = array(
			'elements' => '.site-footer a',
			'property' => 'color',
			'value'    => get_option( 'theme_footer_widget_link_color' ),
		);
		$output_css[] = array(
			'elements' => '.site-footer a:hover',
			'property' => 'color',
			'value'    => get_option( 'theme_footer_widget_link_hover_color' ),
		);
		$output_css[] = array(
			'elements' => '.site-footer h1,
			 .site-footer h2, 
			 .site-footer h3, 
			 .site-footer h4, 
			 .site-footer h5, 
			 .site-footer h6',
			'property' => 'color',
			'value'    => get_option( 'theme_footer_widget_title_hover_color' ),
		);
		$output_css[] = array(
			'elements' => '.site-footer-contacts',
			'property' => 'background-color',
			'value'    => get_option( 'realhomes_footer_contacts_wrapper_bg_color' ),
		);
		$output_css[] = array(
			'elements' => '.site-footer-contacts .rh-ultra-footer-help',
			'property' => 'color',
			'value'    => get_option( 'realhomes_footer_contacts_heading_color' ),
		);
		$output_css[] = array(
			'elements' => '.site-footer .rh-ultra-footer-number',
			'property' => 'color',
			'value'    => get_option( 'realhomes_footer_contacts_button_color' ),
		);
		$output_css[] = array(
			'elements' => '.site-footer .rh-ultra-footer-number:hover',
			'property' => 'color',
			'value'    => get_option( 'realhomes_footer_contacts_button_hover_color' ),
		);
		$output_css[] = array(
			'elements' => '.site-footer .rh-ultra-footer-number svg',
			'property' => 'fill',
			'value'    => get_option( 'realhomes_footer_contacts_button_color' ),
		);
		$output_css[] = array(
			'elements' => '.site-footer .rh-ultra-footer-number:hover svg',
			'property' => 'fill',
			'value'    => get_option( 'realhomes_footer_contacts_button_hover_color' ),
		);
		$output_css[] = array(
			'elements' => '.site-footer .rh-ultra-footer-number',
			'property' => array( 'background-color' ),
			'value'    => get_option( 'realhomes_footer_contacts_button_bg_color' ),
		);
		$output_css[] = array(
			'elements' => '.site-footer .rh-ultra-footer-number:hover',
			'property' => array( 'background-color' ),
			'value'    => get_option( 'realhomes_footer_contacts_button_bg_hover_color' ),
		);

		// Process styles
		$prop_count = count( $output_css );
		if ( $prop_count > 0 ) {
			foreach ( $output_css as $css_unit ) {
				if ( ! empty( $css_unit['value'] ) ) {
					$value     = $css_unit['value'];
					$property  = $css_unit['property'];
					$selectors = $css_unit['elements'];

					// For multiple css properties
					if ( is_array( $property ) ) {
						if ( ! empty( $property ) ) {
							$properties = '';
							foreach ( $property as $prop ) {
								$properties .= sprintf( "%s: %s;\n", $prop, $value );
							}

							$custom_css .= strip_tags( $selectors . "{" . $properties . "}\n" );
						}
					} else {
						$custom_css .= strip_tags( $selectors . "{" . $property . ":" . $value . ";" . "}\n" );
					}
				}
			}
		}

		return $custom_css;
	}
}

add_filter( 'realhomes_ultra_custom_css', 'realhomes_generate_dynamic_css' );