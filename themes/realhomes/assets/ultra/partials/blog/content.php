<?php
get_template_part( 'assets/ultra/partials/page-head' );

// Display any contents after the page head and before the contents.
do_action( 'inspiry_before_page_contents' );
?>
<main id="main" class="rh-main main">
	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();

			$post_id = get_the_ID();
			$format  = get_post_format( $post_id );
			if ( false === $format ) {
				$format = 'standard';
			}
			?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="entry-thumbnail-wrapper">
					<?php
					// Image, gallery or video based on format.
					if ( in_array( $format, array( 'standard', 'image', 'gallery', 'video' ), true ) ) {
						get_template_part( 'assets/ultra/partials/blog/post-formats/' . $format );
					}
					if ( ( ! empty( get_the_post_thumbnail() ) ) || ! empty( get_post_meta( $post_id, 'REAL_HOMES_gallery', true ) ) || ! empty( get_post_meta( $post_id, 'REAL_HOMES_embed_code', true ) ) ) {
						get_template_part( 'assets/ultra/partials/blog/post/post-author' );
					}
					?>
                </div>
                <div class="entry-content-wrapper">
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
                    <div class="entry-content">
						<?php the_content(); ?>
                    </div>
                    <div class="entry-footer">
						<?php
						if ( function_exists( 'ere_share_post' ) ) {
							ere_share_post();
						}

						if ( get_the_tags() ) {
							?>
                            <div class="post-tags">
								<?php the_tags( '<i class="fas fa-tags"></i>&nbsp', ', ', '' ); ?>
                            </div>
							<?php
						}
						?>
                    </div>
                </div>
            </article>
			<?php
			wp_link_pages( array(
				'before'         => '<div class="pages-navigation">',
				'after'          => '</div>',
				'next_or_number' => 'next',
			) );

			// If comments are open or there is at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		}
	}
	?>
</main>