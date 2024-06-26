<?php
// Reponsive Menu.
if ( has_nav_menu( 'responsive-menu' ) ) {
	wp_nav_menu( array(
		'theme_location'  => 'responsive-menu',
		'walker'          => new RH_Walker_Nav_Menu(),
		'menu_class'      => 'rh-menu-responsive clearfix',
		'fallback_cb'     => false, // Do not fall back to wp_page_menu()
		'container_class' => 'rh-ultra-responsive-nav'
	) );
} else {
	// Assign main menu as fallback.
	$locations = get_theme_mod( 'nav_menu_locations' );
	$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
	if ( ! empty( $main_menu ) ) {
		$locations['responsive-menu'] = $main_menu->term_id;
		set_theme_mod( 'nav_menu_locations', $locations );

		if ( has_nav_menu( 'responsive-menu' ) ) {
			wp_nav_menu( array(
				'theme_location' => 'responsive-menu',
				'walker'         => new RH_Walker_Nav_Menu(),
				'menu_class'     => 'rh-menu-responsive clearfix',
				'fallback_cb'    => false // Do not fall back to wp_page_menu()
			) );
		}
	}
}