<?php
/**
 * Page Content
 *
 * @since    4.2.0
 * @package  realhomes/modern
 */

if ( have_posts() ) {
	?>
    <div class="rh_blog rh_blog__listing rh_blog__single">
		<?php
		while ( have_posts() ) {
			the_post();
			?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php
				// Meta box setting to display page title or not
				if ( 'hide' !== get_post_meta( get_the_ID(), 'REAL_HOMES_page_title_display', true ) ) {
					?>
                    <div class="entry-header blog-post-entry-header">
						<?php get_template_part( 'assets/modern/partials/blog/post/title' ); ?>
                    </div>
					<?php
				}
				?>
                <div class="rh_content entry-content">
					<?php the_content(); ?>
                </div>
            </article>
			<?php
			wp_link_pages( array(
				'before'         => '<div class="rh_pagination__pages-nav">',
				'after'          => '</div>',
				'next_or_number' => 'next'
			) );
		}

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
		?>
    </div><!-- .rh_blog__listing -->
	<?php
}