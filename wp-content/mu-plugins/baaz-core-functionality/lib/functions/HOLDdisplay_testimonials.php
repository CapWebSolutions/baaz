<?php
/**
 * General
 *
 * This file contains functions related to display of the testimonials
 *
 * @package      Core_Functionality
 * @since        1.0.0
 * @link         https://github.com/capwebsolutions/bicycleaz-core-functionality
 * @author       Matt Ryan <matt@capwebsolutions.com>
 * @copyright    Copyright (c) 2017, Matt Ryan
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

function cws_display_testimonials() {

$args = array(
    'post_type'         => 'cws_testimonials', 
    'posts_per_page'    => 6, 
    'order'             => 'ASC' );


$loop = new WP_Query( $args );
    echo '<div id="testimonials">';
    if ( $loop->have_posts() ) { 
        while ( $loop->have_posts() ) : $loop->the_post();
            $data = get_post_meta( $loop->post->ID, 'cws_testimonials', true );
            static $count = 0;
            if ( is_front_page() ) {
                if ($count == "1") { ?>
                    <div class="slide" style="display: none;">
                        <div class="testimonial-quote"><?php the_content(); ?></div>
                        <div class="client-contact-info"><?php echo $data[ 'person-name' ]; ?>,&nbsp;<?php echo $data[ 'location' ]; ?></div>
                        <div class="clearfix"></div>
                    </div>
                    <?php 
                } else { ?>
                    <div class="slide">
                        <div class="testimonial-quote"><?php the_content(); ?></div>
                        <div class="client-contact-info"><?php echo $data[ 'person-name' ]; ?>,&nbsp;<?php echo $data[ 'location' ]; ?></div>
                        <div class="clearfix"></div>
                    </div>
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