<?php
$format  = $args['format'];
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	// Image, gallery or video based on format.
	if ( in_array( $format, array( 'standard', 'image', 'gallery', 'video' ), true ) ) {
		get_template_part( 'assets/modern/partials/blog/post-formats/' . $format );
	}
	?>
    <div class="entry-header blog-post-entry-header">
		<?php
		// Post title.
		get_template_part( 'assets/modern/partials/blog/post/title' );

		// Post meta.
		if ( 'true' === get_option( 'realhomes_display_blog_meta', 'true' ) ) {
			get_template_part( 'assets/modern/partials/blog/post/meta' );
		}
		?>
    </div>
    <div class="entry-summary">
		<?php
		if ( strpos( get_the_content(), 'more-link' ) === false ) {
			the_excerpt();
		} else {
			the_content( '' );
		}
		?>
        <a href="<?php the_permalink(); ?>" rel="bookmark" class="rh-btn rh-btn-primary read-more"><?php esc_html_e( 'Read More', 'framework' ); ?></a>
    </div>
</article>