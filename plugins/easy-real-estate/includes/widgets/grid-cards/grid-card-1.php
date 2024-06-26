<?php
$property_id = get_the_ID();
$is_featured = get_post_meta( $property_id, 'REAL_HOMES_featured', true );

global $featured_text;
?>
<article class="rh_prop_card rh_prop_card--block">
    <div class="rh_prop_card__wrap">
		<?php if ( $is_featured ) : ?>
            <div class="rh_label rh_label__featured_widget">
                <div class="rh_label__wrap">
					<?php
					if ( ! empty( $featured_text ) ) {
						echo esc_html( $featured_text );
					} else {
						esc_html_e( 'Featured', 'easy-real-estate' );
					}
					?>
                    <span></span>
                </div>
            </div>
		<?php endif; ?>
        <figure class="rh_prop_card__thumbnail">
            <div class="rh_figure_property_one">
                <a href="<?php the_permalink(); ?>">
					<?php
					if ( has_post_thumbnail( $property_id ) ) {
						the_post_thumbnail( 'modern-property-child-slider' );
					} else {
						if ( function_exists( 'inspiry_image_placeholder' ) ) {
							inspiry_image_placeholder( 'modern-property-child-slider' );
						}
					}
					?>
                </a>
                <div class="rh_overlay"></div>
                <div class="rh_overlay__contents rh_overlay__fadeIn-bottom">
					<?php
					if ( isset( $view_property ) && ! empty( $view_property ) ) {
						?>
                        <a href="<?php the_permalink(); ?>"><?php echo esc_html( $view_property ); ?></a>
						<?php
					} else {
						?>
                        <a href="<?php the_permalink(); ?>"><?php esc_html_e( 'View Property', 'easy-real-estate' ); ?></a>
						<?php
					}
					?>
                </div>
				<?php ere_display_property_label( $property_id ); ?>
            </div>
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
        </figure><!-- /.rh_prop_card__thumbnail -->

        <div class="rh_prop_card__details">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p class="rh_prop_card__excerpt"><?php ere_framework_excerpt( 10 ); ?></p>
			<?php ere_get_template_part( 'includes/widgets/grid-cards/card-parts/grid-card-meta' ); ?>

            <div class="rh_prop_card__priceLabel rh_prop_card__priceLabel_box">
                <div class="rh_rvr_price_status_box">
                    <span class="rh_prop_card__status">
                        <?php echo esc_html( ere_get_property_statuses( $property_id ) ); ?>
                    </span>
                    <p class="rh_prop_card__price">
						<?php ere_property_price(); ?>
                    </p>
                </div>
				<?php
				if ( inspiry_is_rvr_enabled() ) {
					global $post;
					?>
                    <div class="inspiry_rating_right">
						<?php
						if ( 'property' === $post->post_type && 'true' === get_option( 'inspiry_property_ratings', 'false' ) ) {
							inspiry_rating_average_plain();
						}
						?>
                    </div>
					<?php
				}
				?>
            </div>
        </div>
    </div><!-- /.rh_prop_card__wrap -->
</article>