<?php
/**
 * Google Map
 *
 * @since 	3.0.0
 * @package realhomes/dashboard
 */
$property_address_label = get_option( 'realhomes_submit_property_address_label' );
$find_address_btn_label = get_option( 'realhomes_submit_property_find_address_label' );

if ( empty( $property_address_label ) ) {
	$property_address_label = esc_html__( 'Address', 'framework' );
}

if ( empty( $find_address_btn_label ) ) {
	$find_address_btn_label = esc_html__( 'Find Address', 'framework' );
}

if ( realhomes_dashboard_edit_property() ) {
	global $post_meta_data; ?>
	<div class="address-map-fields-wrapper">
		<?php
		$property_address = '';
	    if ( isset( $post_meta_data['REAL_HOMES_property_address'] ) && ! empty( $post_meta_data['REAL_HOMES_property_address'][0] ) ) {
	        $property_address = $post_meta_data['REAL_HOMES_property_address'][0];
	    } else {
	        $property_address = get_option( 'theme_submit_default_address' );
	    }

		$property_location = '';
		if ( isset( $post_meta_data['REAL_HOMES_property_location'] ) && ! empty( $post_meta_data['REAL_HOMES_property_location'][0] ) ) {
		    $property_location = $post_meta_data['REAL_HOMES_property_location'][0];
		} else {
		    $property_location = get_option( 'theme_submit_default_location' );
		} ?>
		<div class="map-wrapper">
            <div id="map-address-field-wrapper" class="address-wrapper">
                <label for="address"><?php echo esc_html( $property_address_label ); ?></label>
                <input type="text" class="required" name="address" id="address" value="<?php echo esc_attr( $property_address ); ?>" title="<?php esc_attr_e( '* Please provide a property address!', 'framework' ); ?>" />
                <button class="btn btn-primary goto-address-button" type="button" value="address"><?php echo esc_html( $find_address_btn_label ); ?></button>
            </div>
			<div class="map-canvas"></div>
			<input type="hidden" name="coordinates" class="map-coordinate" value="<?php echo esc_attr( $property_location ); ?>" />
		</div>
	</div>
	<?php
} else {
	?>
	<div class="address-map-fields-wrapper">
		<div class="map-wrapper">
            <div id="map-address-field-wrapper" class="address-wrapper">
                <label for="address"><?php echo esc_html( $property_address_label ); ?></label>
                <input type="text" class="required map-address" name="address" id="address" value="<?php echo esc_attr( get_option( 'theme_submit_default_address' ) ); ?>" title="<?php esc_attr_e( '* Please provide a property address!', 'framework' ); ?>" />
                <button class="btn btn-primary goto-address-button" type="button" value="address"><?php echo esc_html( $find_address_btn_label ); ?></button>
            </div>
            <div class="map-canvas"></div>
			<input type="hidden" name="coordinates" class="map-coordinate" value="<?php echo esc_attr( get_option( 'theme_submit_default_location' ) ); ?>" />
		</div>
	</div>
	<?php
}