<?php
/*
Plugin Name: Movoto Mortgage Calculator
Plugin URI: http://wordpress.org/extend/plugins/movoto-mortgage-calculator/
Description: Movoto Mortgage Calculator
Version: 1.0.0
Author: Martin Sudolsky
Author URI: http://martinsuly.eu
Text Domain: movotomcalculator
*/

// widget
class MovotoMortgageCalculatorWidget extends WP_Widget
{
  private $plugin_path;

  public function __construct()
  {
    $path = dirname(plugin_basename(__FILE__));        
    $this->plugin_path = WP_PLUGIN_DIR.'/'.$path;
  
    parent::WP_Widget(__class__, __('Movoto Mortgage Calculator', MovotoMortgageCalculator::ld), array(
                        'description' => __('Movoto Mortgage Calculator - Widget', MovotoMortgageCalculator::ld)
                      ));  
  }

  // show widget
  function widget($args, $instance)        
  {
    extract($args);      
    
    $title = apply_filters('widget_title', $instance['title']);
    
    echo $before_widget;

    if ($title)
      echo $before_title.$title.$after_title;
      
    $background = $instance['background'];
    $input_field = $instance['input_field'];
    $button_type = $instance['button_type'];
    $show_link = $instance['show_link'];
    
    require $this->plugin_path.'/frontend/widget.php';
            
    echo $after_widget;
  }

  // update widget
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['background'] = $new_instance['background'];
    $instance['input_field'] = $new_instance['input_field'];
    $instance['button_type'] = $new_instance['button_type'];
    $instance['show_link'] = $new_instance['show_link'];
    return $instance;
  }
  
  // show widget form
  function form($instance)
  {
    if ($instance)
    {
      $title = esc_attr($instance['title']);
      $background = $instance['background'];
      $input_field = $instance['input_field'];
      $button_type = $instance['button_type'];
      $show_link = $instance['show_link'];
    }
    else
    {
      $title = __('Movoto Mortgage Calculator', MovotoMortgageCalculator::ld);
      $background = 0;
      $input_field = 0;
      $button_type = 0;
      $show_link = false;
    }        
    
    require $this->plugin_path.'/admin/widget_form.php';      
  }
}

// main class
class MovotoMortgageCalculator
{
  const ld = 'movotomcalculator';
  const nonce = 'movotomcalculator_nonce';
  const version = '1.0.0';

  private $plugin_url, $plugin_path;
  
  public function __construct()
  {
    // paths
    $path = dirname(plugin_basename(__FILE__));        
    $this->plugin_url = WP_PLUGIN_URL.'/'.$path;
    $this->plugin_path = WP_PLUGIN_DIR.'/'.$path;
    
    add_action('plugins_loaded', array(&$this, 'plugins_loaded'));
    
    if (is_admin())
      add_action('init', array(&$this, 'init'));

    // shortcode action
    add_shortcode('movotomortgage', array(&$this, 'shortcode'));
      
    // activation and uninstall hook
    register_activation_hook(__FILE__, array(&$this, 'activation'));
    register_uninstall_hook(__FILE__, array(__class__, 'uninstall'));

    // register widget
    add_action('widgets_init', array(&$this, 'widget'));
  }
  
  // register widget
  public function widget()
  {
    register_widget(__class__.'Widget');
  }
  
  // load localization domain
  public function plugins_loaded()
  {
    load_plugin_textdomain(self::ld, false, $this->plugin_path.'/languages/');
  }  

  // on activation
  public function activation()
  {
    add_option(__class__.'_options', array(
                                    'background' => 0,
                                    'input_field' => 0,
                                    'button_type' => 0
                                ));
  }
  
  // uninstallation
  static function uninstall()
  {
    delete_option(__class__.'_options');
  }
  
  public function init()
  {
    if (!current_user_can('edit_posts') && !current_user_can('edit_pages'))
      return;
    
    add_action('admin_enqueue_scripts', array(&$this, 'add_admin_scripts_edit'));
    add_action('admin_footer-post.php', array(&$this, 'admin_footer_edit'));
    add_action('admin_footer-post-new.php', array(&$this, 'admin_footer_edit'));

    // register filters to add button into tinyMCE
    if (get_user_option('rich_editing') == 'true')
    {
      add_filter('mce_external_plugins', array(&$this, 'mce_plugin'));
      add_filter('mce_buttons', array(&$this, 'mce_buttons'));
    }  
  }
  
  // add mce button
  public function mce_buttons($buttons)
  {    
    array_push($buttons, '|', 'movoto_mortgage_button');
    return $buttons;
  }
  
  // set mce plugin
  public function mce_plugin($plugin_array)
  {
    $plugin_array['movoto_mortgage_shortcode_dialog'] = $this->plugin_url.'/admin/mce_plugin.js';
    return $plugin_array;
  }
  
  // helper functions
  public function get_field_name($name)
  {
    return $name;
  }
  
  public function get_field_id($id)
  {
    return $id;
  }
  
  // add css into post/page edit
  public function add_admin_scripts_edit($hook)
  {
    if ($hook == 'post.php' || $hook == 'post-new.php')
    {    
      wp_enqueue_style(__class__.'_button_dialog', $this->plugin_url.'/admin/shortcode_dialog.css', array(), self::version, 'all');      

      wp_enqueue_script(__class__, $this->plugin_url.'/admin/shortcode_dialog.js', array('jquery'), self::version);          
      wp_localize_script(__class__, __class__.'_data',
            array(
              'version' => self::version,
              'text' => array(
                  'add_shortcode' => __('Add Movoto Mortgage Calculator Shortcode', self::ld),
                  'long_name' => __('Movoto Mortgage Calculator Dialog', self::ld),
                  'button_title' => __('Movoto Mortgage', self::ld)
                )
              ));
    }
        
    if ($hook == 'widgets.php' || $hook == 'post.php' || $hook == 'post-new.php')
    {
      wp_enqueue_style(__class__.'_form', $this->plugin_url.'/admin/form.css', array(), self::version, 'all');          
      wp_enqueue_script(__class__.'_form', $this->plugin_url.'/admin/form.js', array('jquery'), self::version);              
    }
  }
  
  // admin footer for post.php and post-new.php
  public function admin_footer_edit()
  {
    require_once $this->plugin_path.'/admin/shortcode_dialog.php';    
  }
  
  // shortcode implementation
  public function shortcode($atts)
  {
    $atts = shortcode_atts(array(
                  'background' => 0,
                  'input' => 0,
                  'button' => 0,
                  'link' => false
                ), $atts);
          
    $background = $atts['background'];
    $input_field = $atts['input'];
    $button_type = $atts['button'];
    $show_link = $atts['link'];
          
    ob_start();
    require $this->plugin_path.'/frontend/widget.php';
    $c = ob_get_contents();
    ob_end_clean();
    return $c;
  }
  
}

new MovotoMortgageCalculator();