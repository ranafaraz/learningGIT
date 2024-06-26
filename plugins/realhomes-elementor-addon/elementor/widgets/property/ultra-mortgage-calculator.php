<?php
/**
 * Mortgage Calculator Elementor widget for single property
 *
 * @since 2.1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Single_Mortgage_Calculator extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-single-property-mortgage-calculator';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Single Property Mortgage Calculator', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		// More classes for icons can be found at https://pojome.github.io/elementor-icons/
		return 'eicon-number-field';
	}

	public function get_categories() {
		return [ 'ultra-realhomes-single-property' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__( 'Settings', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'section_title',
			[
				'label'   => esc_html__( 'Section Title', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Mortgage Calculator', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'section_title_color',
			[
				'label'     => esc_html__( 'Section Title Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__heading' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'section_title_typography',
				'label'    => esc_html__( 'Section Title Typography', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_property__heading',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'features_colors_section',
			[
				'label' => esc_html__( 'Basic Styles', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'section-border-radius',
			[
				'label'      => esc_html__( 'Section Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rh_property__mc_wrap .rh_property__mc' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'fields-border-radius',
			[
				'label'      => esc_html__( 'Fields Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rh_property__mc_wrap .rh_property__mc .rh-mc-slider-fields' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'dropdown-field-border-radius',
			[
				'label'      => esc_html__( 'Dropdown Field Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rh_property__mc_wrap .rh_property__mc .rh_mc_field button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'cost-section-border-radius',
			[
				'label'      => esc_html__( 'Cost Section Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rh_property__mc_wrap .mc_cost ul li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'section-margin-bottom',
			[
				'label'     => esc_html__( 'Section Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh_property__mc_wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'styles_section',
			[
				'label' => esc_html__( 'Styles', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'bg-color',
			[
				'label'     => esc_html__( 'Section Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__mc_wrap .rh_property__mc' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'calculator-color-one',
			[
				'label'     => esc_html__( 'Principle and Interest Border/Graph', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__mc_wrap .mc_cost ul .mc_cost_interest:before'                                    => 'background: {{VALUE}};',
					'{{WRAPPER}} .rh_property__mc_wrap .rh_property__mc .mc_cost_graph_circle .mc_graph_svg .mc_graph_interest' => 'stroke: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'calculator-color-two',
			[
				'label'     => esc_html__( 'Property Taxes Border/Graph', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__mc_wrap .mc_cost ul .mc_cost_tax:before'                                    => 'background: {{VALUE}};',
					'{{WRAPPER}} .rh_property__mc_wrap .rh_property__mc .mc_cost_graph_circle .mc_graph_svg .mc_graph_tax' => 'stroke: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'calculator-color-three',
			[
				'label'     => esc_html__( 'Additional Fee Border/Graph', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__mc_wrap .mc_cost ul .mc_cost_hoa:before'                                    => 'background: {{VALUE}};',
					'{{WRAPPER}} .rh_property__mc_wrap .rh_property__mc .mc_cost_graph_circle .mc_graph_svg .mc_graph_hoa' => 'stroke: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'calculator-label-color',
			[
				'label'     => esc_html__( 'Labels', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__mc_wrap .rh_property__mc .rh_mc_field label' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'calculator-fields-color',
			[
				'label'     => esc_html__( 'Fields Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__mc_wrap .rh_property__mc .rh_mc_field input[type=text]'                                  => 'color: {{VALUE}};',
					'{{WRAPPER}} .rh_property__mc_wrap .rh_property__mc .rh_mc_field .rh_form__item .bootstrap-select .dropdown-toggle' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bootstrap-select.rh-ultra-select-dropdown .dropdown-menu li a'                                        => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'calculator-dropdown-select-color',
			[
				'label'     => esc_html__( 'Selected Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bootstrap-select.rh-ultra-select-dropdown .dropdown-menu li.selected .text'           => 'color: {{VALUE}};',
					'{{WRAPPER}} .bootstrap-select.rh-ultra-select-dropdown .dropdown-menu li.selected span.check-mark' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'calculator-icon-color',
			[
				'label'     => esc_html__( 'Icon Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-dark'        => 'fill: {{VALUE}};',
					'{{WRAPPER}} .rh-ultra-stroke-dark' => 'stroke: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'calculator-icon-filled-color',
			[
				'label'       => esc_html__( 'Icon Filled Color', 'realhomes-elementor-addon' ),
				'description' => esc_html__( 'For term field only', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::COLOR,
				'selectors'   => [
					'{{WRAPPER}} .rh_property__mc_wrap .rh_property__mc .rh_mc_field .rh_form__item .feather-calendar' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'calculator-terms-value-color',
			[
				'label'     => esc_html__( 'Terms and Interest Value', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mc_term_interest .rh-mc-value'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .mc_term_interest .rh-mc-percent' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'calculator-terms-label-color',
			[
				'label'     => esc_html__( 'Terms and Interest Label', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mc_term_interest .rh-mc-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'calculator-cost-label-color',
			[
				'label'     => esc_html__( 'Cost Label', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__mc_wrap .mc_cost ul li' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'calculator-cost-value-color',
			[
				'label'     => esc_html__( 'Cost Value', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__mc_wrap .mc_cost ul li span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'calculator-graph-label-color',
			[
				'label'     => esc_html__( 'Graph Label', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__mc_wrap .rh_property__mc .mc_cost_graph_circle .mc_cost_over_graph' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'calculator-graph-value-color',
			[
				'label'     => esc_html__( 'Graph Value', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_property__mc_wrap .rh_property__mc .mc_cost_graph_circle .mc_cost_over_graph strong' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'fields_box_shadow',
				'label'    => esc_html__( 'Fields Box Shadow', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rh_property__mc_wrap .rh_property__mc .rh-mc-slider-fields',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'cost_box_shadow',
				'label'    => esc_html__( 'Cost Section Box Shadow', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rh_property__mc_wrap .mc_cost ul li',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'mc-typography',
			[
				'label' => esc_html__( 'Typography', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'mc_fields_label_typography',
				'label'    => esc_html__( 'Fields Label', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_property__mc_wrap .rh_property__mc .rh_mc_field label',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'mc_fields_typography',
				'label'    => esc_html__( 'Text Fields', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_property__mc_wrap .rh_property__mc .rh_mc_field input[type=text]',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'mc_select_label_typography',
				'label'    => esc_html__( 'Select Field', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .bootstrap-select.rh-ultra-select-dropdown > .dropdown-toggle',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'mc_dropdown_label_typography',
				'label'    => esc_html__( 'Select Dropdown', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .bootstrap-select.show-tick .dropdown-menu li a span.text',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'mc_terms_value_typography',
				'label'    => esc_html__( 'Terms/Interest Value', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .mc_term_interest .rh-mc-value,{{WRAPPER}} .mc_term_interest .rh-mc-percent',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'mc_terms_label_typography',
				'label'    => esc_html__( 'Terms/Interest Label', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .mc_term_interest .rh-mc-label',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'mc_cost_label_typography',
				'label'    => esc_html__( 'Costs Label', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_property__mc_wrap .mc_cost ul li',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'mc_cost_value_typography',
				'label'    => esc_html__( 'Costs Value', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_property__mc_wrap .mc_cost ul li span',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'mc_graph_label_typography',
				'label'    => esc_html__( 'Graph Label', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_property__mc_wrap .rh_property__mc .mc_cost_graph_circle .mc_cost_over_graph',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'mc_graph_value_typography',
				'label'    => esc_html__( 'Graph Value', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh_property__mc_wrap .rh_property__mc .mc_cost_graph_circle .mc_cost_over_graph strong',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		$post_id  = get_the_ID();

		// Sample Post id for Elementor editor only
		if ( rhea_is_preview_mode() ) {
			$post_id = rhea_get_sample_property_id();
		}
		$property_rent_status = get_option( 'inspiry_mortgage_calculator_statuses' ); // Get property enabled statuses for the mortgage calculator.
		if ( has_term( $property_rent_status, 'property-status', $post_id ) ) { // Display Mortgage Calculator only if current property has enabled status.
			?>
            <div class="rh_property__mc_wrap margin-bottom-40px">
                <h4 class="rh_property__heading"><?php echo esc_html( $settings['section_title'] ); ?></h4>
                <div class="rh_property__mc clearfix">
					<?php
					// Default data for the mortgage calculator.
					$mc_default['terms']       = array_map( 'intval', explode( ',', get_option( 'inspiry_mc_terms', '30,20,15,10,5' ) ) );
					$mc_default['term']        = intval( get_option( 'inspiry_mc_term_default', '10' ) );
					$mc_default['interest']    = floatval( get_option( 'inspiry_mc_interest_default', '3.5' ) );
					$mc_default['downpayment'] = floatval( get_option( 'inspiry_mc_downpayment_default', '20' ) );
					$mc_default['tax']         = intval( get_post_meta( $post_id, 'inspiry_property_tax', true ) );
					$mc_default['fee']         = intval( get_post_meta( $post_id, 'inspiry_additional_fee', true ) );
					$mc_default['price']       = intval( get_post_meta( $post_id, 'REAL_HOMES_property_price', true ) );

					if ( empty( $mc_default['terms'] ) ) {
						$mc_default['terms'] = array( '30', '20', '15', '10' );
					}

					if ( empty( $mc_default['price'] ) ) {
						$mc_default['price'] = intval( get_option( 'inspiry_mc_price_default', '0' ) );

						if ( '' === $mc_default['price'] ) {
							$mc_default['price'] = '0';
						}
					}

					// Currency conversion in case Currency Switcher is enabled.
					if ( function_exists( 'realhomes_currency_switcher_enabled' ) && realhomes_currency_switcher_enabled() ) {
						$base_currency    = realhomes_get_base_currency();
						$current_currency = realhomes_get_current_currency();

						$mc_default['price_converted'] = realhomes_convert_currency( $mc_default['price'], $base_currency, $current_currency );
						$mc_default['tax_converted']   = realhomes_convert_currency( $mc_default['tax'], $base_currency, $current_currency );
						$mc_default['fee_converted']   = realhomes_convert_currency( $mc_default['fee'], $base_currency, $current_currency );

						$currencies_data   = realhomes_get_currencies_data();
						$currency_sign     = $currencies_data[ $current_currency ]['symbol'];
						$currency_position = $currencies_data[ $current_currency ]['position'];
					} else {
						$mc_default['price_converted'] = $mc_default['price'];
						$mc_default['tax_converted']   = $mc_default['tax'];
						$mc_default['fee_converted']   = $mc_default['fee'];
						$currency_sign                 = ere_get_currency_sign();
						$currency_position             = get_option( 'theme_currency_position', 'before' );
					}

					// Fields labels.
					$term_label        = get_option( 'inspiry_mc_term_field_label', esc_html__( 'Term', 'realhomes-elementor-addon' ) );
					$interest_label    = get_option( 'inspiry_mc_interest_field_label', esc_html__( 'Interest', 'realhomes-elementor-addon' ) );
					$price_label       = get_option( 'inspiry_mc_price_field_label', esc_html__( 'Home Price', 'realhomes-elementor-addon' ) );
					$downpayment_label = get_option( 'inspiry_mc_downpayment_field_label', esc_html__( 'Down Payment', 'realhomes-elementor-addon' ) );
					$principle_label   = get_option( 'inspiry_mc_principle_field_label', esc_html__( 'Principle and Interest', 'realhomes-elementor-addon' ) );
					$cost_prefix       = get_option( 'inspiry_mc_cost_prefix', esc_html__( 'per month', 'realhomes-elementor-addon' ) );
					?>
                    <!-- Calculator left side -->
                    <div class="mc_left_side">

                        <!-- Term -->
                        <div class="rh_mc_field">
                            <label for="mc_term"><?php echo esc_html( $term_label ); ?></label>
                            <div class="rh_form__item">
								<?php inspiry_safe_include_svg( '/ultra/icons/calendar.svg', '/assets/' ); ?>
                                <select id="mc_term" name="mc_term" class="rh-ultra-select-dropdown mc_term inspiry_select_picker_trigger show-tick">
									<?php
									foreach ( $mc_default['terms'] as $mc_term ) {
										echo '<option value="' . esc_attr( $mc_term ) . '" ' . selected( $mc_default['term'], $mc_term, false ) . '>' . esc_html( $mc_term ) . ' ' . esc_html__( 'Years Fixed', 'realhomes-elementor-addon' ) . '</option>';
									}
									?>
                                </select>
                            </div>
                        </div>

                        <!-- Interest Rate -->
                        <div class="rh_mc_field">
                            <label for="mc_interest"><?php echo esc_html( $interest_label ); ?></label>
                            <div class="rh_form__item rh-mc-slider-fields">
								<?php inspiry_safe_include_svg( '/ultra/icons/calculator.svg', '/assets/' ); ?>
                                <input id="mc_interest" class="mc_interset" type="text" value="<?php echo esc_attr( $mc_default['interest'] ); ?>%">
                                <input class="mc_interset_slider" type="range" min="0" max="10" step="0.1" value="<?php echo esc_attr( $mc_default['interest'] ); ?>">
                            </div>
                        </div>

                        <!-- Home Price -->
                        <div class="rh_mc_field">
                            <label for="mc_home_price"><?php echo esc_html( $price_label ); ?></label>
                            <div class="rh_form__item rh-mc-slider-fields">
								<?php inspiry_safe_include_svg( '/ultra/icons/money.svg', '/assets/' ); ?>
                                <input id="mc_home_price" class="mc_home_price" type="text" value="<?php echo esc_html( $mc_default['price_converted'] ); ?>">
								<?php
								$price_slider_max = esc_html( $mc_default['price_converted'] * 3 );
								if ( 200000 > $price_slider_max ) {
									$price_slider_max = 200000;
								}
								?>
                                <input class="mc_home_price_slider" type="range" min="100000" max="<?php echo esc_html( $price_slider_max ); ?>" step="1" value="<?php echo esc_html( $mc_default['price_converted'] ); ?>">
                                <input class="mc_currency_sign" type="hidden" value="<?php echo esc_attr( $currency_sign ); ?>">
                                <input class="mc_sign_position" type="hidden" value="<?php echo esc_attr( $currency_position ); ?>">
                            </div>
                        </div>

                        <!-- Down Payment -->
                        <div class="rh_mc_field">
                            <label for="mc_downpayment"><?php echo esc_html( $downpayment_label ); ?></label>
                            <div class="rh_form__item rh-mc-slider-fields">
								<?php inspiry_safe_include_svg( '/ultra/icons/money.svg', '/assets/' ); ?>
                                <div class="rh-mc-fields-half">
                                    <input id="mc_downpayment" class="mc_downpayment" type="text" value="<?php echo esc_html( ( $mc_default['price_converted'] * $mc_default['downpayment'] ) / 100 ); ?>">
                                    <input class="mc_downpayment_percent" type="text" value="<?php echo esc_html( $mc_default['downpayment'] ); ?>%">
                                </div>
                                <input class="mc_downpayment_slider" type="range" min="0" max="100" step="1" value="<?php echo esc_html( $mc_default['downpayment'] ); ?>">
                            </div>
                        </div>

                    </div><!-- End of the left side -->

					<?php $graph_type = get_option( 'inspiry_mc_graph_type', 'circle' ); ?>
                    <div class="mc_right_side <?php echo 'graph_' . esc_attr( $graph_type ); ?>">
						<?php
						$tax_field_display = get_option( 'inspiry_mc_first_field_display', 'true' );
						$hoa_field_display = get_option( 'inspiry_mc_second_field_display', 'true' );

						if ( 'true' !== $tax_field_display ) {
							$mc_default['tax_converted'] = '0';
							$mc_default['tax']           = '0';
						} else {
							$tax_field_label = get_option( 'inspiry_mc_first_field_title', esc_html__( 'Property Taxes', 'realhomes-elementor-addon' ) );
						}

						if ( 'true' !== $hoa_field_display ) {
							$mc_default['fee_converted'] = '0';
							$mc_default['fee']           = '0';
						} else {
							$hoa_field_label = get_option( 'inspiry_mc_second_field_title', esc_html__( 'Other Dues', 'realhomes-elementor-addon' ) );
						}

						$graph_type = get_option( 'inspiry_mc_graph_type', 'circle' );
						if ( 'circle' === $graph_type ) {
							?>
                            <div class="mc_term_interest">
                                <div class="rh-mc-label-box">
                                    <span class="mc_term_value rh-mc-value"><?php echo esc_html( $mc_default['term'] ); ?></span>
                                    <span class="rh-mc-label">
							<?php esc_html_e( 'Years Fixed', 'realhomes-elementor-addon' ); ?>
                            </span>
                                </div>
                                <div class="rh-mc-label-box">
                                    <span class="mc_interest_value rh-mc-value test"><?php echo esc_attr( $mc_default['interest'] ); ?></span><span class="rh-mc-percent">%</span>
                                    <span class="rh-mc-label">
							<?php echo esc_html( $interest_label ); ?>
                            </span>
                                </div>
                            </div>
                            <div class="mc_cost_graph_circle">
                                <svg class="mc_graph_svg" width="220" height="220" viewPort="0 0 100 100">
                                    <circle r="90" cx="110" cy="110" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0"></circle>
                                    <circle class="mc_graph_hoa" r="90" cx="110" cy="110" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0"></circle>
                                    <circle class="mc_graph_tax" r="90" cx="110" cy="110" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0"></circle>
                                    <circle class="mc_graph_interest" r="90" cx="110" cy="110" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0"></circle>
                                </svg>
                                <div class="mc_cost_over_graph" data-cost-prefix=" <?php echo esc_html( $cost_prefix ); ?>">
									<?php
									// Temporary Text Added for Editor Side only
									if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
										?>
                                        <strong>$9,999</strong><?php esc_html_e( 'per month', 'realhomes-elementor-addon' ); ?><?php
									}
									?>
                                </div>
                            </div>
							<?php
						} else {
							?>
                            <div class="mc_cost_total"><span></span> <?php echo esc_html( $cost_prefix ); ?></div>
                            <div class="mc_term_interest">
                                <span class="mc_term_value"><?php echo esc_html( $mc_default['term'] ); ?></span> <?php esc_html_e( 'Years Fixed', 'realhomes-elementor-addon' ); ?>
                                ,
                                <span class="mc_interest_value"><?php echo esc_attr( $mc_default['interest'] ); ?></span><span>%</span> <?php echo esc_html( $interest_label ); ?>
                            </div>
                            <div class="mc_cost_graph">
                                <ul class="clearfix">
                                    <li class="mc_graph_interest"><span></span></li>
                                    <li class="mc_graph_tax"><span></span></li>
                                    <li class="mc_graph_hoa"><span></span></li>
                                </ul>
                            </div>
							<?php
						}
						?>

                        <div class="mc_cost">
                            <ul>
                                <li class="mc_cost_interest"><?php echo esc_html( $principle_label ); ?> <span></span>
                                </li>
								<?php
								if ( ! empty( $mc_default['tax'] ) ) {
									?>
                                    <li class="mc_cost_tax"><?php echo esc_html( $tax_field_label ); ?>
                                        <span><?php echo esc_html( ere_format_amount( $mc_default['tax'] ) ); ?></span>
                                    </li>
									<?php
								}

								if ( ! empty( $mc_default['fee'] ) ) {
									?>
                                    <li class="mc_cost_hoa"><?php echo esc_html( $hoa_field_label ); ?>
                                        <span><?php echo esc_html( ere_format_amount( $mc_default['fee'] ) ); ?></span>
                                    </li>
									<?php
								}
								?>
                            </ul>
                            <input class="mc_cost_tax_value" type="hidden" value="<?php echo esc_html( $mc_default['tax_converted'] ); ?>">
                            <input class="mc_cost_hoa_value" type="hidden" value="<?php echo esc_html( $mc_default['fee_converted'] ); ?>">
                        </div>

                    </div><!-- End of the right side -->

                </div>
            </div>
			<?php
		} else {
			rhea_print_no_result_for_editor();
		}
		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			?>
            <script type="application/javascript">
                rheaSelectPicker( '.inspiry_select_picker_trigger' );
            </script>
			<?php
		}
	}
}