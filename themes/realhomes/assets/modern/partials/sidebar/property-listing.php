<?php
/**
 * Sidebar: Property Listing
 *
 * @package    realhomes
 * @subpackage modern
 */

$attached_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar( 'property-listing-sidebar' );
?>
<aside class="rh_sidebar">
	<?php dynamic_sidebar( $attached_sidebar ); ?>
</aside>