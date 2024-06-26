<?php
/**
 * Sidebar
 *
 * @package    realhomes
 * @subpackage classic
 */

$attached_sidebar = RealHomes_Custom_Sidebar::get_attached_sidebar();
if ( is_active_sidebar( $attached_sidebar ) )  : ?>
    <div class="span4 sidebar-wrap">
        <aside class="sidebar">
			<?php dynamic_sidebar( $attached_sidebar ); ?>
        </aside>
    </div>
<?php endif; ?>