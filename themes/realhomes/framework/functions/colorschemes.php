<?php
/**
 * Realhomes theme color scheme config array
 *
 * Consists of named color schemes with predefined color key and color value.
 */

// Default color scheme for Modern design variation.
$default_color_schemes = array(
	'label'                           => esc_html__( 'Default', 'framework' ),
	'primary'                         => '#1ea69a',
	'primary_light'                   => '#0b8278',
	'primary_dark'                    => '#0b8278',
	'secondary'                       => '#ea723d',
	'secondary_light'                 => '#ea5819',
	'secondary_dark'                  => '#ea5819',
	'text'                            => '#808080',
	'headings'                        => '#1a1a1a',
	'headings_hover'                  => '#ea723d',
	'link'                            => '#444444',
	'link_hover'                      => '#ea723d',
	'selection'                       => '#1ea69a',
	'footer_bg'                       => '#303030',
	'footer_widget_text_color'        => '#808080',
	'footer_widget_link_color'        => '#808080',
	'footer_widget_link_hover_color'  => '#ffffff',
	'footer_widget_title_hover_color' => '#ffffff',
);

// Default color scheme for Ultra design variation.
if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {
	$default_color_schemes = array(
		'label'                           => esc_html__( 'Default', 'framework' ),
		'primary'                         => '#1db2ff',
		'primary_light'                   => '#e7f6fd',
		'primary_dark'                    => '#dbf0fa',
		'secondary'                       => '#f58220',
		'secondary_light'                 => '#f8ab69',
		'secondary_dark'                  => '#c05d09',
		'text'                            => '#808080',
		'headings'                        => '#1a1a1a',
		'headings_hover'                  => '#1db2ff',
		'link'                            => '#1a1a1a',
		'link_hover'                      => '#1db2ff',
		'selection'                       => '#1db2ff',
		'footer_bg'                       => '#e7f6fd',
		'footer_widget_text_color'        => '#808080',
		'footer_widget_link_color'        => '#808080',
		'footer_widget_link_hover_color'  => '#ffffff',
		'footer_widget_title_hover_color' => '#ffffff',
	);
}

// Color scheme config array.
$realhomes_color_schemes = array(
	'default'      => $default_color_schemes,
	'red'          => array(
		'label'                           => esc_html__( 'Red', 'framework' ),
		'primary'                         => '#FF0000',
		'primary_light'                   => '#ffeaea',
		'primary_dark'                    => ( 'ultra' === INSPIRY_DESIGN_VARIATION ) ? '#fadcdc' : '#D10000',
		'secondary'                       => '#D10000',
		'secondary_light'                 => 'fce6e6',
		'secondary_dark'                  => '#A30000',
		'text'                            => '#808080',
		'headings'                        => '#1a1a1a',
		'headings_hover'                  => '#FF0000',
		'link'                            => '#444444',
		'link_hover'                      => '#FF0000',
		'selection'                       => '#FF5C5C',
		'footer_bg'                       => '#303030',
		'footer_widget_text_color'        => '#808080',
		'footer_widget_link_color'        => '#808080',
		'footer_widget_link_hover_color'  => '#ffffff',
		'footer_widget_title_hover_color' => '#ffffff',
	),
	'orange'       => array(
		'label'                           => esc_html__( 'Orange', 'framework' ),
		'primary'                         => '#FFA500',
		'primary_light'                   => '#fcf4e6',
		'primary_dark'                    => ( 'ultra' === INSPIRY_DESIGN_VARIATION ) ? '#faefdc' : '#D18700',
		'secondary'                       => '#D18700',
		'secondary_light'                 => '#e0d9cc',
		'secondary_dark'                  => '#A36A00',
		'text'                            => '#808080',
		'headings'                        => '#1a1a1a',
		'headings_hover'                  => '#FFA500',
		'link'                            => '#444444',
		'link_hover'                      => '#FFA500',
		'selection'                       => '#FFC55C',
		'footer_bg'                       => '#303030',
		'footer_widget_text_color'        => '#808080',
		'footer_widget_link_color'        => '#808080',
		'footer_widget_link_hover_color'  => '#ffffff',
		'footer_widget_title_hover_color' => '#ffffff',
	),
	'yellow'       => array(
		'label'                           => esc_html__( 'Yellow', 'framework' ),
		'primary'                         => '#D1D100',
		'primary_light'                   => '#fcfce6',
		'primary_dark'                    => ( 'ultra' === INSPIRY_DESIGN_VARIATION ) ? '#fafadc' : '#A3A300',
		'secondary'                       => '#A3A300',
		'secondary_light'                 => '#e0e0cc',
		'secondary_dark'                  => '#757500',
		'text'                            => '#808080',
		'headings'                        => '#1a1a1a',
		'headings_hover'                  => '#D1D100',
		'link'                            => '#444444',
		'link_hover'                      => '#D1D100',
		'selection'                       => '#FFFF00',
		'footer_bg'                       => '#303030',
		'footer_widget_text_color'        => '#808080',
		'footer_widget_link_color'        => '#808080',
		'footer_widget_link_hover_color'  => '#ffffff',
		'footer_widget_title_hover_color' => '#ffffff',
	),
	'green'        => array(
		'label'                           => esc_html__( 'Green', 'framework' ),
		'primary'                         => '#4CBB17',
		'primary_light'                   => '#f8fff6',
		'primary_dark'                    => ( 'ultra' === INSPIRY_DESIGN_VARIATION ) ? '#e5fadc' : '#3B9212',
		'secondary'                       => '#3B9212',
		'secondary_light'                 => '#d3e0cc',
		'secondary_dark'                  => '#2B690D',
		'text'                            => '#808080',
		'headings'                        => '#1a1a1a',
		'headings_hover'                  => '#4CBB17',
		'link'                            => '#444444',
		'link_hover'                      => '#4CBB17',
		'selection'                       => '#7AE846',
		'footer_bg'                       => '#303030',
		'footer_widget_text_color'        => '#808080',
		'footer_widget_link_color'        => '#808080',
		'footer_widget_link_hover_color'  => '#ffffff',
		'footer_widget_title_hover_color' => '#ffffff',
	),
	'blue'         => array(
		'label'                           => esc_html__( 'Blue', 'framework' ),
		'primary'                         => '#1cb2ff',
		'primary_light'                   => '#e6f5fc',
		'primary_dark'                    => ( 'ultra' === INSPIRY_DESIGN_VARIATION ) ? '#dcf0fa' : '#0054a6',
		'secondary'                       => '#0054a6',
		'secondary_light'                 => '#ccd6e0',
		'secondary_dark'                  => '#004284',
		'text'                            => '#808080',
		'headings'                        => '#1a1a1a',
		'headings_hover'                  => '#1cb2ff',
		'link'                            => '#444444',
		'link_hover'                      => '#1cb2ff',
		'selection'                       => '#3fbfff',
		'footer_bg'                       => '#0054a5',
		'footer_widget_text_color'        => '#aacef2',
		'footer_widget_link_color'        => '#aacef2',
		'footer_widget_link_hover_color'  => '#ffffff',
		'footer_widget_title_hover_color' => '#ffffff',
	),
	'brown'        => array(
		'label'                           => esc_html__( 'Brown', 'framework' ),
		'primary'                         => '#F27900',
		'primary_light'                   => '#fcf1e6',
		'primary_dark'                    => ( 'ultra' === INSPIRY_DESIGN_VARIATION ) ? '#faebdc' : '#C46200',
		'secondary'                       => '#C46200',
		'secondary_light'                 => '#e0d6cc',
		'secondary_dark'                  => '#c05d09',
		'text'                            => '#808080',
		'headings'                        => '#1a1a1a',
		'headings_hover'                  => '#F27900',
		'link'                            => '#444444',
		'link_hover'                      => '#F27900',
		'selection'                       => '#FF9021',
		'footer_bg'                       => '#303030',
		'footer_widget_text_color'        => '#808080',
		'footer_widget_link_color'        => '#808080',
		'footer_widget_link_hover_color'  => '#ffffff',
		'footer_widget_title_hover_color' => '#ffffff',
	),
	'pink'         => array(
		'label'                           => esc_html__( 'Pink', 'framework' ),
		'primary'                         => '#DE006F',
		'primary_light'                   => '#fce6f1',
		'primary_dark'                    => ( 'ultra' === INSPIRY_DESIGN_VARIATION ) ? '#fadceb' : '#B00058',
		'secondary'                       => '#B00058',
		'secondary_light'                 => '#fce6f1',
		'secondary_dark'                  => '#820041',
		'text'                            => '#808080',
		'headings'                        => '#1a1a1a',
		'headings_hover'                  => '#DE006F',
		'link'                            => '#444444',
		'link_hover'                      => '#DE006F',
		'selection'                       => '#FF3B9D',
		'footer_bg'                       => '#303030',
		'footer_widget_text_color'        => '#808080',
		'footer_widget_link_color'        => '#808080',
		'footer_widget_link_hover_color'  => '#ffffff',
		'footer_widget_title_hover_color' => '#ffffff',
	),
	'tiffany_blue' => array(
		'label'                           => esc_html__( 'Tiffany Blue', 'framework' ),
		'primary'                         => '#0ABAB5',
		'primary_light'                   => '#e6fcfc',
		'primary_dark'                    => ( 'ultra' === INSPIRY_DESIGN_VARIATION ) ? '#dcfaf9' : '#088E8B',
		'secondary'                       => '#088E8B',
		'secondary_light'                 => '#e6fcfc',
		'secondary_dark'                  => '#056360',
		'text'                            => '#808080',
		'headings'                        => '#1a1a1a',
		'headings_hover'                  => '#0ABAB5',
		'link'                            => '#444444',
		'link_hover'                      => '#0ABAB5',
		'selection'                       => '#0CE6DF',
		'footer_bg'                       => '#303030',
		'footer_widget_text_color'        => '#808080',
		'footer_widget_link_color'        => '#808080',
		'footer_widget_link_hover_color'  => '#ffffff',
		'footer_widget_title_hover_color' => '#ffffff',
	),
);

/**
 * Returns the color scheme config array.
 *
 * @since 3.17.0
 *
 * @return array Color scheme config array.
 */
function realhomes_color_schemes() {
	global $realhomes_color_schemes;

	return $realhomes_color_schemes;
}

/**
 *  Returns the color scheme array based on given color scheme.
 *
 * @since 3.17.0
 *
 * @param string $color_scheme Optional. Default 'custom'.
 *
 * @return array|bool The color scheme array, or false instead.
 */
function realhomes_get_color_scheme( $color_scheme = 'custom' ) {
	$color_schemes = realhomes_color_schemes();

	if ( isset( $color_schemes[ $color_scheme ] ) ) {
		return $color_schemes[ $color_scheme ];
	}

	return false;
}

/**
 *  Returns a list of color schemes.
 *
 * @since 3.17.0
 *
 * @return array The color schemes array.
 */
function realhomes_color_schemes_list() {
	$output             = array();
	$color_schemes      = realhomes_color_schemes();
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
 * Returns the theme global color's customizer ids mapping with color types.
 *
 * @since 3.17.0
 *
 * @return array Colors customizer setting ids.
 */
function realhomes_colors_customizer_ids() {
	return array(
		'primary'                         => 'theme_core_mod_color_green',
		'primary_dark'                    => 'theme_core_mod_color_green_dark',
		'primary_light'                   => 'realhomes_color_primary_light',
		'secondary'                       => 'theme_core_mod_color_orange',
		'secondary_light'                 => 'realhomes_color_secondary_light',
		'secondary_dark'                  => 'theme_core_mod_color_orange_dark',
		'text'                            => 'inspiry_body_font_color',
		'headings'                        => 'inspiry_heading_font_color',
		'headings_hover'                  => 'realhomes_global_headings_hover_color',
		'link'                            => 'realhomes_global_link_color',
		'link_hover'                      => 'realhomes_global_link_hover_color',
		'selection'                       => 'realhomes_selection_bg_color',
		'footer_bg'                       => 'inspiry_footer_bg',
		'footer_widget_text_color'        => 'theme_footer_widget_text_color',
		'footer_widget_link_color'        => 'theme_footer_widget_link_color',
		'footer_widget_link_hover_color'  => 'theme_footer_widget_link_hover_color',
		'footer_widget_title_hover_color' => 'theme_footer_widget_title_hover_color',
	);
}

/**
 * Updates the theme color temporarily based on selected color scheme from customizer.
 *
 * @since 3.17.0
 *
 * @return bool
 */
function realhomes_update_color_scheme() {
	$selected_color_scheme = get_option( 'realhomes_color_scheme', 'custom' );

	// Skip updating for custom scheme.
	if ( 'custom' === $selected_color_scheme ) {
		return false;
	}

	$get_color_scheme = realhomes_get_color_scheme( $selected_color_scheme );
	if ( ! empty( $get_color_scheme ) && is_array( $get_color_scheme ) ) {
		global $color_scheme_array;

		$customizer_settings = realhomes_colors_customizer_ids();
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

add_action( 'customize_preview_init', 'realhomes_update_color_scheme' );

/**
 * Saves the selected color scheme on publish.
 *
 * @since 3.17.0
 *
 * @return bool
 */
function realhomes_save_color_scheme() {
	$selected_color_scheme = get_option( 'realhomes_color_scheme', 'custom' );
	$previous_color_scheme = get_option( 'realhomes_color_scheme_previous', 'custom' );

	// Skip saving for custom and same scheme.
	if ( 'custom' === $selected_color_scheme || $selected_color_scheme === $previous_color_scheme ) {
		return false;
	}

	update_option( 'realhomes_color_scheme_previous', $selected_color_scheme );

	$get_color_scheme = realhomes_get_color_scheme( $selected_color_scheme );
	if ( ! empty( $get_color_scheme ) && is_array( $get_color_scheme ) ) {
		$customizer_settings = realhomes_colors_customizer_ids();
		foreach ( $customizer_settings as $key => $settings_id ) {
			if ( isset( $get_color_scheme[ $key ] ) && ! empty( $get_color_scheme[ $key ] ) ) {
				update_option( $settings_id, $get_color_scheme[ $key ] );
			}
		}
	}

	return true;
}

add_action( 'customize_save_after', 'realhomes_save_color_scheme' );

/**
 * Returns the theme global colors current values.
 *
 * @since 3.17.0
 *
 * @return array
 */
function realhomes_get_current_colors() {
	$current_colors = array();

	$customizer_settings = realhomes_colors_customizer_ids();
	if ( ! empty( $customizer_settings ) && is_array( $customizer_settings ) ) {
		foreach ( $customizer_settings as $settings_id ) {
			$current_colors[ $settings_id ] = get_option( $settings_id );
		}
	}

	return wp_send_json_success( $current_colors );
}

add_action( 'wp_ajax_realhomes_get_current_colors', 'realhomes_get_current_colors' );