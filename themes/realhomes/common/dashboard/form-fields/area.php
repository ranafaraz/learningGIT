<?php
/**
 * Field: Area
 *
 * @since 	3.0.0
 * @package realhomes/dashboard
 */
$property_area_label = get_option( 'realhomes_submit_property_area_label' );
if ( empty( $property_area_label ) ) {
	$property_area_label = esc_html__( 'Area', 'framework' );
}
?>

<p>
	<label for="size"><?php echo esc_html( $property_area_label ); ?></label>
	<input id="size" name="size" type="text" value="<?php
	if ( realhomes_dashboard_edit_property() ) {
	    global $post_meta_data;
	    if ( isset( $post_meta_data['REAL_HOMES_property_size'] ) ) {
	        echo esc_attr( $post_meta_data['REAL_HOMES_property_size'][0] );
	    }
	}
	?>" title="<?php esc_attr_e( '* Please provide the value in digits only!', 'framework' ); ?>"/>

</p>