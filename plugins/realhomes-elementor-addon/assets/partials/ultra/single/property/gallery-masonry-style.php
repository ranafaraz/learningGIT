<?php
/**
 * This file contains the Grid variation of Single Property Gallery widget
 *
 * @version 2.3.0
 */
global $settings, $post_id, $properties_images, $widget_id;
?>
<div class="rhea-single-property-gallery-wrapper" id="rhea-gallery-wrapper-<?php echo esc_attr( $widget_id ) ?>">
    <div class="rhea-single-property-gallery grid-box">
		<?php
		$i = 0;
		foreach ( $properties_images as $prop_image_id => $prop_image_meta ) {
			$lightbox_caption = 'data-caption="' . $prop_image_meta['title'] . '"';
			if ( $i < 5 ) {
				?>
                <a class="rhea-gallery-item" href="<?php echo esc_url( $prop_image_meta['full_url'] ) ?>" style='background-image: url("<?php echo esc_url( $prop_image_meta['full_url'] ) ?>")' data-fancybox="gallery-<?php echo esc_attr( $widget_id ) . '-' . esc_attr( $post_id ); ?>"<?php echo esc_attr( $lightbox_caption ) ?>>
					<?php
					if ( 4 === $i ) {
						?>
                        <span class="overlay-counter"><?php echo esc_html( $settings['counter_label'] . ' ( ' . count( $properties_images ) . ' )' ) ?></span>
						<?php
					}
					?>
                </a>
				<?php
				$i++;
			} else {
				?>
                <span style="display: none;" data-fancybox="gallery-<?php echo esc_attr( $widget_id ) . '-' . esc_attr( $post_id ); ?>" data-src="<?php echo esc_url( $prop_image_meta['full_url'] ); ?>" data-thumb="<?php echo esc_url( $prop_image_meta['full_url'] ); ?>"></span>
				<?php
			}
		}
		?>
    </div>
</div>

