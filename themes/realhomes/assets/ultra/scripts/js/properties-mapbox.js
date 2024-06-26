/**
 * Javascript to handle mapbox map for multiple properties
 *
 * @since 3.21.0
 */
( function ( $ ) {
    "use strict";

    window.realhomes_update_mapbox = function ( propertiesMapData ) {

        const mapContainer                  = $( '#map-head' );
        let propertiesMapBoxContainer       = document.getElementById( "listing-map" );
        propertiesMapBoxContainer.className = 'mapbox-dl-map-wrap';

        if ( typeof propertiesMapData !== "undefined" && 0 < propertiesMapData.length ) {

            const mapboxAPI   = propertiesMapOptions.mapboxAPI,
                  mapboxStyle = propertiesMapOptions.mapboxStyle;

            // TODO find out the proper way to implement it
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
            var mapCenter = L.latLng( 27.664827, -81.515755 );	// given coordinates not going to matter 99.9% of the time but still added just in case.
            if ( 1 === mapBounds.length ) {
                mapCenter = L.latLng( mapBounds[0] );	// this is also not going to effect 99% of the time but just in case of one property.
            }

            if ( propertiesMapBoxContainer.childNodes.length !== 0 ) {
                mapContainer.empty().append( '<div id="listing-map"></div>' );
                propertiesMapBoxContainer           = document.getElementById( "listing-map" );
                propertiesMapBoxContainer.className = 'mapbox-dl-map-wrap';
            }

            L.mapbox.accessToken = mapboxAPI;
            var propertiesMap    = L.mapbox.map( propertiesMapBoxContainer )
            .setView( mapCenter, 12 )
            .addLayer( L.mapbox.styleLayer( mapboxStyle ) );

            if ( 1 < mapBounds.length ) {
                propertiesMap.fitBounds( mapBounds );	// fit bounds should work only for more than one properties
            }

            let markers = new L.MarkerClusterGroup();

            for ( let i = 0; i < propertiesMapData.length; i++ ) {
                if ( propertiesMapData[i].lat && propertiesMapData[i].lng ) {
                    let propertyMapData = propertiesMapData[i],
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
                    if ( 'pin' === propertiesMapOptions.marker_type && propertyMapData.icon ) {
                        var iconOptions = {
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
                            fillColor   : propertiesMapOptions.marker_color,
                            color       : propertiesMapOptions.marker_color,
                            weight      : 2,
                            fillOpacity : 0.6,
                            opacity     : 0.6,
                            radius      : 25
                        } ).addTo( propertiesMap );
                    }
                    // Marker popup
                    let popupContentWrapper       = document.createElement( "div" );
                    popupContentWrapper.className = 'mapboxgl-popup-content';
                    let popupContent              = "";

                    if ( propertyMapData.thumb ) {
                        popupContent += '<a class="mapbox-popup-thumb-link" href="' + propertyMapData.url + '"><img class="mapbox-popup-thumb" src="' + propertyMapData.thumb + '" alt="' + propertyMapData.title + '"/></a>';
                    }
                    popupContent += '<div class="mapbox-detail-wrapper">';
                    if ( propertyMapData.title ) {
                        popupContent += '<h5 class="mapbox-popup-title"><a class="mapbox-popup-link" href="' + propertyMapData.url + '">' + propertyMapData.title + '</a></h5>';
                    }
                    popupContent += '<div>'
                    if (propertyMapData.propertyType) {
                        popupContent += '<span class="type">' + propertyMapData.propertyType + '</span>';
                    }
                    if ( propertyMapData.price ) {
                        popupContent += '<p><span class="mapbox-popup-price">' + propertyMapData.price + '</span></p>';
                    }
                    popupContent += '</div>'
                    popupContent += '</div>';
                    popupContentWrapper.innerHTML = popupContent;
                    propertyMarker.popupContents  = popupContentWrapper;
                    propertyMarker.id             = propertyMapData.id;
                    propertyMarker.className      = 'mapboxgl-wrapper';
                    propertyMarker.bindPopup( popupContentWrapper );
                    markers.addLayer( propertyMarker );

                }
            }
            propertiesMap.addLayer( markers );
            propertiesMap.scrollWheelZoom.disable();

            /*
             * Pan the marker to center of the visible map on popupopen event
             */
            propertiesMap.on( 'popupopen', function ( e ) {
                // find the pixel location on the map where the popup anchor is
                var px = propertiesMap.project( e.target._popup._latlng );
                // find the height of the popup container, divide by 2, subtract from the Y axis of marker location
                px.y -= e.target._popup._container.clientHeight / 2;
                // pan to new center
                propertiesMap.panTo( propertiesMap.unproject( px ), { animate : true } );

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
                propertiesMap.eachLayer( function ( layer ) {

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
                                } );
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

                propertiesMap.eachLayer( function ( layer ) {

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
                                } );
                        }
                    } else {
                        if ( layer.id == parseInt( markerid ) ) {
                            layer.closePopup();
                            propertiesMap.closePopup();
                        }
                    }
                } );
            }

            let realhomesInfoboxPopupTrigger = function () {
                $( '.rh_popup_info_map' ).each( function ( i ) {
                    // Getting the Property ID for mouse events
                    let property_ID = $( this ).attr( 'data-rh-id' ).replace( /[^\d.]/g, '' );
                    $( this )
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

        } else {

            // Fallback Map in Case of No Properties
            let fallbackLayer = L.tileLayer( 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution : '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            } );

            let fallback_lat,
                fallback_lng;
            if (
                undefined !== propertiesMapOptions.fallback_location
                && propertiesMapOptions.fallback_location.lat
                && propertiesMapOptions.fallback_location.lng
            ) {
                fallback_lat = propertiesMapOptions.fallback_location.lat;
                fallback_lng = propertiesMapOptions.fallback_location.lng;
            } else {
                // Default location of Florida in fallback map.
                fallback_lat = '27.664827';
                fallback_lng = '-81.515755';
            }
            let fallbackMapOptions = {
                center : [fallback_lat, fallback_lng],
                zoom   : 12
            };

            if ( propertiesMapBoxContainer.childNodes.length !== 0 ) {
                mapContainer.empty().append( '<div id="listing-map"></div>' );
                let propertiesMapBoxContainer       = document.getElementById( "listing-map" );
                propertiesMapBoxContainer.className = 'mapbox-dl-map-wrap';
            }

            let fallbackMap = L.map( propertiesMapBoxContainer, fallbackMapOptions );
            fallbackMap.addLayer( fallbackLayer );

        }

        // Add custom class to zoom control to apply z-index for modern variation
        $( ".leaflet-control-zoom" ).parent( ".leaflet-bottom" ).addClass( "rh_leaflet_controls_zoom" );
    }

    if ( typeof propertiesMapData !== "undefined" ) {
        realhomes_update_mapbox( propertiesMapData );
    }

    function isset( variable ) {
        return typeof variable !== typeof undefined;
    }

} )( jQuery );