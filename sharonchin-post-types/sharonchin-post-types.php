<?php  
/* 
Plugin Name: Sharon Chin Theme Custom Post Types (News and Archives)
Plugin URI: http://www.robertour.com/ 
Version: Current Version 
Author: Roberto Ulloa
Description: Create the News and Archives Post Types
*/

function codex_custom_init() {
  $labels = array(
    'name' => __( 'Announcements' ),
    'singular_name' => __( 'Announcement' ),
    'add_new' => __( 'Add Announcements' ),
    'add_new_item' => __( 'Add New Announcement' ),
    'edit_item' => __( 'Edit Announcement' ),
    'new_item' => __( 'New Announcement' ),
    'all_items' => __( 'All Announcements' ),
    'view_item' => __( 'View Announcement' ),
    'search_items' => __( 'Search Announcements' ),
    'not_found' =>  __( 'No announcements found' ),
    'not_found_in_trash' => __( 'No announcements found in Trash' ), 
    'parent_item_colon' => __( '' ),
    'menu_name' => __( 'News' )
  );

  $args = array(
    'labels' => $labels,
    'description' => __( 'News' ),
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'exclude_from_search' => false,
    'menu_position' => 6,
    'hierarchical' => false,
    'query_var' => true,
    'capability_type' => 'post',
    'supports' => array( 'title', 'editor', 'comments', 'trackbacks', 'revisions', 'excerpt', 'thumbnail', 'custom-fields' ),
    'show_in_menu' => true, 
    'rewrite' => array( 'slug' => 'news', 'with_front' => true ),
    'taxonomies' => array( 'post_tag', 'category'),
    'has_archive' => true, 
    'can_export' => true
  ); 

  register_post_type( 'news', $args );
  
  $labels = array(
    'name' => __( 'Archive' ),
    'singular_name' => __( 'Archive Item' ),
    'add_new' => __( 'Add Archive Item' ),
    'add_new_item' => __( 'Add New Archive Item' ),
    'edit_item' => __( 'Edit Archive Item' ),
    'new_item' => __( 'New Archive Item' ),
    'all_items' => __( 'All Archive Items' ),
    'view_item' => __( 'View Archive Item' ),
    'search_items' => __( 'Search Archive Items' ),
    'not_found' =>  __( 'No archive items found' ),
    'not_found_in_trash' => __( 'No archive items found in Trash' ), 
    'parent_item_colon' => __( '' ),
    'menu_name' => __( 'Archive' )
  );

  $args = array(
    'labels' => $labels,
    'description' => __( 'Items' ),
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'exclude_from_search' => false,
    'menu_position' => 7,
    'hierarchical' => true,
    'query_var' => true,
    'capability_type' => 'post',
    'supports' => array( 'title', 'editor', 'comments', 'trackbacks', 'revisions', 'excerpt', 'thumbnail', 'custom-fields', 'post-formats' ),
    'show_in_menu' => true, 
    'rewrite' => array( 'slug' => 'archive', 'with_front' => true ),
    'taxonomies' => array( 'post_tag', 'category'),
    'has_archive' => true, 
    'can_export' => true
  ); 

  register_post_type( 'archive', $args );

}
add_action( 'init', 'codex_custom_init' );

?>
