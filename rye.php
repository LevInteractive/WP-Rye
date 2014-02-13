<?php
class Rye {
  /**
   * JSON decode the package.json file.
   * @return {object}
   */
  public static function package() {
    return json_decode(file_get_contents("./package.json"));
  }

  /**
   * Create a safe name to use for such things as compiled asset filenames.
   * @return {string}
   */
  public static function project_name() {
    $package = self::package();
    return sanitize_title($package->name);
  }

  /**
   * Initialize the site the way WP likes it.
   * @return {void}
   */
  public static function init(array $rye_config) {
    // Move all scripts to footer.
    if ($rye_config['place_javascript_in_footer']):
      remove_action('wp_head', 'wp_print_scripts');
      remove_action('wp_head', 'wp_print_head_scripts', 9);
      remove_action('wp_head', 'wp_enqueue_scripts', 1);
      add_action('wp_footer', 'wp_print_scripts', 5);
      add_action('wp_footer', 'wp_enqueue_scripts', 5);
      add_action('wp_footer', 'wp_print_head_scripts', 5);
    endif;
    
    // Queue JavaScripts.
    if ( ! is_admin()):
      foreach ($rye_config['javascripts'] as $name => $path):
        wp_deregister_script($name);
        
        wp_register_script($name, $path, array(), false, 
          $rye_config['place_javascript_in_footer']);
        
        wp_enqueue_script($name, $path, array(), false, 
          $rye_config['place_javascript_in_footer']);
      endforeach;
    endif;
    
    // Register Custom Menus.
    register_nav_menus($rye_config['menus']);
    
    // Register Sidebars.
    foreach ($rye_config['widgetized_regions'] as $region)
      register_sidebar($region);
    
    // Register Custom Post Types.
    foreach ($rye_config['post_types'] as $name => $type)
      register_post_type($name, $type);
    
    // Register Taxonomies.
    foreach($rye_config['taxonomies'] as $taxonomy)
      register_taxonomy($taxonomy[0], $taxonomy[1], $taxonomy[2]);
      
    // Register image sizes.
    foreach($rye_config['image_sizes'] as $name => $args)
      add_image_size($name, $args[0], $args[1], $args[2]);
    
    // Register theme support.
    foreach($rye_config['theme_support'] as $name => $args)
      add_theme_support($name, $args);

    // Hook the Rye initialization method with WordPress init.
    // http://codex.wordpress.org/Function_Reference/add_action
    add_action('init', array($this, 'init'));
  }
}
