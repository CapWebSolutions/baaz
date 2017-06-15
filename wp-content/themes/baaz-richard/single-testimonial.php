<?php


//* Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Remove the standard loop
remove_action( 'genesis_loop', 'genesis_do_loop' );



// Execute testimonial Single Content

add_action( 'genesis_loop', 'baaz_testimonial_page' );
function baaz_testimonial_page() {

	global $post;
	$post_id = get_the_ID( $post->ID );

	echo '<header class="entry-header"><h1 class="entry-title testimonial">';
	the_title( );
	echo '</h1></header>';

	// Contact Details
	$args = array(
		'post_type'         => 'testimonial', 
		'posts_per_page'    => 1, 
		'order'             => 'ASC',
		'p'					=> $post_id,
		);
	$wp_query = new WP_Query( $args );

	if ( $wp_query->have_posts() ) { 
		while ( $wp_query->have_posts() ) : $wp_query->the_post();
			$data = get_post_meta( $wp_query->post->ID, 'testimonial', true );
			?>
			<!--<div class="h1">Testimonial of: </h1>-->
			<div class="testimonial-quote-internal">			
			<?php the_content(); ?>
			</div>
			<div class="client-contact-info-wrap">
			<span class="client-contact-info-internal">
			<?php echo $data['person-name'] . ', '; ?>
			<?php echo $data['location'];
			echo '</span></div>';
		endwhile; 
	}

			//* Restore original query
	wp_reset_query();

}

genesis();