<?php
/**
 * Field: Price Prefix
 *
 * @since 	3.12
 * @package realhomes/dashboard
 */
$property_price_prefix_label = get_option( 'realhomes_submit_property_price_prefix_label' );
if ( empty( $property_price_prefix_label ) ) {
	$property_price_prefix_label = esc_html__( 'Price Prefix Text', 'framework' );
}
?>
<p>
	<label for="price-prefix"><?php echo esc_html( $property_price_prefix_label ); ?> <span><?php esc_html_e( 'Example: Starting Form', 'framework' ); ?></span></label>
	<input id="price-prefix" name="price-prefix" type="text" value="<?php
	if ( realhomes_dashboard_edit_property() ) {
	    global $post_meta_data;
	    if ( isset( $post_meta_data['REAL_HOMES_property_price_prefix'] ) ) {
	        echo esc_attr( $post_meta_data['REAL_HOMES_property_price_prefix'][0] );
	    }
	}
	?>"/>
</p>