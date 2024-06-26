/**
 * ES6 Class for Elementor Properties Slider Widget
 *
 * @since 1.0.2
 * */

class RHEAPropertiesSliderWidgetClass extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors : {
                sliderWrapper    : '.rhea-properties-slider-wrapper',
                propertiesSlider : '.rhea-properties-slider',
                sliderNav        : '.rhea-properties-slider-nav'
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
            contentWrapper   = sliderWrapper.find( '.rhea-properties-content-wrap' ),
            propertiesSlider = this.elements.$propertiesSlider,
            sliderNav        = this.elements.$sliderNav;

        if ( jQuery().flexslider ) {
            jQuery( propertiesSlider ).flexslider( {
                animation          : "fade",
                slideshowSpeed     : 7000,
                animationSpeed     : 1500,
                slideshow          : true,
                controlNav         : false,
                keyboardNav        : true,
                directionNav       : true,
                pauseOnHover       : true,
                customDirectionNav : sliderNav.find( '.nav-buttons' ),
                start              : function ( slider ) {
                    slider.removeClass( 'loading' );
                }
            } );
        }

        jQuery.each( sliderWrapper.find( '.rhea-properties-meta' ), function ( key, value ) {

            let metaItems = jQuery( value ).find( '.rhea-properties-meta-item' );

            // Toggles class on first item on hover.
            metaItems.first().hover(
                function () {
                    contentWrapper.addClass( 'disable-border-radius disable-first-border-radius' );
                }, function () {
                    contentWrapper.removeClass( 'disable-border-radius disable-first-border-radius' );
                }
            );

            if ( metaItems.length > 2 ) {

                // Toggles class on last item on hover.
                metaItems.last().hover(
                    function () {
                        contentWrapper.addClass( 'disable-border-radius disable-last-border-radius' );
                    }, function () {
                        contentWrapper.removeClass( 'disable-border-radius disable-last-border-radius' );
                    }
                );
            }

        } );

    }
}

jQuery( window ).on( 'elementor/frontend/init', () => {
    const propertiesSliderHandler = ( $element ) => {
        elementorFrontend.elementsHandler.addHandler( RHEAPropertiesSliderWidgetClass, {
            $element
        } );
    };

    elementorFrontend.hooks.addAction( 'frontend/element_ready/rhea-properties-slider-widget.default', propertiesSliderHandler );
} );