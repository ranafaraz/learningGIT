<?php
/**
 * Gallery post format.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

$post_id            = get_the_ID();
$REAL_HOMES_gallery = get_post_meta( $post_id, 'REAL_HOMES_gallery', true );
if ( ! empty( get_the_post_thumbnail( $post_id ) ) || ! empty( $REAL_HOMES_gallery ) ) {
	?>
    <div class="gallery-post-slider flexslider">
        <ul class="slides">
			<?php list_gallery_images(); ?>
        </ul>
    </div>
	<?php
} else {
	?>
    <figure>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php inspiry_image_placeholder( 'post-featured-image' ); ?>
        </a>
    </figure>
	<?php
}