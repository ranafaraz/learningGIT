<?php
/**
 * Grid Property Card
 *
 * Property grid card to be displayed on grid listing page.
 *
 * @since    3.0.0
 * @package realhomes/modern
 */

$is_featured = get_post_meta( get_the_ID(), 'REAL_HOMES_featured', true );
$label_text  = get_post_meta( get_the_ID(), 'inspiry_property_label', true );
?>

<div class="rh-ultra-property-card">
	<div class="rh-ultra-card-thumb-wrapper">
		<div class="rh-ultra-property-card-thumb">
			<?php ere_get_template_part( 'includes/widgets/ultra-grid-cards/card-parts/thumbnail' ); ?>
		</div>
		<div class="rh-ultra-top-tags-box">
			<div class="rh-ultra-status-box">
				<?php
				ere_get_property_statuses_ultra( get_the_ID() );
				if ( isset( $is_featured ) && $is_featured == '1' ) {
					?>
					<span class="rh-ultra-featured">
                        <?php esc_html_e( 'Featured', 'easy-real-estate' ); ?>
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

			<div class="rh-ultra-media-count-box">
				<?php
				ere_get_template_part( 'includes/widgets/ultra-grid-cards/card-parts/media-count' );
				?>
			</div>

		</div>
		<div class="rh-ultra-bottom-box rh-ultra-flex-end">
			<div class="rh-ultra-action-buttons rh-ultra-action-dark hover-dark">
				<?php
				if ( function_exists( 'inspiry_favorite_button' ) ) {
					inspiry_favorite_button( get_the_ID(), '', '', '/common/images/icons/ultra-favourite.svg' );
				}
				if ( function_exists( 'inspiry_add_to_compare_button' ) ) {
					inspiry_add_to_compare_button();
				}
				?>
			</div>
		</div>
	</div>
	<div class="rh-ultra-card-detail-wrapper">

		<?php
		ere_get_template_part( 'includes/widgets/ultra-grid-cards/card-parts/heading' );
		ere_get_template_part( 'includes/widgets/ultra-grid-cards/card-parts/address' );
		$type_terms = get_the_terms( get_the_ID(), "property-type" );
		if ( ! empty( $type_terms ) ) {
			if ( function_exists( 'ere_get_property_types' ) && ! empty( ere_get_property_types( get_the_ID() ) ) ) {
				?>
				<span class="rh-ultra-property-types">
                    <?php
                    echo ere_get_property_types( get_the_ID() );
                    ?>
                </span>
				<?php
			}
		}
		?>
		<div class="rh-ultra-price-meta-box hide-ultra-price-postfix-separator">
			<?php
			ere_get_template_part( 'includes/widgets/ultra-grid-cards/card-parts/price' );
			ere_get_template_part( 'includes/widgets/ultra-grid-cards/card-parts/grid-card-meta' );
			?>
		</div>
	</div>
</div>
