<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'baaz_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category Core_Functionality
 * @package  BAAZ
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/CMB2/CMB2
 */


/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 object $cmb CMB2 object.
 *
 * @return bool             True if metabox should show
 */
function baaz_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template.
	if ( get_option( 'page_on_front' ) !== $cmb->object_id ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object.
 *
 * @return bool                     True if metabox should show
 */
function baaz_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category.
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Manually render a field.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object.
 */
function baaz_render_row_cb( $field_args, $field ) {
	$classes     = $field->row_classes();
	$id          = $field->args( 'id' );
	$label       = $field->args( 'name' );
	$name        = $field->args( '_name' );
	$value       = $field->escaped_value();
	$description = $field->args( 'description' );
	?>
	<div class="custom-field-row <?php echo esc_attr( $classes ); ?>">
		<p><label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $label ); ?></label></p>
		<p><input id="<?php echo esc_attr( $id ); ?>" type="text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo $value; ?>"/></p>
		<p class="description"><?php echo esc_html( $description ); ?></p>
	</div>
	<?php
}




add_action( 'cmb2_init', 'cws_register_testimonial_metabox' );
function cws_register_testimonial_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_baaz_testimonial_';
	
	/**
	 * Featured Testimonial
	 */
	$cmb_featured_testimonial = new_cmb2_box( array(
		'id'           => $prefix . 'testimonial_metabox',
		'title'        => __( 'Testimonial Details', 'baaz-testimonials' ),
		'object_types' => array( 'cws_testimonials', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true,
	) ); 
	
	// $cmb_featured_testimonial->add_field( array(
	// 	'name' => __( 'Name', 'baaz-testimonials' ),
	// 	'id'   => $prefix . 'quote_name',
	// 	'type' => 'text',
	// 	'description' => "Enter name of person providing testimonial."
	// ) );
	$cmb_featured_testimonial->add_field( array(
		'name' => __( 'Comments', 'baaz-testimonials' ),
		'id'   => $prefix . 'quote_comments',
		'type' => 'wysiwyg',
		'description' => "Enter contents of the testimonial."
	) );
	$cmb_featured_testimonial->add_field( array(
		'name' => __( 'Client Location', 'baaz-testimonials' ),
		'id'   => $prefix . 'quote_location',
		'type' => 'text',
		'description' => "Enter City, State."
	) );
}

