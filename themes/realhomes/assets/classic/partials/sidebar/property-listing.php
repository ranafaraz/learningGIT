<?php
/**
 * Sidebar: Property Listing
 *
 * @package    realhomes
 * @subpackage classic
 */

$attached_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar( 'property-listing-sidebar' );
?>
<div class="span3 sidebar-wrap">
    <aside class="sidebar">
		<?php dynamic_sidebar( $attached_sidebar ); ?>
    </aside>
</div>