/**
 * Custom Elementor Control for Sorting Search Form Fields.
 *
 * This JavaScript file provides functionality for sorting search form fields in Elementor.
 * It extends the BaseData control module to enable sorting of fields using drag-and-drop.
 *
 * @since 2.3.0
 */
window.addEventListener( 'elementor/init', () => {
    const rheaSortingControl = elementor.modules.controls.BaseData.extend( {
        onReady() {
            const control        = this,
                  setting        = control.ui.input,
                  fieldsList     = control.$el.find( '.rhea_sorting_control_wrapper ul' ),
                  checkboxFields = control.$el.find( '.rhea_sorting_control_wrapper ul input[type="checkbox"]' );

            function updateSetting() {
                const checkedFields = control.$el.find( '.rhea_sorting_control_wrapper ul input[type="checkbox"]:checked' ),
                      setValue      = checkedFields.map( function () {
                          return this.value;
                      } ).get().join( ',' );

                setting.val( setValue ).trigger( 'input' );
            }

            checkboxFields.on( 'change', updateSetting );
            fieldsList.sortable( { update : updateSetting } );
        }
    } );

    elementor.addControlView( 'rhea-select-unit-control', rheaSortingControl );
    elementor.addControlView( 'rhea-select-unit-control-modern', rheaSortingControl );
} );