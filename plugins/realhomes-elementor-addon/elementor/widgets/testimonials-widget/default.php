<?php
/**
 * This file contains the default variation of Ultra testimonials widget.
 *
 * @version 2.2.0
 */

global $settings, $widget_id, $repeater_testimonials;
?>
<div class="rhea-ultra-testimonials-wrapper" id="rhea_ultra-<?php echo esc_attr( $widget_id ); ?>">
    <div class="rhea-ultra-testimonials owl-carousel" id="rhea-carousel-<?php echo esc_attr( $widget_id ); ?>">
		<?php
		foreach ( $repeater_testimonials as $testimonial ) {
			?>
            <div class="rhea-ultra-testimonial-box-wrapper">
                <div class="rhea-ultra-testimonial-box">
                    <div class="rhea-ultra-testimonials-thumb rhea-ultra-bg-dots">
                        <div class="rhea-ultra-thumb">
                            <img src="<?php if ( ! empty( $testimonial['rhea_testimonial_author_thumb']['id'] ) ) {
								echo wp_get_attachment_image_url( $testimonial['rhea_testimonial_author_thumb']['id'], 'small' );
							} else {
								echo inspiry_get_raw_placeholder_url( 'thumbnail' );
							} ?>" alt="<?php echo esc_attr( $testimonial['rhea_testimonial_author'] ) ?>">
                        </div>
                    </div>
                    <div class="rhea-ultra-testimonials-details">
						<?php if ( ! empty( $testimonial['rhea_testimonial_text_strong'] ) ) { ?>
                            <p class="rhea-ultra-testimonial-strong">
								<?php
								echo esc_html( $testimonial['rhea_testimonial_text_strong'] );
								?>
                            </p>
							<?php
						}
						if ( ! empty( $testimonial['rhea_testimonial_text'] ) ) {
							?>
                            <p class="rhea-ultra-testimonial-light">
								<?php
								echo esc_html( $testimonial['rhea_testimonial_text'] );
								?>
                            </p>
							<?php
						}
						?>
                        <div class="rhea-ultra-testimonal-author">
							<?php
							if ( ! empty( $testimonial['rhea_testimonial_author'] ) ) {
								?>
                                <span class="rhea-author"><?php echo esc_html( $testimonial['rhea_testimonial_author'] ) ?></span>
								<?php
							}
							if ( ! empty( $testimonial['rhea_testimonial_author_designation'] ) ) {
								?>
                                <span class="rhea-author-designation"><?php echo esc_html( $testimonial['rhea_testimonial_author_designation'] ) ?></span>
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
    <div id="rhea-nav-<?php echo esc_attr( $widget_id ); ?>" class="rhea-ultra-nav-box rhea-ultra-owl-nav owl-nav">
        <div id="rhea-dots-<?php echo esc_attr( $widget_id ); ?>" class="rhea-ultra-owl-dots owl-dots"></div>
    </div>
</div>
<script type="application/javascript">
    jQuery( document ).ready( function () {
        jQuery( "#rhea-carousel-<?php echo esc_html( $widget_id ); ?>" ).owlCarousel( {
            animateOut    : 'animate__fadeOut',
            animateIn     : 'animate__fadeIn',
            items         : 1,
            nav           : true,
            dots          : true,
            dotsEach      : true,
            loop          : false,
            rtl           : rheaIsRTL(),
            smartSpeed    : 500,
            navText       : ['<i class="fas fa-caret-left"></i>', '<i class="fas fa-caret-right"></i>'],
            navContainer  : '#rhea-nav-<?php echo esc_html( $widget_id ); ?>',
            dotsContainer : '#rhea-dots-<?php echo esc_html( $widget_id ); ?>'
        } );
    } );
</script>