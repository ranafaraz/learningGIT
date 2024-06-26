<?php
/**
 * Layout 2 Template for Taxonomy Widget
 *
 * @since      2.1.2
 */
global $settings;
global $term;

$label = $settings['property_plural_label'];
if ( $term->count <= 1 ) {
	$label = $settings['property_singular_label'];
}
$button_icon = $settings['button_icon'];
?>
<div class="rhea-tax-widget-inner ">
    <div class="rhea-tax-top-box">
		<?php
		if ( 'yes' === $settings['show_property_count'] ) {
			?>
            <span class="rhea-property-taxonomy-property-counter">
		      <span class="rhea-property-taxonomy-property-count"><?php echo esc_html( $term->count ); ?></span>
		      <span class="rhea-property-taxonomy-property-label"><?php echo esc_html( $label ); ?></span>
            </span>
			<?php
		}
		?>
        <span class="rhea-property-taxonomy-term-title">
		<?php
		if ( ! empty( $settings['term_custom_name'] ) ) {
			echo esc_html( $settings['term_custom_name'] );
		} else {
			echo esc_html( $term->name );
		}
		?>
		</span>
    </div>
	<?php
	if ( ! empty( $settings['tax_view_all_label'] ) ) {
		?>
        <div class="rhea-tax-view-all">

            <span class="rhea-view-all"><?php echo esc_html( $settings['tax_view_all_label'] ) ?></span>
			<?php
			if ( is_array( $button_icon ) && ! empty( $button_icon ) ) {
				if ( is_array( $button_icon['value'] ) && ! empty( $button_icon['value']['url'] ) ) {
					?><span class="svg-icon">
					<?php
					\Elementor\Icons_Manager::render_icon( $button_icon, [ 'aria-hidden' => 'true' ] );
					?>
                    </span><?php
				} else {
					?>
                <i class="<?php echo esc_attr( $button_icon['library'] . ' ' . $button_icon['value'] ) ?>"></i><?php
				}
			}
			?>
        </div>
		<?php
	}
	?>
</div>
