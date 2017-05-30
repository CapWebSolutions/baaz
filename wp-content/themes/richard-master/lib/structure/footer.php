<?php

/**
 * Footer Functions
 *
 * This file controls the footer on the site. The standard Genesis footer
 * has been replaced with one that has menu links on the right side and
 * copyright and credits on the left side.
 *
 * @category     Richard
 * @package      Admin
 * @author       Web Savvy Marketing
 * @copyright    Copyright (c) 2016, Web Savvy Marketing
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since        1.0.0
 *
 */

remove_action( 'genesis_footer', 'genesis_do_footer' );

add_action( 'genesis_footer', 'wsm_child_do_footer' );
function wsm_child_do_footer() {
	if ( is_active_sidebar('pre-footer-ctas') ) {
		echo '<div class="clearfix"></div>';
		echo '<div class="pre-footer-ctas">';
		genesis_widget_area( 'pre-footer-ctas', array( 'before' => '<div class="pre-footer-ctas">', 'after' => '</div>') );
		echo '</div>';
	}

	echo '<div class="footer-left">';

	genesis_widget_area( 'footer-social', array( 'before' => '<div class="social-icons">', 'after' => '</div>') );

	$copyright = genesis_get_option( 'wsm_copyright', 'richard-settings' );
	$info= genesis_get_option( 'wsm_info', 'richard-settings' );

	if ( !empty( $info ) ) {
		echo '<p class="credit">' . do_shortcode( genesis_get_option( 'wsm_info', 'richard-settings' ) ) . '</p>';
	}

	if ( !empty( $copyright ) ) {
		echo '<p class="copyright">' . do_shortcode( genesis_get_option( 'wsm_copyright', 'richard-settings' ) ) . '</p>';
	}

	echo '</div>';

	$extras = genesis_get_option( 'wsm_extras', 'richard-settings' );

	if ( !empty( $extras ) ) {
		echo '<div class="extras">' . do_shortcode( genesis_get_option( 'wsm_extras', 'richard-settings' ) ) . '</div>';
	}

}