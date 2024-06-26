<?php
/**
 * Blog sidebar.
 *
 * @package realhomes
 * @subpackage modern
 */

$attached_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar();
if ( is_active_sidebar( $attached_sidebar ) ) {
	?>
    <aside class="rh_sidebar">
		<?php dynamic_sidebar( $attached_sidebar ); ?>
    </aside>
	<?php
}