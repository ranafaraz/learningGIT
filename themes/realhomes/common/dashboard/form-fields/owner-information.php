<?php
$property_owner_name_label    = get_option( 'realhomes_submit_property_owner_name_label' );
$property_owner_contact_label = get_option( 'realhomes_submit_property_owner_contact_label' );
$property_owner_address_label = get_option( 'realhomes_submit_property_owner_address_label' );

if ( empty( $property_owner_name_label ) ) {
	$property_owner_name_label = esc_html__( 'Property Owner Name', 'framework' );
}

if ( empty( $property_owner_contact_label ) ) {
	$property_owner_contact_label = esc_html__( 'Owner Contact', 'framework' );
}

if ( empty( $property_owner_address_label ) ) {
	$property_owner_address_label = esc_html__( 'Owner Address', 'framework' );
}

$inspiry_property_owner_name    = '';
$inspiry_property_owner_contact = '';
$inspiry_property_owner_address = '';

if ( realhomes_dashboard_edit_property() ) {
	global $post_meta_data;

	if ( isset( $post_meta_data['inspiry_property_owner_name'] ) ) {
		$inspiry_property_owner_name = $post_meta_data['inspiry_property_owner_name'][0];
	}

	if ( isset( $post_meta_data['inspiry_property_owner_contact'] ) ) {
		$inspiry_property_owner_contact = $post_meta_data['inspiry_property_owner_contact'][0];
	}

	if ( isset( $post_meta_data['inspiry_property_owner_address'] ) ) {
		$inspiry_property_owner_address = $post_meta_data['inspiry_property_owner_address'][0];
	}
}
?>
<div class="col-md-6 col-lg-3">
	<p>
		<label for="inspiry_property_owner_name"><?php echo esc_html( $property_owner_name_label ); ?></label>
		<input id="inspiry_property_owner_name" name="inspiry_property_owner_name" type="text" value="<?php echo esc_attr( $inspiry_property_owner_name ); ?>" />
	</p>
</div>
<div class="col-md-6 col-lg-3">
	<p>
		<label for="inspiry_property_owner_contact"><?php echo esc_html( $property_owner_contact_label ); ?></label>
		<input id="inspiry_property_owner_contact" name="inspiry_property_owner_contact" type="text" value="<?php echo esc_attr( $inspiry_property_owner_contact ); ?>" />
	</p>
</div>
<div class="col-md-6 col-lg-6">
	<p>
		<label for="inspiry_property_owner_address"><?php echo esc_html( $property_owner_address_label ); ?></label>
		<input id="inspiry_property_owner_address" name="inspiry_property_owner_address" type="text" value="<?php echo esc_attr( $inspiry_property_owner_address ); ?>" />
	</p>
</div>