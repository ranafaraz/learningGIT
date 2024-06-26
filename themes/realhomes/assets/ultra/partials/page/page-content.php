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
			?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="entry-thumbnail-wrapper">
					<?php
					if ( ! empty( get_the_post_thumbnail() ) ) {
						?>
                        <figure>
							<?php
							$image_id  = get_post_thumbnail_id();
							$image_url = wp_get_attachment_url( $image_id );
							?>
                            <a href="<?php echo esc_url( $image_url ); ?>" data-fancybox class="" title="<?php the_title_attribute(); ?>">
								<?php the_post_thumbnail( 'post-featured-image' ); ?>
                            </a>
                        </figure>
						<?php
					}
					?>
                </div>
                <div class="entry-content-wrapper">
                    <div class="entry-content">
						<?php the_content(); ?>
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