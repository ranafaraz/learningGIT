<?php
/**
 * Property RVR Price Details
 *
 * @since 2.2.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Single_Price_Details extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-pdp-price-details';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Price Details', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-price-list';
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
				'default' => esc_html__( 'Price Details', 'realhomes-elementor-addon' ),
			]
		);


		$this->add_control(
			'bulk_prices_title',
			[
				'label'   => esc_html__( 'Bulk Prices Title', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Bulk Prices', 'realhomes-elementor-addon' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'typography_section',
			[
				'label' => esc_html__( 'Typography', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'prices_title_typography',
				'label'    => esc_html__( 'Prices Title Typography', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rvr_price_details_wrap .rh_property__heading',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'bulk_prices_title_typography',
				'label'    => esc_html__( 'Bulk Prices Title Typography', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rvr_price_details_wrap .rvr_price_details ul li.bulk-pricing-heading',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'price_details_colors_section',
			[
				'label' => esc_html__( 'Basic Styles', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
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

		$this->add_control(
			'bulk_price_title_color',
			[
				'label'     => esc_html__( 'Bulk Price Title Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rvr_price_details_wrap .rvr_price_details ul li.bulk-pricing-heading' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'price_details_list_color',
			[
				'label'     => esc_html__( 'Price Detail List Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rvr_price_details_wrap .rvr_price_details ul li strong' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'price_details_sub_statement_color',
			[
				'label'     => esc_html__( 'Price Detail Sub Statement Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rvr_price_details_wrap .rvr_price_details ul li i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'price_details_value_color',
			[
				'label'     => esc_html__( 'Price Detail Value Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rvr_price_details_wrap .rvr_price_details ul li' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'list-item-size',
			[
				'label'      => esc_html__( 'List Item Size', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rvr_price_details_wrap .rvr_price_details ul li' => 'flex-basis: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'section-padding',
			[
				'label'      => esc_html__( 'Section Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rvr_price_details_wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'section-margins',
			[
				'label'      => esc_html__( 'Section Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rvr_price_details_wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'price-detail-li-margin',
			[
				'label'      => esc_html__( 'Price List Item Margin', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rvr_price_details_wrap .rvr_price_details ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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

		$bulk_prices       = get_post_meta( $post_id, 'rvr_bulk_pricing', true );
		$service_charges   = get_post_meta( $post_id, 'rvr_service_charges', true );
		$govt_tax          = get_post_meta( $post_id, 'rvr_govt_tax', true );
		$additional_fees   = get_post_meta( $post_id, 'rvr_additional_fees', true );
		$extra_guest_price = get_post_meta( $post_id, 'rvr_extra_guest_price', true );
		$all_prices        = [ $bulk_prices, $service_charges, $govt_tax, $additional_fees, $extra_guest_price ];
		$sections_enable   = array_filter( $all_prices ); // check if any of the top section is available so that we can display the wrapper

		if ( ! empty( $sections_enable ) ) {
			?>
            <div class="rvr_price_details_wrap <?php realhomes_printable_section( 'rvr/price-details' ); ?>">
                <h4 class="rh_property__heading"><?php echo esc_html( $settings['section_title'] ); ?></h4>
                <div class="rvr_price_details">
                    <ul>
						<?php
						if ( ! empty( $additional_fees ) && is_array( $additional_fees ) ) {
							foreach ( $additional_fees as $additional_fee ) {
								if ( ! empty( $additional_fee['rvr_fee_label'] ) && ! empty( $additional_fee['rvr_fee_amount'] ) ) {

									if ( 'fixed' === $additional_fee['rvr_fee_type'] ) {
										$fee_amount = ere_format_amount( $additional_fee['rvr_fee_amount'] );
									} else {
										$fee_amount = intval( $additional_fee['rvr_fee_amount'] ) . '%';
									}

									switch ( $additional_fee['rvr_fee_calculation'] ) {
										case 'per_night':
											$fee_info_label = esc_html__( 'per night', 'realhomes-elementor-addon' );
											break;
										case 'per_guest':
											$fee_info_label = esc_html__( 'per guest', 'realhomes-elementor-addon' );
											break;
										case 'per_night_guest':
											$fee_info_label = esc_html__( 'per night per guest', 'realhomes-elementor-addon' );
											break;
										case 'per_stay':
											$fee_info_label = esc_html__( 'per stay', 'realhomes-elementor-addon' );
											break;
										default:
											$fee_info_label = '';
									}

									$fee_info = '(' . $fee_info_label . ')';
									?>
                                    <li><strong><?php echo esc_html( $additional_fee['rvr_fee_label'] ); ?>
                                            :</strong><span><?php echo ( ! empty( $fee_info ) ) ? '<i>' . esc_html( $fee_info ) . '</i>' : ''; ?></span><?php echo esc_html( $fee_amount ); ?>
                                    </li>
									<?php
								}
							}
						}

						if ( ! empty( $extra_guest_price ) ) {
							?>
                            <li><strong><?php esc_html_e( 'Extra Guest Price', 'realhomes-elementor-addon' ); ?>
                                    :</strong><span><i><?php esc_html_e( '(per night)', 'realhomes-elementor-addon' ); ?></i></span><?php echo ere_format_amount( $extra_guest_price ); ?>
                            </li>
							<?php
						}

						if ( ! empty( $service_charges ) ) {
							?>
                            <li><strong><?php esc_html_e( 'Service Charges', 'realhomes-elementor-addon' ); ?>:</strong><span><i><?php esc_html_e( '(per stay)', 'realhomes-elementor-addon' ); ?></i></span><?php echo intval( $service_charges ) . '%'; ?>
                            </li>
							<?php
						}
						if ( ! empty( $govt_tax ) ) {
							?>
                            <li><strong><?php esc_html_e( 'Govt Tax', 'realhomes-elementor-addon' ); ?>
                                    :</strong><span><i><?php esc_html_e( '(per stay)', 'realhomes-elementor-addon' ); ?></i></span><?php echo intval( $govt_tax ) . '%'; ?>
                            </li>
							<?php
						}

						if ( ! empty( $bulk_prices ) ) {
							?>
                            <li class="bulk-pricing-heading"><?php echo esc_html( $settings['bulk_prices_title'] ); ?></li>
							<?php
							foreach ( $bulk_prices as $bulk_price ) {
								if ( ! empty( $bulk_price['number_of_nights'] ) && ! empty( $bulk_price['price_per_night'] ) ) {
									?>
                                    <li>
                                        <strong><?php echo sprintf( esc_html__( 'Price per night (%sdays+)', 'realhomes-elementor-addon' ), $bulk_price['number_of_nights'] ); ?>
                                            :</strong><?php echo ere_format_amount( $bulk_price['price_per_night'] ); ?>
                                    </li>
									<?php
								}
							}
						}
						?>
                    </ul>
                </div>
            </div>
			<?php
		} else {
			rhea_print_no_result_for_editor();
		}

	}
}
