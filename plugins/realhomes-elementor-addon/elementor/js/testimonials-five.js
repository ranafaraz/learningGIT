/**
 * ES6 Class for Elementor Testimonials Five Widget
 *
 * @since 1.0.2
 * */

class RHEATestimonialsFiveWidgetClass extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors : {
                testimonialsWrapper : '.rhea-testimonials-5-widget',
                testimonialsSlider  : '.rhea-testimonials-5-widget-carousel',
                sliderNavigation    : '.rhea-testimonials-5-widget-carousel-dots'
            }
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings( 'selectors' );
        return {
            $testimonialsWrapper : this.$element.find( selectors.testimonialsWrapper ),
            $testimonialsSlider  : this.$element.find( selectors.testimonialsSlider ),
            $sliderNavigation    : this.$element.find( selectors.sliderNavigation )
        };
    }

    bindEvents() {
        this.loadTestimonialsSlider();
    }

    loadTestimonialsSlider( event ) {

        let testimonialsWrap   = this.elements.$testimonialsWrapper,
            testimonialsSlider = this.elements.$testimonialsSlider,
            sliderNavigation   = this.elements.$sliderNavigation,
            animationType      = testimonialsWrap.data( 'animation-type' ),
            animationSpeed     = testimonialsWrap.data( 'animation-speed' ),
            autoplay           = testimonialsWrap.data( 'autoplay' ),
            autoplaySpeed      = testimonialsWrap.data( 'autoplay-speed' ),
            animationLoop      = testimonialsWrap.data( 'animation-loop' );

        if ( jQuery().owlCarousel ) {

            let carouselOptions = {
                items              : 1,
                margin             : 0,
                nav                : false,
                autoHeight         : true,
                loop               : animationLoop,
                autoplay           : autoplay,
                autoplayTimeout    : autoplaySpeed,
                autoplayHoverPause : true,
                smartSpeed         : animationSpeed,
                dotsContainer      : sliderNavigation,
                rtl                : jQuery( 'body' ).hasClass( 'rtl' )
            };

            if ( 'fade' === animationType ) {
                carouselOptions.animateOut = 'fadeOut';
                carouselOptions.animateIn  = 'fadeIn';
            }

            jQuery( testimonialsSlider ).owlCarousel( carouselOptions );
        }

    }
}

jQuery( window ).on( 'elementor/frontend/init', () => {
    const testimonialsFiveHandler = ( $element ) => {
        elementorFrontend.elementsHandler.addHandler( RHEATestimonialsFiveWidgetClass, {
            $element
        } );
    };

    elementorFrontend.hooks.addAction( 'frontend/element_ready/inspiry-testimonial-five-widget.default', testimonialsFiveHandler );
} );
