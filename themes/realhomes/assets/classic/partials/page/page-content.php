<?php
/**
 * Page Content
 *
 * @since      4.2.0
 * @package    realhomes
 * @subpackage classic
 */

do_action( 'inspiry_before_page_contents' );
?>
<div class="main page-main">
	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php
				$title_display = get_post_meta( get_the_ID(), 'REAL_HOMES_page_title_display', true );
				if ( 'hide' !== $title_display ) {
					?>
                    <header class="post-header">
                        <h3 class="post-title"><?php the_title(); ?></h3>
                    </header>
					<?php
				}

				if ( has_post_thumbnail() ) {
					$image_id  = get_post_thumbnail_id();
					$image_url = wp_get_attachment_url( $image_id );
					echo '<a data-fancybox="thumbnail" href="' . esc_attr( $image_url ) . '" title="' . the_title_attribute( 'echo=0' ) . '" >';
					the_post_thumbnail( 'property-detail-slider-image-two' );
					echo '</a>';
				}
				?>
                <div class="post-content rh_classic_content_zero clearfix">
					<?php the_content(); ?>
                </div>
				<?php
				// WordPress Link Pages.
				wp_link_pages( array(
					'before'         => '<div class="pages-nav clearfix">',
					'after'          => '</div>',
					'next_or_number' => 'next',
				) );
				?>
            </article>
			<?php
			// If comments are open or there is at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		}
	}
	?>
</div>