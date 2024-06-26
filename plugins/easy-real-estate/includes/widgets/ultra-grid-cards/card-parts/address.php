<?php
$REAL_HOMES_property_address = get_post_meta( get_the_ID(), 'REAL_HOMES_property_address', true );

if ( isset( $REAL_HOMES_property_address ) && ! empty( $REAL_HOMES_property_address ) ) {

	// triggering related scripts function
	do_action( 'realhomes_enqueue_map_lightbox_essentials' );
	?>
    <div class="rh-address-ultra">
        <a <?php rh_lightbox_data_attributes( '', get_the_ID() ) ?> href="<?php the_permalink(); ?>">
            <span class="rh-ultra-address-pin">
                <?php inspiry_safe_include_svg( '/ultra/icons/pin-line.svg', '/assets/' ); ?>
            </span>
			<?php echo esc_html( $REAL_HOMES_property_address ); ?>
        </a>
    </div>
	<?php
}