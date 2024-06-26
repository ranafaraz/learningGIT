<?php
$logo_path        = get_option( 'theme_sitelogo' );
$retina_logo_path = get_option( 'theme_sitelogo_retina' );
if ( ! empty( $logo_path ) || ! empty( $retina_logo_path ) ) {
	?>
    <div class="rh-ultra-logo">
        <a title="<?php bloginfo( 'name' ); ?>" href="<?php echo esc_url( home_url() ); ?>">
			<?php inspiry_logo_img( $logo_path, $retina_logo_path ); ?>
        </a>
    </div>
	<?php
} else {
	?>
    <div class="rh-logo-heading-wrap">
        <h2 class="rh-logo-heading">
            <a href="<?php echo esc_url( home_url() ); ?>" title="<?php bloginfo( 'name' ); ?>">
				<?php bloginfo( 'name' ); ?>
            </a>
        </h2>
        <p class="rh-site-description only-for-print">
			<?php bloginfo( 'description' ); ?>
        </p><!-- /.only-for-print -->
    </div>
	<?php
}
