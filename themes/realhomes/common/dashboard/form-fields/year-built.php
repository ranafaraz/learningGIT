<?php
/**
 * Field: Year Built
 *
 * @since 3.3.0
 * @package realhomes/dashboard
 */

$property_year_built_label = get_option( 'realhomes_submit_property_year_built_label' );

if ( empty( $property_year_built_label ) ) {
	$property_year_built_label = esc_html__( 'Year Built', 'framework' );
}

if ( realhomes_dashboard_edit_property() ) {
	global $post_meta_data;
	if ( isset( $post_meta_data['REAL_HOMES_property_year_built'] ) ) {
		$year_built = $post_meta_data['REAL_HOMES_property_year_built'][0];
	}
}
?>
<p>
    <label for="year-built"><?php echo esc_html( $property_year_built_label ) ?></label>
    <input id="year-built" name="year-built" type="text" value="<?php echo ( ! empty( $year_built ) ) ? esc_attr( $year_built ) : false; ?>"
           title="<?php esc_attr_e( 'Year Built', 'framework' ); ?>"/>
</p>

