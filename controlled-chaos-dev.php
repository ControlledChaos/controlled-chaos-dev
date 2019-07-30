<?php
/**
 * Controlled Chaos Development
 *
 * @package     Controlled_Chaos_Development
 * @version     1.0.0
 * @author      Greg Sweet <greg@ccdzine.com>
 * @copyright   Copyright © 2018, Greg Sweet
 * @link        https://github.com/ControlledChaos/controlled-chaos-dev
 * @license     GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 *
 * Plugin Name:  Controlled Chaos Development
 * Plugin URI:   https://github.com/ControlledChaos/controlled-chaos-dev
 * Description:  ClassicPress/WordPress development tools.
 * Version:      1.0.0
 * Author:       Controlled Chaos Design
 * Author URI:   http://ccdzine.com/
 * License:      GPL-3.0+
 * License URI:  https://www.gnu.org/licenses/gpl.txt
 * Text Domain:  controlled-chaos-dev
 * Domain Path:  /languages
 * Tested up to: 5.2.2
 */

/**
 * License & Warranty
 *
 * Controlled Chaos Development is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Controlled Chaos Development is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Controlled Chaos Development. If not, see {URI to Plugin License}.
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The core plugin class
 *
 * Defines constants, gets the initialization class file
 * plus the activation and deactivation classes.
 *
 * @since  1.0.0
 * @access public
 */

// First check for other classes with the same name.
if ( ! class_exists( 'CC_Dev_Dev' ) ) :
	final class CC_Dev_Dev {

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

				// Define plugin constants.
				$instance->constants();

				// Require the core plugin class files.
				$instance->dependencies();

			}

			// Return the instance.
			return $instance;

		}

		/**
		 * Constructor method
		 *
		 * @since  1.0.0
		 * @access protected
		 * @return void Constructor method is empty.
		 *              Change to `self` if used.
		 */
		protected function __construct() {}

		/**
		 * Define plugin constants
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function constants() {

			/**
			 * Plugin version
			 *
			 * @since  1.0.0
			 * @return string Returns the latest plugin version.
			 */
			if ( ! defined( 'CCDEV_VERSION' ) ) {
				define( 'CCDEV_VERSION', '1.0.0' );
			}

			/**
			 * Text domain
			 *
			 * @since  1.0.0
			 * @return string Returns the text domain of the plugin.
			 *
			 * @todo   Replace all strings with constant.
			 */
			if ( ! defined( 'CCDEV_DOMAIN' ) ) {
				define( 'CCDEV_DOMAIN', 'controlled-chaos-dev' );
			}

			/**
			 * Plugin folder path
			 *
			 * @since  1.0.0
			 * @return string Returns the filesystem directory path (with trailing slash)
			 *                for the plugin __FILE__ passed in.
			 */
			if ( ! defined( 'CCDEV_PATH' ) ) {
				define( 'CCDEV_PATH', plugin_dir_path( __FILE__ ) );
			}

			/**
			 * Plugin folder URL
			 *
			 * @since  1.0.0
			 * @return string Returns the URL directory path (with trailing slash)
			 *                for the plugin __FILE__ passed in.
			 */
			if ( ! defined( 'CCDEV_URL' ) ) {
				define( 'CCDEV_URL', plugin_dir_url( __FILE__ ) );
			}

			/**
			 * Universal slug
			 *
			 * This URL slug is used for various plugin admin & settings pages.
			 *
			 * @since  1.0.0
			 * @return string Returns the URL slug of the admin pages.
			 */
			if ( ! defined( 'CCDEV_ADMIN_SLUG' ) ) {
				define( 'CCDEV_ADMIN_SLUG', 'controlled-chaos-dev' );
			}

		}

		/**
		 * Throw error on object clone.
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function __clone() {

			// Cloning instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, __( 'This is not allowed.', 'controlled-chaos-dev' ), '1.0.0' );

		}

		/**
		 * Disable unserializing of the class.
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function __wakeup() {

			// Unserializing instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, __( 'This is not allowed.', 'controlled-chaos-dev' ), '1.0.0' );

		}

		/**
		 * Require the core plugin class files.
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void Gets the file which contains the core plugin class.
		 */
		private function dependencies() {

			// The hub of all other dependency files.
			require_once CCDEV_PATH . 'includes/class-init.php';

			// Include the activation class.
			require_once CCDEV_PATH . 'includes/class-activate.php';

			// Include the deactivation class.
			require_once CCDEV_PATH . 'includes/class-deactivate.php';

		}

	}
	// End core plugin class.

	/**
	 * Put an instance of the plugin class into a function.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object Returns the instance of the `CC_Dev_Dev` class.
	 */
	function ccdev_plugin() {

		return CC_Dev_Dev::instance();

	}

	// Begin plugin functionality.
	ccdev_plugin();

// End the check for the plugin class.
endif;

/**
 * Register the activaction & deactivation hooks.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
register_activation_hook( __FILE__, '\ccdev_activate_plugin' );
register_deactivation_hook( __FILE__, '\ccdev_deactivate_plugin' );

/**
 * The code that runs during plugin activation.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function ccdev_activate_plugin() {

	// Run the activation class.
	ccdev_activate();

}

// Bail out now if the core class was not run.
if ( ! function_exists( 'ccdev_plugin' ) ) {
	return;
}

/**
 * The code that runs during plugin deactivation.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function ccdev_deactivate_plugin() {

	// Run the deactivation class.
	ccdev_deactivate();

}

/**
 * Add a link to the plugin's settings page
 *
 * Uses the universal slug partial for admin pages. Set this
 * slug in the core plugin file.
 *
 * @param  array $links Default plugin links on the 'Plugins' admin page.
 * @since  1.0.0
 * @access public
 * @return mixed[] Returns an HTML string for the about page link.
 *                 Returns an array of the about link with the default plugin links.
 */
function ccdev_settings_link( $links ) {

	if ( is_admin() ) {

		$url = admin_url( 'tools.php?page=' . CCDEV_ADMIN_SLUG . '-settings' );

		// Create new settings link array as a variable.
		$settings_page = [
			sprintf(
				'<a href="%1s" class="' . CCDEV_ADMIN_SLUG . '-settings-link">%2s</a>',
				$url,
				esc_attr( 'Settings', 'controlled-chaos-dev' )
			),
		];

		// Merge the new settings array with the default array.
		return array_merge( $settings_page, $links );

	}

}
// Filter the default settings links with new array.
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'ccdev_settings_link' );