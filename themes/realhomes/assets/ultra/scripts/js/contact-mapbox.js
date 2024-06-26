/**
 * Javascript to handle open street map for property single page.
 *
 * @since 3.21.0
 */
(function ($) {
    "use strict";

    let contactMapBoxContainer = document.getElementById("map_canvas");

    if (typeof contactMapData !== "undefined" && contactMapBoxContainer !== null) {

        let mapboxAPI = contactMapData.mapboxAPI;

        if (mapboxAPI !== null) {

            let mapCenter = L.latLng(contactMapData.lat, contactMapData.lng),
                mapboxStyle = contactMapData.mapboxStyle,
                mapZoom = 16;

            if (contactMapData.zoom) {
                mapZoom = contactMapData.zoom
            }

            mapboxgl.accessToken = mapboxAPI;
            const contactMap = new mapboxgl.Map({
                container: contactMapBoxContainer,
                style: mapboxStyle,
                center: mapCenter,
                zoom: mapZoom
            });

            let iconURL = "",
                iconColor = "",
                contactMarker, img;

            if (contactMapData.iconURL) {
                iconURL = contactMapData.iconURL;

                // Create a DOM element for each marker.
                contactMarker = document.createElement('div');
                img = document.createElement('img');
                contactMarker.className = 'marker';
                img.src = iconURL;
                contactMarker.append(img);
            } else {
                if (contactMapData.iconColor) {
                    iconColor = contactMapData.iconColor;
                } else {
                    iconColor = '#0054a5';
                }

                contactMarker = {'color': iconColor};
            }

            // Add markers to the map.
            new mapboxgl.Marker(contactMarker)
                .setLngLat(mapCenter)
                .addTo(contactMap);
        }

    }
})(jQuery);