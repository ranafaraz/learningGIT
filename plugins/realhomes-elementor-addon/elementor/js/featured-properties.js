/**
 * ES6 Class for Elementor Featured Properties
 *
 * @since 1.0.2
 * */

class RHEAFeaturesPropertiesWidgetClass extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors : {
                sectionWrap : '.rh_wrapper--featured_elementor',
                sliderWrap  : '.rh_section__featured_elementor'
            }
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings( 'selectors' );
        return {
            $sectionWrap : this.$element.find( selectors.sectionWrap ),
            $sliderWrap  : this.$element.find( selectors.sliderWrap )
        };
    }

    bindEvents() {
        this.loadFeaturedPropertiesSlider();
    }

    loadFeaturedPropertiesSlider( event ) {

        let sectionWrap    = this.elements.$sectionWrap,
            sliderWrap     = this.elements.$sliderWrap,
            sliderNav      = sliderWrap.find( '.rh_flexslider__nav_elementor' ),
            slideshow      = sectionWrap.data( 'slideshow' ),
            slideshowSpeed = sectionWrap.data( 'slideshow-speed' ),
            animationType  = sectionWrap.data( 'animation-type' ),
            animationSpeed = sectionWrap.data( 'animation-speed' );

        if ( jQuery().flexslider ) {
            jQuery( sliderWrap ).each( function () {
                jQuery( this ).flexslider( {
                    slideshow          : slideshow,
                    slideshowSpeed     : slideshowSpeed,
                    animationSpeed     : animationSpeed,
                    animation          : animationType,
                    pauseOnHover       : true,
                    directionNav       : true,
                    controlNav         : false,
                    keyboardNav        : true,
                    customDirectionNav : sliderNav.find( '.nav-mod' ),
                    start              : function ( slider ) {
                        slider.removeClass( 'loading' );
                    }
                } );
            } );
        }

    }
}

jQuery( window ).on( 'elementor/frontend/init', () => {
    const featuredPropertiesHandler = ( $element ) => {
        elementorFrontend.elementsHandler.addHandler( RHEAFeaturesPropertiesWidgetClass, {
            $element
        } );
    };

    elementorFrontend.hooks.addAction( 'frontend/element_ready/ere-featured-properties-widget.default', featuredPropertiesHandler );
} );