<?php
/**
 * Modification of the Genesis Featured Page Widget
 * to add customizable text area option.
 *
 */


add_action( 'widgets_init', create_function( '', "register_widget('CWS_Featured_Widget');" ) );


class CWS_Featured_Widget extends WP_Widget {

	/**
	 * Constructor. Set the default widget options and create widget.
	 */
	function __construct() {
		$widget_ops = array( 'classname' => 'cws-featured-widget', 'description' => __('Displays featured image/video and customizable text and Link', 'james') );
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'cws-featured-widget' );
		parent::__construct( 'cws-featured-widget', __('Cap Web - Featured Widget', 'baaz'), $widget_ops, $control_ops );
	}

	/**
	 * Echo the widget content.
	 *
	 * @param array $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * @param array $instance The settings for the particular instance of the widget
	 */
	function widget($args, $instance) {
		extract($args);

		$instance = wp_parse_args( (array) $instance, array(
			'cws-title' => '',
			'cws-content' => '',
			'cws-moretext' => '',
			'cws-morelink' => '',
			'cws-moretarget' => '',
			'cws-text-alignment' => '',
			'cws-image-url' => '',
		) );


		// WMPL
		/**
		 * Filter strings for WPML translation
     	 */
     	$instance['cws-title'] = apply_filters( 'wpml_translate_single_string', $instance['cws-title'], 'Widgets', 'Cap Web - Featured Widget - Title' );
     	$instance['cws-content'] = apply_filters( 'wpml_translate_single_string', $instance['cws-content'], 'Widgets', 'Cap Web - Featured Widget - Custom Text' );
     	$instance['cws-moretext'] = apply_filters( 'wpml_translate_single_string', $instance['cws-moretext'], 'Widgets', 'Cap Web - Featured Widget - More Text' );
     	$instance['cws-moretarget'] = apply_filters( 'wpml_translate_single_string', $instance['cws-moretarget'], 'Widgets', 'Cap Web - Featured Widget - More Link' );
     	$instance['cws-image-url'] = apply_filters( 'wpml_translate_single_string', $instance['cws-image-url'], 'Widgets', 'Cap Web - Featured Widget - Image URL' );
     	// WPML

		echo $before_widget;

		echo '<div class="text-content-wrap '. $instance['cws-text-alignment'] .'">';

		if(!empty($instance['cws-image-url'])) {
			echo '<img style="border: 0;" class="featured-image" src="' . esc_attr($instance['cws-image-url']) .'" alt="' . strip_tags($instance['cws-title']) .'"/>';
		}

		echo '<div class="featured-content">';

		if ( ! empty( $instance['cws-title'] ) ) {
			$heading = wp_kses_post($instance['cws-title']);
			echo '<h4 class="widget-title widgettitle">'. $heading .'</h4>';
		}

		if(!empty($instance['cws-content'])) {
			$text = wp_kses_post($instance['cws-content']);
			echo do_shortcode($text);
			if(!empty($instance['cws-moretext'])) :
			echo '<span class="more-link"><a href="'. esc_attr($instance['cws-morelink']) .'" target="'. esc_attr($instance['cws-moretarget']) .'">' . esc_attr($instance['cws-moretext']) .'</a></span>';
			endif;
		}

		echo '</div>';

		echo '</div>';

		echo "\n\n";


		echo $after_widget;
		wp_reset_query();
	}

	/** Update a particular instance.
	 *
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the instance won't be saved/updated.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via form()
	 * @param array $old_instance Old settings for this instance
	 * @return array Settings to save or bool false to cancel saving
	 */
	function update($new_instance, $old_instance) {
		$new_instance['cws-title'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['cws-title']) ) );
		$new_instance['cws-content'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['cws-content']) ) );
		$new_instance['cws-moretext'] = strip_tags( $new_instance['cws-moretext'] );
		$new_instance['cws-morelink'] = strip_tags( $new_instance['cws-morelink'] );
		$new_instance['cws-moretarget'] = strip_tags( $new_instance['cws-moretarget'] );
		$new_instance['cws-text-alignment'] = strip_tags( $new_instance['cws-text-alignment'] );
		$new_instance['cws-image-url'] = strip_tags( $new_instance['cws-image-url'] );

		//WMPL
		/**
		 * register strings for translation
     	 */
	 	do_action( 'wpml_register_single_string', 'Widgets', 'Cap Web - Featured Widget - Title', $new_instance['cws-title'] );
	 	do_action( 'wpml_register_single_string', 'Widgets', 'Cap Web - Featured Widget - Custom Text', $new_instance['cws-content'] );
	 	do_action( 'wpml_register_single_string', 'Widgets', 'Cap Web - Featured Widget - More Text', $new_instance['cws-moretext'] );
	 	do_action( 'wpml_register_single_string', 'Widgets', 'Cap Web - Featured Widget - More Link', $new_instance['cws-morelink'] );
	 	do_action( 'wpml_register_single_string', 'Widgets', 'Cap Web - Featured Widget - Image URL', $new_instance['cws-image-url'] );
	 	//WMPL

		return $new_instance;
	}

	/** Echo the settings update form.
	 *
	 * @param array $instance Current settings
	 */
	function form($instance) {

		$instance = wp_parse_args( (array)$instance, array(
			'cws-title' => '',
			'cws-content' => '',
			'cws-moretext' => '',
			'cws-morelink' => '',
			'cws-moretarget' => '',
			'cws-text-alignment' => '',
			'cws-image-url' => '',
		) );

		$title = esc_attr($instance['cws-title']);
		$content = esc_attr($instance['cws-content']);

	?>

		<p><label for="<?php echo $this->get_field_id('cws-title'); ?>"><?php _e('Title', 'james'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('cws-title'); ?>" name="<?php echo $this->get_field_name('cws-title'); ?>" value="<?php echo $title; ?>" class="widefat" /></p>

		<p><label for="<?php echo $this->get_field_id('cws-content'); ?>"><?php _e('Custom Text'); ?></label><textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('cws-content'); ?>" name="<?php echo $this->get_field_name('cws-content'); ?>"><?php echo $content; ?></textarea></p>

		<p><label for="<?php echo $this->get_field_id('cws-text-alignment'); ?>"><?php _e('Text Alignment', 'james'); ?>: </label>
			<select id="<?php echo $this->get_field_id('cws-text-alignment'); ?>" name="<?php echo $this->get_field_name('cws-text-alignment'); ?>">
				<option value="center-text" <?php selected('center-text', $instance['cws-text-alignment']); ?>><?php _e('Center', 'james'); ?></option>
				<option value="left-text" <?php selected('left-text', $instance['cws-text-alignment']); ?>><?php _e('Left', 'james'); ?></option>
				<option value="right-text" <?php selected('right-text', $instance['cws-text-alignment']); ?>><?php _e('Right', 'james'); ?></option>
			</select>
		</p>

		<p><label for="<?php echo $this->get_field_id('cws-moretext'); ?>"><?php _e('More Text', 'james'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('cws-moretext'); ?>" name="<?php echo $this->get_field_name('cws-moretext'); ?>" value="<?php echo esc_attr( $instance['cws-moretext'] ); ?>" class="widefat" /></p>

		<p><label for="<?php echo $this->get_field_id('cws-morelink'); ?>"><?php _e('More Link', 'james'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('cws-morelink'); ?>" name="<?php echo $this->get_field_name('cws-morelink'); ?>" value="<?php echo esc_attr( $instance['cws-morelink'] ); ?>" class="widefat" /></p>

		<p><label for="<?php echo $this->get_field_id('cws-moretarget'); ?>"><?php _e('Link Target', 'james'); ?>: </label>
			<select id="<?php echo $this->get_field_id('cws-moretarget'); ?>" name="<?php echo $this->get_field_name('cws-moretarget'); ?>">
				<option value="_self" <?php selected('_self', $instance['cws-moretarget']); ?>><?php _e('_self', 'james'); ?></option>
				<option value="_blank" <?php selected('_blank', $instance['cws-moretarget']); ?>><?php _e('_blank', 'james'); ?></option>
			</select>
		</p>


		<p><label for="<?php echo $this->get_field_id('cws-image-url'); ?>"><?php _e('Image URL', 'james'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('cws-image-url'); ?>" name="<?php echo $this->get_field_name('cws-image-url'); ?>" value="<?php echo esc_attr( $instance['cws-image-url'] ); ?>" class="widefat" /></p>

	<?php
	}
}