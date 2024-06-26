/**
 * Javascript to handle open street map for contact page.
 */
( function ( $ ) {

    "use strict";

    let mapContainer = document.getElementById( "map_canvas" );

    if ( typeof contactMapData !== "undefined" && mapContainer !== null ) {

        if ( contactMapData.lat && contactMapData.lng ) {

            let tileLayer = L.tileLayer( 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution : '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            } );

            let mapCenter = L.latLng( parseFloat( contactMapData.lat ), parseFloat( contactMapData.lng ) );
            let mapZoom   = 14;

            if ( contactMapData.zoom ) {
                mapZoom = contactMapData.zoom
            }

            let mapOptions = {
                center : mapCenter,
                zoom   : mapZoom
            };

            let contactMap = L.map( 'map_canvas', mapOptions );
            contactMap.scrollWheelZoom.disable();
            contactMap.addLayer( tileLayer );

            // Custom Map Marker Icon
            if ( contactMapData.iconURL ) {

                let myIcon = L.icon( {
                    iconUrl  : contactMapData.iconURL,
                } );

                let iconOptions = {
                    icon      : myIcon
                }

                L.marker( mapCenter, iconOptions ).addTo( contactMap );

            } else {

                L.marker( mapCenter ).addTo( contactMap );

            }
        }
    }
} )( jQuery );