<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 */

/**
 * Get the bootstrap!
 */

if ( file_exists( dirname( __FILE__ ) . '/metabox/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/metabox/init.php';
}


add_action( 'cmb2_init', 'cws_register_pa_metabox' );
function cws_register_pa_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_baaz_pa_';
	
	/**
	 * Featured Video
	 */
	$cmb_featured_icon = new_cmb2_box( array(
		'id'           => $prefix . 'icon_metabox',
		'title'        => __( 'Featured Icon', 'baaz-practice-areas' ),
		'object_types' => array( 'cws_practice-area', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true,
	) );
	
	$cmb_featured_icon->add_field( array(
		'name' => __( 'Icon URL', 'baaz-practice-areas' ),
		'id'   => $prefix . 'featured_icon',
		'desc' => __( 'Recommended image size is 90px wide by 90px high.', 'baaz-practice-areas' ),
		'type' => 'file',
	) );
	
	$cmb_featured_icon->add_field( array(
		'name' => __( 'Use Default Icon', 'baaz-practice-areas' ),
		'id'   => $prefix . 'featured_icon_default',
		'desc' => __( '<br/>Availbale CSS Class : bankruptcy, corporate-law, employment-law, estate-planning, litagation, realestate-law, tax-law', 'baaz-practice-areas' ),
		'type' => 'text_medium',
	) );
	
	/**
	 * Featured Video
	 */
	$cmb_featured_video = new_cmb2_box( array(
		'id'           => $prefix . 'video_metabox',
		'title'        => __( 'Feartured Video', 'baaz-practice-areas' ),
		'object_types' => array( 'cws_practice-area', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true,
	) );
	
	$cmb_featured_video->add_field( array(
		'name' => __( 'Video Embed', 'baaz-practice-areas' ),
		'desc' => __( 'Paste your video url to here. See the', 'baaz-practice-areas' ) .  ' <a href="https://codex.wordpress.org/Embeds" target="_blank" >' . __( 'WordPress oEmbed Codex', 'baaz-practice-areas' ) . '</a> ' . __( 'for list of compatible video hosting sites such as YouTube, Vimeo, etc.', 'baaz-practice-areas' ),
		'id'   => $prefix . 'video_oembed',
		'type' => 'oembed',
	) );
	
	$cmb_featured_video->add_field( array(
		'name' => __( 'Video Poster', 'baaz-practice-areas' ),
		'desc' => __( 'Recommended image size is 800px wide by 400px high.', 'baaz-practice-areas' ),
		'id'   => $prefix . 'video_poster',
		'type' => 'file',
	) );
	
	$cmb_featured_video->add_field( array(
		'name' => __( 'Title', 'baaz-practice-areas' ),
		'id'   => $prefix . 'video_title',
		'default' =>  __( 'Client Testimonial', 'baaz-practice-areas' ),
		'type' => 'text',
	) );
	
	$cmb_featured_video->add_field( array(
		'name' => __( 'Description', 'baaz-practice-areas' ),
		'id'   => $prefix . 'video_desc',
		'type' => 'textarea',
	) );
	
	/**
	 * Featured Testimonial
	 */
	$cmb_featured_quote = new_cmb2_box( array(
		'id'           => $prefix . 'quote_metabox',
		'title'        => __( 'Feartured Testimonial', 'baaz-practice-areas' ),
		'object_types' => array( 'cws_practice-area', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true,
	) );
	
	$cmb_featured_quote->add_field( array(
		'name' => __( 'Quote', 'baaz-practice-areas' ),
		'id'   => $prefix . 'quote_text',
		'type' => 'textarea',
	) );
	$cmb_featured_quote->add_field( array(
		'name' => __( 'Name', 'baaz-practice-areas' ),
		'id'   => $prefix . 'quote_name',
		'type' => 'text',
	) );
	$cmb_featured_quote->add_field( array(
		'name' => __( 'Company', 'baaz-practice-areas' ),
		'id'   => $prefix . 'quote_company',
		'type' => 'text',
	) );
	$cmb_featured_quote->add_field( array(
		'name' => __( 'BG Image', 'baaz-practice-areas' ),
		'desc' => __( 'Recommended image size is 1200px wide by 460px high.', 'baaz-practice-areas' ),
		'id'   => $prefix . 'quote_bg',
		'type' => 'file',
		'default' =>  CHILD_URL .'/images/Testimonial-Background.jpg',
	) );
		
}
