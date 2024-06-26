/**
 * Ajax Filters Sidebar Widget Functionality
 *
 * @since 4.1.0
 */
( function ( $ ) {
    "use strict";

    // Assigning targets
    const widgetMainWrapper = $( '.widget_properties_filter_widget' ),
          filterWidgetWrap  = $( '.property-filters' ),
          filterWrapper     = $( '.filter-wrapper' ),
          statsContainer    = $( '.rh_pagination__stats' ),
          pageID            = statsContainer.data( 'page-id' ),
          filtersWrapper    = $( '.widget_properties_filter_widget .filter-wrapper' ),
          openCollapseWrap  = $( '.collapse-button' );

    // Assigning default properties wrapper
    let propertiesSection   = $( '.rh_page__listing' ),
        viewTypeControl     = $( '.rh_view_type' ),
        mainWrapper         = $( '#properties-listing' ),
        postsPerPage        = mainWrapper.data( 'properties-count' ),
        filterDisplayWrap   = '.rh_page__listing_page',
        beforeFilterDisplay = '.rh_page__listing_page .rh_page__head',
        mapService          = 'openstreetmaps',
        designVariation     = 'modern',
        clearAllLabel       = 'Clear All';

    // Removing all widget other than first one from sidebar
    if ( widgetMainWrapper.length > 1 ) {
        widgetMainWrapper.not( ':first' ).remove();
    }

    // Checking if object exists.
    // Also updating the related variables if each object element is defined
    if ( typeof localizedFilters !== "undefined" ) {
        if ( localizedFilters.mapService !== undefined ) {
            mapService = localizedFilters.mapService;
        }
        if ( localizedFilters.designVariation !== undefined ) {
            designVariation = localizedFilters.designVariation;
        }
        if ( localizedFilters.filterStrings.clearAll !== undefined ) {
            clearAllLabel = localizedFilters.filterStrings.clearAll;
        }
    }

    // Changing the targets and classes based on ultra design variation
    if ( designVariation === 'ultra' ) {
        propertiesSection   = $( '.rh-properties-listing' );
        viewTypeControl     = $( '.rh-ultra-view-type' );
        beforeFilterDisplay = '.rh-ultra-page-title-area';
        filterDisplayWrap   = '.rh-ultra-page-content';
    }

    if ( ! parseInt( postsPerPage ) ) {
        postsPerPage = 6;
    }

    // Declaring an object to use globally for filtering properties
    let searchFieldValues = {};

    // Setting posts per page
    searchFieldValues['filter_posts_count'] = postsPerPage;

    // Calling the document.ready here after variable initialization based on design variation and other on page targets
    $( document ).ready( function () {

        // Adding filters display wrapper to show on the top of properties on listing templates
        if ( 0 === $( filterDisplayWrap + ' .filters-display' ).length ) {
            $( beforeFilterDisplay )
            .after( '<div class="filters-display"><span class="clear-all-filters">' + clearAllLabel + '</span></div>' );
        }

    } );


    // Controlling the toggle using headings for all filter widget sections
    filterWidgetWrap.on( 'click', '.filter-wrapper h4', function ( e ) {
        $( this ).siblings( '.filter-section' ).slideToggle( 300 );
        $( this ).toggleClass( 'collapsed' );
    } );


    // Controlling opening and collapsing of all filter sections of the sidebar widget
    openCollapseWrap.on( 'click', 'span', function ( e ) {
        let thisClasses = $( this ).attr( 'class' );
        $( this ).addClass( 'hidden' ).siblings( 'span' ).removeClass( 'hidden' );
        if ( thisClasses.includes( 'pop-collapse-all' ) ) {
            filterWrapper.children( 'h4' ).addClass( 'collapsed' ).siblings( '.filter-section' ).hide( 200 );
        } else {
            filterWrapper.children( 'h4' ).removeClass( 'collapsed' ).siblings( '.filter-section' ).show( 200 );
        }
    } );


    // Changing the sorting ID to get rid of the conflict with other ajax calls related to it
    $( '#sort-properties' ).attr( 'id', 'filter-sort-properties' );
    searchFieldValues['properties_sort_by'] = $( '#filter-sort-properties' ).val();
    
    // Acting on the change of sorting control menu
    $( '#filter-sort-properties' ).on( 'change', function ( e ) {
        e.preventDefault();
        searchFieldValues['properties_sort_by'] = $( this ).val();

        realhomes_trigger_filters_ajax( searchFieldValues );
    } );


    /* Handling view more functionality for property taxonomy filters and post type filters
       sections of the widget like (type, location, status, features, agents, agencies) */
    filtersWrapper.on( 'click', '.filter-section > a', function ( e ) {
        let thisItem  = $( this ),
            thisClass = thisItem.attr( 'class' );

        if ( thisClass === 'view-more' ) {
            thisItem.hide( 0, function () {
                thisItem.siblings( '.view-less' ).show();
            } );
            thisItem.siblings( '.items-view-more' ).show( 200 );
        } else {
            thisItem.hide( 0, function () {
                thisItem.siblings( '.view-more' ).show();
                thisItem.siblings( '.items-view-more' ).hide( 300 );
            } );
        }
    } );


    // Triggering the taxonomy filters on click (types, locations, statuses, features)
    filtersWrapper.on( 'click', '.terms-list > div > span', function ( event ) {
        event.preventDefault();

        let currentFilter      = $( this ),
            currentSlug        = currentFilter.data( 'term-slug' ),
            parentWrap         = currentFilter.parent( 'div' ).parent( 'div' ),
            sectionHeading     = parentWrap.siblings( 'h4' ),
            currentTaxonomy    = parentWrap.data( 'taxonomy' ),
            currentTitle       = parentWrap.data( 'display-title' ),
            filtersDisplayWrap = $( '.filters-display' ),
            viewMoreBtn        = $( parentWrap ).find( '.view-more' ),
            filterDisplayHTML  = '';

        // Showing hidden meta items when clicked on any item
        viewMoreBtn.hide( 0, function () {
            $( this ).siblings( '.view-less' ).show().siblings( '.items-view-more' ).show( 200 );
        } );

        // Actions for already active checkbox
        if ( currentFilter.hasClass( 'active' ) ) {
            currentFilter.removeClass( 'active' );
            let thisIndex = realhomes_find_object_value_index( searchFieldValues, currentTaxonomy, currentSlug );
            if ( thisIndex > -1 && searchFieldValues[currentTaxonomy][thisIndex] === currentSlug ) {
                delete searchFieldValues[currentTaxonomy][thisIndex];
            }

            // Removing this item from filters list at the top of listing
            $( filterDisplayWrap + ' .filters-display #' + currentSlug + '-filter-label' ).remove();

            // Process section heading filters counter
            realhomes_process_counter( sectionHeading, 'decrease' );

        } else {

            // Adding selected checkbox value to the set
            currentFilter.addClass( 'active' );
            let taxonomySet = searchFieldValues[currentTaxonomy];
            if ( ! Array.isArray( taxonomySet ) ) {
                taxonomySet = [];
            }

            // Adding current value to tax set and main object
            taxonomySet.push( currentSlug );
            searchFieldValues[currentTaxonomy] = taxonomySet;

            // Adding filter display on the top of property listing
            let filterDisplayName = currentSlug.replace(/-/g, ' ');
            filterDisplayName     = capitalizeWords( filterDisplayName );
            filterDisplayHTML += '<span id="' + currentSlug + '-filter-label" data-key-type="' + currentTaxonomy + '"><span class="filter-name" data-filter-value="' + currentSlug + '">' + currentTitle + ': </span>' + filterDisplayName + '<i></i></span>';
            $( filtersDisplayWrap ).children( '.clear-all-filters' ).before( filterDisplayHTML );

            // Process section heading filters counter
            realhomes_process_counter( sectionHeading, 'increase' );
        }

        // Ajax trigger after setting the related values
        realhomes_trigger_filters_ajax( searchFieldValues );

    } );


    // Triggering filter ajax based on radio list selections. (Price ranges, Area ranges)
    filtersWrapper.on( 'click', '.range-list .radio-wrap input', function ( event ) {

        let currentFilter     = $( this ),
            currentSlug       = currentFilter.parent( '.radio-wrap' ).data( 'meta-name' ),
            currentValue      = currentFilter.val(),
            filtersDisplay    = $( '.filters-display' ),
            filterDisplayHTML = '',
            filterLabelTitle  = currentFilter.parent( '.radio-wrap' ).data( 'display-title' ),
            filterLabelValue  = currentFilter.data( 'display-value' ),
            currentNumMetaID  = currentSlug + '-filter-label',
            currentValueArray = currentValue.split( ' - ' );

        // Adding price range to main object
        if ( 'price' === currentSlug ) {
            if ( 'All' === currentValue ) {
                searchFieldValues['price']    = [];
                searchFieldValues['minPrice'] = [];
                searchFieldValues['maxPrice'] = [];
            } else {
                searchFieldValues['price']    = currentValue;
                searchFieldValues['minPrice'] = parseInt( currentValueArray[0] );
                searchFieldValues['maxPrice'] = parseInt( currentValueArray[1] );
            }
        }

        // Adding area range to main object
        if ( 'area' === currentSlug ) {
            if ( 'All' === currentValue ) {
                searchFieldValues['area']    = [];
                searchFieldValues['minArea'] = [];
                searchFieldValues['maxArea'] = [];
            } else {
                searchFieldValues['area']    = currentValue;
                searchFieldValues['minArea'] = parseInt( currentValueArray[0] );
                searchFieldValues['maxArea'] = parseInt( currentValueArray[1] );
            }
        }

        // Adding filter display on the top of property listing
        $( filterDisplayWrap + ' #' + currentNumMetaID ).remove();
        if ( 'All' !== currentValue ) {
            filterDisplayHTML += '<span id="' + currentNumMetaID + '" data-key-type="' + currentSlug + '"><span class="filter-name" data-filter-value="' + currentValue + '">' + filterLabelTitle + ': </span>' + filterLabelValue + '<i></i></span>';
            $( filtersDisplay ).children( '.clear-all-filters' ).before( filterDisplayHTML );
        }

        // Ajax trigger after setting the related values
        realhomes_trigger_filters_ajax( searchFieldValues );

    } );

    // Triggering filter ajax based on number selections. (Bedrooms, Bathrooms, Garages)
    filtersWrapper.on( 'click', '.number-option-wrap .option-num input', function ( event ) {

        let currentFilter     = $( this ),
            parentWrap        = currentFilter.parent( '.option-num' )
            .parent( '.number-option-wrap' )
            .parent( '.filter-section' ),
            currentMeta       = parentWrap.data( 'meta-name' ),
            currentTitle      = parentWrap.data( 'display-title' ),
            currentValue      = currentFilter.val(),
            relatedMetas      = ['bedrooms', 'bathrooms', 'garages'],
            filtersDisplay    = $( '.filters-display' ),
            currentNumMetaID  = currentMeta + '-filter-label',
            filterDisplayHTML = '';

        // Managing buttoned number controls in the main object
        if ( relatedMetas.includes( currentMeta ) ) {
            if ( 0 === currentValue || '0' === currentValue ) {
                searchFieldValues[currentMeta] = [];
                $( filterDisplayWrap + ' #' + currentNumMetaID ).remove();
            } else {
                // Adding filter display on the top of property listing
                searchFieldValues[currentMeta] = parseInt( currentValue );
                $( filterDisplayWrap + ' #' + currentNumMetaID ).remove();
                filterDisplayHTML += '<span id="' + currentNumMetaID + '" data-key-type="' + currentMeta + '"><span class="filter-name" data-filter-value="' + currentValue + '">' + currentTitle + ': </span>' + currentValue + '<i></i></span>';
                $( filtersDisplay ).children( '.clear-all-filters' ).before( filterDisplayHTML );
            }
        }

        // Ajax trigger after setting the related values
        realhomes_trigger_filters_ajax( searchFieldValues );

    } );


    // Triggering the post type filters. (agents, agencies)
    filtersWrapper.on( 'click', '.posts-list > div > div', function ( event ) {

        // Prevent the default event of click just in case
        event.preventDefault();

        let currentFilter      = $( this ),
            currentSlug        = currentFilter.data( 'post-id' ),
            parentWrap         = currentFilter.parent( 'div' ).parent( 'div' ),
            sectionHeading     = parentWrap.siblings( 'h4' ),
            currentPostType    = parentWrap.data( 'meta-name' ),
            currentTitle       = parentWrap.data( 'display-title' ),
            viewMoreBtn        = $( parentWrap ).find( '.view-more' ),
            filtersDisplayWrap = $( '.filters-display' ),
            currentTargetID    = currentSlug.split( '|' ),
            filterDisplayHTML  = '';

        currentTargetID = currentTargetID[1];
        currentTargetID = currentTargetID.replace( /\s+/g, '-' ).toLowerCase();

        // Showing hidden checkbox items upon click on any item
        viewMoreBtn.hide( 0, function () {
            $( this ).siblings( '.view-less' ).show().siblings( '.items-view-more' ).show( 200 );
        } );

        // Managing checkboxes of post type filters
        if ( currentFilter.hasClass( 'active' ) ) {

            currentFilter.removeClass( 'active' );

            let thisIndex = realhomes_find_object_value_index( searchFieldValues, currentPostType, currentSlug );

            if ( thisIndex > -1 && searchFieldValues[currentPostType][thisIndex] === currentSlug ) {
                delete searchFieldValues[currentPostType][thisIndex];
            }

            // Removing this item from filters list at the top of listing
            $( filterDisplayWrap + ' .filters-display #' + currentTargetID + '-filter-label' ).remove();

            // Process section heading filters counter
            realhomes_process_counter( sectionHeading, 'decrease' );
        } else {

            // Adding selected checkbox value to the set
            currentFilter.addClass( 'active' );
            let postTypeSet = searchFieldValues[currentPostType];
            if ( ! Array.isArray( postTypeSet ) ) {
                postTypeSet = [];
            }
            postTypeSet.push( currentSlug );
            searchFieldValues[currentPostType] = postTypeSet;

            // Adding filter display on the top of property listing
            let currentPTValue = currentSlug.split( '|' );
            filterDisplayHTML += '<span id="' + currentTargetID + '-filter-label" data-key-type="' + currentPostType + '"><span class="filter-name" data-filter-value="' + currentSlug + '">' + currentTitle + ': </span>' + currentPTValue[1] + '<i></i></span>';
            $( filtersDisplayWrap ).children( '.clear-all-filters' ).before( filterDisplayHTML );

            // Process section heading filters counter
            realhomes_process_counter( sectionHeading, 'increase' );
        }

        // Ajax trigger after setting the related values
        realhomes_trigger_filters_ajax( searchFieldValues );

    } );


    // Triggering filter ajax based property ID field in sidebar widget
    let typeDelayTimer; // Timer delay variable to be used later on
    filtersWrapper.on( 'keyup', '.input-filter .input-wrap #property-id', function ( event ) {

        let thisItem           = $( this ),
            filtersDisplayWrap = $( '.filters-display' ),
            currentMeta        = thisItem.parent( 'p' ).data( 'meta-name' ),
            currentValue       = thisItem.val(),
            currentTitle       = thisItem.parent( 'p' ).parent( 'div' ).siblings( 'h4' ).html(),
            currentNumMetaID   = currentMeta + '-filter-label',
            filterDisplayHTML  = '';

        // Clearing previous keyup requests
        clearTimeout( typeDelayTimer );

        // Input field request after 1 second timeout to keep the request minimum
        typeDelayTimer = setTimeout( function () {
            searchFieldValues['propertyID'] = thisItem.val();

            // Adding filter display on the top of property listing
            $( filterDisplayWrap + ' #' + currentNumMetaID ).remove();
            if ( 0 < currentValue.length ) {
                filterDisplayHTML += '<span id="' + currentNumMetaID + '" data-key-type="' + currentMeta + '"><span class="filter-name" data-filter-value="' + currentValue + '">' + currentTitle + ': </span>' + currentValue + '<i></i></span>';
            }
            $( filtersDisplayWrap ).children( '.clear-all-filters' ).before( filterDisplayHTML );

            // Ajax trigger after setting the related values
            realhomes_trigger_filters_ajax( searchFieldValues );
        }, 1000 );

    } );


    // Triggering additional detail input text type filters
    filtersWrapper.on( 'keyup', '.additional-item .input-wrap input', function ( event ) {

        // Prevent the default event of click just in case
        event.preventDefault();

        let thisItem           = $( this ),
            fieldSlug          = thisItem.attr( 'name' ),
            currentTitle       = thisItem.siblings( 'label' ).html(),
            currentNumMetaID   = fieldSlug + '-filter-label',
            currentValue       = thisItem.val(),
            filtersDisplayWrap = $( '.filters-display' ),
            filterDisplayHTML  = '';

        // Clearing previous keyup requests
        clearTimeout( typeDelayTimer );

        // Input field request after 1 second timeout to keep the request minimum
        typeDelayTimer = setTimeout( function () {

            searchFieldValues[fieldSlug] = currentValue;

            // Adding filter display on the top of property listing
            $( filterDisplayWrap + ' #' + currentNumMetaID ).remove();
            if ( 0 < currentValue.length ) {
                filterDisplayHTML += '<span id="' + currentNumMetaID + '" data-key-type="' + fieldSlug + '"><span class="filter-name" data-filter-value="' + currentValue + '">' + currentTitle + ': </span>' + currentValue + '<i></i></span>';
            }
            $( filtersDisplayWrap ).children( '.clear-all-filters' ).before( filterDisplayHTML );

            // Ajax trigger after setting the related filters
            realhomes_trigger_filters_ajax( searchFieldValues );
        }, 1000 );

    } );

    // Triggering additional detail select type dropdown filters
    filtersWrapper.on( 'change', '.additional-item .select-wrap select', function ( event ) {

        let thisItem           = $( this ),
            fieldSlug          = $( this ).attr( 'name' ),
            currentTitle       = thisItem.siblings( 'label' ).html(),
            currentNumMetaID   = fieldSlug + '-filter-label',
            currentValue       = thisItem.val(),
            currentDisplay     = capitalizeWords( currentValue ),
            filtersDisplayWrap = $( '.filters-display' ),
            filterDisplayHTML  = '';

        searchFieldValues[fieldSlug] = currentValue;

        // Adding filter display on the top of property listing
        $( filterDisplayWrap + ' #' + currentNumMetaID ).remove();
        if ( 0 < currentValue.length ) {
            filterDisplayHTML += '<span id="' + currentNumMetaID + '" data-key-type="' + fieldSlug + '"><span class="filter-name" data-filter-value="' + currentValue + '">' + currentTitle + ': </span>' + currentDisplay + '<i></i></span>';
        }
        $( filtersDisplayWrap ).children( '.clear-all-filters' ).before( filterDisplayHTML );

        // Ajax trigger after setting the related filters
        realhomes_trigger_filters_ajax( searchFieldValues );

    } );


    // Triggering additional detail radio field type filters
    filtersWrapper.on( 'click', '.additional-item .radio-wrap input', function ( event ) {

        let thisItem           = $( this ),
            fieldSlug          = $( this ).attr( 'name' ),
            currentTitle       = thisItem.parent( 'p' ).siblings( 'h5' ).html(),
            currentNumMetaID   = fieldSlug + '-filter-label',
            currentValue       = thisItem.val(),
            currentDisplay     = capitalizeWords( currentValue ),
            filtersDisplayWrap = $( '.filters-display' ),
            filterDisplayHTML  = '';

        // Assigning the current range value to global object
        searchFieldValues[fieldSlug] = currentValue;

        // Adding filter display on the top of property listing
        $( filterDisplayWrap + ' #' + currentNumMetaID ).remove();
        if ( 0 < currentValue.length ) {
            filterDisplayHTML += '<span id="' + currentNumMetaID + '" data-key-type="' + fieldSlug + '"><span class="filter-name" data-filter-value="' + currentValue + '">' + currentTitle + ': </span>' + currentDisplay + '<i></i></span>';
        }
        $( filtersDisplayWrap ).children( '.clear-all-filters' ).before( filterDisplayHTML );

        // Ajax trigger after setting the related filters
        realhomes_trigger_filters_ajax( searchFieldValues );

    } );


    // Triggering additional detail checkbox field type filters
    filtersWrapper.on( 'click', '.additional-item .checkbox-wrap input', function ( event ) {

        let thisItem           = $( this ),
            thisWrap           = thisItem.parent( 'p' ).parent( '.checkbox-filter' ),
            fieldSlug          = $( this ).attr( 'name' ),
            currentTitle       = thisItem.parent( 'p' ).siblings( 'h5' ),
            currentTitleVal     = currentTitle.html(),
            inputValues        = $( thisWrap ).find( 'input' ),
            filtersDisplayWrap = $( '.filters-display' ),
            selectedValues     = [],
            filterDisplayHTML  = '';

        for ( let [key, checkbox] of Object.entries( inputValues ) ) {
            $( filterDisplayWrap + ' #' + checkbox.value + '-filter-label' ).remove();
        }

        let selectedCheckBoxes = Array.prototype.slice.call( inputValues ).filter( ch => ch.checked === true );

        // Adding/Creating mini counter to additional checkboxes heading after check if container already exists
        if ( 0 < selectedCheckBoxes.length ) {
            if ( 0 < currentTitle.children( '.counter' ).length ) {
                currentTitle.children( '.counter' )
                .html( '(' + '<i>' + selectedCheckBoxes.length + '</i> ' + localizedFilters.filterStrings.selected + ')' );
            } else {
                currentTitle.append( '<span class="counter">(' + '<i>' + selectedCheckBoxes.length + '</i> ' + localizedFilters.filterStrings.selected + ')</span>' );
            }
            currentTitle.children( '.counter' ).show();
        } else {
            currentTitle.children( '.counter' ).hide();
        }

        for ( let [key, checkbox] of Object.entries( selectedCheckBoxes ) ) {
            let currentValue     = checkbox.value,
                currentNumMetaID = currentValue + '-filter-label',
                currentDisplay   = capitalizeWords( currentValue );
            selectedValues.push( currentValue );

            $( filterDisplayWrap + ' .ad-checkbox-display-item' ).remove();
            if ( 0 < currentValue.length && 0 === $( filterDisplayWrap + ' #' + currentNumMetaID ).length ) {
                let OptionTitle = currentTitleVal.split('<span')[0];
                filterDisplayHTML += '<span id="' + currentNumMetaID + '" class="ad-checkbox-display-item" data-key-type="' + fieldSlug + '"><span class="filter-name" data-filter-value="' + currentValue + '">' + OptionTitle + ': </span>' + currentDisplay + '<i></i></span>';
            }

            $( filtersDisplayWrap ).children( '.clear-all-filters' ).before( filterDisplayHTML );
        }

        searchFieldValues[fieldSlug] = selectedValues;
        realhomes_trigger_filters_ajax( searchFieldValues );

    } );


    // Triggering the properties listing bottom pagination for filtered properties
    $( document ).on( 'click', '.filter-pagination .rh_filter_pagination a', function ( event ) {

        // Prevent default <a> tag behaviour
        event.preventDefault();

        let currentPage    = $( this ).siblings( '.current' ),
            pagiLoader     = $( '.filter-pagination .svg-loader' ),
            currentPageNum = currentPage.data( 'page-number' ),
            thisPageNum    = $( this ).data( 'page-number' );

        if ( currentPageNum !== thisPageNum ) {

            searchFieldValues['page'] = thisPageNum;
            pagiLoader.css( 'height', '32px' );

            $.ajax( {
                url     : ajaxurl,
                type    : 'post',
                data    : {
                    action      : 'realhomes_properties_ajax_filter',
                    fieldValues : searchFieldValues,
                    pageID      : pageID
                },
                success : ( response ) => {
                    pagiLoader.css( 'height', '0' );
                    propertiesSection.empty().append( response.data.search_results );

                    if ( undefined !== response.data.search_query ) {
                        let searchQuery = response.data.search_query.query_vars,
                            currentPage = 1,
                            stats       = response.data.search_query,
                            per_page    = searchQuery.posts_per_page,
                            foundPosts  = stats.found_posts;

                        if ( undefined !== searchQuery.paged && 0 < parseInt( searchQuery.paged ) ) {
                            currentPage = searchQuery.paged;
                        }

                        let currentPostsStart = ( currentPage - 1 ) * per_page + 1;
                        let currentPostsEnd   = per_page * currentPage;

                        if ( currentPostsEnd >= foundPosts ) {
                            currentPostsEnd = foundPosts;
                        }

                        $( '.rh_page > .rh_pagination, .rh_page > .svg-loader' ).remove();
                        $( '.filter-pagination .rh_filter_pagination a.current' ).removeClass( 'current' );
                        $( '.filter-pagination .rh_filter_pagination a[data-page-number=' + currentPage + ']' )
                        .addClass( 'current' );

                        // Updating the pagination stats visible on the top left of the properties listing
                        updatePaginationStats( currentPostsStart, currentPostsEnd, foundPosts );

                    } else {

                        updatePaginationStats( 0 );

                    }

                    // Trigger the map according to the properties object
                    $.ajax( {
                        url     : ajaxurl,
                        type    : 'post',
                        data    : {
                            action : 'realhomes_map_ajax_search_results',
                            ...searchFieldValues
                        },
                        success : ( response ) => {
                            let propertiesMapData = response.data.propertiesData,
                                mapServiceType    = mapService.toString();
                            realhomes_update_properties_on_map( mapServiceType, propertiesMapData );
                        }
                    } );

                }
            } );

        }

    } );


    // Clearing all the filters
    $( filterDisplayWrap ).on( 'click', '.filters-display .clear-all-filters', function () {

        // Saving existing sortby value
        let currentSortBy = searchFieldValues['properties_sort_by'];

        for ( let filter in searchFieldValues ) {
            searchFieldValues = {
                filter_posts_count : postsPerPage,
                properties_sort_by : currentSortBy
            };
        }

        $( this ).siblings( 'span' ).remove();
        $( this ).removeClass( 'active' );

        // Resetting all input fields in filters widget
        $( filtersWrapper ).find( 'input[type=text]' ).val( '' );

        // Resetting all select dropdown fields in filters widget
        $( filtersWrapper ).find( 'select' ).prop( 'selectedIndex', 0 );

        // Resetting all radio fields in filters widget
        $( filtersWrapper ).find( '.radio-wrap:first-of-type input' ).prop( 'checked', true );

        // Resetting all taxonomy terms and post type items in filters widget
        $( filtersWrapper ).find( '.posts-list span, .posts-list .pt-item, .terms-list span' ).removeClass( 'active' );

        // Resetting all numbers fields in filters widget
        $( filtersWrapper ).find( '.option-num:first-child input' ).prop( 'checked', true );

        // Resetting all checkbox fields in filters widget
        $( filtersWrapper ).find( '.cb-wrap input' ).prop( 'checked', 0 );

        // Triggering the ajax call after clearing all filters
        realhomes_trigger_filters_ajax( searchFieldValues );

        // Resting heading counters of all the filter sections in the widget
        $( '.filter-wrapper > h4' ).children( '.counter' ).remove();
    } );


    // Controlling the view type buttons (grid/list) on top of listings
    viewTypeControl.on( 'click', 'a', function ( e ) {

        // Preventing default behaviour
        e.preventDefault();

        let currentURL = new URL(window.location);

        // Setting list view as default
        searchFieldValues['view_type'] = 'list';

        viewTypeControl.children( 'a' ).removeClass( 'active' );

        $( this ).addClass( 'active' );

        // If clicked on grid then value will be changed
        if ( $( this ).hasClass( 'grid' ) ) {
            searchFieldValues['view_type'] = 'grid';

            // Setting top url to manage view type on page load
            if ( currentURL.searchParams.has('view') === true ) {
                currentURL.searchParams.set('view', 'grid');
            }

            if ( designVariation === 'modern' ) {
                propertiesSection.addClass( 'rh_page__listing_grid' ).addClass( 'rh-grid-2-columns' );
            }

            if ( designVariation === 'ultra' ) {
                $( '#properties-listing' )
                .removeClass( 'rh-ultra-list-layout-listing' )
                .addClass( 'rh-ultra-grid-listing' );
                propertiesSection.removeClass( 'rh-ultra-list-wrapper' ).addClass( 'rh-ultra-grid-wrapper' );
            }
        } else {
            // Setting top url to manage view type on page load
            if ( currentURL.searchParams.has('view') === true ) {
                currentURL.searchParams.set('view', 'list');
            }

            if ( designVariation === 'modern' ) {
                propertiesSection.removeClass( 'rh_page__listing_grid' ).removeClass( 'rh-grid-2-columns' );
            }

            if ( designVariation === 'ultra' ) {
                $( '#properties-listing' )
                .removeClass( 'rh-ultra-grid-listing' )
                .addClass( 'rh-ultra-list-layout-listing' );
                propertiesSection.removeClass( 'rh-ultra-grid-wrapper' ).addClass( 'rh-ultra-list-wrapper' );
            }
        }

        // Setting top url for view type $_GET values
        window.history.pushState({}, null, currentURL);

        realhomes_trigger_filters_ajax( searchFieldValues );
    } );


    /**
     * This function triggers the ajax call to fetch properties
     * according to the selected/provided filters
     *
     * @since 4.1.0
     * @modified 4.2.0
     *
     * @param searchFieldValues array
     *
     * */
    let realhomes_trigger_filters_ajax = ( searchFieldValues ) => {

        // To reset pagination to first after re-filtering of the properties
        if ( 0 !== Object.keys( searchFieldValues ).length ) {
            $( filterDisplayWrap + ' .filters-display .clear-all-filters' ).addClass( 'active' );
            searchFieldValues['page'] = 1;
        }

        if ( 2 > $( filterDisplayWrap + ' .filters-display' ).children( 'span' ).length ) {
            $( filterDisplayWrap + ' .filters-display .clear-all-filters' ).removeClass( 'active' );
        }

        let currentURLParams = new URLSearchParams(window.location.search),
            viewType = currentURLParams.get('view');

        if ( viewType !== null ) {
            searchFieldValues['view_type'] = viewType;
        }

        // Setting search field values to local storage
        localStorage.setItem( 'filterSectionValues', JSON.stringify( searchFieldValues ) );

        // Updating filters tags on top of properties listing based on local storage values
        realhomes_update_storage_display();

        propertiesSection.addClass( 'loading' );

        $.ajax( {
            url     : ajaxurl,
            type    : 'post',
            data    : {
                action      : 'realhomes_properties_ajax_filter',
                fieldValues : searchFieldValues,
                pageID      : pageID
            },
            success : ( response ) => {
                propertiesSection.empty().append( response.data.search_results );
                $( '.rh_page > .rh_pagination, .rh_page > .svg-loader' ).remove();
                propertiesSection.removeClass( 'loading' );

                if ( undefined !== response.data.search_query ) {
                    let searchQuery = response.data.search_query.query_vars,
                        currentPage = 1,
                        stats       = response.data.search_query,
                        per_page    = searchQuery.posts_per_page,
                        foundPosts  = stats.found_posts;

                    if ( undefined !== searchQuery.page && 0 < parseInt( searchQuery.page ) ) {
                        currentPage = searchQuery.page;
                    }

                    let currentPostsStart = ( currentPage - 1 ) * per_page + 1;
                    let currentPostsEnd   = per_page * currentPage;

                    if ( currentPostsEnd >= foundPosts ) {
                        currentPostsEnd = foundPosts;
                    }

                    // Updating the pagination stats visible on the top left of the properties listing
                    updatePaginationStats( currentPostsStart, currentPostsEnd, foundPosts );

                } else {

                    // Updating the pagination stats visible on the top left of the properties listing
                    updatePaginationStats( 0 );

                }

                // Trigger the map according to the properties object
                $.ajax( {
                    url     : ajaxurl,
                    type    : 'post',
                    data    : {
                        action : 'realhomes_map_ajax_search_results',
                        ...searchFieldValues
                    },
                    success : ( response ) => {
                        let propertiesMapData = response.data.propertiesData,
                            mapServiceType    = mapService.toString();
                        realhomes_update_properties_on_map( mapServiceType, propertiesMapData );
                    }
                } );

            }
        } );

    }


    /**
     * Update the filters properties on the map according to map service type
     *
     * @since 4.1.0
     *
     * @param mapServiceType
     * @param propertiesMapData
     *
     */
    let realhomes_update_properties_on_map = ( mapServiceType, propertiesMapData ) => {

        if ( designVariation !== 'classic' && typeof mapServiceType !== "undefined" ) {
            if (  mapServiceType === 'openstreetmaps' && window.realhomes_update_open_street_map ) {
                realhomes_update_open_street_map( propertiesMapData );
            } else if ( mapServiceType === 'mapbox' && window.realhomes_update_mapbox ) {
                $( '#map-head' ).empty().append( '<div id="listing-map"></div>' );
                realhomes_update_mapbox( propertiesMapData );
            } else if ( window.realhomes_update_google_map ) {
                realhomes_update_google_map( propertiesMapData );
            }
        }
    }


    /**
     * Getting the index of an array item based of the given key and value
     *
     * @since 4.1.0
     *
     * @param targetItem mixed
     * @param key string
     * @param value string
     *
     * @return number
     *
     */
    let realhomes_find_object_value_index = ( targetItem, key, value ) => {
        for ( let i = 0; i < targetItem[key].length; i += 1 ) {
            if ( targetItem[key][i] === value ) {
                return i;
            }
        }
        return -1;
    }


    /**
     * Update pagination stats on the visible top of listings
     *
     * @since 4.1.0
     *
     * @param start int
     * @param end int
     * @param total int
     *
     */
    function updatePaginationStats( start, end, total ) {

        if ( 0 < start ) {
            if ( statsContainer.hasClass( 'hidden' ) ) {
                statsContainer.removeClass( 'hidden' ).show();
            }

            if ( localizedFilters.designVariation === 'ultra' ) {
                statsContainer.children( 'span:first-child' ).html( start );
                statsContainer.children( 'span:nth-child(2)' ).html( end );
                statsContainer.children( 'span:nth-child(3)' ).html( total );
            } else {
                statsContainer.children( '.highlight_stats:first-child' ).html( start );
                statsContainer.children( '.highlight_stats:nth-child(3)' ).html( end );
                statsContainer.children( '.highlight_stats:nth-child(5)' ).html( total );
            }
        } else {
            statsContainer.addClass( 'hidden' ).hide();
        }

    }


    // Handling close trigger for displayed filter on the top of properties
    $( filterDisplayWrap ).on( 'click', '.filters-display span i', function () {
        let thisItem      = $( this ).parent( 'span' );
        let thisValue     = $( this ).siblings( 'span' ).data( 'filter-value' );
        let thisFilterKey = $( this ).parent( 'span' ).data( 'key-type' );

        // Remove entry with current key and value
        for ( let [filter, values] of Object.entries( searchFieldValues ) ) {
            if ( thisFilterKey === filter ) {
                if ( Array.isArray( values ) ) {
                    for ( let [key, value] of Object.entries( values ) ) {
                        if ( value === thisValue ) {
                            delete searchFieldValues[filter][key];
                        }
                    }
                } else {
                    if ( values === thisValue || parseInt( values ) === parseInt( thisValue ) ) {
                        delete searchFieldValues[filter];
                    }
                }
                thisItem.remove();
                realhomes_trigger_filters_ajax( searchFieldValues );
            }
        }

        // TODO: This functionality should handle an object intelligently to minimize the code and do it more efficiently

        let filterSection = $( '.property-filters .filter-section' );

        // Going through each filter section
        for ( let i = 0; i < filterSection.length; i++ ) {

            // Checking all taxonomy terms checkbox lists sections (types,locations,statuses,features)
            if ( filterSection[i].className.includes( 'terms-list' ) ) {

                // Getting the taxonomy name from section data attribute
                if ( thisFilterKey === filterSection[i].dataset.taxonomy ) {
                    let filterTargetWraps = filterSection[i].children;

                    // Removing/Decreasing filters' section counter
                    realhomes_process_filter_counter_display_tag_removal( filterSection[i] );

                    for ( let j = 0; j < filterTargetWraps.length; j++ ) {
                        if ( filterTargetWraps[j] instanceof HTMLDivElement ) {
                            let filterTargetItems = filterTargetWraps[j].children;
                            for ( let k = 0; k < filterTargetItems.length; k++ ) {
                                let thisTermValue = filterTargetItems[k].dataset.termSlug;
                                if ( thisTermValue === thisValue ) {
                                    filterTargetItems[k].className = '';
                                }
                            }
                        }
                    }
                }
                // Checking all post types checkbox lists sections (agents, agencies)
            } else if ( filterSection[i].className.includes( 'posts-list' ) ) {

                // Getting the meta name from section data attribute
                if ( thisFilterKey === filterSection[i].dataset.metaName ) {
                    let filterTargetWraps = filterSection[i].children;

                    // Removing/Decreasing filters' section counter
                    realhomes_process_filter_counter_display_tag_removal( filterSection[i] );

                    for ( let j = 0; j < filterTargetWraps.length; j++ ) {
                        if ( filterTargetWraps[j] instanceof HTMLDivElement ) {
                            let filterTargetItems = filterTargetWraps[j].children;
                            for ( let k = 0; k < filterTargetItems.length; k++ ) {
                                let thisPostValue = filterTargetItems[k].dataset.postId;
                                if ( thisPostValue === thisValue ) {
                                    filterTargetItems[k].classList.remove( "active" );
                                }
                            }
                        }
                    }
                }
                // Checking all buttons form number lists sections (beds, baths, garages)
            } else if ( filterSection[i].className.includes( 'buttons-list' ) ) {
                let thisMetaName     = filterSection[i].dataset.metaName,
                    filterTargetWrap = filterSection[i].children;

                for ( let j = 0; j < filterTargetWrap.length; j++ ) {
                    let thisMetaWrap = filterTargetWrap[j].children;
                    for ( let k = 0; k < thisMetaWrap.length; k++ ) {
                        if ( undefined !== thisMetaName && thisMetaName === thisFilterKey ) {

                            // Unchecking the checkbox if the value is matched with the clicked one
                            $( thisMetaWrap[0] ).find( 'input' ).prop( 'checked', true );
                        }
                    }
                }
                // Checking all radio input type ranges lists (price, area)
            } else if ( filterSection[i].className.includes( 'range-list' ) ) {
                let filterTargetWrap = filterSection[i].children,
                    targetMetaName   = filterTargetWrap[0].dataset.metaName;

                if ( targetMetaName === thisFilterKey ) {

                    // Resetting the buttons to first item which is usually 'All' for these sections
                    $( filterTargetWrap[0] ).find( 'input' ).prop( 'checked', true );
                }
                // Checking text input filters (property id)
            } else if ( filterSection[i].className.includes( 'input-filter' ) ) {
                let filterTargetWrap = filterSection[i].children,
                    targetMetaName   = filterTargetWrap[0].dataset.metaName;

                // Removing the input value based on removed filter display tag
                if ( targetMetaName === thisFilterKey ) {
                    $( filterTargetWrap[0] ).find( 'input' ).val( '' );
                }
                // Checking each additional field items
            } else if ( filterSection[i].className.includes( 'additional-items' ) ) {
                let filterTargetWrap = filterSection[i].children;
                for ( let j = 0; j < filterTargetWrap.length; j++ ) {
                    if ( filterTargetWrap[j].className.includes( 'additional-item' ) ) {

                        let thisFieldWrap = filterTargetWrap[j].children;
                        for ( let k = 0; k < thisFieldWrap.length; k++ ) {

                            // Checking if the additional field type of field is text type input
                            if ( thisFieldWrap[k].className.includes( 'input-filter' ) ) {
                                let fieldSlug = thisFieldWrap[k].children[1].id;
                                if ( fieldSlug === thisFilterKey ) {

                                    // Removing the input value upon reset
                                    $( thisFieldWrap[k] ).find( 'input' ).val( '' );
                                }
                                // Checking if the addition field type is a select dropdown
                            } else if ( thisFieldWrap[k].className.includes( 'select-filter' ) ) {
                                let fieldSlug = thisFieldWrap[k].children[1].id;
                                if ( fieldSlug === thisFilterKey ) {

                                    // Resetting the dropdown option to first item which is usually 'None' for these sections
                                    thisFieldWrap[k].children[1].selectedIndex = 0;
                                }
                                // Checking if the additional field type is radio type input
                            } else if ( thisFieldWrap[k].className.includes( 'radio-filter' ) ) {
                                let fieldSlug = thisFieldWrap[k].dataset.fieldSlug;
                                if ( fieldSlug === thisFilterKey ) {

                                    // Resetting the radio to first item which is the default one usually
                                    $( thisFieldWrap[k] ).find( 'p:first-of-type input' ).prop( 'checked', true );
                                }
                                // Checking if additional field type is checkbox type input
                            } else if ( thisFieldWrap[k].className.includes( 'checkbox-filter' ) ) {
                                let fieldSlug    = thisFieldWrap[k].dataset.fieldSlug;
                                let filterCBWrap = thisFieldWrap[k].children;
                                for ( let l = 0; l < filterCBWrap.length; l++ ) {
                                    if ( filterCBWrap[l].className.includes( 'cb-wrap' ) ) {
                                        let thisCBValue = filterCBWrap[l].children[0].value;
                                        if ( thisCBValue === thisValue ) {

                                            // Unchecking the checkbox field if the value is matched with the clicked one
                                            filterCBWrap[l].children[0].checked = false;
                                        }
                                    }

                                } // Ending for loop of filterCBWrap
                            } // Ending checkbox filter else condition of if statement
                        } // Ending for loop of thisFieldWrap addition field sections
                    } // Ending addition item wrap if condition
                } // Ending for loop for filterTargetWrap of additional items
            } // Ending if statement of additional items section
        } // Ending the filterSections for loop
    } );


    /**
     * Capitalize the given string
     *
     * @since 4.1.0
     *
     * @param string string
     *
     * @return string
     *
     */
    function capitalizeWords( string ) {

        return string.toLowerCase().split( ' ' ).map( function ( word ) {
            return ( word.charAt( 0 ).toUpperCase() + word.slice( 1 ) );
        } ).join( ' ' );

    }


    /**
     * Process filter section heading counter for sections containing multi-select options
     *
     *
     * @since 4.2.0
     *
     * @param target
     * @param type
     *
     * @return null
     */
    function realhomes_process_counter( target, type ) {

        let counter = 0;

        // Managing counter value if counter container already exists
        if ( 0 < target.children( '.counter' ).length ) {

            counter = parseInt( target.children( '.counter' ).children( 'i' ).html() );

            if ( 'decrease' === type ) {
                counter--;
            } else {
                counter++;
            }

            target.children( '.counter' )
            .html( '(' + '<i>' + counter + '</i> ' + localizedFilters.filterStrings.selected + ')' );

        } else {

            counter = 1;
            target.append( '<span class="counter">(' + '<i>' + counter + '</i> ' + localizedFilters.filterStrings.selected + ')</span>' );

        }

        // Handling counter display based on values count
        if ( counter === 0 ) {
            target.children( '.counter' ).hide();
        } else {
            target.children( '.counter' ).show();
        }
    }

    /**
     * Process filter section heading counter for filters display tags when those are removed from
     * the top of property listings
     *
     * @since 4.2.0
     *
     * @param target
     *
     * @return null
     */
    function realhomes_process_filter_counter_display_tag_removal( target ) {

        let counterWrap = target.previousElementSibling.children,
            counterDOM  = $( counterWrap ).children( 'i' ),
            counter     = $( counterWrap ).children( 'i' ).html();
        counterDOM.html( --counter );

        if ( counter < 1 ) {
            $( counterWrap ).hide();
        }
    }

    /**
     * Managing selected filter values stored in local storage and populating/selecting/checking those
     * in the filters' widget list sections according to their types
     *
     * @since 4.2.0
     */
    function realhomes_manage_storage_values() {

        let filterWidgetStorageItem = window.localStorage.getItem( 'filterSectionValues' );
        if ( filterWidgetStorageItem !== null ) {
            let taxonomies          = ['types', 'locations', 'statuses', 'features'],
                radioTypes          = ['price', 'area'],
                postTypes           = ['agent', 'agencies'],
                numberTypes         = ['bedrooms', 'bathrooms', 'garages'],
                filterWidgetObj     = JSON.parse( filterWidgetStorageItem ),
                filterKeys          = Object.keys( filterWidgetObj ),
                targetFilterSection = '';

            // Managing assigned items one by one
            filterKeys.forEach( ( key ) => {

                // Checking through number types (bed, bath, garage)
                radioTypes.forEach( ( radioFilter ) => {
                    if ( key === radioFilter ) {
                        let filterValue = filterWidgetObj[key];
                        if ( filterValue !== 'all' && 0 < filterValue.length ) {
                            let radioTargetID = filterValue.replaceAll( ' ', '' ),
                                radioItem     = $( '.' + radioFilter + '-ranges .range-list .radio-wrap #' + radioFilter + '-' + radioTargetID );
                            radioItem.prop( "checked", true );
                            searchFieldValues[radioFilter] = filterValue;
                            let minMaxValues               = radioTargetID.split( '-' ),
                                minTarget                  = 'minArea',
                                maxTarget                  = 'maxArea';
                            if ( radioFilter === 'price' ) {
                                minTarget = 'minPrice';
                                maxTarget = 'maxPrice';
                            }
                            searchFieldValues[minTarget] = minMaxValues[0];
                            searchFieldValues[maxTarget] = minMaxValues[1];
                        } else {
                            $( '.' + radioFilter + '-ranges .range-list .radio-wrap #' + radioFilter + '-All' ).prop( "checked", true );
                        }
                    }
                } );

                // Checking through taxonomies
                taxonomies.forEach( ( taxFilter ) => {
                    if ( key === taxFilter ) {
                        targetFilterSection = 'property-' + key;
                        let filterValues    = filterWidgetObj[key];
                        if ( Array.isArray( filterValues ) ) {
                            filterValues.forEach( ( filterItem ) => {
                                let spanItems = $( '.' + targetFilterSection + ' .terms-list span' );

                                for ( let i = 0; i < spanItems.length; i++ ) {
                                    let termDataSet = spanItems[i].dataset.termSlug,
                                        parentHeading = spanItems[i].parentNode.parentNode.previousElementSibling;
                                    if ( filterItem === termDataSet ) {
                                        spanItems[i].classList.add( 'active' );

                                        // Process section heading filters counter
                                        realhomes_process_counter( $( parentHeading ), 'increase' );
                                        let taxonomySet = searchFieldValues[taxFilter];
                                        if ( ! Array.isArray( taxonomySet ) ) {
                                            taxonomySet = [];
                                        }
                                        // Adding current value to tax set and main object
                                        taxonomySet.push( termDataSet );
                                        searchFieldValues[taxFilter] = taxonomySet;
                                    }
                                }
                            } );
                        }
                    }
                } );

                // Checking through post types
                postTypes.forEach( ( postTypeFilter ) => {
                    if ( key === postTypeFilter ) {
                        let filterValues = filterWidgetObj[key];
                        if ( key === 'agent' ) {
                            targetFilterSection = 'agent-options';
                        } else if ( key === 'agencies' ) {
                            targetFilterSection = 'agency-options';
                        }
                        if ( Array.isArray( filterValues ) ) {
                            filterValues.forEach( ( filterItem ) => {
                                let spanItems = $( '.' + targetFilterSection + ' .posts-list .pt-item' );
                                for ( let i = 0; i < spanItems.length; i++ ) {
                                    let ptDataSet     = spanItems[i].dataset.postId,
                                        parentHeading = spanItems[i].parentNode.parentNode.previousElementSibling;
                                    if ( filterItem === ptDataSet ) {
                                        spanItems[i].classList.add( 'active' );

                                        // Process section heading filters counter
                                        realhomes_process_counter( $( parentHeading ), 'increase' );
                                        let postTypeSet = searchFieldValues[postTypeFilter];
                                        if ( ! Array.isArray( postTypeSet ) ) {
                                            postTypeSet = [];
                                        }
                                        postTypeSet.push( ptDataSet );
                                        searchFieldValues[postTypeFilter] = postTypeSet;
                                    }
                                }
                            } );
                        }
                    }
                } );

                // Checking through number types (bed, bath, garage)
                numberTypes.forEach( ( numberFilter ) => {
                    if ( key === numberFilter ) {
                        let filterValue = filterWidgetObj[key],
                            numberClass = numberFilter.slice( 0, -1 );
                        let numberItems = $( '.radio-buttons .buttons-list .' + numberClass + '-options .option-num input#min-' + numberClass + '-' + filterValue );
                        numberItems.prop( "checked", true );
                        searchFieldValues[numberFilter] = parseInt( filterValue );
                    }
                } );

                if ( key === 'inspiry_radios' ) {
                    let filterValue  = filterWidgetObj[key],
                        targetItemID = filterValue.toLowerCase();
                    targetItemID     = targetItemID.replace( ' ', '-' );
                    if ( 0 < filterValue.length ) {
                        $( '.additional-items .additional-item.' + key + ' .radio-filter .radio-wrap #' + targetItemID ).prop( "checked", true );
                        searchFieldValues[key] = filterValue;
                    } else {
                        $( '.additional-items .inspiry_radios .radio-filter .radio-wrap #' + key + '-none' )
                        .prop( "checked", true );
                    }
                } else if ( key === 'inspiry_additional_checkbox' ) {
                    let filterValues = filterWidgetObj[key];
                    if ( Array.isArray( filterValues ) ) {
                        filterValues.forEach( ( checkValue ) => {
                            let targetItemID = checkValue.toLowerCase();
                            targetItemID     = targetItemID.replace( ' ', '-' );
                            if ( 0 < checkValue.length ) {

                                // Process section heading filters counter
                                realhomes_process_counter( $( '.additional-items .additional-item.' + key + ' h5' ), 'increase' );
                                $( '.additional-items .additional-item.' + key + ' .checkbox-filter .cb-wrap #' + targetItemID ).prop( "checked", true );
                                let adCheckboxSet = searchFieldValues[key];
                                if ( ! Array.isArray( adCheckboxSet ) ) {
                                    adCheckboxSet = [];
                                }
                                adCheckboxSet.push( checkValue );
                                searchFieldValues[key] = adCheckboxSet;
                            }
                        } );
                    }
                } else if ( key === 'inspiry_additional_text' ) {
                    let filterValue = filterWidgetObj[key];
                    $( '.additional-items .additional-item.' + key + ' .input-wrap #' + key ).val( filterValue );
                }
            } );
        }

        /* Injecting the selected filters tags on the top of property
        listings based on values saved in local storage */
        realhomes_inject_storage_display_tags();
    }

    /**
     * Update display filters tags to the local storage
     *
     * @since 4.2.0
     * */
    function realhomes_update_storage_display() {
        let filterDisplayValues = {};

        let filterElements = $( '.filters-display > span' );
        for ( let i = 0; i < filterElements.length; i++ ) {
            if ( filterElements[i].classList[0] !== 'clear-all-filters' ) {
                let thisChildren       = filterElements[i].children[0],
                    currentLabel       = filterElements[i].childNodes[1];
                filterDisplayValues[i] = {
                    'id'          : filterElements[i].id,
                    'keyType'     : filterElements[i].dataset.keyType,
                    'dataValue'   : thisChildren.dataset.filterValue,
                    'filterValue' : currentLabel.textContent,
                    'typeLabel'   : thisChildren.textContent
                };
            }
        }
        localStorage.setItem( 'filterDisplayValues', JSON.stringify( filterDisplayValues ) );
    }

    /**
     * Display all saved tags in local storage
     *
     * @since 4.2.0
     * */
    function realhomes_inject_storage_display_tags() {

        let filterDisplayValues = window.localStorage.getItem( 'filterDisplayValues' ),
            filtersDisplayWrap  = $( '.filters-display' );

        // Creating filter tags container if it does not exist
        if ( 0 === $( filterDisplayWrap + ' .filters-display' ).length ) {
            $( beforeFilterDisplay )
            .after( '<div class="filters-display"><span class="clear-all-filters">' + clearAllLabel + '</span></div>' );
        }

        // Populating filter display tags if exists in local storage
        if ( null !== filterDisplayValues && 0 < filterDisplayValues.length ) {
            let filterValuesObj = JSON.parse( filterDisplayValues );
            if ( 0 < Object.keys( filterValuesObj ).length ) {
                for ( let key in filterValuesObj ) {
                    let id        = filterValuesObj[key]['id'],
                        type      = filterValuesObj[key]['keyType'],
                        dataValue = filterValuesObj[key]['dataValue'],
                        value     = filterValuesObj[key]['filterValue'],
                        typeLabel = filterValuesObj[key]['typeLabel'];

                    $( filtersDisplayWrap )
                    .children( '.clear-all-filters' )
                    .before( '<span id="' + id + '" data-key-type="' + type + '"><span class="filter-name" data-filter-value="' + dataValue + '">' + typeLabel + ' </span>' + value + '<i></i></span>' );
                }
                $( '.clear-all-filters' ).addClass( 'active' );
            }

            // Triggering the filters ajax function for property population according to the saved settings
            realhomes_trigger_filters_ajax( searchFieldValues );
        }
    }

    // Calling the storage management function after page the is loaded
    $( document ).ready( function () {
        realhomes_manage_storage_values();
    } );

} )( jQuery );