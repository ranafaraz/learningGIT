<?php

/**
 * Class Realhomes_Customizer_Notice_Control
 *
 * Custom control to display notice
 *
 * @since 4.3.0
 */
class Realhomes_Customizer_Notice_Control extends WP_Customize_Control {

	// Option type defaults to notice
	public $type = 'notice';

	// custom_class         options: (info,warning,notice)
	public $custom_class = '';

	public function __construct( $manager, $id, $args = array() ) {
		$this->custom_class = isset( $args['custom_class'] ) ? $args['custom_class'] : '';
		parent::__construct( $manager, $id, $args );
	}

	public function render_content() {
		?>
        <div class="customizer-notification-container <?php echo esc_html( $this->custom_class ); ?>">
            <p>
                <strong class="customize-control-title"><?php echo esc_html( $this->label ); ?></strong>
                <span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
            </p>
        </div>
		<?php
	}
}