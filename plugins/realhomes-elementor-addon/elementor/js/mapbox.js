/**
 * MapBox elementor widget ES6 Class
 * */

class RHEAMapBoxWidgetClass extends elementorModules.frontend.handlers.Base {

    getDefaultSettings() {
        return {
            selectors : {
                mapDataDiv : '.rhea-mapbox-data'
            }
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings( 'selectors' );
        return {
            $mapDataDiv : this.$element.find( selectors.mapDataDiv )
        };
    }

    bindEvents() {
        this.loadMapBox();
    }

    loadMapBox() {

        let $mapData = ( this.elements.$mapDataDiv ).data( 'mapbox-properties-map' );

        if ( typeof $mapData !== "undefined" ) {

            const mapData          = JSON.parse( atob( $mapData ) ),
                  propertiesData   = mapData.properties,
                  mapSettings      = mapData.settings,
                  mapBoxStyle      = mapSettings.style,
                  eleMapBoxAPI     = mapSettings.api_key,
                  mapBoxMarkerType = 'pin', //widgetSettings.marker_type;
                  ThisMapID        = 'rhea-' + mapData.id;

            if ( 0 < propertiesData.length ) {

                let mapBoxContainer       = document.getElementById( ThisMapID );
                mapBoxContainer.className = mapBoxContainer.className + ' mapbox-dl-map-wrap rhea-mapbox-wrap';

                if ( typeof mapSettings !== "undefined" ) {

                    // TODO find out the proper way to implement it
                    let tileLayer = L.tileLayer( 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution : '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                    } );

                    // get map bounds
                    let mapBounds = [];
                    for ( let i = 0; i < propertiesData.length; i++ ) {
                        if ( propertiesData[i].lat && propertiesData[i].lng ) {
                            mapBounds.push( [propertiesData[i].lat, propertiesData[i].lng] );
                        }
                    }

                    // Basic map
                    let mapBoxCenter = L.latLng( 27.664827, -81.515755 );	// given coordinates not going to matter 99.9% of the time but still added just in case.
                    if ( 1 === mapBounds.length ) {
                        mapBoxCenter = L.latLng( mapBounds[0] );	// this is also not going to effect 99% of the time but just in case of one property.
                    }

                    L.mapbox.accessToken   = eleMapBoxAPI;
                    const mapBoxProperties = L.mapbox.map( mapBoxContainer )
                    .setView( mapBoxCenter, 12 )
                    .addLayer( L.mapbox.styleLayer( mapBoxStyle ) );

                    if ( 1 < mapBounds.length ) {
                        mapBoxProperties.fitBounds( mapBounds );	// fit bounds should work only for more than one properties
                    }

                    let markers = new L.MarkerClusterGroup();

                    for ( let i = 0; i < propertiesData.length; i++ ) {
                        if ( propertiesData[i].lat && propertiesData[i].lng ) {
                            let propertyMapData = propertiesData[i],
                                markerLatLng    = L.latLng( propertyMapData.lat, propertyMapData.lng ),
                                propertyMarker,
                                markerOptions   = {
                                    id          : propertyMapData.id,
                                    riseOnHover : true
                                };

                            // Marker icon
                            if ( propertyMapData.title ) {
                                markerOptions.title = propertyMapData.title;
                            }

                            // Map marker.
                            if ( 'pin' === mapBoxMarkerType ) {

                                let iconOptions = {
                                    iconUrl     : propertyMapData.icon,
                                    iconSize    : [42, 57],
                                    iconAnchor  : [20, 57],
                                    popupAnchor : [1, -54]
                                };

                                if ( propertyMapData.retinaIcon ) {
                                    iconOptions.iconRetinaUrl = propertyMapData.retinaIcon;
                                }

                                markerOptions.icon = L.icon( iconOptions );
                                propertyMarker     = L.marker( markerLatLng, markerOptions );

                            } else {

                                propertyMarker = new L.CircleMarker( markerLatLng, {
                                    fillColor   : '#1cb2ff', //widgetSettings.marker_color,
                                    color       : '#1cb2ff', //widgetSettings.marker_color,
                                    weight      : 2,
                                    fillOpacity : 0.6,
                                    opacity     : 0.6,
                                    radius      : 25
                                } ).addTo( mapBoxProperties );
                            }

                            // Marker popup
                            let popupContentWrapper       = document.createElement( "div" ),
                                popupContent              = "";
                            popupContentWrapper.className = 'mapboxgl-popup-content';

                            if ( propertyMapData.thumb ) {
                                popupContent += '<a class="mapbox-popup-thumb-link" href="' + propertyMapData.url + '"><img class="mapbox-popup-thumb" src="' + propertyMapData.thumb + '" alt="' + propertyMapData.title + '"/></a>';
                            }

                            if ( propertyMapData.title ) {
                                popupContent += '<h5 class="mapbox-popup-title"><a class="mapbox-popup-link" href="' + propertyMapData.url + '">' + propertyMapData.title + '</a></h5>';
                            }

                            if ( propertyMapData.price ) {
                                popupContent += '<p><span class="mapbox-popup-price">' + propertyMapData.price + '</span></p>';
                            }

                            popupContentWrapper.innerHTML = popupContent;
                            propertyMarker.popupContents  = popupContentWrapper;
                            propertyMarker.id             = propertyMapData.id;
                            propertyMarker.className      = 'mapboxgl-wrapper';
                            propertyMarker.bindPopup( popupContentWrapper );
                            markers.addLayer( propertyMarker );

                        }
                    }

                    mapBoxProperties.addLayer( markers );
                    mapBoxProperties.scrollWheelZoom.disable();

                    /*
                     * Panning the marker to center of the visible map on "popupopen" event
                     */
                    mapBoxProperties.on( 'popupopen', function ( e ) {
                        // find the pixel location on the map where the popup anchor is
                        var px = mapBoxProperties.project( e.target._popup._latlng );
                        // find the height of the popup container, divide by 2, subtract from the Y axis of marker location
                        px.y -= e.target._popup._container.clientHeight / 2;
                        // pan to new center
                        mapBoxProperties.panTo( mapBoxProperties.unproject( px ), { animate : true } );
                    } );

                    /**
                     * Function to find the marker in a cluster
                     * @param {int} marker
                     * @param {int} cluster
                     * @returns
                     */
                    function is_marker_in_cluster( marker, cluster ) {

                        let length = cluster.length;
                        for ( let i = 0; i < length; i++ ) {
                            if ( cluster[i].id == marker ) {
                                return true;
                            }
                        }
                        return false;
                    }

                    /**
                     * Open Popup function
                     * @param {int} markerid
                     */
                    function mapbox_open_popup( markerid ) {

                        mapBoxProperties.eachLayer( function ( layer ) {

                            // Checking if this layer is a cluster
                            if ( typeof layer._childCount !== "undefined" ) {

                                // Getting all markers in this cluster
                                let markersincluster = layer.getAllChildMarkers();

                                if ( is_marker_in_cluster( markerid, markersincluster ) ) {
                                    layer.spiderfy();
                                    markersincluster.forEach(
                                        function ( property_marker ) {
                                            if ( property_marker.id === parseInt( markerid ) ) {
                                                property_marker.openPopup();
                                            }
                                        }
                                    );
                                }
                            } else {
                                if ( layer.id === parseInt( markerid ) ) {
                                    layer.openPopup();
                                }
                            }
                        } );
                    }

                    /**
                     * Close Popup function
                     * @param {int} markerid
                     */
                    function mapbox_close_popup( markerid ) {

                        mapBoxProperties.eachLayer( function ( layer ) {
                            // Checking if this layer is a cluster
                            if ( typeof layer._childCount !== "undefined" ) {
                                // Getting all markers in this cluster
                                var markersincluster = layer.getAllChildMarkers();
                                if ( is_marker_in_cluster( markerid, markersincluster ) ) {
                                    layer.unspiderfy();
                                    markersincluster.forEach(
                                        function ( property_marker ) {
                                            if ( property_marker.id == parseInt( markerid ) ) {
                                                layer.closePopup();
                                            }
                                        }
                                    );
                                }
                            } else {
                                if ( layer.id == parseInt( markerid ) ) {

                                    layer.closePopup();
                                    mapBoxProperties.closePopup();
                                }
                            }
                        } );
                    }

                    let realhomesInfoboxPopupTrigger = function () {

                        jQuery( '.rh_popup_info_map' ).each( function ( i ) {
                            // Getting the Property ID for mouse events
                            let property_ID = jQuery( this ).attr( 'data-rh-id' ).replace( /[^\d.]/g, '' );

                            jQuery( this )
                            .on( 'mouseenter', function () {
                                mapbox_open_popup( property_ID );
                            } )
                            .on( 'mouseleave', function () {
                                mapbox_close_popup( property_ID );
                            } );

                        } );

                        return false;
                    };

                    let RHisMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test( navigator.userAgent ) ? true : false;
                    if ( ! RHisMobile ) {
                        realhomesInfoboxPopupTrigger();
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
}

jQuery( window ).on( 'elementor/frontend/init', () => {
    const RHEAMapBoxHandler = ( $element ) => {
        elementorFrontend.elementsHandler.addHandler( RHEAMapBoxWidgetClass, { $element } );
    };

    elementorFrontend.hooks.addAction( 'frontend/element_ready/properties-mapbox-widget.default', RHEAMapBoxHandler );
} );