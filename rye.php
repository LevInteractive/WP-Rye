<?php
class Rye {

  // Enviornment constants for convenience.
  const PRODUCTION = 10;
  const STAGING = 20;
  const TESTING = 30;
  const DEVELOPMENT = 40;

  /**
   * @var  int  Current enviornment variable.
   */
  public static $enviornment = Rye::DEVELOPMENT;

  /**
   * @var  array  Internal configuration hash array.
   */
  private static $_config = array();

  /**
   * JSON decode the package.json file.
   * @return {object}
   */
  public static function package() {
    return json_decode(file_get_contents(__dir__."/package.json"));
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
   * Output the stylesheet html.
   * @return {string}
   */
  public static function stylesheet() {
    if ( Rye::$enviornment > Rye::PRODUCTION ) {
      $path = get_bloginfo('template_directory').'/assets/dist/'.Rye::project_name().'.all.css';
    } else {
      $path = get_bloginfo('template_directory').'/assets/dist/'.Rye::project_name().'.all.min.css';
    }
    return '<link rel="stylesheet" type="text/css" media="all" href="'.$path.'" />';
  }

  /**
   * Register JavaScripts.
   * @return {void}
   */
  private static function register_scripts() {
    if ( self::$_config['place_javascript_in_footer'] ) {
      remove_action('wp_head', 'wp_print_scripts');
      remove_action('wp_head', 'wp_print_head_scripts', 9);
      remove_action('wp_head', 'wp_enqueue_scripts', 1);
      add_action('wp_footer', 'wp_print_scripts', 5);
      add_action('wp_footer', 'wp_enqueue_scripts', 5);
      add_action('wp_footer', 'wp_print_head_scripts', 5);
    }

    if ( ! is_admin() ) {
      foreach ( self::$_config['javascripts'] as $name => $path ) {
        wp_deregister_script($name);
        wp_register_script($name, $path, array(), false, self::$_config['place_javascript_in_footer']);
        wp_enqueue_script($name, $path, array(), false, self::$_config['place_javascript_in_footer']);
      }
    }
  }

  /**
   * Register sidebar regions.
   * @return {void}
   */
  private static function register_regions() {
    foreach ( self::$_config['widgetized_regions'] as $region ) {
      register_sidebar($region);
    }
  }

  /**
   * Register taxonomies.
   * @return {void}
   */
  private static function register_taxonomies() {
    foreach ( self::$_config['taxonomies'] as $taxonomy ) {
      register_taxonomy($taxonomy[0], $taxonomy[1], $taxonomy[2]);
    }
  }

  /**
   * Register post types.
   * @return {void}
   */
  private static function register_post_types() {
    foreach ( self::$_config['post_types'] as $name => $type ) {
      register_post_type($name, $type);
    }
  }

  /**
   * Register image sizes.
   * @return {void}
   */
  private static function register_image_sizes() {
    foreach ( self::$_config['image_sizes'] as $name => $args ) {
      add_image_size($name, $args[0], $args[1], $args[2]);
    }
  }

  /**
   * Add various types of theme support.
   * @return {void}
   */
  private static function add_theme_support() {
    foreach ( self::$_config['theme_support'] as $name => $args ) {
      add_theme_support($name, $args);
    }
  }

  /**
   * Initialize the site the way WP likes it. This will be called on
   * the init hook.
   * @return {void}
   */
  public static function _init() {
    register_nav_menus(self::$_config['menus']);
    self::register_scripts();
    self::register_scripts();
    self::register_regions();
    self::register_taxonomies();
    self::register_post_types();
    self::register_image_sizes();
    self::add_theme_support();
  }

  /**
   * Set the hook for initiating WP.
   * @return {void}
   */
  public static function init(array $rye_config) {
    // Set internal config property.
    self::$_config = $rye_config;

    // Hook the Rye initialization method with WordPress init.
    // http://codex.wordpress.org/Function_Reference/add_action
    add_action('init', array(Rye, '_init'));
  }
}
