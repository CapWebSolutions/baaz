<?php
/**
 * Plugin Name: Core Functionality
 * Plugin URI: https://github.com/CapWebSolutions/corefunctionality
 * Description: This contains all this site's core functionality so that it is theme independent. Customized for this site.
 * Version: 1.0.0
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

/**
 * Get the CMB2 bootstrap going!
 */

if ( file_exists( __DIR__ . '/lib/cmb2/init.php' ) ) {
  require_once __DIR__ . '/lib/cmb2/init.php';
} elseif ( file_exists(  __DIR__ . '/lib/CMB2/init.php' ) ) {
  require_once __DIR__ . '/lib/CMB2/init.php';
}

// Post Types.
// include_once( CWS_DIR . '/lib/functions/post-types.php' );

// Metaboxes.
// include_once( CWS_DIR . '/lib/functions/metaboxes.php' );

// General.
include_once( CWS_DIR . '/lib/functions/general.php' );

// Testimonials
// include_once( CWS_DIR . '/lib/functions/display_testimonials.php' );

// Footer Setup.
// include_once( CWS_DIR . '/lib/functions/core-footer.php' );

// Woo tweaks.
// include_once( CWS_DIR . '/lib/functions/wootweaks.php' );

// Enqueue Assets
add_action('wp_enqueue_scripts', 'core_functionality_add_css_and_js');
function core_functionality_add_css_and_js() {
	// wp_enqueue_style( 'core-functionality-styles', CWS_DIR . '/assets/css/testimonials.css');
	wp_enqueue_script( 'core-functionality-scripts', CWS_DIR . '/assets/js/retina.min.js', array(), '1.0.0', true);
	// wp_enqueue_script( 'core-functionality-scripts', CWS_DIR . '/assets/js/slide-testimonials.js', array(), '1.0.0', true);
}
