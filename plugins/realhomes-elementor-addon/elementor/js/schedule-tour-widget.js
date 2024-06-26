/**
 * ES6 Class for Elementor Schedule A Tour Widget
 *
 * @since 2.0.0
 * */

class RHEAScheduleATourWidgetClass extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors : {
                propGallery      : '.sat-slides',
                daysWrap         : '.day-tiles',
                timesWrap        : '.time-tiles',
                dayTarget        : '#sat-date',
                timeTarget       : '#sat-time',
                satFormNav       : '.sat-form-nav',
                gallerySlider    : '.gallery-slides',
                submitButton     : '#rhea-schedule-a-tour',
                ajaxLoader       : '#sat-loader',
                messageContainer : '#message-container',
                errorContainer   : '#error-container'
            }
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings( 'selectors' );
        return {
            $propGallery      : this.$element.find( selectors.propGallery ),
            $daysWrap         : this.$element.find( selectors.daysWrap ),
            $timesWrap        : this.$element.find( selectors.timesWrap ),
            $dayTarget        : this.$element.find( selectors.dayTarget ),
            $timeTarget       : this.$element.find( selectors.timeTarget ),
            $satFormNav       : this.$element.find( selectors.satFormNav ),
            $gallerySlider    : this.$element.find( selectors.gallerySlider ),
            $submitButton     : this.$element.find( selectors.submitButton ),
            $ajaxLoader       : this.$element.find( selectors.ajaxLoader ),
            $messageContainer : this.$element.find( selectors.messageContainer ),
            $errorContainer   : this.$element.find( selectors.errorContainer )
        };
    }

    bindEvents() {
        this.loadScheduleATourRender();
        this.scheduleATourFromProcess();
    }

    loadScheduleATourRender( event ) {
        /**
         * Handling multiple schedule slider related functions
         *
         * @since 2.0.0
         * */

        // Assigning related handlers to the variables
        let propGallery   = this.elements.$propGallery,
            daysWrap      = this.elements.$daysWrap,
            timesWrap     = this.elements.$timesWrap,
            dayTarget     = this.elements.$dayTarget,
            timeTarget    = this.elements.$timeTarget,
            satFormNav    = this.elements.$satFormNav,
            gallerySlider = this.elements.$gallerySlider;

        // If slick js library is available
        if ( jQuery().slick ) {

            // Targeting property detail background gallery
            jQuery( propGallery ).each( function () {

                jQuery( this ).slick( {
                    dots     : false,
                    arrows   : false,
                    infinite : true,
                    speed    : 500,
                    fade     : true,
                    autoplay : true,
                    cssEase  : 'linear'
                } );

            } );

            // Targeting days slider control for schedule form
            jQuery( daysWrap ).each( function () {

                jQuery( this ).slick( {
                    centerMode    : true,
                    centerPadding : '15px',
                    slidesToShow  : 5,
                    speed         : 300,
                    arrows        : false,
                    focusOnSelect : true,
                    responsive    : [
                        {
                            breakpoint : 667,
                            settings   : {
                                arrows        : false,
                                centerMode    : true,
                                centerPadding : '15px',
                                slidesToShow  : 3
                            }
                        },
                        {
                            breakpoint : 400,
                            settings   : {
                                arrows        : true,
                                centerMode    : true,
                                centerPadding : '15px',
                                slidesToShow  : 1
                            }
                        }
                    ]
                } );

                jQuery( this ).on( 'afterChange', function ( slick, slides, current ) {
                    renderSlickTime( slides, current, dayTarget );
                } );
            } );

            // Targeting times slider control for schedule form
            jQuery( timesWrap ).each( function () {

                jQuery( this ).slick( {
                    centerMode    : true,
                    centerPadding : '9px',
                    slidesToShow  : 5,
                    speed         : 300,
                    arrows        : false,
                    focusOnSelect : true,
                    responsive    : [
                        {
                            breakpoint : 667,
                            settings   : {
                                arrows        : false,
                                centerMode    : true,
                                centerPadding : '5px',
                                slidesToShow  : 3
                            }
                        },
                        {
                            breakpoint : 430,
                            settings   : {
                                arrows        : true,
                                centerMode    : true,
                                centerPadding : '5px',
                                slidesToShow  : 1
                            }
                        }
                    ]
                } );

                jQuery( this ).on( 'afterChange', function ( slick, slides, current ) {
                    renderSlickTime( slides, current, timeTarget );
                } );
            } );

            // Targeting custom gallery slider
            jQuery( gallerySlider ).each( function () {
                jQuery( this ).slick( {
                    dots           : true,
                    arrows         : false,
                    infinite       : true,
                    speed          : 300,
                    slidesToShow   : 1,
                    adaptiveHeight : false
                } );
            } );

        }

        // Form nav control for date and form pages
        jQuery( satFormNav ).on( 'click', 'button', function ( e ) {
            e.preventDefault();
            let button   = jQuery( this ),
                slideOld = '.sat-right-two',
                slideNew = '.sat-right-one';

            if ( button.hasClass( 'sat-next' ) ) {
                slideOld = '.sat-right-one';
                slideNew = '.sat-right-two';
            }

            jQuery( slideOld ).fadeOut( 200, function () {
                jQuery( slideNew ).fadeIn( 200 );
            } );
        } );

        // render function to handle Slick Times
        let renderSlickTime = function ( slides, current ) {
            let currentEle = slides.$slides[current],
                timeDetail = jQuery( currentEle ).data( 'time-detail' );
            dayTarget.val( timeDetail );
        }
    }

    scheduleATourFromProcess( event ) {
        /**
         * Handling Schedule A Tour form functionality
         *
         * @since 2.0.0
         * */
        if ( jQuery().validate && jQuery().ajaxSubmit ) {

            let submitButton     = this.elements.$submitButton,
                ajaxLoader       = this.elements.$ajaxLoader,
                messageContainer = this.elements.$messageContainer,
                errorContainer   = this.elements.$errorContainer;

            let satFormOptions = {
                beforeSubmit : function () {
                    submitButton.attr( 'disabled', 'disabled' );
                    ajaxLoader.fadeIn( 'fast' );
                    messageContainer.fadeOut( 'fast' );
                    errorContainer.fadeOut( 'fast' );
                },
                success      : function ( ajax_response, statusText, xhr, $form ) {
                    let response = jQuery.parseJSON( ajax_response );
                    ajaxLoader.fadeOut( 'fast' );
                    submitButton.removeAttr( 'disabled' );
                    if ( response.success ) {
                        $form.resetForm();
                        messageContainer.html( response.message ).fadeIn( 'fast' );

                        setTimeout( function () {
                            messageContainer.fadeOut( 'slow' )
                        }, 5000 );

                        // call reset function if it exists
                        if ( typeof inspiryResetReCAPTCHA == 'function' ) {
                            inspiryResetReCAPTCHA();
                        }
                    } else {
                        errorContainer.html( response.message ).fadeIn( 'fast' );
                    }
                }
            };

            // Contact page form
            submitButton.validate( {
                errorLabelContainer : errorContainer,
                submitHandler       : function ( form ) {
                    jQuery( form ).ajaxSubmit( satFormOptions );
                }
            } );
        }
    }

}

jQuery( window ).on( 'elementor/frontend/init', () => {
    const scheduleATourWidgetHandler = ( $element ) => {
        elementorFrontend.elementsHandler.addHandler( RHEAScheduleATourWidgetClass, {
            $element
        } );
    };

    elementorFrontend.hooks.addAction( 'frontend/element_ready/rhea-schedule-tour-widget.default', scheduleATourWidgetHandler );
} );