<?php

/**
 * Template Name: Testimonial Archives
 * Description: Used as a page template to show page contents, followed by a loop through a CPT archive  
 */

remove_action ('genesis_loop', 'genesis_do_loop'); // Remove the standard loop
add_action( 'genesis_loop', 'custom_do_grid_loop' ); // Add custom loop

function custom_do_grid_loop() {  
  	
	// Intro Text (from page content)
	echo '<div class="page hentry entry">';
	echo '<h1 class="entry-title">'. get_the_title() .'</h1>';
	echo '<div class="entry-content">' . get_the_content() ;

	$args = array(
		'post_type' => 'testimonial', // enter your custom post type
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page'=> '10',  // overrides posts per page in theme settings
	);
	$loop = new WP_Query( $args );
	if( $loop->have_posts() ):
				
		while( $loop->have_posts() ): $loop->the_post(); global $post;
?>
            <div id="testimonials">
            <!-- <blockquote> -->
			<?php the_content($id); ?>
			<!-- </blockquote> -->
            <div class="client-contact-info"><?php the_title($id); ?></div>
            <div class="clearfix"></div>
            </div>
<?php
		endwhile;
		
	endif;
}
	
/** Remove Post Info */
remove_action('genesis_before_post_content','genesis_post_info');
remove_action('genesis_after_post_content','genesis_post_meta');
 
genesis();