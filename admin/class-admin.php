<?php
/**
 * Admin functiontionality and settings.
 *
 * @package    Controlled_Chaos_Development
 * @subpackage Admin
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 *
 * @todo       Add admin and user access checks.
 */

namespace CC_Dev\Admin;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Admin functiontionality and settings.
 *
 * @since  1.0.0
 * @access public
 */
class Admin {

	/**
	 * Instance of the class
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object Returns the instance.
	 */
	public static function instance() {

		// Varialbe for the instance to be used outside the class.
		static $instance = null;

		if ( is_null( $instance ) ) {

			// Set variable for new instance.
			$instance = new self;

			// Require the class files.
			$instance->dependencies();

		}

		// Return the instance.
		return $instance;

	}

	/**
	 * Constructor method
	 *
	 * @since  1.0.0
	 * @access private
	 * @return self
	 */
	private function __construct() {

		// Add the settings page to the admin menu.
		add_action( 'admin_menu', [ $this, 'settings_page' ] );

	}

	/**
	 * Class dependency files.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function dependencies() {}

	/**
	 * Add development subpage to Tools in the admin menu.
	 *
	 * Uses the universal slug partial for admin pages. Set this
     * slug in the core plugin file.
	 *
	 * Adds a contextual help section.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function settings_page() {

		$this->page_help_section = add_management_page(
			__( 'Website Development', 'controlled-chaos-dev' ),
			__( 'Site Development', 'controlled-chaos-dev' ),
			'manage_options',
			CCDEV_ADMIN_SLUG . '-settings',
			[ $this, 'settings_page_output' ]
		);

		// Add content to the Help tab.
		add_action( 'load-' . $this->page_help_section, [ $this, 'settings_page_help_section' ] );

	}

	/**
	 * Get development subpage output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function settings_page_output() {

		require CCDEV_PATH . 'admin/partials/settings-page.php';

	}

	/**
     * Output for the development page contextual help section.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
     */
    public function settings_page_help_section() {

		// Add to the development page.
		$screen = get_current_screen();
		if ( $screen->id != $this->page_help_section ) {
			return;
		}

		// More information.
		$screen->add_help_tab( [
			'id'       => 'help_dev_info',
			'title'    => __( 'More Information', 'controlled-chaos-dev' ),
			'content'  => null,
			'callback' => [ $this, 'help_dev_info_output' ]
		] );

		// Add a help sidebar.
		$screen->set_help_sidebar(
			$this->help_dev_info_sidebar()
		);

	}

	/**
     * Get more information help tab content.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
     */
	public function help_dev_info_output() {

		include_once CCDEV_PATH . 'admin/partials/help-dev-info.php';

    }

    /**
     * Get development page contextual tab sidebar content.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
     */
    public function help_dev_info_sidebar() {

		$html = '';
		return $html;

	}

}

/**
 * Put an instance of the class into a function.
 *
 * @since  1.0.0
 * @access public
 * @return object Returns an instance of the class.
 */
function ccdev_admin() {

	return Admin::instance();

}

// Run an instance of the class.
ccdev_admin();