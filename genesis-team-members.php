<?php
/**
 * Plugin Name: Genesis Team Members
 * Plugin URI: http://wpbacon.com/genesis-team-members/
 * Description: Create a custom post type for team members and a widget to display them.
 * Author: Ozzy Rodriguez
 * Author URI: http://www.ozzyrodriguez.com/
 * Version: 1.0.0
 * Text Domain: gtmp
 * Domain Path: languages
 *
 * Genesis Team Members is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Genesis Featured Team is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Awesome Featured Content. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package  GTMP
 * @category Core
 * @author   Ozzy Rodriguez
 * @version  1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Genesis_Team_Members' ) ) :

class Genesis_Team_Members {
	/** Singleton *************************************************************/

	/**
	 * @var Genesis_Team_Members The one true Genesis_Team_Members
	 * @since 1.4
	 */
	private static $instance;

	/**
	 * Main Genesis_Team_Members Instance
	 *
	 * Insures that only one instance of Genesis_Team_Members exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @since 1.4
	 * @static
	 * @staticvar array $instance
	 * @uses Genesis_Team_Members::setup_globals() Setup the globals needed
	 * @uses Genesis_Team_Members::includes() Include the required files
	 * @uses Genesis_Team_Members::setup_actions() Setup the hooks and actions
	 * @see GTMP()
	 * @return The one true Genesis_Team_Members
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Genesis_Team_Members ) ) {
			self::$instance = new Genesis_Team_Members;
			self::$instance->setup_constants();
			self::$instance->includes();
			self::$instance->load_textdomain();
		}
		return self::$instance;
	}

	/**
	 * Throw error on object clone
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be cloned.
	 *
	 * @since 1.6
	 * @access protected
	 * @return void
	 */
	public function __clone() {
		// Cloning instances of the class is forbidden
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'gtmp' ), '1.6' );
	}

	/**
	 * Disable unserializing of the class
	 *
	 * @since 1.6
	 * @access protected
	 * @return void
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'gtmp' ), '1.6' );
	}

	/**
	 * Setup plugin constants
	 *
	 * @access private
	 * @since 1.4
	 * @return void
	 */
	private function setup_constants() {

		// Plugin version
		if ( ! defined( 'GTMP_VERSION' ) ) {
			define( 'GTMP_VERSION', '1.0.0' );
		}

		// Plugin Folder URL
		if ( ! defined( 'GTMP_PLUGIN_URL' ) ) {
			define( 'GTMP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}

		// Plugin Folder Path
		if ( ! defined( 'GTMP_PLUGIN_DIR' ) ) {
			define( 'GTMP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}

		// Plugin Root File
		if ( ! defined( 'GTMP_PLUGIN_FILE' ) ) {
			define( 'GTMP_PLUGIN_FILE', __FILE__ );
		}

	}

	/**
	 * Include required files
	 *
	 * @access private
	 * @since 1.4
	 * @return void
	 */
	private function includes() {

		/** Require Plugin Files*/
		require_once GTMP_PLUGIN_DIR . 'includes/cpt.php';
		require_once GTMP_PLUGIN_DIR . 'includes/install.php';
		require_once GTMP_PLUGIN_DIR . 'includes/functions.php';
		require_once GTMP_PLUGIN_DIR . 'includes/scripts.php';
		require_once GTMP_PLUGIN_DIR . 'includes/widgets.php';
		require_once GTMP_PLUGIN_DIR . 'includes/genesis-team-members-widget.php';
		require_once GTMP_PLUGIN_DIR . 'includes/cmb/gtmp-metaboxes.php';
		if( is_admin() ) {
			require_once GTMP_PLUGIN_DIR . 'includes/admin/scripts.php';
		}
	}

	/**
	 * Loads the plugin language files
	 *
	 * @access public
	 * @since 1.4
	 * @return void
	 */
	public function load_textdomain() {
		// Set filter for plugin's languages directory
		$gtmp_lang_dir = dirname( plugin_basename( GTMP_PLUGIN_FILE ) ) . '/languages/';
		$gtmp_lang_dir = apply_filters( 'gtmp_languages_directory', $gtmp_lang_dir );

		// Traditional WordPress plugin locale filter
		$locale        = apply_filters( 'plugin_locale',  get_locale(), 'gtmp' );
		$mofile        = sprintf( '%1$s-%2$s.mo', 'gtmp', $locale );

		// Setup paths to current locale file
		$mofile_local  = $gtmp_lang_dir . $mofile;
		$mofile_global = WP_LANG_DIR . '/genesis-team-members/' . $mofile;

		if ( file_exists( $mofile_global ) ) {
			// Look in global /wp-content/languages/gtmp folder
			load_textdomain( 'gtmp', $mofile_global );
		} elseif ( file_exists( $mofile_local ) ) {
			// Look in local /wp-content/plugins/easy-digital-obituaries/languages/ folder
			load_textdomain( 'gtmp', $mofile_local );
		} else {
			// Load the default language files
			load_plugin_textdomain( 'gtmp', false, $gtmp_lang_dir );
		}
	}
}

endif; // End if class_exists check

/**
 * The main function responsible for returning the one true Genesis_Team_Members
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $gtmp = GTMP(); ?>
 *
 * @since 1.4
 * @return object The one true Genesis_Team_Members Instance
 */
function GTMP() {
	return Genesis_Team_Members::instance();
}

// Get GTMP Running
GTMP();
