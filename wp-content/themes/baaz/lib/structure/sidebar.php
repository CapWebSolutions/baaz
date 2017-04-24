<?php
/**
 * Sidebar Functions
 *
 * This file controls the various sidebar displays on the site
 *
 * @category     Child BAAZ
 * @package      Admin
 * @author       Cap Web Solutions
 * @copyright    Copyright (c) 2017, Cap Web Solutions
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since        1.0.0
 *
 */

// Conditionally unregister sidebar(s)
if ( ( is_admin() && baaz_is_widgets_page() ) || ( !is_admin() ) ) {
    unregister_sidebar( 'sidebar' );
	//unregister_sidebar( 'sidebar-alt' );
    // For themes without 3 column layouts the sidebar-alt function stays in the functions.php file to remove it everywhere.
}

function baaz_is_widgets_page() {
    return in_array( $GLOBALS['pagenow'], array( 'widgets.php', ) );
}

// Replace Sidebar With Custom Sidebar
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );

add_action( 'get_header', 'baaz_child_sidebars_init', 15 );
/**
 * Remove sidebars
 */
function baaz_child_sidebars_init() {
	remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
	remove_action( 'genesis_sidebar_alt', 'genesis_do_sidebar_alt' );
	remove_action( 'genesis_sidebar', 'ss_do_sidebar' );
	remove_action( 'genesis_sidebar_alt', 'ss_do_sidebar_alt' );
	add_action( 'genesis_sidebar', 'baaz_child_do_sidebar' );
}

/**
 * Checks to see if simple sidebar exists
 *
 * @return string/boolean String of sidebar key OR false if none found
 */
function cws_child_has_ss_sidebar( $sidebar_key = '_ss_sidebar' ) {

	if ( is_singular() && $sidebar_key = genesis_get_custom_field( $sidebar_key ) ) {
		return $sidebar_key;
	}

	if ( is_tax() || is_category() || is_tag() ) {

		if ( $sidebar_key = get_term_meta( get_queried_object()->term_id, $sidebar_key, true ) ) {
			return $sidebar_key;
		}
	}

	return false;
}


/**
 * Custom Frederik Sidebar for each sidebar
 */
function baaz_child_do_sidebar() {
	if ( $id = cws_child_has_ss_sidebar() ) {
		if ( dynamic_sidebar( $id ) ) { /* do nothing */ }
	}

	else {

		if( is_archive() || is_single() || is_category() || is_tag() || is_home( ) ) {
			genesis_widget_area( 'blog-sidebar');
		}

		else genesis_widget_area( 'page-sidebar');
	}
}