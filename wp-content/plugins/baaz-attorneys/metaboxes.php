<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 */

/**
 * Get the bootstrap!
 */

if ( file_exists( dirname( __FILE__ ) . '/metabox/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/metabox/init.php';
}

// Get practice-area Post type
function cws_get_pa_post_options( $query_args ) {

     $args = wp_parse_args( $query_args, array(
         'post_type'   => 'practice-area',
         'numberposts' => -1,
     ) );

     $posts = get_posts( $args );

     $post_options = array();
     if ( $posts ) {
         foreach ( $posts as $post ) {
           $post_options[ $post->ID ] = $post->post_title;
         }
     }

     return $post_options;
}

add_action( 'cmb2_init', 'cws_register_attorneys_metabox' );
function cws_register_attorneys_metabox() {


	// Start with an underscore to hide fields from custom fields list
	$prefix = '_baaz_attorney_';
	
		
	/**
	 * Intro
	 */
	$cmb_attorney_intro = new_cmb2_box( array(
		'id'           => $prefix . 'intro_metabox',
		'title'        => __( 'Details', 'baaz-attorneys' ),
		'object_types' => array( 'cws_attorney', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true,
	) );
	
	$cmb_attorney_intro->add_field( array(
		'name' => __( 'Job Title', 'baaz-attorneys' ),
		'id'   => $prefix . 'job_title',
		'type' => 'text',
	) );

	$cmb_attorney_intro->add_field( array(
		'name' => __( 'Short Description', 'baaz-attorneys' ),
		'id'   => $prefix . 'short_desc',
		'type' => 'textarea',
	) );
	
	/**
	 * Practice Area
	 */
	$cmb_attorney_pa = new_cmb2_box( array(
		'id'           => $prefix . 'attorney_pa_metabox',
		'title'        => __( 'Practice Areas', 'baaz-attorneys' ),
		'object_types' => array( 'cws_attorney', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true,
	) );
	
	$cmb_attorney_pa->add_field( array(
		'name' => __( 'Section Heading', 'baaz-attorneys' ),
		'id'   => $prefix . 'pa_heading',
		'type' => 'text',
		'default' => ' Practice Area',
	) );
	
	$cmb_attorney_pa ->add_field( array(
	'name'     => __( 'Practice Areas', 'baaz-attorneys' ),
	'id'       => $prefix . 'select_pa',
	'type'	=> 'multicheck',
	'options' => 'cws_get_pa_post_options',
	) );
	
	/**
	 * Industries
	 */
	$cmb_attorney_industries = new_cmb2_box( array(
		'id'           => $prefix . 'attorney_industries_metabox',
		'title'        => __( 'Industries', 'baaz-attorneys' ),
		'object_types' => array( 'cws_attorney', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true,
	) );
	
	$cmb_attorney_industries->add_field( array(
		'name' => __( 'Section Heading', 'baaz-attorneys' ),
		'id'   => $prefix . 'industries_heading',
		'type' => 'text',
		'default' => 'Industries',
	) );
	
	$industries_field_id = $cmb_attorney_industries->add_field( array(
		'id'          => $prefix . 'industry_group',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => __( 'Industry {#}', 'baaz-attorneys' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Industry', 'baaz-attorneys' ),
			'remove_button' => __( 'Remove Industry', 'baaz-attorneys' ),
			'sortable'      => true,
		),
	) );

	$cmb_attorney_industries->add_group_field( $industries_field_id, array(
		'name'       => __( 'Industry Name', 'baaz-attorneys' ),
		'id'         => $prefix .'industry_name',
		'type'       => 'text',
	) );

	/**
	 * Contact Info
	 */
	$cmb_attorney_contact = new_cmb2_box( array(
		'id'           => $prefix . 'contact_metabox',
		'title'        => __( 'Contact Details', 'baaz-attorneys' ),
		'object_types' => array( 'cws_attorney', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true,
	) );
	$cmb_attorney_contact->add_field( array(
		'name' => __( 'Section Heading', 'baaz-attorneys' ),
		'id'   => $prefix . 'contact_heading',
		'type' => 'text',
		'default' => 'Contact',
	) );
	$cmb_attorney_contact->add_field( array(
		'name' => __( 'Address', 'baaz-attorneys' ),
		'id'   => $prefix . 'contact_address',
		'type' => 'textarea_small',
	) );
	$cmb_attorney_contact->add_field( array(
		'name' => __( 'Phone', 'baaz-attorneys' ),
		'id'   => $prefix . 'contact_phone',
		'type' => 'text_medium',
	) );
	$cmb_attorney_contact->add_field( array(
		'name' => __( 'Fax', 'baaz-attorneys' ),
		'id'   => $prefix . 'contact_fax',
		'type' => 'text_medium',
	) );
	$cmb_attorney_contact->add_field( array(
		'name' => __( 'Email', 'baaz-attorneys' ),
		'id'   => $prefix . 'contact_email',
		'type' => 'text_medium',
	) );
	$cmb_attorney_contact->add_field( array(
		'name' => __( 'Linkedin', 'baaz-attorneys' ),
		'id'   => $prefix . 'contact_linkedin',
		'type' => 'text',
	) );
	$cmb_attorney_contact->add_field( array(
		'name' => __( 'Facebook', 'baaz-attorneys' ),
		'id'   => $prefix . 'contact_facebook',
		'type' => 'text',
	) );
	$cmb_attorney_contact->add_field( array(
		'name' => __( 'Twitter', 'baaz-attorneys' ),
		'id'   => $prefix . 'contact_twitter',
		'type' => 'text',
	) );
	$cmb_attorney_contact->add_field( array(
		'name' => __( 'Google +', 'baaz-attorneys' ),
		'id'   => $prefix . 'contact_gplus',
		'type' => 'text',
	) );

	/**
	 * Education Info
	 */

	$cmb_attorney_education = new_cmb2_box( array(
		'id'           => $prefix . 'education_metabox',
		'title'        => __( 'Education', 'baaz-attorneys' ),
		'object_types' => array( 'cws_attorney', ),
	) );
	
	$cmb_attorney_education->add_field( array(
		'name' => __( 'Section Heading', 'baaz-attorneys' ),
		'id'   => $prefix . 'education_heading',
		'type' => 'text',
		'default' => 'Education',
	) );

	$education_field_id = $cmb_attorney_education->add_field( array(
		'id'          => $prefix . 'education_group',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => __( 'School {#}', 'baaz-attorneys' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another School', 'baaz-attorneys' ),
			'remove_button' => __( 'Remove School', 'baaz-attorneys' ),
			'sortable'      => true,
		),
	) );

	$cmb_attorney_education->add_group_field( $education_field_id, array(
		'name'       => __( 'School Name', 'baaz-attorneys' ),
		'id'         => $prefix .'school_name',
		'type'       => 'text',
	) );

	$cmb_attorney_education->add_group_field( $education_field_id, array(
		'name'        => __( 'Description', 'baaz-attorneys' ),
		'id'          => $prefix .'school_desc',
		'type'        => 'text',
	) );
	
	/**
	 * Associations
	 */

	$cmb_attorney_associations = new_cmb2_box( array(
		'id'           => $prefix . 'associations_metabox',
		'title'        => __( 'Associations', 'baaz-attorneys' ),
		'object_types' => array( 'cws_attorney', ),
	) );
	
	$cmb_attorney_associations->add_field( array(
		'name' => __( 'Section Heading', 'baaz-attorneys' ),
		'id'   => $prefix . 'associations_heading',
		'type' => 'text',
		'default' => 'Associations',
	) );

	$associations_field_id = $cmb_attorney_associations->add_field( array(
		'id'          => $prefix . 'associations_group',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => __( 'Association {#}', 'baaz-attorneys' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Association', 'baaz-attorneys' ),
			'remove_button' => __( 'Remove Association', 'baaz-attorneys' ),
			'sortable'      => true,
		),
	) );

	$cmb_attorney_associations->add_group_field( $associations_field_id, array(
		'name'       => __( 'Association Name', 'baaz-attorneys' ),
		'id'         => $prefix .'association_name',
		'type'       => 'text',
	) );
	
	/**
	 * Membership/Awards
	 */

	$cmb_attorney_awards = new_cmb2_box( array(
		'id'           => $prefix . 'awards_metabox',
		'title'        => __( 'Membership/Awards', 'baaz-attorneys' ),
		'object_types' => array( 'cws_attorney', ),
	) );
	
	$cmb_attorney_awards->add_field( array(
		'name' => __( 'Section Heading', 'baaz-attorneys' ),
		'id'   => $prefix . 'awards_heading',
		'type' => 'text',
		'default' => 'Membership & Awards',
	) );

	$awards_field_id = $cmb_attorney_awards->add_field( array(
		'id'          => $prefix . 'awards_group',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => __( 'Membership/Award {#}', 'baaz-attorneys' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Membership/Award', 'baaz-attorneys' ),
			'remove_button' => __( 'Remove Membership/Award', 'baaz-attorneys' ),
			'sortable'      => true,
		),
	) );

	$cmb_attorney_awards->add_group_field( $awards_field_id, array(
		'name'       => __( 'Logo', 'baaz-attorneys' ),
		'id'         => $prefix .'award_logo',
		'type'       => 'file',
	) );
	
}
