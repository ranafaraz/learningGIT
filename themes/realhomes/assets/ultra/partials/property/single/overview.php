<div class="rh-ultra-overview-box">
	<h4 class="rh_property__heading">
		<?php
		$inspiry_overview_property_label = get_option('inspiry_overview_property_label');
		if ($inspiry_overview_property_label) {
			echo esc_html($inspiry_overview_property_label);
		} else {
			esc_html_e('Overview', 'framework');
		}
		?>
	</h4>
	<?php
	/*
	 $property_id = get_post_meta( get_the_ID(), 'REAL_HOMES_property_id', true );
	 if ( ! empty( $property_id ) ) {
		 ?>
				 <span class="rh-overview-separator">|</span>
				 <div class="rh-property-id">
				 <span>
						 <?php
						 $inspiry_prop_id_field_label = get_option( 'inspiry_prop_id_field_label' );
						 if ( $inspiry_prop_id_field_label ) {
							 echo esc_html( $inspiry_prop_id_field_label );
						 } else {
							 esc_html_e( 'Property ID :', 'framework' );
						 }
						 ?>
				 </span>
						 <span><?php echo esc_html( $property_id ); ?></span>
				 </div>
		 <?php
	 }
		 */
	?>
</div>