<div class="content-wrapper single-property-section">
    <div class="container">
        <div class="rh_property__row rh_property__meta rh_property--borderBottom">
			<?php
			$property_id                     = get_post_meta( get_the_ID(), 'REAL_HOMES_property_id', true );
			$display_social_share            = get_option( 'theme_display_social_share', 'true' );
			$theme_property_detail_variation = get_option( 'theme_property_detail_variation', 'default' );
			?>
            <div class="rh_property__id">
                <p class="title"><?php esc_html_e( 'Property ID', 'framework' ); ?> :&nbsp;</p>
                <p class="id">
					<?php
					if ( ! empty( $property_id ) ) :
						echo esc_html( $property_id );
					else :
						esc_html_e( 'None', 'framework' );
					endif;
					?>
                </p>
            </div>
            <div class="rh_property__print">
				<?php
				if ( 'true' === $display_social_share ) {
					$share_tooltip                = esc_html__( 'Share', 'framework' );
					$inspiry_share_property_label = get_option( 'inspiry_share_property_label' );

					if ( ! empty( $inspiry_share_property_label ) ) {
						$share_tooltip = $inspiry_share_property_label;
					}
					?>
                    <a href="#" class="share" id="social-share" data-tooltip="<?php echo esc_attr( $share_tooltip ); ?>"><?php inspiry_safe_include_svg( '/images/icons/icon-share-2.svg' ); ?></a>
                    <div id="share-button-title" class="hide"><?php esc_html_e( 'Share', 'framework' ); ?></div>
                    <div class="share-this" data-check-mobile="<?php if ( wp_is_mobile() ) { echo esc_attr( 'mobile' ); } ?>" data-property-name="<?php the_title(); ?>" data-property-permalink="<?php the_permalink(); ?>"></div>
					<?php
				}

				// Display add to favorite button
				inspiry_favorite_button( get_the_ID() );

				$print_tooltip                = esc_html__( 'Print', 'framework' );
				$inspiry_print_property_label = get_option( 'inspiry_print_property_label' );
				if ( ! empty( $inspiry_print_property_label ) ) {
					$print_tooltip = $inspiry_print_property_label;
				}
				?>
                <a href="javascript:window.print()" class="print" data-tooltip="<?php echo esc_attr( $print_tooltip ); ?>">
					<?php inspiry_safe_include_svg( '/images/icons/icon-printer.svg' ); ?>
                </a>
	            <?php
	            if ( 'true' === get_option( 'realhomes_enable_report_property', 'false' ) ) {
		            ?>
                    <a class="report-this-property" href="#report-property-modal-<?php echo esc_attr( $property_id ); ?>" data-tooltip="<?php esc_attr_e( 'Report This Property', 'framework' ); ?>">
                        <i class="fas fa-flag"></i>
                    </a>
		            <?php
	            }
	            ?>
            </div>
        </div>
		<?php
		/**
		 * Property meta information.
		 */
		get_template_part( 'assets/modern/partials/property/single/meta' );

		$content_container_class = realhomes_printable_section( 'content', false );
		?>
        <h4 class="rh_property__heading <?php echo esc_attr( $content_container_class ); ?>"><?php esc_html_e( 'Description', 'framework' ); ?></h4>
        <div class="rh_content <?php echo esc_attr( $content_container_class ); ?>">
		    <?php the_content(); ?>
        </div>
    </div>
</div>