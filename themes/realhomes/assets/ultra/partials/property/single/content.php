<div class="rh-content-wrapper <?php realhomes_printable_section( 'content' ); ?>">
	<?php
	if ( get_the_content() ) {
		?>
        <h4 class="rh_property__heading"><?php
			$inspiry_description_property_label = get_option( 'inspiry_description_property_label' );
			if ( $inspiry_description_property_label ) {
				echo esc_html( $inspiry_description_property_label );
			} else {
				esc_html_e( 'Description', 'framework' );
			}
			?>
        </h4>
        <div class="rh_content margin-bottom-40px">
			<?php
			the_content();
			?>
        </div>
		<?php
	}
	?>
</div>