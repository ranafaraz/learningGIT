<?php
/**
 * Image post format.
 *
 * @package    realhomes
 * @subpackage modern
 */
?>
<figure>
	<?php
	$image_size = 'post-featured-image';
	if ( is_page_template( 'templates/home.php' ) ) {
		$image_size = 'modern-property-child-slider';
	}

	if ( is_single() ) {
		$image_id  = get_post_thumbnail_id();
		$image_url = wp_get_attachment_url( $image_id );

		if ( has_post_thumbnail() ) {
			?>
            <a href="<?php echo esc_url( $image_url ); ?>" data-fancybox title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail( $image_size ); ?>
            </a>
			<?php
		} else {
			inspiry_image_placeholder( $image_size );
		}
		?><?php
	} else {
		?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( $image_size );
			} else {
				inspiry_image_placeholder( $image_size );
			}
			?>
        </a>
		<?php
	}
	?>
</figure>