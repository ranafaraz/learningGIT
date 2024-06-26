<?php
/**
 * Field: Entry Date
 */

$entry_date_label = esc_html__('תאריך כניסה', 'framework');
?>

<p>
  <label for="entry_date"><?php echo esc_html($entry_date_label); ?></label>
  <input id="entry_date" name="entry_date" type="date" value="<?php
  if (realhomes_dashboard_edit_property()) {
    global $post_meta_data;
    if (isset($post_meta_data['REAL_HOMES_property_entry_date'])) {
      echo esc_attr($post_meta_data['REAL_HOMES_property_entry_date'][0]);
    }
  }
  ?>" min="<?php echo date('Y-m-d'); ?>" />
</p>