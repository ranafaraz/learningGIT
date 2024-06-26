<?php
/**
 * Contains the property gallery images carousel for single property gallery fullwidth variation.
 *
 * @since 3.20.0
 * @package    realhomes
 * @subpackage modern
 */

$properties_images = rwmb_meta( 'REAL_HOMES_property_images', 'type=plupload_image&size=' . 'post-featured-image', get_the_ID() );
$prop_detail_login = inspiry_prop_detail_login();

if ( ! empty( $properties_images ) && 1 < count( $properties_images ) && ( 'yes' != $prop_detail_login || is_user_logged_in() ) ) {

	// Getting gallery slider post meta
	$gallery_type_changed = get_post_meta( get_the_ID(), 'REAL_HOMES_change_gallery_slider_type', true );
	$gallery_slider_type  = get_post_meta( get_the_ID(), 'REAL_HOMES_gallery_slider_type', true );
	$gallery_variation    = 'default';

	// If the gallery slider type isn't changed in meta post then get global settings
	if ( ! $gallery_type_changed ) {
		$gallery_slider_type = get_option( 'inspiry_gallery_slider_type', 'thumb-on-right' );
	}

    // Setting gallery variation template name according to the gallery slider type
	if ( 'carousel-style' === $gallery_slider_type || 'fw-carousel-style' === $gallery_slider_type ) {

		$gallery_variation = 'carousel';

	} else if ( 'masonry-style' === $gallery_slider_type ) {

		$gallery_variation = 'masonry';

	} else if ( 'thumb-on-bottom' === $gallery_slider_type ) {

		$gallery_variation = 'gallery-with-thumb';

	} else if ( 'img-pagination' === $gallery_slider_type ) {

		$gallery_variation = 'gallery-with-thumb2';

	}

    // Getting template part according to gallery variation
	get_template_part( 'assets/modern/partials/property/gallery/' . $gallery_variation, null, array(
		'class'    => 'realhomes_property_full_width_gallery',
		'count'    => count( $properties_images ),
		'gallery'  => $properties_images,
		'lightbox' => get_option( 'inspiry_display_title_in_lightbox' ),
	) );

	if ( has_post_thumbnail() ) {
		?>
        <div id="property-featured-image" class="clearfix only-for-print">
			<?php
			$image_id  = get_post_thumbnail_id();
			$image_url = wp_get_attachment_url( $image_id );
			echo '<img src="' . esc_url( $image_url ) . '" alt="' . the_title_attribute( 'echo=0' ) . '" />';
			?>
        </div>
		<?php
	};
} elseif ( has_post_thumbnail() ) {
	?>
    <div class="rh_section rh_wrap--padding rh_wrap--topPadding">
        <div id="property-featured-image" class="clearfix">
			<?php
			$image_id  = get_post_thumbnail_id();
			$image_url = wp_get_attachment_url( $image_id );
			echo '<a href="' . esc_url( $image_url ) . '" data-fancybox="gallery">';
			echo '<img src="' . esc_url( $image_url ) . '" alt="' . the_title_attribute( 'echo=0' ) . '" />';
			echo '</a>';
			?>
        </div>
    </div>
	<?php
}