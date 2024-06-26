<?php
/**
 * Default Template for Taxonomy Widget
 *
 * @since      2.1.2
 */
global $settings;
global $term;

$label = $settings['property_plural_label'];
if ( $term->count <= 1 ) {
	$label = $settings['property_singular_label'];
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
