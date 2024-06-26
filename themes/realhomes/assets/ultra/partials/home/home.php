<?php
/**
 * Homepage Template
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>
        <div id="post-<?php the_ID(); ?>" class="rh-home-content"><?php the_content(); ?></div>
	<?php
	endwhile;
endif;

get_footer();
