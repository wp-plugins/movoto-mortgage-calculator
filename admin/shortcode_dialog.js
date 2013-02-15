(function($)
{  
  var Movoto_Mortgage_Dialog = {    
    init: function()
    {
      var t = this;
      this.dialog = $('#movoto_mortgage_shortcode_dialog');
      this.cancel = $('#mm_cancel');
      this.insert = $('#mm_insert');            
                        
      QTags.addButton('movoto_mortgage_button', MovotoMortgageCalculator_data.text.button_title, function() { t.open(); });
      this.insert.bind('click', function() { t.update(); });
      this.cancel.bind('click', function() { t.close(); });
    },
    isMCE: function()
    {
      return tinyMCEPopup && ( ed = tinyMCEPopup.editor ) && ! ed.isHidden();
    },        
    open: function()
    {      
      if (!wpActiveEditor) return;
      this.textarea = $('#'+wpActiveEditor).get(0);
      
      if (!this.dialog.data('wpdialog'))
      {
        this.dialog.wpdialog(
        {
          title: MovotoMortgageCalculator_data.text.add_shortcode,
          width: 350,
          height: 'auto',
          modal: true,
          dialogClass: 'wp-dialog',
          zIndex: 300000
        });        
      }

      this.dialog.wpdialog('open');
    },    
    close: function()
    {
      if (this.isMCE())
      {
        tinyMCEPopup.editor.focus();
        tinyMCEPopup.close();
      }
      else
      {        
        this.dialog.wpdialog('close');
        this.textarea.focus();
      }           
    },
    genHTML: function()
    {
      var html = '[movotomortgage';
      html+= ' background=' + $('.background', this.dialog).val();
      html+= ' input=' + $('.input_field', this.dialog).val();
      html+= ' button=' + $('.button_type', this.dialog).val();
      html+= ' link=' + ($('.show_link', this.dialog).attr('checked')?'1':'0');
      html+= ']';

      return html;    
    },
    update: function()
    {
      if (this.isMCE())
        this.mceUpdate();
      else
        this.htmlUpdate();
    },                
    htmlUpdate : function()
    {
      var html, start, end, cursor, textarea = this.textarea;
      if (!textarea) return;
      
      html = this.genHTML();
      
      var range = null;       
      if (!this.isMCE() && document.selection)
      {
        textarea.focus();
        range = document.selection.createRange();
      } 

      // Insert HTML
      // W3C
      if (typeof textarea.selectionStart !== 'undefined')
      {
        start = textarea.selectionStart;
        end = textarea.selectionEnd;
        selection = textarea.value.substring(start, end);
        cursor = start + html.length;

        textarea.value = textarea.value.substring(0, start)
                       + html
                       + textarea.value.substring(end, textarea.value.length);

        // Update cursor position
        textarea.selectionStart = textarea.selectionEnd = cursor;
      }
      else
      if (document.selection && range) // IE
      {
        textarea.focus();
        range.text = html; //+ range.text;
        range.moveToBookmark(range.getBookmark());
        range.select();
        range = null;
      }

      this.close();
      textarea.focus();
    },
    mceUpdate : function()
    {
      var ed = tinyMCEPopup.editor, html = this.genHTML();
      
      tinyMCEPopup.execCommand("mceBeginUndoLevel");
      ed.selection.setContent(html);
      tinyMCEPopup.execCommand("mceEndUndoLevel");      
      this.close();
      ed.focus();
    },
  }

  $(document).ready(function() { Movoto_Mortgage_Dialog.init(); });
})(jQuery);