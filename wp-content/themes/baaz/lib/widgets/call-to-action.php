<?php
/**
 * Modification of the baaz Featured Page Widget
 * to add customizable text area option.
 *
 */


add_action( 'widgets_init', create_function( '', "register_widget('WSM_CTA_Widget');" ) );


class WSM_CTA_Widget extends WP_Widget {

	/**
	 * Constructor. Set the default widget options and create widget.
	 */
	function __construct() {
		$widget_ops = array( 'classname' => 'cws-cta-widget', 'description' => __('Displays icons and customizable headline and Link', 'baaz') );
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'cws-sidebar-cta-widget' );
		parent::__construct( 'cws-sidebar-cta-widget', __('Cap Web - CTA', 'baaz'), $widget_ops, $control_ops );
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
			'title' => '',
			'cws-morelink' => '',
			'cws-moretarget' => '',
			'cws-cta-icon' => '',
			'cws-cta-icon-html' => '',
			'cws-cta-icon-url' => '',
		) );

		$before_title = $after_title = '';

		// WMPL
		/**
		 * Filter strings for WPML translation
     	 */
     	$instance['title'] = apply_filters( 'wpml_translate_single_string', $instance['title'], 'Widgets', 'Cap Web - CTA - Title' );
     	$instance['cws-morelink'] = apply_filters( 'wpml_translate_single_string', $instance['cws-morelink'], 'Widgets', 'Cap Web - CTA - Link' );
     	$instance['cws-cta-icon'] = apply_filters( 'wpml_translate_single_string', $instance['cws-cta-icon'], 'Widgets', 'Cap Web - CTA - Included Icon' );
     	$instance['cws-cta-icon-html'] = apply_filters( 'wpml_translate_single_string', $instance['cws-cta-icon-html'], 'Widgets', 'Cap Web - CTA - HTML Icon' );
     	$instance['cws-cta-icon-url'] = apply_filters( 'wpml_translate_single_string', $instance['cws-cta-icon-url'], 'Widgets', 'Cap Web - CTA - Icon URL' );
     	// WPML

		echo $before_widget;

			// Set up the CTA's

			echo '<div class="cta-wrap">';

			// CTA 1

			//if (!empty( $instance['cws-title'] ) ) {

			echo '<div class="cta-box cta-box">';

			if (!empty( $instance['cws-morelink'] ) ) {	echo'<a href="'. esc_attr( $instance['cws-morelink'] ) . '" target="'. $instance['cws-moretarget'] .'">'; }

			else {	echo'<a href="#">'; }

					if (!empty( $instance['cws-cta-icon'] ) ) {
						$icon1 = wp_kses_post($instance['cws-cta-icon']);
								echo '<span class="' . $icon1 . ' cta-icon">Icon</span>';
					}

					elseif (!empty( $instance['cws-cta-icon-html'] ) ) {
						$icon2 = wp_kses_post($instance['cws-cta-icon-html']);
								echo $icon2;
					}

					elseif ( !empty( $instance['cws-cta-icon-url'] ) ) {
						echo '<img class="cta-icon" height="52" width="64" src="'. esc_attr( $instance['cws-cta-icon-url'] ) . '" alt="'. strip_tags( $instance['cws-title'] ) . '"/>';
					}

					//$title1 = wp_kses_post($instance['cws-title']);

						echo '<span class="cta-title">';
							//echo $title1 ;
							if ( ! empty( $instance['title'] ) )
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
						echo '</span>';

				echo'</a>';

				echo '</div>';

			//}

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
		$new_instance['title']     = strip_tags( $new_instance['title'] );
		$new_instance['cws-morelink'] = strip_tags( $new_instance['cws-morelink'] );
		$new_instance['cws-moretarget'] = strip_tags( $new_instance['cws-moretarget'] );
		$new_instance['cws-cta-icon'] = stripslashes( $new_instance['cws-cta-icon'] );
		$new_instance['cws-cta-icon-html'] = stripslashes( $new_instance['cws-cta-icon-html'] );
		$new_instance['cws-cta-icon-url'] = strip_tags( $new_instance['cws-cta-icon-url'] );;

		//WMPL
		/**
		 * register strings for translation
     	 */
	 	do_action( 'wpml_register_single_string', 'Widgets', 'Cap Web - CTA - Title', $new_instance['title'] );
	 	do_action( 'wpml_register_single_string', 'Widgets', 'Cap Web - CTA - Link', $new_instance['cws-morelink'] );
	 	do_action( 'wpml_register_single_string', 'Widgets', 'Cap Web - CTA - Included Icon', $new_instance['cws-cta-icon'] );
	 	do_action( 'wpml_register_single_string', 'Widgets', 'Cap Web - CTA - HTML Icon', $new_instance['cws-cta-icon-html'] );
	 	do_action( 'wpml_register_single_string', 'Widgets', 'Cap Web - CTA - Icon URL', $new_instance['cws-cta-icon-url'] );
	 	//WMPL

		return $new_instance;
	}

	/** Echo the settings update form.
	 *
	 * @param array $instance Current settings
	 */
	function form($instance) {

		$instance = wp_parse_args( (array)$instance, array(
			'title' => '',
			'cws-morelink' => '',
			'cws-moretarget' => '',
			'cws-cta-icon' => '',
			'cws-cta-icon-html' => '',
			'cws-cta-icon-url' => '',
		) );


		$icon_html = esc_textarea($instance['cws-cta-icon-html']);

?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'baaz' ); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>

		<p><label for="<?php echo $this->get_field_id('cws-morelink'); ?>"><?php _e('Link', 'baaz'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id('cws-morelink'); ?>" name="<?php echo $this->get_field_name('cws-morelink'); ?>" value="<?php echo esc_attr( $instance['cws-morelink'] ); ?>" class="widefat" /></p>

		<p><label for="<?php echo $this->get_field_id('cws-moretarget'); ?>"><?php _e('Link Target', 'baaz'); ?></label>
			<select id="<?php echo $this->get_field_id('cws-moretarget'); ?>" name="<?php echo $this->get_field_name('cws-moretarget'); ?>">
				<option value="_self" <?php selected('_self', $instance['cws-moretarget']); ?>><?php _e('_self', 'baaz'); ?></option>
				<option value="_blank" <?php selected('_blank', $instance['cws-moretarget']); ?>><?php _e('_blank', 'baaz'); ?></option>
			</select>
		</p>

		<hr style=" height: 2px; border-top: 1px solid #CCC; margin-bottom: 10px;">

		<p><?php _e( 'Use either an Included Icon, HTML Icon from Google Material Icons or Genericons, or your uploaded image Icon URL below', 'baaz' ); ?></p>

		<p><label for="<?php echo $this->get_field_id('cws-cta-icon'); ?>"><?php _e('Included Icon', 'baaz'); ?></label>
			<select id="<?php echo $this->get_field_id('cws-cta-icon'); ?>" name="<?php echo $this->get_field_name('cws-cta-icon'); ?>">
				<option value="" <?php selected('none', $instance['cws-cta-icon']); ?>><?php _e('none', 'baaz'); ?></option>
				<option value="bankruptcy" <?php selected('bankruptcy', $instance['cws-cta-icon']); ?>><?php _e('bankruptcy', 'baaz'); ?></option>
				<option value="corporate-law" <?php selected('corporate-law', $instance['cws-cta-icon']); ?>><?php _e('corporate-law', 'baaz'); ?></option>
				<option value="employment-law" <?php selected('employment-law', $instance['cws-cta-icon']); ?>><?php _e('employment-law', 'baaz'); ?></option>
				<option value="estate-planning" <?php selected('estate-planning', $instance['cws-cta-icon']); ?>><?php _e('estate-planning', 'baaz'); ?></option>
				<option value="litagation" <?php selected('litagation', $instance['cws-cta-icon']); ?>><?php _e('litagation', 'baaz'); ?></option>
				<option value="realestate-law" <?php selected('realestate-law', $instance['cws-cta-icon']); ?>><?php _e('realestate-law', 'baaz'); ?></option>
				<option value="tax-law" <?php selected('tax-law', $instance['cws-cta-icon']); ?>><?php _e('tax-law', 'baaz'); ?></option>
			</select>
		</p>

		<p><label for="<?php echo $this->get_field_id( 'cws-cta-icon-html' ); ?>"><?php _e( 'HTML Icon', 'baaz' ); ?></label>
		<textarea class="widefat" rows="2" cols="10" id="<?php echo $this->get_field_id( 'cws-cta-icon-html' ); ?>" name="<?php echo $this->get_field_name( 'cws-cta-icon-html' ); ?>"><?php echo $icon_html; ?></textarea>
		</p>

		<p><label for="<?php echo $this->get_field_id('cws-cta-icon-url'); ?>"><?php _e('Icon url ', 'baaz'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id('cws-cta-icon-url'); ?>" name="<?php echo $this->get_field_name('cws-cta-icon-url'); ?>" value="<?php echo esc_attr( $instance['cws-cta-icon-url'] ); ?>" class="widefat" />
		<br /><small><em><?php _e( 'Recommended size: 64px by 64px.', 'baaz' ); ?></em></small>
		</p>

	<?php
	}
}