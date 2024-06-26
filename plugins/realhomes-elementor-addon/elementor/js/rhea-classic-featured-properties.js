/**
 * ES6 Class for Classic Featured Properties Widget
 *
 * @since 1.0.2
 * */
class RheaClassicFeaturedProperties extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors : {
                carouselWrap : '.rhea_classic_featured_properties'
            }
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings( 'selectors' );
        return {
            $carouselWrap : this.$element.find( selectors.carouselWrap )
        };
    }

    bindEvents() {
        this.loadFlexOnFeaturedProperties();
    }

    loadFlexOnFeaturedProperties( event ) {

        let carouselWrap   = this.elements.$carouselWrap,
            animation      = carouselWrap.data( 'animation' ),
            slideSpeed     = carouselWrap.data( 'slide-speed' ),
            animationSpeed = carouselWrap.data( 'animation-speed' ),
            navStatus      = carouselWrap.data( 'show-nav' );
        
        if ( jQuery().flexslider ) {
            jQuery( this.elements.$carouselWrap ).each( function () {
                jQuery( this ).flexslider( {
                    animation      : animation,
                    slideshowSpeed : slideSpeed,
                    animationSpeed : animationSpeed,
                    slideshow      : true,
                    directionNav   : false,
                    controlNav     : navStatus,
                    keyboardNav    : true
                } );
            } );
        }
    }
}

jQuery( window ).on( 'elementor/frontend/init', () => {
    const RHEAClassicFeaturedWidgetHandler = ( $element ) => {
        elementorFrontend.elementsHandler.addHandler( RheaClassicFeaturedProperties, {
            $element
        } );
    };

    elementorFrontend.hooks.addAction( 'frontend/element_ready/ere-classic-featured-properties-widget.default', RHEAClassicFeaturedWidgetHandler );
} );