<?php
/**
 * Field: Lot Size
 *
 * @since    3.9.2
 * @package realhomes/dashboard
 */
$property_lot_size_label = get_option( 'realhomes_submit_property_lot_size_label' );
if ( empty( $property_lot_size_label ) ) {
	$property_lot_size_label = esc_html__( 'Lot Size', 'framework' );
}
?>
<p>
    <label for="lot-size"><?php echo esc_html( $property_lot_size_label ); ?></label>
    <input id="lot-size" name="lot-size" type="text" value="<?php
	if ( realhomes_dashboard_edit_property() ) {
		global $post_meta_data;
		if ( isset( $post_meta_data['REAL_HOMES_property_lot_size'] ) ) {
			echo esc_attr( $post_meta_data['REAL_HOMES_property_lot_size'][0] );
		}
	}
	?>" title="<?php esc_attr_e( '* Please provide the value in digits only!', 'framework' ); ?>"/>
</p>