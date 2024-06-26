<?php
global $settings, $the_widget_id;


	?>
	<div class="rhea_search_button_wrapper rhea_buttons_top">
		<?php
        if ( 'yes' == $settings['show_advance_fields'] ) {
	        $open_class = '';
            if('open' === $settings['rhea_default_advance_state'] ){
                $open_class = 'rhea_advance_open';
            }
            ?>
            <div class="rhea_advanced_expander <?php echo esc_attr($open_class)?>"
                 id="advance_button_<?php echo esc_attr( $the_widget_id ); ?>">
                <span class="search-ultra-plus"><?php include RHEA_ASSETS_DIR . '/icons/ultra-search-icon.svg'; ?></span>
                <span>
                    <?php
                    if ( ! empty( $settings['advance_search_button_label'] ) ) {
	                    echo esc_html( $settings['advance_search_button_label'] );
                    } else {
	                    esc_html_e( 'Advance Search', 'realhomes-elementor-addon' );
                    }
                    ?>
                </span>

            </div>
			<?php
		}


		?>
		<button class="rhea_search_form_button" type="submit">
			<span>
                <?php
                $inspiry_search_button_text = $settings['search_button_label'];
                if ( ! empty( $inspiry_search_button_text ) ) {
	                echo esc_html( $inspiry_search_button_text );
                } else {
	                echo esc_html__( 'Search', 'realhomes-elementor-addon' );
                }
                ?>
                    </span>
		</button>
	</div>


