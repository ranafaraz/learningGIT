<?php
/**
 * Gallery
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */
?>
<div class="rh-page-container container">
	<?php
	get_template_part( 'assets/ultra/partials/page-head' );

	// Display any contents after the page head and before the contents.
	do_action( 'inspiry_before_page_contents' );

	// Display page content area at top
	do_action( 'realhomes_content_area_at_top' );
	?>
    <div class="main-content">
		<?php
		/**
		 * Getting the property status terms and assigning these a
		 * unique key to manage in isotopes for all languages properly.
		 */
		$status_items = array();

		$gallery_properties_filters = get_option( 'realhomes_gallery_properties_filters', 'show' );
		if ( 'show' === $gallery_properties_filters && class_exists( 'ERE_Data' ) ) {
            $status_terms = ERE_Data::get_statuses_slug_name();
            $count        = 1;
            foreach ( $status_terms as $slug => $name ) {
                $key                          = 'status-' . $count;
                $status_items[ $key ]['name'] = $name;

                $property_count = get_term_by( 'slug', esc_html( $slug ), 'property-status' );
                if ( $property_count ) {
                    $status_items[ $key ]['count'] = $property_count->count;
                }

                $count++;
            }
			?>
            <div id="filter-by" class="properties-gallery-items-filters">
                <a href="#" data-filter="property-gallery-item" class="active"><?php esc_html_e( 'All', 'framework' ); ?></a>
				<?php
				if ( 0 < count( $status_items ) ) {
					foreach ( $status_items as $item_key => $item ) {
						$item_name   = $item['name'];
						$filter_name = $item_name . " (" . $item['count'] . ")";
						echo '<a href="#" data-filter="' . esc_attr( $item_key ) . '" title="' . sprintf( esc_html__( 'View all Properties having %s status', 'framework' ), esc_attr( $item_name ) ) . '">' . esc_html( $filter_name ) . '</a>';
					}
				}
				?>
            </div>
            <?php
        }
		?>
        <div class="properties-gallery-wrapper">
            <div id="properties-gallery-container" class="properties-gallery-container isotope">
				<?php
				if ( isset( $args['gallery_columns'] ) ) {
					$gallery_columns = $args['gallery_columns'];
				}

				global $gallery_properties;
				if ( isset( $args['gallery_properties'] ) ) {
					$gallery_properties = $args['gallery_properties'];
				}

				$paged = 1;
				if ( get_query_var( 'paged' ) ) {
					$paged = get_query_var( 'paged' );
				}

				$gallery_listing_args = array(
					'post_type' => 'property',
					'paged'     => $paged,
				);

				/**
				 * Gallery Property Arguments Filter.
				 *
				 * @var array
				 */
				$gallery_listing_args = apply_filters( 'inspiry_gallery_properties_filter', $gallery_listing_args );

				if ( 'show' === get_option( 'inspiry_gallery_properties_sorting', 'hide' ) ) {
					$gallery_listing_args = sort_properties( $gallery_listing_args );
				}

				// Gallery Query
				$gallery_query = new WP_Query( $gallery_listing_args );

				while ( $gallery_query->have_posts() ) {
					$gallery_query->the_post();

					$gallery_item_id      = get_the_ID();
					$gallery_item_classes = $gallery_columns;

					// Getting list of property status terms.
					$terms = get_the_terms( $gallery_item_id, 'property-status' );

					/**
					 * Condition to make sure that terms doesn't have a wp_error
					 * also that the assigned status keys variable is set as
					 * array and has at least one item in it.
					 */
					if ( ! empty( $terms ) && ! is_wp_error( $terms ) && is_array( $status_items ) && 0 < count( $status_items ) ) {
						/**
						 * Managing a terms list with assigned substitute
						 * keys and term names for the classes to be used
						 * with isotopes js library.
						 */
						foreach ( $terms as $term ) {
							$gallery_item_classes .= ' ';
							foreach ( $status_items as $item_key => $item ) {
								if ( $item['name'] === $term->name ) {
									$gallery_item_classes .= $item_key;
									$gallery_item_classes .= ' ';
									$gallery_item_classes .= $term->slug;
								}
							}
						}
					}
					?>
                    <div class="property-gallery-item isotope-item <?php echo esc_attr( $gallery_item_classes ); ?>">
                        <figure>
							<?php
							$get_post_meta_image = get_post_meta( $gallery_item_id, 'REAL_HOMES_property_images' );
							$get_prop_images     = count( $get_post_meta_image );

							$gallery_item_media_container_class = 'property-gallery-item-media-container';

							// Add the following container class, when there is no gallery and featured image.
							if ( ! has_post_thumbnail() && ! $get_prop_images ) {
								$gallery_item_media_container_class .= ' no-property-gallery-images';
							}
							?>
                            <div class="<?php echo esc_attr( $gallery_item_media_container_class ); ?>">
                                <a data-fancybox-trigger="gallery-<?php echo esc_attr( $gallery_item_id ); ?>" data-this-id="<?php echo esc_attr( $gallery_item_id ); ?>" class="zoom" href="javascript:;" title="<?php the_title_attribute(); ?>">
									<?php inspiry_safe_include_svg( '/icons/icon-zoom.svg' ); ?>
                                </a>
                                <a class="link" href="<?php the_permalink(); ?>">
									<?php inspiry_safe_include_svg( '/icons/icon-link.svg' ); ?>
                                </a>
                            </div>
							<?php
							if ( ! empty( get_the_post_thumbnail() ) ) {
								$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'modern-property-child-slider' );
								if ( isset( $featured_image[0] ) ) {
									echo '<img class="img-border" src="' . esc_attr( $featured_image[0] ) . '" alt="' . the_title_attribute( 'echo=0' ) . '">';
								}

							} else {
								// Set the first image from property gallery, if the featured image is not available.
								if ( $get_prop_images && isset( $get_post_meta_image[0] ) && ! empty( $get_post_meta_image[0] ) ) {
									$images_src = wp_get_attachment_image_src( $get_post_meta_image[0], 'modern-property-child-slider' );
									if ( isset( $images_src[0] ) ) {
										echo '<img class="img-border" src="' . esc_attr( $images_src[0] ) . '" alt="' . the_title_attribute( 'echo=0' ) . '">';
									} else {
										inspiry_image_placeholder( 'modern-property-child-slider' );
									}

								} else {
									inspiry_image_placeholder( 'modern-property-child-slider' );
								}
							}
							?>
                        </figure>
                        <h3 class="property-gallery-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="property-gallery-item-images">
							<?php
							$lightbox_item_format = '<span data-fancybox="gallery-%1$s" data-src="%2$s" data-thumb="%2$s"></span>';
							if ( $get_prop_images && isset( $get_post_meta_image[0] ) && ! empty( $get_post_meta_image[0] ) ) {
								foreach ( $get_post_meta_image as $item ) {
									$images_src = wp_get_attachment_image_src( $item, 'post-featured-image' );
									if ( isset( $images_src[0] ) ) {
										printf( $lightbox_item_format, esc_attr( $gallery_item_id ), esc_url( $images_src[0] ) );
									}
								}
							} else {
								$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post-featured-image' );
								if ( isset( $featured_image[0] ) ) {
									printf( $lightbox_item_format, esc_attr( $gallery_item_id ), esc_url( $featured_image[0] ) );
								}
							}
							?>
                        </div><!-- .property-gallery-item-images -->
                    </div><!-- .property-gallery-item -->
					<?php
				}

				wp_reset_postdata();
				?>
            </div><!-- .properties-gallery-container -->
			<?php inspiry_theme_pagination( $gallery_query->max_num_pages ); ?>
        </div><!-- .properties-gallery-wrapper -->
    </div><!-- .main-content -->
	<?php
	// Display page content area at bottom
	do_action( 'realhomes_content_area_at_bottom' );
	?>
</div><!-- .rh-page-container -->