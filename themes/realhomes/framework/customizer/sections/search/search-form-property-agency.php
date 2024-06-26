<?php
/**
 * Section: `Search Form Agency`
 * Panel:   `Properties Search`
 *
 * @package realhomes/customizer
 * @since 3.21.0
 */
if ( ! function_exists( 'realhomes_search_form_agency_customizer' ) ) {
    /**
     * Search Form Agency Customizer Settings.
     *
     * @param WP_Customize_Manager $wp_customize - Instance of WP_Customize_Manager.
     *
     * @since 3.21.0
     */
    function realhomes_search_form_agency_customizer( WP_Customize_Manager $wp_customize )
    {

        // Agency Section for Search Form
        $wp_customize->add_section(
            'realhomes_properties_search_form_agency', array(
                'title' => esc_html__( 'Search Form Agencies', 'framework' ),
                'panel' => 'inspiry_properties_search_panel',
            )
        );

        // Multi-select Option for Agency Field
        $wp_customize->add_setting(
            'realhomes_search_form_multiselect_agencies', array(
            'type'              => 'option',
            'default'           => 'yes',
            'sanitize_callback' => 'inspiry_sanitize_radio',
        ) );
        $wp_customize->add_control( 'realhomes_search_form_multiselect_agencies', array(
            'label'   => esc_html__( 'Enable Multi Select For Property Agencies Field? ', 'framework' ),
            'type'    => 'radio',
            'section' => 'realhomes_properties_search_form_agency',
            'choices' => array(
                'yes' => esc_html__( 'Yes', 'framework' ),
                'no'  => esc_html__( 'No', 'framework' ),
            ),
        ) );

        // Agency Label
        $wp_customize->add_setting(
            'realhomes_agency_field_label', array(
            'type'              => 'option',
            'transport'         => 'postMessage',
            'default'           => esc_html__( 'Agency', 'framework' ),
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control(
            'realhomes_agency_field_label', array(
            'label'   => esc_html__( 'Label for Agency', 'framework' ),
            'type'    => 'text',
            'section' => 'realhomes_properties_search_form_agency',
        ) );

        // Agency Field's Placeholder Text
        $wp_customize->add_setting( 'realhomes_property_agency_placeholder', array(
            'type'              => 'option',
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'realhomes_property_agency_placeholder', array(
            'label'   => esc_html__( 'Placeholder for Property Agency', 'framework' ),
            'type'    => 'text',
            'section' => 'realhomes_properties_search_form_agency',
        ) );

        // Agency Field's Counter Placeholder Text
        $wp_customize->add_setting( 'realhomes_property_agency_counter_placeholder', array(
            'type'              => 'option',
            'sanitize_callback' => 'sanitize_text_field',
            'default'           => esc_html__( ' Agencies Selected ', 'framework' ),
        ) );
        $wp_customize->add_control( 'realhomes_property_agency_counter_placeholder', array(
            'label'       => esc_html__( 'Agencies Selected', 'framework' ),
            'description' => esc_html__( 'When selected agencies are greater than 2  ', 'framework' ),
            'type'        => 'text',
            'section'     => 'realhomes_properties_search_form_agency',
        ) );
    }

    add_action( 'customize_register', 'realhomes_search_form_agency_customizer' );
}