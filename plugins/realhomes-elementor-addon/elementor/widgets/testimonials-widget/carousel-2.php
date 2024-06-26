<?php
/**
 * This file contains the carousel 2 variation of Ultra Testimonials widget.
 *
 * @version 2.3.0
 */

global $settings, $widget_id, $testimonials;
?>

<div class="rhea-testimonials-carousel-wrapper-2" id="rhea-testimonials-container-<?php echo esc_html( $widget_id ); ?>">

    <div class="rhea-testimonials-nav ">
        <a class="rhea-testimonials-carousel-nav-prev rhea-testimonials-carousel-nav" aria-label="Previous">
			<?php rhea_safe_include_svg( 'icons/thin-arrow-left.svg' ); ?>
        </a>
        <a class="rhea-testimonials-carousel-nav-next rhea-testimonials-carousel-nav" aria-label="Next">
			<?php rhea_safe_include_svg( 'icons/thin-arrow-left.svg' ); ?>
        </a>
    </div>

    <div class="rhea-testimonials-2-box rhea-testimonials-carousel-2">
		<?php
		foreach ( $testimonials as $testimonial ) {
			?>
            <div class="testimonials-card-wrapper">
                <div class="testimonials-card">
					<?php
					if ( ! empty( $testimonial['text'] ) ) {
						?>
                        <p class="rhea-testimonial-text"><?php echo esc_html( $testimonial['text'] ); ?></p>
						<?php
					}
					?>
                    <div class="author-info-box">
                        <div class="author-thumb">
							<?php
							if ( ! empty( $testimonial['testimonial_author_thumb']['id'] ) ) {
								$author_thumbnail = wp_get_attachment_image_url( $testimonial['testimonial_author_thumb']['id'], 'small' );
							} else {
								$author_thumbnail = inspiry_get_raw_placeholder_url( 'thumbnail' );
							}
							?>
                            <img src="<?php echo esc_url( $author_thumbnail ); ?>" alt="<?php echo esc_attr( $testimonial['testimonial_author'] ) ?>">
                        </div>
                        <div class="author-title">
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
                </div>
            </div>
			<?php
		}
		?>
    </div>
</div>
<?php
$carousel_options                       = array();
$carousel_options['speed']              = (int)$settings['speed'];
$carousel_options['autoplaySpeed']      = (int)$settings['autoplay_speed'];
$carousel_options['autoplay']           = ( 'yes' == $settings['autoplay'] );
$carousel_options['pauseOnHover']       = ( 'yes' == $settings['pause_on_hover'] );
$carousel_options['pauseOnInteraction'] = ( 'yes' == $settings['pause_on_interaction'] );
$carousel_options['infinite']           = ( 'yes' == $settings['infinite'] );
?>
<script>
    'use strict';
    jQuery( document ).ready( function () {
        const settings              = <?php echo wp_json_encode( $carousel_options ); ?>;
        const testimonialsContainer = jQuery( "#rhea-testimonials-container-<?php echo esc_html( $widget_id ); ?>" ),
              testimonialsCarousel  = testimonialsContainer.find( ".rhea-testimonials-carousel-2" ),
              options               = {
                  speed              : settings.speed,
                  infinite           : settings.infinite,
                  autoplay           : settings.autoplay,
                  autoplaySpeed      : settings.autoplaySpeed,
                  pauseOnHover       : settings.pauseOnHover,
                  pauseOnInteraction : settings.pauseOnInteraction,
                  slidesToShow       : 3,
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
                          breakpoint : 1024,
                          settings   : {
                              slidesToShow : 3
                          }
                      },
                      {
                          breakpoint : 600,
                          settings   : {
                              slidesToShow : 2
                          }
                      },
                      {
                          breakpoint : 320,
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
