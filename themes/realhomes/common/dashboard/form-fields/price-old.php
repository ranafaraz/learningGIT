<?php
/**
 * Field: OldPrice
 *
 * @since 	3.12
 * @package realhomes/dashboard
 */
$property_old_price_label = get_option( 'realhomes_submit_property_old_price_label' );
if ( empty( $property_old_price_label ) ) {
	$property_old_price_label = esc_html__( 'Old Price', 'framework' );
}
?>
<p>
	<label for="price"><?php echo esc_html( $property_old_price_label ); ?> <span><?php esc_html_e( '( If Any )', 'framework' ); ?></span></label>
	<input id="old-price" name="old-price" type="text" value="<?php
	if ( realhomes_dashboard_edit_property() ) {
	    global $post_meta_data;
	    if ( isset( $post_meta_data['REAL_HOMES_property_old_price'] ) ) {
	        echo esc_attr( $post_meta_data['REAL_HOMES_property_old_price'][0] );
	    }
	}
	?>" title="<?php esc_attr_e( '* Please provide the value in digits only!', 'framework' ); ?>"/>
</p>