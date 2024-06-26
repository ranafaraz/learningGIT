<?php
/**
 * List Property Half Map
 *
 * Property grid card to be displayed on listing half map page.
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

$is_featured = get_post_meta( get_the_ID(), 'REAL_HOMES_featured', true );
$label_text  = get_post_meta( get_the_ID(), 'inspiry_property_label', true );
?>

<div class="rh-ultra-property-card rh-half-map-card rh_popup_info_map" data-RH-ID="RH-<?php echo get_the_ID(); ?>">
    <div class="rh-ultra-list-card-thumb">
        <div class="rh-ultra-status-box">
			<?php
			if ( function_exists( 'ere_get_property_statuses_ultra' ) ) {
				ere_get_property_statuses_ultra( get_the_ID() );
			}

			if ( isset( $is_featured ) && $is_featured == '1' ) {
				?>
                <span class="rh-ultra-featured">
                        <?php esc_html_e( 'Featured', 'framework' ); ?>
                    </span>
				<?php
			}
			if ( isset( $label_text ) && ! empty( $label_text ) ) {
				?>
                <span class="rh-ultra-hot">
                        <?php echo esc_html( $label_text ); ?>
                    </span>
				<?php
			}
			?>
        </div>
		<?php
		get_template_part( 'assets/ultra/partials/properties/card-parts/thumbnail-as-bg' );
		?>
        <div class="rh-ultra-bottom-box rh-ultra-flex-end">
            <div class="rh-ultra-action-buttons rh-ultra-action-dark hover-dark">
				<?php
				inspiry_favorite_button( get_the_ID(), '', '', '/common/images/icons/ultra-favourite.svg', 'ultra' );
				inspiry_add_to_compare_button();
				?>
            </div>
        </div>
    </div>
    <div class="rh-ultra-card-detail-wrapper">

		<?php
		get_template_part( 'assets/ultra/partials/properties/card-parts/heading' );
		get_template_part( 'assets/ultra/partials/properties/card-parts/address' );

		?>
        <div class="rh-ultra-meta">
			<?php
			get_template_part( 'assets/ultra/partials/properties/card-parts/grid-card-meta' );
			?>
        </div>

        <div class="rh-ultra-price-meta-box hide-ultra-price-postfix-separator">
			<?php
			get_template_part( 'assets/ultra/partials/properties/card-parts/price' );
			get_template_part( 'assets/ultra/partials/properties/card-parts/year-built' );
			?>
        </div>
	    <?php
	    if ( inspiry_is_rvr_enabled() ) {
		    ?>
            <div class="rvr_card_info_wrap">
                <div class="rh-ultra-rvr-rating">
				    <?php
				    if ( 'true' === get_option( 'inspiry_property_ratings', 'false' ) ) {
					    inspiry_rating_average_plain();
				    }
				    ?>
                </div>
                <p class="added-date"><span class="added-title"><?php esc_html_e( 'Added:', 'framework' );?></span> <?php echo get_the_date(); ?></p>
            </div>
		    <?php
	    }
	    ?>
    </div>
</div>
