<?php
/**
 * This file contains the blog post list card variation one.
 *
 * @version 4.2.0
 */

$post_id = $args['post_id'];
$format  = $args['format'];
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-thumbnail-wrapper">
		<?php
		// Image, gallery or video based on format.
		if ( in_array( $format, array( 'standard', 'image', 'gallery', 'video' ), true ) ) {
			get_template_part( 'assets/ultra/partials/blog/post-formats/' . $format );
		}
		if ( ( ! empty( get_the_post_thumbnail() ) ) || ! empty( get_post_meta( $post_id, 'REAL_HOMES_gallery', true ) ) ) {
			get_template_part( 'assets/ultra/partials/blog/post/post-author' );
		}
		?>
    </div>
    <div class="entry-summary">
        <div class="entry-header">
			<?php
			// Post meta.
			if ( 'true' === get_option( 'realhomes_display_blog_meta', 'true' ) ) {
				get_template_part( 'assets/ultra/partials/blog/post/meta' );
			}

			// Post title.
			get_template_part( 'assets/ultra/partials/blog/post/title' );
			?>
        </div>
		<?php
		if ( strpos( get_the_content(), 'more-link' ) === false ) {
			the_excerpt();
		} else {
			the_content( '' );
		}
		?>
    </div>
</article>