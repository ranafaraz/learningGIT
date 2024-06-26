/**
 * ES6 Class for Agent Contact Form Widget
 *
 * @since 1.0.2
 * */

class RHEAAgentContactFormClass extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors : {
                agentContactForm : '.rhea_acf_form_box',
                SubmitButton: '.rhea_acf_submit',
                messageContainer: '.rhea-message-container',
                errorContainer: '.rhea-error-container',
                ajaxLoader: '.rhea-ajax-loader'
            }
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings( 'selectors' );
        return {
            $thisElement : this.$element,
            $agentContactForm : this.$element.find( selectors.agentContactForm ),
            $formSubmitButton : this.$element.find( selectors.SubmitButton ),
            $messageContainer : this.$element.find( selectors.messageContainer ),
            $errorContainer : this.$element.find( selectors.errorContainer ),
            $ajaxLoader : this.$element.find( selectors.ajaxLoader )
        };
    }

    bindEvents() {
        this.loadContactFormHandler();
    }

    loadContactFormHandler( event ) {

        let contactForm = this.elements.$agentContactForm,
            submitButton = this.elements.$formSubmitButton,
            messageContainer = this.elements.$messageContainer,
            errorContainer = this.elements.$errorContainer,
            ajaxLoader = this.elements.$ajaxLoader;

        if (jQuery().validate && jQuery().ajaxSubmit) {

            let formOptions = {
                beforeSubmit: function () {
                    submitButton.attr('disabled', 'disabled');
                    ajaxLoader.fadeIn('fast');
                    messageContainer.fadeOut('fast');
                    errorContainer.fadeOut('fast');
                },
                success: function (ajax_response, statusText, xhr, $form) {
                    let response = jQuery.parseJSON(ajax_response);
                    ajaxLoader.fadeOut('fast');
                    submitButton.removeAttr('disabled');
                    if (response.success) {
                        $form.resetForm();
                        messageContainer.html(response.message).fadeIn('fast');

                        setTimeout(function () {
                            messageContainer.fadeOut('slow')
                        }, 5000);

                        // call reset function if it exists
                        if (typeof inspiryResetReCAPTCHA == 'function') {
                            inspiryResetReCAPTCHA();
                        }

                        if (typeof CFOSData !== 'undefined') {
                            setTimeout(function () {
                                window.location.replace(CFOSData.redirectPageUrl);
                            }, 1000);
                        }

                        if (typeof contactFromData !== 'undefined') {
                            setTimeout(function () {
                                window.location.replace(contactFromData.redirectPageUrl);
                            }, 1000);
                        }
                    } else {
                        errorContainer.html(response.message).fadeIn('fast');
                    }
                }
            };

            // Agent form trigger
            jQuery(contactForm).validate({
                errorLabelContainer: errorContainer,
                submitHandler: function (form) {
                    jQuery(form).ajaxSubmit(formOptions);
                }
            });
        }
    }
}

jQuery( window ).on( 'elementor/frontend/init', () => {
    const RHEAAgentContactFormHandler = ( $element ) => {
        elementorFrontend.elementsHandler.addHandler( RHEAAgentContactFormClass, {
            $element
        } );
    };

    elementorFrontend.hooks.addAction( 'frontend/element_ready/rhea-agent-contact-form-widget.default', RHEAAgentContactFormHandler );
} );