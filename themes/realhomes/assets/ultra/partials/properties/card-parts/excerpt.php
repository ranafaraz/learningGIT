<?php

$theme_listing_excerpt_length = get_option( 'theme_listing_excerpt_length' );

if ( ! empty( $theme_listing_excerpt_length ) && ( 0 < $theme_listing_excerpt_length ) ) {
	$card_excerpt = $theme_listing_excerpt_length;
} else {
	$card_excerpt = 10;
}

if ( ! empty( rhea_get_framework_excerpt() ) ) {
	?>
    <p class="rh-ultra-property-excerpt"><?php rhea_framework_excerpt( esc_html( $card_excerpt ) ); ?></p>

	<?php
}