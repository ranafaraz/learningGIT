<?php
/**
 * Grid Property Card 5
 *
 * Property grid card to be displayed on grid listing page.
 *
 * @since   3.21.0
 * @package realhomes/modern
 */

$property_id = get_the_ID();
?>
<article class="rh_prop_card rh_prop_card--listing rh-grid-card-5">
    <figure class="rh_prop_card__thumbnail">
		<?php
		if ( has_post_thumbnail( $property_id ) ) {
			the_post_thumbnail( 'modern-property-child-slider' );
		} else {
			inspiry_image_placeholder( 'modern-property-child-slider' );
		}
		?>
        <div class="rh-property-tags-wrapper">
			<?php
			inspiry_display_property_label( $property_id );

			if ( get_post_meta( $property_id, 'REAL_HOMES_featured', true ) ) {
				?>
                <span class="rh-property-tag rh-featured-property-tag"><?php esc_html_e( 'Featured', 'framework' ); ?></span>
				<?php
			}

			$property_status = display_property_status( $property_id );
			if ( $property_status ) {
				?>
                <span class="rh-property-tag rh-status-property-tag"><?php echo esc_html( $property_status ); ?></span>
				<?php
			}
			?>
        </div>
        <div class="rh_prop_card__btns">
			<?php
			inspiry_favorite_button(); // Display add to favorite button.
			inspiry_add_to_compare_button(); // Display add to compare button.
			?>
        </div>
        <div class="rh-property-thumbnail-overlay"></div>
        <div class="rh-property-details-wrapper">
            <h3 class="rh-property-title"><?php the_title(); ?></h3>
			<?php
			if ( function_exists( 'ere_property_price' ) ) {
				?>
                <p class="rh-property-price"><?php ere_property_price( '', true ); ?></p>
				<?php
			}
			?>
			<?php get_template_part( 'assets/modern/partials/properties/card-parts/grid-card-meta' ); ?>
        </div>
    </figure>
    <a class="know-more" href="<?php the_permalink(); ?>"></a>
</article><!-- /.rh-grid-card-5 -->