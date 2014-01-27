<?php
/**
 * Install Function
 *
 * @package     GTMP
 * @subpackage  Functions/Install
 * @copyright   Copyright (c) 2014, Ozzy Rodriguez
 * @license     GPL-2.0+
 * @since       1.0.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Install
 *
 * Runs on plugin install by setting up the post types, custom taxonomies,
 * flushing rewrite rules to initiate the new 'obituaries' slug and also
 * creates the plugin and populates the settings fields for those plugin
 * pages. After successfull install, the user is redirected to the AFCW Welcome
 * screen.
 *
 * @since 1.0.0
 * @global $gtmp
 * @global $gtmp_options
 * @global $wp_version
 * @return void
 */
function gtmp_install() {
	global $wp_version;

	if ( (float) $wp_version < 3.7 ) {
		deactivate_plugins( plugin_basename( __FILE__ ) );
		wp_die( __( 'Looks like you\'re running an older version of WordPress, you need to be running at least WordPress 3.7 to use Genesis Team Members.', 'gtmp' ), __( 'Genesis Team Members is not compatible with this version of WordPress.', 'gtmp' ), array( 'back_link' => true ) );
	}

	update_option( 'gtmp_version', GTMP_VERSION );

}
register_activation_hook( GTMP_PLUGIN_FILE, 'gtmp_install' );