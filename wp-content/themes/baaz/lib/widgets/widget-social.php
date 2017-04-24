<?php
/**
 * Social Widget
 *
 * Displays links to Facebook, Twitter and Youtube
 *
 */
class cws_Social_Widget extends WP_Widget {

    /**
     * Constructor
     *
     * @return void
     **/
	function __construct() {
		$widget_ops = array( 'classname' => 'widget-social', 'description' => 'Social icon widget' );
		parent::__construct( 'social-widget', 'Cap Web - Social Widget', $widget_ops );
	}

    /**
     * Outputs the HTML for this widget.
     *
     * @param array  An array of standard parameters for widgets in this theme
     * @param array  An array of settings for this widget instance
     * @return void Echoes it's output
     **/
	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );

		// WMPL
		/**
		 * Filter strings for WPML translation
     	 */
     	$instance['title'] = apply_filters( 'wpml_translate_single_string', $instance['title'], 'Widgets', 'Cap Web - Social Widget - Title' );
     	// WPML

		echo $before_widget;
		echo '<h4 class="social-heading">Social Media</h4>';
		if (!empty( $instance['cws_facebook'] ) ) { echo '<a href="'. $instance['cws_facebook'] .'" class="genericon genericon-facebook-alt" target="_blank" title="Facebook">Facebook</a>';}
		if (!empty( $instance['cws_twitter'] ) ) { echo '<a href="'. $instance['cws_twitter'] .'" class="genericon genericon-twitter" target="_blank" title="Twitter">Twitter</a>'; }
		if (!empty( $instance['cws_googleplus'] ) ) { echo '<a href="'. $instance['cws_googleplus'] .'" class="genericon genericon-googleplus-alt" target="_blank" title="Google +">Google +</a>';}
		if (!empty( $instance['cws_youtube'] ) ) { echo '<a href="'. $instance['cws_youtube'] .'" class="genericon genericon-youtube" target="_blank" title="Youtube">Youtube</a>'; }
		if (!empty( $instance['cws_linkedin'] ) ) { echo '<a href="'. $instance['cws_linkedin'] .'" class="genericon genericon-linkedin" target="_blank" title="Linkedin">Linkedin</a>'; }
		if (!empty( $instance['cws_pinterest'] ) ) { echo '<a href="'. $instance['cws_pinterest'] .'" class="genericon genericon-pinterest" target="_blank" title="Pinterest">Pinterest</a>';}
		if (!empty( $instance['cws_instagram'] ) ) { echo '<a href="'. $instance['cws_instagram'] .'" class="genericon genericon-instagram" target="_blank" title="Instagram">Instagram</a>';}
		echo $after_widget;
	}

    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @param array  An array of new settings as submitted by the admin
     * @param array  An array of the previous settings
     * @return array The validated and (if necessary) amended settings
     **/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['cws_facebook'] = esc_url( $new_instance['cws_facebook'] );
		$instance['cws_twitter'] = esc_url( $new_instance['cws_twitter'] );
		$instance['cws_linkedin'] = esc_url( $new_instance['cws_linkedin'] );
		$instance['cws_youtube'] = esc_url( $new_instance['cws_youtube'] );
		$instance['cws_googleplus'] = esc_url( $new_instance['cws_googleplus'] );
		$instance['cws_pinterest'] = esc_url( $new_instance['cws_pinterest'] );
		$instance['cws_instagram'] = esc_url( $new_instance['cws_instagram'] );

		//WMPL
		/**
		 * register strings for translation
     	 */
	 	do_action( 'wpml_register_single_string', 'Widgets', 'Cap Web - Social Widget - Title', $new_instance['title'] );
	 	//WMPL

		return $instance;
	}

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array  An array of the current settings for this widget
     * @return void Echoes it's output
     **/
	function form( $instance ) {

		$defaults = array( 'cws_custom_text'=> '', 'cws_facebook' => '', 'cws_twitter' => '', 'cws_youtube' => '', 'cws_linkedin' => '', 'cws_googleplus' => '','cws_pinterest' => '','cws_instagram' => '', );


		$instance = wp_parse_args( (array) $instance, $defaults ); ?>


		<p><label for="<?php echo $this->get_field_id( 'cws_facebook' ); ?>">Facebook URL: <input class="widefat" id="<?php echo $this->get_field_id( 'cws_facebook' ); ?>" name="<?php echo $this->get_field_name( 'cws_facebook' ); ?>" value="<?php echo $instance['cws_facebook']; ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id( 'cws_twitter' ); ?>">Twitter URL: <input class="widefat" id="<?php echo $this->get_field_id( 'cws_twitter' ); ?>" name="<?php echo $this->get_field_name( 'cws_twitter' ); ?>" value="<?php echo $instance['cws_twitter']; ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id( 'cws_linkedin' ); ?>">LinkedIn URL: <input class="widefat" id="<?php echo $this->get_field_id( 'cws_linkedin' ); ?>" name="<?php echo $this->get_field_name( 'cws_linkedin' ); ?>" value="<?php echo $instance['cws_linkedin']; ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id( 'cws_youtube' ); ?>">Youtube URL: <input class="widefat" id="<?php echo $this->get_field_id( 'cws_youtube' ); ?>" name="<?php echo $this->get_field_name( 'cws_youtube' ); ?>" value="<?php echo $instance['cws_youtube']; ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id( 'cws_googleplus' ); ?>">Google+ URL: <input class="widefat" id="<?php echo $this->get_field_id( 'cws_googleplus' ); ?>" name="<?php echo $this->get_field_name( 'cws_googleplus' ); ?>" value="<?php echo $instance['cws_googleplus']; ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id( 'cws_pinterest' ); ?>">Pinterest URL: <input class="widefat" id="<?php echo $this->get_field_id( 'cws_pinterest' ); ?>" name="<?php echo $this->get_field_name( 'cws_pinterest' ); ?>" value="<?php echo $instance['cws_pinterest']; ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id( 'cws_instagram' ); ?>">Instagram URL: <input class="widefat" id="<?php echo $this->get_field_id( 'cws_instagram' ); ?>" name="<?php echo $this->get_field_name( 'cws_instagram' ); ?>" value="<?php echo $instance['cws_instagram']; ?>" /></label></p>

		<?php

	}
}

add_action( 'widgets_init', create_function( '', "register_widget('cws_Social_Widget');" ) );