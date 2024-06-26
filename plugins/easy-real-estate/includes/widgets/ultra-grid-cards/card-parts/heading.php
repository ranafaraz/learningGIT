<?php
$post_title = get_the_title();
if ( 'ultra' === INSPIRY_DESIGN_VARIATION ) {
	$post_title = wp_trim_words( $post_title, 4 );
}
?>
<h3 class="rh-ultra-property-title"><a href="<?php the_permalink(); ?>"><?php echo esc_html( $post_title ); ?></a></h3>