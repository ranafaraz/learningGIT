<?php
global $settings;
global $widget_id;

$show_address = $settings['show_address'];

if ( 'yes' == $show_address ) {
	$REAL_HOMES_property_address = get_post_meta( get_the_ID(), 'REAL_HOMES_property_address', true );

	// triggering related scripts function
	do_action( 'realhomes_enqueue_map_lightbox_essentials' );

	if ( isset( $REAL_HOMES_property_address ) && ! empty( $REAL_HOMES_property_address ) ) {
		?>
        <div class="rhea_address_ultra">
            <a <?php rhea_lightbox_data_attributes( $widget_id, get_the_ID() ) ?> href="<?php the_permalink(); ?>">
                <span class="rhea_ultra_address_pin"><?php include RHEA_ASSETS_DIR . 'icons/pin-line.svg'; ?></span>
				<?php echo esc_html( $REAL_HOMES_property_address ); ?>
            </a>
        </div>
		<?php
	}
}

