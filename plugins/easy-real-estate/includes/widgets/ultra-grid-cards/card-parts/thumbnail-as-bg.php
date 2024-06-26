<?php
if ( has_post_thumbnail( get_the_ID() ) ) {
	$image_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
}else{
	$image_url = get_inspiry_image_placeholder_url( 'large' );
}
?>
<a class="rh-permalink rh-thumb-with-bg" href="<?php the_permalink() ?>" style="background-image: url('<?php echo esc_url($image_url);?>')">

</a>