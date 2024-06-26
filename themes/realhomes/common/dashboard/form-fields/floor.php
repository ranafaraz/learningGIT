<?php
/**
 * Field: Property Floor
 */

$property_floor_label = esc_html__('קומה', 'framework');
?>
<p>
  <label for="floor"><?php echo esc_html($property_floor_label); ?></label>
  <select name="floor" id="floor" class="inspiry_select_picker_trigger show-tick">
    <option selected="selected" value=""><?php esc_html_e('None', 'framework'); ?></option>
    <?php
    if (realhomes_dashboard_edit_property()) {
      global $target_property;
      $selected_floor = get_post_meta($target_property->ID, 'REAL_HOMES_property_floor', true);
      if (isset($selected_floor) && strlen($selected_floor) !== 0) {
        $selected_floor = intval($selected_floor);
      }

      for ($i = -1; $i <= 20; $i++) {
        if ($selected_floor === $i) {
          echo '<option value="' . $selected_floor . '" selected="selected">' . $selected_floor . '</option>';
        } else {
          echo '<option value="' . $i . '">' . $i . '</option>';
        }
      }
    } else {
      for ($i = -1; $i <= 20; $i++) {
        echo '<option value="' . $i . '">' . $i . '</option>';
      }
    }
    ?>
  </select>
</p>