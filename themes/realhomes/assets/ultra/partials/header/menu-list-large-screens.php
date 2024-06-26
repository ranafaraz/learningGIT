<?php
// Main Menu.
if ( has_nav_menu( 'main-menu' ) ) :
	wp_nav_menu( array(
		'theme_location'  => 'main-menu',
		'walker'          => new RH_Walker_Nav_Menu(),
		'menu_class'      => 'rh-ultra-main-menu clearfix',
		'container'       => 'div',
		'container_class' => 'menu-main-menu-container rh-ultra-nav-menu',
		'fallback_cb'    => false // Do not fall back to wp_page_menu()
	) );
endif;