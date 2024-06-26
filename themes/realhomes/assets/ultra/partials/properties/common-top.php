<?php
/**
 * Common top par for grid and list files.
 */

/*
 * Skip sticky properties.
 */
if ( function_exists( 'ere_skip_sticky_properties' ) ) {
	ere_skip_sticky_properties();
}

/*
 * List page module
 */
if ( 'properties-map' === get_option( 'theme_listing_module' ) ) {
	?>
    <div class="rh-ultra-properties-map ">
		<?php
		get_template_part( 'assets/ultra/partials/properties/map' );
		?>
    </div>
	<?php
}
