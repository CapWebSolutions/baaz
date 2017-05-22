<?php
/**
 * Post Types
 *
 * This file registers any custom post types
 *
 * @package      Core_Functionality
 * @since        1.0.0
 * @link         https://github.com/capwebsolutions/Core-Functionality
 * @author       Cap Web Solutions <matt@capwebsolutions.com>
 * @copyright    Copyright (c) 2017, Matt Ryan
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */


add_action( 'init', 'cptui_register_my_cpts' );
function cptui_register_my_cpts() {

	/**
	 * Post Type: Testimonials.
	 */

	$labels = array(
		"name" => __( 'Testimonials', 'baaz-testimonials' ),
		"singular_name" => __( 'Testimonial', 'baaz-testimonials' ),
		'add_new' => __( 'Add New Testimonial', 'baaz-testimonials' ),
		'add_new_item' => __( 'Add New Testimonial', 'baaz-testimonials' ),
		'edit_item' => __( 'Edit Testimonial', 'baaz-testimonials' ),
		'new_item' => __( 'New Testimonial', 'baaz-testimonials' ),
		'view_item' => __( 'View Testimonial', 'baaz-testimonials' ),
		'search_items' => __( 'Search Testimonials', 'baaz-testimonials' ),
		'not_found' =>  __( 'No Testimonials found', 'baaz-testimonials' ),
		'not_found_in_trash' => __( 'No Testimonials found in trash', 'baaz-testimonials' ),
		'parent_item_colon' => '',
		'menu_name' => __( 'Testimonials', 'baaz-testimonials' ),
	);

	$args = array(
		"label" => __( 'Testimonials', 'baaz-testimonials' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( 
            'slug'          => __( 'cws_testimonials', 'baaz-testimonials' ), 
            "with_front"    => false,  
            ),
		"query_var" => true,
		"menu_position" => 20,
		"menu_icon" => "dashicons-megaphone",
   		"supports" => array( 'title', 'editor', 'page-attributes','genesis-cpt-archives-settings' ),

	);

	register_post_type( "cws_testimonials", $args );
}
/*
 * Clean up title placeholder
 */
add_filter('gettext','baaz_testimonial_name');
function baaz_testimonial_name( $input ) {

    global $post_type;

    if( is_admin() && 'Enter title here' == $input && 'cws_testimonials' == $post_type )
        return __( 'Testimonial Client Name', 'baaz-testimonials' );
    return $input;
}

