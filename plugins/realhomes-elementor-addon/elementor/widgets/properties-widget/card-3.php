<?php
/**
 * This file contains card style three.
 *
 * @version 2.3.0
 */
global $settings;

$property_id = get_the_ID();

if ( ! empty( get_the_post_thumbnail( $property_id ) ) ) {
	$image_url = get_the_post_thumbnail_url( $property_id, 'large' );
} else {
	$image_url = get_inspiry_image_placeholder_url( 'large' );
}
?>
<div class="rhea-ultra-property-card-three-wrapper">
    <div class="rhea-ultra-property-card-three" style="background-image: url('<?php echo esc_url( $image_url ); ?>');">
        <div class="rhea-ultra-property-card-three-content">
            <h3 class="rhea-ultra-property-card-three-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php
			$excerpt_length = ! empty( $settings['excerpt_length'] ) ? $settings['excerpt_length'] : 11;
			$excerpt        = rhea_get_framework_excerpt( $excerpt_length, '' );

			if ( ! empty( $excerpt ) ) {
				?>
                <p><?php echo esc_html( $excerpt ); ?></p>
				<?php
			}

			rhea_get_template_part( 'assets/partials/ultra/grid-card-meta-with-ratings' );
			?>
        </div>
    </div><!-- .rhea-ultra-property-card-three -->
</div><!-- .rhea-ultra-property-card-three-wrapper -->