<?php
/**
 * This file contains the carousel variation of Ultra testimonials widget.
 *
 * @version 2.2.0
 */

global $settings, $widget_id, $testimonials;
?>
<div id="rhea-testimonials-container-<?php echo esc_attr( $widget_id ); ?>" class="rhea-testimonials-container">
    <div class="rhea-testimonials-section-head">
		<?php
		if ( ! empty( $settings['testimonials_section_title'] ) ) {
			?>
            <h2 class="rhea-testimonials-section-heading"><?php echo esc_html( $settings['testimonials_section_title'] ); ?></h2>
			<?php
		}
		?>
        <div class="rhea-testimonials-nav">
            <a class="rhea-testimonials-carousel-nav-prev rhea-testimonials-carousel-nav" aria-label="Previous">
                <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 1L1 7L7 13" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a>
            <a class="rhea-testimonials-carousel-nav-next rhea-testimonials-carousel-nav" aria-label="Next">
                <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L7 7L1 13" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a>
        </div>
    </div>
    <div class="rhea-testimonials-carousel-wrapper">
        <div class="rhea-testimonials-carousel">
			<?php
			$star_svg = '<svg width="20" height="20" viewBox="0 0 20 20" class="rating-stars" xmlns="http://www.w3.org/2000/svg"><path d="M9.04894 2.92705C9.3483 2.00574 10.6517 2.00574 10.9511 2.92705L12.0206 6.21885C12.1545 6.63087 12.5385 6.90983 12.9717 6.90983H16.4329C17.4016 6.90983 17.8044 8.14945 17.0207 8.71885L14.2205 10.7533C13.87 11.0079 13.7234 11.4593 13.8572 11.8713L14.9268 15.1631C15.2261 16.0844 14.1717 16.8506 13.388 16.2812L10.5878 14.2467C10.2373 13.9921 9.7627 13.9921 9.41221 14.2467L6.61204 16.2812C5.82833 16.8506 4.77385 16.0844 5.0732 15.1631L6.14277 11.8713C6.27665 11.4593 6.12999 11.0079 5.7795 10.7533L2.97933 8.71885C2.19562 8.14945 2.59839 6.90983 3.56712 6.90983H7.02832C7.46154 6.90983 7.8455 6.63087 7.97937 6.21885L9.04894 2.92705Z" /></svg>';

			foreach ( $testimonials as $testimonial ) {
				?>
                <div class="rhea-testimonial-wrapper">
                    <div class="rhea-testimonial-top">
                        <div class="rhea-testimonial-author-info">
							<?php
							if ( ! empty( $testimonial['testimonial_author_thumb']['id'] ) ) {
								$author_thumbnail = wp_get_attachment_image_url( $testimonial['testimonial_author_thumb']['id'], 'small' );
							} else {
								$author_thumbnail = inspiry_get_raw_placeholder_url( 'thumbnail' );
							}
							?>
                            <img src="<?php echo esc_url( $author_thumbnail ); ?>" alt="<?php echo esc_attr( $testimonial['testimonial_author'] ) ?>">
                            <div class="rhea-testimonial-author-info-inner">
								<?php
								if ( ! empty( $testimonial['testimonial_author'] ) ) {
									?>
                                    <h4 class="rhea-testimonial-author-name"><?php echo esc_html( $testimonial['testimonial_author'] ) ?></h4>
									<?php
								}

								if ( ! empty( $testimonial['testimonial_author_designation'] ) ) {
									?>
                                    <span class="rhea-testimonial-author-designation"><?php echo esc_html( $testimonial['testimonial_author_designation'] ) ?></span>
									<?php
								}
								?>
                            </div>
                        </div>
						<?php
						if ( ! empty( $testimonial['rating'] ) && $star_svg ) {
							$rating = intval( $testimonial['rating'] );
							?>
                            <div class="rhea-testimonial-rating">
								<?php
								for ( $i = 1; $i <= 5; $i++ ) {
									if ( $i <= $rating ) {
										echo str_replace( 'rating-stars', 'rating-stars-colored', $star_svg );
									} else {
										echo $star_svg;
									}
								}
								?>
                            </div>
							<?php
						}
						?>
                    </div>
                    <div class="rhea-testimonial-content">
						<?php
						if ( ! empty( $testimonial['heading'] ) ) {
							?>
                            <h3 class="rhea-testimonial-heading"><?php echo esc_html( $testimonial['heading'] ); ?></h3>
							<?php
						}

						if ( ! empty( $testimonial['text'] ) ) {
							?>
                            <p class="rhea-testimonial-text"><?php echo esc_html( $testimonial['text'] ); ?></p>
							<?php
						}
						?>
                    </div>
                </div>
				<?php
			}

			$carousel_options                       = array();
			$carousel_options['speed']              = (int)$settings['speed'];
			$carousel_options['autoplaySpeed']      = (int)$settings['autoplay_speed'];
			$carousel_options['autoplay']           = ( 'yes' == $settings['autoplay'] );
			$carousel_options['pauseOnHover']       = ( 'yes' == $settings['pause_on_hover'] );
			$carousel_options['pauseOnInteraction'] = ( 'yes' == $settings['pause_on_interaction'] );
			$carousel_options['infinite']           = ( 'yes' == $settings['infinite'] );
			?>
        </div>
    </div>
</div>
<script>
    'use strict';
    jQuery( document ).ready( function () {
        const settings              = <?php echo wp_json_encode( $carousel_options ); ?>;
        const testimonialsContainer = jQuery( "#rhea-testimonials-container-<?php echo esc_html( $widget_id ); ?>" ),
              testimonialsCarousel  = testimonialsContainer.find( ".rhea-testimonials-carousel" ),
              options               = {
                  speed              : settings.speed,
                  infinite           : settings.infinite,
                  autoplay           : settings.autoplay,
                  autoplaySpeed      : settings.autoplaySpeed,
                  pauseOnHover       : settings.pauseOnHover,
                  pauseOnInteraction : settings.pauseOnInteraction,
                  slidesToShow       : 4,
                  slidesToScroll     : 1,
                  arrows             : true,
                  dots               : false,
                  prevArrow          : testimonialsContainer.find( '.rhea-testimonials-carousel-nav-prev' ),
                  nextArrow          : testimonialsContainer.find( '.rhea-testimonials-carousel-nav-next' ),
                  vertical           : false,
                  mobileFirst        : true,
                  adaptiveHeight     : true,
                  rtl                : rheaIsRTL(),
                  responsive         : [
                      {
                          breakpoint : 1400,
                          settings   : {
                              slidesToShow : 4
                          }
                      },
                      {
                          breakpoint : 1024,
                          settings   : {
                              slidesToShow : 3
                          }
                      },
                      {
                          breakpoint : 768,
                          settings   : {
                              slidesToShow : 2
                          }
                      },
                      {
                          breakpoint : 220,
                          settings   : {
                              slidesToShow : 1
                          }
                      }
                  ]
              };

        if ( jQuery().slick ) {
            testimonialsCarousel.slick( options );
        }
    } );
</script>
