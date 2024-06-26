<?php
/**
 * Property Comments Elementor widget for single property
 *
 * @since 2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Ultra_Single_Comments extends \Elementor\Widget_Base {

	public function __construct( array $data = [], array $args = null ) {
		parent::__construct( $data, $args );
		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			add_filter( 'comments_template_query_args', [
				$this,
				'post_id_args_for_comments'
			] );
			add_filter( 'rhea_comment_post_id_for_editor', [
				$this,
				'post_id_for_comment_template'
			] );
		}
	}

	public function get_name() {
		return 'rhea-ultra-single-property-comments';
	}

	public function get_title() {
		return esc_html__( 'Ultra: Single Property Comments', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		// More classes for icons can be found at https://pojome.github.io/elementor-icons/
		return 'eicon-comments';
	}

	public function get_categories() {
		return [ 'ultra-realhomes-single-property' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'basic-styles',
			[
				'label' => esc_html__( 'Basic Styles', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'form-padding',
			[
				'label'      => esc_html__( 'Contact Form Padding', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rh-ultra-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'form-border-radius',
			[
				'label'      => esc_html__( 'Contact Form Border Radius', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
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
				'size_units' => [ 'px' ],
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
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rh-ultra-form-field-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content-margin-bottom',
			[
				'label'     => esc_html__( 'Content Margin Bottom', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-property-comment' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'colors_section',
			[
				'label' => esc_html__( 'Color', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'comment-counter-color',
			[
				'label'     => esc_html__( 'Comment Counter Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh_comments__header h3' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'comment-author-color',
			[
				'label'     => esc_html__( 'Comment Author', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .comment-meta .author a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'comment-author-hover-color',
			[
				'label'     => esc_html__( 'Comment Author Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .comment-meta .author a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'comment-date-color',
			[
				'label'     => esc_html__( 'Comment Date', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .commentlist .comment-meta time' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'comment-date-hover-color',
			[
				'label'     => esc_html__( 'Comment Date Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .commentlist .comment-meta a:hover time' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'comment-body-color',
			[
				'label'     => esc_html__( 'Comment Body', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .comment-body p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'comment-reply-color',
			[
				'label'     => esc_html__( 'Comment Reply', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .comment-reply-link' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'comment-reply-color-hover',
			[
				'label'     => esc_html__( 'Comment Reply Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .comment-reply-link:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'leave-reply-text-color',
			[
				'label'     => esc_html__( 'Leave Reply Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .comment-reply-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'form-bg-color',
			[
				'label'     => esc_html__( 'Form Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-form' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'login-text-color',
			[
				'label'     => esc_html__( 'Login Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .logged-in-as' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'login-text-links-color',
			[
				'label'     => esc_html__( 'Login Text Links', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .logged-in-as a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .required'       => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'login-text-links-hover-color',
			[
				'label'     => esc_html__( 'Login Text Links', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .logged-in-as a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'comments-note-color',
			[
				'label'     => esc_html__( 'Login Text Links', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .comment-notes' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'fields-label-colors',
			[
				'label'     => esc_html__( 'Fields Label Colors', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-form-field > label' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-form-fields-color',
			[
				'label'     => esc_html__( 'Fields Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-field' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-form-placeholder-color',
			[
				'label'     => esc_html__( 'Fields Placeholder', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-form ::-webkit-input-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-form :-ms-input-placeholder'      => 'color: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-form ::placeholder'               => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-form-border-color',
			[
				'label'     => esc_html__( 'Fields Bottom Border', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-field' => 'border-bottom-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-form-border-active-color',
			[
				'label'     => esc_html__( 'Fields Bottom Border Active', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-field:focus' => 'border-bottom-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-form-icons-color',
			[
				'label'     => esc_html__( 'Fields Icon', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-form-field-wrapper .rh-ultra-dark'        => 'fill: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-form-field-wrapper .rh-ultra-stroke-dark' => 'stroke: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-form-icons-active-color',
			[
				'label'     => esc_html__( 'Fields Icon Active', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-form-field-wrapper:focus-within .rh-ultra-dark'        => 'fill: {{VALUE}}',
					'{{WRAPPER}} .rh-ultra-form-field-wrapper:focus-within .rh-ultra-stroke-dark' => 'stroke: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow-fields',
				'label'    => esc_html__( 'Fields Box Shadow', 'realhomes-elementor-addon' ),
				'selector' => '{{WRAPPER}} .rh-ultra-form-field-wrapper',
			]
		);
		$this->add_control(
			'agent-contact-error-color',
			[
				'label'     => esc_html__( 'Error Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-form .error-container label' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-submit-color',
			[
				'label'     => esc_html__( 'Submit Button Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-button' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-submit-hover-color',
			[
				'label'     => esc_html__( 'Submit Button Text Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-button:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-submit-bg-color',
			[
				'label'     => esc_html__( 'Submit Button Background', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-button' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-submit-bg-hover-color',
			[
				'label'     => esc_html__( 'Submit Button Background Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-button:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-submit-border-color',
			[
				'label'     => esc_html__( 'Submit Button Border', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-button' => 'border-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agent-contact-submit-border-hover-color',
			[
				'label'     => esc_html__( 'Submit Button Border Hover', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rh-ultra-button:hover' => 'border-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'comment-consent-text-color',
			[
				'label'     => esc_html__( 'Comment Consent Text', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wp-comment-cookies-consent' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'comment-rating-star-color',
			[
				'label'     => esc_html__( 'Rating Stars', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #comments .fa-star'                             => 'color: {{VALUE}}',
					'{{WRAPPER}} .br-theme-fontawesome-stars .br-widget a:after' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'comment-rating-star-color-hover',
			[
				'label'     => esc_html__( 'Rating Stars Hover/Selected', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .br-theme-fontawesome-stars .br-widget a.br-active:after'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .br-theme-fontawesome-stars .br-widget a.br-selected:after' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
	}

	public function post_id_args_for_comments( $array ) {
		$array['post_id'] = rhea_get_sample_property_id();

		return $array;
	}

	public function post_id_for_comment_template( $post_id ) {
		$post_id = rhea_get_sample_property_id();

		return $post_id;
	}

	protected function render() {
		if ( rhea_is_preview_mode() || comments_open() || get_comments_number() ) {
			?>
            <section class="property-comments rh_property__comments rh-ultra-property-comment margin-bottom-40px">
				<?php
				// Comments Template
				comments_template();
				?>
            </section>
			<?php
		}
	}
}