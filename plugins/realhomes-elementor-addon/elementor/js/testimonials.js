/**
 * ES6 Class for Elementor Testimonials Widget
 *
 * @since 1.0.2
 * */

class RHEATestimonialsWidgetClass extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors : {
                testimonialsWrapper : '.rhea_testimonial_2_wrapper',
                testimonialsSlider  : '.rhea_testimonials_slider'
            }
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings( 'selectors' );
        return {
            $testimonialsWrapper : this.$element.find( selectors.testimonialsWrapper ),
            $testimonialsSlider  : this.$element.find( selectors.testimonialsSlider )
        };
    }

    bindEvents() {
        this.loadFeaturedPropertiesSlider();
    }

    loadFeaturedPropertiesSlider( event ) {

        let testimonialsWrap   = this.elements.$testimonialsWrapper,
            testimonialsSlider = this.elements.$testimonialsSlider,
            slidesCountFluid   = testimonialsWrap.data( 'slides-fluid' ),
            slidesCount        = testimonialsWrap.data( 'slides-count' ),
            slidesCountTab     = testimonialsWrap.data( 'slides-count-tab' ),
            slidesCountMobile  = testimonialsWrap.data( 'slides-count-mobile' ),
            sliderGap          = testimonialsWrap.data( 'slider-gap' ),
            navDots            = testimonialsWrap.data( 'nav-dots' ),
            rtl                = testimonialsWrap.data( 'rtl' );

        if ( jQuery().owlCarousel ) {
            jQuery( testimonialsSlider ).owlCarousel( {
                loop       : false,
                dots       : navDots,
                nav        : false,
                margin     : sliderGap,
                rtl        : rtl,
                responsive : {
                    0    : {
                        items : slidesCountMobile
                    },
                    767  : {
                        items : slidesCountTab
                    },
                    1024 : {
                        items : slidesCount
                    },
                    1440 : {
                        items : slidesCountFluid
                    }
                }

            } );
        }

    }
}

jQuery( window ).on( 'elementor/frontend/init', () => {
    const testimonialsHandler = ( $element ) => {
        elementorFrontend.elementsHandler.addHandler( RHEATestimonialsWidgetClass, {
            $element
        } );
    };

    elementorFrontend.hooks.addAction( 'frontend/element_ready/inspiry-testimonial-widget.default', testimonialsHandler );
} );