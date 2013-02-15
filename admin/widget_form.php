<p>
  <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', MovotoMortgageCalculator::ld); ?></label> 
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</p>

<?php require $this->plugin_path.'/admin/form.php'; ?>
