<?php
/**
 * This file contains list card style one.
 *
 * @version 2.3.0
 */
global $settings, $is_list_view;

$property_id = get_the_ID();
$is_featured = get_post_meta( $property_id, 'REAL_HOMES_featured', true );
$label_text  = get_post_meta( $property_id, 'inspiry_property_label', true );
?>
<div class="rhea-ultra-property-list-card-outer rhea-ultra-property-list-card">
    <div class="rhea-ultra-property-list-card-thumb">
		<?php
		$post_thumbnail_url = get_the_post_thumbnail_url( $property_id, 'large' );
		if ( empty( $post_thumbnail_url ) ) {
			$post_thumbnail_url = get_inspiry_image_placeholder_url( 'large' );
		}
		?>
        <a class="rh-permalink rh-thumb-with-bg" href="<?php the_permalink() ?>" style="background-image: url('<?php echo esc_url( $post_thumbnail_url ); ?>')"></a>
		<?php
		if ( 'yes' == $settings['ere_show_property_media_count'] || $is_list_view ) {
			?>
            <div class="rhea-ultra-media-count-box">
				<?php rhea_get_template_part( 'assets/partials/ultra/media-count' ); ?>
            </div>
			<?php
		}
		?>
    </div>
    <div class="rhea-ultra-property-list-card-detail">
        <div class="rhea-ultra-property-list-card-detail-box">
			<?php
			if ( 'yes' == $settings['ere_show_property_status'] ||
				'yes' == $settings['ere_show_featured_tag'] ||
				'yes' == $settings['ere_show_label_tags'] ||
				( ! empty( $property_year_built ) && 'yes' == $settings['show_year_built'] ) ) {
				?>
                <div class="rhea-ultra-property-list-card-tags-wrapper">
                    <div class="rhea-ultra-status-box">
						<?php
						if ( 'yes' == $settings['ere_show_property_status'] || $is_list_view ) {
							if ( function_exists( 'ere_get_property_statuses_ultra' ) ) {
								ere_get_property_statuses_ultra( $property_id, 'rhea-ultra-status' );
							}
						}

						if ( 'yes' == $settings['ere_show_featured_tag'] || $is_list_view ) {
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

						if ( 'yes' == $settings['ere_show_label_tags'] || $is_list_view ) {
							rhea_display_property_label( $property_id, 'rhea_ultra_hot' );
						}
						?>
                    </div>
					<?php
					$property_year_built = get_post_meta( $property_id, 'REAL_HOMES_property_year_built', true );
					if ( ! empty( $property_year_built ) && ( 'yes' == $settings['show_year_built'] || $is_list_view ) ) {
						if ( ! empty( $settings['year_built_label'] ) ) {
							$build_label = $settings['year_built_label'];
						} else {
							$build_label = esc_html__( 'Build', 'realhomes-elementor-addon' );
						}
						?>
                        <div class="rhea-ultra-property-list-card-year-built">
							<?php echo esc_html( $build_label ) . ' ' . esc_html( $property_year_built ); ?>
                        </div>
						<?php
					}
					?>
                </div>
				<?php
			}
			?>
            <div class="rhea-ultra-property-list-card-heading">
                <div class="rhea-ultra-property-list-card-title-address">
					<?php
					rhea_get_template_part( 'assets/partials/ultra/heading' );
					rhea_get_template_part( 'assets/partials/ultra/address' );
					?>
                </div>
                <div class="rhea-ultra-property-list-card-price">
					<?php rhea_get_template_part( 'assets/partials/ultra/price' ); ?>
                </div>
            </div>
	        <?php
	        if ( 'yes' === $settings['show_list_card_excerpt'] ) {
		        $excerpt_length = ! empty( $settings['list_card_excerpt_length'] ) ? $settings['list_card_excerpt_length'] : 24;
		        $excerpt        = rhea_get_framework_excerpt( $excerpt_length, '' );
		        if ( ! empty( $excerpt ) ) {
			        ?>
                    <p class="rhea-ultra-property-list-card-excerpt"><?php echo esc_html( $excerpt ); ?></p>
			        <?php
		        }
	        }
	        ?>
        </div>
        <div class="rhea-ultra-property-list-card-meta-wrapper">
			<?php rhea_get_template_part( 'assets/partials/ultra/grid-card-meta' ); ?>
            <div class="rhea-ultra-bottom-box rh-ultra-action-buttons rh-ultra-action-light hover-light">
				<?php
				if ( ( 'yes' === $settings['ere_enable_fav_properties'] || $is_list_view ) && function_exists( 'inspiry_favorite_button' ) ) {
					inspiry_favorite_button( $property_id, $settings['ere_property_fav_label'], $settings['ere_property_fav_added_label'], '/common/images/icons/ultra-favourite.svg', 'ultra' );
				}

				if ( 'enable' === get_option( 'theme_compare_properties_module' ) && get_option( 'inspiry_compare_page' ) && ( 'yes' == $settings['ere_enable_compare_properties'] || $is_list_view ) ) {
					$property_img_url = get_the_post_thumbnail_url( $property_id, 'property-thumb-image' );
					if ( empty( $property_img_url ) ) {
						$property_img_url = get_inspiry_image_placeholder_url( 'property-thumb-image' );
					}
					?>
                    <span class="add-to-compare-span rhea_compare_icons rhea_svg_fav_icons compare-btn-<?php echo esc_attr( $property_id ); ?>" data-property-id="<?php echo esc_attr( $property_id ); ?>" data-property-title="<?php echo esc_attr( get_the_title( $property_id ) ); ?>" data-property-url="<?php echo esc_url( get_the_permalink( $property_id ) ); ?>" data-property-image="<?php echo esc_url( $property_img_url ); ?>">
                        <span class="compare-placeholder highlight hide rh-ui-tooltip" title="<?php echo esc_attr( $settings['ere_property_compare_added_label'] ); ?>"><?php include RHEA_ASSETS_DIR . 'icons/ultra-compare.svg'; ?></span>
                        <a class="rh_trigger_compare rhea_add_to_compare rh-ui-tooltip" title="<?php echo esc_attr( $settings['ere_property_compare_label'] ); ?>" href="<?php echo esc_url( get_the_permalink( $property_id ) ); ?>"><?php include RHEA_ASSETS_DIR . 'icons/ultra-compare.svg'; ?></a>
                    </span>
					<?php
				}
				?>
            </div>
        </div>
        <div class="rvr_card_info_wrap">
			<?php
			if ( rhea_is_rvr_enabled() ) {
				if ( $settings['rhea_rating_enable'] === 'yes' || $is_list_view ) {
					?>
                    <div class="rh-ultra-rvr-rating">
						<?php
						if ( 'true' === get_option( 'inspiry_property_ratings', 'false' ) ) {
							inspiry_rating_average_plain();
						}
						?>
                    </div>
					<?php
				}
			}
			?>
            <p class="added-date">
				<?php
				if ( $settings['ere_property_rvt_date_added_label'] ) {
					echo '<span class="added-title">' . esc_html( $settings['ere_property_rvt_date_added_label'] ) . '</span> ';
				}
				echo get_the_date();
				?>
            </p>
        </div>

    </div>
</div>