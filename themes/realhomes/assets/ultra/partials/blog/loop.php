<?php
/**
 * Blog Loop File
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */
if ( have_posts() ) {

	$counter           = 1;
	$blog_page_card    = get_option( 'realhomes_blog_page_card_layout', 'list' );
	$grid_card_design  = get_option( 'realhomes_blog_page_grid_card_design', '1' );
	$post_layout_shift = get_option( 'realhomes_post_layout_shift', 'false' );

	if ( 'grid' === $blog_page_card ) {
		?>
        <div class="blog-grid-layout <?php echo sprintf( 'blog-grid-layout-%s-columns', esc_attr( get_option( 'realhomes_blog_page_columns', '3' ) ) ); ?>">
		<?php
	}

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
				get_template_part( 'assets/ultra/partials/blog/cards/card-3', null, $args );
			} else {
				get_template_part( 'assets/ultra/partials/blog/cards/card-' . $grid_card_design, null, $args );
			}
		} else {
			get_template_part( 'assets/ultra/partials/blog/cards/list', null, $args );
		}

		++$counter;
	}

	if ( 'grid' === $blog_page_card ) {
		?>
        </div>
		<?php
	}

	inspiry_theme_pagination();
} else {
	realhomes_print_no_result();
}