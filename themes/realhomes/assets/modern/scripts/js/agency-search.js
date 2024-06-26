/**
 * Agency Search Feature
 *
 * @since 4.0.0
 */
( function ( $ ) {
    "use strict";

    const agenciesContainer = document.getElementById( 'listing-container' );

    if ( agenciesContainer.classList.contains( 'realhomes_agency_search' ) ) {

        const pagination = document.querySelector( '.rh_pagination' );
        const loader     = document.querySelector( '.svg-loader' );

        // Object containing the values of the search fields on first page load
        let searchFieldValues = {
            name            : $( '#agency-txt' ).val(),
            agencylocations : $( "#agency-locations" ).val()
        }

        // If pagination container is not found then create it
        if ( typeof pagination === 'undefined' || pagination === null ) {
            let paginationDOM = document.createElement( 'div' );
            paginationDOM.classList.add( 'rh_pagination' );
            loader.parentNode.insertBefore( paginationDOM, loader.nextSibling );
        }

        // Binding the classes to trigger Ajax Search
        $( '.inspiry_select_picker_agency, .rh_mod_text_field input' )
        .each( function () {

            // If any field is changed and has a new value
            $( this ).on( 'change', () => {

                let selectedField                 = $( this ),
                    fieldName                     = selectedField.attr( 'name' ),
                    fieldValue                    = selectedField.val();
                searchFieldValues.name            = $( '#agency-txt' ).val();
                searchFieldValues.agencylocations = $( "#agency-locations" ).val();

                // Getting an array of selected values if any
                let fieldValues = realhomes_agency_search_values( searchFieldValues );
                if ( typeof fieldValues !== 'undefined' ) {

                    // Updating the current URL and window history
                    const url = new URL( window.location );

                    // Check if we are on a paginated page
                    if ( url.pathname.lastIndexOf( 'page' ) !== -1 ) {
                        url.pathname = url.pathname.slice( 0, url.pathname.lastIndexOf( 'page' ) );
                    }

                    // Update the browser URL based on selected field/features values
                    realhomes_update_browser_URL( fieldName, fieldValue, url );

                    agenciesContainer.style.display = 'none';
                    agenciesContainer.innerHTML     = '';
                    loader.style.display            = 'block';

                    if ( typeof pagination !== 'undefined' && pagination !== null ) {
                        pagination.style.display = 'none';
                    }

                    // Sending AJAX Request to filter agency search results
                    $.ajax( {
                        url      : ajaxurl,
                        type     : 'post',
                        data     : {
                            action : 'realhomes_filter_agency',
                            ...searchFieldValues
                        },
                        success  : ( response ) => {
                            loader.style.display = 'none';

                            let currentURL = url.href;
                            realhomes_update_agency_pagination( currentURL );

                            agenciesContainer.innerHTML     = response.data.search_results;
                            agenciesContainer.style.display = 'block';

                            agenciesContainer.dataset.max      = response.data.max_pages;
                            agenciesContainer.dataset.agencies = response.data.total_agencies;
                            agenciesContainer.dataset.page     = response.data.paged;

                        },
                        complete : ( $response ) => {
                            if ( agenciesContainer.dataset.max > 1 ) {
                                pagination.style.display = 'flex';
                            } else {
                                pagination.style.display = 'none';
                            }
                        }
                    } );
                }
            } );
        } );

        /**
         * Update the browser URL when select any field in agent search
         *
         * @param fieldName
         * @param fieldValue
         * @param url
         * @since 4.0.0
         */
        let realhomes_update_browser_URL = ( fieldName, fieldValue, url ) => {
            if ( fieldValue.length > 0 && fieldValue !== 'any' ) {
                if ( Array.isArray( fieldValue ) ) {
                    url.searchParams.delete( fieldName );
                    fieldValue.forEach( ( value, index ) => {
                        url.searchParams.append( fieldName, value );
                    } );
                } else {
                    url.searchParams.set( fieldName, fieldValue );
                }
                window.history.pushState( {}, '', url );
            } else {
                url.searchParams.delete( fieldName, fieldValue );
                window.history.pushState( {}, '', url );
            }
        }

        /**
         * Check for fields which are set as 'any', 'undefined' or empty arrays
         *
         * @param searchFieldValuesObj
         * @returns {*[]} (array)
         * @since 4.0.0
         */
        let realhomes_agency_search_values = ( searchFieldValuesObj ) => {
            let searchValues = [];
            Object.entries( searchFieldValuesObj ).forEach( ( [key, value] ) => {
                ( value !== 'any' && value !== '' && typeof value !== 'undefined' && value.length > 0 ) ? searchValues.push( value ) : '';
            } );
            return searchValues;
        }

    }

    /**
     * Update Pagination - Agency Search
     *
     * @param sourceURL
     * @since 4.0.0
     */
    let realhomes_update_agency_pagination = ( sourceURL ) => {
        const paginationContainer = $( '.rh_pagination' );
        paginationContainer.load( sourceURL + ' ' + '.rh_pagination > *' );
    }

} )( jQuery );