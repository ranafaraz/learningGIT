<?php
/**
 * RVR property owner widget for ultra single property
 *
 * @since 2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Property_Owner extends \Elementor\Widget_Base {

	public function get_name() {
		return 'rhea-ultra-single-property-owner';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Single Property Owner', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-person';
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
				'default' => esc_html__( 'Owner', 'realhomes-elementor-addon' ),
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
			'owner_labels',
			[
				'label' => esc_html__( 'Labels', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'owner_text',
			[
				'label'   => esc_html__( 'Owner', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Owner', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'owner_office_contact_label',
			[
				'label'   => esc_html__( 'Office Contact', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Office:', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'owner_office_contact_mobile',
			[
				'label'   => esc_html__( 'Mobile Contact', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Mobile:', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'owner_office_contact_fax',
			[
				'label'   => esc_html__( 'Fax Contact', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Fax:', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'owner_office_contact_whatsapp',
			[
				'label'   => esc_html__( 'WhatsApp Contact', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'WhatsApp:', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'owner_office_contact_email',
			[
				'label'   => esc_html__( 'Email Contact', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Email:', 'realhomes-elementor-addon' ),
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'owner_typo_section',
			[
				'label' => esc_html__( 'Typography', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'owner_typography',
				'label'    => esc_html__( 'Label', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh-ultra-property-owner-label',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'owner_title_typography',
				'label'    => esc_html__( 'Title', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh-ultra-property-owner-title',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'owner_description_typography',
				'label'    => esc_html__( 'Description', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh-ultra-property-owner .rh-ultra-property-owner-description',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'owner_contact_items_typography',
				'label'    => esc_html__( 'Contact Labels', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh-ultra-property-owner-contacts .contact span',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'owner_contact_items_values_typography',
				'label'    => esc_html__( 'Contact Values', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rh-ultra-property-owner-contacts .contact a',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'basic_settings',
			[
				'label' => esc_html__( 'Basic Settings', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'contact-list-margin-bottom',
			[
				'label'     => esc_html__( 'Contacts List Gap', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-property-owner-contacts' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'colors_section',
			[
				'label' => esc_html__( 'Colors', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'owner-label-color',
			[
				'label'     => esc_html__( 'Labels', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-property-owner-label' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'owner-title-color',
			[
				'label'     => esc_html__( 'Title', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-property-owner-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'owner-description-color',
			[
				'label'     => esc_html__( 'Description', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-property-owner-description' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'owner_contact_items_color',
			[
				'label'     => esc_html__( 'Contact Labels', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-property-owner-contacts .contact span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'owner_contact_items_values_color',
			[
				'label'     => esc_html__( 'Contact Values', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-property-owner-contacts .contact a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'owner_contact_items_values_hover_color',
			[
				'label'     => esc_html__( 'Contact Values Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-property-owner-contacts .contact a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$owner_id = 0;
		if ( is_singular( 'property' ) ) {
			$owner_id = intval( get_post_meta( get_the_ID(), 'rvr_property_owner', true ) );
		} else {
			$widget_content_placeholder = get_posts( array(
				'post_type'      => 'owner',
				'posts_per_page' => 1,
			) );

			if ( $widget_content_placeholder ) {
				$owner_id = $widget_content_placeholder[0]->ID;
			}
		}

		if ( ! empty( $owner_id ) ) {
			$owner_label      = $settings['owner_text'];
			$owner_title_text = get_the_title( $owner_id );
			$owner_meta       = get_post_custom( $owner_id );

			$owner_mobile       = ! empty( $owner_meta['rvr_owner_mobile'][0] ) ? $owner_meta['rvr_owner_mobile'][0] : false;
			$owner_whatsapp     = ! empty( $owner_meta['rvr_owner_whatsapp'][0] ) ? $owner_meta['rvr_owner_whatsapp'][0] : false;
			$owner_office_phone = ! empty( $owner_meta['rvr_owner_office_phone'][0] ) ? $owner_meta['rvr_owner_office_phone'][0] : false;
			$owner_fax          = ! empty( $owner_meta['rvr_owner_fax'][0] ) ? $owner_meta['rvr_owner_fax'][0] : false;
			$owner_email        = ! empty( $owner_meta['rvr_owner_email'][0] ) ? $owner_meta['rvr_owner_email'][0] : false;

			$owner_twitter   = ! empty( $owner_meta['rvr_owner_twitter'][0] ) ? $owner_meta['rvr_owner_twitter'][0] : false;
			$owner_facebook  = ! empty( $owner_meta['rvr_owner_facebook'][0] ) ? $owner_meta['rvr_owner_facebook'][0] : false;
			$owner_instagram = ! empty( $owner_meta['rvr_owner_instagram'][0] ) ? $owner_meta['rvr_owner_instagram'][0] : false;
			$owner_linkedin  = ! empty( $owner_meta['rvr_owner_linkedin'][0] ) ? $owner_meta['rvr_owner_linkedin'][0] : false;
			$owner_pinterest = ! empty( $owner_meta['rvr_owner_pinterest'][0] ) ? $owner_meta['rvr_owner_pinterest'][0] : false;
			$owner_youtube   = ! empty( $owner_meta['rvr_owner_youtube'][0] ) ? $owner_meta['rvr_owner_youtube'][0] : false;
			?>
            <section class="rh-ultra-property-owner">
	            <?php
	            if ( ! empty( $settings['section_title'] ) ) {
		            ?>
                    <h4 class="rh_property__heading"><?php echo esc_html( $settings['section_title'] ); ?></h4>
		            <?php
	            }
	            ?>
                <div class="rh-ultra-property-owner-info">
					<?php
					if ( has_post_thumbnail( $owner_id ) ) {
						?>
                        <span class="agent-image">
                            <?php echo get_the_post_thumbnail( $owner_id, 'agent-image' ); ?>
                        </span>
						<?php
					}
					?>
                    <div class="rh-ultra-property-owner-info-inner">
                        <div class="rh-ultra-property-owner-content">
							<?php
							if ( ! empty( $owner_label ) ) {
								?>
                                <span class="rh-ultra-property-owner-label"><?php echo esc_html( $owner_label ) ?></span>
								<?php
							}

							if ( ! empty( $owner_title_text ) ) {
								?>
                                <h3 class="rh-ultra-property-owner-title"><?php echo esc_html( $owner_title_text ); ?></h3>
								<?php
							}

							if ( $owner_twitter || $owner_facebook || $owner_instagram || $owner_linkedin || $owner_pinterest || $owner_youtube ) {
								?>
                                <div class="rh-ultra-property-owner-social">
									<?php
									if ( $owner_twitter ) {
										?>
                                        <a target="_blank" href="<?php echo esc_url( $owner_twitter ); ?>">
                                            <i class="fab fa-twitter"></i>
                                        </a>
										<?php
									}

									if ( $owner_facebook ) {
										?>
                                        <a target="_blank" href="<?php echo esc_url( $owner_facebook ); ?>">
                                            <i class="fab fa-facebook-square"></i>
                                        </a>
										<?php
									}

									if ( $owner_instagram ) {
										?>
                                        <a target="_blank" href="<?php echo esc_url( $owner_instagram ); ?>">
                                            <i class="fab fa-instagram"></i>
                                        </a>
										<?php
									}

									if ( $owner_linkedin ) {
										?>
                                        <a target="_blank" href="<?php echo esc_url( $owner_linkedin ); ?>">
                                            <i class="fab fa-linkedin"></i>
                                        </a>
										<?php
									}

									if ( $owner_pinterest ) {
										?>
                                        <a target="_blank" href="<?php echo esc_url( $owner_pinterest ); ?>">
                                            <i class="fab fa-pinterest-square"></i>
                                        </a>
										<?php
									}

									if ( $owner_youtube ) {
										?>
                                        <a target="_blank" href="<?php echo esc_url( $owner_youtube ); ?>">
                                            <i class="fab fa-youtube"></i>
                                        </a>
										<?php
									}
									?>
                                </div>
								<?php
							}
							?>
                        </div>
                        <div class="rh-ultra-property-owner-contacts">
							<?php
							if ( $owner_office_phone ) {
								?>
                                <p class="contact office">
									<?php
									if ( ! empty( $settings['owner_office_contact_label'] ) ) {
										?>
                                        <span><?php echo esc_html( $settings['owner_office_contact_label'] ); ?></span>
										<?php
									}
									?>
                                    <a href="tel:<?php echo esc_html( $owner_office_phone ); ?>">
										<?php
										inspiry_safe_include_svg( '/ultra/icons/phone.svg', '/assets/' );
										echo esc_html( $owner_office_phone );
										?>
                                    </a>
                                </p>
								<?php
							}

							if ( $owner_mobile ) {
								?>
                                <p class="contact mobile">
									<?php
									if ( ! empty( $settings['owner_office_contact_mobile'] ) ) {
										?>
                                        <span><?php echo esc_html( $settings['owner_office_contact_mobile'] ); ?></span>
										<?php
									}
									?>
                                    <a href="tel:<?php echo esc_html( $owner_mobile ); ?>">
										<?php
										inspiry_safe_include_svg( '/ultra/icons/phone.svg', '/assets/' );
										echo esc_html( $owner_mobile );
										?>
                                    </a>
                                </p>
								<?php
							}

							if ( $owner_fax ) {
								?>
                                <p class="contact fax">
									<?php
									if ( ! empty( $settings['owner_office_contact_fax'] ) ) {
										?>
                                        <span><?php echo esc_html( $settings['owner_office_contact_fax'] ); ?></span>
										<?php
									}
									?>
                                    <a href="fax:<?php echo esc_attr( $owner_fax ); ?>">
										<?php
										inspiry_safe_include_svg( '/ultra/icons/print.svg', '/assets/' );
										echo esc_html( $owner_fax );
										?>
                                    </a>
                                </p>
								<?php
							}

							if ( $owner_whatsapp ) {
								?>
                                <p class="contact whatsapp">
									<?php
									if ( ! empty( $settings['owner_office_contact_whatsapp'] ) ) {
										?>
                                        <span><?php echo esc_html( $settings['owner_office_contact_whatsapp'] ); ?></span>
										<?php
									}
									?>
                                    <a href="https://wa.me/<?php echo esc_attr( $owner_whatsapp ); ?>">
										<?php
										inspiry_safe_include_svg( '/ultra/icons/whatsapp.svg', '/assets/' );
										echo esc_html( $owner_whatsapp );
										?>
                                    </a>
                                </p>
								<?php
							}

							if ( $owner_email ) {
								?>
                                <p class="contact email">
									<?php
									if ( ! empty( $settings['owner_office_contact_email'] ) ) {
										?>
                                        <span><?php echo esc_html( $settings['owner_office_contact_email'] ); ?></span>
										<?php
									}
									?>
                                    <a href="mailto:<?php echo esc_attr( antispambot( $owner_email ) ); ?>">
										<?php
										inspiry_safe_include_svg( '/ultra/icons/email.svg', '/assets/' );
										echo esc_html( antispambot( $owner_email ) );
										?>
                                    </a>
                                </p>
								<?php
							}
							?>
                        </div>
                        <p class="rh-ultra-property-owner-description"><?php echo get_the_content( null, null, $owner_id ); ?></p>
                    </div>
                </div>
            </section>
			<?php
		} else {
			rhea_print_no_result_for_editor();
		}
	}
}