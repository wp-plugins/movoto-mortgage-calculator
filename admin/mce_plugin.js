(function()
{
  tinymce.create('tinymce.plugins.movoto_mortgage_shortcode_dialog',
  {    
    init: function(ed, url)
    {      
      ed.addCommand('movoto_mortgage_shortcode_dialog', function()
      {
        var win = ed.windowManager.open(
        {
          id: 'movoto_mortgage_shortcode_dialog',
          width: 350,
          height: "auto",
          wpDialog: true,
          title: MovotoMortgageCalculator_data.text.add_shortcode
        },
        {
          plugin_url: url
        });                       
      });    
             
      ed.addButton('movoto_mortgage_button',
      {        
        title: MovotoMortgageCalculator_data.text.add_shortcode,
        image: url + '/images/mce-icon.png',
        cmd: 'movoto_mortgage_shortcode_dialog'
      });
    },
    createControl: function(n, cm)
    {
      return null;
    },
    getInfo: function()
    {      
      return {
        longname: MovotoMortgageCalculator_data.text.long_name,
        author: '',
        authorurl: '',
        infourl: '',
        version: MovotoMortgageCalculator_data.version
      };
    }     
  });
  
  tinymce.PluginManager.add('movoto_mortgage_shortcode_dialog', tinymce.plugins.movoto_mortgage_shortcode_dialog);
})();