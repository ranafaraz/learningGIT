<?php
$excerpt_length = get_option( 'realhomes_post_excerpt_length', '25' );

if ( ! $excerpt_length ) {
	$excerpt_length = 25;
}
?>
<p><?php echo wp_trim_words( wp_trim_excerpt( get_the_excerpt() ), intval( $excerpt_length ), '.' ); ?></p>
