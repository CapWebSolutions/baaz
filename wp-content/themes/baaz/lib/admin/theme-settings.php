<?php
/**
 * Registers a new admin page, providing content and corresponding menu item
 * for the Child Theme Settings page.
 *
 * @since 1.0.0
 *
 * @package baaz
 * @subpackage BAAZ_Settings
 */
class BAAZ_Settings extends Genesis_Admin_Boxes {

	/**
	 * Create an admin menu item and settings page.
	 * @since 1.0.0
	 */
	function __construct() {

		// Specify a unique page ID.
		$page_id = 'baaz';

		// Set it as a child to genesis, and define the menu and page titles
		$menu_ops = array(
			'submenu' => array(
				'parent_slug' => 'genesis',
				'page_title'  => __( 'BAAZ Settings', 'baaz' ),
				'menu_title'  => __( 'BAAZ Settings', 'baaz' ),
				'capability' => 'manage_options',
			)
		);

		// Set up page options. These are optional, so only uncomment if you want to change the defaults
		$page_ops = array(
		//	'screen_icon'       => 'options-general',
		//	'save_button_text'  => 'Save Settings',
		//	'reset_button_text' => 'Reset Settings',
		//	'save_notice_text'  => 'Settings saved.',
		//	'reset_notice_text' => 'Settings reset.',
		);

		// Give it a unique settings field.
		// You'll access them from genesis_get_option( 'option_name', 'baaz-settings' );
		$settings_field = 'baaz-settings';

		// Set the default values
		$default_settings = array(
			'cws_attorneys_count' => '12',
			'cws_page_top_image' => '[child]/images/top-image.jpg',
			'cws_practice_area_top_image' => '[child]/images/top-image.jpg',
			'cws_attorney_top_image' => '[child]/images/top-image.jpg',
			'cws_search' => 1,
			'cws_phone' => '248-555-1212',
			'cws_info' => '30100 Telegraph Road  |  Birmingham, MI 48382 <br />248-555-1212 p  | 248-555-4422 f',
			'cws_copyright' => '[footer_copyright] Baaz Lawyer Theme  |  Baaz is a Genesis Theme Modified by Cap Web Solutions',
			'cws_extras' => '<img class="alignright" src="[url]/wp-content/uploads/2016/05/tl.png" alt="The Best Lawyers of America" />
<img class="alignright" src="[url]/wp-content/uploads/2016/05/sls.png" alt="Best Law Firms" />
<img class="alignright" src="[url]/wp-content/uploads/2016/05/cuafew.png" alt="Award Winner Logo" />
<img class="alignright" src="[url]/wp-content/uploads/2016/05/blfldl.png" alt="Top Law Firms" />
<img class="alignright" src="[url]/wp-content/uploads/2016/05/tblis.png" alt="" />',
			);

		// Create the Admin Page
		$this->create( $page_id, $menu_ops, $page_ops, $settings_field, $default_settings );

		// Initialize the Sanitization Filter
		add_action( 'genesis_settings_sanitizer_init', array( $this, 'sanitization_filters' ) );

	}

	/**
	 * Set up Sanitization Filters
	 * @since 1.0.0
	 *
	 * See /lib/classes/sanitization.php for all available filters.
	 */
	function sanitization_filters() {

		genesis_add_option_filter( 'no_html', $this->settings_field,
			array(
				'cws_attorneys_count',
			) );

		genesis_add_option_filter( 'one_zero', $this->settings_field,
			array(
				'cws_search',
			) );

		genesis_add_option_filter( 'safe_html', $this->settings_field,
			array(
				'cws_page_top_image',
				'cws_practice_area_top_image',
				'cws_attorney_top_image',
				'cws_phone',
				'cws_copyright',
				'cws_info',
				'cws_extras',
			) );
	}

	/**
	 * Set up Help Tab
	 * @since 1.0.0
	 *
	 * Genesis automatically looks for a help() function, and if provided uses it for the help tabs
	 * @link http://wpdevel.wordpress.com/2011/12/06/help-and-screen-api-changes-in-3-3/
	 */
	 function help() {
	 	$screen = get_current_screen();

		$screen->add_help_tab( array(
			'id'      => 'sample-help',
			'title'   => 'Sample Help',
			'content' => '<p>Help content goes here.</p>',
		) );
	 }

	/**
	 * Register metaboxes on Child Theme Settings page
	 * @since 1.0.0
	 */
	function metaboxes() {
		add_meta_box('baaz_attorneys_metabox', __( 'Attorneys Main', 'baaz' ), array( $this, 'baaz_attorneys_metabox' ), $this->pagehook, 'main', 'high');
		add_meta_box('baaz_top_image_metabox', __( 'Default Top Image', 'baaz' ), array( $this, 'baaz_top_image_metabox' ), $this->pagehook, 'main', 'high');
		add_meta_box('baaz_navigation_metabox', __( 'Menu Extras', 'baaz' ), array( $this, 'baaz_navigation_metabox' ), $this->pagehook, 'main', 'high');
		add_meta_box('baaz_footer_info_metabox', __( 'Footer Info', 'baaz' ), array( $this, 'baaz_footer_info_metabox' ), $this->pagehook, 'main', 'high');
		add_meta_box('cws_upate_notifications_metabox', __( 'Update Notifications', 'baaz' ), array( $this, 'cws_upate_notifications_metabox' ), $this->pagehook, 'main', 'high');
	}

	/**
	 * Interior Top Image Metabox
	 * @since 1.0.0
	 */
	function baaz_attorneys_metabox() {
		echo '<p><strong>' . __( 'Attorneys Per Page:', 'baaz' ) . '</strong> ';
		echo '<input class="small-text" type="text" name="' . $this->get_field_name( 'cws_attorneys_count' ) . '" id="' . $this->get_field_id( 'cws_attorneys_count' ) . '" value="' . esc_attr( $this->get_field_value( 'cws_attorneys_count' ) ) . '" /></p>';
	}

	/**
	 * Interior Top Image Metabox
	 * @since 1.0.0
	 */
	function baaz_top_image_metabox() {

	echo '<p><strong>' . __( 'Page Top Image URL', 'baaz' ) . '</strong><br>';
	echo '<input class="large-text" type="text" name="' . $this->get_field_name( 'cws_page_top_image' ) . '" id="' . $this->get_field_id( 'cws_page_top_image' ) . '" value="' . esc_attr( $this->get_field_value( 'cws_page_top_image' ) ) . '" /><br><em><small>' . __( ' Recommended image size', 'baaz' ) . ' 1200px x 250px</small></em></p>';

	echo '<p><strong>' . __( 'Practice Area Top Image URL', 'baaz' ) . '</strong><br>';
	echo '<input class="large-text" type="text" name="' . $this->get_field_name( 'cws_practice_area_top_image' ) . '" id="' . $this->get_field_id( 'cws_practice_area_top_image' ) . '" value="' . esc_attr( $this->get_field_value( 'cws_practice_area_top_image' ) ) . '" /><br><em><small>' . __( ' Recommended image size', 'baaz' ) . ' 1200px x 250px</small></em></p>';

	echo '<p><strong>' . __( 'Attorneys Top Image URL', 'baaz' ) . '</strong><br>';
	echo '<input class="large-text" type="text" name="' . $this->get_field_name( 'cws_attorney_top_image' ) . '" id="' . $this->get_field_id( 'cws_attorney_top_image' ) . '" value="' . esc_attr( $this->get_field_value( 'cws_attorney_top_image' ) ) . '" /><br><em><small>' . __( ' Recommended image size', 'baaz' ) . ' 1200px x 250px</small></em></p>';

	}

	/**
	 * Navigation Extras Metabox
	 * @since 1.0.0
	 */
	function baaz_navigation_metabox() {

		echo '<p><input type="checkbox" name="' . $this->get_field_name( 'cws_search' ) . '" id="' . $this->get_field_id( 'cws_search' ) . '" value="1"';
        checked( 1, $this->get_field_value( 'cws_search' ) ); echo '/><strong>' . __( 'Enable Search in Primary Menu', 'baaz' ) . '</strong></p>';

		echo '<p><strong>' . __( 'Add Phone Number to Secondary Menu', 'baaz' ) . '</strong><br>';
		echo '<input class="medium-text" type="text" name="' . $this->get_field_name( 'cws_phone' ) . '" id="' . $this->get_field_id( 'cws_phone' ) . '" value="' . esc_attr( $this->get_field_value( 'cws_phone' ) ) . '" /></p>';
	}


	/**
	 * Footer Info Metabox
	 * @since 1.0.0
	 */
	function baaz_footer_info_metabox() {

		echo '<p><strong>' . __( 'Contact Info', 'baaz' ) . '</strong><br>';
		echo '<input class="large-text" type="text" name="' . $this->get_field_name( 'cws_info' ) . '" id="' . $this->get_field_id( 'cws_info' ) . '" value="' . esc_attr( $this->get_field_value( 'cws_info' ) ) . '" /></p>';

		echo '<p><strong>' . __( 'Copyright Info', 'baaz' ) . '</strong><br>';
		echo '<input class="large-text" type="text" name="' . $this->get_field_name( 'cws_copyright' ) . '" id="' . $this->get_field_id( 'cws_copyright' ) . '" value="' . esc_attr( $this->get_field_value( 'cws_copyright' ) ) . '" /></p>';

		echo '<p><strong>' . __( 'Footer Right Content', 'baaz' ) . '</strong><br>';
		echo __( '(Some HTML is allowed.)', 'baaz' ) . '<br>';
		echo '<textarea class="large-text" name="' . $this->get_field_name( 'cws_extras' ) . '" cols="78" rows="8">' . esc_textarea( $this->get_field_value( 'cws_extras' ) ) . '</textarea><br><small><em>(Recommended image size for awards icons is 64px wide by 60px high)</em></small></p>';

	}

	/**
	 * Update Notifications Metabox
	 * @since 1.0.0
	 */
	function cws_upate_notifications_metabox() {

		echo '<p>' . __( 'Please check the box below if you wish to ignore/hide the theme update notification.<br/>Uncheck the box if you wish to be notified of theme updates.', 'baaz' ) . '</p>';

		echo '<input type="checkbox" name="' . $this->get_field_name( 'cws_ignore_updates' ) . '" id="' .  $this->get_field_id( 'cws_ignore_updates' ) . '" value="1" ';
		checked( 1, $this->get_field_value( 'cws_ignore_updates' ) );
		echo '/> <label for="' . $this->get_field_id( 'cws_ignore_updates' ) . '">' . __( 'Ignore Theme Updates?', 'baaz' ) . '</label>';

	}


}

/**
 * Add the Theme Settings Page
 * @since 1.0.0
 */
function baaz_add_settings() {
	global $_child_theme_settings;
	$_child_theme_settings = new BAAZ_Settings;
}
add_action( 'genesis_admin_menu', 'baaz_add_settings' );
