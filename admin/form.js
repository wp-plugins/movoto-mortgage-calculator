(function($)
{
  var _self = this;

  this.setBackground = function(parent, val)
  {
    if (val == 0)
    {
      $('.colorJ', parent).addClass('selected');
      $('.colorA', parent).removeClass('selected');
    }
    else
    {
      $('.colorJ', parent).removeClass('selected');
      $('.colorA', parent).addClass('selected');      
    }
    
    $('.background', parent).val(val);
  }
  
  this.setInputField = function(parent, val)
  {
    if (val == 0)
    {
      $('.colorAA', parent).addClass('selected');
      $('.colorK', parent).removeClass('selected');
    }
    else
    {
      $('.colorAA', parent).removeClass('selected');
      $('.colorK', parent).addClass('selected');      
    }
    
    $('.input_field', parent).val(val);
  }
  
  this.setButton = function(parent, val)
  {
    $('.colorL, .colorM, .colorN', parent).removeClass('selected');
    if (val == 0)
      $('.colorL', parent).addClass('selected');
    else if (val == 1)
      $('.colorM', parent).addClass('selected');      
    else if (val == 2)
      $('.colorN', parent).addClass('selected');      

    $('.button_type', parent).val(val);
  }
      
  $('.badgeBG').live('click', function()
  {
    var t = $(this);
    var p = t.parent();
    if (t.hasClass('colorJ'))
      _self.setBackground(p, 0);
      
    if (t.hasClass('colorA'))
      _self.setBackground(p, 1);

    if (t.hasClass('colorAA'))
      _self.setInputField(p, 0);
      
    if (t.hasClass('colorK'))
      _self.setInputField(p, 1);
      
    if (t.hasClass('colorL'))
      _self.setButton(p, 0);

    if (t.hasClass('colorM'))
      _self.setButton(p, 1);

    if (t.hasClass('colorN'))
      _self.setButton(p, 2);
  });
  
})(jQuery);