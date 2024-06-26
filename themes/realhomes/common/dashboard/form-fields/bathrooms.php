<?php
/**
 * Field: Bathrooms
 *
 * @since 	3.0.0
 * @package realhomes/dashboard
 */

$property_bathrooms_label = get_option( 'realhomes_submit_property_bathroom_label' );
if ( empty( $property_bathrooms_label ) ) {
	$property_bathrooms_label = esc_html__( 'Bathrooms', 'framework' );
}
?>
<p>
	<label for="bathrooms"><?php echo esc_html( $property_bathrooms_label ); ?></label>
	<input id="bathrooms" name="bathrooms" type="text" value="<?php
	if ( realhomes_dashboard_edit_property() ) {
	    global $post_meta_data;
	    if ( isset( $post_meta_data['REAL_HOMES_property_bathrooms'] ) ) {
	        echo esc_attr( $post_meta_data['REAL_HOMES_property_bathrooms'][0] );
	    }
	}
	?>" title="<?php esc_attr_e( '* Please provide the value in digits only!', 'framework' ); ?>"/>
</p>
