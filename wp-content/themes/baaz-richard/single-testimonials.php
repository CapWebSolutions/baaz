<?php

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

	$quote_comments = get_post_meta( $post_id , '_baaz_testimonial_quote_comments', true );
	$quote_name = get_post_meta( $post_id , '_baaz_testimonial_quote_name', true );
	$quote_location = get_post_meta( $post_id , '_baaz_testimonial_quote_location', true );

	$testimonial = '';
	$testimonial .= '<div class="testimonial-container">';
	$testimonial .= '<blockquote>';
	$testimonial .= strip_tags( $quote_comments );
	$testimonial .= '</blockquote>';
	$testimonial .= '<p class="quote-meta">'. $quote_name .', ' . $quote_location . '</p>';
	$testimonial .= '</div>';


	if(!empty( $quote_comments )) {

	echo '<div class="wsm-featured-testimonial"'. $do_bg .'><div class="wrap">';
			echo '<blockquote>';
			echo strip_tags( $quote_comments );
			echo '</blockquote>';
			echo '<p class="quote-name">'. $quote_name .', ' . $quote_location . '</p>';

	echo '</div></div>';

	}


}

genesis();