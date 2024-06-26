<?php

global $settings, $the_widget_id;
global $search_fields_to_display;

$separator_class = '';
if (isset($settings['show_fields_separator']) && 'yes' === $settings['show_fields_separator']) {
  $separator_class = '  rhea-ultra-field-separator  ';
}

$field_key = count($search_fields_to_display);
?>

<div
  class="rhea_prop_search__option rhea_prop_search__select price-for-others rhea_min_floor_field <?php echo esc_attr($separator_class) ?>"
  data-key-position="<?php echo esc_attr($field_key); ?>" style="order: <?php echo esc_attr($field_key); ?>">
  <?php if ($settings['show_labels'] === 'yes') { ?>
    <label class="rhea_fields_labels" for="select-min-floor-<?php echo esc_attr($the_widget_id); ?>">
      <?php echo esc_html__('החל מקומה', 'realhomes-elementor-addon'); ?>
    </label>
    <?php
  }
  ?>
  <span class="rhea_prop_search__selectwrap <?php rhea_add_fields_icon_class('enable_min_price_icon', $settings) ?>">
    <?php rhea_generate_fields_icons('min_price_icon', $settings); ?>
    <select name="min-floor" id="select-min-floor-<?php echo esc_attr($the_widget_id); ?>"
      class="rhea_multi_select_picker show-tick"
      data-size="<?php echo esc_attr($settings['rhea_dropdown_items_in']); ?>">
      <?php rhea_min_floors_list('הכל'); ?>
    </select>
  </span>
</div>
<div
  class="rhea_prop_search__option rhea_prop_search__select price-for-others rhea_max_floor_field <?php echo esc_attr($separator_class) ?>"
  data-key-position="<?php echo esc_attr($field_key); ?>" style="order: <?php echo esc_attr($field_key); ?>">

  <?php if ($settings['show_labels'] === 'yes') { ?>
    <label class="rhea_fields_labels" for="select-max-floor-<?php echo esc_attr($the_widget_id); ?>">
      <?php echo esc_html__('עד קומה', 'realhomes-elementor-addon'); ?>
    </label>
    <?php
  }
  ?>
  <span class="rhea_prop_search__selectwrap <?php rhea_add_fields_icon_class('enable_max_price_icon', $settings) ?>">
    <?php rhea_generate_fields_icons('max_price_icon', $settings); ?>
    <select name="max-floor" id="select-max-floor-<?php echo esc_attr($the_widget_id); ?>"
      class="rhea_multi_select_picker show-tick"
      data-size="<?php echo esc_attr($settings['rhea_dropdown_items_in']); ?>">
      <?php rhea_max_floors_list('הכל'); ?>
    </select>
  </span>
</div>