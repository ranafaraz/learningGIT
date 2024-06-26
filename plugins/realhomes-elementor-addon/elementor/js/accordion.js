/**
 * ES6 Class for Elementor Accordion Widget
 *
 * @since 1.0.2
 * */

class RHEAAccordionWidgetClass extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors : {
                accordionWrap : '.rhea-accordion'
            }
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings( 'selectors' );
        return {
            $accordionWrap : this.$element.find( selectors.accordionWrap )
        };
    }

    bindEvents() {
        this.loadAccordionWidget();
    }

    loadAccordionWidget( event ) {

        let accordionWrap = this.elements.$accordionWrap;

        jQuery( accordionWrap.find( '.rhea-accordion-title' ) ).on( 'click', function ( event ) {
            let $this = jQuery( this );

            if ( $this.hasClass( 'rhea-accordion-active' ) ) {
                $this.next( '.rhea-accordion-content' ).slideUp( 500, function () {
                    $this.removeClass( 'rhea-accordion-active' )
                } );
            } else {
                $this.siblings( '.rhea-accordion-title' ).removeClass( 'rhea-accordion-active' );
                $this.addClass( 'rhea-accordion-active' )
                .next( '.rhea-accordion-content' )
                .slideDown( 500 )
                .siblings( '.rhea-accordion-content' )
                .slideUp( 500 );
            }
        } );

    }
}

jQuery( window ).on( 'elementor/frontend/init', () => {
    const accordionWidgetHandler = ( $element ) => {
        elementorFrontend.elementsHandler.addHandler( RHEAAccordionWidgetClass, {
            $element
        } );
    };

    elementorFrontend.hooks.addAction( 'frontend/element_ready/inspiry-accordion-widget.default', accordionWidgetHandler );
} );