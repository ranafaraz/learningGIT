<?php
/**
 * Field: Price
 *
 * @since 	3.0.0
 * @package realhomes/dashboard
 */
$property_price_label = get_option( 'realhomes_submit_property_price_label' );
if ( empty( $property_price_label ) ) {
	$property_price_label = esc_html__( 'Sale or Rent Price', 'framework' );
}
?>
<p>
	<label for="price"><?php echo esc_html( $property_price_label ); ?></label>
	<input id="price" name="price" type="text" value="<?php
	if ( realhomes_dashboard_edit_property() ) {
	    global $post_meta_data;
	    if ( isset( $post_meta_data['REAL_HOMES_property_price'] ) ) {
	        echo esc_attr( $post_meta_data['REAL_HOMES_property_price'][0] );
	    }
	}
	?>" title="<?php esc_attr_e( '* Please provide the value in digits only!', 'framework' ); ?>"/>
</p>