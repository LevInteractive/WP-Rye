<?php
/**
 *  Include Rye.
 */
require_once 'rye.php';


/**
 *  Site configurations.
 */
Rye::init(array(

  /**
   *  Place JavaScripts in footer. This tends to break some plugins that rely on
   *  jQuery in the header. Enable with caution (even though it's recommended).
   *  http://developer.yahoo.com/performance/rules.html#js_bottom
   */
  'place_javascript_in_footer' => false,



  /**
   *  Path to JavaScript files.
   *  http://codex.wordpress.org/Function_Reference/wp_register_script
   */
  'javascripts' => array(
    'main' => get_bloginfo('template_directory').'/assets/dist/'.Rye::project_name().'.all.min.js'
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
    'main-nav'  => 'Main Navigation',
    'sub-nav'   => 'Sub Navigation',
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
    'html5'     => array('search-form', 'comment-form', 'comment-list'),
    'post-thumbnails' => array('post', 'articles'),
    'post-formats'  => array('aside', 'gallery')
    */
  ),



  /**
   *  Declare "widgetized" regions.
   *  http://codex.wordpress.org/Function_Reference/register_sidebar
   */
  'widgetized_regions' => array(
    /*
    array(
      'name'    => '<Region Name>',
      'description'   => '<Region Description>',
      'before_title'  => '<h2>',
      'after_title'   => '</h2>',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
    ),
    array(
      'name'    => '<Region Name>',
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
      'labels'     => array('name' => 'Some Type'),
      'public'     => false,
      'publicly_queryable' => false,
      'show_ui'    => true, 
      'show_in_menu'   => true, 
      'query_var'    => true,
      'rewrite'    => true,
      'capability_type'  => 'post',
      'has_archive'  => true, 
      'hierarchical'   => false,
      'menu_position'  => 4,
      'supports'     => array('title','thumbnail','custom-fields')
    ),
    'some_type' => array(
      'labels'     => array('name' => 'Some Type'),
      'public'     => false,
      'publicly_queryable' => false,
      'show_ui'    => true, 
      'show_in_menu'   => true, 
      'query_var'    => true,
      'rewrite'    => true,
      'capability_type'  => 'post',
      'has_archive'  => true, 
      'hierarchical'   => false,
      'menu_position'  => 4,
      'supports'     => array('title','thumbnail','custom-fields')
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
      'hierarchical'  => false,
      'labels'    => array('name' => '<Tax Name>'),
      'show_ui'   => true,
      'query_var'   => true,
      'rewrite'   => array('slug' => 'tax-name'),
      )
    ),
    array(
      'tax_name', 'postype_name', array(
      'hierarchical'  => false,
      'labels'    => array('name' => '<Tax Name>'),
      'show_ui'   => true,
      'query_var'   => true,
      'rewrite'   => array('slug' => 'tax-name'),
      )
    )
    */
  )
));

// Set the enviornment property. If in production the scripts and styles
// will be minified.
// Rye::$enviornment = Rye::PRODUCTION;


// Filters.
// Miscellaneous theme specific utility filters.

/**
 *  Filter text through the the_content filter. Userful outside the loop.
 *  http://codex.wordpress.org/Function_Reference/the_content#Alternative_Usage
 *  
 *  apply_filters('wp_content', $str);
 */
add_filter('wp_content', function ($str) {
   $content = apply_filters('the_content', $str);
   $content = str_replace(']]>', ']]&gt;', $content);
   return $content;
}, 10, 1);


/**
 *  Truncate text by words. Note: This also strips html tags.
 *  https://bitbucket.org/ellislab/codeigniter/src
 *  
 *  apply_filters('truncate_by_words', $longstr, 20, '...');
 */
add_filter('truncate_by_words', function ($str, $limit = 100, $end_char = '&#8230;') {
   if (trim($str) == '') 
     return strip_tags($str);

   preg_match('/^\s*+(?:\S++\s*+){1,'.(int) $limit.'}/', $str, $matches);

   if (strlen($str) == strlen($matches[0])) 
     $end_char = '';

   return strip_tags(rtrim($matches[0]).$end_char);
}, 10, 3);


/**
 *  Theme specific methods.
 *  Other methods which make the theme function.
 */

