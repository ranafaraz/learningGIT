/**
 * ES6 Class for Elementor News Widget Classic
 *
 * @since 1.0.2
 * */

class RHEAClassicNewsWidgetClass extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors : {
                newsWidgetSlider   : '.rhea_classic_listing_slider',
                newsElementWrapper : '.rhea_classic_news_elementor_wrapper'
            }
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings( 'selectors' );
        return {
            $newsWidgetSlider   : this.$element.find( selectors.newsWidgetSlider ),
            $newsElementWrapper : this.$element.find( selectors.newsElementWrapper )
        };
    }

    bindEvents() {
        this.loadFlexOnNewsWidget();
    }

    loadFlexOnNewsWidget( event ) {

        let newsSlider     = this.elements.$newsWidgetSlider,
            elementWrapper = this.elements.$newsElementWrapper,
            thumbHeight    = newsSlider.find( 'img' ).height();

        // adding height of img element to stop the flickr on slider loading
        newsSlider.css( 'height', thumbHeight );

        if ( jQuery().flexslider ) {
            jQuery( newsSlider ).each( function () {
                jQuery( this ).flexslider( {
                    animation    : "slide",
                    controlNav   : false,
                    directionNav : true,
                    prevText     : '<i class="fa fa-angle-left"></i>',
                    nextText     : '<i class="fa fa-angle-right"></i>',
                    start        : function ( slider ) {
                        console.log(slider);
                        slider.removeClass( 'loading' )
                        .css( 'height', 'auto' )
                        .children( '.gallery-loader' )
                        .fadeOut( 200 );
                    }
                } )
            } );

            jQuery( window ).on( 'load', function () {
                jQuery( window ).trigger( 'resize' );
            } );
        }

        let setVideoHeightElementor = function () {
            jQuery( elementWrapper ).each( function () {
                let getHeightElement       = jQuery( this ).find( '.rhea_post_get_height:first-child' );
                let getHeightElementHeight = getHeightElement.height();
                jQuery( this ).find( '.rhea_post_set_height' ).css( { height : getHeightElementHeight + 'px' } );
            } );
        }

        setVideoHeightElementor();

        jQuery( window ).on( 'resize load', function () {
            setVideoHeightElementor();
        } );
    }
}

jQuery( window ).on( 'elementor/frontend/init', () => {
    const RHEAClassicNewsWidgetHandler = ( $element ) => {
        elementorFrontend.elementsHandler.addHandler( RHEAClassicNewsWidgetClass, {
            $element
        } );
    };

    elementorFrontend.hooks.addAction( 'frontend/element_ready/ere-classic-news-section-widget.default', RHEAClassicNewsWidgetHandler );
} );