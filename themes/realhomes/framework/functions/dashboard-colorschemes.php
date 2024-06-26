<?php
/**
 * Dashboard color scheme config array
 *
 * Consists of named color schemes with predefined color key and color value.
 *
 * @since 4.0.0
 */

// Default color scheme for Modern design variation.
$dashboard_default_color_schemes = array(
	'label'                      => esc_html__( 'Default', 'framework' ),
	'primary'                    => '#1ea69a',
	'secondary'                  => '#ea723d',
	'body'                       => '#808080',
	'heading'                    => '#333333',
	'link'                       => '#333333',
	'link_hover'                 => '#e86126',
	'logo_container_bg'          => '#2f3534',
	'logo'                       => '#fff',
	'logo_hover'                 => '#f2f2f2',
	'sidebar_bg'                 => '#1e2323',
	'sidebar_menu'               => '#91afad',
	'sidebar_menu_bg'            => '#1e2323',
	'sidebar_menu_hover'         => '#ffffff',
	'sidebar_menu_hover_bg'      => '#1e3331',
	'sidebar_current_submenu'    => '#ffffff',
	'sidebar_current_submenu_bg' => '#171b1b',
	'package_background'         => '#d5f0eb',
	'popular_package_background' => '#f7daca',
);

// Default color scheme for Ultra design variation.
if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {
	$dashboard_default_color_schemes = array(
		'label'                      => esc_html__( 'Default', 'framework' ),
		'primary'                    => '#1db2ff',
		'secondary'                  => '#f58220',
		'body'                       => '#808080',
		'heading'                    => '#1a1a1a',
		'link'                       => '#1a1a1a',
		'link_hover'                 => '#1db2ff',
		'logo_container_bg'          => '#2f3534',
		'logo'                       => '#fff',
		'logo_hover'                 => '#f2f2f2',
		'sidebar_bg'                 => '#1e2323',
		'sidebar_menu'               => '#91afad',
		'sidebar_menu_bg'            => '#1e2323',
		'sidebar_menu_hover'         => '#ffffff',
		'sidebar_menu_hover_bg'      => '#1e3331',
		'sidebar_current_submenu'    => '#ffffff',
		'sidebar_current_submenu_bg' => '#171b1b',
		'package_background'         => '#d5f0eb',
		'popular_package_background' => '#f7daca',
	);
}

// Dashboard color scheme config array
$realhomes_dashboard_color_schemes = array(
	'default'      => $dashboard_default_color_schemes,
	'red'          => array(
		'label'                      => esc_html__( 'Red', 'framework' ),
		'primary'                    => '#FF0000',
		'secondary'                  => '#D10000',
		'body'                       => '#808080',
		'heading'                    => '#333333',
		'link'                       => '#333333',
		'link_hover'                 => '#FF0000',
		'logo_container_bg'          => '#2f3534',
		'logo'                       => '#fff',
		'logo_hover'                 => '#f2f2f2',
		'sidebar_bg'                 => '#1e2323',
		'sidebar_menu'               => '#91afad',
		'sidebar_menu_bg'            => '#1e2323',
		'sidebar_menu_hover'         => '#ffffff',
		'sidebar_menu_hover_bg'      => '#1e3331',
		'sidebar_current_submenu'    => '#ffffff',
		'sidebar_current_submenu_bg' => '#171b1b',
		'package_background'         => '#d5f0eb',
		'popular_package_background' => '#f7daca',
	),
	'orange'       => array(
		'label'                      => esc_html__( 'Orange', 'framework' ),
		'primary'                    => '#FFA500',
		'secondary'                  => '#D18700',
		'body'                       => '#808080',
		'heading'                    => '#333333',
		'link'                       => '#333333',
		'link_hover'                 => '#FFA500',
		'logo_container_bg'          => '#2f3534',
		'logo'                       => '#fff',
		'logo_hover'                 => '#f2f2f2',
		'sidebar_bg'                 => '#1e2323',
		'sidebar_menu'               => '#91afad',
		'sidebar_menu_bg'            => '#1e2323',
		'sidebar_menu_hover'         => '#ffffff',
		'sidebar_menu_hover_bg'      => '#1e3331',
		'sidebar_current_submenu'    => '#ffffff',
		'sidebar_current_submenu_bg' => '#171b1b',
		'package_background'         => '#d5f0eb',
		'popular_package_background' => '#f7daca',
	),
	'yellow'       => array(
		'label'                      => esc_html__( 'Yellow', 'framework' ),
		'primary'                    => '#D1D100',
		'secondary'                  => '#A3A300',
		'body'                       => '#808080',
		'heading'                    => '#333333',
		'link'                       => '#333333',
		'link_hover'                 => '#D1D100',
		'logo_container_bg'          => '#2f3534',
		'logo'                       => '#fff',
		'logo_hover'                 => '#f2f2f2',
		'sidebar_bg'                 => '#1e2323',
		'sidebar_menu'               => '#91afad',
		'sidebar_menu_bg'            => '#1e2323',
		'sidebar_menu_hover'         => '#ffffff',
		'sidebar_menu_hover_bg'      => '#1e3331',
		'sidebar_current_submenu'    => '#ffffff',
		'sidebar_current_submenu_bg' => '#171b1b',
		'package_background'         => '#d5f0eb',
		'popular_package_background' => '#f7daca',
	),
	'green'        => array(
		'label'                      => esc_html__( 'Green', 'framework' ),
		'primary'                    => '#4CBB17',
		'secondary'                  => '#3B9212',
		'body'                       => '#808080',
		'heading'                    => '#333333',
		'link'                       => '#333333',
		'link_hover'                 => '#4CBB17',
		'logo_container_bg'          => '#2f3534',
		'logo'                       => '#fff',
		'logo_hover'                 => '#f2f2f2',
		'sidebar_bg'                 => '#1e2323',
		'sidebar_menu'               => '#91afad',
		'sidebar_menu_bg'            => '#1e2323',
		'sidebar_menu_hover'         => '#ffffff',
		'sidebar_menu_hover_bg'      => '#1e3331',
		'sidebar_current_submenu'    => '#ffffff',
		'sidebar_current_submenu_bg' => '#171b1b',
		'package_background'         => '#d5f0eb',
		'popular_package_background' => '#f7daca',
	),
	'blue'         => array(
		'label'                      => esc_html__( 'Blue', 'framework' ),
		'primary'                    => '#1cb2ff',
		'secondary'                  => '#0054a6',
		'body'                       => '#808080',
		'heading'                    => '#333333',
		'link'                       => '#333333',
		'link_hover'                 => '#1cb2ff',
		'logo_container_bg'          => '#2f3534',
		'logo'                       => '#fff',
		'logo_hover'                 => '#f2f2f2',
		'sidebar_bg'                 => '#1e2323',
		'sidebar_menu'               => '#91afad',
		'sidebar_menu_bg'            => '#1e2323',
		'sidebar_menu_hover'         => '#ffffff',
		'sidebar_menu_hover_bg'      => '#1e3331',
		'sidebar_current_submenu'    => '#ffffff',
		'sidebar_current_submenu_bg' => '#171b1b',
		'package_background'         => '#d5f0eb',
		'popular_package_background' => '#f7daca',
	),
	'brown'        => array(
		'label'                      => esc_html__( 'Brown', 'framework' ),
		'primary'                    => '#F27900',
		'secondary'                  => '#C46200',
		'body'                       => '#808080',
		'heading'                    => '#333333',
		'link'                       => '#333333',
		'link_hover'                 => '#F27900',
		'logo_container_bg'          => '#2f3534',
		'logo'                       => '#fff',
		'logo_hover'                 => '#f2f2f2',
		'sidebar_bg'                 => '#1e2323',
		'sidebar_menu'               => '#91afad',
		'sidebar_menu_bg'            => '#1e2323',
		'sidebar_menu_hover'         => '#ffffff',
		'sidebar_menu_hover_bg'      => '#1e3331',
		'sidebar_current_submenu'    => '#ffffff',
		'sidebar_current_submenu_bg' => '#171b1b',
		'package_background'         => '#d5f0eb',
		'popular_package_background' => '#f7daca',
	),
	'pink'         => array(
		'label'                      => esc_html__( 'Pink', 'framework' ),
		'primary'                    => '#DE006F',
		'secondary'                  => '#B00058',
		'body'                       => '#808080',
		'heading'                    => '#333333',
		'link'                       => '#333333',
		'link_hover'                 => '#DE006F',
		'logo_container_bg'          => '#2f3534',
		'logo'                       => '#fff',
		'logo_hover'                 => '#f2f2f2',
		'sidebar_bg'                 => '#1e2323',
		'sidebar_menu'               => '#91afad',
		'sidebar_menu_bg'            => '#1e2323',
		'sidebar_menu_hover'         => '#ffffff',
		'sidebar_menu_hover_bg'      => '#1e3331',
		'sidebar_current_submenu'    => '#ffffff',
		'sidebar_current_submenu_bg' => '#171b1b',
		'package_background'         => '#d5f0eb',
		'popular_package_background' => '#f7daca',
	),
	'tiffany_blue' => array(
		'label'                      => esc_html__( 'Tiffany Blue', 'framework' ),
		'primary'                    => '#0ABAB5',
		'secondary'                  => '#088E8B',
		'body'                       => '#808080',
		'heading'                    => '#333333',
		'link'                       => '#333333',
		'link_hover'                 => '#0ABAB5',
		'logo_container_bg'          => '#2f3534',
		'logo'                       => '#fff',
		'logo_hover'                 => '#f2f2f2',
		'sidebar_bg'                 => '#1e2323',
		'sidebar_menu'               => '#91afad',
		'sidebar_menu_bg'            => '#1e2323',
		'sidebar_menu_hover'         => '#ffffff',
		'sidebar_menu_hover_bg'      => '#1e3331',
		'sidebar_current_submenu'    => '#ffffff',
		'sidebar_current_submenu_bg' => '#171b1b',
		'package_background'         => '#d5f0eb',
		'popular_package_background' => '#f7daca',
	),
);

/**
 * Returns the dashboard color scheme config array.
 *
 * @since 4.0.0
 *
 * @return array Color scheme config array.
 */
function realhomes_dashboard_color_schemes() {
	global $realhomes_dashboard_color_schemes;

	return $realhomes_dashboard_color_schemes;
}

/**
 *  Returns the dashboard color scheme array based on given color scheme.
 *
 * @since 4.0.0
 *
 * @param string $color_scheme Optional. Default 'custom'.
 *
 * @return array|bool The color scheme array, or false instead.
 */
function realhomes_dashboard_get_color_scheme( $color_scheme = 'custom' ) {
	$color_schemes = realhomes_dashboard_color_schemes();

	if ( isset( $color_schemes[ $color_scheme ] ) ) {
		return $color_schemes[ $color_scheme ];
	}

	return false;
}

/**
 *  Returns a list of dashboard color schemes.
 *
 * @since 4.0.0
 *
 * @return array The color schemes array.
 */
function realhomes_dashboard_color_schemes_list() {
	$output             = array();
	$color_schemes      = realhomes_dashboard_color_schemes();
	$color_schemes_list = array_keys( $color_schemes );

	if ( ! empty( $color_schemes_list ) && is_array( $color_schemes_list ) ) {
		foreach ( $color_schemes_list as $color_scheme ) {
			if ( isset( $color_schemes[ $color_scheme ]['label'] ) ) {
				$output[ $color_scheme ] = $color_schemes[ $color_scheme ]['label'];
			}
		}
	}

	// Custom option
	$output['custom'] = esc_html__( 'Custom', 'framework' );

	return $output;
}

/**
 * Returns the dashboard colors customizer ids mapping with color types.
 *
 * @since 4.0.0
 *
 * @return array Colors customizer setting ids.
 */
function realhomes_dashboard_colors_customizer_ids() {

	$customizer_ids = array();
	$color_settings = realhomes_dashboard_color_settings();

	if ( is_array( $color_settings ) && ! empty( $color_settings ) ) {
		foreach ( $color_settings as $setting ) {
			$customizer_id = esc_html( $setting['id'] );

			// Map the color key with customizer ID.
			$customizer_ids[ esc_html( str_replace( '_color', '', $customizer_id ) ) ] = 'inspiry_dashboard_' . $customizer_id;
		}
	}

	return $customizer_ids;
}

/**
 * Updates the dashboard color temporarily based on selected color scheme from customizer.
 *
 * @since 4.0.0
 *
 * @return bool
 */
function realhomes_dashboard_update_color_scheme() {
	$selected_color_scheme = get_option( 'realhomes_dashboard_color_scheme', 'custom' );

	// Skip updating for custom scheme.
	if ( 'custom' === $selected_color_scheme ) {
		return false;
	}

	$get_color_scheme = realhomes_dashboard_get_color_scheme( $selected_color_scheme );
	if ( ! empty( $get_color_scheme ) && is_array( $get_color_scheme ) ) {
		global $color_scheme_array;

		$customizer_settings = realhomes_dashboard_colors_customizer_ids();
		foreach ( $customizer_settings as $key => $settings_id ) {
			if ( isset( $get_color_scheme[ $key ] ) && ! empty( $get_color_scheme[ $key ] ) ) {
				$color_scheme_array[ $settings_id ] = $get_color_scheme[ $key ];
				add_filter( 'pre_option_' . $settings_id, function ( $option_default, $option ) {
					global $color_scheme_array;

					return $color_scheme_array[ $option ];
				}, 1, 2 );
			}
		}

		return true;
	}
}

add_action( 'customize_preview_init', 'realhomes_dashboard_update_color_scheme' );

/**
 * Saves the selected color scheme on publish.
 *
 * @since 4.0.0
 *
 * @return bool
 */
function realhomes_dashboard_save_color_scheme() {
	$selected_color_scheme = get_option( 'realhomes_dashboard_color_scheme', 'custom' );
	$previous_color_scheme = get_option( 'realhomes_dashboard_color_scheme_previous', 'custom' );

	// Skip saving for custom and same scheme.
	if ( 'custom' === $selected_color_scheme || $selected_color_scheme === $previous_color_scheme ) {
		return false;
	}

	update_option( 'realhomes_dashboard_color_scheme_previous', $selected_color_scheme );

	$get_color_scheme = realhomes_dashboard_get_color_scheme( $selected_color_scheme );
	if ( ! empty( $get_color_scheme ) && is_array( $get_color_scheme ) ) {
		$customizer_settings = realhomes_dashboard_colors_customizer_ids();
		foreach ( $customizer_settings as $key => $settings_id ) {
			if ( isset( $get_color_scheme[ $key ] ) && ! empty( $get_color_scheme[ $key ] ) ) {
				update_option( $settings_id, $get_color_scheme[ $key ] );
			}
		}
	}

	return true;
}

add_action( 'customize_save_after', 'realhomes_dashboard_save_color_scheme' );

/**
 * Returns the dashboard colors current values.
 *
 * @since 4.0.0
 *
 * @return array
 */
function realhomes_dashboard_get_current_colors() {
	$current_colors = array();

	$customizer_settings = realhomes_dashboard_colors_customizer_ids();
	if ( ! empty( $customizer_settings ) && is_array( $customizer_settings ) ) {
		foreach ( $customizer_settings as $settings_id ) {
			$current_colors[ $settings_id ] = get_option( $settings_id );
		}
	}

	return wp_send_json_success( $current_colors );
}

add_action( 'wp_ajax_realhomes_dashboard_get_current_colors', 'realhomes_dashboard_get_current_colors' );