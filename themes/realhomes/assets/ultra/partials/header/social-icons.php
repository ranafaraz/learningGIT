<?php
if ( function_exists( 'ere_social_networks' ) ) {

	$args = array(
		'container'       => 'div',
		'container_class' => 'rh-ultra-header-social-list',
		'replace_icons'   => array(
			'facebook' => 'fab fa-facebook',
			'linkedin' => 'fab fa-linkedin-in',
			'youtube'  => 'fab fa-youtube',
		),
	);

	ere_social_networks( $args );
}