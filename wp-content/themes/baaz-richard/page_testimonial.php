<?php

/*
 * Template Name: Testimonial
 *
 */

//* Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Remove the standard loop
remove_action( 'genesis_loop', 'genesis_do_loop' );

// Execute testimonials loop
add_action( 'genesis_loop', 'baaz_testimonials_loop' );
function baaz_testimonials_loop() {
    
	echo '<header class="entry-header"><h1 class="entry-title testimonial">';
	the_title( );
	echo '</h1></header>';

    echo '<div class="testimonials-container">';

	global $wp_query;
	global $post;
	global $paged, $page;

	$query_args = array(
				'post_type' => 'testimonial',
				'showposts' => 10,
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'paged' => get_query_var( 'paged' ),
	);

	$wp_query = new WP_Query( $query_args );

    if ( $wp_query -> have_posts() ) :

        while ( $wp_query -> have_posts() ) :
            $wp_query -> the_post();
            $data = get_post_meta( $wp_query->post->ID, 'testimonial', true );
            ?>
            <div class="testimonial-quote-internal">			
            <?php the_content(); ?>
            </div>
            <div class="client-contact-info-wrap">
            <span class="client-contact-info-internal">
            <?php echo $data['person-name'] . '</span></div><hr>';
        endwhile; 
    endif;

    genesis_posts_nav();

echo '</div>';  // close testimonials-container

//* Restore original query
wp_reset_query();

}

genesis();