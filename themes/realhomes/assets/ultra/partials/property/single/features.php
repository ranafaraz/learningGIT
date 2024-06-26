<?php
/**
 * Property features of single property.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

/* Property Features */
$features_terms = get_the_terms( get_the_ID(), 'property-feature' );
if ( ! empty( $features_terms ) ) {
	?>
    <div class="rh_property__features_wrap margin-bottom-40px <?php realhomes_printable_section( 'features' ); ?>">
		<?php
		$property_features_title = get_option( 'theme_property_features_title' );
		if ( ! empty( $property_features_title ) ) {
			?><h4 class="rh_property__heading"><?php echo esc_html( $property_features_title ); ?></h4><?php
		}
		$rh_property_features_display = get_option( 'inspiry_property_features_display', 'link' );
		?>
        <ul class="rh_property__features arrow-bullet-list">
			<?php
			foreach ( $features_terms as $feature_term ) {
				$feature = $feature_term->name;
				echo '<li class="rh_property__feature" id="rh_property__feature_' . esc_attr( $feature_term->term_id ) . '">';

				$feature_icon_id = get_term_meta( $feature_term->term_id, 'inspiry_property_feature_icon', true );
				$feature_icon    = ! empty( $feature_icon_id ) ? wp_get_attachment_url( $feature_icon_id ) : false;
				if ( $feature_icon ) {
					if ( preg_match( '/\.svg$/', $feature_icon ) === 1 ) {
						// Download SVG content.
						$svg_file = wp_remote_get( $feature_icon );
						if ( is_array( $svg_file ) && ! is_wp_error( $svg_file ) ) {
							$svg_content = wp_remote_retrieve_body( $svg_file );

							$svg_class = 'property-feature-icon property-feature-icon-svg';
							if ( preg_match( '/<svg[^>]*\bclass\s*=\s*["\'](.*?)["\'][^>]*>/', $svg_content ) ) {
								$svg_content = str_replace( '<svg class="', '<svg class="' . $svg_class . ' ', $svg_content );
							} else {
								$svg_content = str_replace( '<svg', '<svg class="' . $svg_class . '"', $svg_content );
							}

							$sanitized_svg = ( new RealHomes_Sanitize_Svg() )->sanitize( $svg_content );
							if ( false !== $sanitized_svg ) {
								echo $sanitized_svg;
							} else {
								inspiry_safe_include_svg( '/ultra/icons/done.svg', '/assets/' );
							}
						}

					} else {
						echo '<img class="property-feature-icon property-feature-icon-image" src="' . esc_url( $feature_icon ) . '" alt="' . esc_attr( $feature ) . '">';
					}

				} else {
					inspiry_safe_include_svg( '/ultra/icons/done.svg', '/assets/' );
				}

				if ( 'link' === $rh_property_features_display ) {
					echo '<a href="' . esc_url( get_term_link( $feature_term->slug, 'property-feature' ) ) . '">' . esc_html( $feature_term->name ) . '</a>';
				} else {
					echo esc_html( $feature_term->name );
				}
				echo '</li>';
			}
			?>
        </ul>
    </div>
	<?php
}

/**
 * Display RVR related contents if it's enabled.
 */
if ( inspiry_is_rvr_enabled() ) {
	/*
	 * RVR - Property Outdoor Features.
	 */

	?>

    <div class="rh_wrapper_rvr_features <?php realhomes_printable_section( 'features' ); ?>">

		<?php
		$location_surroundings = get_post_meta( get_the_ID(), 'rvr_surroundings', true );
		$rvr_outdoor_features  = get_post_meta( get_the_ID(), 'rvr_outdoor_features', true );
		if ( ! empty( $location_surroundings ) || ! empty( $rvr_outdoor_features ) ) {
			?>
            <div class="rh_rvr_alternate_wrapper rh_outdoor_and_surroundings">
				<?php
				get_template_part( 'assets/modern/partials/property/single/rvr/location-surroundings' );
				get_template_part( 'assets/ultra/partials/property/single/rvr/outdoor-features' );

				?>
            </div>
			<?php
		}
		/*
		 * RVR - Property Optional Services.
		 */
		get_template_part( 'assets/ultra/partials/property/single/rvr/optional-services' );

		/*
		 * RVR - Property Property Policies.
		 */
		get_template_part( 'assets/modern/partials/property/single/rvr/property-policies' );

		/*
		 * RVR - Property Location Surroundings.
		 */

		?>
    </div>
	<?php
}