<?php
/**
 * Standard post format.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */
if ( ! empty( get_the_post_thumbnail() ) ) {
	?>
    <figure>
		<?php
		if ( is_single() ) {
		$image_id  = get_post_thumbnail_id();
		$image_url = wp_get_attachment_url( $image_id );
		?>
        <a href="<?php echo esc_url( $image_url ); ?>" data-fancybox title="<?php the_title_attribute(); ?>">
			<?php
			} else {
			?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php
				}

				the_post_thumbnail( 'post-featured-image' );
				?>
            </a>
    </figure>
	<?php
} else {
	inspiry_image_placeholder( 'post-featured-image' );
}