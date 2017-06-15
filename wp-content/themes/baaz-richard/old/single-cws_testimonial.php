<?php
echo 'in single-cws_testimonial.php';

//* Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Remove the standard loop
remove_action( 'genesis_loop', 'genesis_do_loop' );

// Execute Practice Single Content

add_action( 'genesis_loop', 'baaz_testimonial' );
function baaz_testimonial() {

global $post;

$post_id = get_the_ID( $post->ID );

echo '<div class="testimonial-container">';

// Featured Testimonial

echo '<div id="testimonials">';
	echo '<div class="one-fourth first">';
		echo '<div class="quote-obtuse"><div class="pic">'. get_the_post_thumbnail( $id, array(150,150) ).'</div></div>';
		echo '<div style="margin-top:20px;line-height:20px;text-align:right;"><cite>'.genesis_get_custom_field( '_cd_client_name' ).'</cite><br />'.genesis_get_custom_field( '_cd_client_title' ).'</div>';
		echo '</div>';	
		echo '<div class="three-fourths" style="border-bottom:1px solid #DDD;">';
		echo '<h3>' . get_the_title() . '</h3>';
		echo '<blockquote><p>' . get_the_content() . '</p></blockquote>';	
	echo '</div>';
echo '</div>';

genesis();