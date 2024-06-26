<?php
if ( 'true' === get_option( 'realhomes_show_partners', 'true' ) ) {

	$number_of_partners = get_option( 'realhomes_number_of_partners', '20' );
	$partners_args      = array(
		'post_type'      => 'partners',
		'posts_per_page' => ! empty( $number_of_partners ) ? intval( $number_of_partners ) : 5,
	);

	$partners_query = new WP_Query( $partners_args );
	if ( $partners_query->have_posts() ) {
		?>
        <section class="rh-partners">
			<?php
			$partners_section_title = get_option( 'realhomes_partners_section_title', esc_html__( 'Partners of RealHomes', 'framework' ) );
			$partners_section_desc  = get_option( 'realhomes_partners_section_desc', esc_html__( 'We are pleased to work with our partners', 'framework' ) );

			if ( ! empty( $partners_section_title ) || ! empty( $partners_section_desc ) ) {
				?>
                <div class="rh-partners-section-head">
					<?php
					if ( ! empty( $partners_section_title ) ) {
						?>
                        <h2 class="rh-partners-section-title"><?php echo esc_html( $partners_section_title ); ?></h2>
						<?php
					}
					if ( ! empty( $partners_section_desc ) ) {
						?>
                        <p class="rh-partners-section-desc"><?php echo esc_html( $partners_section_desc ); ?></p>
						<?php
					}
					?>
                </div>
				<?php
			}
			?>
            <div class="rh-partners-items">
				<?php
				while ( $partners_query->have_posts() ) {
					$partners_query->the_post();
					$partner_id              = get_the_ID();
					$partner_url             = get_post_meta( $partner_id, 'REAL_HOMES_partner_url', true );
					$partners_item_attribute = the_title_attribute( array( 'echo' => false ) );
					?>
                    <a class="rh-partners-item" target="_blank" href="<?php echo esc_url( $partner_url ); ?>" title="<?php echo $partners_item_attribute; ?>">
						<?php the_post_thumbnail( 'partners-logo', array(
							'alt'   => $partners_item_attribute,
							'title' => $partners_item_attribute,
						) ); ?>
                    </a>
					<?php
				}
				wp_reset_postdata();
				?>
            </div>
        </section><!-- .rh-partners -->
		<?php
	}
}