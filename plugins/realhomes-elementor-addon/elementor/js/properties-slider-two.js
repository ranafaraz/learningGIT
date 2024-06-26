/**
 * ES6 Class for Elementor Properties Slider Two Widget
 *
 * @since 1.0.2
 * */

class RHEAPropertiesSliderTwoWidgetClass extends elementorModules.frontend.handlers.Base {

    getDefaultSettings() {
        return {
            selectors : {
                sliderWrapper    : '.rhea-properties-slider-two-wrapper',
                propertiesSlider : '.rhea-properties-slider-two',
                sliderNav        : '.rhea-properties-slider-two-nav'
            }
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings( 'selectors' );
        return {
            $sliderWrapper    : this.$element.find( selectors.sliderWrapper ),
            $propertiesSlider : this.$element.find( selectors.propertiesSlider ),
            $sliderNav        : this.$element.find( selectors.sliderNav )
        };
    }

    bindEvents() {
        this.loadPropertiesSlider();
    }

    loadPropertiesSlider( event ) {

        let sliderWrapper    = this.elements.$sliderWrapper,
            propertiesSlider = this.elements.$propertiesSlider,
            sliderNav        = this.elements.$sliderNav;

        if ( jQuery().flexslider ) {
            jQuery( propertiesSlider ).flexslider( {
                animation          : "fade",
                slideshowSpeed     : 2000,
                animationSpeed     : 500,
                slideshow          : true,
                controlNav         : false,
                keyboardNav        : true,
                directionNav       : true,
                pauseOnHover       : false,
                customDirectionNav : sliderNav.find( 'a' ),
                start              : function ( slider ) {
                    slider.removeClass( 'loading' );
                }
            } );
        }

    }
}

jQuery( window ).on( 'elementor/frontend/init', () => {
    const propertiesSliderTwoHandler = ( $element ) => {
        elementorFrontend.elementsHandler.addHandler( RHEAPropertiesSliderTwoWidgetClass, {
            $element
        } );
    };

    elementorFrontend.hooks.addAction( 'frontend/element_ready/rhea-properties-slider-two-widget.default', propertiesSliderTwoHandler );
} );