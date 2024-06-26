<?php
/**
 * Field: Title
 *
 * @since    3.0.0
 * @package realhomes/dashboard
 */
$property_title_label = get_option( 'realhomes_submit_property_title_label' );
if ( empty( $property_title_label ) ) {
	$property_title_label = esc_html__( 'Property Title', 'framework' );
}
?>
<p>
    <label for="inspiry_property_title"><?php echo esc_html( $property_title_label ); ?></label>
    <input id="inspiry_property_title" name="inspiry_property_title" type="text" class="required" value="<?php
	if ( realhomes_dashboard_edit_property() ) {
		global $target_property;
		echo esc_attr( $target_property->post_title );
	}
	?>" title="<?php esc_attr_e( '* Please provide property title', 'framework' ); ?>" autofocus required/>
</p>