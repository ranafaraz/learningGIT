<?php
/**
 * This file contains card style four.
 *
 * @version 2.3.0
 */
global $settings;

$property_id = get_the_ID();
?>
<div class="rhea-ultra-property-card-four-wrapper">
    <div class="rhea-ultra-property-card-four">
        <div class="rhea-ultra-property-card-four-thumb">
			<?php
			if ( function_exists( 'ere_property_price' ) ) {
				?><p class="rhea-ultra-property-card-four-price"><?php ere_property_price( $property_id, false, true ); ?></p><?php
			}
			?>
			<?php rhea_get_template_part( 'assets/partials/ultra/thumbnail' ); ?>
        </div>
        <div class="rhea-ultra-property-card-four-content">
            <h3 class="rhea-ultra-property-card-four-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php
			$excerpt_length = ! empty( $settings['excerpt_length'] ) ? $settings['excerpt_length'] : 24;
			$excerpt        = rhea_get_framework_excerpt( $excerpt_length, '' );

			if ( ! empty( $excerpt ) ) {
				?>
                <p><?php echo esc_html( $excerpt ); ?></p>
				<?php
			}

			$wrapper_classes = 'rhea-ultra-property-card-four-footer';
			if ( 'yes' === $settings['hide_meta_label'] ) {
				$wrapper_classes .= ' rhea-ultra-property-hide-meta-label';
			}
			?>
            <div class="<?php echo esc_attr( $wrapper_classes ); ?>">
                <a class="rhea-ultra-property-card-four-link" href="<?php the_permalink(); ?>">
					<?php
					if ( ! empty( $settings['button_text'] ) ) {
						$button_text = $settings['button_text'];
					} else {
						$button_text = esc_html__( 'Check Availability', 'realhomes-elementor-addon' );
					}

					echo esc_html( $button_text );
					?>
                </a>
				<?php
				rhea_get_template_part( 'assets/partials/ultra/grid-card-meta-with-ratings' );
				?>
            </div>
        </div>
    </div><!-- .rhea-ultra-property-card-four -->
</div><!-- .rhea-ultra-property-card-four-wrapper -->