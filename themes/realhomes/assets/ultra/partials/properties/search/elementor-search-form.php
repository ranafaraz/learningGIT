<?php
$realhomes_custom_search_form = get_option('realhomes_custom_search_form', 'default');
$realhomes_custom_search_form_max_width = get_option('realhomes_custom_search_form_max_width');
$realhomes_custom_search_form_margin_top = get_option('realhomes_custom_search_form_margin_top');
$realhomes_custom_search_form_margin_bottom = get_option('realhomes_custom_search_form_margin_bottom');

$REAL_HOMES_custom_search_form = get_post_meta(get_queried_object_id(), 'REAL_HOMES_custom_search_form', true);
$REAL_HOMES_search_form_margin_top = get_post_meta(get_queried_object_id(), 'REAL_HOMES_search_form_margin_top', true);
$REAL_HOMES_search_form_margin_bottom = get_post_meta(get_queried_object_id(), 'REAL_HOMES_search_form_margin_bottom', true);

if (!empty($realhomes_custom_search_form_max_width)) {
	$max_width = $realhomes_custom_search_form_max_width;
} else {
	$max_width = '1320px';
}

if (!empty($REAL_HOMES_search_form_margin_top)) {
	$margin_top = $REAL_HOMES_search_form_margin_top;
} else if (!empty($realhomes_custom_search_form_margin_top)) {
	$margin_top = $realhomes_custom_search_form_margin_top;
} else {
	$margin_top = 'initial';
}

if (!empty($REAL_HOMES_search_form_margin_bottom)) {
	$margin_bottom = $REAL_HOMES_search_form_margin_bottom;
} else if (!empty($realhomes_custom_search_form_margin_bottom)) {
	$margin_bottom = $realhomes_custom_search_form_margin_bottom;
} else {
	$margin_bottom = 'initial';
}
if ('1' !== get_post_meta(get_queried_object_id(), 'REAL_HOMES_hide_advance_search', true) && inspiry_show_header_search_form()) {
	if (class_exists('RHEA_Elementor_Search_Form') && (!empty($realhomes_custom_search_form) || (!empty($REAL_HOMES_custom_search_form) && 'default' !== $REAL_HOMES_custom_search_form))) {
		// Set search parameters based on url
		$currentPath = $_SERVER['REQUEST_URI'];
		$currentPath = urldecode($currentPath);
		if (str_starts_with($currentPath, '/למכירה-דירות-בחריש/')) {
			$_GET['status'] = ['למכירה'];
		} else if (str_starts_with($currentPath, '/להשכרה-דירות-בחריש/')) {
			$_GET['status'] = ['להשכרה'];
		} else if (str_starts_with($currentPath, '/דירות-בחריש-בשכונת-') && count(explode('/', $currentPath)) >= 2) {
			$mainPart = explode('/', $currentPath)[1];
			$location = preg_replace('/דירות-בחריש-בשכונת-/', '', $mainPart);
			$_GET['location'] = [$location];
		} else {
			$parts = explode('/', $currentPath);
			if (count($parts) >= 2) {
				$mainPart = $parts[1];
				if (str_ends_with($mainPart, '-בחריש')) {
					$type = preg_replace('/-בחריש/', '', $mainPart);
					$_GET['type'] = [$type];
				}
			}
		}

		// Set page title based on search parameters
		$title = null;
		if (
			(isset($_GET['status']) && !empty($_GET['status']) && is_array($_GET['status']) && count($_GET['status']) > 0) ||
			(isset($_GET['location']) && !empty($_GET['location']) && is_array($_GET['location']) && count($_GET['location']) > 0) ||
			(isset($_GET['type']) && !empty($_GET['type']) && is_array($_GET['type']) && count($_GET['type']) > 0)
		) {
			// $title = get_the_title();
			$title = '';

			if (isset($_GET['status']) && !empty($_GET['status']) && is_array($_GET['status']) && count($_GET['status']) > 0) {
				$title = urldecode($_GET['status'][0]) . ' דירות בחריש';
			} else if (isset($_GET['location']) && !empty($_GET['location']) && is_array($_GET['location']) && count($_GET['location']) > 0) {
				$title = 'דירות בחריש בשכונת ' . urldecode($_GET['location'][0]);
			} else if (isset($_GET['type']) && !empty($_GET['type']) && is_array($_GET['type']) && count($_GET['type']) > 0) {
				$title = preg_replace('/-/', ' ', urldecode($_GET['type'][0])) . ' בחריש';
			}

			// Set global variable for other parts of the page
			$GLOBALS['custom_search_title'] = $title;
		}

		if (!empty($title)) {
			?>
			<h1
				style="margin-left: auto !important; margin-right: auto !important; max-width: 1320px; padding-right: 3rem; margin: 0;">
				<?php echo $title; ?>
			</h1>
			<?php
		}

		?>
		<div class="rh-custom-search-form-wrapper rhea-hide-before-load"
			style="margin-top: <?php echo esc_attr($margin_top); ?>;margin-bottom:  <?php echo esc_attr($margin_bottom); ?>;max-width: <?php echo esc_attr($max_width); ?>;">
			<?php
			do_action('realhomes_elementor_search_form');
			?>
		</div>
		<div class="rh-custom-search-form-gutter clearfix"></div>

		<?php
	}
}