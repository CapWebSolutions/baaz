<?php 
/*
Plugin Name: Rotating Testimonials
Version: 0.1
Plugin URI: http://www.wpbeginner.com/
Description: Rotating testimonials is a plugin that lets you add rotating testimonials in WordPress
Author: WPBeginner
Author URI: http://www.wpbeginner.com/
*/

add_action( 'init', 'wpb_register_cpt_testimonial' );

function wpb_register_cpt_testimonial() {

    $labels = array( 
        'name' => _x( 'Testimonials', 'testimonial' ),
        'singular_name' => _x( 'Testimonial', 'testimonial' ),
        'add_new' => _x( 'Add New', 'testimonial' ),
        'add_new_item' => _x( 'Add New testimonial', 'testimonial' ),
        'edit_item' => _x( 'Edit testimonial', 'testimonial' ),
        'new_item' => _x( 'New testimonial', 'testimonial' ),
        'view_item' => _x( 'View testimonial', 'testimonial' ),
        'search_items' => _x( 'Search testimonials', 'testimonial' ),
        'not_found' => _x( 'No testimonials found', 'testimonial' ),
        'not_found_in_trash' => _x( 'No testimonials found in Trash', 'testimonial' ),
        'parent_item_colon' => _x( 'Parent testimonial:', 'testimonial' ),
        'menu_name' => _x( 'Testimonials', 'testimonial' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        
        'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'genesis-cpt-archives-settings' ),
        
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'testimonial', $args );
}

$key = "testimonial";
$meta_boxes = array(
    "person-name" => array(
        "name" => "person-name",
        "title" => "Person's Name",
        "description" => "Enter the name of the person who gave you the testimonial."
        ),
    "location" => array(
        "name" => "location",
        "title" => "Location",
        "description" => "Enter their location (city, state)."
        ),
);
 
function wpb_create_meta_box() {
global $key;
 
if( function_exists( 'add_meta_box' ) ) {
    add_meta_box( 'new-meta-boxes', ucfirst( $key ) . ' Information', 'display_meta_box', 'testimonial', 'normal', 'high' );
    }
}
 
function display_meta_box() {
global $post, $meta_boxes, $key;
?>
 
<div class="form-wrap">
 
<?php
wp_nonce_field( plugin_basename( __FILE__ ), $key . '_wpnonce', false, true );
 
foreach($meta_boxes as $meta_box) {
$data = get_post_meta($post->ID, $key, true);
?>
 
<div class="form-field form-required">
<label for="<?php echo $meta_box[ 'name' ]; ?>"><?php echo $meta_box[ 'title' ]; ?></label>
<input type="text" name="<?php echo $meta_box[ 'name' ]; ?>" value="<?php echo (isset($data[ $meta_box[ 'name' ] ]) ? htmlspecialchars( $data[ $meta_box[ 'name' ] ] ) : ''); ?>" />
<p><?php echo $meta_box[ 'description' ]; ?></p>
</div>
 
<?php } ?>
 
</div>
<?php
}
 
function wpb_save_meta_box( $post_id ) {
global $post, $meta_boxes, $key;
 
foreach( $meta_boxes as $meta_box ) {
if (isset($_POST[ $meta_box[ 'name' ] ])) {
$data[ $meta_box[ 'name' ] ] = $_POST[ $meta_box[ 'name' ] ];
}
}
 
if (!isset($_POST[ $key . '_wpnonce' ])) 
return $post_id;

if ( !wp_verify_nonce( $_POST[ $key . '_wpnonce' ], plugin_basename(__FILE__) ) )
return $post_id;
 
if ( !current_user_can( 'edit_post', $post_id ))
return $post_id;
 
update_post_meta( $post_id, $key, $data );
}
 
add_action( 'admin_menu', 'wpb_create_meta_box' );
add_action( 'save_post', 'wpb_save_meta_box' );



function wpb_display_testimonials() { ?>
<script> 
jQuery(document).ready(function(){
    // jQuery(function($){
	jQuery('#testimonials .slide');
	setInterval(function(){
		jQuery('#testimonials .slide').filter(':visible').fadeOut(1000,function(){
			if(jQuery(this).next('.slide').size()){
				jQuery(this).next().fadeIn(1000);
			}
			else{
				jQuery('#testimonials .slide').eq(0).fadeIn(1000);
			}
		});
	},4000);	
});	
</script> 
<style type='text/css'>
#testimonials .slide {
    color: #9c968e;
    }
#testimonials .client-contact-info {
    margin: 0 0 25px 0; 
    float: right;
    font-weight: lighter;
    font-size: 18px; 
    }
#testimonials .client-contact-info-internal {
    margin: 0 0 25px 0; 
    /*float: right;*/
    text-align: center;
    font-weight: lighter;
    font-size: 18px; 
    }    
#testimonials .testimonial-quote {
    text-align: center;
    padding: 3px 0 0 0;   
    line-height: 1.5em; 
    font-size: 20px; 
    font-style: italic; 
    margin: 10px 0 0 0;
    }
#testimonials .testimonial-quote-internal {
    text-align: center;
    padding: 3px 0 0 0;   
    line-height: 1.5em; 
    font-size: 20px; 
    font-style: italic; 
    margin: 10px 0 0 0;
    }          
#testimonials p {
    margin: 0;
}
</style>
<div id="testimonials">
<?php
$args = array(
    'post_type'         => 'testimonial', 
    'posts_per_page'    => 6, 
    'order'             => 'ASC' );
$loop = new WP_Query( $args );

    if ( $loop->have_posts() ) { 
        while ( $loop->have_posts() ) : $loop->the_post();
            $data = get_post_meta( $loop->post->ID, 'testimonial', true );
            static $count = 0;
            if ( is_front_page() ) {
                if ($count == "1") { ?>
                    <div class="slide" style="display: none;">
                        <div class="testimonial-quote"><?php the_content(); ?></div>
                        <div class="client-contact-info"><?php echo $data[ 'person-name' ]; ?>,&nbsp;<?php echo $data[ 'location' ]; ?></div>
                        <div class="clearfix"></div></div>
                    <?php 
                } else { ?>
                    <div class="slide">
                        <div class="testimonial-quote"><?php the_content(); ?></div>
                        <div class="client-contact-info"><?php echo $data[ 'person-name' ]; ?>,&nbsp;<?php echo $data[ 'location' ]; ?></div>
                        <div class="clearfix"></div></div>
                    <?php
                    $count++;
                }
            } else {
                $my_testimonial = "";
                $my_testimonial .= sprintf('<div class="testimonial-quote-internal">%s</div>', the_content());
                $my_testimonial .= sprintf('<div class="client-contact-info-internal">');
                $my_testimonial .= $data['person-name'];
                $my_testimonial .= $data['location'] . '</div>';
                echo $my_testimonial;
                $count++;
            } 
        endwhile; 
    }
echo '</div>';
}
?>