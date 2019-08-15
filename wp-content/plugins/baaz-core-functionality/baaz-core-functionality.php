<?php
/**
 * Plugin Name: BAAZ Core Functionality
 * Plugin URI: https://github.com/CapWebSolutions/baaz
 * Description: This contains all this site's core functionality so that it is theme independent. Customized for this site.
 * Version: 1.1.0
 * Author: Cap Web Solutions
 * Author URI: https://capwebsolutions.com
 *
 * @package      Core_Functionality
 * @since        1.0.0
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

// Plugin Directory.
define( 'CWS_DIR', dirname( __FILE__ ) );

// General.
include_once( CWS_DIR . '/lib/functions/general.php' );

// Load login screen customizations
include_once( CWS_DIR . '/lib/functions/custom-login.php' );

// Enqueue Assets
add_action('wp_enqueue_scripts', 'core_functionality_add_css_and_js');
function core_functionality_add_css_and_js() {
	wp_enqueue_script( 'core-functionality-scripts', CWS_DIR . 'assets/js/retina.min.js', array(), '', true);
}

/**
 * Load custom styles for the WordPress login page.
 */
add_action( 'login_enqueue_scripts', 'cws_custom_login_stylesheet' );
function cws_custom_login_stylesheet() {
	wp_enqueue_style( 'custom-login', CWS_DIR . 'assets/css/login-style.css' );
}