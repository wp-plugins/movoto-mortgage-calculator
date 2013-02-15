<div id="movoto_mortgage_shortcode_dialog">  
  <?php
    $background = 0;
    $input_field = 0;
    $button_type = 0;
    $show_link = false;
    require_once $this->plugin_path.'/admin/form.php';
  ?>  
  <div class="mm_buttonbox">
    <a class="button" href="#" id="mm_cancel" onclick="return false;"><?php esc_html_e('Cancel', self::ld); ?></a>
    <input type="submit" value="<?php esc_attr_e('Insert', self::ld); ?>" class="button-primary" id="mm_insert" name="mm_insert">
  </div>
</div>