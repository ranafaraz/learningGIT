<!-- Modal -->
<div id="report-property-modal-<?php echo get_the_ID(); ?>" class="report-property-modal rh-modal" tabindex="-1" aria-hidden="true">
    <div class="rh-modal-dialog">
        <div class="rh-modal-content">
            <button type="button" class="btn-close close" aria-label="Close"><i class="fas fa-times"></i></button>
            <form id="report-property-form" class="report-property-form" method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
				<?php
				$rpm_defaults = realhomes_rpm_default_values();

				$modal_title = get_option( 'realhomes_rpm_title', $rpm_defaults['title'] );
				if ( ! empty( $modal_title ) ) {
					?>
                    <div class="rh-modal-header">
	                    <?php inspiry_safe_include_svg( '/images/report-property-icon.svg', '/common/' ); ?>
                        <div class="rh-modal-headings">
                            <h3 class="rh-modal-title"><?php echo esc_html( $modal_title ); ?></h3>
							<?php
							$modal_sub_title = get_option( 'realhomes_rpm_sub_title', $rpm_defaults['sub_title'] );
							if ( ! empty( $modal_sub_title ) ) {
								?>
                                <h4 class="rh-modal-sub-title"><?php echo esc_html( $modal_sub_title ); ?></h4>
								<?php
							}
							?>
                        </div>
                    </div>
					<?php
				}
				?>

                <div class="rh-modal-body">
                    <div id="report-property-form-main-options" class="checkbox-single">
						<?php
						$validation_message       = esc_html__( 'Please select at least one field.', 'framework' );
						$form_main_options        = get_option( 'realhomes_rpm_form_main_options', $rpm_defaults['main_options'] );
						$form_main_options_format = '<label for="feedback-option-%1$s"><input type="radio" id="feedback-option-%1$s" name="feedback-option" value="%2$s" title="%3$s"><span>%2$s</span></label>';

						if ( ! empty( $form_main_options ) ) {
							$form_main_options = explode( ",", $form_main_options );

							if ( is_array( $form_main_options ) ) {
								foreach ( $form_main_options as $index => $option ) {
									$option = trim( $option );

									if ( ! empty( $option ) ) {
										printf( $form_main_options_format, esc_attr( $index ), esc_html( $option ), esc_html( $validation_message ) );
									}
								}
							}
						}

						$is_parent_item    = ( 'true' === get_option( 'realhomes_rpm_form_parent_item', 'true' ) );
						$parent_item_title = get_option( 'realhomes_rpm_form_parent_item_title', $rpm_defaults['parent_item_title'] );
						if ( $is_parent_item && ! empty( $parent_item_title ) ) {
							printf( $form_main_options_format, 'custom-parent-item', esc_html( $parent_item_title ), esc_html( $validation_message ) );
						}
						?>
                    </div>
					<?php
					if ( $is_parent_item && ! empty( $parent_item_title ) ) {
						?>
                        <div id="report-property-form-child-options" class="hide">
							<?php
							$child_options_title = get_option( 'realhomes_rpm_form_child_options_title', $rpm_defaults['child_options_title'] );
							if ( ! empty( $child_options_title ) ) {
								?>
                                <h3 class="title"><?php echo esc_html( $child_options_title ); ?></h3>
								<?php
							}
							?>
                            <div class="checkbox-multi">
								<?php
								$form_child_options        = get_option( 'realhomes_rpm_form_parent_item_child_options', $rpm_defaults['parent_item_child_options'] );
								$form_child_options_format = '<label for="feedback-child-option-%1$s"><input type="checkbox" id="feedback-child-option-%1$s" name="feedback-child-options[]" value="%2$s" title="%3$s"><span>%2$s</span></label>';

								if ( ! empty( $form_child_options ) ) {
									$form_child_options = explode( ",", $form_child_options );

									if ( is_array( $form_child_options ) ) {
										foreach ( $form_child_options as $index => $option ) {
											$option = trim( $option );

											if ( ! empty( $option ) ) {
												printf( $form_child_options_format, esc_attr( $index ), esc_html( $option ), esc_html( $validation_message ) );
											}
										}
									}
								}

								if ( 'true' === get_option( 'realhomes_rpm_form_custom_child_item', 'true' ) ) {
									$form_child_item_title = get_option( 'realhomes_rpm_form_custom_child_item_title', $rpm_defaults['child_item_title'] );

									if ( ! empty( $form_child_item_title ) ) {
										printf( $form_child_options_format, 'custom-child-item', esc_html( $form_child_item_title ), esc_html( $validation_message ) );
										?>
                                        <textarea id="feedback-custom-message" name="feedback-custom-message" class="hide" placeholder="<?php echo esc_attr( get_option( 'realhomes_rpm_form_textarea_placeholder', $rpm_defaults['textarea_placeholder'] ) ); ?>" title="<?php esc_attr_e( 'Please provide your message', 'framework' ); ?>"></textarea>
										<?php
									}
								}
								?>
                            </div>
                        </div>
						<?php
					}

					$property_id = get_the_ID();
					?>
                    <input type="hidden" name="property_title" value="<?php echo esc_attr( get_the_title( $property_id ) ); ?>"/>
                    <input type="hidden" name="property_permalink" value="<?php echo esc_url_raw( get_permalink( $property_id ) ); ?>"/>
                    <input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'realhomes_report_property_form_nonce' ) ); ?>"/>
                    <input type="hidden" name="target" value="<?php echo antispambot( sanitize_email( get_option( 'realhomes_rpm_form_email', $rpm_defaults['target_email'] ) ) ); ?>">
                    <input type="hidden" name="action" value="report_property_email"/>
                </div>

                <div id="response-container" class="response-container hide">
                    <h2 class="response-title"></h2>
                    <p class="response-text"></p>
                </div>

				<?php
				if ( 'true' === get_option( 'realhomes_rpm_form_user_email', 'false' ) ) {
					$field_type = 'text';
					$user_email = '';
					if ( is_user_logged_in() ) {
						$field_type   = 'hidden';
						$current_user = wp_get_current_user();
						$user_email   = $current_user->user_email;
					}
					?>
                    <input type="<?php echo esc_attr( $field_type ); ?>" name="email" value="<?php echo antispambot( sanitize_email( $user_email ) ); ?>" class="feedback-user-email email required" placeholder="<?php esc_attr_e( 'Your Email', 'framework' ); ?>" title="<?php esc_attr_e( 'Please provide a valid email address', 'framework' ); ?>">
					<?php
				}
				?>

                <div id="error-container" class="error-container"></div>

                <div class="rh-modal-footer">
                    <div class="rh-modal-footer-left">
                        <button type="button" id="btn-back" class="rh-btn-primary hide"><?php esc_html_e( 'Back', 'framework' ); ?></button>
                    </div>
                    <span id="ajax-loader" class="ajax-loader"><?php inspiry_safe_include_svg( '/images/loader.svg' ); ?></span>
                    <div class="rh-modal-footer-right">
						<?php
						$submit_button_label = get_option( 'realhomes_rpm_form_submit_button_label', $rpm_defaults['submit_button_label'] );
						if ( empty( $submit_button_label ) ) {
							$submit_button_label = esc_html( $rpm_defaults['submit_button_label'] );
						}
						?>
                        <button type="submit" id="btn-submit" class=" rh-btn rh-btn-primary"><?php echo esc_html( $submit_button_label ); ?></button>
                        <button type="button" class="rh-btn rh-btn-primary btn-close btn-ok"><?php esc_html_e( 'OK', 'framework' ); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>