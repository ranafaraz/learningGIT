/**
 * ES6 Class for Elementor Schedule A Tour Single Property Widget
 *
 * @since 2.1.1
 * */

class RHEASingleScheduleSectionWidgetClass extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors : {
                sectionWrap : '.property-content-section',
                dateField   : '#sat-single-date'
            }
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings( 'selectors' );
        return {
            $sectionWrap : this.$element.find( selectors.sectionWrap ),
            $dateField   : this.$element.find( selectors.dateField )
        };
    }

    bindEvents() {
        this.loadScheduleSectionRender();
    }

    loadScheduleSectionRender( event ) {
        /**
         * Handling schedule section related functions
         *
         * @since 2.1.1
         * */

            // Assigning related handlers to the variables
        let sectionWrap = this.elements.$sectionWrap,
            widgetID    = sectionWrap.data( 'widget-id' ),
            dateField   = this.elements.$dateField;

        if ( jQuery().datepicker ) {
            dateField.datepicker( {
                minDate    : 0,
                showAnim   : 'slideDown',
                beforeShow : function ( input, inst ) {
                    inst.dpDiv[0].classList.add( 'rhea-schedule-section-wrapper' );
                    inst.dpDiv[0].classList.add( 'widget-id-' + widgetID );
                }
            } );
        }

    }

}

jQuery( window ).on( 'elementor/frontend/init', () => {
    const singleScheduleSectionWidgetHandler = ( $element ) => {
        elementorFrontend.elementsHandler.addHandler( RHEASingleScheduleSectionWidgetClass, {
            $element
        } );
    };

    elementorFrontend.hooks.addAction(
        'frontend/element_ready/rhea-ultra-single-property-schedule-tour.default',
        singleScheduleSectionWidgetHandler
    );
} );