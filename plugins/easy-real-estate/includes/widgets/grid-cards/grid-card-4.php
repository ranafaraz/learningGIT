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

global $featured_text;
?>
<article class="rh_prop_card rh_prop_card--block rh-grid-card-4">
    <div class="rh_prop_card__wrap">
        <figure class="rh_prop_card__thumbnail">
            <div class="rh_figure_property_one">
				<?php
				if ( has_post_thumbnail( $property_id ) ) {
					the_post_thumbnail( 'modern-property-child-slider' );
				} else {
					if ( function_exists( 'inspiry_image_placeholder' ) ) {
						inspiry_image_placeholder( 'modern-property-child-slider' );
					}
				}
				?>
                <div class="rh_overlay"></div>
				<?php
				if ( function_exists( 'inspiry_property_detail_page_link_text' ) ) {
					?>
                    <div class="rh_overlay__contents rh_overlay__fadeIn-bottom">
                        <a href="<?php the_permalink(); ?>"><?php inspiry_property_detail_page_link_text(); ?></a>
                    </div>
					<?php
				}
				?>
            </div>
            <div class="rh-property-tags-wrapper">
				<?php
				ere_display_property_label( $property_id );

				if ( get_post_meta( $property_id, 'REAL_HOMES_featured', true ) ) {
					if ( empty( $featured_text ) ) {
						$featured_text = esc_html__( 'Featured', 'easy-real-estate' );
					}
					?>
                    <span class="rh-property-tag rh-featured-property-tag"><?php echo esc_html( $featured_text ); ?></span>
					<?php
				}

				$property_status = ere_get_property_statuses( $property_id );
				if ( $property_status ) {
					?>
                    <span class="rh-property-tag rh-status-property-tag"><?php echo esc_html( $property_status ); ?></span>
					<?php
				}
				?>
            </div>
            <div class="rh-card-bottom-info">
                <p class="rh_prop_card__price"><?php ere_property_price( '', true ); ?></p>
                <div class="rh_prop_card__btns">
					<?php
					// Display add to favorite button.
					if ( function_exists( 'inspiry_favorite_button' ) ) {
						inspiry_favorite_button();
					}

					// Display add to compare button.
					if ( function_exists( 'inspiry_add_to_compare_button' ) ) {
						inspiry_add_to_compare_button();
					}
					?>
                </div>
            </div>
        </figure>
        <div class="rh_prop_card__details">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php ere_get_template_part( 'includes/widgets/grid-cards/card-parts/grid-card-meta' ); ?>
        </div>
    </div>
</article><!-- /.rh-grid-card-4 -->