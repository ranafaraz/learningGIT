<?php
/**
 * Grid Property Card 4
 *
 * Property grid card to be displayed on grid listing page.
 *
 * @since   3.21.0
 * @package realhomes/modern
 */

$property_id = get_the_ID();
?>
<article class="rh_prop_card rh_prop_card--listing rh-grid-card-4">
    <div class="rh_prop_card__wrap">
        <figure class="rh_prop_card__thumbnail">
            <div class="rh_figure_property_one">
				<?php
				if ( has_post_thumbnail( $property_id ) ) {
					the_post_thumbnail( 'modern-property-child-slider' );
				} else {
					inspiry_image_placeholder( 'modern-property-child-slider' );
				}
				?>
                <div class="rh_overlay"></div>
                <div class="rh_overlay__contents rh_overlay__fadeIn-bottom">
                    <a href="<?php the_permalink(); ?>"><?php inspiry_property_detail_page_link_text(); ?></a>
                </div>
            </div>
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
            <div class="rh-card-bottom-info">
                <p class="rh_prop_card__price">
			        <?php
			        if ( function_exists( 'ere_property_price' ) ) {
				        ere_property_price( '', true );
			        }
			        ?>
                </p>
                <div class="rh_prop_card__btns">
			        <?php
			        inspiry_favorite_button(); // Display add to favorite button.
			        inspiry_add_to_compare_button(); // Display add to compare button.
			        ?>
                </div>
            </div>
        </figure>
        <div class="rh_prop_card__details">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <?php get_template_part( 'assets/modern/partials/properties/card-parts/grid-card-meta' ); ?>
        </div>
    </div>
</article><!-- /.rh-grid-card-4 -->