<?php
/**
 * Sidebar: Pages
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

$attached_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar( 'default-page-sidebar' );
if ( is_active_sidebar( $attached_sidebar ) ) {
	?>
    <aside class="rh-sidebar sidebar">
		<?php dynamic_sidebar( $attached_sidebar ); ?>
    </aside>
	<?php
}