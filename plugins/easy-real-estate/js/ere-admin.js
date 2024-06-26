( function ( $ ) {
    "use strict";

    $( document ).ready( function () {

        // Script for Additional Social Networks
        var fontsLink = '<div><a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank">' + ereSocialLinksL10n.iconLink + '</a></div>';
        $( document ).on( "click", "#inspiry-ere-add-sn", function ( event ) {
            var socialNetworksTable = $( '#inspiry-ere-social-networks-table' );
            var socialNetworkIndex  = socialNetworksTable.find( 'tbody tr' ).last().index() + 1;
            var socialNetwork       =
                    '<tr class="inspiry-ere-sn-tr">' +
                    '<th scope="row">' +
                    '<label for="inspiry-ere-sn-title-' + socialNetworkIndex + '">' + ereSocialLinksL10n.title + '</label>' +
                    '<input type="text" id="inspiry-ere-sn-title-' + socialNetworkIndex + '" name="inspiry_ere_social_networks[' + socialNetworkIndex + '][title]" class="code">' +
                    '</th>' +
                    '<td>' +
                    '<div>' +
                    '<label for="inspiry-ere-sn-url-' + socialNetworkIndex + '"><strong>' + ereSocialLinksL10n.profileURL + '</strong></label>' +
                    '<input type="text" id="inspiry-ere-sn-url-' + socialNetworkIndex + '" name="inspiry_ere_social_networks[' + socialNetworkIndex + '][url]" class="regular-text code">' +
                    '</div>' +
                    '<div>' +
                    '<label for="inspiry-ere-sn-icon-' + socialNetworkIndex + '"><strong>' + ereSocialLinksL10n.iconClass + '</strong> <small>- <em>' + ereSocialLinksL10n.iconExample + '</em></small></label>' +
                    '<input type="text" id="inspiry-ere-sn-icon-' + socialNetworkIndex + '" name="inspiry_ere_social_networks[' + socialNetworkIndex + '][icon]" class="code">' +
                    '<a href="#" class="inspiry-ere-remove-sn inspiry-ere-sn-btn">-</a>' +
                    fontsLink +
                    '</div>' +
                    '</td>' +
                    '</tr>';

            socialNetworksTable.append( socialNetwork );
            event.preventDefault();
        } );

        $( document ).on( "click", ".inspiry-ere-remove-sn", function ( event ) {
            $( this ).closest( '.inspiry-ere-sn-tr' ).remove();
            event.preventDefault();
        } );

        $( document ).on( "click", ".inspiry-ere-edit-sn", function ( event ) {
            var $this    = $( this ),
                tableRow = $this.closest( '.inspiry-ere-sn-tr' );
            tableRow.find( '.inspiry-ere-sn-field' ).removeClass( 'hide' );
            tableRow.find( '.inspiry-ere-sn-title' ).hide();
            $this.siblings( '.inspiry-ere-update-sn' ).removeClass( 'hide' );
            $this.addClass( 'hide' );
            event.preventDefault();
        } );

        $( document ).on( "click", ".inspiry-ere-update-sn", function ( event ) {
            var $this    = $( this ),
                tableRow = $this.closest( '.inspiry-ere-sn-tr' );
            tableRow.find( '.inspiry-ere-sn-field' ).addClass( 'hide' );
            tableRow.find( '.inspiry-ere-sn-title' ).show().html( tableRow.find( 'input[type="text"]' ).val() );
            $this.siblings( '.inspiry-ere-edit-sn' ).removeClass( 'hide' );
            $this.addClass( 'hide' );
            event.preventDefault();
        } );

        /**
         * Formats the price according to current local.
         *
         * @since 0.9.0
         */
        function ereFormatPrice( price ) {
            var local = $( 'html' ).attr( 'lang' );

            // Check for localized data object to get price number format language tag.
            if ( typeof erePriceNumberFormatData !== "undefined" ) {
                local = erePriceNumberFormatData.local;
            }

            return ( new Intl.NumberFormat( local ).format( price ) );
        }


        /**
         * Adds formatted price preview on price fields in Property MetaBox.
         *
         * @since 0.6.0
         */
        function erePricePreview( element ) {
            var $element = $( element ),
                $price   = $element.val(),
                $parent  = $element.parent( '.rwmb-input' );

            if ( $price ) {
                $price.trim();
            }

            $parent
            .css( 'position', 'relative' )
            .append( '<strong class="ere-price-preview"></strong>' );

            var $preview = $parent.find( '.ere-price-preview' );

            if ( $price ) {
                $price = ereFormatPrice( $price );

                if ( 'NaN' !== $price && '0' !== $price ) {
                    $preview.addClass( 'overlap' ).text( $price );
                }
            }

            $element.on( 'input', function () {
                var price = $( this ).val();

                if ( price ) {
                    price.trim();
                }

                price = ereFormatPrice( price );
                if ( 'NaN' === price || '0' === price ) {
                    $preview.text( '' );
                } else {
                    $preview.text( price );
                }
            } );

            $element.on( 'focus', function () {
                $preview.removeClass( 'overlap' );
            } );

            $element.on( 'blur', function () {
                $preview.addClass( 'overlap' );
            } );

            $preview.on( 'click', function () {
                $element.focus();
            } );
        }

        erePricePreview( '#REAL_HOMES_property_price' );
        erePricePreview( '#REAL_HOMES_property_old_price' );

        /*
         * Managing website map options based on service selection
         */
        let websiteMapOption  = $( '.website-map-options' ),
            currentMapService = $( '.website-map-option:checked' ),
            mapsServiceWrap   = $( '.map-service-wrap' );

        mapsServiceWrap.hide();
        $( '.map-service-wrap' + '.' + currentMapService.val() ).show();

        websiteMapOption.on( 'click', 'input', function () {
            let selectedMapService = $( this ).val();
            mapsServiceWrap.hide();
            $( '.map-service-wrap' + '.' + selectedMapService ).show();
        } );


        /*
        * Valid map coordinates before user can save the maps settings.
        */
        $( '#inspiry_properties_map_default_location, #theme_submit_default_location' ).on( 'focusout', function () {
            let coordinates        = $( this ).val(),
                coordinatesPattern = /^-?\d{1,3}(?:\.\d+)?,\s*-?\d{1,3}(?:\.\d+)?$/;

            if ( coordinatesPattern.test( coordinates ) ) {
                // Valid coordinates
                $( this ).removeClass( 'invalid' ).addClass( 'valid' );
            } else {
                // Invalid coordinates
                $( this ).removeClass( 'valid' ).addClass( 'invalid' );
            }

            if ( $( '#inspiry_properties_map_default_location' ).hasClass( 'invalid' ) || $( '#theme_submit_default_location' ).hasClass( 'invalid' ) ) {
                $( '#submit' ).prop( 'disabled', true );
            } else {
                $( '#submit' ).prop( 'disabled', false );
            }
        } );

        /**
         * Users setting related JS
         * */
        let settingsWrapSection = $( '.main-settings-section' ),
            ereOptionTabs       = $( '.ere-option-tabs' ),
            ereOptionsWrap      = $( '.ere-options-wrap' );

        /* Settings inner section handling */
        settingsWrapSection.on( 'click', 'h3.main-head', function(){
            let thisHeading = $(this),
                thisParent = thisHeading.parent('div');
            if ( thisHeading.hasClass('active') ) {
                settingsWrapSection.children('h3.main-head').removeClass('active');
                settingsWrapSection.children('div').stop( true, true ).removeClass('active').slideUp(500);
            } else {
                settingsWrapSection.children('h3.main-head').removeClass('active');
                thisHeading.addClass('active');
                settingsWrapSection.children('div').slideUp(500);
                thisParent.children('div').stop( true, true ).addClass('active').slideDown(500);
            }
        } );


        /* General function to handle ERE Options Tabs */
        ereOptionTabs.on( 'click', 'label', function (e) {
            let $this = $( this ),
                currentTabIndex = $this.index();

            if ( ! $this.hasClass( 'current' ) ) {
                ereOptionTabs.children( 'label' ).removeClass( 'current' );
                $this.addClass( 'current' );
                ereOptionsWrap.children('div').hide();
                ereOptionsWrap.children('div:nth-child(' + ++currentTabIndex + ')').show();
            }
        } );

        /* Triggering users approval section if user list filter GET variable is in url */
        if ( window.location.href.indexOf("user-list-filter") > -1 ) {
            $( '.user-approval-wrap .main-head' ).click();
        }

        /*
         * User Approve Setting Tabs
         * Using $(document) here to bind click event to newly generated content using ajax as well
         * */

        $(document).on( 'click', '.user-action a', function ( e ) {
            // Preventing default action
            e.preventDefault();

            let $this      = $( this ),
                thisLoader = $this.siblings( '.loader' ),
                userStatus = $this.parent( 'li' ).siblings( '.user-status' );

            // Get user ID and other data as needed
            let userId        = $( this ).data( 'user-id' ),
                currentStatus = $this.data( 'current-status' ),
                newStatus     = $this.data( 'new-status' ),
                currentText   = $this.data( 'current-text' ),
                alterText     = $( this ).data( 'alter-text' );

            // AJAX request to update user meta
            $.ajax( {
                type       : 'POST',
                url        : ajaxurl,
                beforeSend : function () {
                    $this.fadeOut( 200 );
                    thisLoader.fadeIn( 200 );
                },
                data       : {
                    action     : 'update_user_approve_status',
                    user_id    : userId,
                    new_status : newStatus
                },
                success    : function ( response ) {
                    thisLoader.fadeOut( 200, function () {
                        $this.after( '<span class="ere-status-message">' + response + '</span>' );
                    } );

                },
                complete   : function () {
                    setTimeout(
                        function () {
                            $this.text( alterText )
                            .removeClass( 'pending' )
                            .removeClass( newStatus )
                            .addClass( currentStatus )
                            .data( 'current-status', newStatus )
                            .data( 'new-status', currentStatus )
                            .data( 'current-text', alterText )
                            .data( 'alter-text', currentText );

                            userStatus.removeClass( currentStatus ).addClass( newStatus ).text( newStatus );

                            $this.siblings( '.ere-status-message' ).hide( 300, function () {
                                $this.fadeIn( 200 );
                            } );
                        },
                        600
                    );
                }
            } );
        } );


        // Pagination target variable
        let userPaginationWrap = $('.user-pagination');

        /*
         * This block of code is handing ajax request for users listing pagination
         * on the admin side. It will fetch a list based on the selected page number
         * and populate it in the list.
         * */
        userPaginationWrap.on( 'click', '.num', function () {
            let thisPageNum   = $( this ).text(),
                usersList     = $( '#ere-users-approval-users-list' ),
                thisLoader    = $( '.pagination-loader' ),
                pagiParent    = $( this ).parent(),
                currentStatus = pagiParent.data( 'user-status' );

            pagiParent.children('.num').removeClass('current');
            $(this).addClass('current');

            // AJAX request to update user meta
            $.ajax( {
                type       : 'POST',
                url        : ajaxurl,
                beforeSend : function () {
                    usersList.slideUp( 300 );
                    thisLoader.slideDown( 300 );
                },
                data       : {
                    action   : 'update_user_paged_items',
                    page_num : thisPageNum,
                    status   : currentStatus
                },
                success    : function ( response ) {
                    let request = JSON.parse( response );
                    if ( request.success ) {
                        thisLoader.slideUp( 300, function () {
                            usersList.html( request.data );
                            usersList.slideDown( 200 );
                        } );
                    } else {
                        usersList.html( request.message );
                    }
                }
            } );
        } );


    } );
}( jQuery ) );