<div class="rhea_thumb_wrapper rhea_classic_listing_slider loading">
    <div class="gallery-loader">
		<?php include RHEA_ASSETS_DIR . '/icons/loading-bars.svg'; ?>
    </div>
    <ul class="slides">
        <?php
        global $news_grid_size;
            list_gallery_images( $news_grid_size );
        ?>
    </ul>
</div>