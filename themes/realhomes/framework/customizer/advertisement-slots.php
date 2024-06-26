<?php
if ( ! function_exists( 'realhomes_advertisement_slots' ) ) {
	/**
	 * Returns the list of advertisement slots.
	 *
	 * @since 4.1.1
	 *
	 * @return array
	 */
	function realhomes_advertisement_slots() {

		return array(
			'ad_above_header'   => esc_html__( 'Above Header', 'framework' ),
			'ad_below_header'   => esc_html__( 'Below Header', 'framework' ),
			'ad_above_sp_agent' => esc_html__( 'Above Single Property Sidebar Agent', 'framework' ),
			'ad_above_footer'   => esc_html__( 'Above Footer', 'framework' ),
			'ad_below_footer'   => esc_html__( 'Below Footer', 'framework' ),
		);
	}
}

/**
 * Converts textarea code to base64 string.
 *
 * @since 4.1.1
 *
 * @return string
 */
function realhomes_ad_sanitize_js( $value ) {
	return base64_encode( $value );
}

/**
 * Converts base64 string to code for textarea.
 *
 * @since 4.1.1
 *
 * @return string
 */
function realhomes_ad_escape_js( $value ) {
	return esc_textarea( base64_decode( $value ) );
}

/**
 * Advertisement slots customizer settings
 *
 * @since   4.1.1
 *
 * @package realhomes/customizer
 */
if ( ! function_exists( 'realhomes_advertisement_slots_customizer' ) ) {
	function realhomes_advertisement_slots_customizer( WP_Customize_Manager $wp_customize ) {

		$wp_customize->add_panel( 'realhomes_advertisement_panel', array(
			'title'    => esc_html__( 'Advertisements', 'framework' ),
			'priority' => 140,
		) );

		$advertisement_locations = realhomes_advertisement_slots();
		if ( is_array( $advertisement_locations ) && ! empty( $advertisement_locations ) ) {
			foreach ( $advertisement_locations as $slot_name => $title ) {

				$setting_id = 'realhomes_' . $slot_name;
				$section_id = $setting_id . '_section';

				$wp_customize->add_section( $section_id, array(
					'title' => sprintf( '%s %s', esc_html__( 'Ad ', 'framework' ), esc_html( $title ) ),
					'panel' => 'realhomes_advertisement_panel',
				) );

				$enable_location_id = $setting_id . '_enable_location';
				$wp_customize->add_setting( $enable_location_id, array(
					'type'              => 'option',
					'default'           => 'no',
					'sanitize_callback' => 'inspiry_sanitize_radio',
				) );
				$wp_customize->add_control( $enable_location_id, array(
					'label'   => esc_html__( 'Enable Ad Location', 'framework' ),
					'type'    => 'radio',
					'section' => $section_id,
					'choices' => array(
						'yes' => esc_html__( 'Yes', 'framework' ),
						'no'  => esc_html__( 'No', 'framework' ),
					),
				) );

				$ad_type_id = $setting_id . '_ad_type';
				$wp_customize->add_setting( $ad_type_id, array(
					'type'              => 'option',
					'default'           => 'code',
					'sanitize_callback' => 'inspiry_sanitize_radio',
				) );
				$wp_customize->add_control( $ad_type_id, array(
					'label'           => esc_html__( 'Ad Type', 'framework' ),
					'type'            => 'radio',
					'section'         => $section_id,
					'choices'         => array(
						'code'  => esc_html__( 'Code or Markup', 'framework' ),
						'image' => esc_html__( 'Simple Image', 'framework' ),
					),
					'active_callback' => function () use ( $enable_location_id ) {
						return ( 'yes' === get_option( $enable_location_id, 'no' ) );
					}
				) );

				$ad_setting_id = $setting_id . '_ad';
				$wp_customize->add_setting( $ad_setting_id, array(
					'type'                 => 'option',
					'default'              => '',
					'sanitize_callback'    => 'realhomes_ad_sanitize_js', // Encode for DB insert
					'sanitize_js_callback' => 'realhomes_ad_escape_js' // Escape script for the textarea
				) );
				$wp_customize->add_control( $ad_setting_id, array(
					'label'           => esc_html__( 'Ad Markup/Code', 'framework' ),
					'description'     => esc_html__( 'Place your ad unit code here.', 'framework' ),
					'type'            => 'textarea',
					'section'         => $section_id,
					'active_callback' => function () use ( $ad_type_id, $enable_location_id ) {
						return ( 'code' === get_option( $ad_type_id, 'code' ) && 'yes' === get_option( $enable_location_id, 'no' ) );
					}
				) );

				$ad_image_setting_id = $setting_id . '_ad_image';
				$wp_customize->add_setting( $ad_image_setting_id, array(
					'type'              => 'option',
					'sanitize_callback' => 'esc_url_raw',
				) );
				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $ad_image_setting_id, array(
					'label'           => esc_html__( 'Ad Image', 'framework' ),
					'description'     => esc_html__( 'Select the suitable size image for the current ad area.', 'framework' ),
					'section'         => $section_id,
					'active_callback' => function () use ( $ad_type_id, $enable_location_id ) {
						return ( 'image' === get_option( $ad_type_id, 'code' ) && 'yes' === get_option( $enable_location_id, 'no' ) );
					}
				) ) );

				$ad_link_setting_id = $setting_id . '_ad_link';
				$wp_customize->add_setting( $ad_link_setting_id, array(
					'type'              => 'option',
					'default'           => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_control( $ad_link_setting_id, array(
					'label'           => esc_html__( 'Ad Link', 'framework' ),
					'type'            => 'text',
					'section'         => $section_id,
					'active_callback' => function () use ( $ad_type_id, $enable_location_id ) {
						return ( 'image' === get_option( $ad_type_id, 'code' ) && 'yes' === get_option( $enable_location_id, 'no' ) );
					}
				) );

				$heading = $setting_id . '_heading';
				$wp_customize->add_setting( $heading, array( 'sanitize_callback' => 'sanitize_text_field', ) );
				$wp_customize->add_control( new Inspiry_Heading_Customize_Control( $wp_customize, $heading,
					array(
						'label'           => esc_html__( 'Ad Container Styles', 'framework' ),
						'section'         => $section_id,
						'active_callback' => function () use ( $enable_location_id ) {
							return ( 'yes' === get_option( $enable_location_id, 'no' ) );
						}
					)
				) );

				$container_width_id = $setting_id . '_container_max_width';
				$wp_customize->add_setting( $container_width_id, array(
					'type'              => 'option',
					'default'           => '768px',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_control( $container_width_id, array(
					'label'           => esc_html__( 'Max Width', 'framework' ),
					'description'     => esc_html__( 'Example: 1240px, 80% etc.', 'framework' ),
					'type'            => 'text',
					'section'         => $section_id,
					'active_callback' => function () use ( $enable_location_id ) {
						return ( 'yes' === get_option( $enable_location_id, 'no' ) );
					}
				) );

				$container_margin_id = $setting_id . '_container_margin';
				$wp_customize->add_setting( $container_margin_id, array(
					'type'              => 'option',
					'default'           => '5px auto',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_control( $container_margin_id, array(
					'label'           => esc_html__( 'Margin', 'framework' ),
					'description'     => esc_html__( 'Use any combination of possible values. Example: 15px, 5%, 15px 30px, 10px auto etc.', 'framework' ),
					'type'            => 'text',
					'section'         => $section_id,
					'active_callback' => function () use ( $enable_location_id ) {
						return ( 'yes' === get_option( $enable_location_id, 'no' ) );
					}
				) );

				$container_padding_id = $setting_id . '_container_padding';
				$wp_customize->add_setting( $container_padding_id, array(
					'type'              => 'option',
					'default'           => '5px',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_control( $container_padding_id, array(
					'label'           => esc_html__( 'Padding', 'framework' ),
					'description'     => esc_html__( 'Use any combination of possible values. Example: 15px, 5%, 15px 30px etc.', 'framework' ),
					'type'            => 'text',
					'section'         => $section_id,
					'active_callback' => function () use ( $enable_location_id ) {
						return ( 'yes' === get_option( $enable_location_id, 'no' ) );
					}
				) );

				$container_border_width_id = $setting_id . '_container_border_width';
				$wp_customize->add_setting( $container_border_width_id, array(
					'type'              => 'option',
					'default'           => '1px',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_control( $container_border_width_id, array(
					'label'           => esc_html__( 'Border Width', 'framework' ),
					'description'     => esc_html__( 'Example: 1px, 5px etc.', 'framework' ),
					'type'            => 'text',
					'section'         => $section_id,
					'active_callback' => function () use ( $enable_location_id ) {
						return ( 'yes' === get_option( $enable_location_id, 'no' ) );
					}
				) );

				$container_border_color_id = $setting_id . '_container_border_color';
				$wp_customize->add_setting( $container_border_color_id, array(
					'type'              => 'option',
					'default'           => '#eee',
					'sanitize_callback' => 'sanitize_hex_color',
				) );
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $container_border_color_id, array(
						'label'           => esc_html__( 'Border Color', 'framework' ),
						'section'         => $section_id,
						'active_callback' => function () use ( $enable_location_id ) {
							return ( 'yes' === get_option( $enable_location_id, 'no' ) );
						}
					)
				) );

				$container_background_color_id = $setting_id . '_container_background_color';
				$wp_customize->add_setting( $container_background_color_id, array(
					'type'              => 'option',
					'default'           => '#fff',
					'sanitize_callback' => 'sanitize_hex_color',
				) );
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $container_background_color_id, array(
						'label'           => esc_html__( 'Background Color', 'framework' ),
						'section'         => $section_id,
						'active_callback' => function () use ( $enable_location_id ) {
							return ( 'yes' === get_option( $enable_location_id, 'no' ) );
						}
					)
				) );

			}
		}
	}

	add_action( 'customize_register', 'realhomes_advertisement_slots_customizer' );
}

/**
 * Displays the ad markup if available.
 *
 * @since 4.1.1
 *
 * @param $slot_name
 *
 * @return bool|void
 */
function realhomes_advertisement_by_slot_name( $slot_name ) {

	$option_id = 'realhomes_' . $slot_name;

	if ( 'no' === get_option( $option_id . '_enable_location', 'no' ) ) {
		return false;
	}

	$container_class  = str_replace( '_', '-', $option_id );
	$container_styles = sprintf( 'max-width: %s; ', esc_html( get_option( $option_id . '_container_max_width', '768px' ) ) );
	$container_styles .= sprintf( 'margin: %s; ', esc_html( get_option( $option_id . '_container_margin', '5px auto' ) ) );
	$container_styles .= sprintf( 'padding: %s; ', esc_html( get_option( $option_id . '_container_padding', '5px' ) ) );
	$container_styles .= sprintf( 'border: %s solid %s; ', esc_html( get_option( $option_id . '_container_border_width', '1px' ) ), esc_html( get_option( $option_id . '_container_border_color', '#eee' ) ) );
	$container_styles .= sprintf( 'background: %s;', esc_html( get_option( $option_id . '_container_background_color', '#fff' ) ) );
	?>
    <div class="<?php echo esc_attr( $container_class . '-advertisement' ); ?>" style="width: 100%;">
        <div class="<?php echo esc_attr( $container_class . '-advertisement-inner' ); ?>" style="<?php echo esc_attr( $container_styles ); ?>">
			<?php
			if ( 'image' === get_option( $option_id . '_ad_type', 'code' ) ) {
				$ad_image = get_option( $option_id . '_ad_image', '' );
				if ( ! empty( $ad_image ) ) {
					$img = sprintf( '<img src="%s" alt="" />', esc_url( $ad_image ) );

					$ad_link = get_option( $option_id . '_ad_link', '' );
					if ( ! empty( $ad_link ) ) {
						printf( '<a href="%s">%s</a>', esc_url( $ad_link ), $img );
					} else {
						echo $img;
					}
				}
			} else {
				echo base64_decode( get_option( $option_id . '_ad', '' ) );
			}
			?>
        </div>
    </div>
	<?php
}

/**
 * Displays the ad above header.
 *
 * @since 4.1.1
 */
function realhomes_ad_above_header() {
	realhomes_advertisement_by_slot_name( 'ad_above_header' );
}

/**
 * Displays the ad below header.
 *
 * @since 4.1.1
 */
function realhomes_ad_below_header() {
	realhomes_advertisement_by_slot_name( 'ad_below_header' );
}

/**
 * Displays the ad above footer.
 *
 * @since 4.1.1
 */
function realhomes_ad_above_footer() {
	realhomes_advertisement_by_slot_name( 'ad_above_footer' );
}

/**
 * Displays the ad below footer.
 *
 * @since 4.1.1
 */
function realhomes_ad_below_footer() {
	realhomes_advertisement_by_slot_name( 'ad_below_footer' );
}

/**
 * Displays the ad above single property sidebar agent.
 *
 * @since 4.1.1
 */
function realhomes_ad_above_sp_agent() {
	realhomes_advertisement_by_slot_name( 'ad_above_sp_agent' );
}

add_action( 'wp_body_open', 'realhomes_ad_above_header' );
add_action( 'inspiry_before_page_contents', 'realhomes_ad_below_header' );
add_action( 'realhomes_above_single_property_sidebar_agent', 'realhomes_ad_above_sp_agent' );
add_action( 'realhomes_before_footer', 'realhomes_ad_above_footer' );
add_action( 'wp_footer', 'realhomes_ad_below_footer' );