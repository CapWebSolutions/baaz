<?php
/**
 * Modification of the Genesis Featured Page Widget
 * to add customizable text area option.
 *
 */


add_action( 'widgets_init', create_function( '', "register_widget('WSM_Featured_Video');" ) );


class WSM_Featured_Video extends WP_Widget {

	/**
	 * Constructor. Set the default widget options and create widget.
	 */
	function __construct() {
		$widget_ops = array( 'classname' => 'cws-featured-video', 'description' => __('Displays Custom Text and Video', 'baaz') );
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'cws-featured-video' );
		parent::__construct( 'cws-featured-video', __('Cap Web - Featured Video', 'baaz'), $widget_ops, $control_ops );
		add_action('admin_enqueue_scripts', array($this, 'upload_scripts'));
	}

	/**
	 * Upload the Javascripts for the media uploader
	 */
	public function upload_scripts() {

		wp_enqueue_script( 'media-upload' );
		wp_enqueue_script( 'thickbox' );
		wp_enqueue_script( 'upload_media_widget', BAAZ_JS . '/upload-media.js', array( 'jquery' ) );

		wp_enqueue_style( 'thickbox' );

	}

	/**
	 * Echo the widget content.
	 *
	 * @param array $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * @param array $instance The settings for the particular instance of the widget
	 */
	function widget( $args, $instance ) {
		extract( $args );

		$instance = wp_parse_args( (array) $instance, array(
			'cws-video_url' => '',
			'cws-video_heading' => '',
			'cws-video_text' => '',
			'cws-text-alignment' => '',
		) );

		// WMPL
		/**
		 * Filter strings for WPML translation
     	 */
     	$instance['cws-video_url'] = apply_filters( 'wpml_translate_single_string', $instance['cws-video_url'], 'Widgets', 'Cap Web - Featured Video - Youtube Video URL' );
     	$instance['cws-video_heading'] = apply_filters( 'wpml_translate_single_string', $instance['cws-video_heading'], 'Widgets', 'Cap Web - Featured Video - Title' );
     	$instance['cws-video_text'] = apply_filters( 'wpml_translate_single_string', $instance['cws-video_text'], 'Widgets', 'Cap Web - Featured Video - ideo Caption' );
     	// WPML

		echo $before_widget;

		echo '<div class="featured_video-wrap '. $instance['cws-text-alignment'] .'">';

		$video_url = esc_attr( $instance['cws-video_url'] );
		$video_poster = esc_attr( $instance['cws-image'] );


		if( !empty( $video_url ) ) {

			if ( function_exists( 'fvc_video' ) ) {

				fvc_video( $video_url, $video_poster );

			} else {

				echo '<div class="video-file video-url">';

				echo wp_oembed_get( $video_url, array( 'width' => 160, 'height' => 90 ) );

				echo '</div>';

			}

		}

		$video_text = wp_kses_post($instance['cws-video_text']);
		$video_heading = wp_kses_post($instance['cws-video_heading']);

		echo '<div class="video-caption">';

		echo '<div class="video-text">';
			if(!empty($instance['cws-video_heading'])) {	echo '<h4 class="widget-title widgettitle">' . $video_heading . '</h4>';	}
			if(!empty($instance['cws-video_text'])) {	echo $video_text ;	}
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
	function update( $new_instance, $old_instance ) {
		$new_instance['cws-video_url'] = strip_tags( $new_instance['cws-video_url'] );
		$new_instance['cws-image'] = $new_instance['cws-image'];
		$new_instance['cws-text-alignment'] = strip_tags( $new_instance['cws-text-alignment'] );
		$new_instance['cws-video_heading'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['cws-video_heading']) ) );
		$new_instance['cws-video_text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['cws-video_text']) ) );

		//WMPL
		/**
		 * register strings for translation
     	 */
	 	do_action( 'wpml_register_single_string', 'Widgets', 'Cap Web - Featured Video - Youtube Video URL', $new_instance['cws-video_url'] );
	 	do_action( 'wpml_register_single_string', 'Widgets', 'Cap Web - Featured Video - Cover Image', $new_instance['cws-image'] );
	 	do_action( 'wpml_register_single_string', 'Widgets', 'Cap Web - Featured Video - Title', $new_instance['cws-video_heading'] );
	 	do_action( 'wpml_register_single_string', 'Widgets', 'Cap Web - Featured Video - Video Caption', $new_instance['cws-video_text'] );
	 	//WMPL

		return $new_instance;
	}

	/** Echo the settings update form.
	 *
	 * @param array $instance Current settings
	 */
	function form( $instance ) {

		$instance = wp_parse_args( (array)$instance, array(
			'cws-video_url' => '',
			'cws-image' => '',
			'cws-video_heading' => '',
			'cws-video_text' => '',
			'cws-text-alignment',
		) );

		$video_heading = esc_attr($instance['cws-video_heading']);
		$video_text = esc_attr($instance['cws-video_text']);

		$image = '';
        if( isset( $instance['cws-image'] ) ) {
            $image = $instance['cws-image'];
        }

	?>

		<p><label for="<?php echo $this->get_field_id('cws-video_url'); ?>"><?php _e( 'Video URL', 'baaz' ); ?></label>
		<input type="text" id="<?php echo $this->get_field_id('cws-video_url'); ?>" name="<?php echo $this->get_field_name('cws-video_url'); ?>" value="<?php echo esc_attr( $instance['cws-video_url'] ); ?>" class="widefat" /><br><small><?php _e( '(See the WordPress oEmbed list)', 'baaz' ); ?></small></p>

		<p><label for="<?php echo $this->get_field_name( 'cws-image' ); ?>"><?php _e( 'Cover Image', 'baaz' ); ?></label><input name="<?php echo $this->get_field_name( 'cws-image' ); ?>" id="<?php echo $this->get_field_id( 'cws-image' ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url( $image ); ?>" /><input class="upload_image_button button button-primary" type="button" value="<?php _e( 'Upload Image', 'baaz' ); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('cws-video_heading'); ?>"><?php _e('Title', 'baaz'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id('cws-video_heading'); ?>" name="<?php echo $this->get_field_name('cws-video_heading'); ?>" value="<?php echo esc_attr( $instance['cws-video_heading'] ); ?>" class="widefat" /></p>

		<p><label for="<?php echo $this->get_field_id('cws-video_text'); ?>"><?php _e( 'Video Caption', 'baaz' ); ?></label><textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('cws-video_text'); ?>" name="<?php echo $this->get_field_name('cws-video_text'); ?>"><?php echo $video_text; ?></textarea></p>

		<p><label for="<?php echo $this->get_field_id('cws-text-alignment'); ?>"><?php _e('Caption Alignment', 'baaz'); ?></label>
			<select id="<?php echo $this->get_field_id('cws-text-alignment'); ?>" name="<?php echo $this->get_field_name('cws-text-alignment'); ?>">
				<option value="left-caption" <?php selected('left-caption', $instance['cws-text-alignment']); ?>><?php _e( 'Left', 'baaz' ); ?></option>
				<option value="right-caption" <?php selected('right-caption', $instance['cws-text-alignment']); ?>><?php _e( 'Right', 'baaz' ); ?></option>
			</select>
		</p>
	<?php
	}
}