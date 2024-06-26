<?php
global $settings;
?>
<div class="rhea_fp_price_status">
	<?php
		if ( function_exists( 'ere_get_property_statuses' ) && ! empty( ere_get_property_statuses( get_the_ID() ) ) ) { ?>
            <span class="rhea_fp_status"><?php echo esc_html( ere_get_property_statuses( get_the_ID() ) ); ?></span>
			<?php
		}
	if ( ! empty( ere_get_property_price() ) ) {
		?>
        <p class="rhea_fp_price">
			<?php
			if ( function_exists( 'ere_property_price' ) ) {
				if ( ! empty( $settings['rhea_show_old_price'] ) && 'yes' === $settings['rhea_show_old_price'] ) {
					ere_property_price( get_the_ID(), true );
				} else {
					ere_property_price();
				}
			}
			?>
        </p>
		<?php
	}
	?>
</div>