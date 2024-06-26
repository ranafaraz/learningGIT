/**
 * ES6 Class for Elementor Ultra Search Form and Search Form 2
 *
 * @since 2.2.0
 * */

class ultraSearchWidgetClass extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors : {
                geoLocationAddress : '#geolocation-address',
                locationFieldWrap  : '#location-fields-wrap',
                geoRadiusSlider    : '#geolocation-radius-slider-wrapper'
            }
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings( 'selectors' );
        return {
            $geoLocationAddress : this.$element.find( selectors.geoLocationAddress ),
            $locationFieldWrap  : this.$element.find( selectors.locationFieldWrap ),
            $geoRadiusSlider    : this.$element.find( selectors.geoRadiusSlider )
        };
    }

    bindEvents() {
        this.loadUltraSearchWidget();
    }

    loadUltraSearchWidget( event ) {

        const widgetID                 = this.getID(),
              widgetSettings           = this.getElementSettings(),
              widgetWrapID             = '#rhea-' + widgetID,
              locationFieldsID         = this.elements.$locationFieldWrap,
              geoLocationAddress       = jQuery( this.elements.$geoLocationAddress ),
              locationFieldsWrap       = jQuery( locationFieldsID ),
              geolocationRadiusWrapper = this.elements.$geoRadiusSlider,
              TriggerCalender          = jQuery( widgetWrapID + ' .rhea-trigger-calender' ),
              searchSingleCheckIn      = jQuery( widgetWrapID + ' .rhea-single-check-in-search' ),
              searchCheckIn            = jQuery( widgetWrapID + ' .rhea-check-in-search' ),
              searchCheckOut           = jQuery( widgetWrapID + ' .rhea-check-out-search' );

        // if check in / check out fields exist
        if ( 0 < TriggerCalender.length ) {
            searchCheckOut.on( 'click', function () {
                TriggerCalender.trigger( 'click' );
            } );

            // Setting calendar options from localized calendar names and months data.
            let localeOptions = {
                firstDay : 1
            };

            if ( 'undefined' !== typeof ( availability_calendar_data ) ) {
                localeOptions.daysOfWeek = availability_calendar_data.day_name;
                localeOptions.monthNames = availability_calendar_data.month_name;
            }

            let searchPickerOptions = {
                autoApply       : true,
                drops           : 'down',
                opens           : 'right',
                autoUpdateInput : false,
                minDate         : new Date(),
                parentEl        : '#rhea-'+ widgetID,
                locale          : {
                    ...localeOptions
                }
            };

            if ( searchCheckIn.val() && searchCheckOut.val() ) {
                searchPickerOptions.startDate = searchCheckIn.val();
                searchPickerOptions.endDate   = searchCheckOut.val();
            }

            TriggerCalender.daterangepicker( searchPickerOptions, function ( startDate, endDate, label ) {
                // Set focus to the check-in and check-out fields.
                searchCheckIn.parents( '.rh_mod_text_field' ).addClass( 'rh_mod_text_field_focused' );
                searchCheckOut.parents( '.rh_mod_text_field' ).addClass( 'rh_mod_text_field_focused' );

                // Setting the Check-In and Check-Out dates in their fields.
                searchCheckIn.val( startDate.format( 'YYYY-MM-DD' ) );
                searchCheckOut.val( endDate.format( 'YYYY-MM-DD' ) );
                searchSingleCheckIn.val( startDate.format( 'YYYY-MM-DD' ) + '  /  ' + endDate.format( 'YYYY-MM-DD' ) );
            } );
        }

        /*-----------------------------------------------------------------------------------*/
        /* Geolocation Field Places AutoComplete
        /*-----------------------------------------------------------------------------------*/
        if ( typeof google !== undefined ) {
            let geoLocationWrap = geoLocationAddress.get( 0 );
            if ( geoLocationWrap ) {
                function initAutocomplete() {
                    let autocomplete = new google.maps.places.Autocomplete( geoLocationWrap );
                    // Set the data fields to return when the user selects a place.
                    autocomplete.setFields( ['address_components', 'geometry', 'icon', 'name'] );

                    // Handle place selection
                    autocomplete.addListener( 'place_changed', function () {
                        const place = autocomplete.getPlace();
                        locationFieldsWrap.find( '.location-field-lat' ).val( place.geometry.location.lat() );
                        locationFieldsWrap.find( '.location-field-lng' ).val( place.geometry.location.lng() );
                    } );
                }

                initAutocomplete();
            }
        }

        /*-----------------------------------------------------------------------------------*/
        /* Geolocation Radius Slider for Properties Search Form
        /*-----------------------------------------------------------------------------------*/
        if ( geolocationRadiusWrapper.length ) {
            const geolocationRadiusSlider = geolocationRadiusWrapper.find( '#geolocation-radius-slider' );
            geolocationRadiusSlider.slider( {
                range : 'max',
                value : geolocationRadiusSlider.data( 'value' ),
                min   : geolocationRadiusSlider.data( 'min-value' ),
                max   : geolocationRadiusSlider.data( 'max-value' ),
                slide : function ( event, ui ) {
                    geolocationRadiusWrapper.find( 'strong' )
                    .text( ui.value + ' ' + geolocationRadiusSlider.data( 'unit' ) );
                    geolocationRadiusWrapper.find( '#geolocation-radius' ).val( ui.value );
                }
            } );
        }

    }
}

jQuery( window ).on( 'elementor/frontend/init', () => {
    const ultraSearchWidgetHandler = ( $element ) => {
        elementorFrontend.elementsHandler.addHandler( ultraSearchWidgetClass, {
            $element
        } );
    };

    elementorFrontend.hooks.addAction( 'frontend/element_ready/rhea-search-form-widget.default', ultraSearchWidgetHandler );
    elementorFrontend.hooks.addAction( 'frontend/element_ready/rhea-ultra-search-form-widget.default', ultraSearchWidgetHandler );
    elementorFrontend.hooks.addAction( 'frontend/element_ready/rhea-ultra-search-form-2-widget.default', ultraSearchWidgetHandler );
} );
