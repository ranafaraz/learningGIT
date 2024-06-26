<?php
/**
 * Floor plans of property.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

global $post;
$property_floor_plans = get_post_meta( get_the_ID(), 'inspiry_floor_plans', true );

if ( ! empty( $property_floor_plans ) && is_array( $property_floor_plans ) && ! empty( $property_floor_plans[0]['inspiry_floor_plan_name'] ) ) {
	?>
    <div class="rh_property__floor_plans floor-plans margin-bottom-40px <?php realhomes_printable_section( 'floor-plans' ); ?>">

		<?php
		$inspiry_property_floor_plans_label = get_option( 'inspiry_property_floor_plans_label', esc_html__( 'Floor Plans', 'framework' ) );
		if ( $inspiry_property_floor_plans_label ) : ?>
            <h3 class="rh_property__heading floor-plans-label"><?php echo esc_html( $inspiry_property_floor_plans_label ); ?></h3><?php
		endif;
		?>

        <div class="floor-plans-accordions">
			<?php
			/**
			 * Floor plans contents
			 */
			$tabs   = '';
			$detail = '';

			$meta_to_display = array(
				[
					'id'       => 'inspiry_floor_plan_bedrooms',
					'label'    => esc_html__( 'Bedrooms', 'framework' ),
					'icon'     => 'ultra-bedrooms.svg',
					'post-fix' => ''
				],

				[
					'id'       => 'inspiry_floor_plan_bathrooms',
					'label'    => esc_html__( 'Bathrooms', 'framework' ),
					'icon'     => 'ultra-bathrooms.svg',
					'post-fix' => ''
				],

				[
					'id'       => 'inspiry_floor_plan_size',
					'label'    => esc_html__( 'Size', 'framework' ),
					'icon'     => 'ultra-area.svg',
					'post-fix' => 'inspiry_floor_plan_size_postfix'
				],

			);

			$meta_to_display = apply_filters( 'inspiry_property_floor_plan_meta', $meta_to_display );


			foreach ( $property_floor_plans as $i => $floor ) {

				if ( 1 === $i + 1 ) {
					$current_tab = 'rh-current-tab';
					$active_tab  = 'rh-active-tab';
				} else {
					$current_tab = '';
					$active_tab  = '';
				}

				if ( isset( $floor['inspiry_floor_plan_name'] ) && ! empty( $floor['inspiry_floor_plan_name'] ) ) {
					$tabs .= '<a class="rh-floor-plan-tab ' . $current_tab . '" data-id="tab-' . ( $i + 1 ) . '" href="#">' . esc_html( $floor['inspiry_floor_plan_name'] ) . '</a>';

					$detail .= '<div class="rh-floor-plan ' . $active_tab . '" data-id="tab-' . ( $i + 1 ) . '">';
					$detail .= '<div class="floor-plan-title-price">';
					$detail .= '<h4>' . esc_html( $floor['inspiry_floor_plan_name'] ) . '</h4>';
					if ( ! empty( $floor['inspiry_floor_plan_price'] ) ) {
						$detail .= '<div class="floor-plan-price-wrapper">';
						$detail .= ' <span class="floor-price"> ';
						$detail .= ere_get_property_floor_price($floor);
						$detail .= ' </span> ';
						$detail .= '</div>';
					}
					$detail .= '</div>';
					if ( ! empty( $floor['inspiry_floor_plan_descr'] ) ) {
						$detail .= '<div class="floor-plan-desc">';
						$detail .= apply_filters( 'the_content', $floor['inspiry_floor_plan_descr'] );
						$detail .= '</div>';
					}


					$detail .= ' <div class="floor-plan-meta">';
					foreach ( $meta_to_display as $key => $value ) {


						if ( ! empty( $floor[ $value['id'] ] ) ) {
							$detail .= '<div class="rh-floor-meta">';

							$detail .= '<span class="rh-floor-meta-label">' . esc_html( $value['label'] ) . '</span>';
							$detail .= '<div class="rh-floor-meta-icon">';
							$detail .= file_get_contents( get_theme_file_path( '/assets/ultra/icons/' . $value['icon'] ) );

							if ( isset( $value['post-fix'] ) && ! empty( $value['post-fix'] ) ) {
								$post_fix = $floor[ $value['post-fix'] ];
							} else {
								$post_fix = '';
							}
							$detail .= '<span class="rh-floor-meta-value">' . esc_html( $floor[ $value['id'] ] ) . ' ' . esc_html( $post_fix ) . '</span>';
							$detail .= '</div>';
							$detail .= '</div>';
						}
					}
					$detail .= '</div>';

					if ( ! empty( $floor['inspiry_floor_plan_image'] ) ) {
						$detail .= '<div class="floor-plan-map">';
						$detail .= '<a href="' . esc_url( $floor['inspiry_floor_plan_image'] ) . '" data-fancybox="floor-plans">';
						$detail .= '<img src="' . esc_url( $floor['inspiry_floor_plan_image'] ) . '" alt="' . esc_attr( $floor['inspiry_floor_plan_name'] ) . '">';
						$detail .= '</a>';
						$detail .= '</div>';
					}

					$detail .= '</div>';
				}

			}
			?>
            <div class="rh-floor-tabs-wrapper">
				<?php
				echo $tabs;
				?>
            </div>
            <div class="rh-floor-content-wrapper">
				<?php
				echo $detail;
				?>
            </div>
			<?php
			?>
        </div>
    </div>
	<?php
}
