<?php
/**
 * Sidebar
 *
 * @package    realhomes
 * @subpackage classic
 */

if ( isset( $args['sidebar'] ) ) {
	$sidebar_container_classes = 'sidebar-wrap';
	if ( isset( $args['sidebar_container_classes'] ) ) {
		$sidebar_container_classes .= ' ' . $args['sidebar_container_classes'];
	}

	$sidebar_classes = 'sidebar';
	if ( isset( $args['sidebar_classes'] ) ) {
		$sidebar_classes .= ' ' . $args['sidebar_classes'];
	}
	?>
    <div class="<?php echo esc_attr( $sidebar_container_classes ); ?> ">
        <aside class="<?php echo esc_attr( $sidebar_classes ); ?>">
			<?php dynamic_sidebar( esc_html( $args['sidebar'] ) ); ?>
        </aside><!-- .sidebar -->
    </div><!-- .sidebar-wrap -->
	<?php
}