<?php

/*
 * Template Name: Testimonial
 *
 */

//* Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Remove the standard loop
remove_action( 'genesis_loop', 'genesis_do_loop' );

// Execute attorneys loop
add_action( 'genesis_loop', 'baaz_testimonials_loop' );
function baaz_testimonials_loop() {


echo '<div class="testimonials-container">';

	global $wp_query;
	global $post;
	global $paged, $page;

	$query_args = array(
				'post_type' => 'cws_testimonial',
				'showposts' => 6,
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'paged' => get_query_var( 'paged' ),
	);

	$wp_query = new WP_Query( $query_args );

			if ( $wp_query -> have_posts() ) :

                while ( $wp_query -> have_posts() ) :
                    $wp_query -> the_post();
                    $post_id = get_the_ID( $post->ID );
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

                    printf( '<div class="testimonial entry" id="testimonial-'.$post_id.'">%s</div>',  $testimonial );

                endwhile;

            genesis_posts_nav();

			endif;

	echo '</div>';

//* Restore original query
wp_reset_query();


}


genesis();