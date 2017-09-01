<?php
/**
 * General
 *
 * This file contains the logo customization functions
 *
 * @package      Core_Functionality
 * @since        1.0.0
 * @link         https://github.com/capwebsolutions/bicycleaz-core-functionality
 * @author       Matt Ryan <matt@capwebsolutions.com>
 * @copyright    Copyright (c) 2017, Matt Ryan
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

add_filter( 'login_headerurl', 'cws_my_login_logo_url' );
/**
 * Change the URL of the logo in WordPress login page to home URL.
 *
 * @return URL of site's homepage.
 */
function cws_my_login_logo_url() {
	return home_url();
}

add_filter( 'login_headertitle', 'cws_my_login_logo_url_title' );
/**
 * Filter the title attribute of the header logo above login form.
 *
 * @return string Site title - Site description(tagline).
 */
function cws_my_login_logo_url_title() {
	return get_bloginfo( 'name' ) . ' - ' . get_bloginfo( 'description' );
}
