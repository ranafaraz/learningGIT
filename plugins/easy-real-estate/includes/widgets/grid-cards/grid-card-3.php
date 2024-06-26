<?php
/**
 * Grid Property Card
 *
 * Property grid card to be displayed on grid listing page.
 *
 * @package easy_real_estate
 */

$property_id = get_the_ID();
?>
<article class="rh_latest_properties_2 rh_property_card_stylish">
    <div class="rh_property_card_stylish_inner">
        <div class="rh_thumbnail_wrapper">
            <div class="rh_top_tags_box">
				<?php
				ere_get_template_part( 'includes/widgets/grid-cards/card-parts/media-count' );
				ere_get_template_part( 'includes/widgets/grid-cards/card-parts/tags' );
				?>
            </div>
            <div class="rh_bottom_tags_box">
		        <?php
		        $property_types_string = inspiry_get_property_types_string( $property_id );
		        if ( ! empty( $property_types_string ) ) {
			        ?>
                    <span class="rh_stylish_property_types"><?php echo esc_html( $property_types_string ); ?></span>
			        <?php
		        }
		        ere_get_template_part( 'includes/widgets/grid-cards/card-parts/status' );
		        ?>
            </div>
			<?php ere_get_template_part( 'includes/widgets/grid-cards/card-parts/thumbnail' ); ?>
        </div>

        <div class="rh_detail_wrapper rh_detail_wrapper_2">
			<?php
			ere_get_template_part( 'includes/widgets/grid-cards/card-parts/heading' );

			if ( 'no' === get_option( 'inspiry_hide_property_address', 'no' ) ) {
				ere_get_template_part( 'includes/widgets/grid-cards/card-parts/address' );
			}

			if ( inspiry_is_rvr_enabled() ) {
				?>
                <div class="rh_rvr_ratings_wrapper_stylish rvr_rating_left">
					<?php rh_rvr_rating_average(); ?>
					<?php ere_get_template_part( 'includes/widgets/grid-cards/card-parts/added' ); ?>
                </div>
				<?php
			} else {
				ere_get_template_part( 'includes/widgets/grid-cards/card-parts/added' );
			}

			ere_get_template_part( 'includes/widgets/grid-cards/card-parts/grid-card-meta' );
			?>
            <div class="rh_price_fav_box">
                <div class="rh_price_box">
					<?php ere_get_template_part( 'includes/widgets/grid-cards/card-parts/price' ); ?>
                </div>
                <div class="rh_fav_icon_box rh_parent_fav_button">
					<?php
					if ( function_exists( 'inspiry_favorite_button' ) ) {
						inspiry_favorite_button( $property_id );
					}
					if ( function_exists( 'inspiry_add_to_compare_button' ) ) {
						inspiry_add_to_compare_button();
					}
					?>
                </div>
            </div>
        </div>
        <div class="rh_wrapper_bottom_agent">
			<?php
			if ( ! is_singular( 'agent' ) ) {
				if ( inspiry_is_rvr_enabled() ) {
					ere_get_template_part( 'includes/widgets/grid-cards/card-parts/rvr-owner' );

				} else {
					ere_get_template_part( 'includes/widgets/grid-cards/card-parts/agent-in-listing' );
				}
			}
			?>
        </div>
    </div>
</article>