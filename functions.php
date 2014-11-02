<?php
require_once 'lib/rye.php';

/**
 * Set domains for auto tag detection.
 */
define("PRODUCTION_SERVER", "my-production-site.com");
define("STAGING_SERVER", "my-staging-site.com");

/**
 * Set the enviornment property. This will determine which version of the
 * assets will be used.
 */
if (stripos($_SERVER['SERVER_NAME'], PRODUCTION_SERVER) !== -1) {
  Rye::$enviornment = Rye::PRODUCTION;
} else if (stripos($_SERVER['SERVER_NAME'], STAGING_SERVER) !== -1) {
  Rye::$enviornment = Rye::STAGING;
} else {
  Rye::$enviornment = Rye::DEVELOPMENT;
}

/**
 * Site configurations.
 */
Rye::init(array(

  /**
   *  Path to JavaScript files. Notice that vendor libraries are left separate
   *  from the custom compiled script. This allows for better compatibility with
   *  other plugins.
   *  http://codex.wordpress.org/Function_Reference/wp_register_script
   */
  'javascripts' => array(
    // 'jquery' => '//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js',
    'main' => get_bloginfo('template_directory').'/assets/dist/'.Rye::project_name().'.all'.
      ((Rye::$enviornment < Rye::STAGING) ? '.min' : '').'.js'
  ),

  /**
   *  Path to JavaScript files.
   *  http://codex.wordpress.org/Function_Reference/add_image_size
   *
   *  '<image-size-name>' => array(<width>, <height>, <crop>)
   */
  'image_sizes' => array(
    /*
    'featured_post'  => array(500, 500, false),
    'featured_article' => array(200, 200, true)
    */
  ),

  /**
   *  Declare custom menu regions.
   *  http://codex.wordpress.org/Function_Reference/register_nav_menus
   */
  'menus' => array(
    /*
    'main-nav' => 'Main Navigation',
    'sub-nav'  => 'Sub Navigation',
    */
  ),

  /**
   *  Declare theme features.
   *  http://codex.wordpress.org/Function_Reference/add_theme_support
   *
   *  '<feature>' => array('<arg>', '<arg>')
   */
  'theme_support' => array(
    /*
    'html5'           => array('search-form', 'comment-form', 'comment-list'),
    'post-thumbnails' => array('post', 'articles'),
    'post-formats'    => array('aside', 'gallery')
    */
  ),

  /**
   *  Declare "widgetized" regions.
   *  http://codex.wordpress.org/Function_Reference/register_sidebar
   */
  'widgetized_regions' => array(
    /*
    array(
      'name'          => '<Region Name>',
      'description'   => '<Region Description>',
      'before_title'  => '<h2>',
      'after_title'   => '</h2>',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
    ),
    array(
      'name'          => '<Region Name>',
      'description'   => '<Region Description>',
      'before_title'  => '<h2>',
      'after_title'   => '</h2>',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
    )
    */
  ),

  /**
   *  Declare custom post types.
   *  http://codex.wordpress.org/Function_Reference/register_post_type
   */
  'post_types' => array(
    /*
    'some_type' => array(
      'labels'      => array('name' => 'Some Type'),
      'public'      => true,
      'rewrite'     => true,
      'has_archive' => true,
      'supports'    => array('title', 'thumbnail', 'editor')
    )
    */
  ),

  /**
   *  Declare custom taxonomies.
   *  http://codex.wordpress.org/Function_Reference/register_taxonomy
   */
  'taxonomies' => array(
    /*
    array(
      'tax_name', 'postype_name', array(
        'hierarchical' => false,
        'labels'       => array('name' => '<Tax Name>'),
        'show_ui'      => true,
        'query_var'    => true,
        'rewrite'      => array('slug' => 'tax-name'),
      )
    )
    */
  )
));
