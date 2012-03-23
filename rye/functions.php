<?php
/**
 *  Include Rye coniguration file.
 */
require_once('_config.php');

/**
 *  Filters.
 *  Miscellaneous theme specific utility filters.
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


/**
 *  Theme specific methods.
 *  Other methods which make the theme function.
 */

