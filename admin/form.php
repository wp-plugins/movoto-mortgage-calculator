<div class="movoto_panebox">
  <table>
    <tr>
      <td height="60"><?php _e('Background:', MovotoMortgageCalculator::ld); ?></td>
      <td>
        <span class="colorJ badgeBG<?php echo ($background == 0?' selected':''); ?>"></span>
        <span class="colorA badgeBG<?php echo ($background == 1?' selected':''); ?>"></span>
        <input type="hidden" class="background" name="<?php echo $this->get_field_name('background'); ?>" value="<?php echo (int)$background; ?>" />
      </td>
    </tr>
    <tr>
      <td height="60"><?php _e('Input Field:', MovotoMortgageCalculator::ld); ?></td>
      <td>
        <span class="colorAA badgeBG<?php echo ($input_field == 0?' selected':''); ?>"></span>
        <span class="colorK badgeBG<?php echo ($input_field == 1?' selected':''); ?>"></span>
        <input type="hidden" class="input_field" name="<?php echo $this->get_field_name('input_field'); ?>" value="<?php echo (int)$input_field; ?>" />
      </td>
    </tr>
    <tr>
      <td height="60"><?php _e('Button Type:', MovotoMortgageCalculator::ld); ?></td>
      <td>
        <span class="colorL badgeBG<?php echo ($button_type == 0?' selected':''); ?>"></span>
        <span class="colorM badgeBG<?php echo ($button_type == 1?' selected':''); ?>"></span>
        <span class="colorN badgeBG<?php echo ($button_type == 2?' selected':''); ?>"></span>
        <input type="hidden" class="button_type" name="<?php echo $this->get_field_name('button_type'); ?>" value="<?php echo (int)$button_type; ?>" />
      </td>
    </tr>
  </table>
</div>

<p>
  <input type="checkbox"<?php echo $show_link?' checked':''; ?> class="show_link" name="<?php echo $this->get_field_name('show_link'); ?>" id="<?php echo $this->get_field_id('show_link'); ?>" />
  <label for="<?php echo $this->get_field_id('show_link'); ?>"><?php _e('Show Movoto link at the bottom', MovotoMortgageCalculator::ld); ?></label><br />
</p>