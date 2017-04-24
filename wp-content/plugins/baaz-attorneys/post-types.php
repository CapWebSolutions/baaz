<?php
/**
 * Include and setup custom post types.
 *
 */


// Add Attorney Post Type
add_action( 'init', 'cws_register_attorney_post_type' );
function cws_register_attorney_post_type() {
	$labels = array(
		'name' => __( 'Attorneys', 'baaz-attorneys' ),
		'singular_name' => __( 'Attorney', 'baaz-attorneys' ),
		'add_new' => __( 'Add New Attorney', 'baaz-attorneys' ),
		'add_new_item' => __( 'Add New Attorney', 'baaz-attorneys' ),
		'edit_item' => __( 'Edit Attorney', 'baaz-attorneys' ),
		'new_item' => __( 'New Attorney', 'baaz-attorneys' ),
		'view_item' => __( 'View Attorney', 'baaz-attorneys' ),
		'search_items' => __( 'Search Attorney', 'baaz-attorneys' ),
		'not_found' =>  __( 'No Attorney found', 'baaz-attorneys' ),
		'not_found_in_trash' => __( 'No Attorneys found in trash', 'baaz-attorneys' ),
		'parent_item_colon' => '',
		'menu_name' => __( 'Attorneys', 'baaz-attorneys' ),
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_admin_bar' => true,
		'menu_position' => null,
		'menu_icon' => 'dashicons-businessman',
		'query_var' => true,
		'rewrite' => array( 'slug' => __( 'attorney', 'baaz-attorneys' ) ),
		'capability_type' => 'post',
		'hierarchical' => true,
		'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes', )
	);

	register_post_type( 'cws_attorney', $args );
}

add_filter('gettext','baaz_attorney_name');

function baaz_attorney_name( $input ) {

    global $post_type;

    if( is_admin() && 'Enter title here' == $input && 'attorney' == $post_type )
        return __( 'NAME GOES HERE', 'baaz-attorneys' );
    return $input;
}