<?php
/**
 * Field: Description
 *
 * @since 	3.0.0
 * @package realhomes/dashboard
 */
$property_description_label = get_option( 'realhomes_submit_property_description_label' );
if ( empty( $property_description_label ) ) {
	$property_description_label = esc_html__( 'Property Description', 'framework' );
}
?>
<label for="description"><?php echo esc_html( $property_description_label ); ?></label>
<?php
$editor_id       = 'description';
$editor_settings = array(
    'media_buttons' => false,
    'textarea_rows' => 8,
);
if ( realhomes_dashboard_edit_property() ) {
    global $target_property;
    wp_editor( $target_property->post_content, $editor_id, $editor_settings );
} else {
    wp_editor( '', $editor_id, $editor_settings );
}
?>