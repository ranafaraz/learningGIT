/**
 * Open street map elementor widget ES6 Class
 * */

class RHEAOpenStreetMapWidgetClass extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors : {
                mapContainer : '#rhea-map-container',
                mapDataDiv   : '.rhea-osm-map-data'
            }
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings( 'selectors' );
        return {
            $mapContainer : this.$element.find( selectors.mapContainer ),
            $mapDataDiv   : this.$element.find( selectors.mapDataDiv )
        };
    }

    bindEvents() {
        let mapData  = {},
            $mapData = ( this.elements.$mapDataDiv ).data( 'osm-properties-map' );

        if ( typeof $mapData !== "undefined" ) {
            mapData = JSON.parse( atob( $mapData ) );
        }

        const mapSettings = this.getElementSettings();
        if ( ( 'yes' === mapSettings.map_sync_properties ) && ( typeof propertiesMapNewData !== "undefined" ) ) {
            mapData.data = JSON.parse( propertiesMapNewData.rheaPropertiesData );
        }

        this.loadOpenStreetMap( mapData );

        jQuery( window ).on( 'rheaUpdateMapData', ( event ) => {
            if ( event.mapProperties ) {
                mapData.data  = JSON.parse( event.mapProperties );
                let mapID     = 'rhea-' + mapData.id,
                    mapDiv    = jQuery( "#" + mapID ),
                    container = mapDiv.parents( '.rhea-map-head' );

                // Removing existing map container
                mapDiv.remove();
                container.append( '<div id="' + mapID + '" class="rhea-listing-map"></div>' );
                this.loadOpenStreetMap( mapData );
            }
        } );
    }

    loadOpenStreetMap( mapData ) {
        let propertiesMapData = mapData.data;
        let ThisMapID         = 'rhea-' + mapData.id;

        if ( 0 < propertiesMapData.length ) {
            let tileLayer = L.tileLayer( 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution : '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            } );

            // get map bounds
            let mapBounds = [];
            for ( let i = 0; i < propertiesMapData.length; i++ ) {
                if ( propertiesMapData[i].lat && propertiesMapData[i].lng ) {
                    mapBounds.push( [propertiesMapData[i].lat, propertiesMapData[i].lng] );
                }
            }

            // Basic map
            let mapCenter = L.latLng( 27.664827, -81.515755 );	// given coordinates not going to matter 99.9% of the time but still added just in case.
            if ( 1 === mapBounds.length ) {
                mapCenter = L.latLng( mapBounds[0] );	// this is also not going to effect 99% of the the time but just in case of one property.
            }
            let mapDragging   = L.Browser.mobile ? false : true; // disabling one finger dragging on mobile but zoom with two fingers will still be enabled.
            let mapOptions    = {
                dragging    : mapDragging,
                center      : mapCenter,
                zoom        : 13,
                zoomControl : false,
                tap         : false
            };
            let propertiesMap = L.map( ThisMapID, mapOptions );

            L.control.zoom( {
                position : 'bottomleft'
            } ).addTo( propertiesMap );

            propertiesMap.scrollWheelZoom.disable();

            if ( 1 < mapBounds.length ) {
                propertiesMap.fitBounds( mapBounds );	// fit bounds should work only for more than one properties
            }

            propertiesMap.addLayer( tileLayer );

            for ( let i = 0; i < propertiesMapData.length; i++ ) {

                if ( propertiesMapData[i].lat && propertiesMapData[i].lng ) {

                    let propertyMapData = propertiesMapData[i];

                    let markerLatLng = L.latLng( propertyMapData.lat, propertyMapData.lng );

                    let markerOptions = {
                        riseOnHover : true
                    };

                    // Marker icon
                    if ( propertyMapData.title ) {
                        markerOptions.title = propertyMapData.title;
                    }

                    let mapClasses = '';
                    if ( propertyMapData.classes ) {
                        mapClasses = propertyMapData.classes.join( ' ' );
                    } else {
                        mapClasses = '';
                    }


                    // Marker icon
                    if ( propertyMapData.icon ) {
                        let iconOptions = {
                            iconUrl     : propertyMapData.icon,
                            iconSize    : [42, 57],
                            iconAnchor  : [20, 57],
                            popupAnchor : [1, -54],
                            className   : mapClasses
                        };
                        if ( propertyMapData.retinaIcon ) {
                            iconOptions.iconRetinaUrl = propertyMapData.retinaIcon;
                        }
                        markerOptions.icon = L.icon( iconOptions );
                    }

                    let propertyMarker = L.marker( markerLatLng, markerOptions ).addTo( propertiesMap );

                    // Marker popup
                    let popupContentWrapper       = document.createElement( "div" );
                    popupContentWrapper.className = 'osm-popup-content';
                    let popupContent              = "";

                    // Info box for Ultra variation.
                    if ( document.body.classList.contains( "design_ultra" ) ) {
                        if ( propertyMapData.thumb ) {
                            popupContent += '<a class="osm-popup-thumb-link" href="' + propertyMapData.url + '"><img class="osm-popup-thumb" src="' + propertyMapData.thumb + '" alt="' + propertyMapData.title + '"/></a>';
                        }
                        popupContent += '<div class="osm-detail-wrapper">'
                        if ( propertyMapData.title ) {
                            popupContent += '<h5 class="osm-popup-title"><a class="osm-popup-link" href="' + propertyMapData.url + '">' + propertyMapData.title + '</a></h5>';
                        }
                        popupContent += '<div>'
                        if ( propertyMapData.propertyType ) {
                            popupContent += '<span class="type">' + propertyMapData.propertyType + '</span>';
                        }
                        if ( propertyMapData.price ) {
                            popupContent += '<p><span class="osm-popup-price">' + propertyMapData.price + '</span></p>';
                        }
                        popupContent += '</div>'
                        popupContent += '</div>'

                    } else {
                        if ( propertyMapData.thumb ) {
                            popupContent += '<a class="osm-popup-thumb-link" href="' + propertyMapData.url + '"><img class="osm-popup-thumb" src="' + propertyMapData.thumb + '" alt="' + propertyMapData.title + '"/></a>';
                        }
                        popupContent += '<div class="osm-detail-wrapper">';
                        if ( propertyMapData.title ) {
                            popupContent += '<h5 class="osm-popup-title"><a class="osm-popup-link" href="' + propertyMapData.url + '">' + propertyMapData.title + '</a></h5>';
                        }
                        popupContent += '</div>';
                        if ( propertyMapData.price ) {
                            popupContent += '<p><span class="osm-popup-price">' + propertyMapData.price + '</span></p>';
                        }
                    }

                    popupContentWrapper.innerHTML = popupContent;

                    propertyMarker.bindPopup( popupContentWrapper );
                }
            }

        } else {

            // Fallback Map
            let fallbackLayer = L.tileLayer( 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution : '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            } );

            // todo: provide an option for fallback map coordinates
            let fallbackMapOptions = {
                center : [27.664827, -81.515755],
                zoom   : 12
            };

            let fallbackMap = L.map( ThisMapID, fallbackMapOptions );
            fallbackMap.addLayer( fallbackLayer );
        }
    }
}

jQuery( window ).on( 'elementor/frontend/init', () => {
    const RHEAOSMHandler = ( $element ) => {
        elementorFrontend.elementsHandler.addHandler( RHEAOpenStreetMapWidgetClass, { $element } );
    };

    elementorFrontend.hooks.addAction( 'frontend/element_ready/rhea-properties-os-map-widget.default', RHEAOSMHandler );
} );