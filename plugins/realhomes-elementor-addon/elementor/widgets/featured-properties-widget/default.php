<?php
/**
 * This file contains the default variation of Ultra featured properties widget.
 *
 * @version 2.2.0
 */

global $settings, $widget_id, $featured_properties_query;
?>
<div class="rhea-ultra-featred-properties rhea-ultra-tooltip rhea-toolip-dark">
    <div class="rhea-ultra-slider-top-box">
        <div class="rhea-ultra-featured-thumb-slider">
            <div id="rhaa-slider-1-<?php echo esc_attr( $widget_id ) ?>" class="rhea-ultra-thumb-trigger">
				<?php
				while ( $featured_properties_query->have_posts() ) {
					$featured_properties_query->the_post();

					$post_id = get_the_ID();
					if ( has_post_thumbnail( $post_id ) ) {
						$post_thumbnail_url = get_the_post_thumbnail_url( $post_id, 'large' );
					} else {
						$post_thumbnail_url = get_inspiry_image_placeholder_url( 'property-thumb-image' );
					}
					?>
                    <div>
                        <div class="rhea-ultra-featured-slide">
                            <div class="rhea-ultra-thumb-box">
                                <div class="rhea-ultra-featured-thumbs rhea-featured-<?php echo esc_attr( $widget_id ) ?>" style="background-image: url('<?php echo esc_url( $post_thumbnail_url ); ?>')">
                                    <a <?php rhea_lightbox_data_attributes( $widget_id, $post_id, 'rhea-ultra-featured-map' ); ?> href="<?php the_permalink(); ?>">
                                        <img alt="<?php the_title(); ?>" src="<?php echo esc_url( RHEA_PLUGIN_URL . '/assets/images/map-featured.png' ); ?>">
                                    </a>
									<?php
									if ( 'none' !== $settings['adress_icon_type'] ) {
										$REAL_HOMES_property_address = get_post_meta( $post_id, 'REAL_HOMES_property_address', true );

										if ( isset( $REAL_HOMES_property_address ) && ! empty( $REAL_HOMES_property_address ) ) {

											if ( ! empty( $settings['address_image'] ) ) {
												?>
                                                <a <?php rhea_lightbox_data_attributes( $widget_id, $post_id, 'rhea-ultra-featured-map-icon rhea-image-icon' ); ?> href="<?php the_permalink(); ?>">
                                                    <img src="<?php echo esc_url( $settings['address_image']['url'] ); ?>">
                                                </a>
												<?php
											}

											if ( ! empty( $settings['address_icon'] ) ) {
												?>
                                                <a <?php rhea_lightbox_data_attributes( $widget_id, $post_id, 'rhea-ultra-featured-map-icon rhea-ultra-icon' ); ?> href="<?php the_permalink(); ?>">
													<?php \Elementor\Icons_Manager::render_icon( $settings['address_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                </a>
												<?php
											}
										}
									}
									?>

                                    <div class="rhea-ultra-bottom-box rhea-ultra-flex-between">
										<?php
										if ( 'yes' == $settings['ere_show_property_media_count'] ) {
											?>
                                            <div class="rhea-ultra-media-count-box">
												<?php
												rhea_get_template_part( 'assets/partials/ultra/media-count-2' );
												?>
                                            </div>
											<?php
										}
										?>
                                        <div class="rhea-ultra-action-buttons rh-ultra-action-dark hover-light">
											<?php
											if ( 'yes' === $settings['ere_enable_fav_properties'] ) {
												if ( function_exists( 'inspiry_favorite_button' ) ) {
													inspiry_favorite_button( $post_id, $settings['ere_property_fav_label'], $settings['ere_property_fav_added_label'], '/common/images/icons/ultra-favourite.svg', 'ultra' );
												}
											}

											rhea_get_template_part( 'assets/partials/ultra/compare' );
											?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="rhea-ultra-featured-content">
                                <div class="rhea-ultra-featured-top-info">
                                    <div class="rhea-ultra-status-box">
										<?php
										if ( 'yes' == $settings['ere_show_property_status'] ) {
											if ( function_exists( 'ere_get_property_statuses_ultra' ) ) {
												ere_get_property_statuses_ultra( $post_id, 'rhea-ultra-status' );
											}
										}

										if ( 'yes' == $settings['ere_show_featured_tag'] ) {
											$is_featured = get_post_meta( $post_id, 'REAL_HOMES_featured', true );

											if ( isset( $is_featured ) && $is_featured == '1' ) {
												?>
                                                <span class="rhea_ultra_featured">
                                                    <?php
                                                    if ( ! empty( $settings['ere_property_featured_label'] ) ) {
	                                                    echo esc_html( $settings['ere_property_featured_label'] );
                                                    } else {
	                                                    esc_html_e( 'Featured', 'realhomes-elementor-addon' );
                                                    }
                                                    ?>
												</span>
												<?php
											}
										}
										if ( 'yes' == $settings['ere_show_label_tags'] ) {
											$label_text = get_post_meta( $post_id, 'inspiry_property_label', true );
											if ( isset( $label_text ) && ! empty( $label_text ) ) {
												?>
                                                <span class="rhea_ultra_hot"><?php echo esc_html( $label_text ); ?></span>
												<?php
											}
										}
										?>
                                    </div>
									<?php
									$property_year_built = get_post_meta( $post_id, 'REAL_HOMES_property_year_built', true );
									if ( ! empty( $property_year_built ) ) {
										?>
                                        <span class="rhea-ultra-featured-year-build"><?php echo esc_html( $settings['property_build_label'] ) . ' ' . esc_html( $property_year_built ); ?></span>
										<?php
									}
									?>
                                </div>
								<?php
								rhea_get_template_part( 'assets/partials/ultra/heading' );
								rhea_get_template_part( 'assets/partials/ultra/address' );
								rhea_get_template_part( 'assets/partials/ultra/grid-card-meta' );
								rhea_get_template_part( 'assets/partials/ultra/price' );
								rhea_get_template_part( 'assets/partials/ultra/excerpt' );
								?>
                            </div>
                        </div>
                    </div>
					<?php
				}
				?>
            </div>
        </div>
        <div class="rhea-ultra-feature-nav-wrapper" id="rhea-nav-<?php echo esc_attr( $widget_id ) ?>">
            <div id="rhea-ultra-nav-<?php echo esc_attr( $widget_id ) ?>" class="rhea-ultra-nav">
                <div id="rhea-ultra-featured-dots-<?php echo esc_attr( $widget_id ) ?>" class="rhea-ultra-featured-dots"></div>
            </div>
        </div>
    </div>
    <div class="rhea-ultra-featured-thumbnail-carousel">
        <div class="rhea-ultra-thumbnail-carouse-wrapper">
            <div id="rhaa-slider-2-<?php echo esc_attr( $widget_id ) ?>" class="rhea-ultra-thumbnail-carousel">
				<?php
				while ( $featured_properties_query->have_posts() ) {
					$featured_properties_query->the_post();
					$carousel_id = get_the_ID();
					if ( has_post_thumbnail( $carousel_id ) ) {
						$carousel_thumbnail_url = get_the_post_thumbnail_url( $carousel_id, 'large' );
					} else {
						$carousel_thumbnail_url = get_inspiry_image_placeholder_url( 'property-thumb-image' );
					}
					?>
                    <div>
                        <div class="rhea-ultra-carousel-thumb-inner">
                            <a class="rhea-ultra-carousel-thumb" style="background-image: url('<?php echo esc_url( $carousel_thumbnail_url ); ?>')"></a>
                        </div>
                    </div>
					<?php
				}
				?>
            </div>
        </div>
        <div class="rhea-ultra-thumb-count">
			<?php include RHEA_ASSETS_DIR . 'icons/building.svg'; ?>
            <span class="rhea-slider-item-total"><?php echo esc_html( $featured_properties_query->post_count ); ?></span>
            <span class="rhea-more-slides"><?php esc_html_e( 'Properties', 'realhomes-elementor-addon' ) ?></span>
        </div>
    </div>
</div><!-- .rhea-ultra-featred-properties -->
<script>
    jQuery( document ).ready( function () {
        var $slider = jQuery( "#rhaa-slider-2-<?php echo esc_attr( $widget_id ); ?>" );

        jQuery( "#rhaa-slider-1-<?php echo esc_attr( $widget_id ); ?>" ).slick( {
            slidesToShow   : 1,
            slidesToScroll : 1,
            arrows         : true,
            dots           : true,
            fade           : true,
            rtl            : rheaIsRTL(),
            adaptiveHeight : true,
            infinite       : true,
            asNavFor       : "#rhaa-slider-2-<?php echo esc_attr( $widget_id ); ?>",
            prevArrow      : '<button class="rhea-slick-prev rhea-slick-nav" aria-label="Previous" type="button"><i class="fas fa-caret-left"></i></button>',
            nextArrow      : '<button class="rhea-slick-next rhea-slick-nav" aria-label="Next" type="button"><i class="fas fa-caret-right"></i></button>',
            appendArrows   : jQuery( "#rhea-ultra-nav-<?php echo esc_attr( $widget_id ) ?>" ),
            appendDots     : jQuery( "#rhea-ultra-featured-dots-<?php echo esc_attr( $widget_id ) ?>" )
        } );

        $slider.slick( {
            slidesToShow   : 3,
            slidesToScroll : 1,
            asNavFor       : "#rhaa-slider-1-<?php echo esc_attr( $widget_id ); ?>",
            dots           : false,
            arrows         : false,
            infinite       : true,
            centerMode     : true,
            focusOnSelect  : true,
            touchThreshold : 200,
            rtl            : rheaIsRTL(),
            centerPadding  : '0'
        } );
    } );
    jQuery( window ).on( 'load', function () {
        setTimeout( function () {
            rheaFeaturedNavPosition( ".rhea-featured-<?php echo esc_attr( $widget_id )?>", "#rhea-nav-<?php echo esc_attr( $widget_id )?>" );
        }, 500 )
    } );
    jQuery( window ).on( 'resize', function () {
        setTimeout( function () {
            rheaFeaturedNavPosition( ".rhea-featured-<?php echo esc_attr( $widget_id )?>", "#rhea-nav-<?php echo esc_attr( $widget_id )?>" );
        }, 500 )
    } );
</script>