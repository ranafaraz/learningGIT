/**
 * Javascript to handle AJAX based Pagination in the map
 * created by mapbox for Listing & Archive pages
 */
( function ( $ ) {
    "use strict";

    let statsWrap   = $( '.rh_pagination__stats' );
    let page_id     = statsWrap.data( 'page-id' );
    let is_taxonomy = statsWrap.data( 'is-taxonomy' );

    $( document ).on( 'click', '#properties-listing .rh_pagination > a', function ( event ) {
        event.preventDefault();

        let currentButton = $( this );
        let current_page  = parseInt( currentButton.data( 'page-number' ) );

        $.ajax( {
            url     : ajaxurl,
            type    : 'post',
            data    : {
                action      : 'realhomes_render_properties_on_mapbox',
                page_number : current_page,
                page_id     : page_id,
                is_taxonomy : is_taxonomy
            },
            success : ( response ) => {
                $( '#map-head' ).empty().append( '<div id="listing-map"></div>' );
                realhomes_update_mapbox( response.data.propertiesData );
            }
        } );

    } );

} )( jQuery );