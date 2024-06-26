/**
 * Javascript to handle AJAX based Pagination in the
 * google map for Listing & Archive pages
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
                action      : 'realhomes_render_properties_on_google_map',
                page_id     : page_id,
                page        : current_page,
                is_taxonomy : is_taxonomy
            },
            success : ( response ) => realhomes_update_google_map( response.data.propertiesData )
        } );

    } );

} )( jQuery );