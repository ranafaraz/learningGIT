<?php
/**
 * Blog Loop File
 *
 * Loop file of blog.
 *
 * @since    3.0.0
 * @package  realhomes/modern
 */

if ( have_posts() ) {

	$counter           = 1;
	$blog_page_card    = get_option( 'realhomes_blog_page_card_layout', 'list' );
	$grid_card_design  = get_option( 'realhomes_blog_page_grid_card_design', '1' );
	$post_layout_shift = get_option( 'realhomes_post_layout_shift', 'false' );

	$container_classes = 'rh_blog rh_blog__listing';
	if ( 'grid' === $blog_page_card ) {
		$container_classes .= ' blog-grid-layout ' . sprintf( 'blog-grid-layout-%s-columns', get_option( 'realhomes_blog_page_columns', '3' ) );
	}
	?>
    <div class="<?php echo esc_attr( $container_classes ); ?>">
		<?php
		while ( have_posts() ) {
			the_post();

			$post_id = get_the_ID();
			$format  = get_post_format( $post_id );
			if ( false === $format ) {
				$format = 'standard';
			}

			$args = array(
				'post_id' => $post_id,
				'format'  => $format,
			);

			if ( 'grid' === $blog_page_card ) {
				if ( '2' === $grid_card_design && 'true' === $post_layout_shift && 2 >= $counter ) {
					get_template_part( 'assets/modern/partials/blog/cards/card-3', null, $args );
				} else {
					get_template_part( 'assets/modern/partials/blog/cards/card-' . $grid_card_design, null, $args );
				}
			} else {
				get_template_part( 'assets/modern/partials/blog/cards/list', null, $args );
			}

			++$counter;
		}

		if ( 'list' === $blog_page_card ) {
			inspiry_theme_pagination( $wp_query->max_num_pages );
		}
		?>
    </div><!-- .rh_blog__listing -->
	<?php
	if ( 'grid' === $blog_page_card ) {
		inspiry_theme_pagination( $wp_query->max_num_pages );
	}

} else {
	?>
    <div class="rh_alert-wrapper">
        <h4 class="no-results"><?php esc_html_e( 'No Posts Found!', 'framework' ) ?></h4>
    </div>
	<?php
}