<?php /**
 * RVR search form geo location slider
 *
 * @since 2.2.0
 */
if ( is_page_template( array(
	'templates/properties-search.php',
	'templates/properties-search-half-map.php',
	'templates/half-map-layout.php',
	'templates/properties-search-left-sidebar.php',
	'templates/properties-search-right-sidebar.php'
) ) ) {
	if ( 'properties-map' === get_option( 'theme_search_module', 'properties-map' ) && inspiry_is_search_page_map_visible() ) {
		$default_radius = ! empty( $_GET['geolocation-radius'] ) ? $_GET['geolocation-radius'] : get_option( 'realhomes_search_radius_range_initial', '20' );
		$radius_unit    = esc_html__( 'miles', 'realhomes-elementor-addon' );

		if ( 'kilometers' === get_option( 'realhomes_search_radius_range_type', 'miles' ) ) {
			$radius_unit = esc_html__( 'km', 'realhomes-elementor-addon' );
		}
		?>
        <div id="geolocation-radius-slider-wrapper" class="geolocation-radius-slider-wrapper">
            <p class="geolocation-radius-info">
				<?php esc_html_e( 'Radius:', 'realhomes-elementor-addon' ); ?>
                <strong><?php printf( '%s %s', esc_html( $default_radius ), esc_html( $radius_unit ) ); ?></strong>
            </p>
            <div id="geolocation-radius-slider" data-unit="<?php echo esc_attr( $radius_unit ); ?>" data-value="<?php echo esc_attr( $default_radius ); ?>" data-min-value="<?php echo get_option( 'realhomes_search_radius_range_min', '10' ); ?>" data-max-value="<?php echo get_option( 'realhomes_search_radius_range_max', '50' ); ?>"></div>
            <input type="hidden" name="geolocation-radius" id="geolocation-radius" value="<?php echo esc_attr( $default_radius ); ?>">
        </div>
		<?php
	}
}
?>