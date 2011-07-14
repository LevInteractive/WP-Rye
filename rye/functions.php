<?php
/**
 *      --   Rye Configuration    --
 *
 *  Here you can declare your javascript files, custom menus, 
 *  widgetized areas, custom post types and taxonomies.
 *
 * 
 *  Project Name: <Name>
 *  PHP Developer: <Your Name>
 *  UI Developer: <Your Name>
 *  Created: <MM-DD-YYYY>
 * 
 */





/**
 *  Optional. Add custom menu & post thumbnail support.
 *  http://codex.wordpress.org/Function_Reference/add_theme_support
 */
// add_theme_support('menus');
// add_theme_support('post-thumbnails');





/**
 *  Add specific sizes for thumbnails.
 *  http://codex.wordpress.org/Function_Reference/add_image_size
 */
// add_image_size('featured_article', 200, 170, true);





/**
 *  Site Configurations.
 */
$rye_config = array(
	
	/**
	 *  Place JavaScripts in footer.
	 *  http://developer.yahoo.com/performance/rules.html#js_bottom
	 */
	'place_javascript_in_footer' => true,





	/**
	 *  Path to JavaScript files.
	 *  http://codex.wordpress.org/Function_Reference/wp_register_script
	 */
	'javascripts' => array(
		'jquery'             => 'https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js',
		//'jquery_cycle'       => get_bloginfo('template_directory').'/assets/js/jquery.cycle.all.min.js',
		//'jquery_fancybox'    => get_bloginfo('template_directory').'/assets/js/jquery.fancybox-1.3.4.pack.js',
		//'application'        => get_bloginfo('template_directory').'/assets/js/application.js',
	),





	/**
	 *  Declare Custom Menu Regions.
	 *  http://codex.wordpress.org/Function_Reference/register_nav_menus
	 */
	'menus' => array(
		//'main-nav'    => 'Main Navigation',
		//'sub-nav'     => 'Sub Navigation',
	),





	/**
	 *  Declare "Widgetized" Regions.
	 *  http://codex.wordpress.org/Function_Reference/register_sidebar
	 */
	'widgetized_regions' => array(
		/*
		array(
			'name' => 'Sidebar',
			'description' => 'The sidebar.',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
		),
		array(
			'name' => '',
			'description' => '',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
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
			'labels' => array('name' => 'Some Type'),
			'public' => false,
			'publicly_queryable' => false,
			'show_ui' => true, 
			'show_in_menu' => true, 
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'has_archive' => true, 
			'hierarchical' => false,
			'menu_position' => 4,
			'supports' => array('title','thumbnail','custom-fields')
		),
		'some_type' => array(
			'labels' => array('name' => 'Some Type'),
			'public' => false,
			'publicly_queryable' => false,
			'show_ui' => true, 
			'show_in_menu' => true, 
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'has_archive' => true, 
			'hierarchical' => false,
			'menu_position' => 4,
			'supports' => array('title','thumbnail','custom-fields')
		),
		*/
	),
	
	
	
	
	
	
	/**
	 *  Declare Custom Post Types.
	 *	http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	'taxonomies' => array(
		/*
		array(
			'writer', 'book', array(
				'hierarchical' => false,
				'labels' => array('name' => 'Writers'),
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => array('slug' => 'writer'),
			)
		),
		array(
			'writer', 'book', array(
				'hierarchical' => false,
				'labels' => array('name' => 'Writers'),
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => array('slug' => 'writer'),
			)
		),
		*/
	)
);




/**
 *  Hook.
 *  http://codex.wordpress.org/Function_Reference/add_action
 */
add_action('init', 'rye_init');




/**
 *  Initialize Rye.
 */
function rye_init()
{
	global $rye_config;
	
	// Move all scripts to footer.
	if ($rye_config['place_javascript_in_footer'])
	{
		remove_action('wp_head', 'wp_print_scripts');
		remove_action('wp_head', 'wp_print_head_scripts', 9);
		remove_action('wp_head', 'wp_enqueue_scripts', 1);
		add_action('wp_footer', 'wp_print_scripts', 5);
		add_action('wp_footer', 'wp_enqueue_scripts', 5);
		add_action('wp_footer', 'wp_print_head_scripts', 5);
	}
	
	// Queue JavaScripts.
	if ( ! is_admin()) 
	{
		foreach ($rye_config['javascripts'] as $name => $path)
		{
			wp_deregister_script($name);
			
			wp_register_script($name, $path, array(), false, 
				$rye_config['place_javascript_in_footer']);
			
			wp_enqueue_script($name, $path, array(), false, 
				$rye_config['place_javascript_in_footer']);
		}
	}
	
	// Register Custom Menus.
	register_nav_menus($rye_config['menus']);
	
	// Register Sidebars.
	foreach ($rye_config['widgetized_regions'] as $region)
	{
		register_sidebar($region);
	}
	
	// Register Custom Post Types.
	foreach ($rye_config['post_types'] as $name => $type)
	{
		register_post_type($name, $type);
	}
	
	// Register Taxonomies.
	foreach($rye_config['taxonomies'] as $taxonomy)
	{
		register_taxonomy($taxonomy[0], $taxonomy[1], $taxonomy[2]);
	}
}









/**
 *  Helper Functions.
 *  Miscellaneous theme specific utility functions.
 */

// Truncate text by words.
// Source: https://bitbucket.org/ellislab/codeigniter/src
function rye_truncate_by_words($str, $limit = 100, $end_char = '&#8230;') 
{
	if (trim($str) == '') 
	{
	    return strip_tags($str);
	}
	
	preg_match('/^\s*+(?:\S++\s*+){1,'.(int) $limit.'}/', $str, $matches);
	
	if (strlen($str) == strlen($matches[0])) 
	{
	    $end_char = '';
	}
	
	return strip_tags(rtrim($matches[0]).$end_char, '<b><strong>');
}
