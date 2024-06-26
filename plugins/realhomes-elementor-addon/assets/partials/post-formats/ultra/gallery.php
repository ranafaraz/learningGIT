<?php

/**
 * Gallery post format.
 */
?>
<div class="rhea-ultra-gallry-news rhea-slider-directional-nav rhea-transition-200ms">
	<div class="rhea-ultra-listing-slider rhea-listing-news-slider rhea-list-no-padding-margin">
		<ul class="slides">
			<?php
			global $news_grid_size;
			rhea_list_gallery_images($news_grid_size);
			?>
		</ul>
	</div>
	<div class="rhea-ultra-slide-nav rhea-news-directional-nav">
		<a href="#" class="flex-prev rhea-ultra-diretional-buttons rhea-transition-200ms">
			<i class='fas fa-caret-left'></i>
		</a>
		<a href="#" class="flex-next rhea-ultra-diretional-buttons rhea-transition-200ms">
			<i class='fas fa-caret-right'></i>
		</a>
	</div>
</div>