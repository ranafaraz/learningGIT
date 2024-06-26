<?php
$inspiry_property_label = '';
$inspiry_property_label_color = '';

if ( realhomes_dashboard_edit_property() ) {
	global $post_meta_data;

	if ( isset( $post_meta_data['inspiry_property_label'] ) ) {
		$inspiry_property_label = $post_meta_data['inspiry_property_label'][0];
	}

	if ( isset( $post_meta_data['inspiry_property_label_color'] ) ) {
		$inspiry_property_label_color = $post_meta_data['inspiry_property_label_color'][0];
	}
}

$property_label_text = get_option( 'realhomes_submit_property_label_text' );
if ( empty( $property_label_text ) ) {
	$property_label_text = esc_html__( 'Property Label Text', 'framework' );
}

$property_label_text_sub = get_option( 'realhomes_submit_property_label_text_sub' );
if ( empty( $property_label_text_sub ) ) {
	$property_label_text_sub = esc_html__( 'You can add a property label to display on property thumbnails. Example: Hot Deal', 'framework' );
}

$property_label_bg_text = get_option( 'realhomes_submit_property_label_bg_color' );
if ( empty( $property_label_bg_text ) ) {
	$property_label_bg_text = esc_html__( 'Label Background Color', 'framework' );
}

$property_label_bg_sub = get_option( 'realhomes_submit_property_label_bg_sub' );
if ( empty( $property_label_bg_sub ) ) {
	$property_label_bg_sub = esc_html__( 'Set a label background color. Otherwise label text will be displayed with transparent background.', 'framework' );
}

?>
<div class="col-md-6">
	<p>
		<label for="inspiry_property_label"><?php echo esc_html( $property_label_text ); ?></label>
		<input id="inspiry_property_label" name="inspiry_property_label" type="text" value="<?php echo esc_attr( $inspiry_property_label ); ?>" />
		<span class="note"><?php echo esc_html( $property_label_text_sub ); ?></span>
	</p>
</div>
<div class="col-md-6">
	<div class="field-wrap">
		<label for="inspiry_property_label_color"><?php echo esc_html( $property_label_bg_text ); ?></label>
        <div class="dashboard-color-picker">
            <input id="inspiry_property_label_color" name="inspiry_property_label_color" type="text" value="<?php echo esc_attr( $inspiry_property_label_color ); ?>" />
        </div>
		<span class="note"><?php echo esc_html( $property_label_bg_sub ); ?></span>
	</div>
</div>