<?php

/**
 * Footer Functions
 *
 * This file controls the footer on the site. The standard Genesis footer
 * has been replaced with one that has menu links on the right side and
 * copyright and credits on the left side.
 *
 * @category     BAAZ
 * @package      Admin
 * @author       Cap Web Solutions
 * @copyright    Copyright (c) 2017, Cap Web Solutions
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since        1.0.0
 *
 */

remove_action( 'genesis_footer', 'genesis_do_footer' );

add_action( 'genesis_footer', 'cws_child_do_footer' );
function cws_child_do_footer() {

	echo '<div class="footer-left">';

	genesis_widget_area( 'footer-social', array( 'before' => '<div class="social-icons">', 'after' => '</div>') );

	$copyright = genesis_get_option( 'cws_copyright', 'baaz-settings' );
	$info= genesis_get_option( 'cws_info', 'baaz-settings' );

	if ( !empty( $info ) ) {
		echo '<p class="credit">' . do_shortcode( genesis_get_option( 'cws_info', 'baaz-settings' ) ) . '</p>';
	}

	if ( !empty( $copyright ) ) {
		echo '<p class="copyright">' . do_shortcode( genesis_get_option( 'cws_copyright', 'baaz-settings' ) ) . '</p>';
	}

	echo '</div>';

	$extras = genesis_get_option( 'cws_extras', 'baaz-settings' );

	if ( !empty( $extras ) ) {
		echo '<div class="extras">' . do_shortcode( genesis_get_option( 'cws_extras', 'baaz-settings' ) ) . '</div>';
	}

}