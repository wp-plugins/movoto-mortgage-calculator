<?php
$bg = array('#eeeeee', 'White');
$if = array('White', '#e4f3a8');
$bt = array('Green', 'Orange', 'Blue');
?>
<div id="movoCalculatorHolder" style="line-height: normal; height:346px;width:170px;background: url(http://www.movoto.com/images/widget/calcBg.png) no-repeat; color: Black; font-family:Arial; font-size:12px; text-align:left; padding:15px 15px 0px 15px; background-color: <?php echo $bg[$background]; ?>;">
  <div style="border-bottom:1px dashed #B9B9B9;font-size:13px;padding-bottom:3px;font-weight:bold;">
    <a href="http://www.movoto.com/tools/mortgage-calculator" style="color:#000;text-decoration:none;">Mortgage <span style="color:#f26122;">Calculator</span></a>
  </div>
  <iframe style="margin-bottom: 0px;" src="http://www.movoto.com/tools/mortgagecalculatorforiframe?bg=<?php echo urlencode($bg[$background]);?>&ibg=<?php echo urlencode($if[$input_field]); ?>&bt=<?php echo urlencode($bt[$button_type]); ?>&rate30=&rate15=&price=200000&payment=40000" frameborder="0" scrolling="no" height="293" width="170" allowTransparency="true"></iframe>
  <?php
  if ($show_link)
  {
  ?>
  <div style="text-align:center;margin-top:10px;">
    <a href="http://www.movoto.com/"><img src="http://www.movoto.com/images/widget/powerBy.png" alt="Movoto Real Estate" border="0"/></a>
  </div>
  <?php
  }
  ?>
</div>
