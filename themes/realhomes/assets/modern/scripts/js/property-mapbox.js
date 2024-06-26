/**
 * Javascript to handle open street map for property single page.
 *
 * @since 3.21.0
 */
( function ( $ ) {
    "use strict";

    let propertyMapBoxContainer = document.getElementById( "property_map" );

    if ( typeof propertyMapData !== "undefined" && propertyMapBoxContainer !== null ) {

        let mapboxAPI = propertyMapData.mapboxAPI;

        if ( mapboxAPI !== null ) {

            const mapCenter   = L.latLng( propertyMapData.lat, propertyMapData.lng ),
                  mapboxStyle = propertyMapData.mapboxStyle;

            mapboxgl.accessToken = mapboxAPI;
            const propertyMap    = new mapboxgl.Map( {
                attributionControl : false,
                container          : propertyMapBoxContainer,
                style              : mapboxStyle,
                center             : mapCenter,
                zoom               : 12
            } ).addControl( new mapboxgl.AttributionControl( {} ) );

            // TODO: bottom map statement fix
            // const mapCredits = L.control.attribution().addTo(propertyMap);
            // mapCredits.addAttribution(
            //     `© <a href="https://www.mapbox.com/about/maps/">Mapbox</a> <strong><a href="https://www.mapbox.com/map-feedback/" target="_blank">Improve this map</a></strong>`
            // );

            // Marker popup
            let popupContentWrapper = document.createElement( "div" );

            // create the popup
            const popup = new mapboxgl.Popup( { offset : 25 } )
            .setHTML( popupContentWrapper.innerHTML );

            // create DOM element for the marker
            const marker_icon     = document.createElement( 'div' );
            marker_icon.className = 'mapbox-marker';

            const marker_icon_img = document.createElement( 'img' );
            marker_icon_img.src   = propertyMapData.icon;
            marker_icon_img.alt   = propertyMapData.title;
            marker_icon.append( marker_icon_img );

            const propertyMarker = new mapboxgl.Marker( marker_icon, { anchor: 'bottom' } )
            .setLngLat( mapCenter )
            .addTo( propertyMap );

            // Unbinding marker click event
            propertyMarker.unbind( 'click' );
        }

    }

} )( jQuery );