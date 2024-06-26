<?php
/**
 * This file contains the list layout of Ultra properties widget.
 *
 * @version 2.3.0
 */

global $settings, $widget_id, $properties_query, $column_classes, $is_list_view;

$is_list_view = ( isset( $_GET['rhea-properties-view'] ) && 'list' === $_GET['rhea-properties-view'] );
if ( 'list' === $settings['layout'] ) {
	$is_list_view = false;
}
?>
<div id="rhea-ultra-properties-<?php echo esc_attr( $widget_id ); ?>" class="rhea-ultra-properties-container rhea-ultra-properties-list-container">
	<?php rhea_get_template_part( 'elementor/widgets/properties-widget/top-bar' ); ?>
    <div class="rhea-ultra-properties-inner-container rhea-ultra-properties-list-inner-container <?php echo esc_attr( $column_classes ); ?>">
		<?php
		while ( $properties_query->have_posts() ) {
			$properties_query->the_post();

			rhea_get_template_part( 'elementor/widgets/properties-widget/list-card-1' );
		}

		wp_reset_postdata();
		?>
    </div>
    <div class="rhea-ultra-properties-pagination-wrapper">
		<?php
		if ( 'yes' == $settings['show_pagination'] ) {
			?>
            <div class="rhea_svg_loader">
				<?php include RHEA_ASSETS_DIR . '/icons/loading-bars.svg'; ?>
            </div>
			<?php
			$container_class = 'rhea-ultra-properties-pagination';
			if ( 'yes' === $settings['ajax_pagination'] ) {
				$container_class .= ' rhea-ultra-properties-ajax-pagination';
			}

			RHEA_ajax_pagination( $properties_query->max_num_pages, $properties_query, $container_class );
		}
		?>
    </div>
</div><!-- .rhea-properties-container -->