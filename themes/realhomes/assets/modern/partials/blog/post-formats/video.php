<?php
/**
 * Video post format.
 *
 * @package    realhomes
 * @subpackage modern
 */

global $post;

$image_size = 'post-featured-image';
if ( is_single() ) {
	$embed_code = get_post_meta( get_the_ID(), 'REAL_HOMES_embed_code', true );
	if ( ! empty( $embed_code ) ) {
		?>
        <div class="post-video">
            <div class="video-wrapper">
				<?php echo stripslashes( wp_specialchars_decode( $embed_code ) ); ?>
            </div>
        </div>
		<?php
	} else {
		?>
        <div class="post-video test">
			<?php
			if ( has_post_thumbnail() ) {
				$image_id  = get_post_thumbnail_id();
				$image_url = wp_get_attachment_url( $image_id );
				?>
                <a href="<?php echo esc_url( $image_url ); ?>" data-fancybox class="" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail( $image_size ); ?>
                </a>
				<?php
			} else {
				inspiry_image_placeholder( $image_size );
			}
			?>
        </div>
		<?php
	}
} else {
	$is_home_template = is_page_template( 'templates/home.php' );
	if ( $is_home_template ) {
		$image_size = 'modern-property-child-slider';
	}
	?>
    <div class="post-video">
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php
			if ( has_post_thumbnail() ) {
				if ( $is_home_template ) {
					?>
                    <div class="wrapper-video-post-home">
						<?php the_post_thumbnail( $image_size ); ?>
                    </div>
					<?php
				} else {
					the_post_thumbnail( $image_size );
				}

			} else {
				if ( $is_home_template ) {
					?>
                    <div class="wrapper-video-post-home">
						<?php inspiry_image_placeholder( $image_size ); ?>
                    </div>
					<?php
				} else {
					inspiry_image_placeholder( $image_size );
				}
			}
			?>
        </a>
    </div>
	<?php
}