<?php
/**
 * Single agency sidebar.
 *
 * @package realhomes
 * @subpackage modern
 * @since 3.5.0
 */

$attached_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar( 'agency-sidebar' );
if ( is_active_sidebar( $attached_sidebar ) ) {
	?>
    <aside class="rh_sidebar">
		<?php dynamic_sidebar( $attached_sidebar ); ?>
    </aside>
	<?php
}