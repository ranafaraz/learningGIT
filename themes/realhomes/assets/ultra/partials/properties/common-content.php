<?php
/**
 * Contains content part for multiple properties pages
 */

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		?>
        <div class="rh-content rh-content-above-footer  <?php if ( get_the_content() ) {
			echo esc_attr( 'rh-page-content' );
		} ?>">
			<?php the_content(); ?>
        </div>
        <!-- /.rh_content -->
		<?php

	}
}

?>



