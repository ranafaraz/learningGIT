<?php
/**
 * This file contains the blog post grid card variation three.
 *
 * @version 4.2.0
 */

$post_id = $args['post_id'];
$format  = $args['format'];
?>
<article id="post-<?php the_ID(); ?>" class="blog-grid-card-three <?php echo esc_attr( implode( ' ', get_post_class() ) ); ?>">
	<?php
	$image_url = get_the_post_thumbnail_url( $post_id, 'post-featured-image' );
	if ( ! $image_url ) {
		$image_url = inspiry_get_raw_placeholder_url( 'post-featured-image' );
	}

	printf( '<div class="entry-thumbnail-wrapper" style="background-image: url(\'%s\');">', esc_url( $image_url ) );

	// Image, gallery or video based on format.
	if ( in_array( $format, array( 'standard', 'image', 'gallery', 'video' ), true ) ) {
		get_template_part( 'assets/modern/partials/blog/post-formats/' . $format );
	}

	echo '</div><!-- .entry-thumbnail-wrapper -->';
	?>
    <div class="entry-summary">
        <div class="entry-header">
			<?php
			// Post meta.
			if ( 'true' === get_option( 'realhomes_display_blog_meta', 'true' ) ) {
				?>
                <div class="entry-meta">
                    <div class="entry-categories">
						<?php the_category( ', ' ); ?>
                    </div>
                </div>
				<?php
			}

			// Post title.
			get_template_part( 'assets/modern/partials/blog/post/title' );
			?>
        </div>
		<?php get_template_part( 'assets/modern/partials/blog/post/excerpt' ); ?>
    </div>
</article>