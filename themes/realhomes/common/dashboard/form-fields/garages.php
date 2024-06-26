<?php
/**
 * Field: Garages
 *
 * @since 	3.0.0
 * @package realhomes/dashboard
 */
$property_garage_label = get_option( 'realhomes_submit_property_garage_label' );
if ( empty( $property_garage_label ) ) {
	$property_garage_label = esc_html__( 'Garages or Parking Spaces', 'framework' );
}
?>
<p>
	<label for="garages"><?php echo esc_html( $property_garage_label ); ?></label>
	<input id="garages" name="garages" type="text" value="<?php
	if ( realhomes_dashboard_edit_property() ) {
	    global $post_meta_data;
	    if ( isset( $post_meta_data['REAL_HOMES_property_garage'] ) ) {
	        echo esc_attr( $post_meta_data['REAL_HOMES_property_garage'][0] );
	    }
	}
	?>" title="<?php esc_attr_e( '* Please provide the value in digits only!', 'framework' ); ?>"/>
</p>