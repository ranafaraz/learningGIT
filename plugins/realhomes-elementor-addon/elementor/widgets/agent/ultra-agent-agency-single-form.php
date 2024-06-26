<?php
/**
 * Agent/Agency Single Contact Form Widget
 *
 * @since 2.3.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Agent_Agency_Form_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'rhea-ultra-agent-form-widget';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Agent/Agency Contact Form', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	public function get_categories() {
		return [ 'ultra-real-homes' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'basic_settings',
			[
				'label' => esc_html__( 'Basic', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'form_heading',
			[
				'label'   => esc_html__( 'Form Heading', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Contact Me', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'name_field_label',
			[
				'label'   => esc_html__( 'Name Field Label', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Name', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'name_field_placeholder',
			[
				'label'   => esc_html__( 'Name Field Placeholder', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Your Name', 'realhomes-elementor-addon' ),
			]
		);

		$this->add_control(
			'name_field_error_text',
			[
				'label'   => esc_html__( 'Name Field Error Text', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '* Please provide your name', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'phone_field_label',
			[
				'label'   => esc_html__( 'Phone Field Label', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Phone', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'phone_field_placeholder',
			[
				'label'   => esc_html__( 'Phone Field Placeholder', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Your Phone', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'email_field_label',
			[
				'label'   => esc_html__( 'Email Field Label', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Email', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'email_field_placeholder',
			[
				'label'   => esc_html__( 'Email Field Placeholder', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Your Email', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'email_field_error_text',
			[
				'label'   => esc_html__( 'Email Field Error Text', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '* Please provide a valid email address', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'message_field_label',
			[
				'label'   => esc_html__( 'Message Field Label', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Message', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'message_field_placeholder',
			[
				'label'   => esc_html__( 'Message Field Placeholder', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Your Message', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'message_field_error_text',
			[
				'label'   => esc_html__( 'Message Field Error Text', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '* Please provide your message', 'realhomes-elementor-addon' ),
			]
		);
		$this->add_control(
			'button_text',
			[
				'label'   => esc_html__( 'Button Text', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Send Message', 'realhomes-elementor-addon' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'sizes_spaces',
			[
				'label' => esc_html__( 'Sizes & Spaces', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'wrapper_padding',
			[
				'label'      => esc_html__( 'Wrapper Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rh-ultra-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'form-border-radius',
			[
				'label'      => esc_html__( 'Wrapper Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rh-ultra-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'fields-padding',
			[
				'label'      => esc_html__( 'Fields Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rh-ultra-form-field-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'fields-border-radius',
			[
				'label'      => esc_html__( 'Fields Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rh-ultra-form-field-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'button-padding',
			[
				'label'      => esc_html__( 'Button Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .submit-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'button-border-radius',
			[
				'label'      => esc_html__( 'Button Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .submit-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'colors',
			[
				'label' => esc_html__( 'Colors', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'form_heading_color',
			[
				'label'     => esc_html__( 'Heading', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-page-heading' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'form_bg_color',
			[
				'label'     => esc_html__( 'Form Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-form' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'fields_bg_color',
			[
				'label'     => esc_html__( 'Fields Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-form-field-wrapper' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-field'              => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'fields_label_color',
			[
				'label'     => esc_html__( 'Fields Label Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-form-field > label' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'field-placeholder-color',
			[
				'label'     => esc_html__( 'Placeholder Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-form ::-webkit-input-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-form ::-moz-placeholder'          => 'color: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-form :-ms-input-placeholder'      => 'color: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-form :-moz-placeholder'           => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'field-text-color',
			[
				'label'     => esc_html__( 'Field Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-field' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'field-icon-color',
			[
				'label'     => esc_html__( 'Field Icon & Separator', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-form-field-wrapper svg' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-field'                  => 'border-bottom-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'field-icon-color-focused',
			[
				'label'     => esc_html__( 'Field Icon & Separator Focus', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-form-field-wrapper:focus-within svg' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-field:focus'                         => 'border-bottom-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button-bg-color',
			[
				'label'     => esc_html__( 'Button Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .submit-button' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button-bg-border-color',
			[
				'label'     => esc_html__( 'Button Border Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .submit-button' => 'border-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button-bg-hover-color',
			[
				'label'     => esc_html__( 'Button Background Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .submit-button:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button-bg-border-hover-color',
			[
				'label'     => esc_html__( 'Button Border Hover Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .submit-button:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button-text-color',
			[
				'label'     => esc_html__( 'Button Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .submit-button:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button-textr-hover-color',
			[
				'label'     => esc_html__( 'Button Text Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .submit-button:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'fields_box_shadow',
				'label'    => esc_html__( 'Fields Box Shadow', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rh-ultra-form-field-wrapper',
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
				'name'     => 'heading_typography',
				'label'    => esc_html__( 'Heading', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rh-page-heading',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'label_typography',
				'label'    => esc_html__( 'Fields Label', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rh-ultra-form-field > label',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'fields_text_typography',
				'label'    => esc_html__( 'Fields Text', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rh-ultra-field',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'button_text_typography',
				'label'    => esc_html__( 'Button Text', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .submit-button',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$agent_id = get_the_ID();
		if ( rhea_is_preview_mode() ) {
			$agent_id = rhea_get_sample_agent_id();
		}
		$agent_email = get_post_meta( $agent_id, 'REAL_HOMES_agent_email', true );

		if ( inspiry_get_agent_custom_form() ) {
			inspiry_agent_custom_form();
		} else if ( is_email( $agent_email ) ) {
			if ( ! empty( $settings['form_heading'] ) ) {
				?>
                <h3 class="agent-contact-form-heading rh-page-heading"><?php echo esc_html( $settings['form_heading'] ) ?></h3>
				<?php
			}
			?>
            <div class="rh-ultra-form rhea-ultra-agent-form">
                <form id="agent-single-form" class="contact-form agent-contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
                    <div class="rh-ultra-fields-split">
                        <div class="rh-ultra-form-field">
                            <label for="name"><?php echo esc_html( $settings['name_field_label'] ); ?></label>
                            <p class="rh-ultra-form-field-wrapper">
                                <label><?php inspiry_safe_include_svg( '/ultra/icons/user.svg', '/assets/' ); ?></label>
                                <input type="text" name="name" id="name" class="required rh-ultra-field" placeholder="<?php echo esc_attr( $settings['name_field_placeholder'] ) ?>" title="<?php echo esc_attr( $settings['name_field_error_text'] ); ?>">
                            </p>
                        </div>
                        <div class="rh-ultra-form-field">
                            <label for="number"><?php echo esc_html( $settings['phone_field_label'] ); ?></label>
                            <p class="rh-ultra-form-field-wrapper">
                                <label><?php inspiry_safe_include_svg( '/ultra/icons/phone.svg', '/assets/' ); ?></label>
                                <input type="text" name="number" id="number" class="rh-ultra-field" placeholder="<?php echo esc_attr( $settings['phone_field_placeholder'] ) ?>">
                            </p>
                        </div>
                    </div>
                    <div class="rh-ultra-form-field">
                        <label for="email"><?php echo esc_html( $settings['email_field_label'] ); ?></label>
                        <p class="rh-ultra-form-field-wrapper">
                            <label><?php inspiry_safe_include_svg( '/ultra/icons/email.svg', '/assets/' ); ?></label>
                            <input type="text" name="email" id="email" class="email required rh-ultra-field" placeholder="<?php echo esc_attr( $settings['email_field_placeholder'] ); ?>" title="<?php echo esc_attr( $settings['email_field_error_text'] ); ?>">
                        </p>
                    </div>
                    <div class="rh-ultra-form-field">
                        <label for="message"><?php echo esc_html( $settings['message_field_label'] ); ?></label>
                        <p class="rh-ultra-form-field-wrapper rh-ultra-form-textarea">
                            <label><?php inspiry_safe_include_svg( '/ultra/icons/message.svg', '/assets/' ); ?></label>
                            <textarea cols="40" rows="6" name="message" id="message" class="required rh-ultra-field" placeholder="<?php echo esc_attr( $settings['message_field_placeholder'] ); ?>" title="<?php echo esc_attr( $settings['message_field_error_text'] ); ?>"></textarea>
                        </p>
                    </div>
					<?php
					if ( function_exists( 'ere_gdpr_agreement' ) ) {
						ere_gdpr_agreement( array(
							'id'              => 'inspiry-gdpr',
							'container'       => 'p',
							'container_class' => 'rh-inspiry-gdpr',
							'title_class'     => 'gdpr-checkbox-label'
						) );
					}

					if ( class_exists( 'Easy_Real_Estate' ) ) {
						// Display reCAPTCHA if enabled and configured from customizer settings
						if ( ere_is_reCAPTCHA_configured() ) {
							$recaptcha_type = get_option( 'inspiry_reCAPTCHA_type', 'v2' );
							?>
                            <div class="rh_contact__input rh_contact__input_recaptcha inspiry-recaptcha-wrapper g-recaptcha-type-<?php echo esc_attr( $recaptcha_type ); ?>">
                                <div class="inspiry-google-recaptcha"></div>
                            </div>
							<?php
						}
					}
					?>
                    <div class="rh-ultra-submit-wrapper">
                        <input type="hidden" name="action" value="send_message_to_agent" />
                        <input type="hidden" name="agent_id" value="<?php echo esc_attr( $agent_id ); ?>">
                        <input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'agent_message_nonce' ) ); ?>" />
                        <input type="hidden" name="target" value="<?php echo esc_attr( antispambot( $agent_email ) ); ?>">
                        <button type="submit" name="submit" class="submit-button rh-btn rh-btn-primary"><?php echo esc_html( $settings['button_text'] ); ?></button>
                        <span class="ajax-loader rh-ultra-ajax-loader"><?php inspiry_safe_include_svg( '/icons/ball-triangle.svg' ); ?></span>
                    </div>
                    <div id="error-container" class="error-container"></div>
                    <div id="message-container" class="message-container"></div>
                </form>
            </div>
			<?php
		}

	}
}
