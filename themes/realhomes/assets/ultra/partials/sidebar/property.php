<?php
/**
 * Property sidebar
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

$attached_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar( 'property-sidebar' );
if ( is_active_sidebar( $attached_sidebar ) ) {
	?>
    <aside class="rh-property-sidebar rh-sidebar sidebar">
		<?php dynamic_sidebar( $attached_sidebar ); ?>
    </aside>
	<?php
}