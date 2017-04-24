<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.5.2
 * @author     Thomas Griffin <thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo.com>
 * @copyright  Copyright (c) 2014, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'cws_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function cws_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// Attorneys
		array(
			'name'     				=> 'BAAZ Attorneys',
			'slug'     				=> 'baaz-attorneys',
			'source'   				=> BAAZ_DIR . '/lib/plugins/baaz-attorneys.zip',
			'required' 				=> true,
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url'       => '',
		),

		// Testimonials
		array(
			'name'     				=> 'BAAZ Practice Areas',
			'slug'     				=> 'baaz-practice-areas',
			'source'   				=> BAAZ_DIR . '/lib/plugins/baaz-practice-areas.zip',
			'required' 				=> true,
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url'       => '',
		),

	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'baaz';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'id'           		=> 'tgmpa-baaz',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_slug' 		=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
        'dismissable'  		=> true,                    	// If false, a user cannot dismiss the nag message.
        'dismiss_msg'  		=> '',                     		// If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table

	);

	tgmpa( $plugins, $config );

}