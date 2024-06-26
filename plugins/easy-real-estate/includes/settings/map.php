<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$ere_theme_map_type          = $this->get_option( 'ere_theme_map_type' );
$inspiry_google_maps_api_key = $this->get_option( 'inspiry_google_maps_api_key' );
$theme_map_localization      = $this->get_option( 'theme_map_localization', 'true' );
$ere_google_map_type         = $this->get_option( 'ere_google_map_type', 'roadmap' );
$inspiry_google_maps_styles  = $this->get_option( 'inspiry_google_maps_styles' );

// MapBox Options
$ere_mapbox_api_key = $this->get_option( 'ere_mapbox_api_key' );
$ere_mapbox_style   = $this->get_option( 'ere_mapbox_style' );

$theme_submit_default_address    = $this->get_option( 'theme_submit_default_address', esc_html__( '15421 Southwest 39th Terrace, Miami, FL 33185, USA', 'easy-real-estate' ) );
$theme_submit_default_location   = $this->get_option( 'theme_submit_default_location', esc_html__( '25.7308309,-80.44414899999998', 'easy-real-estate' ) );
$properties_map_default_location = $this->get_option( 'inspiry_properties_map_default_location', esc_html__( '27.664827,-81.515755', 'easy-real-estate' ) );

if ( isset( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'inspiry_ere_settings' ) ) {
	update_option( 'ere_theme_map_type', $ere_theme_map_type );

	// Updating Google Map Options
	update_option( 'inspiry_google_maps_api_key', $inspiry_google_maps_api_key );
	update_option( 'theme_map_localization', $theme_map_localization );
	update_option( 'ere_google_map_type', $ere_google_map_type );
	update_option( 'inspiry_google_maps_styles', $inspiry_google_maps_styles );

	// Updating MapBox Options
	update_option( 'ere_mapbox_api_key', $ere_mapbox_api_key );
	update_option( 'ere_mapbox_style', $ere_mapbox_style );

	// Updating general map options
	update_option( 'theme_submit_default_address', $theme_submit_default_address );
	update_option( 'theme_submit_default_location', $theme_submit_default_location );
	update_option( 'inspiry_properties_map_default_location', $properties_map_default_location );
}

if ( empty( $ere_theme_map_type ) ) {
	$ere_theme_map_type = 'openstreetmaps';
}

$mapbox_styles = array(
	'Streets'           => 'mapbox://styles/mapbox/streets-v11',
	'Outdoors'          => 'mapbox://styles/mapbox/outdoors-v11',
	'Light'             => 'mapbox://styles/mapbox/light-v10',
	'Dark'              => 'mapbox://styles/mapbox/dark-v10',
	'Satellite'         => 'mapbox://styles/mapbox/satellite-v9',
	'Satellite Streets' => 'mapbox://styles/mapbox/satellite-streets-v11',
	'Navigation Day'    => 'mapbox://styles/mapbox/navigation-day-v1',
	'Navigation Night'  => 'mapbox://styles/mapbox/navigation-night-v1'
);

?>
<div class="inspiry-ere-page-content">
    <h2 class="title"><?php esc_html_e( 'Map Settings', 'easy-real-estate' ); ?></h2>

    <form method="post" action="" novalidate="novalidate">
        <table class="form-table">
            <tbody>
            <tr>
                <th scope="row"><?php esc_html_e( 'Website Map Service', 'easy-real-estate' ); ?></th>
                <td>
                    <fieldset class="website-map-options">
                        <legend class="screen-reader-text">
                            <span><?php esc_html_e( 'Website Map Service', 'easy-real-estate' ); ?></span></legend>
                        <label>
                            <input type="radio" class="website-map-option" name="ere_theme_map_type" value="googlemaps" <?php checked( $ere_theme_map_type, 'googlemaps' ) ?>>
                            <span><?php esc_html_e( 'Google Maps', 'easy-real-estate' ); ?></span>
                        </label>
                        <br>
                        <label>
                            <input type="radio" class="website-map-option" name="ere_theme_map_type" value="mapbox" <?php checked( $ere_theme_map_type, 'mapbox' ) ?>>
                            <span><?php esc_html_e( 'MapBox', 'easy-real-estate' ); ?></span>
                        </label>
                        <br>
                        <label>
                            <input type="radio" class="website-map-option" name="ere_theme_map_type" value="openstreetmaps" <?php checked( $ere_theme_map_type, 'openstreetmaps' ) ?>>
                            <span><?php esc_html_e( 'OpenStreetMaps', 'easy-real-estate' ); ?></span>
                        </label>
                    </fieldset>
                </td>
            </tr>

            <!-- Google Maps related options -->
            <tr class="map-service-wrap googlemaps">
                <th scope="row">
                    <label for="inspiry_google_maps_api_key"><?php esc_html_e( 'Google Maps API Key', 'easy-real-estate' ); ?></label>
                </th>
                <td>
                    <input name="inspiry_google_maps_api_key" type="text" id="inspiry_google_maps_api_key" value="<?php echo esc_attr( $inspiry_google_maps_api_key ); ?>" class="regular-text code">
                    <p class="description">
                        <a href="https://realhomes.io/documentation/google-maps-setup/" target="_blank"><?php esc_html_e( 'How to get Google Maps API Key?', 'easy-real-estate' ); ?></a>
                    </p>
                </td>
            </tr>
            <tr class="map-service-wrap googlemaps">
                <th scope="row"><?php esc_html_e( 'Localize Google Maps', 'easy-real-estate' ); ?></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text">
                            <span><?php esc_html_e( 'Localize Google Maps', 'easy-real-estate' ); ?></span></legend>
                        <label>
                            <input type="radio" name="theme_map_localization" value="true" <?php checked( $theme_map_localization, 'true' ) ?>>
                            <span><?php esc_html_e( 'Yes', 'easy-real-estate' ); ?></span>
                        </label>
                        <br>
                        <label>
                            <input type="radio" name="theme_map_localization" value="false" <?php checked( $theme_map_localization, 'false' ) ?>>
                            <span><?php esc_html_e( 'No', 'easy-real-estate' ); ?></span>
                        </label>
                    </fieldset>
                </td>
            </tr>
            <tr class="map-service-wrap googlemaps">
                <th scope="row"><?php esc_html_e( 'Google Map Type', 'easy-real-estate' ); ?></th>
                <td>
                    <select name="ere_google_map_type" id="ere_google_map_type">
                        <option value="roadmap"<?php selected( $ere_google_map_type, 'roadmap' ); ?>><?php esc_html_e( 'RoadMap', 'easy-real-estate' ); ?></option>
                        <option value="satellite"<?php selected( $ere_google_map_type, 'satellite' ); ?>><?php esc_html_e( 'Satellite', 'easy-real-estate' ); ?></option>
                        <option value="hybrid"<?php selected( $ere_google_map_type, 'hybrid' ); ?>><?php esc_html_e( 'Hybrid', 'easy-real-estate' ); ?></option>
                        <option value="terrain"<?php selected( $ere_google_map_type, 'terrain' ); ?>><?php esc_html_e( 'Terrain', 'easy-real-estate' ); ?></option>
                    </select>
                </td>
            </tr>
            <tr class="map-service-wrap googlemaps">
                <th scope="row">
                    <label for="inspiry_google_maps_styles"><?php esc_html_e( 'Google Maps Styles JSON (optional)', 'easy-real-estate' ); ?></label>
                </th>
                <td>
                    <textarea name="inspiry_google_maps_styles" id="inspiry_google_maps_styles" rows="6" cols="40" class="code"><?php echo stripslashes( $inspiry_google_maps_styles ); ?></textarea>
                    <p class="description"><?php printf( esc_html__( 'You can create Google Maps styles JSON using %s Google Styling Wizard %s or %s Snazzy Maps %s.', 'easy-real-estate' ), '<a href="https://mapstyle.withgoogle.com/" target="_blank">', '</a>', '<a href="https://snazzymaps.com/" target="_blank">', '</a>' ); ?></p>
                </td>
            </tr>

            <!-- MapBox API key option -->
            <tr class="map-service-wrap mapbox">
                <th scope="row">
                    <label for="ere_mapbox_api_key"><?php esc_html_e( 'MapBox API Key', 'easy-real-estate' ); ?></label>
                </th>
                <td>
                    <input name="ere_mapbox_api_key" type="text" id="ere_mapbox_api_key" value="<?php echo esc_attr( $ere_mapbox_api_key ); ?>" class="regular-text code">
                    <p class="description">
                        <a href="https://realhomes.io/documentation/mapbox-setup/" target="_blank"><?php esc_html_e( 'How to get MapBox API Key?', 'easy-real-estate' ); ?></a>
                    </p>
                </td>
            </tr>

            <!-- MapBox map style option -->
            <tr class="map-service-wrap mapbox">
                <th scope="row">
                    <label for="ere_mapbox_style"><?php esc_html_e( 'Mapbox Style', 'easy-real-estate' ); ?></label>
                </th>
                <td>
                    <select name="ere_mapbox_style" id="ere_mapbox_style">
						<?php
						foreach ( $mapbox_styles as $style => $url ) {
							?>
                            <option value="<?php echo esc_attr( $url ); ?>" <?php selected( $url, $ere_mapbox_style ); ?>><?php echo esc_html( $style ); ?></option>
							<?php
						}
						?>
                    </select>
                </td>
            </tr>

            <!-- General Map Options -->
            <tr style="border-top: 1px solid #dddddd;">
                <th scope="row">
                    <label for="theme_submit_default_address"><?php esc_html_e( 'Default Address for New Property', 'easy-real-estate' ); ?></label>
                </th>
                <td>
                    <textarea name="theme_submit_default_address" id="theme_submit_default_address" rows="3" cols="40" class="code"><?php echo stripslashes( $theme_submit_default_address ); ?></textarea>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="theme_submit_default_location"><?php esc_html_e( 'Default Map Location for New Property (Latitude,Longitude)', 'easy-real-estate' ); ?></label>
                </th>
                <td>
                    <input name="theme_submit_default_location" type="text" id="theme_submit_default_location" value="<?php echo esc_attr( $theme_submit_default_location ); ?>" class="regular-text code">
                    <p class="description"><?php printf( esc_html__( 'You can use %s OR %s to get Latitude and longitude of your desired location.', 'easy-real-estate' ), '<a href="http://www.latlong.net/" target="_blank">latlong.net</a>', '<a href="https://getlatlong.net/" target="_blank">getlatlong.net</a>' ); ?></p>
                </td>
            </tr>
            <tr style="border-top: 1px solid #dddddd;">
                <th scope="row">
                    <label for="inspiry_properties_map_default_location"><?php esc_html_e( 'Default Properties Map Location (Latitude,Longitude)', 'easy-real-estate' ); ?></label>
                </th>
                <td>
                    <input name="inspiry_properties_map_default_location" type="text" id="inspiry_properties_map_default_location" value="<?php echo esc_attr( $properties_map_default_location ); ?>" class="regular-text code">
                    <p class="description"><?php printf( esc_html__( 'You can use %s OR %s to get Latitude and longitude of your desired location.', 'easy-real-estate' ), '<a href="http://www.latlong.net/" target="_blank">latlong.net</a>', '<a href="https://getlatlong.net/" target="_blank">getlatlong.net</a>' ); ?></p>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="submit">
			<?php wp_nonce_field( 'inspiry_ere_settings' ); ?>
            <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php esc_attr_e( 'Save Changes', 'easy-real-estate' ); ?>">
        </div>
    </form>

</div>