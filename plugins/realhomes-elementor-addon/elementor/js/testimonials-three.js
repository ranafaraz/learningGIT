/**
 * ES6 Class for Elementor Testimonials Three Widget
 *
 * @since 1.0.2
 * */

class RHEATestimonialsThreeWidgetClass extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors : {
                testimonialsWrapper     : '.rhea_testimonials_three_wrapper',
                testimonialsSliderThumb : '.rhea_testimonials_thumb_3',
                testimonialsSliderText  : '.rhea_testimonials_text_3',
                navigationWrap          : '.rhea-testimonials-navigation'
            }
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings( 'selectors' );
        return {
            $testimonialsWrapper     : this.$element.find( selectors.testimonialsWrapper ),
            $testimonialsSliderThumb : this.$element.find( selectors.testimonialsSliderThumb ),
            $testimonialsSliderText  : this.$element.find( selectors.testimonialsSliderText ),
            $navigationWrap          : this.$element.find( selectors.navigationWrap )
        };
    }

    bindEvents() {
        this.loadTestimonialsThreeSlider();
    }

    loadTestimonialsThreeSlider( event ) {

        let testimonialsWrap = this.elements.$testimonialsWrapper,
            sliderThumb      = this.elements.$testimonialsSliderThumb,
            sliderText       = this.elements.$testimonialsSliderText,
            navigationWrap   = this.elements.$navigationWrap,
            animationSpeed   = testimonialsWrap.data( 'animation-speed' ),
            slideShowSpeed   = testimonialsWrap.data( 'slideshow-speed' ),
            autoSlide        = testimonialsWrap.data( 'auto-slide' ),
            animationtype    = testimonialsWrap.data( 'animation-type' ),
            AnimationReverse = testimonialsWrap.data( 'reverse' ),
            animationText    = testimonialsWrap.data( 'animation-text' ),
            reverseText      = testimonialsWrap.data( 'reverse-text' );

        if ( jQuery().flexslider ) {
            jQuery( sliderThumb ).flexslider( {
                controlNav     : false,
                directionNav   : false,
                animationLoop  : true,
                slideshow      : autoSlide,
                direction      : 'horizontal',
                animation      : animationtype,
                reverse        : AnimationReverse,
                animationSpeed : animationSpeed,
                slideshowSpeed : slideShowSpeed
            } );

            jQuery( sliderText ).flexslider( {
                controlNav         : false,
                animation          : animationText,
                animationLoop      : true,
                slideshow          : autoSlide,
                reverse            : reverseText,
                customDirectionNav : navigationWrap.find( 'a' ),
                sync               : jQuery( sliderThumb ),
                animationSpeed     : animationSpeed,
                slideshowSpeed     : slideShowSpeed
            } );
        }

    }
}

jQuery( window ).on( 'elementor/frontend/init', () => {
    const testimonialsThreeHandler = ( $element ) => {
        elementorFrontend.elementsHandler.addHandler( RHEATestimonialsThreeWidgetClass, {
            $element
        } );
    };

    elementorFrontend.hooks.addAction( 'frontend/element_ready/inspiry-testimonial-three-widget.default', testimonialsThreeHandler );
} );
