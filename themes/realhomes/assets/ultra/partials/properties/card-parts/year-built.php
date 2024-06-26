<?php
$REAL_HOMES_property_year_built = get_post_meta( get_the_ID(), 'REAL_HOMES_property_year_built', true );
if ( ! empty( $REAL_HOMES_property_year_built ) ) {
	$inspiry_year_built_field_label = get_option( 'inspiry_year_built_field_label' );
	if ( ! empty( $inspiry_year_built_field_label ) ) {
		$build_label = $inspiry_year_built_field_label;
	} else {
		$build_label = esc_html__( 'Build', 'framework' );
	}
	?>
    <div class="rh-ultra-year-built">
		<?php
		echo esc_html( $build_label ) . ' ' . esc_html( $REAL_HOMES_property_year_built );
		?>
    </div>
	<?php
}
?>