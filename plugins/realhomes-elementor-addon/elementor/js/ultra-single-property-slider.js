/**
 * ES6 Class for Elementor Ultra Single Property Slider
 *
 * @since 2.1.0
 * */

class RHEAUltraSinglePropertySlider extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {

        return {
            selectors : {
                propertySlider   : '.rhea-ultra-property-slider',
                propertyCarousel : '.rhea-ultra-horizontal-carousel-trigger'
            }
        };
    }

    getDefaultElements() {

        const selectors = this.getSettings( 'selectors' );
        return {
            $propertySlider   : this.$element.find( selectors.propertySlider ),
            $propertyCarousel : this.$element.find( selectors.propertyCarousel )

        };
    }

    bindEvents() {

        this.UltraSinglePropertySlider();
    }

    UltraSinglePropertySlider( event ) {

        let singlePropertySlider   = this.elements.$propertySlider;
        let singlePropertyCarousel = this.elements.$propertyCarousel;

        if ( jQuery().slick ) {

            let syncEnable = '';
            let centerMode = false;

            singlePropertyCarousel.on( 'init', function ( event, slick ) {
                if ( singlePropertyCarousel.data( 'count' ) > singlePropertyCarousel.find( '.slick-active' ).length ) {
                    syncEnable = singlePropertyCarousel;
                    centerMode = true;
                }
            } );

            singlePropertySlider.on( 'init afterChange', function ( event, slick ) {

                if ( syncEnable === '' ) {
                    singlePropertyCarousel.find( '.slick-slide' ).removeClass( 'slick-current' );
                    singlePropertyCarousel.find( '.slick-slide' ).eq( slick.currentSlide ).addClass( "slick-current" );
                }

            } );

            singlePropertyCarousel.slick( {
                slidesToShow   : 6,
                slidesToScroll : 1,
                asNavFor       : singlePropertySlider,
                // dots: false,
                infinite       : true,
                centerMode     : centerMode,
                focusOnSelect  : true,
                touchThreshold : 200,
                arrows         : false,
                centerPadding  : '0',
                rtl            : rheaIsRTL,
                responsive     : [
                    {
                        breakpoint : 1200,
                        settings   : {
                            slidesToShow : 4
                        }
                    },
                    {
                        breakpoint : 767,
                        settings   : {

                            slidesToShow : 3
                        }
                    }
                ]
            } );

            singlePropertySlider.slick( {
                slidesToShow   : 1,
                slidesToScroll : 1,
                arrows         : true,
                fade           : true,
                adaptiveHeight : true,
                infinite       : true,
                rtl            : rheaIsRTL,
                asNavFor       : syncEnable
            } );

        }
    }

}

jQuery( window ).on( 'elementor/frontend/init', () => {
    const singlePropertyWidgetHandler = ( $element ) => {
        elementorFrontend.elementsHandler.addHandler( RHEAUltraSinglePropertySlider, {
            $element
        } );
    };

    elementorFrontend.hooks.addAction( 'frontend/element_ready/rhea-ultra-single-property-slider.default', singlePropertyWidgetHandler );
} );