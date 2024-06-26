( function ( $ ) {
    let RHSidebar = function () {
        this.widget_wrap = $( '.widget-liquid-right' );
        this.widget_area = $( '#widgets-right' );
        this.widget_add  = $( '#rh-add-sidebar-form-script' );

        this.create_form();
        this.add_delete_button();
        this.bind_events();
    };

    RHSidebar.prototype =
        {
            create_form       : function () {
                this.widget_wrap.append( this.widget_add.html() );
                this.widget_name = this.widget_wrap.find( 'input[name="rh-add-sidebar"]' );
                this.nonce       = this.widget_wrap.find( 'input[name="realhomes-delete-custom-sidebar-nonce"]' ).val();
            },
            add_delete_button : function () {
                this.widget_area.find( '.sidebar-rh-custom' )
                .append( '<span class="rh-custom-sidebar-area-delete dashicons dashicons-no-alt"></span>' );
            },
            bind_events       : function () {
                this.widget_wrap.on( 'click', '.rh-custom-sidebar-area-delete', this.delete_sidebar.bind( this ) );
            },
            delete_sidebar    : function ( event ) {

                let sidebar        = $( event.currentTarget ).parents( '.widgets-holder-wrap' ).eq( 0 ),
                    heading        = sidebar.find( '.sidebar-name h3 , .sidebar-name h2' ),
                    delete_sidebar = confirm( customSidebar.deleteAlert.replace( '{sidebar_name}', '"' + heading.text().trim() + '"' ) );

                if ( delete_sidebar === false ) {
                    return false;
                }

                let loader       = heading.find( '.loader' ),
                    sidebar_name = heading.text().trim(),
                    object       = this;

                $.ajax( {
                    type       : 'POST',
                    url        : ajaxurl,
                    data       : {
                        action   : 'rh_ajax_delete_custom_sidebar',
                        name     : sidebar_name,
                        _wpnonce : object.nonce
                    },
                    beforeSend : function () {
                        loader.addClass( 'spin_loader' );
                    },
                    success    : function ( response ) {
                        if ( response === 'sidebar-deleted' ) {
                            sidebar.slideUp( 200, function () {
                                $( '.widget-control-remove', sidebar ).trigger( 'click' ); // Delete all dropped widgets for deleted sidebar.
                                sidebar.remove();
                            } );
                        }
                    }
                } );
            }
        };

    $( function () {
        new RHSidebar();
    } );


} )( jQuery );