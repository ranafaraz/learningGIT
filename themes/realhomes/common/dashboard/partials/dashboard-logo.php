<?php
$logo_path        = get_option( 'realhomes_frontend_dashboard_logo' );
$retina_logo_path = get_option( 'realhomes_frontend_dashboard_logo_retina' );

// Dashboard Logo Link Behaviour
$dashboard_page_URL  = realhomes_get_dashboard_page_url();
$dashboard_logo_link = get_option( 'realhomes_dashboard_logo_link', 'dashboard' );
if ( 'homepage' === $dashboard_logo_link ) {
	$dashboard_page_URL = get_bloginfo( 'url' );
}

if ( ! empty( $logo_path ) || ! empty( $retina_logo_path ) ) {
	?>
    <div class="rh-logo">
        <a title="<?php bloginfo( 'name' ); ?>" href="<?php echo esc_url( $dashboard_page_URL ); ?>">
			<?php inspiry_logo_img( $logo_path, $retina_logo_path ); ?>
        </a>
    </div><!-- .rh-logo -->
	<?php
} else {
	?>
    <div class="rh-logo">
        <h2 class="rh-site-title">
            <a href="<?php echo esc_url( $dashboard_page_URL ); ?>"><?php bloginfo( 'name' ); ?></a>
        </h2>
    </div><!-- .rh-logo -->
	<?php
}