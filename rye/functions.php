<?php
/**
 *      --   Rye Configuration    --
 *
 *  Here you can declare your javascript files, custom menus, 
 *  widgetized areas, custom post types and taxonomies.
 *
 * 
 *  Project Name: <Name>
 *  Created: <MM-DD-YYYY>
 * 
 */



/**
 *  Site configurations.
 */
$rye_config = array(
    /**
     *  Place JavaScripts in footer. This tends to break some plugins that rely on
     *  jQuery in the header. Enable with caution.
     *  http://developer.yahoo.com/performance/rules.html#js_bottom
     */
    'place_javascript_in_footer' => false,



    /**
     *  Path to JavaScript files.
     *  http://codex.wordpress.org/Function_Reference/wp_register_script
     */
    'javascripts' => array(
        /*
        'jquery'  => 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js',
        'plugins' => get_bloginfo('template_directory').'/assets/js/plugins.js',
        'script'  => get_bloginfo('template_directory').'/assets/js/script.js'
        */
    ),
    
    
    
    /**
     *  Path to JavaScript files.
     *  http://codex.wordpress.org/Function_Reference/add_image_size
     *
     *  '<image-size-name>' => array(<width>, <height>, <crop>)
     */
    'image_sizes' => array(
        /*
        'featured_post'    => array(500, 500, false),
        'featured_article' => array(200, 200, true)
        */
    ),



    /**
     *  Declare Custom Menu Regions.
     *  http://codex.wordpress.org/Function_Reference/register_nav_menus
     */
    'menus' => array(
        /*
        'main-nav'    => 'Main Navigation',
        'sub-nav'     => 'Sub Navigation',
        */
    ),
    

    
    /**
     *  Declare Custom Menu Regions.
     *  http://codex.wordpress.org/Function_Reference/register_nav_menus
     *
     *  '<feature>' => array('<arg>', '<arg>')
     */
    'theme_support' => array(
        /*
        'post-thumbnails' => array('post', 'articles'),
        'post-formats'    => array('aside', 'gallery')
        */
    ),



    /**
     *  Declare "Widgetized" Regions.
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
     *  Declare Custom Post Types.
     *  http://codex.wordpress.org/Function_Reference/register_post_type
     */
    'post_types' => array(
        /*
        'some_type' => array(
            'labels'             => array('name' => 'Some Type'),
            'public'             => false,
            'publicly_queryable' => false,
            'show_ui'            => true, 
            'show_in_menu'       => true, 
            'query_var'          => true,
            'rewrite'            => true,
            'capability_type'    => 'post',
            'has_archive'        => true, 
            'hierarchical'       => false,
            'menu_position'      => 4,
            'supports'           => array('title','thumbnail','custom-fields')
        ),
        'some_type' => array(
            'labels'             => array('name' => 'Some Type'),
            'public'             => false,
            'publicly_queryable' => false,
            'show_ui'            => true, 
            'show_in_menu'       => true, 
            'query_var'          => true,
            'rewrite'            => true,
            'capability_type'    => 'post',
            'has_archive'        => true, 
            'hierarchical'       => false,
            'menu_position'      => 4,
            'supports'           => array('title','thumbnail','custom-fields')
        )
        */
    ),



    /**
     *  Declare Custom Post Types.
     *  http://codex.wordpress.org/Function_Reference/register_taxonomy
     */
    'taxonomies' => array(
        /*
        array(
            'tax_name', 'postype_name', array(
            'hierarchical'    => false,
            'labels'          => array('name' => '<Tax Name>'),
            'show_ui'         => true,
            'query_var'       => true,
            'rewrite'         => array('slug' => 'tax-name'),
            )
        ),
        array(
            'tax_name', 'postype_name', array(
            'hierarchical'    => false,
            'labels'          => array('name' => '<Tax Name>'),
            'show_ui'         => true,
            'query_var'       => true,
            'rewrite'         => array('slug' => 'tax-name'),
            )
        )
        */
    )
);




/**
 *  Initialize the configuration array.
 */
function _rye_init($rye_config)
{
    global $rye_config;
    
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
}


/**
 *  Hook the Rye initialization method with WordPress init.
 *  http://codex.wordpress.org/Function_Reference/add_action
 */
add_action('init', '_rye_init');






/**
 *  Helpers.
 *  Miscellaneous theme specific utility methods & filters.
 */

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
