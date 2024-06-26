<div class="dashboard-page-head">
    <div class="row">
        <div class="col-sm-6">
			<?php get_template_part( 'common/dashboard/breadcrumbs' ); ?>
        </div>
		<?php
		global $current_module;
		if ( in_array( $current_module, array( 'properties', 'favorites', 'bookings', 'reservations', 'invoices' ) ) ) {
			?>
            <div class="col-sm-6">
				<?php get_template_part( 'common/dashboard/search' ); ?>
            </div>
			<?php
		}
		?>
    </div>
</div>