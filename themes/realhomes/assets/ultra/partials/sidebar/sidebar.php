<?php
/**
 * Sidebar.
 *
 * @since      4.2.0
 * @package    realhomes
 * @subpackage ultra
 */

if ( isset( $args['sidebar'] ) ) {
	$sidebar_container_classes = 'col-4 sidebar-content';
	if ( isset( $args['sidebar_container_classes'] ) ) {
		$sidebar_container_classes .= ' ' . $args['sidebar_container_classes'];
	}

	$sidebar_classes = 'rh-sidebar sidebar';
	if ( isset( $args['sidebar_classes'] ) ) {
		$sidebar_classes .= ' ' . $args['sidebar_classes'];
	}
	?>
    <div class="<?php echo esc_attr( $sidebar_container_classes ); ?> ">
        <aside class="<?php echo esc_attr( $sidebar_classes ); ?>">
			<?php dynamic_sidebar( esc_html( $args['sidebar'] ) ); ?>
        </aside>
    </div>
	<?php
}