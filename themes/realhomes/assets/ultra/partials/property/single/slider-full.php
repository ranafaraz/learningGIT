<?php
/**
 * Single Property: Slider
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

$size = 'post-featured-image';
$properties_images = rwmb_meta( 'REAL_HOMES_property_images', 'type=plupload_image&size=' . $size, get_the_ID() );
$prop_detail_login = inspiry_prop_detail_login();

if ( ! empty( get_the_post_thumbnail() ) ) {
	$image_url = wp_get_attachment_url( get_post_thumbnail_id() );
}

if ( ! empty( $properties_images ) && 1 < count( $properties_images ) && ( 'yes' != $prop_detail_login || is_user_logged_in() ) ) {
	?>
    <div class="rh-ultra-property-slider-wrapper rh-ultra-property-full-slider rh-hide-before-ready">
        <div class="rh-ultra-property-slider-container">
            <div class="rh-ultra-property-slider" data-count="<?php echo esc_attr( count( $properties_images ) ) ?>">
				<?php
				$title_in_lightbox = get_option( 'inspiry_display_title_in_lightbox' );
				$lightbox_caption  = '';
				foreach ( $properties_images as $prop_image_id => $prop_image_meta ) {
					$lightbox_title = $prop_image_meta['title'];
					if ( 'true' == $title_in_lightbox ) {
						$lightbox_caption = 'data-caption="' . $prop_image_meta['title'] . '"';
					}
					?>
                    <div>
                        <div class="rh-ultra-property-thumb-wrapper">
                            <a class="rh-ultra-property-thumb" href="<?php echo esc_url( $prop_image_meta['full_url'] ) ?>" style='background-image: url("<?php echo esc_url( $prop_image_meta['full_url'] ) ?>")' data-fancybox="gallery" <?php echo esc_attr( $lightbox_caption ) ?>></a>
                        </div>
                    </div>
					<?php
				}
				?>
            </div>
            <div class="rh-ultra-property-thumb-box">
                <div class="rh-ultra-property-thumb-container">
					<?php get_template_part( 'assets/ultra/partials/property/single/property-head' ); ?>
                    <div class="rh-ultra-thumb-action-box rh-ultra-action-buttons rh-ultra-action-dark hover-dark">
						<?php get_template_part( 'assets/ultra/partials/property/single/action-buttons' ); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="rh-ultra-property-carousel-wrapper rh-ultra-vertical-carousel" data-count="<?php echo esc_attr( count( $properties_images ) ) ?>">
            <div class="rh-ultra-property-carousel-box">
                <div class="rh-ultra-property-carousel rh-ultra-vertical-carousel-trigger">
					<?php
					$title_in_lightbox = get_option( 'inspiry_display_title_in_lightbox' );
					$lightbox_caption  = '';
					foreach ( $properties_images as $prop_image_id => $prop_image_meta ) {
						$lightbox_title = $prop_image_meta['title'];
						if ( 'true' == $title_in_lightbox ) {
							$lightbox_caption = 'data-caption="' . $prop_image_meta['title'] . '"';
						}
						?>
                        <div>
                            <div class="rh-ultra-property-carousel-thumb-box">
                                <span class="rh-ultra-property-carousel-thumb" style='background-image: url("<?php echo esc_url( $prop_image_meta['full_url'] ) ?>")'></span>
                            </div>
                        </div>
						<?php
					}
					?>
                </div>
            </div>
            <div class="rh-ultra-thumb-count">
				<?php inspiry_safe_include_svg( '/ultra/icons/photos.svg', '/assets/' ); ?>
                <span class="rh-slider-item-total"><?php echo esc_html( count( $properties_images ) ) ?></span>
                <span class="rh-more-slides"><?php esc_html_e( 'Photos', 'framework' ) ?></span>
            </div>
        </div>
    </div>
	<?php realhomes_print_property_images( $properties_images ); ?>
    <div class="only-for-print">
	    <?php get_template_part( 'assets/ultra/partials/property/single/property-head', null, array( 'print' => 'true' ) ); ?>
    </div>
	<?php
} else {

	if ( ! empty( get_the_post_thumbnail( get_the_ID() ) ) ) {
		$image_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
	} else {
		$image_url = get_inspiry_image_placeholder_url( 'large' );
	}
	?>
    <div class="rh-ultra-property-slider-wrapper">
        <div class="rh-ultra-property-slider-container">
            <div class="rh-property-featured-image" style="background-image: url('<?php echo esc_url( $image_url ); ?>')">
                <div id="property-featured-image" class="clearfix only-for-print">
					<?php echo '<img src="' . esc_url( $image_url ) . '" alt="' . the_title_attribute( 'echo=0' ) . '" />'; ?>
                </div>
            </div>
            <div class="rh-ultra-property-thumb-box">
                <div class="rh-ultra-property-thumb-container">
					<?php get_template_part( 'assets/ultra/partials/property/single/property-head' ); ?>
                    <div class="rh-ultra-thumb-action-box rh-ultra-action-buttons rh-ultra-action-dark hover-dark">
                        <?php get_template_part( 'assets/ultra/partials/property/single/action-buttons' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<?php
}