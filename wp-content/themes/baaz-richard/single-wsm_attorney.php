<?php


//* Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Remove the standard loop
remove_action( 'genesis_loop', 'genesis_do_loop' );

// Execute Attorney Single Content

add_action( 'genesis_loop', 'richard_attorney_page' );
function richard_attorney_page() {

global $post;

$post_id = get_the_ID( $post->ID );

echo '<header class="entry-header"><h1 class="entry-title attorney">';
the_title( );
echo '</h1></header><br>';

// Contact Details

$attorney_img = genesis_get_image( array( 'format' => 'html', 'size' => 'attorney', 'attr' => array( 'class' => 'featured-image alignone' ) ) );
$attorney_contact_heading = get_post_meta( $post_id , '_richard_attorney_contact_heading', true );

echo '<div class="attorney-left-info">';

echo $attorney_img;

echo '<div class="left-info">';

echo '</div>';

echo '</div>';


// Main Content

echo '<div class="attorney-content entry-content">';

	$short_desc = get_post_meta( $post_id , '_richard_attorney_short_desc', true );

	if ( $short_desc ) { echo '<div class="intro-text">' . $short_desc .'</div>'; }

		//* Restore original query
	wp_reset_query();


	 the_content($post_id);

	echo '</div>';

}

genesis();