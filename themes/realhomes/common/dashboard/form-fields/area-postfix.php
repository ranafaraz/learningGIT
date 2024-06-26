<?php
/**
 * Field: Area Postfix
 *
 * @since 	3.0.0
 * @package realhomes/dashboard
 */
$property_area_postfix_label = get_option( 'realhomes_submit_property_area_postfix_label' );
if ( empty( $property_area_postfix_label ) ) {
	$property_area_postfix_label = esc_html__( 'Area Postfix Text', 'framework' );
}
?>
<p>
	<label for="area-postfix"><?php echo esc_html( $property_area_postfix_label ); ?></label>
	<input id="area-postfix" name="area-postfix" type="text" value="<?php
	if ( realhomes_dashboard_edit_property() ) {
	    global $post_meta_data;
	    if ( isset( $post_meta_data['REAL_HOMES_property_size_postfix'] ) ) {
	        echo esc_attr( $post_meta_data['REAL_HOMES_property_size_postfix'][0] );
	    }
	}
	?>" />
</p>

