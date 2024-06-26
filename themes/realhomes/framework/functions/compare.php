<?php
if ( ! function_exists( 'inspiry_add_to_compare_button' ) ) {
	/**
	 * Display add to compare button markup.
	 *
	 * @since 2.6.0
	 *
	 * @param string $add_to_compare_label   Add to compare tooltip label.
	 * @param string $added_to_compare_label Added to compare tooltip label.
	 * @param string $design_variation       RealHomes design variation name i.e classic,modern,ultra
	 */
	function inspiry_add_to_compare_button( $add_to_compare_label = '', $added_to_compare_label = '', $design_variation = '' ) {
		$compare_properties_module = get_option( 'theme_compare_properties_module' );
		$inspiry_compare_page      = get_option( 'inspiry_compare_page' );
		if ( ( 'enable' === $compare_properties_module ) && ( $inspiry_compare_page ) ) {

			$property_id      = get_the_ID();
			$property_img_url = get_the_post_thumbnail_url( $property_id, 'property-thumb-image' );
			if ( empty( $property_img_url ) ) {
				$property_img_url = get_inspiry_image_placeholder_url( 'property-thumb-image' );
			}

			$add_to_compare_tooltip = esc_attr__( 'Add to compare', 'framework' );;
			if ( ! empty( $add_to_compare_label ) ) {
				$add_to_compare_tooltip = $add_to_compare_label;
			}

			$added_to_compare_tooltip = esc_attr__( 'Added to compare', 'framework' );
			if ( ! empty( $added_to_compare_label ) ) {
				$added_to_compare_tooltip = $added_to_compare_label;
			}

			$realhomes_design_varition = INSPIRY_DESIGN_VARIATION;
			if ( ! empty( $design_variation ) ) {
				$realhomes_design_varition = $design_variation;
			}

			if ( 'ultra' === $realhomes_design_varition ) {
				?>
                <span class="add-to-compare-span compare-btn-<?php echo esc_attr( $property_id ); ?>" data-property-id="<?php echo esc_attr( $property_id ); ?>" data-property-title="<?php echo esc_attr( get_the_title( $property_id ) ); ?>" data-property-url="<?php echo esc_url( get_the_permalink( $property_id ) ); ?>" data-property-image="<?php echo esc_url( $property_img_url ); ?>">
					<span class="compare-placeholder highlight hide rh-ui-tooltip" title="<?php echo esc_attr( $added_to_compare_tooltip ) ?>">
						<?php inspiry_safe_include_svg( '/ultra/icons/ultra-compare.svg', '/assets/' ); ?>
					</span>
					<a class="rh_trigger_compare add-to-compare rh-ui-tooltip" href="<?php echo esc_url( get_the_permalink( $property_id ) ); ?>" title="<?php echo esc_attr( $add_to_compare_tooltip ) ?>">
						<?php inspiry_safe_include_svg( '/ultra/icons/ultra-compare.svg', '/assets/' ); ?>
					</a>
				</span>
				<?php

			} else if ( 'modern' === $realhomes_design_varition ) {
				?>
                <span class="add-to-compare-span compare-btn-<?php echo esc_attr( $property_id ); ?>" data-property-id="<?php echo esc_attr( $property_id ); ?>" data-property-title="<?php echo esc_attr( get_the_title( $property_id ) ); ?>" data-property-url="<?php echo esc_url( get_the_permalink( $property_id ) ); ?>" data-property-image="<?php echo esc_url( $property_img_url ); ?>">
					<span class="compare-placeholder highlight hide" data-tooltip="<?php echo esc_attr( $added_to_compare_tooltip ) ?>">
						<?php inspiry_safe_include_svg( '/images/icons/icon-compare.svg' ); ?>
					</span>
					<a class="rh_trigger_compare add-to-compare" href="<?php echo esc_url( get_the_permalink( $property_id ) ); ?>" data-tooltip="<?php echo esc_attr( $add_to_compare_tooltip ) ?>">
						<?php inspiry_safe_include_svg( '/images/icons/icon-compare.svg' ); ?>
					</a>
				</span>
				<?php
			} else {
				?>
                <span class="add-to-compare-span compare-btn-<?php echo esc_attr( $property_id ); ?>" data-property-id="<?php echo esc_attr( $property_id ); ?>" data-property-title="<?php echo esc_attr( get_the_title( $property_id ) ); ?>" data-property-url="<?php echo esc_url( get_the_permalink( $property_id ) ); ?>" data-property-image="<?php echo esc_url( $property_img_url ); ?>">
					<i class="rh_added_to_compare compare-placeholder highlight hide">
						<i class="rh_classic_icon_atc fas fa-plus-circle dim"></i> <i class="rh_classic_added"><?php echo esc_attr( $added_to_compare_tooltip ) ?></i>
					</i>
					<a class="rh_trigger_compare add-to-compare" href="<?php echo esc_url( get_the_permalink( $property_id ) ); ?>">
						<i class="rh_classic_icon_atc fas fa-plus-circle"></i>
						<span class="rh_classic_atc"><?php echo esc_attr( $add_to_compare_tooltip ) ?></span>
					</a>
				</span>
				<?php
			}
		}
	}
}

if ( ! function_exists( 'realhomes_get_comparable_property_fields' ) ) {
	/**
	 * Returns the list of comparable property fields.
	 *
	 * @since 4.0.2
	 *
	 * @return array
	 */
	function realhomes_get_comparable_property_fields() {

		return array(
			'thumbnail'         => esc_html__( 'Thumbnail', 'framework' ),
			'title'             => esc_html__( 'Title', 'framework' ),
			'status'            => esc_html__( 'Status', 'framework' ),
			'price'             => esc_html__( 'Price', 'framework' ),
			'type'              => esc_html__( 'Type', 'framework' ),
			'location'          => esc_html__( 'Location', 'framework' ),
			'lot-size'          => esc_html__( 'Lot Size', 'framework' ),
			'property-size'     => esc_html__( 'Property Size', 'framework' ),
			'property-id'       => esc_html__( 'Property ID', 'framework' ),
			'year-built'        => esc_html__( 'Year Built', 'framework' ),
			'bedrooms'          => esc_html__( 'Bedrooms', 'framework' ),
			'bathrooms'         => esc_html__( 'Bathrooms', 'framework' ),
			'garages'           => esc_html__( 'Garages', 'framework' ),
			'features'          => esc_html__( 'Features', 'framework' ),
			'additional-fields' => esc_html__( 'Additional Fields', 'framework' ),
		);
	}
}