/**
 * ES6 Class for Elementor Testimonials Four Widget
 *
 * @since 1.0.2
 * */

class RHEATestimonialsFourWidgetClass extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors : {
                testimonialsWrapper : '.rhea_testimonials_4_widget',
                testimonialsSlider  : '.rhea_testimonials_4_widget_flexslider',
                sliderNavigation    : '.rhea_testimonials_4_widget_navigation'
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
            aninationSpeed     = testimonialsWrap.data( 'animation-speed' ),
            reverse            = testimonialsWrap.data( 'reverse' ),
            autoSlide          = testimonialsWrap.data( 'auto-slide' ),
            slideShowSpeed     = testimonialsWrap.data( 'slidershow-speed' );

        if ( jQuery().flexslider ) {
            jQuery( testimonialsSlider ).flexslider( {
                controlNav     : false,
                directionNav   : false,
                animation      : animationType,
                animationSpeed : aninationSpeed,
                reverse        : reverse,
                slideshow      : autoSlide,
                slideshowSpeed : slideShowSpeed
            } );

            jQuery( sliderNavigation ).on( 'click', 'a', function ( event ) {
                jQuery( testimonialsSlider ).flexslider( jQuery( this ).attr( 'href' ) );
                event.preventDefault();
            } );
        }

    }
}

jQuery( window ).on( 'elementor/frontend/init', () => {
    const testimonialsFourHandler = ( $element ) => {
        elementorFrontend.elementsHandler.addHandler( RHEATestimonialsFourWidgetClass, {
            $element
        } );
    };

    elementorFrontend.hooks.addAction( 'frontend/element_ready/inspiry-testimonial-four-widget.default', testimonialsFourHandler );
} );
