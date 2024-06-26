/**
 * ES6 Class for Elementor News Widget Classic
 *
 * @since 1.0.2
 * */

class RHEAClassicFeaturesWidgetClass extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors : {
                featuresWrap  : '.rhea_classic_features_section_elementor',
                featuresImage : '.rhea_features_image',
                imageParallax : '.rhea_image_parallax'
            }
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings( 'selectors' );
        return {
            $featuresWrap  : this.$element.find( selectors.featuresWrap ),
            $featuresImage : this.$element.find( selectors.featuresImage ),
            $imageParallax : this.$element.find( selectors.imageParallax )
        };
    }

    bindEvents() {
        this.loadFeaturedSection();
    }

    loadFeaturedSection( event ) {

        let featuresWrap  = this.elements.$featuresWrap,
            featuresImage = this.elements.$featuresImage,
            imageParallax = this.elements.$imageParallax;

        let classicFeatureHeight = id => {

            let imageHeight = -1;
            jQuery( id ).each( function () {
                if ( jQuery( this ).prop( "complete", "complete" ) ) {
                    imageHeight = imageHeight > jQuery( this ).outerHeight() ? imageHeight : jQuery( this )
                    .outerHeight();
                } else {
                    jQuery( this ).on( 'load', function () {
                        imageHeight = imageHeight > jQuery( this ).outerHeight() ? imageHeight : jQuery( this )
                        .outerHeight();
                    } );
                }
            } );

            jQuery( id ).css( {
                height : imageHeight
            } );

        };

        jQuery( document ).on( 'ready', function () {
            classicFeatureHeight( featuresImage );
        } );
        jQuery( window ).on( 'load', function () {
            classicFeatureHeight( featuresImage )
        } );


        let isInViewport = node => {
            let rect = node.getBoundingClientRect();
            return (
                ( rect.height > 0 || rect.width > 0 ) &&
                rect.bottom >= 0 &&
                rect.right >= 0 &&
                rect.top <= ( window.innerHeight || document.documentElement.clientHeight ) &&
                rect.left <= ( window.innerWidth || document.documentElement.clientWidth )
            )
        }

        let scrollParallax = selector => {
            let scrolled = jQuery( window ).scrollTop();
            jQuery( selector ).each( function ( index, element ) {
                let initY  = jQuery( this ).offset().top;
                let height = jQuery( this ).height();
                let endY   = initY + jQuery( this ).height();

                // Check if the element is in the viewport.
                let visible = isInViewport( this );
                if ( visible ) {
                    let diff  = scrolled - initY;
                    let ratio = Math.round( ( diff / height ) * 100 );
                    jQuery( this ).css( 'background-position', 'center ' + parseInt( ratio ) + 'px' )
                }
            } );
        }

        jQuery( imageParallax ).each( function () {
            scrollParallax( this );
        } );
        jQuery( window ).scroll( function () {
            jQuery( imageParallax ).each( function () {
                scrollParallax( this );
            } );

        } );

    }
}

jQuery( window ).on( 'elementor/frontend/init', () => {
    const classicFeaturesHandler = ( $element ) => {
        elementorFrontend.elementsHandler.addHandler( RHEAClassicFeaturesWidgetClass, {
            $element
        } );
    };

    elementorFrontend.hooks.addAction( 'frontend/element_ready/ere-classic-features-section-widget.default', classicFeaturesHandler );
} );