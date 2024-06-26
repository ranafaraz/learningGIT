<?php
/**
 * This file contains the carousel variation of Ultra featured properties widget.
 *
 * @version 2.2.0
 */

global $settings, $widget_id, $featured_properties_query;
?>
<div class="rhea-featured-properties-container">
	<?php
	$properties_filters = array();

	if ( 'yes' == $settings['show_filters'] ) {
		if ( class_exists( 'ERE_Data' ) ) {
			$status_terms = ERE_Data::get_statuses_slug_name();
			$count        = 1;
			foreach ( $status_terms as $name ) {
				$properties_filters[ 'properties-filter-' . $count ]['name'] = $name;
				$count++;
			}
		}

		if ( 0 < count( $properties_filters ) ) {
			?>
            <div class="rhea-featured-properties-filters-wrap">
                <ul id="rhea-featured-properties-filters-<?php echo esc_attr( $widget_id ); ?>" class="rhea-featured-properties-filters">
                    <li data-filter="rhea-featured-properties-carousel-item" class="active"><?php esc_html_e( 'All', 'realhomes-elementor-addon' ); ?></li>
					<?php
					foreach ( $properties_filters as $properties_filter_key => $item ) {
						echo '<li data-filter="' . esc_attr( $properties_filter_key ) . '">' . esc_html( $item['name'] ) . '</li>';
					}
					?>
                </ul>
            </div>
			<?php
		}
	}
	?>
    <div class="rhea-featured-properties-wrapper">
        <div id="rhea-featured-properties-<?php echo esc_attr( $widget_id ) ?>" class="rhea-featured-properties-carousel-inner">
			<?php
			while ( $featured_properties_query->have_posts() ) {
				$featured_properties_query->the_post();

				$property_id           = get_the_ID();
				$property_item_classes = '';

				if ( is_array( $properties_filters ) && 0 < count( $properties_filters ) ) {
					// Getting list of property status terms.
					$terms = get_the_terms( $property_id, 'property-status' );

					// Condition to make sure that terms doesn't have a wp_error
					if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
						/**
						 * Managing a terms list with assigned substitute
						 * keys and term names for the classes to be used
						 * with isotopes js library.
						 */
						foreach ( $terms as $term ) {
							$property_item_classes .= ' ';
							foreach ( $properties_filters as $properties_filter_key => $item ) {
								if ( $item['name'] === $term->name ) {
									$property_item_classes .= $properties_filter_key;
									$property_item_classes .= ' ';
									$property_item_classes .= $term->slug;
								}
							}
						}
					}
				}

				if ( has_post_thumbnail( $property_id ) ) {
					$post_thumbnail_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id( $property_id ), 'thumbnail', $settings );
				} else {
					$post_thumbnail_url = get_inspiry_image_placeholder_url( 'modern-property-child-slider' );
				}
				?>
                <div class="rhea-featured-properties-carousel-item <?php echo esc_attr( $property_item_classes ); ?>">
                    <div class="rhea-featured-properties-property">
                        <div class="rhea-featured-properties-property-thumb">
                            <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( $post_thumbnail_url ); ?>" alt="<?php the_title(); ?>"></a>
                        </div>
                        <div class="rhea-featured-properties-property-content">
                            <h3 class="rhea-featured-properties-property-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<?php
							if ( 'yes' == $settings['show_address'] ) {
								$REAL_HOMES_property_address = get_post_meta( get_the_ID(), 'REAL_HOMES_property_address', true );
								if ( ! empty( $REAL_HOMES_property_address ) ) {
									// triggering related scripts function
									do_action( 'realhomes_enqueue_map_lightbox_essentials' );
									?>
                                    <a <?php rhea_lightbox_data_attributes( $widget_id, get_the_ID() ) ?> href="<?php the_permalink(); ?>">
                                        <span class="rhea-featured-properties-property-address"><?php echo esc_html( $REAL_HOMES_property_address ); ?></span>
                                    </a>
									<?php
								}
							}

							rhea_get_template_part( 'assets/partials/ultra/grid-card-meta' );
							?>
                            <div class="rhea-featured-properties-property-footer">
                                <p class="rhea-featured-properties-property-price">
									<?php
									if ( function_exists( 'ere_property_price' ) ) {
										ere_property_price( get_the_ID() );
									}
									?>
                                </p>
                                <a class="rhea-featured-properties-property-link" href="<?php the_permalink(); ?>">
									<?php esc_html_e( 'View Details', 'realhomes-elementor-addon' ); ?>
                                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 1L5 5L1 9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
				<?php
			}
			?>
        </div>
    </div>
</div><!-- .rhea-featured-properties-container -->
<script>
    jQuery( document ).ready( function () {
        const $slider       = jQuery( "#rhea-featured-properties-<?php echo esc_attr( $widget_id ); ?>" ),
              sliderOptions = {
                  slidesToShow   : 3,
                  slidesToScroll : 1,
                  rtl            : rheaIsRTL(),
                  arrows         : true,
                  dots           : false,
                  adaptiveHeight : true,
                  infinite       : false,
                  prevArrow      : '<a href="#" class="rhea-properties-carousel-nav-prev rhea-properties-carousel-nav" aria-label="Previous"><svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 1L1 7L7 13" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></a>',
                  nextArrow      : '<a href="#" class="rhea-properties-carousel-nav-next rhea-properties-carousel-nav" aria-label="Next"><svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L7 7L1 13" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></a>',
                  responsive     : [
                      {
                          breakpoint : 1100,
                          settings   : {
                              slidesToShow : 2
                          }
                      },
                      {
                          breakpoint : 767,
                          settings   : {
                              slidesToShow : 1
                          }
                      },
                      {
                          breakpoint : 0,
                          settings   : {
                              slidesToShow : 1
                          }
                      }
                  ]
              };

        $slider.slick( sliderOptions );

        const filtersContainer = jQuery( "#rhea-featured-properties-filters-<?php echo esc_attr( $widget_id ); ?>" ),
              filtersList      = filtersContainer.find( 'li' ),
              filters          = {};

        if ( filtersList.length ) {
            jQuery.each( filtersList, function ( key, value ) {
                let selector = jQuery( value ).data( 'filter' );

                filters[selector] = $slider.find( '.rhea-featured-properties-carousel-item' + '.' + selector );
            } );
        }

        filtersContainer.on( 'click', 'li', function ( event ) {
            let self     = jQuery( this ),
                selector = self.data( 'filter' );

            if ( self.hasClass( 'active' ) ) {
                return false;
            }

            filtersContainer.find( 'li' ).removeClass( 'active' );
            self.addClass( 'active' );

            $slider.slick( 'unslick' );
            $slider.empty();
            $slider.append( filters[selector] );

            if ( filters[selector].length > 2 ) {
                $slider.slick( sliderOptions );
            }

            event.preventDefault();
        } );
    } );
</script>
