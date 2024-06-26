/**
 * ES6 Class for Elementor Featured Properties
 *
 * @since 1.0.2
 * */

class RHEAFeaturesPropertiesThreeWidgetClass extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors : {
                sectionWrap : '.rhea_features_properties_2',
                sliderWrap  : '.rhea_wrapper_fp_carousel .flexslider'
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
            sliderNav      = sectionWrap.find( '.rhea_fp_slider_nav' ),
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
                    smoothHeight       : true,
                    customDirectionNav : sliderNav.find( '.rhea_fp_nav' ),
                    start              : function ( slider ) {
                        slider.removeClass( 'loading' );
                    }
                } );
            } );
        }

    }
}

jQuery( window ).on( 'elementor/frontend/init', () => {
    const featuredPropertiesThreeHandler = ( $element ) => {
        elementorFrontend.elementsHandler.addHandler( RHEAFeaturesPropertiesThreeWidgetClass, {
            $element
        } );
    };

    elementorFrontend.hooks.addAction( 'frontend/element_ready/ere-featured-properties-three-widget.default', featuredPropertiesThreeHandler );
} );