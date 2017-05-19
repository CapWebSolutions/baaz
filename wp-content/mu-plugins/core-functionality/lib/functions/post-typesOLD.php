<?php
/**
 * Post Types
 *
 * This file registers any custom post types
 *
 * @package      Core_Functionality
 * @since        1.0.0
 * @link         https://github.com/billerickson/Core-Functionality
 * @author       Bill Erickson <bill@billerickson.net>
 * @copyright    Copyright (c) 2011, Bill Erickson
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

add_action( 'init', 'cptui_register_my_cpts' );
function cptui_register_my_cpts() {
	$labels = array(
		'name' => __( 'Poet', '' ),
		'singular_name' => __( 'Poet', '' ),
		);

	$args = array(
		'label' => __( 'Poet', '' ),
		'labels' => $labels,
		'description' => '',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_rest' => false,
		'rest_base' => '',
		'has_archive' => false,
		'show_in_menu' => true,
				'exclude_from_search' => false,
		'capability_type' => 'post',
		'map_meta_cap' => true,
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'poets', 'with_front' => false ),
		'query_var' => true,
		'menu_icon' => 'dashicons-id-alt',
		'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
	);
	register_post_type( 'sr_poet', $args );

	// End of cptui_register_my_cpts()
}
