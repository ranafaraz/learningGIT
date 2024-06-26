<?php
get_template_part( 'assets/ultra/partials/page-head' );

// Display any contents after the page head and before the contents.
do_action( 'inspiry_before_page_contents' );
?>
<main id="main" class="rh-main main">
	<?php woocommerce_content(); ?>
</main>